<?php

namespace App\Http\Controllers\otherSamples;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\OtherSamples\UserWorkTimeBulletin;

class UserWorkTimeBulletinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(int $user_id)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_id)
    {
        $month_days = $request->month_days;
        $summary = reduceHoursMinutesSummary($month_days);

        $month_idle_days = $request->month_idle_days;
        $idle_summary = reduceHoursMinutesSummary($month_idle_days);

        $user_work_time_bulletin = UserWorkTimeBulletin::find($request->id);
        $worktime = json_encode([
            'month_days' => $month_days,
            'summary' => $summary,
            'month_idle_days' => $month_idle_days,
            'idle_summary' => $idle_summary
        ]);
        $user_work_time_bulletin->update(['worktime' => $worktime]);
        if($request->ajax()) {
            return response()->json(['success' => __('samples.saved')], 200);
        }
        return back()->withSuccess(__('samples.saved'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
