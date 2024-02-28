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
use Illuminate\Support\Facades\DB;

use Validator;


class OrderInputForCahhboxFourthController extends Controller
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
        $ordersInput = $cashbox->orderInput()->paginate(20);
        $orderOutput = $cashbox->orderOutput()->paginate(20);
        $correspondentaccount = DB::table('correspondentaccount')->get();

        return view('cashbox.cashboxFour.index',compact('patients','doctors','ordersInput','orderOutput','correspondentaccount'));
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
            'user_id' => 'required|numeric',
            'patient_id' => 'required|numeric',
            'price' => 'required|numeric',
            'sum_text' => 'required|string',
        ]);

        $cashbox = Cashbox::where(['slug' => 'cashboxFour'])->first();
        Order::storeOrderInput($request,$cashbox);
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
        $order = Order::findOrFail($id);
        return view('cashbox.cashboxFour.orderinput.show',compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('cashbox.cashboxFour.orderinput.edit',compact('order'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient, $id)
    {
        $input = $request->except('_token');
        $item = Order::findOrFail($id);
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
        Order::find($id)->delete();
        return redirect()->route('cashbox.cashboxFour.orderinput.index')->with('deleted', 'Հաջողությամբ ջնջվել է');

    }
}
