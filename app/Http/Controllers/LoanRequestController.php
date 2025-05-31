<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateStatusRequests;
use App\Http\Requests\AddLoanRRequest;
use App\Http\Requests\UpdateRequestDetails;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Faker\Factory as Faker;


class LoanRequestController extends Controller
{
    public function index()
    {

        return view('users.loanrequests');

    }
    public function list()
    {
        $query = DB::table('loan_approvals')->select();

        return DataTables::of($query)->make(true);
    }

    public function updateStatus(UpdateStatusRequests $request)
    {
        $validated = $request->validated();
        DB::table("loan_approvals")->where("loan_approval_id", $validated['loan_approval_id'])->update([
        "status" => $validated['status'],
        ]);
        }
    public function userInfo(String $id){
        $query = DB::table('loan_approvals') -> where('loan_approval_id',$id) -> get();
        
        return response() -> json($query);
        
    }

    public function updateDetails(UpdateRequestDetails $request){
        $validated = $request -> validated();

        DB::table('loan_approvals') -> where('loan_approval_id',$validated["loan_approval_id"])-> update([
            "loan_approval_id" => $validated["loan_approval_id"],
            "approval_date" => $validated["approval_date"],
            "employee_id" => $validated["employee_id"],
            "loan_id" => $validated["loan_id"],
            "status" =>  $validated["status"],

        ]);

    }

    public function insert(AddLoanRRequest $request){
        $validated = $request -> validated();
        $faker = Faker::create();

        DB::table("loan_approvals") -> insert([
            "approval_date" => $validated['approval_date'],
            'status' => $validated['status'],
            'employee_id' => $validated['employee_id'],
            "loan_id" => $faker -> randomNumber(5,true)
        ]); 

    }

    public function getInfo(String $id){

        $query = DB::table('loan_approvals') -> where('loan_approval_id',$id) -> get();


        return response() -> json($query);
    }
}
