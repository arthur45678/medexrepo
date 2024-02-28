<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HistologicalList;
use Illuminate\Http\Request;

class HistologicalListsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $lists = HistologicalList::all();
        return  view('admin.histologicallist.index', compact('lists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $his=HistologicalList::get()->max('code');

        return  view('admin.histologicallist.create',compact('his'));
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


        HistologicalList::create($request->all());
        return redirect()->route('admin.histological-lists.index')->with('msg','ok');

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
        $codes=HistologicalList::all()->unique('code');

        $item = HistologicalList::find($id);
        return view('admin.histologicalList.edit',compact('item','codes'));
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
            HistologicalList::find($id)->update([
                'name' => $request->name,
                'code' => $request->code,
                'status' => $request->status
            ]);
        } else {
            if ($request->status == 'active') {
                HistologicalList::find($id)->update([
                    'status' => 'inactive'
                ]);
            } else {
                HistologicalList::find($id)->update([
                    'status' => 'active'
                ]);
            }

        }
        return redirect()->route('admin.histological-lists.index')->with('success','Թարմացվեց');
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
