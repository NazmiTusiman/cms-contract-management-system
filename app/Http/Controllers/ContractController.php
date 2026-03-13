<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContractController extends Controller
{
    public function index(){
        $user = Auth::user();
        $contracts = Contract::latest('created_at')->get();

        return view('contracts.index', compact('contracts'));
    }

    public function create(){
        return view('contract.create');
    }

    public function store(Request $request){
        $request->validate([
            'contract_name'     =>['required', 'string','max:150'],
            'contract_value'    =>['required', 'numeric','min:0'],
            'start_date'        =>['required', 'date'],
            'end_date'          =>['required', 'date','after_or_equal:start_date'],
            'bond_value'        =>['nullable', 'numeric','min:0'],
            'attachemnt'        =>['nullable', 'file','mimes:pdf,doc,docx,xls,xlsx,png,jpg,jpeg', 'max:10240']
        ]);

        
    $user = Auth::user();

    $attachmentPath = null;

    if($request->hasFile('attachment')){
        $attachmentPath = $request->file('attachment')->store('contracts', 'public');
    }
    
    Contract::create([
        'contract_name'     => $request->contract_name,
        'contract_value'    => $request->contract_value,
        'start_date'        => $request->start_date,
        'end_date'          => $request->end_date,
        'bond_value'        => $request->bond_value,
        'attachment'        => $request->attachment,

        'division_id'       => $user->division_id,
        'branch_id'         => $user->branch_id,
        'created_by'        => $user->id,

        'created_at'        => now(),
        'updated_at'         => now(),
    ]);

    return redirect()->route('contracts.index')->with('success','Kontrak berjaya ditambah');
    }

    /*public function edit($id){
        $contracts = Contract::findOrFail($id);

        return view('contracts.edit', compact('contact'));
    }*/

}