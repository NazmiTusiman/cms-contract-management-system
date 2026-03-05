<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
    {
        public function index(Request $request)
        {
            $user = $request->user();

            $jumlahKontrak = 0;
            $nilaiKontrak = 0;
            $tamatTempoh = 0;

            if((int) $user->role_id == 3){
                return view('dashboard.user', compact('jumlahKontrak','nilaiKontrak','tamatTempoh'));
            }

            //keep existing redirects for other roles
            return match((int)$user->role_id){
                1=>redirect()->route('superadmin.dashboard'),
                2=>redirect()->route('admin.dashboard'),
                default =>redirect()->route('user.dashboard'),
            };
        }
    }

?>
