<div class="fixed inset-0 z-50 bg-[rgba(0,0,0,0.2)] flex items-center justify-center invisible" id="addNewLoans">
    <div class="w-[90%] max-w-4xl bg-white rounded-xl shadow-2xl p-10 relative">

        <!-- Exit Button -->
        <x-exit id="exit-loans" class="absolute top-4 right-4 text-red-600 hover:text-red-800 cursor-pointer" />

        <h2 class="text-2xl font-semibold text-center mb-8 text-gray-800">Add New Loan</h2>

        <!-- Input Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Loan Type -->
            <div class="flex flex-col">
                <label for="loan-type" class="font-semibold text-lg mb-2">Loan Type:</label>
                <select id="loan-type" name="loan-type"
                    class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
                    <option value="Student">Student</option>
                    <option value="Business">Business</option>
                    <option value="Secured">Secured</option>
                </select>
            </div>

            <!-- Principal Amount -->
            <div class="flex flex-col">
                <label for="principal-amount" class="font-semibold text-lg mb-2">Principal Amount:</label>
                <input type="number" id="principal-amount" name="principal-amount" value="0"
                    class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-400 transition" />
            </div>

            <!-- Interest Rate -->
            <div class="flex flex-col">
                <label for="interest-rate" class="font-semibold text-lg mb-2">Interest Rate:</label>
                <select id="interest-rate" name="interest-rate"
                    class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
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
            <div class="flex flex-col">
                <label for="loan-customer-id" class="font-semibold text-lg mb-2">Customer ID:</label>
                <input type="number" id="loan-customer-id" name="customer-id" value="0"
                    class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-400 transition" />
            </div>

            <!-- Start Date -->
            <div class="flex flex-col">
                <label for="start-date" class="font-semibold text-lg mb-2">Start Date:</label>
                <input type="date" id="start-date" name="start-date"
                    class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-400 transition" />
            </div>

            <!-- End Date -->
            <div class="flex flex-col">
                <label for="end-date" class="font-semibold text-lg mb-2">End Date:</label>
                <input type="date" id="end-date" name="end-date"
                    class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-400 transition" />
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-center mt-10">
            <button id="add-new-loan"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition shadow-md hover:shadow-lg">
                Add Loan
            </button>
        </div>
    </div>
</div>
