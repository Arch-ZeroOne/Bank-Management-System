<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class TransactionsController extends Controller
{
 public function index()
 {

  return view('users.transactions');

 }

 public function list()
 {
  $data = DB::table("transactions")->select();
   return DataTables::of($data) -> make(true);  
 }
}
