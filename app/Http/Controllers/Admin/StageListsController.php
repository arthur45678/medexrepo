<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnesthesiaList;
use App\Models\StageList;
use App\Models\SurgeryList;
use Illuminate\Http\Request;

class StageListsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = StageList::all();
        return  view('admin.StageList.index', compact('lists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('admin.StageList.create');
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
            'group' => 'required',
        ]);


            StageList::create($request->all());
            return redirect()->route('admin.stage-list.index')->with('msg','ok');

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
        $item = StageList::find($id);
        return view('admin.stagelist.edit',compact('item'));
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
            StageList::find($id)->update([
                'name' => $request->name,
                'group' => $request->group,
                'status' => $request->status
            ]);
        } else {
            if ($request->status == 'active') {
                StageList::find($id)->update([
                    'status' => 'inactive'
                ]);
            } else {
                StageList::find($id)->update([
                    'status' => 'active'
                ]);
            }

        }
        return redirect()->route('admin.stage-list.index')->with('success','Թարմացվեց');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
