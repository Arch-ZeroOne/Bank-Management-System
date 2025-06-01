<x-app-layout>
    <!-- Modern Light Background -->
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-blue-50 relative overflow-hidden">

        <!-- Animated Background Elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <!-- Gradient Orbs -->
            <div
                class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-indigo-300/15 to-purple-400/15 
                        rounded-full blur-3xl animate-pulse">
            </div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-gradient-to-br from-emerald-300/15 to-teal-400/15 
                        rounded-full blur-3xl animate-pulse"
                style="animation-delay: 2s;"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 
                        bg-gradient-to-br from-blue-300/10 to-indigo-400/10 rounded-full blur-3xl animate-pulse"
                style="animation-delay: 4s;"></div>

            <!-- Floating Geometric Shapes -->
            <div class="absolute top-20 left-20 w-4 h-4 bg-indigo-400/25 rounded rotate-45 animate-bounce"
                style="animation-delay: 1s; animation-duration: 3s;"></div>
            <div class="absolute top-40 right-32 w-3 h-3 bg-purple-400/25 rounded-full animate-bounce"
                style="animation-delay: 2s; animation-duration: 4s;"></div>
            <div class="absolute bottom-32 left-1/4 w-2 h-8 bg-emerald-400/25 rounded-full animate-bounce"
                style="animation-delay: 3s; animation-duration: 5s;"></div>
        </div>

        <!-- Header -->
        <x-header location="Loans" />

        <!-- Main Content Container -->
        <div class="relative z-10 px-4 sm:px-6 lg:px-8 pb-12">
            <!-- Content Card -->
            <div class="max-w-7xl mx-auto">
                <!-- Top Action Bar -->
                <div class="flex items-center justify-between mb-8">
                    <!-- Page Stats/Info -->
                    <div class="flex items-center gap-6">
                        <div
                            class="hidden sm:flex items-center gap-4 px-6 py-3 bg-white/80 backdrop-blur-xl 
                                    rounded-2xl border border-slate-200/50 shadow-lg shadow-slate-900/5">
                            <div class="flex items-center gap-2">
                                <div
                                    class="w-3 h-3 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-full shadow-md">
                                </div>
                                <span class="text-sm font-medium text-slate-700">Active Loans</span>
                            </div>
                            <div class="w-px h-6 bg-slate-300"></div>
                            <span class="text-sm font-semibold text-slate-800">
                                <span id="loan-count">Loading...</span>
                            </span>
                        </div>
                    </div>

                    <!-- Add Button -->
                    <div class="flex items-center gap-3">
                        <!-- Search/Filter Button -->
                        <button
                            class="hidden md:flex items-center gap-2 px-4 py-2.5 bg-white/80 backdrop-blur-xl 
                                      border border-slate-200/50 rounded-xl text-slate-700 hover:bg-white/95 
                                      hover:border-slate-300/60 transition-all duration-300 font-medium text-sm 
                                      shadow-lg shadow-slate-900/5 hover:shadow-xl hover:scale-105">
                            <i class="fa-solid fa-filter text-xs"></i>
                            <span>Filter</span>
                        </button>

                        <!-- Enhanced Add Loan Button -->
                        <div class="relative">
                            <x-buttons.add title="add-loan" id="add-loan" />
                            <!-- Modern light mode button styling with loan theme -->
                            <style>
                                #add-loan {
                                    background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
                                    padding: 0.75rem 1.5rem !important;
                                    border-radius: 0.75rem !important;
                                    font-weight: 600 !important;
                                    font-size: 0.875rem !important;
                                    color: white !important;
                                    border: none !important;
                                    box-shadow: 0 10px 25px -12px rgba(16, 185, 129, 0.4) !important;
                                    transition: all 0.3s ease !important;
                                    display: flex !important;
                                    align-items: center !important;
                                    gap: 0.5rem !important;
                                }

                                #add-loan:hover {
                                    background: linear-gradient(135deg, #059669 0%, #047857 100%) !important;
                                    transform: translateY(-2px) scale(1.05) !important;
                                    box-shadow: 0 20px 35px -12px rgba(16, 185, 129, 0.6) !important;
                                }

                                #add-loan:before {
                                    content: '\f067';
                                    font-family: 'Font Awesome 6 Free';
                                    font-weight: 900;
                                    font-size: 0.75rem;
                                }
                            </style>
                        </div>
                    </div>
                </div>

                <!-- Table Container -->
                <div
                    class="bg-white/85 backdrop-blur-xl rounded-2xl border border-slate-200/60 
                            shadow-2xl shadow-slate-900/10 overflow-hidden">
                    <!-- Table Header -->
                    <div class="px-6 py-4 border-b border-slate-200/70 bg-gradient-to-r from-slate-50/80 to-white/80">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-2 h-8 bg-gradient-to-b from-emerald-500 to-teal-600 rounded-full"></div>
                                <h3 class="text-lg font-semibold text-slate-800">
                                    Loan Management
                                </h3>
                            </div>
                            <div class="hidden sm:flex items-center gap-2 text-xs text-slate-500">
                                <i class="fa-solid fa-database"></i>
                                <span>Real-time data</span>
                            </div>
                        </div>
                    </div>

                    <!-- Table Content -->
                    <div class="p-6">
                        <div class="w-full flex justify-center">
                            <table id="loansTable" class="display text-slate-700 mdl-data-table w-full">
                                <!-- Your existing table structure -->
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Footer Stats -->
                <div class="mt-8 grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div
                        class="bg-white/70 backdrop-blur-xl rounded-2xl p-4 border border-slate-200/50 text-center 
                                shadow-lg shadow-slate-900/5">
                        <div class="text-2xl font-bold text-slate-800">--</div>
                        <div class="text-sm text-slate-600">Total Loans</div>
                    </div>
                    <div
                        class="bg-white/70 backdrop-blur-xl rounded-2xl p-4 border border-slate-200/50 text-center 
                                shadow-lg shadow-slate-900/5">
                        <div class="text-2xl font-bold text-emerald-600">--</div>
                        <div class="text-sm text-slate-600">Active Loans</div>
                    </div>
                    <div
                        class="bg-white/70 backdrop-blur-xl rounded-2xl p-4 border border-slate-200/50 text-center 
                                shadow-lg shadow-slate-900/5">
                        <div class="text-2xl font-bold text-blue-600">₱--</div>
                        <div class="text-sm text-slate-600">Total Amount</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Optional: Add some interactivity
        document.addEventListener('DOMContentLoaded', function() {
            // Simulate loan count (replace with actual data)
            document.getElementById('loan-count').textContent = '342';

            // Add smooth scroll behavior for better UX
            document.documentElement.style.scrollBehavior = 'smooth';
        });
    </script>
</x-app-layout>
