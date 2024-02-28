<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SurgeryList;
use Illuminate\Http\Request;

class SurgeryListsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists= SurgeryList::all();
        return  view('admin.surgerylist.index', compact('lists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return  view('admin.surgerylist.create');
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

        ]);

        SurgeryList::create($request->all());
        return redirect()->route('admin.surgery-list.index')->with('msg','ok');





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
        $item = SurgeryList::find($id);
        return view('admin.surgerylist.edit',compact('item'));
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
        if ($request->name != '') {
            SurgeryList::find($id)->update([
                'name' => $request->name,
                'code' => $request->code,
                'status' => $request->status
            ]);
        } else {
            if ($request->status == 'active') {
                SurgeryList::find($id)->update([
                    'status' => 'inactive'
                ]);
            } else {
                SurgeryList::find($id)->update([
                    'status' => 'active'
                ]);
            }
        }
        return redirect()->route('admin.surgery-list.index')->with('success','Թարմացվեց');
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
