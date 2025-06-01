<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AccountsApiController;
use App\Http\Controllers\API\TransactionsApiController;
use App\Http\Controllers\API\BranchesApiController;
use App\Http\Controllers\API\CustomerApiController;
use App\Http\Controllers\API\EmployeesApiController;
use App\Http\Controllers\API\LoansApiController;
use App\Http\Controllers\API\LoginController;

Route::post("/login",[LoginController::class,"login"]);



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::middleware('auth:sanctum') -> group(function(){
    Route::get("/accounts",[AccountsApiController::class, "index"]);
    Route::post("accounts/insert",[AccountsApiController::class, "store"]);
    Route::get("accounts/{id}", [AccountsApiController::class, "show"]);
    Route::delete("accounts/{id}", [AccountsApiController::class, "destroy"]);
    Route::patch("accounts/{id}", [AccountsApiController::class, "update"]);
    
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get("/branches", [BranchesApiController::class, "index"]);
    Route::post("/branches/insert", [BranchesApiController::class, "store"]);
    Route::get("/branches/{id}", [BranchesApiController::class, "show"]);
    Route::patch("/branches/{id}", [BranchesApiController::class, "update"]);
    Route::delete("/branches/{id}", [BranchesApiController::class, "destroy"]);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get("/customers", [CustomerApiController::class, "index"]);
    Route::post("/customers/insert", [CustomerApiController::class, "store"]);
    Route::get("/customers/{id}", [CustomerApiController::class, "show"]);
    Route::patch("/customers/{id}", [CustomerApiController::class, "update"]);
    Route::delete("/customers/{id}", [CustomerApiController::class, "destroy"]);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get("/employees", [EmployeesApiController::class, "index"]);
    Route::post("/employees/insert", [EmployeesApiController::class, "store"]);
    Route::get("/employees/{id}", [EmployeesApiController::class, "show"]);
    Route::patch("/employees/{id}", [EmployeesApiController::class, "update"]);
    Route::delete("/employees/{id}", [EmployeesApiController::class, "destroy"]);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get("/loans", [LoansApiController::class, "index"]);
    Route::post("/loans/insert", [LoansApiController::class, "store"]);
    Route::get("/loans/{id}", [LoansApiController::class, "show"]);
    Route::patch("/loans/{id}", [LoansApiController::class, "update"]);
    Route::delete("/loans/{id}", [LoansApiController::class, "destroy"]);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get("/transactions", [TransactionsApiController::class, "index"]);
    Route::post("/transactions/insert", [TransactionsApiController::class, "store"]);
    Route::get("/transactions/{id}", [TransactionsApiController::class, "show"]);
    Route::patch("/transactions/{id}", [TransactionsApiController::class, "update"]);
    Route::delete("/transactions/{id}", [TransactionsApiController::class, "destroy"]);
});