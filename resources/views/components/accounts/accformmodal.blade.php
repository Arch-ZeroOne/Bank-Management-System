    <!-- was not clickable because there is no z index -->

    <div class=" w-screen h-screen  fixed bg-[rgb(0,0,0,0.2)] z-50 invisible" id="modal">

        <div class="flex flex-col items-center  shadow-xl w-[40%] rounded-xl top-[140px]  gap-4 p-4 h-md ml-auto mr-auto bg-white text-black relative "
            id="animated-addform">
            <x-exit class='quit' id='quit' />
            <label for="acc-plans" class="font-bold text-lg">Choose account type:</label>
            <select id="acc-plans" name="acc-plans" class="w-[80%] text-black border border-black rounded-md p-3">
                <option value="Savings">Savings</option>
                <option value="Checking">Checking</option>
                <option value="Basic">Basic</option>
                <option value="Foreign Currency">Foreign Currency</option>
            </select>
            <label for="initial-balance" class="font-bold text-lg">
                Initial Balance:
            </label>
            <input type="number" class="w-[80%]  text-black  border-black rounded-md p-3 " id="initial-balance"
                name="initial-balance" value="0">
            <label for="customer_id" class="font-bold text-lg">
                Customer ID:
            </label>
            <input type="number" class="w-[80%]  text-black  border-black rounded-md p-3" id="customer-id"
                name="customer-id">

            <button class="bg-green-600 text-white p-3 w-[150px] rounded-lg" id="add-user" id="add-user">Add
                user</button>

        </div>

    </div>
