<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Transactions') }}
        </h2>
    </x-slot>
    <div class="flex justify-center w-full">
        <table class="" id="myTable" class="display text-white w-full">
            <thead>
            <tr class="">
                <th class="">Transaction ID</th>
                <th class="">Transaction Date</th>
                <th class="">Transaction Type</th>
                <th class="">Amount</th>
                <th class="">Description</th>
                <th class="">Account ID</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
         @foreach ($transactions as $transaction )
        
         <tr>
         <td class="">{{$transaction -> transaction_id}}</td>
         <td class="">{{$transaction -> transaction_date}}</td>
         <td class="">{{$transaction -> transaction_type}}</td>
         <td class="">{{$transaction -> amount}}</td>
         <td class="">{{$transaction -> description}}</td>
         <td class="">{{$transaction -> account_id}}</td>
         <td>
            <div style="display:flex; gap:20px; ">
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