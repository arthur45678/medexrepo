<?php

namespace App\Http\Controllers;

use App\Models\AdministrativeStaff;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\DepartmentConnection;

use App\Models\User;
use App\Models\Referral;
use App\Models\Patient;
use App\Models\PatientConnection;
use App\Models\Queue;

class DepartmentController extends Controller
{
    /**
     * Display a list of the resource's listing.
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $department_connections = DepartmentConnection::where('user_id', '=', auth()->id())->pluck('department_id');
        $departments = Department::get();
        return view('departments.index', compact('departments', 'department_connections'));
    }


    public function users(Request $request, Department $department)
    {
        $users = User::departmentStaff($department->id)->get();
        return view('users.index')->with(compact('users', 'department'));
    }

    public function user(Request $request, $department_id, $user_id)
    {
        $user = User::where([
            ['id', '=', $user_id],
            ['department_id', '=', $department_id]
        ])->first();

        if(!$user) {
            abort(403, __('authorization.user.not-belongs-to-user'));
        }
        return view('users.show')->with(compact("user"));
    }

    public function patients(Request $request, Department $department)
    {
        $this->authorize('viewAny', 'App\Models\Patient');
        $patients = Patient::departmentPatients($department)->get();
        return view('patients.index', compact('patients','department'));
    }

    public function patient(Request $request, Department $department, Patient $patient)
    {
        $this->authorize('view', $patient);
        $patients = Patient::departmentPatients($department)->pluck('id');
        if(!$patients->contains($patient->id)) {
            abort(403, __('authorization.user.not-belongs-to-user'));
        }

        $patient_with_relations = Patient::with(Patient::samples_relations())->find($patient->id);
        $patient_samples = Patient::get_patient_samples($patient_with_relations);
        $has_ambulator = $patient_with_relations->ambulator ? true : false;
        return view("patients.show")->with(compact("patient", "patient_samples", "has_ambulator"));
    }

    /**
     * Display a structure of the resource's listing.
     * @return \Illuminate\Http\Response
     */
    public function structure()
    {

        $posts = AdministrativeStaff::with('departments')->get();

        return view('departments.structure',compact('posts'));
    }

    /**
     * Display queue into department.
     * @return \Illuminate\Http\Response
     */
    public function queue(Request $request,Department $department)
    {
        $doctor = User::where([
            ['department_id','=', $department->id],
            ['id','=', auth()->id()],
        ])->with(['queues' => function ($q) {
            $q->orderBy('created_at');
        }, 'queues.referral'])->first();

        return view('departments.queue', compact('doctor'));
    }

    public function queues(Request $request, Department $department)
    {
        $this->authorize('is-department-head-or-registrar');

        $doctors = User::where('department_id', $department->id)->with(['queues' => function ($q) {
            $q->orderBy('created_at');
        }, 'queues.referral'])->get()->filter(function ($user) {
            return $user->hasRole('doctor');
        });
        // dd($doctors);
        $receivedReferrals = Referral::where([
            ['department_id', '=',  $department->id],
            ['receiver_id', '=', null]
        ])->with(["sender", "sender.department", "services", "patient"])->latest()->get();
        // dd($receivedReferrals);
        return view('departments.queues', compact("receivedReferrals", "doctors", "department"));
    }

    public function queueStore(Request $request)
    {

        $request->validate([
            'referral_id' => 'required|numeric',
            // 'patient_id' => 'required|numeric',
            'select_user_id' => 'required|numeric',
            'is_urgent' => 'boolean'
        ]);

        $user = User::with('queues')->find($request->select_user_id);
        // $patient = Patient::find($request->patient_id);
        $referral = Referral::find($request->referral_id);
        $last_number = $user->queues->last()->number ?? 0; // չբարդացնելու համար 'is_urgent'-ը կկարմրացնենք։

        $user->queues()->create([
            'referral_id' => $request->referral_id,
            'is_urgent' => $request->is_urgent ?? 0,
            'number' => $last_number + 1,
        ]);

        $referral->update([ 'receiver_id' => $user->id ]);
        $referral->patient_connection()->update(["receiver_id" => $user->id]);

        // dump($referral);
        return back()->withSuccess(__("queues.created"));
    }

    public function queueDelete(Request $request)
    {
        $request->validate([
            'queue_id' => 'required|uuid'
        ]);

        Queue::destroy($request->queue_id);
        return back()->withSuccess(__("queues.deleted"));
    }


}
