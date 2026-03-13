<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\ContracyPayment;

class PaymentController extends Controller
{
    public function store(Request $request)
    {
        ContractPayment::create([
            'contract_id'       =>$request->contract_id,
            'payment_id'        =>$request->payment_id,
            'payment_amount'    =>$request->payment_amount,
            'remakrs'           =>$request->remarks,
            'created_by'        =>$request->auth()->id()
        ]);

        return back()->with('success','Bayaran berjaya direkodkan');
    }
}
