<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\EmployeeRequest;
use Illuminate\Support\Facades\DB;

class EmployeesApiController extends Controller
{
    public function index(){
        $data = DB::table('employees')
            -> select()
            -> get();
        
        //returning data as a resource
        if($data){
            return response() -> json($data);
        }else{
            return response() -> json(["message" => "No records available"],200);
        }
    }

    public function store(EmployeeRequest $request){
        $form_infos = $request->validated();
        
        DB::table("employees")->insert([
            "first_name" => $form_infos['first_name'],
            "last_name" => $form_infos['last_name'],
            "email" => $form_infos['email'],
            "phone_number" => $form_infos['phone_number'],
            "position" => $form_infos['position'],
            "hire_date" => $form_infos['hire_date'],
            "branch_id" => $form_infos['branch_id'],
        ]);
    }

    public function show(String $id){
        $query = DB::table('employees')
            ->where("employee_id", $id)
            -> get();
        
        return response() -> json(["message" => "User Found", "data" => $query],200);
    }

    public function update(EmployeeRequest $request, String $id){
        $validated = $request -> validated();
        
        $query = DB::table('employees')
            -> where("employee_id", $id)
            -> update([
                "first_name" => $validated['first_name'],
                "last_name" => $validated['last_name'],
                "email" => $validated['email'],
                "phone_number" => $validated['phone_number'],
                "position" => $validated['position'],
                "hire_date" => $validated['hire_date'],
                "branch_id" => $validated['branch_id']
            ]);
            
        if($query ){
            return response() -> json(["message" => "User has been updated"],200);
        }else{
            return response() -> json(["error" => "User update fail"],200);
        }
    }

    public function destroy(String $id){
        $query = DB::table('employees')
            ->where("employee_id", $id)
            -> delete();
            
        return response() -> json(["message" => "User has been deleted", "data" => $query],200);
    }
}