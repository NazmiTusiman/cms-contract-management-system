<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\ContractPayment;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function store(Request $request)
    {
        ContractPayment::create([
            'contract_id'       =>$request->contract_id,
            'payment_id'        =>$request->payment_id,
            'payment_amount'    =>$request->payment_amount,
            'remarks'           =>$request->remarks,
            'created_by'        => Auth::id()
        ]);

        return back()->with('success','Bayaran berjaya direkodkan');
    }
}
