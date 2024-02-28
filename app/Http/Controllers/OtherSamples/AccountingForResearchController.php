<?php


namespace App\Http\Controllers\OtherSamples;

use App\Http\Controllers\Controller;
use App\Models\OtherSamples\AccountingForResearch;
use Illuminate\Http\Request;

class AccountingForResearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounting = AccountingForResearch::get();

        return view("otherSamples.accounting_for_research.index", compact('accounting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("otherSamples.accounting_for_research.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'attending_doctor_id' => 'required',
        ]);

        $accounting = AccountingForResearch::create($request->all());
//        $procurement->approvement()->create([
//            "status" => 0, //Pending
//            "department_id" => auth()->user()->department_id
//        ]);

        return response()->json([

            'success' => __('samples.created'),
            'redirect' => route('otherSamples.accounting-for-research.index'),
            'delay' => 2000
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OtherSamples\AccountingForResearch  $accountingForResearch
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $accounting = AccountingForResearch::get();
        return view("otherSamples.accounting_for_research.show", compact('accounting','id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OtherSamples\AccountingForResearch  $accountingForResearch
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $accounting = AccountingForResearch::where('user_id', auth()->id())->where('id', $id)->first();
        if ($accounting == null) {
            abort('404');
        }
        return view("otherSamples.accounting_for_research.edit", compact('accounting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OtherSamples\AccountingForResearch  $accountingForResearch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $accountingForResearch)
    {
        
        $request->validate([
            'date' => 'required',
            'attending_doctor_id' => 'required',
            
        ]);
        $accounting = AccountingForResearch::find($accountingForResearch)->
        update($request->all());


        return response()->json([

            'success' => __('samples.created'),
            'redirect' => route('otherSamples.accounting-for-research.index'),
            'delay' => 2000
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OtherSamples\AccountingForResearch  $accountingForResearch
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $accounting = AccountingForResearch::where('user_id', auth()->id())
        ->where('id', $id)->first();

        if ($accounting == null) {
            abort('404');
        }
        $accounting->delete();
        return back();
        }
}
