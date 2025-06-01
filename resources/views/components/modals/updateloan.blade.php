<div class="fixed inset-0 z-50 bg-black/30 backdrop-blur-sm flex items-center justify-center invisible" id="updateLoans">
    <div class="w-[90%] max-w-4xl bg-white rounded-2xl shadow-2xl p-8 md:p-10 relative">

        <!-- Exit Button -->
        <x-exit id="exit-loans" class="absolute top-4 right-4 text-red-500 hover:text-red-700 text-2xl cursor-pointer" />

        <!-- Title -->
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-10 tracking-tight">Update Loan</h2>

        <!-- Input Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Loan ID -->
            <div>
                <label for="update-loan-id" class="block text-gray-700 font-medium mb-2">Loan ID</label>
                <input type="number" id="update-loan-id" name="loan-id" value="" readonly
                    class="w-full rounded-xl border border-gray-300 p-3 bg-gray-100 cursor-not-allowed focus:outline-none transition duration-200 ease-in-out" />
            </div>

            <!-- Loan Type -->
            <div>
                <label for="update-loan-type" class="block text-gray-700 font-medium mb-2">Loan Type</label>
                <select id="update-loan-type" name="loan-type"
                    class="w-full rounded-xl border border-gray-300 p-3 focus:ring-2 focus:ring-green-400 focus:outline-none transition duration-200 ease-in-out">
                    <option value="Student">Student</option>
                    <option value="Business">Business</option>
                    <option value="Secured">Secured</option>
                </select>
            </div>

            <!-- Principal Amount -->
            <div>
                <label for="update-principal-amount" class="block text-gray-700 font-medium mb-2">Principal
                    Amount</label>
                <input type="number" id="update-principal-amount" name="principal-amount" value="0"
                    class="w-full rounded-xl border border-gray-300 p-3 focus:ring-2 focus:ring-green-400 focus:outline-none transition duration-200 ease-in-out" />
            </div>

            <!-- Interest Rate -->
            <div>
                <label for="update-interest-rate" class="block text-gray-700 font-medium mb-2">Interest Rate</label>
                <select id="update-interest-rate" name="interest-rate"
                    class="w-full rounded-xl border border-gray-300 p-3 focus:ring-2 focus:ring-green-400 focus:outline-none transition duration-200 ease-in-out">
                    <option value="1.0">1.00%</option>
                    <option value="1.5">1.50%</option>
                    <option value="2.0">2.00%</option>
                    <option value="2.5">2.50%</option>
                    <option value="3.0">3.00%</option>
                    <option value="3.5">3.50%</option>
                    <option value="4.0">4.00%</option>
                    <option value="4.5">4.50%</option>
                    <option value="5.0">5.00%</option>
                    <option value="5.5">5.50%</option>
                    <option value="6.0">6.00%</option>
                    <option value="6.5">6.50%</option>
                    <option value="7.0">7.00%</option>
                    <option value="7.5">7.50%</option>
                    <option value="8.0">8.00%</option>
                    <option value="8.5">8.50%</option>
                    <option value="9.0">9.00%</option>
                    <option value="9.5">9.50%</option>
                    <option value="10.0">10.00%</option>
                    <option value="10.5">10.50%</option>
                    <option value="11.0">11.00%</option>
                    <option value="11.5">11.50%</option>
                    <option value="12.0">12.00%</option>
                </select>
            </div>

            <!-- Customer ID -->
            <div>
                <label for="update-customer-id" class="block text-gray-700 font-medium mb-2">Customer ID</label>
                <input type="number" id="update-customer-id" name="customer-id" value="0"
                    class="w-full rounded-xl border border-gray-300 p-3 focus:ring-2 focus:ring-green-400 focus:outline-none transition duration-200 ease-in-out" />
            </div>

            <!-- Start Date -->
            <div>
                <label for="update-start-date" class="block text-gray-700 font-medium mb-2">Start Date</label>
                <input type="date" id="update-start-date" name="start-date"
                    class="w-full rounded-xl border border-gray-300 p-3 focus:ring-2 focus:ring-green-400 focus:outline-none transition duration-200 ease-in-out" />
            </div>

            <!-- End Date -->
            <div>
                <label for="update-end-date" class="block text-gray-700 font-medium mb-2">End Date</label>
                <input type="date" id="update-end-date" name="end-date"
                    class="w-full rounded-xl border border-gray-300 p-3 focus:ring-2 focus:ring-green-400 focus:outline-none transition duration-200 ease-in-out" />
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-center mt-10">
            <button id="update-loan"
                class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl font-semibold text-lg transition-all duration-200 shadow-md hover:shadow-lg">
                ✅ Update Loan
            </button>
        </div>
    </div>
</div>
