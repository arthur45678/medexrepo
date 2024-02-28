<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Models\Cashbox;
use App\Models\Order;
use App\Models\OrderDepartment;
use App\Models\OrderOutput;
use App\Models\OrderTreatment;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class OrderOutputForCahhboxFourthController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cashbox = Cashbox::where(['slug' => 'cashboxFour'])->first();
        $patients = Patient::all();
        $doctors = User::all();
        $orders = $cashbox->orderInput()->paginate(20);
        return view('cashbox.cashboxFour.index',compact('patients','doctors','orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'price' => 'required',
            'sum_text' => 'required',
            'document_type' => 'required',
            'passport_data' => 'required',
            'patient_id' => 'required',
        ]);

//        $data = $request->all();
        $cashbox = Cashbox::where(['slug' => 'cashboxFour'])->first();
        OrderOutput::storeOrder($request,$cashbox);

        return redirect()->route('cashbox.cashboxFour.orderinput.index')->with('success', 'Հաջողությամբ ավելացվել է');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = OrderOutput::findOrFail($id);
        return view('cashbox.cashboxFour.orderoutput.show',compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = OrderOutput::findOrFail($id);
        return view('cashbox.cashboxFour.orderoutput.edit',compact('order'));

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
        $input = $request->except('_token');
        $item = OrderOutput::findOrFail($id);
        $item->update($input);
        return redirect()->route('cashbox.cashboxFour.orderinput.index')->with('updated', 'Հաջողությամբ փոփոխվել է');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        OrderOutput::find($id)->delete();
        return redirect()->route('cashbox.cashboxFour.orderinput.index')->with('deleted', 'Հաջողությամբ ջնջվել է');

    }
}
