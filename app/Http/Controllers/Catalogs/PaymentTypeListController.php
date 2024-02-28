<?php

namespace App\Http\Controllers\Catalogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\PaymentTypeList;

class PaymentTypeListController extends Controller
{
    public function payment_types_json(Request $request, PaymentTypeList $paymentTypeList)
    {
        return response()->json($paymentTypeList->search($request->q ?? ""));
    }

    public function payment_types_hy_json(Request $request, PaymentTypeList $paymentTypeList)
    {
        $payment_types = [];
        foreach ($paymentTypeList->get() as $key => $value) {
            $payment_types[$key]['value'] = $value['name'];
            $payment_types[$key]['label'] = __("enums.service_payment_type_enum.{$value['name']}");
        }

        return $payment_types;
    }

}
