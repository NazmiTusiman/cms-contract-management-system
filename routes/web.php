<?php

use App\Http\Controllers\ContractController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\RequestRegisterationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/registeration-request',[RequestRegisterationController::class, 'create'])
->name('registertaion.request');

Route::post('/registeration-request',[RequestRegisterationController::class, 'store'])
->name('registeration-request');

Route::get('/dashboard', [DashboardController::class, 'index']) 
->middleware(['auth'])
->name('dashboard');

Route::get('/contracts', fn()=>view('contracts.index'))
->middleware(['auth'])
->name('contracts.index');

Route::get('/superadmin', fn () => view('dashboard.superadmin'))
    ->middleware(['auth', 'role:superadmin'])
    ->name('superadmin.dashboard');

Route::get('/admin', fn () => view('dashboard.admin'))
    ->middleware(['auth', 'role:admin'])
    ->name('admin.dashboard');

Route::get('/user', function () {
    return view('dashboard.user', [
        'jumlahKontrak' => 0,
        'nilaiKontrak' => 0,
        'tamatTempoh' => 0,
    ]);
})->middleware(['auth', 'role:user'])->name('user.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/contracts',[ContractController::class, 'index'])->name('contracts.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin,superadmin'])->group(function() {
    Route::get('/contracts/create', [ContractController::class, 'create'])->name('contracts.create');
    Route::post('/contracts', [ContractController::class, 'store'])->name('contracts.store');

    Route::post('/payments/store', [PaymentController::class, 'store'])->name('payment.store');
   // Route::get('/contract/{id}/edit', [ContractController::class,'edit']->name('contracts.edit'));
   // Route::post('/contract/{id}/update', [ContractController::class, 'update']->name('contracts.update'));
});

Route::middleware(['auth', 'role:superadmin'])->group(function() {
    Route::get('/users', function(){
        return view('users.index');
    })->name('users.index');

    Route::get('/setup/branch-department',[SettingController::class, 'index'])->name('setup.branch-department');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    Route::post('/department', [SettingController::class, 'storeDepartment'])->name('department.store');
    Route::post('/branch', [SettingController::class, 'storeBranch'])->name('branch.store');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');    
    Route::post('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('user.toggle-status');

    Route::delete('department/{id}', [SettingController::class, 'destroyDepartment'])->name('department.destroy');
    Route::delete('/branch/{id}', [SettingController::class, 'destroyBranch'])->name('branch.destroy');
    Route::delete('/contract/{id}', [ContractController::class, 'destroy'])->name('contracts.destroy');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

});





require __DIR__.'/auth.php';
