<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\API\InsertCustomerRequest;
use App\Http\Requests\API\UpdateCustomerRequest;

class CustomerApiController extends Controller
{
    public function index()
    {
        $data = DB::table('customer')->get();

        if ($data->isNotEmpty()) {
            return response()->json($data);
        } else {
            return response()->json(["message" => "No records available"], 200);
        }
    }

    public function store(InsertCustomerRequest $request)
    {
        $validated = $request->validated();

        DB::table('customer')->insert([
            'first_name'    => $validated['first_name'],
            'last_name'     => $validated['last_name'],
            'date_of_birth' => $validated['date_of_birth'],
            'email'         => $validated['email'],
            'phone_number'  => $validated['phone_number'],
            'address'       => $validated['address'],
            'date_joined'   => $validated['date_joined'],
        ]);

        return response()->json(['message' => 'Customer added successfully'], 201);
    }

    public function show(string $id)
    {
        $customer = DB::table('customer')->where('customer_id', $id)->first();

        if ($customer) {
            return response()->json(['message' => 'Customer Found', 'data' => $customer], 200);
        } else {
            return response()->json(['message' => 'Customer Not Found'], 404);
        }
    }

    public function update(UpdateCustomerRequest $request, string $id)
    {
        $validated = $request->validated();

        $updated = DB::table('customer')
            ->where('customer_id', $id)
            ->update([
                'first_name'    => $validated['first_name'],
                'last_name'     => $validated['last_name'],
                'date_of_birth' => $validated['date_of_birth'],
                'email'         => $validated['email'],
                'phone_number'  => $validated['phone_number'],
                'address'       => $validated['address'],
                'date_joined'   => $validated['date_joined'],
            ]);

        if ($updated) {
            return response()->json(['message' => 'Customer has been updated'], 200);
        } else {
            return response()->json(['error' => 'Customer update failed'], 200);
        }
    }

    public function destroy(string $id)
    {
        $deleted = DB::table('customer')->where('customer_id', $id)->delete();

        return response()->json(['message' => 'Customer has been deleted', 'data' => $deleted], 200);
    }
}
