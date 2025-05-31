<x-app-layout>
    <x-header location="Dashboard" />

    <div class="flex  flex-col gap-10">
        <div class="p-2 flex items-center  justify-center flex-col gap-4" style="font-family: Winky Rough">
            <section class="w-full flex justify-around ">
                <div
                    class="bg-blue-500 shadow-lg rounded-md  flex justify-center items-center text-white h-50 w-80 gap-2 ">
                    <div
                        class="bg-blue-500 shadow-lg rounded-md  flex justify-center items-center text-white h-50 w-80 gap-2 ">
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


                <div
                    class="bg-green-500 shadow-lg rounded-md  flex justify-center items-center text-white h-50 w-80 gap-2 ">
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
            </section>

            <section class="w-full flex justify-around">

                <div
                    class="bg-yellow-500 shadow-lg rounded-md  flex justify-center items-center text-white h-50 w-80 gap-2 ">
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


                <div
                    class="bg-red-500 shadow-lg rounded-md  flex justify-center items-center text-white h-50 w-80 gap-2 ">
                    <div class="flex flex-col items-center w-full ">
                        <h2 class="self-end text-[30px] p-1" id="bank-balance">0</h2>
                        <div class="flex flex-col items-center">
                            <img src="{{ url('/images/money.png') }}" style="height: 100px">
                            <div class="mb-2">
                                Total Balance
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>


        <div class="max-w-6xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1
                    class="text-4xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent mb-4">
                    Customer's With Highest Balance
                </h1>
                <div class="w-24 h-1 bg-gradient-to-r from-purple-600 to-pink-600 mx-auto rounded-full"></div>
            </div>

            <!-- Table Container -->
            <div class="glass-effect rounded-2xl table-glow border border-white/20 overflow-hidden">
                <table class="w-full">
                    <thead class="header-shine text-white relative">
                        <tr>
                            <th class="px-8 py-6 text-left font-semibold text-lg tracking-wide">
                                <div class="flex items-center space-x-2">
                                    <span class="text-2xl">👤</span>
                                    <span>First Name</span>
                                </div>
                            </th>
                            <th class="px-8 py-6 text-left font-semibold text-lg tracking-wide">
                                <div class="flex items-center space-x-2">
                                    <span class="text-2xl">📝</span>
                                    <span>Last Name</span>
                                </div>
                            </th>
                            <th class="px-8 py-6 text-left font-semibold text-lg tracking-wide">
                                <div class="flex items-center space-x-2">
                                    <span class="text-2xl">📧</span>
                                    <span>Email</span>
                                </div>
                            </th>

                        </tr>
                    </thead>
                    <tbody id="table-body" class="bg-white/60 backdrop-blur-sm">

                    </tbody>
                </table>
            </div>

            <!-- Footer Info -->
            <div class="mt-8 text-center">
                <p class="text-gray-500 text-sm">Last updated: <span class="text-purple-600 font-medium">Just
                        now</span></p>
            </div>

        </div>

    </div>


    <script>
        const users = document.getElementById("users");
        const customers = document.getElementById("customers");
        const transactions = document.getElementById("transactions");
        const bank_balance = document.getElementById("bank-balance");
        const table_body = document.getElementById("table-body");




        //request for getting data from laravel route
        fetch(`dashboard/accounts`).then((response) => {
            return response.json();
        }).then((data) => {
            const {
                accounts,
                customer,
                transaction,
                balance,
                customer_info,
                customer_ranking,

            } = data;


            users.textContent = accounts;
            customers.textContent = customer;
            transactions.textContent = transaction;
            bank_balance.textContent = `$ ${balance}`;



            let count = 0;
            //looping through objects
            for (let key in customer_info) {
                count++;
                if (customer_info.hasOwnProperty(key)) {
                    value = customer_info[key];
                    table_body.innerHTML +=
                        ` <tr class="border-b border-gray-100/50 hover:bg-white/80 transition-all duration-300 group row-enter"
                                style="animation-delay: 0.2s">
                                <td class="px-8 py-6">
                                    <div class="flex items-center space-x-3">
                                        <div
                                            class="w-10 h-10 bg-gradient-to-r from-pink-400 to-red-500 rounded-full flex items-center justify-center text-white font-bold shadow-lg">
                                    ${count}
                                        </div>
                                        <span class="text-gray-900 font-semibold text-lg">${value.first_name}</span>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-gray-800 font-medium text-lg">${value.last_name}</td>
                                <td class="px-8 py-6">
                                    <div class="text-gray-600 bg-gray-50 px-3 py-2 rounded-full text-sm inline-block">
                                    ${value.email}
                                    </div>
                                </td>
                               
                            </tr>
                        </tr>`


                }
            }




        })
    </script>
</x-app-layout>
