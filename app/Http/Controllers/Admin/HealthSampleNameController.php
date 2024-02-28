<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Samples\HealthSampleName;
use Illuminate\Http\Request;
use DataTables;

class HealthSampleNameController extends Controller
{
    protected $route_root = 'admin.health-sample-lists';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = HealthSampleName::where('relation', '<>', null)->get(); //orderBy('id', 'desc')->get();
        return view('admin.health-sample-lists.index', compact('lists'));
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
     * @param  \App\Models\Samples\HealthSampleName  $healthSampleName
     * @return \Illuminate\Http\Response
     */
    public function show(HealthSampleName $healthSampleName)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Samples\HealthSampleName  $healthSampleName
     * @return \Illuminate\Http\Response
     */
    public function edit(HealthSampleName $health_sample_list)
    {

        // return view('admin.health-sample-lists.edit', ['item' => $health_sample_list]);
        return view('admin.health-sample-lists.edit', compact('health_sample_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Samples\HealthSampleName  $healthSampleName
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HealthSampleName $health_sample_list)
    {
        # ապաակտիվացման կոդը
        // if ($request->has('deactivate')) {
        //     $Metastasis_list->update(['status'=>'inactive']);
        //     return back()->with('success', "Մետասթազ ID-{$Metastasis_list->id} հաջողությամբ ապաակտիվացվել է։");
        // }

        $request->validate([
            'name' => 'required|string',
            // 'status' => 'required|in:active,inactive',
        ]);

        $health_sample_list->update([
            'name' => $request->name,
            // 'status' => $request->status
        ]);
        return back()->with('success', "Բուժական ձևանմուշ ID-{$health_sample_list->id} հաջողությամբ փոփոխվել է։");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Samples\HealthSampleName  $healthSampleName
     * @return \Illuminate\Http\Response
     */
    public function destroy(HealthSampleName $healthSampleName)
    {
        //
    }
}
