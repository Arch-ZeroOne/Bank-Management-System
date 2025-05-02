<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class LoansController extends Controller
{
    public function index(){
         $query = DB::select('select * from loans');


         return view('users.loans',[
            "loans" => $query,
         ]);
    }
}
