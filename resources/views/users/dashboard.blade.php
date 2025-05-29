<x-app-layout>
    <x-header location="Dashboard" />
    <div class="p-2 flex items-center gap-3 justify-center" style="font-family: Winky Rough">
        <div class="bg-blue-500 shadow-lg rounded-md  flex justify-center items-center text-white h-50 w-80 gap-2 ">
            <div class="bg-blue-500 shadow-lg rounded-md  flex justify-center items-center text-white h-50 w-80 gap-2 ">
                <div class="flex flex-col items-center w-full ">
                    <h2 class="self-end text-[30px] p-1" id="users">0</h2>
                    <div class="flex flex-col items-center">
                        <img src="{{ url('/images/users.png') }}" style="height: 100px">
                        <div class="mb-2">
                            Total Users
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
                        Total Customers
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
                        Total Transactions
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!--Chart -->

    <div>
        <h1 class="text-center">Total Balance Per Account Type</h1>
        <canvas id="total-balance" class="ml-auto mr-auto h-[500px]"
            style="height: 500px;width: 500px;display: block;box-sizing: border-box;">

        </canvas>
    </div>


    <script>
        const users = document.getElementById("users");
        const customers = document.getElementById("customers");
        const transactions = document.getElementById("transactions");

        fetch(`dashboard/accounts`).then((response) => {
            return response.json();
        }).then((data) => {
            const {
                accounts,
                customer,
                transaction
            } = data;

            users.textContent = accounts;
            customers.textContent = customer;
            transactions.textContent = transaction;
        })
    </script>
</x-app-layout>
