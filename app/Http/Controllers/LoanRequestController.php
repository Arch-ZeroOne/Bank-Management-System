<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateStatusRequests;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

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
}
