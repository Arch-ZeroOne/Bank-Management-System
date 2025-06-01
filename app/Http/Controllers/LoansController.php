<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoanRequest;
use App\Http\Requests\AddLoanRequest;
use App\Http\Requests\EditLoanRequest;
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


    public function insert(AddLoanRequest $request){
        $validated = $request -> validated();

        DB::table('loans') -> insert([
            "loan_type" => $validated["loan_type"],
            "principal_amount" => $validated["principal_amount"],
            "interest_rate" => $validated["interest_rate"],
            "start_date" => $validated["start_date"],
            "end_date" => $validated["end_date"],
            "status" => "Unpaid",
            "customer_id" => $validated["customer_id"],
        ]);
    }

    public function getInfo(String $id){

        $query = DB::table('loans') -> where("loan_id",$id) -> get();

        return response() -> json($query);

    }

    public function edit(EditLoanRequest $request){
            $validated = $request->validated();

            DB::table('loans')
                ->where('loan_id', $validated['loan_id'])
                ->update([
                    'loan_type' => $validated['loan_type'],
                    'principal_amount' => $validated['principal_amount'],
                    'interest_rate' => $validated['interest_rate'],
                    'start_date' => $validated['start_date'],
                    'end_date' => $validated['end_date'],
                    'customer_id' => $validated['customer_id'],
                ]);
                }



}
