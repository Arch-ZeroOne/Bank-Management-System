<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\LoanRequest;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;


class LoansApiController extends Controller
{
    public function index(){
        $data = DB::table('loans')
            -> select()
            -> get();
        
        //returning data as a resource
        if($data){
            return response() -> json($data);
        }else{
            return response() -> json(["message" => "No records available"],200);
        }
    }

    public function store(LoanRequest $request){
        $faker = Faker::create();
        $form_infos = $request->validated();
        
        DB::table("loans")->insert([
            "loan_type" => $form_infos['loan_type'],
            "principal_amount" => $form_infos['principal_amount'],
            "interest_rate" => $form_infos['interest_rate'],
            "start_date" => $form_infos['start_date'],
            "end_date" => $form_infos['end_date'],
            "status" => $form_infos['status'],
            "customer_id" => $form_infos['customer_id'],
        ]);
    }

    public function show(String $id){
        $query = DB::table('loans')
            ->where("loan_id", $id)
            -> get();
        
        return response() -> json(["message" => "Loan Found", "data" => $query],200);
    }

    public function update(LoanRequest $request, String $id){
        $validated = $request -> validated();
        
        $query = DB::table('loans')
            -> where("loan_id", $id)
            -> update([
                "loan_type" => $validated['loan_type'],
                "principal_amount" => $validated['principal_amount'],
                "interest_rate" => $validated['interest_rate'],
                "start_date" => $validated['start_date'],
                "end_date" => $validated['end_date'],
                "status" => $validated['status'],
                "customer_id" => $validated['customer_id']
            ]);
            
        if($query ){
            return response() -> json(["message" => "User has been updated"],200);
        }else{
            return response() -> json(["error" => "User update fail"],200);
        }
    }

    public function destroy(String $id){
        $query = DB::table('loans')
            ->where("loan_id", $id)
            -> delete();
            
        return response() -> json(["message" => "Loan has been deleted", "data" => $query],200);
    }
}