<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnesthesiaList;
use Illuminate\Http\Request;

class AnesthesiaListsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = AnesthesiaList::all();
        return  view('admin.anesthesialist.index', compact('lists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('admin.anesthesialist.create');
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
            AnesthesiaList::create(['name' => $request->name]);
            return redirect()->route('admin.anesthesia-list.index')->with('msg', 'ok');
        } else {
            $msg = "error";
            return back()->with('error', 'error');
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
        $post = AnesthesiaList::find($id);
        return view('admin.anesthesialist.edit',compact('post'));
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
            AnesthesiaList::find($id)->update([
                'name' => $request->name,
                'status' => $request->status
            ]);
        } else {
            if ($request->status == 'active') {
                AnesthesiaList::find($id)->update([
                    'status' => 'inactive'
                ]);
            } else {
                AnesthesiaList::find($id)->update([
                    'status' => 'active'
                ]);
            }

        }
        return redirect()->route('admin.anesthesia-list.index')->with('success','Թարմացվեց');
    }
        /*AnesthesiaList::find($id)->update([
            'status' => 'inactive'
        ]);
        return back();
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
