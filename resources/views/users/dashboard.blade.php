<x-app-layout>
    <x-header location="Dashboard" />

    <div class="flex flex-col gap-12 px-4 md:px-10 py-6 font-[Winky_Rough]">

        <!-- Stats Cards -->
        <section class="w-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 max-w-7xl mx-auto">
            <div
                class="bg-blue-600 shadow-lg rounded-xl flex flex-col items-center justify-center text-white py-8 px-6 cursor-pointer hover:shadow-xl transition-shadow duration-300 hover:scale-105 transform-gpu max-w-full min-w-[150px]">
                <h2 id="users"
                    class="text-5xl font-extrabold mb-3 truncate w-full text-center leading-tight break-words">0</h2>
                <img src="{{ url('/images/users.png') }}" alt="Users" class="h-24 mb-4 object-contain" />
                <p class="uppercase tracking-wider font-semibold text-lg text-center truncate" title="Total Users">Total
                    Users</p>
            </div>

            <div
                class="bg-green-600 shadow-lg rounded-xl flex flex-col items-center justify-center text-white py-8 px-6 cursor-pointer hover:shadow-xl transition-shadow duration-300 hover:scale-105 transform-gpu max-w-full min-w-[150px]">
                <h2 id="customers"
                    class="text-5xl font-extrabold mb-3 truncate w-full text-center leading-tight break-words">0</h2>
                <img src="{{ url('/images/customer.png') }}" alt="Customers" class="h-24 mb-4 object-contain" />
                <p class="uppercase tracking-wider font-semibold text-lg text-center truncate" title="Total Customers">
                    Total Customers</p>
            </div>

            <div
                class="bg-yellow-500 shadow-lg rounded-xl flex flex-col items-center justify-center text-white py-8 px-6 cursor-pointer hover:shadow-xl transition-shadow duration-300 hover:scale-105 transform-gpu max-w-full min-w-[150px]">
                <h2 id="transactions"
                    class="text-5xl font-extrabold mb-3 truncate w-full text-center leading-tight break-words">0</h2>
                <img src="{{ url('/images/transaction.png') }}" alt="Transactions" class="h-24 mb-4 object-contain" />
                <p class="uppercase tracking-wider font-semibold text-lg text-center truncate"
                    title="Total Transactions">Total Transactions</p>
            </div>

            <div
                class="bg-red-600 shadow-lg rounded-xl flex flex-col items-center justify-center text-white py-8 px-6 cursor-pointer hover:shadow-xl transition-shadow duration-300 hover:scale-105 transform-gpu max-w-full min-w-[150px] relative overflow-hidden">

                <!-- Subtle currency icon background -->
                <svg class="absolute top-4 right-4 w-20 h-20 text-red-800 opacity-20" fill="currentColor"
                    viewBox="0 0 24 24" aria-hidden="true">
                    <path
                        d="M12 1C5.925 1 1 5.925 1 12s4.925 11 11 11 11-4.925 11-11S18.075 1 12 1zm.5 16.5h-1v-1.5H9v-2h2.5V11h-2v-2h2.5V7h1v2h2v2h-2v3h2v2h-2v1.5z" />
                </svg>

                <div class="relative z-10 flex items-center justify-center space-x-2 w-full mb-4">
                    <span class="text-4xl font-semibold">$</span>
                    <h2 id="bank-balance"
                        class="text-5xl font-extrabold leading-tight tracking-tight truncate w-full text-center break-words">
                        0.00</h2>
                </div>
                <img src="{{ url('/images/money.png') }}" alt="Balance" class="h-24 object-contain" />
                <p class="uppercase tracking-wider font-semibold text-lg text-center truncate" title="Total Balance">
                    Total Balance</p>
            </div>
        </section>

        <!-- Customers with Highest Balance Section -->
        <div class="max-w-7xl mx-auto w-full">
            <!-- Header -->
            <div class="text-center mb-10">
                <h1
                    class="text-4xl font-extrabold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent mb-3">
                    Customers With Highest Balance
                </h1>
                <div class="mx-auto w-28 h-1 bg-gradient-to-r from-purple-600 to-pink-600 rounded-full"></div>
            </div>

            <!-- Table Container -->
            <div
                class="bg-white/80 backdrop-blur-md rounded-3xl border border-white/30 shadow-lg overflow-hidden max-h-[480px] overflow-y-auto">
                <table class="w-full table-auto border-collapse">
                    <thead class="bg-gradient-to-r from-purple-600 to-pink-600 text-white sticky top-0 shadow-md z-10">
                        <tr>
                            <th class="px-10 py-5 text-left font-semibold text-xl tracking-wide">
                                <div class="flex items-center space-x-3">
                                    <span class="text-3xl">👤</span>
                                    <span>First Name</span>
                                </div>
                            </th>
                            <th class="px-10 py-5 text-left font-semibold text-xl tracking-wide">
                                <div class="flex items-center space-x-3">
                                    <span class="text-3xl">📝</span>
                                    <span>Last Name</span>
                                </div>
                            </th>
                            <th class="px-10 py-5 text-left font-semibold text-xl tracking-wide">
                                <div class="flex items-center space-x-3">
                                    <span class="text-3xl">📧</span>
                                    <span>Email</span>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="table-body" class="bg-white/90">
                        <!-- Data will be injected here -->
                    </tbody>
                </table>
            </div>

            <!-- Footer Info -->
            <div class="mt-6 text-center text-gray-600 italic text-sm">
                Last updated: <span class="font-semibold text-purple-600">Just now</span>
            </div>
        </div>
    </div>

    <script>
        const users = document.getElementById("users");
        const customers = document.getElementById("customers");
        const transactions = document.getElementById("transactions");
        const bank_balance = document.getElementById("bank-balance");
        const table_body = document.getElementById("table-body");

        fetch(`dashboard/accounts`)
            .then(response => response.json())
            .then(data => {
                const {
                    accounts,
                    customer,
                    transaction,
                    balance,
                    customer_info
                } = data;

                users.textContent = accounts;
                customers.textContent = customer;
                transactions.textContent = transaction;
                bank_balance.textContent = balance.toLocaleString(undefined, {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });

                table_body.innerHTML = '';

                for (let key in customer_info) {
                    if (customer_info.hasOwnProperty(key)) {
                        const value = customer_info[key];

                        table_body.innerHTML += `
                            <tr class="border-b border-gray-200 hover:bg-purple-50 transition-colors duration-200 cursor-pointer">
                                <td class="px-10 py-4 text-gray-900 font-semibold text-lg">${value.first_name}</td>
                                <td class="px-10 py-4 text-gray-800 font-medium text-lg">${value.last_name}</td>
                                <td class="px-10 py-4">
                                    <div class="text-gray-700 bg-purple-100 px-3 py-1 rounded-full text-sm font-medium inline-block">
                                        ${value.email}
                                    </div>
                                </td>
                            </tr>`;
                    }
                }
            });
    </script>
</x-app-layout>
