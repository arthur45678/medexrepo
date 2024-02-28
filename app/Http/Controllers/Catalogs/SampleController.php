<?php

namespace App\Http\Controllers\Catalogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Samples\HealthSampleName;

use Illuminate\Support\Facades\Cache;

class SampleController extends Controller
{
    public function index_old()
    {
        // return all samples without filtering
        // return Cache::get('health_sample_names', []);
        // Cache::forget('health_sample_names');
        return config('samples.list');
    }

    public function index()
    {
        return HealthSampleName::getHealthSampleNames();
    }


    public function groupByTarget($target)
    {
        // Cache::forget('health_sample_names');
        return HealthSampleName::getHealthSampleNamesGroupedByTarget($target);
    }

    public function groupByTarget_old($target)
    {
        // dd($target);
        $samples = config('samples.list');
        $grouped = array_filter($samples, function ($sample) use ($target) {
            return $sample['target'] === $target &&
                $sample['relation'] !== 'stationaries' &&
                $sample['relation'] !== 'ambulator';
        });
        return array_values($grouped);
    }
}
