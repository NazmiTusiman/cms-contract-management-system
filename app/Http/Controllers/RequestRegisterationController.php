<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Branch;
use App\Models\UserReqRegis;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RequestRegisterationController extends Controller
{
    public function create()
    {
        $branch =  Branch::orderBy('branch_name')->get();
        $department = Division::whereNotNull('division_name')
        ->orderBy('division_name')
        ->get();

        return view('auth.registeration-request', compact('branch','department'));
    }

    public function store(Request $request)
    {
        $request->validate([
        'full_name'     => ['required', 'string', 'max:150'],
        'username'      => ['nullable', 'string', 'max:100'],
        'mykad'         => ['required', 'string', 'max:20'],
        'email'         => ['required', 'email', 'max:150'],
        'num_phone'     => ['required', 'string', 'max:20'],
        'type'          => ['required', 'in:internal,external'],
        'division_id'   => ['nullable', 'integer'],
        'branch_id'     => ['nullable', 'integer'],
        'remarks'       => ['nullable', 'string'],
        ]);

        if($request->type==='internal' && !$request->branch_id){
            return back()->withErrors(['branch_id' => 'Cawangan diperlukan untuk pengguna dalaman.'])->withInput();
        }
        UserReqRegis::create([
            'full_name'     =>$request->full_name,
            'username'      =>$request->username,
            'mykad'         =>$request->mykad,
            'email'         =>$request->email,
            'num_phone'     =>$request->num_phone,
            'type'          =>$request->type,
            'division_id'   =>$request->type ==='internal' ? $request->division_id:null,
            'branch_id'     =>$request->type ==='internal' ? $request->branch_id:null,
            'remarks'       =>$request->remarks,
        ]);

        return redirect()->route('login')->with('success', 'Permohonan pendaftaran berjaya dihantar');
    }
}
