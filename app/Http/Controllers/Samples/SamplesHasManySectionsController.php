<?php

namespace App\Http\Controllers\Samples;

use App\Http\Controllers\Controller;
use App\Models\Samples\SampleDiagnose;
use App\Models\StationaryDiagnosis;
use Illuminate\Http\Request;

class SamplesHasManySectionsController extends Controller
{

    public function delete_diagnoses(Request $request)
    {
        $request->validate([
            "id" => "required|numeric|exists:sample_diagnoses,id",
            "row_name" => "required|string",
            "hideFormId" => "required|string"
        ]);

        $diagnosis = SampleDiagnose::where([
            ['id','=', $request->id], // + 9999999 for testing
            ['user_id', '=', auth()->id()]
        ])->first();

        if(!$diagnosis) {
            return response()->json([
                'warning'=>'Ուղեգրի "'. $request->row_name . '" կոմպոնենտը չի կարող լինել ջնջված։',
                'insertFormId' => $request->hideFormId
            ]);
            // return back()->with(['warning'=>'Ստացիոնար քարտի "'. $request->row_name . '" կոմպոնենտը չի կարող լինել ջնջված։']);
        }
        return response()->json([
            'success' => 'Ուղեգրի "'.$request->row_name . '" կոմպոնենտը հաջողությամբ ջնջված է։',
            'hideFormId' => $request->hideFormId,
            'delay' => 1500
        ]);
        // return back()->withSuccess('Ստացիոնար քարտի "'.$request->row_name . '" կոմպոնենտը հաջողությամբ ջնջված է։');
    }

    public function diagnoses(Request $request)
    {
        $request->validate([
            "id" => "nullable|numeric|exists:sample_diagnoses,id",
            "diagnosis_comment" => "nullable|string|max:10000",
            "diagnosis_date" => "nullable|date|before:tomorrow",
            "disease_id" => "nullable|numeric|exists:disease_lists,id",
        ]);

        $diagnosis = SampleDiagnose::findOrFail($request->id);
        $this->authorize("belongs-to-user", $diagnosis);

        $diagnosis->fill($request->all())->save();

        return response()->json(["success" => __("samples.changed")]);
    }



}
