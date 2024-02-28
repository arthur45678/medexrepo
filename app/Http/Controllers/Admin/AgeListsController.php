<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AgeList;
use Illuminate\Http\Request;

class AgeListsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = AgeList::all();
        return  view('admin.age-lists.index', compact('lists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('admin.age-lists.create');
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
            'age_from' => 'required',
            'age_to' => 'required',
            'age_code' => 'required',
        ]);

        AgeList::create($request->all());
        return redirect()->route('admin.age-lists.index')->with('msg','ok');
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
        $item = AgeList::find($id);
        return view('admin.age-lists.edit',compact('item'));
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

        if ($request->age_from != '') {
            AgeList::find($id)->update([
                'age_from' => $request->age_from,
                'age_to' => $request->age_to,
                'age_code' => $request->age_code,
                'status' => $request->status,
            ]);
        }else{
            AgeList::find($id)->update([
                'status' => 'inactive'
            ]);
        }

        return redirect()->route('admin.age-lists.index')->with('success','Թարմացվեց');
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
