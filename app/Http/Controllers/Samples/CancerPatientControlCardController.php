<?php

namespace App\Http\Controllers\Samples;

use App\Http\Controllers\Controller;
use App\Models\ApplicationPurposeList;
use App\Models\CurrentStageList;
use App\Models\ExitList;
use App\Models\HistologicalList;
use App\Models\Metastasis_list;
use App\Models\ResearchesList;
use Illuminate\Http\Request;

class CancerPatientControlCardController extends Controller
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
        $repeatables = 5;
        $histologicalLists = HistologicalList::where('status', 'active')->get();
        $researchesLists = ResearchesList::where('status', 'active')->get();
        $exitLists = ExitList::where('status', 'active')->get();
        $currentStageLists = CurrentStageList::where('status', 'active')->get();
        $applicationPurposeList = ApplicationPurposeList::where('status', 'active')->get();
        $metastasisList = Metastasis_list::where('status', 'active')->get();
        return view("samples.cancer_patient_control_card.create", compact(
            'repeatables',
            'histologicalLists',
            'researchesLists',
            'exitLists',
            'currentStageLists',
            'applicationPurposeList',
            'metastasisList'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response()->json(['data' => 'mata']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function destroy($id)
    {
        //
    }
}
