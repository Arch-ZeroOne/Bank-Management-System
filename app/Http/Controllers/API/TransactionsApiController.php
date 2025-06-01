<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\TransactionRequest;

use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class TransactionsApiController extends Controller
{
    public function index(){
        $data = DB::table('transactions')
            -> select()
            -> get();
        
        //returning data as a resource
        if($data){
            return response() -> json($data);
        }else{
            return response() -> json(["message" => "No records available"],200);
        }
    }

    public function store(TransactionRequest $request){
        $faker = Faker::create();
        $form_infos = $request->validated();
        
        DB::table("transactions")->insert([
            "transaction_date" => $form_infos['transaction_date'],
            "transaction_type" => $form_infos['transaction_type'],
            "amount" => $form_infos['amount'],
            "description" => $form_infos['description'],
            "account_id" => $form_infos['account_id'],
        ]);
    }

    public function show(String $id){
        $query = DB::table('transactions')
            ->where("transaction_id", $id)
            -> get();
        
        return response() -> json(["message" => "Transaction Found", "data" => $query],200);
    }

    public function update(TransactionRequest $request, String $id){
        $validated = $request -> validated();
        
        $query = DB::table('transactions')
            -> where("transaction_id", $id)
            -> update([
                "transaction_date" => $validated['transaction_date'],
                "transaction_type" => $validated['transaction_type'],
                "amount" => $validated['amount'],
                "description" => $validated['description'],
                "account_id" => $validated['account_id']
            ]);
            
        if($query ){
            return response() -> json(["message" => "User has been updated"],200);
        }else{
            return response() -> json(["error" => "User update fail"],200);
        }
    }

    public function destroy(String $id){
        $query = DB::table('transactions')
            ->where("transaction_id", $id)
            -> delete();
            
        return response() -> json(["message" => "Transaction has been deleted", "data" => $query],200);
    }
}