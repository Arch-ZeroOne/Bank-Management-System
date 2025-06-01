<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\InsertApiRequest;
use App\Http\Requests\API\UpdateAccountsRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Faker\Factory as Faker;
use App\Http\Resources\AccountsResource;

class AccountsApiController extends Controller
{
    public function index(){
        $data = DB::table('accounts') -> select() -> get();

        //returning data as a resource
        if($data){
            return response() -> json($data);

        }else{
            return response() -> json(["message" => "No records available"],200);
        }
    }

    public function store(InsertApiRequest $request){
    $faker      = Faker::create();
    $form_infos = $request->validated();

    DB::table("accounts")->insert([
    "account_number" => $faker->randomNumber(9, true),
    "account_type" => $form_infos['account_type'],
    "balance" => $form_infos['balance'],
    "customer_id" => $form_infos['customer_id'],
    "opened_date" => $faker->date(),
    "status" => "Active",
    ]);

    }

    public function show(String $id){

        $query  = DB::table('accounts') ->where("account_id", $id) -> get();


        return response() -> json(["message" => "User Found", "data" => $query],200);

    }

    public function update( UpdateAccountsRequest $request, String $id){
        $validated = $request -> validated();
        $query  =  DB::table('accounts') -> where("account_id", $id) 
        -> update([
            "account_type"  => $validated['account_type'],
            "balance" =>  $validated['balance'],
            "opened_date" =>  $validated['opened_date'],
            "status" =>  $validated['status'],
            "customer_id" => $validated['customer_id']
        ]);

        if($query ){
            return response() -> json(["message" => "User has been updated"],200);

        }else{
            return response() -> json(["error" => "User update fail"],200);
        }

        
    }

    public function destroy(String $id){
        $query  = DB::table('accounts') ->where("account_id", $id) -> delete();
        return response() -> json(["message" => "User  has been deleted", "data" => $query],200);
    }
}
