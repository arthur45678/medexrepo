<?php

namespace App\Http\Controllers\Admin;

use App\Enums\TumorTreatmentEnum;
use App\Http\Controllers\Controller;
use App\Models\TumorTreatmentList;
use Illuminate\Http\Request;

class TumorTreatmenListsController extends Controller
{
    public function index()
    {

        $lists = TumorTreatmentList::all();
        return  view('admin.Treatment-tumor.index', compact('lists'));
    }

    /**
     * Show the form for creating a new resource.
     *TreatmentLists
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('admin.Treatment-tumor.create');
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
            'type' => 'required',
        ]);
        if($request->type=='special_treatment'){
            TumorTreatmentList::create([
                'name'=>$request->name,
                'type'=>TumorTreatmentEnum::special_treatment(),
            ]);
        }elseif($request->type=='palliative'){
            TumorTreatmentList::create([
                'name'=>$request->name,
                'type'=>TumorTreatmentEnum::palliative(),
            ]);
        }elseif($request->type=='symptomatic'){
            TumorTreatmentList::create([
                'name'=>$request->name,
                'type'=>TumorTreatmentEnum::symptomatic(),
            ]);
        }
        return redirect()->route('admin.tumor-treatment-list.index')->with('msg','ok');
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
        $item = TumorTreatmentList::find($id);
        return view('admin.Treatment-tumor.edit',compact('item'));
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
            TumorTreatmentList::find($id)->update([
                'name' => $request->name,
                'status' => $request->status,
                'code' => $request->code
            ]);
        } else {
            if ($request->status == 'active') {
                TumorTreatmentList::find($id)->update([
                    'status' => 'inactive'
                ]);
            } else {
                TumorTreatmentList::find($id)->update([
                    'status' => 'active'
                ]);
            }
        }
        return redirect()->route('admin.tumor-treatment-list.index')->with('success','Թարմացվեց');
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
