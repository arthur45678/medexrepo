<?php

namespace App\Http\Controllers\Samples;

use App\Http\Controllers\Controller;
use App\Models\Approvement;
use App\Models\Patient;
use App\Models\Samples\MedicalCareAccounting1;
use App\Models\Samples\MedicalCareMedicineAndSource;
use App\Models\Samples\MedicalCareMedicineLabService;
use App\Models\Scholarships_list;
use App\Models\Stationary;
use Illuminate\Http\Request;

class MedicalCareAccounting1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Patient $patient)
    {
        $list=$patient->MedicalCareAccounting()->onlyApproved()->get();
        return view("samples.medical_care_accounting1.index",compact('patient','list'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Patient $patient)
    {
        $scholarships=Scholarships_list::where('status','active')->get();
        $repeatables=5;

        $stationaries=Stationary::where('patient_id',$patient->id)->orderBy('id','desc')->first();
        if(!$stationaries)
            abort(403,$patient->full_name . __("stationary.does_not_have_card") );
        return view("samples.medical_care_accounting1.create",compact('patient','scholarships','repeatables','stationaries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'patient_id' => 'required',
//            'department_id' => 'required',
            'tickets_N' => 'required',
            'responsible_nurse' =>'required|numeric|exists:users,id',
            'case_status' => 'required',
            'clinic_id' => 'required',
            'referral_N' => 'required',
            'ReportNumberN' => 'required',
            'service_id' => 'required',
            'moved_department_id' => 'required',
        ]);

        $medicalCareAccounting=MedicalCareAccounting1::create($request->all());
        $medicalCareAccounting->approvement()->create([
            "status" => 0, //Pending
            "department_id" => auth()->user()->department_id
        ]);

        foreach($request->care_medicine_id as $k=>$medicine){
            if ($medicine!=null):
                MedicalCareMedicineAndSource::create([
                    'parent_id'=>$medicalCareAccounting->id,
                    'medicine_id'=>$medicine,
                    'medicine_comments'=>$request->care_text[$k],
                    'medicine_count'=>$request->medicine_dose[$k],
                    'source_id'=>$request->source_id[$k],
                ]);
            endif;
        }
        foreach($request->labService_id as $lab=>$labService){
            if ($labService!=null):
                MedicalCareMedicineLabService::create([
                    'parent_id'=>$medicalCareAccounting->id,
                    'lab_service_id'=>$labService,
                    'lab_comments'=>$request->lab_comments[$lab],
                    'lab_count'=>$request->lab_count[$lab],

                ]);
            endif;
        }
        return response()->json([

            'success' => __('samples.created'),
            'redirect' => route('samples.patients.medical-care-accounting1.index', $request->patient_id),
            'delay' => 2000
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Samples\MedicalCareAccounting1  $medicalCareAccounting1
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient,$id)
    {
        $medicalCareAccounting=MedicalCareAccounting1::where('patient_id',$patient->id)
          ->where('id',$id)->first();
        $stationaries=Stationary::find($medicalCareAccounting->stationary_id);

        $medicineData=MedicalCareMedicineAndSource::where('parent_id',$id)->get();
        $scholarships=Scholarships_list::where('status','active')->get();
        $labService=MedicalCareMedicineLabService::where('parent_id',$id)->get();
        return view("samples.medical_care_accounting1.show",compact('patient',
            'scholarships','medicalCareAccounting','medicineData','labService','stationaries'));



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Samples\MedicalCareAccounting1  $medicalCareAccounting1
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient,$id)
    {
        $medicalCareAccounting=MedicalCareAccounting1::where('patient_id',$patient->id)
            ->where('user_id',auth()->id())->where('id',$id)->first();
        if ($medicalCareAccounting==null){
            abort('404');
        }

        $medicineData=MedicalCareMedicineAndSource::where('parent_id',$id)->get();
        $labService=MedicalCareMedicineLabService::where('parent_id',$id)->get();
        $scholarships=Scholarships_list::where('status','active')->get();
        $repeatables=5;
        return view("samples.medical_care_accounting1.edit",compact(
            'patient','scholarships','repeatables','medicalCareAccounting',
            'medicineData','labService'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Samples\MedicalCareAccounting1  $medicalCareAccounting1
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient,$id)
    {
        $medicalCareAccounting=MedicalCareAccounting1::find($id);
        $medicalCareAccounting->update($request->all());
        $approvement = $medicalCareAccounting->approvement()->firstOrNew([
            "approvable_id" => $medicalCareAccounting->id,
            "approvable_type" => get_class($medicalCareAccounting)
        ]);

        $approvement->fill([
            "status" => 0,
            "department_id" => auth()->user()->department_id,
        ])->save();

        foreach($request->care_medicine_id as $k=>$medicine){
            if ($medicine!=null):
                MedicalCareMedicineAndSource::create([
                    'parent_id'=>$id,
                    'medicine_id'=>$medicine,
                    'medicine_comments'=>$request->care_text[$k],
                    'medicine_count'=>$request->medicine_dose[$k],
                    'source_id'=>$request->source_id[$k],

                ]);
            endif;
        }
        foreach($request->labService_id as $lab=>$labService){
            if ($labService!=null):
                MedicalCareMedicineLabService::create([
                    'parent_id'=>$id,
                    'lab_service_id'=>$labService,
                    'lab_comments'=>$request->lab_comments[$lab],
                    'lab_count'=>$request->lab_count[$lab],

                ]);
            endif;
        }


        return response()->json([

            'success' => __('samples.created'),
            'redirect' => route('samples.patients.medical-care-accounting1.index', $patient->id),
            'delay' => 2000
        ], 201);
    }
    public function trash($id)
    {
        MedicalCareMedicineAndSource::find($id)->delete();
        return $id;
    }
    public function labtrash($id)
    {

        MedicalCareMedicineLabService::find($id)->delete();
        return $id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Samples\MedicalCareAccounting1  $medicalCareAccounting1
     * @return \Illuminate\Http\Response
     */
    public function  destroy(Patient $patient,$id)
    {
        $list = MedicalCareAccounting1::where('patient_id',$patient->id)->where('user_id',auth()->id())->find($id);


        if ($list==null){
            abort('404');
        }
        MedicalCareMedicineAndSource::where('parent_id',$id)->delete();
        MedicalCareMedicineLabService::where('parent_id',$id)->delete();

        $list->delete();
        $approvement=Approvement::where('approvable_type','App\Models\Samples\MedicalCareAccounting1')->where('approvable_id',$id)->delete();

        return back()->with('ok','colums delete');

    }
}
