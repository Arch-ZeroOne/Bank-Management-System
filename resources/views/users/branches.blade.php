<x-app-layout>
    <!-- Modern Background -->
    <div
        class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-100 
                dark:from-slate-900 dark:via-slate-800 dark:to-slate-900 
                relative overflow-hidden">

        <!-- Animated Background Elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <!-- Gradient Orbs -->
            <div
                class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-indigo-400/20 to-purple-600/20 
                        rounded-full blur-3xl animate-pulse">
            </div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-gradient-to-br from-emerald-400/20 to-teal-600/20 
                        rounded-full blur-3xl animate-pulse"
                style="animation-delay: 2s;"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 
                        bg-gradient-to-br from-blue-400/10 to-indigo-600/10 rounded-full blur-3xl animate-pulse"
                style="animation-delay: 4s;"></div>

            <!-- Floating Geometric Shapes -->
            <div class="absolute top-20 left-20 w-4 h-4 bg-indigo-500/30 rounded rotate-45 animate-bounce"
                style="animation-delay: 1s; animation-duration: 3s;"></div>
            <div class="absolute top-40 right-32 w-3 h-3 bg-purple-500/30 rounded-full animate-bounce"
                style="animation-delay: 2s; animation-duration: 4s;"></div>
            <div class="absolute bottom-32 left-1/4 w-2 h-8 bg-emerald-500/30 rounded-full animate-bounce"
                style="animation-delay: 3s; animation-duration: 5s;"></div>
        </div>

        <!-- Header -->
        <x-header location="Users" />

        <!-- Main Content Container -->
        <div class="relative z-10 px-4 sm:px-6 lg:px-8 pb-12">
            <!-- Content Card -->
            <div class="max-w-7xl mx-auto">
                <!-- Top Action Bar -->
                <div class="flex items-center justify-between mb-8">
                    <!-- Page Stats/Info -->
                    <div class="flex items-center gap-6">
                        <div
                            class="hidden sm:flex items-center gap-4 px-6 py-3 bg-white/60 dark:bg-slate-800/60 
                                    backdrop-blur-xl rounded-2xl border border-white/20 dark:border-slate-700/30 
                                    shadow-lg shadow-slate-900/5 dark:shadow-slate-900/20">
                            <div class="flex items-center gap-2">
                                <div
                                    class="w-3 h-3 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full shadow-md">
                                </div>
                                <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Active Users</span>
                            </div>
                            <div class="w-px h-6 bg-slate-200 dark:bg-slate-600"></div>
                            <span class="text-sm font-semibold text-slate-800 dark:text-slate-200">
                                <span id="user-count">Loading...</span>
                            </span>
                        </div>
                    </div>

                    <!-- Add Button -->
                    <div class="flex items-center gap-3">
                        <!-- Search/Filter Button -->
                        <button
                            class="hidden md:flex items-center gap-2 px-4 py-2.5 bg-white/60 dark:bg-slate-800/60 
                                      backdrop-blur-xl border border-white/20 dark:border-slate-700/30 rounded-xl 
                                      text-slate-700 dark:text-slate-300 hover:bg-white/80 dark:hover:bg-slate-800/80 
                                      transition-all duration-300 font-medium text-sm shadow-lg shadow-slate-900/5 
                                      dark:shadow-slate-900/20 hover:shadow-xl hover:scale-105">
                            <i class="fa-solid fa-filter text-xs"></i>
                            <span>Filter</span>
                        </button>

                        <!-- Enhanced Add Button -->
                        <div class="relative">
                            <x-buttons.add title="Add new" id="add" />
                            <!-- Add a modern wrapper if the button needs styling -->
                            <style>
                                #add {
                                    background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%) !important;
                                    padding: 0.75rem 1.5rem !important;
                                    border-radius: 0.75rem !important;
                                    font-weight: 600 !important;
                                    font-size: 0.875rem !important;
                                    color: white !important;
                                    border: none !important;
                                    box-shadow: 0 10px 25px -12px rgba(99, 102, 241, 0.4) !important;
                                    transition: all 0.3s ease !important;
                                    display: flex !important;
                                    align-items: center !important;
                                    gap: 0.5rem !important;
                                }

                                #add:hover {
                                    background: linear-gradient(135deg, #5855f7 0%, #7c3aed 100%) !important;
                                    transform: translateY(-2px) scale(1.05) !important;
                                    box-shadow: 0 20px 35px -12px rgba(99, 102, 241, 0.6) !important;
                                }

                                #add:before {
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
                    class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl rounded-2xl 
                            border border-white/20 dark:border-slate-700/30 
                            shadow-2xl shadow-slate-900/10 dark:shadow-slate-900/30 
                            overflow-hidden">
                    <!-- Table Header -->
                    <div
                        class="px-6 py-4 border-b border-slate-200/50 dark:border-slate-700/50 
                                bg-gradient-to-r from-slate-50/50 to-white/50 dark:from-slate-800/50 dark:to-slate-700/50">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-2 h-8 bg-gradient-to-b from-indigo-500 to-purple-600 rounded-full"></div>
                                <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-200">
                                    User Management
                                </h3>
                            </div>
                            <div class="hidden sm:flex items-center gap-2 text-xs text-slate-500 dark:text-slate-400">
                                <i class="fa-solid fa-database"></i>
                                <span>Real-time data</span>
                            </div>
                        </div>
                    </div>

                    <!-- Table Content -->
                    <div class="p-6">
                        <table id="branchesTable" class="display text-white mdl-data-table w-full">
                            <!-- Your existing table structure -->
                        </table>
                    </div>
                </div>

                <!-- Footer Stats -->
                <div class="mt-8 grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div
                        class="bg-white/40 dark:bg-slate-800/40 backdrop-blur-xl rounded-2xl p-4 
                                border border-white/20 dark:border-slate-700/30 text-center">
                        <div class="text-2xl font-bold text-slate-800 dark:text-slate-200">--</div>
                        <div class="text-sm text-slate-600 dark:text-slate-400">Total Users</div>
                    </div>
                    <div
                        class="bg-white/40 dark:bg-slate-800/40 backdrop-blur-xl rounded-2xl p-4 
                                border border-white/20 dark:border-slate-700/30 text-center">
                        <div class="text-2xl font-bold text-emerald-600 dark:text-emerald-400">--</div>
                        <div class="text-sm text-slate-600 dark:text-slate-400">Active Today</div>
                    </div>
                    <div
                        class="bg-white/40 dark:bg-slate-800/40 backdrop-blur-xl rounded-2xl p-4 
                                border border-white/20 dark:border-slate-700/30 text-center">
                        <div class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">--</div>
                        <div class="text-sm text-slate-600 dark:text-slate-400">New This Week</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Optional: Add some interactivity
        document.addEventListener('DOMContentLoaded', function() {
            // Simulate user count (replace with actual data)
            document.getElementById('user-count').textContent = '1,247';

            // Add smooth scroll behavior for better UX
            document.documentElement.style.scrollBehavior = 'smooth';
        });
    </script>
</x-app-layout>
