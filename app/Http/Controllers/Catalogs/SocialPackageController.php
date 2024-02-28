<?php

namespace App\Http\Controllers\Catalogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SocialPackage;

class SocialPackageController extends Controller
{
    public function social_packages_json(Request $request, SocialPackage $social_package)
    {
        return response()->json($social_package->search($request->q ?? ""));
    }
}
