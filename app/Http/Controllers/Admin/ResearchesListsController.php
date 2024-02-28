<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ResearchesList;
use Illuminate\Http\Request;

class ResearchesListsController extends Controller
{/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */
    public function index()
    {
        $lists =  ResearchesList::all();
        return  view('admin.ResearchesList.index', compact('lists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $his=ResearchesList::get()->max('code');

        return  view('admin.ResearchesList.create',compact('his'));
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


        ResearchesList::create($request->all());
        return redirect()->route('admin.researches-lists.index')->with('msg','ok');

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
        $item = ResearchesList::find($id)->first();
        return view('admin.ResearchesList.edit',compact('item'));
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
                ResearchesList::find($id)->update([
                    'name' => $request->name,
                    'status' => $request->status,
                ]);
            } else {
                if ($request->status == 'active') {
                    ResearchesList::find($id)->update([
                        'status' => 'inactive'
                    ]);
                }else {
                    ResearchesList::find($id)->update([
                        'status' => 'active'
                    ]);
                }

            }
        return redirect()->route('admin.researches-lists.index')->with('success','Թարմացվեց');
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
