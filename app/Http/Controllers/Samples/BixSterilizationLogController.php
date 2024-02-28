<?php

namespace App\Http\Controllers\Samples;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Samples\BixSterilizationLog;
use Illuminate\Http\Request;

class BixSterilizationLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Patient $patient)
    {

        $posts = $patient->bix_sterilisation_log()->get();
        $posts = BixSterilizationLog::where('patient_id',$patient->id)->get();
        return view("samples.bix_sterilization_log.index", compact('patient','posts'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Patient $patient)
    {
        return view("samples.bix_sterilization_log.create", compact('patient'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Patient $patient)
    {

        $request->validate([
            'bix_sterilisation_date' => 'nullable|date|before:tomorrow',
            'bix_send_date' => 'nullable|date|before:tomorrow',
            'bix_surgery_date' => 'nullable|date|before:tomorrow',
        ]);

        $patient->bix_sterilisation_log()->create($request->all());

        return response()->json(['success'=>'Բիքսի մանրէազերծման գրանցամատյան ավելացվեց']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Samples\BixSterilizationLog  $bixSterilizationLog
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient, $id)
    {
        $post =  $patient->bix_sterilisation_log()->findOrFail($id);
        return view("samples.bix_sterilization_log.show", compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Samples\BixSterilizationLog  $bixSterilizationLog
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient, $bix_id)
    {
        $bix = $patient->bix_sterilisation_log()->findOrFail($bix_id);
        $this->authorize("belongs-to-user", $bix);

        return view("samples.bix_sterilization_log.edit")->with(compact('patient', 'bix'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Samples\BixSterilizationLog  $bixSterilizationLog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient, $bix_id)
    {
        $bix = $patient->bix_sterilisation_log()->findOrFail($bix_id);

        $this->authorize("belongs-to-user", $bix);

        $res = $bix->update($request->all());


        return response()->json(['success' => __('samples.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Samples\BixSterilizationLog  $bixSterilizationLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(BixSterilizationLog $bixSterilizationLog)
    {
        //
    }
}
