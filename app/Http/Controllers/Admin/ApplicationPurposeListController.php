<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApplicationPurposeList;
use Illuminate\Http\Request;

class ApplicationPurposeListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $lists = ApplicationPurposeList::where('status','active')->orderBy('id','desc')->get();
        $lists = ApplicationPurposeList::orderBy('id', 'desc')->get();
        return  view('admin.ApplicationPurposeList.index', compact('lists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('admin.ApplicationPurposeList.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v = $this->validate($request, [
            'name' => 'required',
        ]);
        ApplicationPurposeList::create($request->all());
        return redirect()->route('admin.ApplicationPurpose-lists.index')
        ->with('success', 'Մահճակալը հաջողությաբմ ստեղծվել է։');
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
        $applicationPurpose = ApplicationPurposeList::findOrFail($id);
        return view('admin.ApplicationPurposeList.edit', compact('applicationPurpose'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ApplicationPurposeList $ApplicationPurpose_list)
    {
        # ապաակտիվացման կոդը
        if ($request->has('deactivate')) {
            $ApplicationPurpose_list->update(['status' => 'inactive']);
            return back()->with('success', "Դիմումի տեսակ ID-{$ApplicationPurpose_list->id} հաջողությամբ ապաակտիվացվել է։");
        }

        $request->validate([
            'name' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        $ApplicationPurpose_list->update([
            'name' => $request->name,
            'status' => $request->status
        ]);
        return back()->with('success', "Դիմումի տեսակ ID-{$ApplicationPurpose_list->id} հաջողությամբ փոփոխվել է։");
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
