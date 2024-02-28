<?php

namespace App\Http\Controllers\Samples;

use App\Http\Controllers\Controller;
use App\Models\Ambulator;
use App\Models\Approvement;
use App\Models\Patient;
use App\Models\Samples\Extract;
use App\Models\Samples\ExtractDiagnosisAndSurgical;
use App\Models\Samples\ExtractTreatmentList;
use App\Models\Stationary;
use Illuminate\Http\Request;

class ExtractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $patient = Patient::find($id);
        $list = $patient->Extract()->onlyApproved()->get();
        return view("samples.extract.index", compact('patient', 'list'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Patient $patient)
    {
        $repeatables = 5;
        $ambulator = Ambulator::where('patient_id', $patient->id)->orderBy('id', 'desc')->first();
        if(!$ambulator)
            abort(403,$patient->full_name . __("stationary.does_not_have_card"));
        $stationaries = Stationary::where('patient_id', $patient->id)->orderBy('id', 'desc')->first();
        if(!$stationaries)
            abort(403,$patient->full_name . __("stationary.does_not_have_card") );


        return view("samples.extract.create", compact('stationaries', 'repeatables', 'patient', 'ambulator'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Patient $patient)
    {
        $request->validate([
            'date' => 'required|date|before:tomorrow',
            'attending_doctor' => 'required|numeric|exists:users,id',
        ]);


        $extract = Extract::create($request->all());
        $id = $extract->id;
        $extract->approvement()->create([
            "status" => 0, //Pending
            "department_id" => auth()->user()->department_id
        ]);
        if ($request->period_time1_data != null):
            foreach ($request->period_time1_data as $period_time1) {
                if ($period_time1 != null) {
                    ExtractDiagnosisAndSurgical::create([
                        "type" => 'diagnosis',
                        "data" => $period_time1,
                        'parent_id' => $id,
                    ]);
                }
            }
        endif;
        if ($request->period_time2_data != null):
            foreach ($request->period_time2_data as $k => $period_time2) {
                if ($period_time2 != null) {
                    ExtractDiagnosisAndSurgical::create([
                        "type" => 'surgicals',
                        "data" => $period_time2,
                        'parent_id' => $id,
                        'comments' => $request->period_time2_data_comment[$k]
                    ]);
                }
            }
        endif;
        if ($request->treatment_c != null):
            foreach ($request->treatment_c as $c => $treatment_c) {
                if ($treatment_c != null) {
                    ExtractTreatmentList::create([
                        'parent_id' => $id,
                        "treatment_id" => $treatment_c,
                        "treatment_comments" => $request->treatment_comment_c[$c],
                        "type" => 'radial',
                    ]);
                }
            }
        endif;
        if ($request->treatment_c2 != null):
            foreach ($request->treatment_c2 as $c2 => $treatment_c2) {
                if ($treatment_c2 != null) {
                    ExtractTreatmentList::create([
                        'parent_id' => $id,
                        "treatment_id" => $treatment_c2,
                        "treatment_comments" => $request->treatment_comment_c2[$c2],
                        "type" => 'complex',
                    ]);
                }
            }
        endif;
        if ($request->treatment_c3 != null):
            foreach ($request->treatment_c3 as $c3 => $treatment_c3) {
                if ($treatment_c3 != null) {
                    ExtractTreatmentList::create([
                        'parent_id' => $id,
                        "treatment_id" => $treatment_c3,
                        "treatment_comments" => $request->treatment_comment_c3[$c3],
                        "type" => 'other',
                    ]);
                }
            }
        endif;

        return response()->json([

            'success' => __('samples.created'),
            'redirect' => route('samples.patients.extract.index', $patient),
            'delay' => 2000
        ], 201);
    }


    /**
     * Display the specified resource.
     *
     * @param \App\Models\Samples\Extract $extract
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient, Extract $extract)
    {
        $ambulator = Ambulator::find($extract->stationary_id);
        $stationaries = Stationary::find($extract->ambulator_id);
        $treatment_c = ExtractTreatmentList::where('parent_id', $extract->id)->where('type', 'radial')->get();
        $treatment_c2 = ExtractTreatmentList::where('parent_id', $extract->id)->where('type', 'complex')->get();
        $treatment_c3 = ExtractTreatmentList::where('parent_id', $extract->id)->where('type', 'other')->get();
        $period = ExtractDiagnosisAndSurgical::where('parent_id', $extract->id)->where('type', 'diagnosis')->get();
        $period2 = ExtractDiagnosisAndSurgical::where('parent_id', $extract->id)->where('type', 'surgicals')->get();

        return view("samples.extract.show", compact('stationaries', 'ambulator'
            , 'patient', 'extract', 'treatment_c', 'treatment_c2', 'treatment_c3', 'period', 'period2'));

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Samples\Extract $extract
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient, Extract $extract)
    {

        $repeatables = 5;
        $ambulator = Ambulator::find($extract->stationary_id);
        $stationaries = Stationary::find($extract->ambulator_id);
        $treatment_c = ExtractTreatmentList::where('parent_id', $extract->id)->where('type', 'radial')->get();
        $treatment_c2 = ExtractTreatmentList::where('parent_id', $extract->id)->where('type', 'complex')->get();
        $treatment_c3 = ExtractTreatmentList::where('parent_id', $extract->id)->where('type', 'other')->get();
        $period = ExtractDiagnosisAndSurgical::where('parent_id', $extract->id)->where('type', 'diagnosis')->get();
        $period2 = ExtractDiagnosisAndSurgical::where('parent_id', $extract->id)->where('type', 'surgicals')->get();

        return view("samples.extract.edit", compact('stationaries', 'ambulator'
            , 'patient', 'repeatables', 'extract', 'treatment_c', 'treatment_c2', 'treatment_c3', 'period', 'period2'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Samples\Extract $extract
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient, $id)
    {
        $extract = Extract::find($id);
        $extract->update($request->all());

        if ($request->period_time1_data != null):
            foreach ($request->period_time1_data as $period_time1) {
                if ($period_time1 != null) {
                    ExtractDiagnosisAndSurgical::create([
                        "type" => 'diagnosis',
                        "data" => $period_time1,
                        'parent_id' => $id,
                    ]);
                }
            }
        endif;
        if ($request->period_time2_data != null):
            foreach ($request->period_time2_data as $k => $period_time2) {
                if ($period_time2 != null) {
                    ExtractDiagnosisAndSurgical::create([
                        "type" => 'surgicals',
                        "data" => $period_time2,
                        'parent_id' => $id,
                        'comments' => $request->period_time2_data_comment[$k]
                    ]);
                }
            }
        endif;
        if ($request->treatment_c != null):
            foreach ($request->treatment_c as $c => $treatment_c) {
                if ($treatment_c != null) {
                    ExtractTreatmentList::create([
                        'parent_id' => $id,
                        "treatment_id" => $treatment_c,
                        "treatment_comments" => $request->treatment_comment_c[$c],
                        "type" => 'radial',
                    ]);
                }
            }
        endif;
        if ($request->treatment_c2 != null):
            foreach ($request->treatment_c2 as $c2 => $treatment_c2) {
                if ($treatment_c2 != null) {
                    ExtractTreatmentList::create([
                        'parent_id' => $id,
                        "treatment_id" => $treatment_c2,
                        "treatment_comments" => $request->treatment_comment_c2[$c2],
                        "type" => 'complex',
                    ]);
                }
            }
        endif;
        if ($request->treatment_c3 != null):
            foreach ($request->treatment_c3 as $c3 => $treatment_c3) {
                if ($treatment_c3 != null) {
                    ExtractTreatmentList::create([
                        'parent_id' => $id,
                        "treatment_id" => $treatment_c3,
                        "treatment_comments" => $request->treatment_comment_c3[$c3],
                        "type" => 'other',
                    ]);
                }
            }
        endif;
        $approvement = $extract->approvement()->firstOrNew([
            "approvable_id" => $id,
            "approvable_type" => get_class($extract)
        ]);

        $approvement->fill([
            "status" => 0,
            "department_id" => auth()->user()->department_id,
        ])->save();

        return response()->json([

            'success' => __('samples.created'),
            'redirect' => route('samples.patients.extract.index', $patient),
            'delay' => 2000
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Samples\Extract $extract
     * @return \Illuminate\Http\Response
     */
    public function periodTrash($data)
    {
        ExtractDiagnosisAndSurgical::find($data)->delete();
        return $data;
    }

    public function period2Trash($data)
    {
        ExtractDiagnosisAndSurgical::find($data)->delete();
        return $data;
    }

    public function treatmentTrash($data)
    {
        ExtractTreatmentList::find($data)->delete();
        return $data;
    }

    public function destroy(Patient $patient, $id)
    {
        $ex = Extract::where('patient_id', $patient->id)
            ->where('user_id', auth()->id())->where('id', $id)->first();
        if ($ex == null) {
            abort('404');
        }
        ExtractDiagnosisAndSurgical::where('parent_id', $id)->delete();
        ExtractTreatmentList::where('parent_id', $id)->delete();
        $ex->delete();
        $approvement = Approvement::where('approvable_type', 'App\Models\Samples\Extract')->where('approvable_id', $id)->delete();
        return back();
    }
}
