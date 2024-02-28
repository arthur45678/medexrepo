<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Metastasis_list;
use Illuminate\Http\Request;

class MetastasisListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $lists = Metastasis_list::where('status','active')->orderBy('id','desc')->get();
        $lists = Metastasis_list::orderBy('id','desc')->get();
        return  view('admin.MetastasisList.index', compact('lists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('admin.MetastasisList.create');
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


        Metastasis_list::create($request->all());
        return redirect()->route('admin.Metastasis-lists.index')->with('msg','ok');
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
        $metastasis= Metastasis_list::findOrFail($id);
        return  view('admin.MetastasisList.edit', compact('metastasis'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Metastasis_list $Metastasis_list)
    {
        # ապաակտիվացման կոդը
        if ($request->has('deactivate')) {
            $Metastasis_list->update(['status'=>'inactive']);
            return back()->with('success', "Մետասթազ ID-{$Metastasis_list->id} հաջողությամբ ապաակտիվացվել է։");
        }

        $request->validate([
            'name' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        $Metastasis_list->update([
            'name' => $request->name,
            'status' => $request->status
        ]);
        return back()->with('success', "Մետասթազ ID-{$Metastasis_list->id} հաջողությամբ փոփոխվել է։");

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
