<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Loan Requests') }}
        </h2>
    </x-slot>
    <div class="flex justify-center w-full">
        <table class="" id="myTable" class="display text-white w-full">
            <thead>
            <tr class="">
                <th class="">Approval ID</th>
                <th class="">Approval Date</th>
                <th class="">Status</th>
                <th class="">Employee ID</th>
                <th class="">Loan ID</th>
                <th class=""></th>
              
            </tr>
        </thead>
        <tbody>
         @foreach ($requests as $loan )
        
         <tr>
         <td class="">{{$loan -> loan_approval_id}}</td>
         <td class="">{{$loan -> approval_date}}</td>
         <td class="">{{$loan -> status}}</td>
         <td class="">{{$loan -> employee_id}}</td>
         <td class="">{{$loan -> loan_id}}</td>
         <td>
            <div style="display:flex; gap:20px; ">
                <button style="background-color:green; color:white; padding:10px; width: 100px; border-radius: 15px;" id="request">Update</button>
                <button style="background-color:red; color:white; padding:10px; width: 100px; border-radius: 15px;" id="delete">Delete</button>

            </div>
         </td>
         </tr>
       
    
         @endforeach
        </tbody>
        </table>
    </div>
</x-app-layout>
