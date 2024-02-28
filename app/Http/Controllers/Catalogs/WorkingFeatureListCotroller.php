<?php

namespace App\Http\Controllers\Catalogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WorkingFeatureList;

class WorkingFeatureListCotroller extends Controller
{
    public function working_feature_list_json(Request $request, WorkingFeatureList $working_feature_list)
    {
        return response()->json($working_feature_list->search($request->q ?? ""));
    }
}
