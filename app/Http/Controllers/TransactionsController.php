<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionsController extends Controller
{
    public function index(){
        $query = DB::select('select * from transactions');
        
        return view('users.transactions',[
            'transactions' => $query,
        ]);
    }
}
