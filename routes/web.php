<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\LoanRequestController;
use App\Http\Controllers\LoansController;
use App\Http\Controllers\TransactionsController;


Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(AccountsController::class) -> name("user") -> prefix("user") -> group(function(){
    Route::get('/','index'); 
    Route::delete("/{id}",'destroy') -> name(".destroy");
    Route::patch("/{id}", "update") -> name(".update");
  });


  //*Needs to be transfered
Route::post('/users/store',[AccountsController::class,'store']) -> name('users.store');




//View for users
Route::get('/loanrequests',[LoanRequestController::class,'index']) -> name('loanrequests');
Route::get('/loans',[LoansController::class,'index']) -> name('loans');
Route::get('/transactions',[TransactionsController::class,'index']) -> name('transactions');

require __DIR__.'/auth.php';
