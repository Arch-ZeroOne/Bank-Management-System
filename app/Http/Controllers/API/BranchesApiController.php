<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\InsertBranchesRequest;
use App\Http\Requests\API\UpdateAccountsRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Faker\Factory as Faker;
use App\Http\Resources\AccountsResource;

class BranchesApiController extends Controller
{
    public function index(){
        $data = DB::table('branches') -> select() -> get();

        //returning data as a resource
        if($data){
            return response() -> json($data);

        }else{
            return response() -> json(["message" => "No records available"],200);
        }
    }

    public function store(InsertBranchesRequest $request){
    $form_infos = $request->validated();

    DB::table("branches")->insert([
    "branch_name" => $form_infos['branch_name'],
    "address" => $form_infos['address'],
    "city" => $form_infos['city'],
    "state" => $form_infos['state'],
    "zip_code" => $form_infos['zip_code'],
    ]);

    }

    public function show(String $id){

        $query  = DB::table('branches') ->where("account_id", $id) -> get();


        return response() -> json(["message" => "User Found", "data" => $query],200);

    }

    public function update( UpdateAccountsRequest $request, String $id){
        $validated = $request -> validated();
        $query = DB::table('branches')
        -> where("branch_id", $id)
        -> update([
            "branch_name" => $validated['branch_name'],
            "address" => $validated['address'],
            "city" => $validated['city'],
            "state" => $validated['state'],
            "zip_code" => $validated['zip_code']
        ]);

        if($query ){
            return response() -> json(["message" => "Branches has been updated"],200);

        }else{
            return response() -> json(["error" => "Branches update fail"],200);
        }

        
    }

    public function destroy(String $id){
        $query  = DB::table('branches') ->where("branch_id", $id) -> delete();
        return response() -> json(["message" => "Branch  has been deleted", "data" => $query],200);
    }
}
