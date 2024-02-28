<?php

namespace App\Http\Controllers\Samples;

use App\Http\Controllers\Controller;
use App\Models\Approvement;
use App\Models\Patient;
use App\Models\Samples\LampOperationMode;
use Illuminate\Http\Request;

class LampOperationModeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

        $patient=Patient::find($id);
        $lamp = $patient->LampOperationMode()->onlyApproved()->get();
        return view("samples.lamp_operation_mode.index", compact('lamp','patient'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($patient_id)
    {

        return view("samples.lamp_operation_mode.create",compact('patient_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $v = $this->validate($request, [
            'patient_id' => 'required',
            'responsible_nurse' => 'required',
            'date' => 'required',
            'title' => 'required',
            'regime' => 'required',
        ]);


        $immunologi = LampOperationMode::create($request->all());


        return redirect()->route('samples.patients.lamp-operation-mode.show', [$request->patient_id ,0]) ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Samples\LampOperationMode  $lampOperationMode
     * @return \Illuminate\Http\Response
     */
    public function show($id, $nullid)
    {

        $lamp=LampOperationMode::where('patient_id',$id)->get();

        if (count($lamp)==0){
            abort('404');
        }
        return view("samples.lamp_operation_mode.show",compact('lamp'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Samples\LampOperationMode  $lampOperationMode
     * @return \Illuminate\Http\Response
     */
    public function edit($patent_id,$id)
    {

        $lamp=LampOperationMode::where('patient_id',$patent_id)->where('user_id',auth()->id())->find($id);

        if ($lamp==null){
            abort('404');
        }

        return view("samples.lamp_operation_mode.edit",compact('lamp'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Samples\LampOperationMode  $lampOperationMode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $patient_id)
    {

        $v = $this->validate($request, [
            'responsible_nurse' => 'required',
            'date' => 'required',
            'title' => 'required',
            'regime' => 'required',
        ]);


        $immunologi = LampOperationMode::find($id)->update($request->all());


        return redirect()->route('samples.patients.lamp-operation-mode.show', [$patient_id ,0]) ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Samples\LampOperationMode  $lampOperationMode
     * @return \Illuminate\Http\Response
     */
    public function destroy($patent_id,$id)
    {
        $lamp= LampOperationMode::where('patient_id',$patent_id)->where('user_id',auth()->id())->find($id);
        $approvement=Approvement::where('approvable_type','App\Models\Samples\LampOperationMode')->where('approvable_id',$id)->delete();

        if ($lamp==null){
            abort('404');
        }

        $lamp->delete();
        return back()->with('ok','colums delete');


    }
}
