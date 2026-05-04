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
            'payment_name'      =>$request->payment_name,
            'payment_amount'    =>$request->payment_amount,
            'payment_due'       =>$request->payment_due,
            'remarks'           =>$request->remarks,
            'created_by'        => Auth::id()
        ]);

        return back()->with('success','Bayaran berjaya direkodkan');
    }

    public function update(Request $request, $id)
    {
        $payment = ContractPayment::findOrFail($id);

        if($request->hasFile('invoice'))
            {
                $path = $request->file('invoice')->store('invoices', 'public');
                $payment->invoice= $path ;
            }
        
        $payment->payment_date = $request->payment_date;
        $payment->save();

        return back()->with('success','Payment updated');
    }
}
