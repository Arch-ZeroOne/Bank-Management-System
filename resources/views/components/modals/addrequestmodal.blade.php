<div class=" w-screen h-screen fixed bg-[rgb(0,0,0,0.2)] z-50 invisible" id="addRequestModal">

    <div class="flex flex-col items-center  shadow-xl w-[40%] rounded-xl top-[140px]  gap-4 p-4 h-md ml-auto mr-auto bg-white text-black relative "
        id="animated-addform">
        <x-exit id="exit-request" class="exit-request" />

        <label for="request-date" class="font-bold text-lg">Request Date:</label>
        <input type="date" class="w-[80%]  text-black  border-black rounded-md p-3 " id="request-date"
            name="request-date">
        <label for="employee-id" class="font-bold text-lg">
            Employee ID:
        </label>
        <input type="number" class="w-[80%]  text-black  border-black rounded-md p-3 " id="employee-id"
            name="employee-id" value="0">


        <button class="bg-green-600 text-white p-3 w-[150px] rounded-lg" id="add-request" id="add-request">Add
            Request</button>

    </div>

</div>
