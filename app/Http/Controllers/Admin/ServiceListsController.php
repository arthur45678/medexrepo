<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceList;
use Illuminate\Http\Request;

class ServiceListsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = ServiceList::all();
        return  view('admin.servicelists.index', compact('lists'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('admin.servicelists.create');
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
            'price' => 'required',
        ]);
        ServiceList::create($request->all());
        return redirect()->route('admin.service-list.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = ServiceList::find($id)->first();
        return view('admin.servicelists.edit',compact('item'));
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
            ServiceList::find($id)->update([
                'name' => $request->name,
                'status' => $request->status,
                'price' => $request->price,
            ]);
        } else {
            if ($request->status == 'active') {
                ServiceList::find($id)->update([
                    'status' => 'inactive'
                ]);
            } else {
                ServiceList::find($id)->update([
                    'status' => 'active'
                ]);
            }

        }
        return redirect()->route('admin.service-list.index')->with('success','Թարմացվեց');
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
