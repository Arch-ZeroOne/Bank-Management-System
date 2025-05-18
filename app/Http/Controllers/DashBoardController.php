<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashBoardController extends Controller
{
 public function getUsersCount()
 {
  $accounts    = DB::table('accounts')->count();
  $customer    = DB::table('customer')->count();
  $transaction = DB::table('transactions')->count();

  return response()->json(['accounts' => $accounts, 'customer' => $customer, "transaction" => $transaction]);
 }

 public function getTypeCount()
 {
  $basicCount    = DB::table('accounts')->where('account_type', 'Basic')->count();
  $savingsCount  = DB::table('accounts')->where('account_type', 'Checking')->count();
  $checkingCount = DB::table('accounts')->where('account_type', 'Savings')->count();

  return response()->json(["basicCount" => $basicCount,
   "savingsCount" => $savingsCount, 'checkingCount' => $checkingCount]);

 }

 public function getStatusCount()
 {
  $activeCount   = DB::table('accounts')->where('status', '1')->count();
  $inactiveCount = DB::table('accounts')->where('status', '0')->count();

  return response()->json([
   'active' => $activeCount, 'inactive' => $inactiveCount,
  ]);

 }
}
