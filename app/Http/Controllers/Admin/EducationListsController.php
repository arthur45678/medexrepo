<?php

namespace App\Http\Controllers\Admin;

use App\Models\EducationList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EducationListsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = EducationList::all();
        return  view('admin.education-lists.index', compact('lists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('admin.education-lists.create');
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
        EducationList::create($request->all());
        return redirect()->route('admin.education-lists.index')->with('msg','ok');
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
        $item = EducationList::find($id);
        return view('admin.education-lists.edit',compact('item'));
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
            EducationList::find($id)->update([
                'name' => $request->name,
                'status' => $request->status
            ]);
        } else {
            if ($request->status == 'active') {
                EducationList::find($id)->update([
                    'status' => 'inactive'
                ]);
            } else {
                EducationList::find($id)->update([
                    'status' => 'active'
                ]);
            }

        }
        return redirect()->route('admin.education-lists.index')->with('success','Թարմացվեց');
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
