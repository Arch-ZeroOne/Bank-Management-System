<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class BranchesController extends Controller
{
    
    public function index(){
        return view("users.branches");
    }

    public function list(){
        $query = DB::table('branches') -> select();

        return DataTables::of($query) -> make(true);
    }

    public function insert(){

    }

    public function update(){

    }

    public function delete(){
        
    }
}
