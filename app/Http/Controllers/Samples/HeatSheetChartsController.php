<?php

namespace App\Http\Controllers\Samples;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Samples\HeatSheet;
use App\Models\Samples\HeatSheetCharts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HeatSheetChartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Patient $patient)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(HeatSheet $heatSheet)
    {

        return view('samples.heat_sheet.createChart')
            ->with([
                'heatSheet' => $heatSheet,
            ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $heatSheet_id)
    {
       // $heatSheet = HeatSheet::findOrFail($heatSheet_id);
        $heatSheetCharts = new HeatSheetCharts();
        $heatSheetCharts->storeChart($request, $heatSheet_id);
        return response()->json(['success' => __('samples.created')]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(HeatSheet $heatSheet, $chart_id)
    {
        dd($heatSheet);
        //dd($chart_id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(HeatSheet $heatSheet, $id)
    {
        $chart = HeatSheetCharts::findOrFail($id);
        return view('samples.heat_sheet.editChart')->with([
            'chart' => $chart,
            'heatSheet' => $heatSheet
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HeatSheet $heatSheet, $chart_id)
    {
        $chart = HeatSheetCharts::findOrFail($chart_id);
        $chart->updateChart($request,$chart_id);
        return redirect()->back()->with(['success' => __('samples.updated')]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(HeatSheet $heatSheet, $post_id)
    {
        $post = HeatSheetCharts::findOrFail($post_id);
        if($post->user_id == Auth::user()->id){
            $post->delete();
            return redirect()->back()->with(['success' => __('samples.deleted')]);
        }
    }
}
