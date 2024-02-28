<?php

namespace App\Http\Controllers\Catalogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EducationList;

class EducationListCotroller extends Controller
{
    public function education_list_json(Request $request, EducationList $education_list)
    {
        return response()->json($education_list->search($request->q ?? ""));
    }
}
