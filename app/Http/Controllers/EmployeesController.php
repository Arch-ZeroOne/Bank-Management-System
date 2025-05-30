<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class EmployeesController extends Controller
{

    public function index(){
        return view("users.employees");
    }


    public function list(){ 

        $query = DB::table("employees") -> get();

        return DataTables::of($query) -> make(true);

    }
    public function insert(){

    }

    public function update(){

    }

    public function delete(){
        
    }
}
