<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashBoardController extends Controller
{
 public function getAccountsCount()
 {
  $data = DB::table('accounts')->count();

  return response()->json(['count' => $data]);
 }
 public function getCustomersCount()
 {
  $data = DB::table('customer')->count();

  return response()->json(['count' => $data]);
 }

 public function getTransactionsCount()
 {
  $data = DB::table('transactions')->count();

  return response()->json(['count' => $data]);

 }
}
