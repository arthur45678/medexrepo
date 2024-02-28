<?php

namespace App\Http\Controllers;

use App\Models\Approvement;
use App\Models\Attendance;
use App\Models\Complaint;
use App\Models\Diagnosis;
use App\Models\FemaleIssue;
use App\Models\HealthStatus;
use App\Models\OnsetAndDevelopment;
use App\Models\Patient;
use App\Models\Tnm;
use App\Models\TumorInfo;
use Illuminate\Http\Request;

class AmbulatorsHasManySectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient, $ambulator)
    {

//        $diagnoses = $ambulator->diagnoses()->onlyApproved()->get();
        $approvementdiagnoses = $patient->ambulator()->findOrFail($ambulator);
        $approvementdiagnoses->loadAllRelationsForApprovement();

        return view("ambulators.relations",compact( 'patient',  'approvementdiagnoses'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function trash($data,$id)
    {
        if($data=='diagnoses'){
            $diagnosis = Diagnosis::where([
                ['id', '=', $id],
                ['user_id', '=', auth()->id()],
            ])->first();
            if (!$diagnosis) {
                return back();
            }
            $diagnosis->delete();
            Approvement::where('approvable_id',$id)->delete();

        }elseif ($data=='attendances'){
            $attendance = Attendance::where([
                ['id', '=', $id],
                ['user_id', '=', auth()->id()],
            ])->first();
            if (!$attendance) {
                return back();
            }
            $attendance->delete();
            Approvement::where('approvable_id',$id)->delete();
        }elseif ($data=='complaints'){
            $complaint = Complaint::where([
                ['id', '=', $id],
                ['user_id', '=', auth()->id()],
            ])->first();
            if (!$complaint) {
                return back();
            }
            $complaint->delete();
            Approvement::where('approvable_id',$id)->delete();
        }elseif ($data=='female_issues'){
           $femaleIssue= FemaleIssue::where([
                ['id', '=', $id],
                ['user_id', '=', auth()->id()],
            ])->first();
            if (!$femaleIssue) {
                return back();
            }
            $femaleIssue->delete();
            Approvement::where('approvable_id',$id)->delete();
        }elseif ($data=='tumor_infos'){
           $tumor_infos= TumorInfo::where([
                ['id', '=', $id],
                ['user_id', '=', auth()->id()],
            ])->first();
            if (!$tumor_infos) {
                return back();
            }
            $tumor_infos->delete();
            Approvement::where('approvable_id',$id)->delete();
        }elseif ($data=='onset_and_developments'){
           $tumor_infos= TumorInfo::where([
                ['id', '=', $id],
                ['user_id', '=', auth()->id()],
            ])->first();
            if (!$tumor_infos) {
                return back();
            }
            $tumor_infos->delete();
            Approvement::where('approvable_id',$id)->delete();
        }elseif ($data=='onset_and_developments'){
           $onset_and_developments= OnsetAndDevelopment::where([
                ['id', '=', $id],
                ['user_id', '=', auth()->id()],
            ])->first();
            if (!$onset_and_developments) {
                return back();
            }
            $onset_and_developments->delete();
            Approvement::where('approvable_id',$id)->delete();
        }elseif ($data=='health_statuses'){
           $health_statuses= HealthStatus::where([
                ['id', '=', $id],
                ['user_id', '=', auth()->id()],
            ])->first();
            if (!$health_statuses) {
                return back();
            }
            $health_statuses->delete();
            Approvement::where('approvable_id',$id)->delete();
        }elseif ($data=='tnms'){
            $tnms= Tnm::where([
                ['id', '=', $id],
                ['user_id', '=', auth()->id()],
            ])->first();
            if (!$tnms) {
                return back();
            }
            $tnms->delete();
            Approvement::where('approvable_id',$id)->delete();
        }
     return back();
    }
}
