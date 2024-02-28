<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Calendar\CalendarModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function finddate(Request $request) {
        $today = Carbon::parse($request->date)->format('Y-m-d').'%';
        $list=CalendarModel::with('patient')->where('start', 'like', $today)->where('user_id',$request->user_id)
            ->where('status','active')->orderBy('id','desc')->get();

        return response()->json(['request' => $list], 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE);

    }
}
