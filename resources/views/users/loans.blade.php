<x-app-layout>
     <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('All Loans') }}
        </h2>
    </x-slot>
    <div class="flex justify-center w-full mt-5 ">
    <table class="" id="myTable" class="display text-white">
        <thead>
        <tr class="">
            <th class="">Loan ID</th>
            <th class="">Loan Type</th>
            <th class="">Principal Amount</th>
            <th class="">Interest Rate</th>
            <th class="">Start Date</th>
            <th class="">End Date</th>
            <th class="">Status</th>
            <th class="">Customer ID</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
     @foreach ($loans as $loan )
    
     <tr>
     <td class="">{{$loan -> loan_id}}</td>
     <td class="">{{$loan -> loan_type}}</td>
     <td class="">{{$loan -> principal_amount }}</td>
     <td class="">{{$loan -> interest_rate}}</td>
     <td class="">{{$loan -> start_date}}</td>
     <td class="">{{$loan -> end_date}}</td>
     <td class="">{{$loan -> status}}</td>
     <td class="">{{$loan -> customer_id}}</td>
     <td>
        <div style="display:flex; gap:10px; ">
            <button style="background-color:green; color:white; padding:10px; width: 100px; border-radius: 15px;" id="update">Update</button>
            <button style="background-color:red; color:white; padding:10px; width: 100px; border-radius: 15px;" id="delete">Delete</button>

        </div>
     </td>
     </tr>
   

     @endforeach
    </tbody>
    </table>
</div>
</x-app-layout>