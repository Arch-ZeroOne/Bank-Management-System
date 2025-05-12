<?php

namespace App\Http\Controllers;
use App\Http\Requests\AddUserRequest;;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Http\Requests\UpdateUserRequest;
class AccountsController extends Controller
{
    
    public function index(){
        $query = DB::select('select * from accounts');

        return view('users.allusers',[
            'users' => $query ,
        ]);
    }


    public function store(AddUserRequest $request){
        $faker = Faker::create();
        $form_infos = $request -> validated();

        DB::table("accounts") -> insert([
            "account_number" => $faker -> randomNumber(9,true), 
            "account_type" => $form_infos['acc-plans'],
            "balance" => $form_infos['initial-balance'],
            "customer_id" => $form_infos['customer_id'],
            "opened_date" => $faker -> date(),
            "status" => 1
        ]);

            return redirect()   -> route("user") 
                                -> with("message", "User added Successfully");
    }

    public function getInfo(String $id){
        $data =  DB::table("accounts") -> where("account_id", $id) -> get();
       
        return response() -> json($data);

    }
    
    public function update(UpdateUserRequest $request , $id){
        $form_infos = $request -> validated();

        dd($id);

        DB::update("UPDATE accounts SET account_number = ? , account_type = ? , balance = ? , customer_id = ?, opened_date = ? , status = ?",
    [$form_infos["acc-id"],$form_infos["acc-number"],$form_infos['acc-plans'],$form_infos['initial-balance'],$form_infos['opened-date'],$form_infos['status'], $form_infos["customer_id"]] );

    return redirect() -> route("users") -> with("message", "User successfully updated");

    }
    public function destroy(String $id){
        DB::table('accounts') -> where("account_id",$id) -> delete();

        return redirect() -> route("user");


    }
}
