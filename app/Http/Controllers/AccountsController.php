<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\AddUserRequest;;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class AccountsController extends Controller
{
    
    public function index(){
        $query = DB::select('select * from accounts') ;
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
                        ->with("message", "User added Successfully");
    }
    
    public function update(){
        

    }
    public function destroy(String $id){
        DB::table('accounts') -> where("account_id",$id) -> delete();

        return redirect() -> route("user");

    }
}
