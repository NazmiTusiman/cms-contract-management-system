<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query()
        ->orderBy('role_id')
        ->orderBy('full_name')
        ->get();

        return view('users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => ['required', 'string', 'max:150'],
            'mykad'     => ['required', 'string', 'max:12', 'unique:tbl_users,mykad'],
            'email'     => ['nullable', 'email'],
            'role_id'   => ['required', 'integer'],
        ]);

        User::create([
            'full_name' => $request->full_name,
            'mykad'     => $request->mykad,
            'email'     => $request->email,
            'role_id'   => $request->role_id,
            'status'    =>'active',
            'password'  => Hash::make('Password123'),
        ]);

        return redirect()->route('users.index')->with('success', 'Pengguna Berjaya Didaftarkan');
    }
}
