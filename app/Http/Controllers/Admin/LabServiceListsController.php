<?php

namespace App\Http\Controllers\Admin;

use App\Models\LabServiceList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LabServiceListsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = LabServiceList::all();
        return  view('admin.lab-service-lists.index', compact('lists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('admin.lab-service-lists.create');
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
        LabServiceList::create($request->all());
        return redirect()->route('admin.lab-service-lists.index')->with('msg','ok');
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
        $item = LabServiceList::find($id);
        return view('admin.lab-service-lists.edit',compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->name != '') {
            LabServiceList::find($id)->update([
                'name' => $request->name,
                'status' => $request->status
            ]);
        } else {
            if ($request->status == 'active') {
                LabServiceList::find($id)->update([
                    'status' => 'inactive'
                ]);
            } else {
                LabServiceList::find($id)->update([
                    'status' => 'active'
                ]);
            }

        }
        return redirect()->route('admin.lab-service-lists.index')->with('success','Թարմացվեց');
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
