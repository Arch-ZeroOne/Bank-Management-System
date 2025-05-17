<x-app-layout>
    <div class="p-2 flex items-center gap-3" style="font-family: Winky Rough">
        <div class="bg-blue-500 shadow-lg rounded-md  flex justify-center items-center text-white h-50 w-80 gap-2 ">
            <div class="bg-blue-500 shadow-lg rounded-md  flex justify-center items-center text-white h-50 w-80 gap-2 ">
                <div class="flex flex-col items-center w-full ">
                    <h2 class="self-end text-[30px] p-1" id="users">0</h2>
                    <div class="flex flex-col items-center">
                        <img src="{{ url('/images/users.png') }}" style="height: 100px">
                        <div class="mb-2">
                            Users
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="bg-green-500 shadow-lg rounded-md  flex justify-center items-center text-white h-50 w-80 gap-2 ">
            <div class="flex flex-col items-center w-full ">
                <h2 class="self-end text-[30px] p-1" id="customers">0</h2>
                <div class="flex flex-col items-center">
                    <img src="{{ url('/images/customer.png') }}" style="height: 100px">
                    <div class="mb-2">
                        Customers
                    </div>
                </div>
            </div>
        </div>


        <div class="bg-yellow-500 shadow-lg rounded-md  flex justify-center items-center text-white h-50 w-80 gap-2 ">
            <div class="flex flex-col items-center w-full ">
                <h2 class="self-end text-[30px] p-1" id="transactions">0</h2>
                <div class="flex flex-col items-center">
                    <img src="{{ url('/images/transaction.png') }}" style="height: 100px">
                    <div class="mb-2">
                        Transactions
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div>
        <canvas id="myChart"></canvas>
    </div>
    <script>
        const users = document.getElementById("users");
        const customers = document.getElementById("customers");
        const transactions = document.getElementById("transactions");

        fetch(`dashboard/accounts`).then((response) => {
            return response.json();
        }).then((data) => {
            users.textContent = data.count;
        })
        fetch(`dashboard/customers`).then((response) => {
            return response.json();
        }).then((data) => {
            customers.textContent = data.count;
        })
        fetch(`dashboard/transactions`).then((response) => {
            return response.json();
        }).then((data) => {
            transactions.textContent = data.count;
        })
    </script>
</x-app-layout>
