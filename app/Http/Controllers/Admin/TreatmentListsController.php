<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\TreatmentList;
use Illuminate\Http\Request;

class TreatmentListsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $lists = TreatmentList::where('status','active')->get();
        $lists = TreatmentList::get();
        return  view('admin.TreatmentLists.index', compact('lists'));
    }

    /**
     * Show the form for creating a new resource.
     *TreatmentLists
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('admin.TreatmentLists.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->name != '') {
            TreatmentList::create($request->all());
            return redirect()->route('admin.treatment-list.index')
            ->with('success', 'Բուժման տեսակը հաջողությաբմ ստեղծվել է։');
        } else {
            return back()->with('warning','Բուժման տեսակը պետք է ունենա անվանում։');
        }
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
        $treatment = TreatmentList::find($id);
        return view('admin.TreatmentLists.edit', compact('treatment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,TreatmentList $treatment_list)
    {
        # ապաակտիվացման կոդը
        if ($request->has('deactivate')) {
            $treatment_list->update([ 'status' => 'inactive' ]);
            return back()->with('success', "ID - {$treatment_list->id}-ով Բուժման տեսակը հաջողությամբ ապաակտիվացվել է։");
        }

        $request->validate([
            'name' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        $treatment_list->update([
            'name' => $request->name,
            'status' => $request->status
        ]);
        return back()->with('success', "ID - {$treatment_list->id}-ով Բուժման տեսակը հաջողությամբ փոփոխվել է։");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd($id);
    }
}
