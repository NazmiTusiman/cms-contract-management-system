<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Branch;
use App\Models\UserReqRegis;
use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RequestRegistrationController extends Controller
{
    public function create()
    {
        $branches =  Branch::orderBy('branch_name')->get();
        $departments = Division::whereNotNull('division_name')
        ->orderBy('division_name')
        ->get();

        return view('auth.registration-request', compact('branches','departments'));
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
            'request_status'=>'Pending',
            'division_id'   =>$request->type ==='internal' ? $request->division_id:null,
            'branch_id'     =>$request->type ==='internal' ? $request->branch_id:null,
            'remarks'       =>$request->remarks,
        ]);

        return redirect()->route('login')->with('status', 'Permohonan pendaftaran berjaya dihantar');
    }

    public function index(){
        $requests = UserReqRegis::where('request_status', 'Pending')->orderBy('timestamps','desc')->get();

        return view('auth.registration-request-list', compact('requests'));
    }

    public function approve(Request $request, $id)
    {
        $request->validate(['role_id' => ['required','integer']]);

        $registration = UserReqRegis::findOrFail($id);

        User::create([
            'username'      =>$registration->username ?? $registration->mykad,
            'full_name'     =>$registration->full_name,
            'mykad'         =>$registration->mykad,
            'email'         =>$registration->email,
            'phone'         =>$registration->num_phone,
            'branch_id'     =>$registration->branch_id,
            'division_id'   =>$registration->division_id,
            'role_id'       =>$request->role_id,
            'status'        =>'active',
            'password'      => Hash::make('Abcd1234'),
        ]);

        $registration->update(['request_status' => 'Approved',]);

        return back()->with('Success','Permohonan Berjaya Diluluskan');
    }

    public function reject( $id)
    {
        $registration = UserReqRegis::findOrFail($id);
 
        $registration->update(['request_status' => 'Rejected']);

        return back()->with('success', 'Permohonan ditolak');
    }

}
