<?php

namespace App\Http\Controllers\Samples;

use App\Http\Controllers\Controller;
use App\Models\Approvement;
use App\Models\Patient;
use App\Models\Samples\PlanningDiagnosisModel;
use App\Models\Samples\PlanningProtocol;
use Illuminate\Http\Request;

class PlanningProtocolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {


        $patient = Patient::find($id);
        $planning = $patient->PlanningProtocols()->onlyApproved()->get();
        return view("samples.planning_protocol.index", compact('planning', 'patient'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($patent_id)
    {
        $repeatables = 5;
        $patent = Patient::find($patent_id);
        return view("samples.planning_protocol.create", compact('repeatables', 'patent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v = $this->validate($request, [
            'patient_id' => 'required',
            'parent_date' => 'required',
        ]);
        $planning = PlanningProtocol::create($request->all());

        if ($request->disease_id) {
            foreach ($request['disease_id'] as $m => $disease_id) {
                if ($disease_id != null):
                    $prescraption = PlanningDiagnosisModel::create([

                        'planning_id' => $planning->id,
                        'disease_id' => $disease_id,
                        'diagnosis_comment' => $request['diagnosis_comment'][$m],

                    ]);

                endif;
            }


        }
        return redirect()->route('samples.patients.planning-protocol.show', [$request->patient_id, $planning->id]);


    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Samples\PlanningProtocol $planningProtocol
     * @return \Illuminate\Http\Response
     */
    public function show($patent_id, $id)
    {


        $planing = PlanningProtocol::where('patient_id', $patent_id)->find($id);

        $planingdiagnostic = PlanningDiagnosisModel::where('planning_id', $id)->get();
        $patent = Patient::find($patent_id);
        return view("samples.planning_protocol.show", compact('patent', 'planing', 'planingdiagnostic'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Samples\PlanningProtocol $planningProtocol
     * @return \Illuminate\Http\Response
     */
    public function edit($patent_id, $id)
    {
        $planing = PlanningProtocol::where('patient_id', $patent_id)->where('user_id', auth()->id())->find($id);
        if ($planing == null) {
            abort('404');
        }
        $planingdiagnostic = PlanningDiagnosisModel::where('planning_id', $id)->get();
        $repeatables = 5;
        $patent = Patient::find($patent_id);
        return view("samples.planning_protocol.edit", compact('repeatables', 'patent', 'planing', 'planingdiagnostic'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Samples\PlanningProtocol $planningProtocol
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $patient_id)
    {
        $v = $this->validate($request, [
            'parent_date' => 'required',
        ]);
        $planning = PlanningProtocol::find($id);
        $planning->update($request->all());


        if ($request->disease_id) {
            foreach ($request['disease_id'] as $m => $disease_id) {
                if ($disease_id != null):
                    $prescraption = PlanningDiagnosisModel::create([

                        'planning_id' => $planning->id,
                        'disease_id' => $disease_id,
                        'diagnosis_comment' => $request['diagnosis_comment'][$m],

                    ]);

                endif;
            }


        }

        return redirect()->route('samples.patients.planning-protocol.show', [$patient_id, $id]);


    }

    public function trash($data)
    {
        $planingdiagnostic = PlanningDiagnosisModel::find($data)->delete();
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Samples\PlanningProtocol $planningProtocol
     * @return \Illuminate\Http\Response
     */
    public function destroy($patent_id, $id)
    {
        $pers = PlanningProtocol::where('patient_id', $patent_id)->where('user_id', auth()->id())->find($id);
        $approvement = Approvement::where('approvable_type','App\Models\Samples\PlanningProtocol')->where('approvable_id', $id)->delete();

        $med = PlanningDiagnosisModel::where('planning_id', $id)->get();

        if (count($med) > 0) {

            $med = PlanningDiagnosisModel::where('planning_id', $id)->delete();
        }
        $pers->delete();
        return back()->with('ok', 'colums delete');


    }
}
