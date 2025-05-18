<?php

use App\Http\Controllers\AccountsController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\LoanRequestController;
use App\Http\Controllers\LoansController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\TransactionsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
 return view('auth.login');
});

Route::middleware('auth')->group(function () {
 Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
 Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
 Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(AccountsController::class)->name("user")->prefix("user")->group(function () {
 Route::view('/', 'users.allusers');
 Route::post('/store', 'store')->name('.store');
 Route::delete("/{id}", 'destroy')->name(".destroy");
 Route::patch("/{id}", "update")->name(".update");
 Route::get("/{id}", "getInfo")->name(".getInfo");

});

Route::controller(DashBoardController::class)->name("dashboard")->prefix("dashboard")->group(function () {
 Route::get("/accounts", 'getUsersCount');

 Route::get("/getCount", 'getTypeCount');
 Route::get('/getStatus', 'getStatusCount');
});

//Table Routes

Route::get("table/list", [TableController::class, 'list'])->name('table.list');
Route::get("/dashboard", function () {
 return view("users.dashboard");
})->name('dashboard');

//View for users
Route::get('/loanrequests', [LoanRequestController::class, 'index'])->name('loanrequests');
Route::get('/loans', [LoansController::class, 'index'])->name('loans');
Route::get('/transactions', [TransactionsController::class, 'index'])->name('transactions');

require __DIR__ . '/auth.php';
