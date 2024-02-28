<?php

namespace App\Http\Controllers\Samples;

use App\Models\Patient;
use App\Models\Samples\SampleDiagnose;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SamplesController extends Controller
{
    public function deleteSamplesDiagnosis($diagnoses_id)
    {
        $post = SampleDiagnose::find($diagnoses_id)->delete();
        return $diagnoses_id;
    }
}
