<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

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
}
