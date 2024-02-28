<?php

namespace App\Http\Controllers\Catalogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MaritalStatusList;

class MaritalStatusListCotroller extends Controller
{
    public function marital_status_list_json(Request $request, MaritalStatusList $marital_status_list)
    {
        return response()->json($marital_status_list->search($request->q ?? ""));
    }
}
