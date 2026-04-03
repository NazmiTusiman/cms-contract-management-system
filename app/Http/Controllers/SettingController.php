<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function index ()
    {
        $departments = DB::table('tbl_division')->orderBy('division_name')->get();

        $branch = DB::table('tbl_branch')->orderBy('branch_name')->get();

        return view('settings.branch-department', compact('departments','branches'));
    }

    public function storeDepartment(Request $request)
    {
        $request->validate([
            'division_code' => ['nullable','string','max:150'],
            'division_name' => ['nullable','string','max:150'],
            'branch_name' => ['nullable','string','max:150'],
        ]);

        DB::table('tbl_division')->insert([
            'division_code' =>$request->division_code,
            'division_name' =>$request->division_name,
            'branch_name' =>$request->branch_name,
        ]);

        return back()->with('success', 'Bahagian berjaya ditambah');
    }

    public function storeBranch(Request $request)
    {
        $request->validate([
            'branch_code_assets' => ['nullable', 'string', 'max:150'],
            'branch_code' => ['required', 'integer'],
            'branch_name' => ['required', 'string', 'max:150'],
            'branch_addr' => ['required', 'string', 'max:150'],
            'branch_postcode' => ['required', 'integer'],
            'branch_city' => ['required', 'string', 'max:150'],
            'branch_state' => ['required', 'string', 'max:150'],
            'branch_country' => ['required', 'string', 'max:150'],
        ]);

        DB::table('tbl_branch')->insert([
            'branch_code_assets' => $request->branch_code_assets,
            'branch_code' => $request->branch_code,
            'branch_name' => $request->branch_name,
            'branch_addr' => $request->branch_addr,
            'branch_postcode' => $request->branch_postcode,
            'branch_city' => $request->branch_city,
            'branch_state' => $request->branch_state,
            'branch_country' => $request->branch_country,
        ]);

        return back()->with('Success','Cawangan berjaya ditambah');
    }

    public function destroyDepartment($id)
    {
        DB::table('tbl_division')
        ->where('division_id'.$id)
        ->delete();

        return back()->with('success','Bahagian ini berjaya dipadam');
    }

    public function destroyBranch($id)
    {
        DB::table('tbl_branch')
        ->where('branch_id'.$id)
        ->delete();

        return back()->with('success','Cawangan ini berjaya dipadam');
    }
}
