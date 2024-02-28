<?php

namespace App\Http\Controllers\Catalogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SocialLivingConditionList;

class SocialLivingConditionListCotroller extends Controller
{
    public function social_living_condition_list_json(
        Request $request,
        SocialLivingConditionList $social_living_condition_list
    ) {
        return response()->json($social_living_condition_list->search($request->q ?? ""));
    }
}
