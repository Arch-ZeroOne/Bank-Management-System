<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('All Users') }}
        </h2>
    </x-slot>

    <div class="flex justify-center w-full mt-5 flex-col items-center">



    <x-addbtn/>
  

    <table class="" id="myTable" class="display text-white">
        <thead>
        <tr class="">
            <th class="">Account ID</th>
            <th class="">Account Number</th>
            <th class="">Account Type</th>
            <th class="">Balance</th>
            <th class="">Opened Date</th>
            <th class="">Status</th>
            <th class="">Customer ID</th>
            <th></th>
        </tr>
    </thead>

    <tbody>
     @foreach ($users as $user )
    
     <tr>
        <td class="">{{$user -> account_id}}</td>
        <td class="" >{{$user -> account_number}}</td>
        <td class="">{{$user -> account_type }}</td>
        <td class="">{{$user -> balance}}</td>
        <td class="">{{$user -> opened_date}}</td>
        <td class="">{{$user -> status}}</td>
        <td class="">{{$user -> customer_id}}</td>
       <td>
        <div style="display:flex; gap:20px; ">
            <button  style="background-color:green; color:white; padding:10px; width: 100px; border-radius: 15px;" id="update">Update</button>


       
            <button style="background-color:red; color:white; padding:10px; width: 100px; border-radius: 15px;" id="delete">Delete</button>
                 <form id="delete-account" method="POST" action="{{route("user.destroy", $user -> account_id)}}">
                @csrf
                @method("DELETE")
            </form>

        </div>
     </td>
     </tr>

     @endforeach
    </tbody>
    </table>
        </div>
        

        
</x-app-layout>
