<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentTypeList;
use Illuminate\Http\Request;

class PaymentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = PaymentTypeList::all();
        return  view('admin.paymentstype.index', compact('lists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('admin.paymentstype.create');
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
            PaymentTypeList::create(['name' => $request->name]);
            return redirect()->route('admin.payment_card.index')->with('msg', 'ok');
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
        $post = PaymentTypeList::find($id);
        return view('admin.paymentstype.edit',compact('post'));
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
            PaymentTypeList::find($id)->update([
                'name' => $request->name,
                'status' => $request->status
            ]);
        } else {
            if ($request->status == 'active') {
                PaymentTypeList::find($id)->update([
                    'status' => 'inactive'
                ]);
            } else {
                PaymentTypeList::find($id)->update([
                    'status' => 'active'
                ]);
            }

        }
        return redirect()->route('admin.payment_card.index')->with('success','Թարմացվեց');
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
