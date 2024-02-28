<?php

namespace App\Http\Controllers\Catalogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LivingPlaceList;

class LivingPlaceListCotroller extends Controller
{
    public function living_place_list_json(Request $request, LivingPlaceList $living_place_list)
    {
        return response()->json($living_place_list->search($request->q ?? ""));
    }
}
