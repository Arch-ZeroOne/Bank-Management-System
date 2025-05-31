<div class="w-screen h-screen  fixed bg-[rgb(0,0,0,0.2)] z-50 invisible" id="editRequestModal">

    <div
        class="animate__animated animate__backInDown flex flex-col items-center  shadow-xl w-[70%] rounded-xl top-[100px]  gap-3 p-4 h-md ml-auto mr-auto bg-white text-black relative ">
        <x-exit class="exit-request" id="exit-request" />
        <h1 class="text-xl font-bold ">Update Request Form</h1>
        <div class="grid grid-cols-2 items-center w-full gap-3 p-2">

            <div class="flex flex-col items-center">
                <label for="request-id" class="font-bold text-lg">Request ID:</label>
                <input type="text" class="w-[80%]  text-black  border-black rounded-md p-3" id="request-id"
                    name="request-id" readonly>
            </div>


            <div class="flex flex-col items-center">
                <label for="request-date" class="font-bold text-lg">
                    Request Date:
                </label>
                <input type="date" class="w-[80%]  text-black  border-black rounded-md p-3 " id="request-date"
                    name="date">
            </div>


            <div class="flex flex-col items-center">
                <label for="employee-id" class="font-bold text-lg">Employee ID:</label>
                <input type="text" class="w-[80%]  text-black  border-black rounded-md p-3" id="employee-request-id"
                    name="employee-request-id">
            </div>

            <div class="flex flex-col items-center">
                <label for="loan-id" class="font-bold text-lg">Loan ID:</label>
                <input type="text" class="w-[80%]  text-black  border-black rounded-md p-3" id="loan-id"
                    name="employee-id">
            </div>

            <div class="flex flex-col items-center">
                <label for="request-status" class="font-bold text-lg">Status:</label>
                <select id="request-status" name="request-status"
                    class="w-[80%] text-black border border-black rounded-md p-3">
                    <option value="Ongoing">Ongoing</option>
                    <option value="Approved">Approved</option>
                    <option value="Rejected">Rejected</option>

                </select>
            </div>





        </div>

        <button class="bg-green-600 text-white p-3 w-[150px] rounded-lg" id="update-request">Update Request</button>


    </div>

</div>
