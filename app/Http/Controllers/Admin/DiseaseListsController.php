<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DiseaseList;
use Illuminate\Http\Request;

class DiseaseListsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dinisase= DiseaseList::all();
        return  view('admin.dinisase.index', compact('dinisase'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dinisase= DiseaseList::where('status','active')->orderBy('id','desc')->first();
        return  view('admin.dinisase.create',compact('dinisase'));
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
            'code' => 'required',
            'chapter' => 'required',

        ]);

            DiseaseList::create($request->all());
            return redirect()->route('admin.dinisase-list.index')->with('msg','ok');





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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Responseicdհիվ
     */
    public function update(Request $request, $id)
    {
        DiseaseList::find($id)->update([
            'status'=>'inactive'
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
