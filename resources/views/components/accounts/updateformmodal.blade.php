
    <!-- was not clickable because there is no z index -->
    
<div class="w-screen h-screen  fixed bg-[rgb(0,0,0,0.2)] z-50" id="update">

<div class=" flex flex-col items-center  shadow-xl w-[70%] rounded-xl top-[100px]  gap-3 p-4 h-md ml-auto mr-auto bg-white text-black relative " >
    <x-exit/>
       <h1 class="text-xl font-bold ">Update User Form</h1>
    <div  class="grid grid-cols-2 items-center w-full gap-3 p-2   " id="add-modal"> 
   
    <div class="flex flex-col items-center">
    <label for="acc-id" class="font-bold text-lg">Account ID:</label>
    <input type="text" class="w-[80%]  text-black  border-black rounded-md p-3" id="acc-id" name="acc-id">
    </div>

    <div class="flex flex-col items-center">
     <label for="acc-number" class="font-bold text-lg">Account Number:</label>
    <input type="text" class="w-[80%]  text-black  border-black rounded-md p-3" id="acc-number" name="acc-number">
    </div>

    <div class="flex flex-col items-center">
    <label for="acc-plans" class="font-bold text-lg">Choose account type:</label>
    <select id="acc-plans" name="acc-plans" class="w-[80%] text-black border border-black rounded-md p-3">
        <option value="Savings">Savings</option>
        <option value="Checking" >Checking</option>
        <option value="Basic">Basic</option>
        <option value="Foreign Currency">Foreign Currency</option>
    </select>
    </div>

    <div class="flex flex-col items-center">
    <label for="initial-balance" class="font-bold text-lg">
    Balance:
    </label>
    <input type="number" class="w-[80%]  text-black  border-black rounded-md p-3 " id="initial-balance" name="initial-balance"  value="0">
   </div>

    <div class="flex flex-col items-center">
    <label for="opend-date" class="font-bold text-lg">
    Opened Date:
    </label>
    <input type="text" class="w-[80%]  text-black  border-black rounded-md p-3 " id="opened-date" name="opened-date"  value="0">
   </div>

   <div class="flex flex-col items-center">
     <label for="status" class="font-bold text-lg">Status:</label>
        <select id="status" name="status" class="w-[80%] text-black border border-black rounded-md p-3">
        <option value="Savings">0</option>
        <option value="Checking" >1</option>
       </select>
    </div>

    <div class="flex flex-col items-center">
    <label for="customer_id" class="font-bold text-lg">
        Customer ID:
    </label>
    <input type="text" class="w-[80%]  text-black  border-black rounded-md p-3" id="customer_id" name="customer_id">
    </div>
    </div>
 
    <button class="bg-green-600 text-white p-3 w-[150px] rounded-lg" id="update-user" >Update Info</button>   
     
   
    
</div>

</div>





