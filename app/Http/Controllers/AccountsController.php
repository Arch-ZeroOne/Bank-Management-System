<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserRequest;
use App\Http\Requests\DeleteUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class AccountsController extends Controller
{

 //Querying for form update values
  public function getInfo(String $id)
  {
    $data = DB::table("accounts")->where("account_id", $id)->get();
    return response()->json($data);

  }

  public function store(AddUserRequest $request)
  {
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

  return redirect()->route("user")
    ->with("message", "User added Successfully");
  } 

  public function update(UpdateUserRequest $request)
  {

    $form_infos = $request->validated();
    DB::table('accounts')
    ->where('account_id', $form_infos['id'])
    ->update(
      [
      'account_type' => $form_infos['plan'],
      'status' => $form_infos['status'],
      'balance' => $form_infos['balance'],
      'opened_date' => $form_infos['date'],
      ]);
  }

  


  public function destroy(DeleteUserRequest $request)
      {
        $validated = $request -> validated();
        
        DB::table('accounts')->where("account_id",
                  $validated['id']) 
                  -> update(['status' => $validated['status'],
        ]);
        
      }
  }
