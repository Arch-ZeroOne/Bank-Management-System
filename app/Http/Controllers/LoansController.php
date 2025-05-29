<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoanRequest;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class LoansController extends Controller
{
    public function index()
    {

    return view('users.loans');
    }

    public function list()
    {

    $query = DB::table('loans')->select();

    return DataTables::of($query)->make(true);
    }

    public function update(LoanRequest $request)
    {
    $validated = $request->validated();

    DB::table("loans")->where('loan_id', $validated['id'])->update([
    'status' => $validated['status'],
    ]);

    }

    public function userInfo(String $id){
        $query = DB::table('loans') -> where('loan_id',$id) -> get(); 

        return response() -> json($query);
    }

}
