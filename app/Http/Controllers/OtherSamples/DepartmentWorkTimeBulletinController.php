<?php

namespace App\Http\Controllers\otherSamples;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\OtherSamples\DepartmentWorkTimeBulletin;
use App\Models\User;
use Carbon\Carbon;

class DepartmentWorkTimeBulletinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(int $department_id)
    {
        $department = Department::find($department_id);
        if ($department_id !== auth()->user()->department_id || !$department) {
            abort(403, __('authorization.user.not-belongs-to-user') .' - dwt-index');
        }

        $department_work_time_bulletin = DepartmentWorkTimeBulletin::where([
            ['department_id', '=', $department_id],
            // ['user_id', '=', auth()->id()] // բաժնեցիք թող նայեն
        ])->with('user_work_time_bulletins', 'department')->latest()->get();

        return view('otherSamples.work_time_bulletin.departments.index', compact('department_work_time_bulletin', 'department'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return 'create department bulletin';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, int $department_id)
    {
        if ($department_id !== auth()->user()->department_id) {
            abort(403, __('authorization.user.not-belongs-to-user'));
        }

        # -------- date and month checking ---------- #

        $last_bulletine = DepartmentWorkTimeBulletin::where([
            ['department_id', '=', $department_id],
            // ['user_id', '=', auth()->id()]
        ])->latest()->first();

        $now = Carbon::now();
        $now_month = $now->month;
        $last_bulletine_date = $last_bulletine->created_at ?? $now;
        $last_bulletine_month = $last_bulletine_date->month ?? $now_month;

        if ($last_bulletine && ($last_bulletine_date->gte($now) || $last_bulletine_month == $now_month)) {
            return back()->withErrors(__('samples.department_bulletin.warning'));
        }

        # ------ data storing ------ #

        $worktime = DepartmentWorkTimeBulletin::default_worktime();

        $department_work_time_bulletin = DepartmentWorkTimeBulletin::create([
            'department_id' => $department_id
        ]);
        $users = User::where('department_id', '=', $department_id)->get();
        foreach ($users as $user) {
            $user->user_work_time_bulletins()->create([
                'department_work_time_bulletin_id' => $department_work_time_bulletin->id,
                'worktime' => json_encode($worktime)
            ]);
        }

        return redirect()->route('otherSamples.departments.work-time-bulletins.index', ['department' => $department_id])
            ->withSuccess(__("samples.saved"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $department_id,int $id)
    {
        $department_work_time_bulletin = DepartmentWorkTimeBulletin::where([
            ['id', '=', $id],
            ['department_id', '=', $department_id],
            // ['user_id', '=', auth()->id()] // բաժնեցիք թող նայեն
        ])->with('user_work_time_bulletins', 'department')->first();

        if (!$department_work_time_bulletin) {
            abort(403, __('authorization.user.not-belongs-to-user') . ' - dwt-show');
        }

        return view("otherSamples.work_time_bulletin.departments.show")->with([
            'department_bulletin' => $department_work_time_bulletin,
            // 'department' => $department
        ]);;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $department_id
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $department_id, int $id)
    {
        $department = Department::find($department_id);
        $department_work_time_bulletin = DepartmentWorkTimeBulletin::where([
            'id' => $id,
            'department_id' => $department_id,
            'user_id' => auth()->id()
        ])->with('user_work_time_bulletins')->first();

        if(!$department_work_time_bulletin || !$department || !(auth()->user()->department_id === $department_id)) {
            return back()->withErrors(__('samples.not_belongs_to_user'));
        }

        return view('otherSamples.work_time_bulletin.departments.edit')->with([
            'department_bulletin' => $department_work_time_bulletin,
            'department' => $department
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $department_id
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $department_id, int $id)
    {
        $department_work_time_bulletin = DepartmentWorkTimeBulletin::where([
            'id' => $id,
            'department_id' => $department_id,
            'user_id' => auth()->id()
        ])->first();

        if(!$department_work_time_bulletin) {
            return back()->withErrors(__('samples.not_belongs_to_user'));
        }

        $user_work_time_bulletins = $department_work_time_bulletin->user_work_time_bulletins;
        $user_work_time_bulletins->each->delete();
        $department_work_time_bulletin->delete();

        return redirect()->route('otherSamples.parentOtherSamples.index')->withSuccess(__('samples.deleted'));
    }
}
