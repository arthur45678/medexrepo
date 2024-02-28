<?php

namespace App\Http\Controllers\Samples;

use App\Http\Controllers\Controller;
use App\Models\Approvement;
use App\Models\Patient;
use App\Models\Samples\ExpressPaterrn;
use Illuminate\Http\Request;

class ExpressPaterrnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($patient_id)
    {
        $patient=Patient::find($patient_id);

        $expres = $patient->patients_exprres()->onlyApproved()->get();
        return view("samples.express_paterrn.index",compact('patient','expres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($patient_id)
    {
        $patient=Patient::find($patient_id);
        $all_stationary_id = $patient->stationaries->pluck('number');

        return view("samples.express_paterrn.create",compact('patient','all_stationary_id'));
    }
    public function create_parent($parent_id)
    {

        $expres=ExpressPaterrn::find($parent_id);
        $patient=Patient::find($expres->patient_id);
        $all_stationary_id = $patient->stationaries->pluck('number');

        return view("samples.express_paterrn.create",compact('patient','parent_id','all_stationary_id'));
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
            'department_id' => 'required',
            'hospital_room_number' => 'required',
            'attending_doctor_id' => 'required',
            'dateTime' => 'required',
        ]);

        $data=ExpressPaterrn::create($request->all());

       return redirect()->route('samples.patients.express-pattern.index',$request->patient_id );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Samples\ExpressPaterrn  $expressPaterrn
     * @return \Illuminate\Http\Response
     */
    public function show($patent_id,$id)
    {


        $expres_parent=ExpressPaterrn::find($id);

        $patient=Patient::find($expres_parent->patient_id);
        $expres =ExpressPaterrn::where('parent_id',$id)->get();




        return view("samples.express_paterrn.show",compact('patient','expres','expres_parent'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Samples\ExpressPaterrn  $expressPaterrn
     * @return \Illuminate\Http\Response
     */
    public function edit($patent_id, $id)
    {

        $expres=ExpressPaterrn::where('patient_id',$patent_id)->where('user_id',auth()->id())->find($id);

        if ($expres==null){
            abort('404');
        }
        $patient=Patient::find($expres->patient_id);
        $all_stationary_id = $patient->stationaries->pluck('number');
        return view("samples.express_paterrn.edit",compact('expres','patient','all_stationary_id','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Samples\ExpressPaterrn  $expressPaterrn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

        $v = $this->validate($request, [
            'patient_id' => 'required',
            'department_id' => 'required',
            'hospital_room_number' => 'required',
            'attending_doctor_id' => 'required',
            'dateTime' => 'required',
        ]);

        $data=ExpressPaterrn::find($id);

        $data->update($request->all());

        return redirect()->route('samples.patients.express-pattern.index',$request->patient_id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Samples\ExpressPaterrn  $expressPaterrn
     * @return \Illuminate\Http\Response
     */
    public function destroy($patent_id,$id)
    {
        $ex = ExpressPaterrn::find($id);
$approvement=Approvement::where('approvable_type','App\Models\Samples\ExpressPaterrn')->where('approvable_id',$id)->delete();

        $ex->delete();

        return back()->with('ok','colums delete');


    }
}
