<form method="POST" action="{{route('users.store')}}">
    @csrf
    <!-- was not clickable because there is no z index -->
<div class="w-screen h-screen  fixed bg-[rgb(0,0,0,0.2)] z-50" id="modal">
   
<div class="flex flex-col items-center  shadow-xl w-[40%] rounded-xl top-[200px]  gap-3 p-4 h-md ml-auto mr-auto bg-black text-white relative " >
    <x-exit/>
    <label for="acc-plans" n class="font-bold">Choose account type:</label>
    <select id="acc-plans" name="acc-plans" class="w-[80%] text-black">
        <option value="Savings">Savings</option>
        <option value="Checking" >Checking</option>
        <option value="Basic">Basic</option>
        <option value="Foreign Currency">Foreign Currency</option>
    </select>
    <label for="initial-balance">
        Initial Balance:
    </label>
    <input type="number" class="w-[80%]  text-black  bg-white" id="initial-balance" name="initial-balance" >
    <label for="customer_id">
        Customer ID:
    </label>
    <input type="number" class="w-[80%]  text-black" id="customer_id" name="customer_id">
    <button class="bg-green-600 text-white p-3 w-[150px] rounded-lg" id="add-user">Add user</button>
</div>

</div>

</form>

