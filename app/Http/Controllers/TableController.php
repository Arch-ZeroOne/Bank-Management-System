<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class TableController extends Controller
{
    
    public function list(){
        $query = DB::select("SELECT * from accounts");

           //Gets datatables values and convert it into table row

        return DataTables::of($query) -> make(true);
    }
}
