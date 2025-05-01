<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class LoanRequestController extends Controller
{
    public function index(){
     $query = DB::select('select * from loan_approvals');

     return view('users.loanrequests',[
       'requests' => $query,
     ]);

    }
}
