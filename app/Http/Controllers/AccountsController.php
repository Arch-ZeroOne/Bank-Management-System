<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class AccountsController extends Controller
{
    
    public function index(){
        $query = DB::select('select * from accounts') ;
        return view('users.allusers',[
            'users' => $query ,
        ]);
    }
}
