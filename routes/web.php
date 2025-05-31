<?php

use App\Http\Controllers\AccountsController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\LoanRequestController;
use App\Http\Controllers\LoansController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\BranchesController;
use App\Http\Controllers\EmployeesController;
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
    Route::patch("/delete", 'destroy')->name("destroy");
    Route::patch("/update", "update")->name("update");
    Route::get("/{id}", "getInfo")->name("getInfo");

    });

    Route::controller(DashBoardController::class)->name("dashboard")->prefix("dashboard")->group(function () {
    Route::get("/accounts", 'getUsersCount');
    Route::get("/getCount", 'getTypeCount');
    Route::get('/getStatus', 'getStatusCount');
    Route::get("/types",'getDataByType');
    });

    //Table Routes

    Route::get("table/list", [TableController::class, 'list'])->name('table.list');
    Route::get("/dashboard", function () {
    return view("users.dashboard");
    })->name('dashboard');

    //View for users

    Route::controller(LoanRequestController::class)->name('loanrequests')->prefix('loanrequests')->group(function () {
    Route::get('/', 'index');
    Route::get("/getAll", 'list')->name(".list");
    Route::get("/{id}", 'userInfo') -> name(".info");
    Route::post("/insert", 'insert') -> name('insert');
    Route::patch("/update", 'updateStatus')->name(".update");
    Route::patch("/edit",'updateDetails') -> name(".edit");
    Route::get("/{id}",'getInfo') -> name('getInfo');
    });

    Route::controller(LoansController::class)->name('loans')->prefix('loans')->group(function () {
    Route::get('/', 'index');
    Route::get("/list", 'list')->name('.list');
    Route::patch("/update", 'update')->name(".update");
    Route::get('/{id}','userInfo') -> name(".info");
    });

    
    
    Route::controller(EmployeesController::class) -> name('employees') -> prefix('employees') -> group(function(){
      Route::get("/",'index');
      Route::get('/list','list') -> name('list');
    });


require __DIR__ . '/auth.php';
