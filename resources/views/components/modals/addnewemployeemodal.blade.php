<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Employee Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-up': 'slideUp 0.4s ease-out',
                        'pulse-glow': 'pulseGlow 2s infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': {
                                opacity: '0'
                            },
                            '100%': {
                                opacity: '1'
                            }
                        },
                        slideUp: {
                            '0%': {
                                transform: 'translateY(20px)',
                                opacity: '0'
                            },
                            '100%': {
                                transform: 'translateY(0)',
                                opacity: '1'
                            }
                        },
                        pulseGlow: {
                            '0%, 100%': {
                                boxShadow: '0 0 20px rgba(59, 130, 246, 0.3)'
                            },
                            '50%': {
                                boxShadow: '0 0 30px rgba(59, 130, 246, 0.6)'
                            }
                        }
                    }
                }
            }
        }
    </script>
</head>

<body
    class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 flex items-center justify-center p-4 ">

    <div class="fixed inset-0 z-50 bg-black/30 backdrop-blur-sm flex items-center justify-center invisible "
        id="addNewEmployeeModal">
        <div
            class="w-full max-w-5xl bg-white/10 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/20 p-8 relative animate-slide-up">

            <!-- Glassmorphism header -->
            <div class="absolute inset-x-0 top-0 h-32 bg-gradient-to-br from-blue-400/20 to-purple-600/20 rounded-t-3xl">
            </div>

            <!-- Exit Button -->
            <button id="exit-employee"
                class="absolute top-6 right-6 z-10 w-10 h-10 bg-red-500/20 hover:bg-red-500/40 backdrop-blur-sm rounded-full flex items-center justify-center text-red-400 hover:text-red-300 transition-all duration-300 hover:scale-110">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>

            <div class="relative z-10">
                <!-- Title with gradient text -->
                <div class="text-center mb-10">
                    <h2
                        class="text-4xl font-bold bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400 bg-clip-text text-transparent mb-2">
                        Add New Employee
                    </h2>
                    <div class="w-24 h-1 bg-gradient-to-r from-blue-400 to-purple-600 mx-auto rounded-full"></div>
                </div>

                <!-- Form Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">

                    <!-- First Name -->
                    <div class="group">
                        <label for="emp-first-name"
                            class="block text-white/90 font-semibold text-lg mb-3 group-hover:text-blue-300 transition-colors">
                            First Name
                        </label>
                        <div class="relative">
                            <input type="text" id="emp-first-name" name="first-name"
                                class="w-full bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-4 text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-blue-400/50 focus:border-blue-400/50 transition-all duration-300 hover:bg-white/15"
                                placeholder="Enter first name" />
                            <div
                                class="absolute inset-0 rounded-2xl bg-gradient-to-r from-blue-400/0 via-purple-400/0 to-pink-400/0 group-hover:from-blue-400/5 group-hover:via-purple-400/5 group-hover:to-pink-400/5 transition-all duration-500 pointer-events-none">
                            </div>
                        </div>
                    </div>

                    <!-- Last Name -->
                    <div class="group">
                        <label for="emp-last-name"
                            class="block text-white/90 font-semibold text-lg mb-3 group-hover:text-purple-300 transition-colors">
                            Last Name
                        </label>
                        <div class="relative">
                            <input type="text" id="emp-last-name" name="last-name"
                                class="w-full bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-4 text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-purple-400/50 focus:border-purple-400/50 transition-all duration-300 hover:bg-white/15"
                                placeholder="Enter last name" />
                            <div
                                class="absolute inset-0 rounded-2xl bg-gradient-to-r from-purple-400/0 via-pink-400/0 to-blue-400/0 group-hover:from-purple-400/5 group-hover:via-pink-400/5 group-hover:to-blue-400/5 transition-all duration-500 pointer-events-none">
                            </div>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="group">
                        <label for="emp-email"
                            class="block text-white/90 font-semibold text-lg mb-3 group-hover:text-pink-300 transition-colors">
                            Email Address
                        </label>
                        <div class="relative">
                            <input type="email" id="emp-email" name="email"
                                class="w-full bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-4 text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-pink-400/50 focus:border-pink-400/50 transition-all duration-300 hover:bg-white/15"
                                placeholder="employee@company.com" />
                            <div class="absolute right-4 top-1/2 transform -translate-y-1/2 text-white/30">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                                    </path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Phone Number -->
                    <div class="group">
                        <label for="emp-phone-number"
                            class="block text-white/90 font-semibold text-lg mb-3 group-hover:text-cyan-300 transition-colors">
                            Phone Number
                        </label>
                        <div class="relative">
                            <input type="tel" id="emp-phone-number" name="phone-number"
                                class="w-full bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-4 text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-cyan-400/50 focus:border-cyan-400/50 transition-all duration-300 hover:bg-white/15"
                                placeholder="+1 (555) 123-4567" />
                            <div class="absolute right-4 top-1/2 transform -translate-y-1/2 text-white/30">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Position -->
                    <div class="group">
                        <label for="emp-position"
                            class="block text-white/90 font-semibold text-lg mb-3 group-hover:text-green-300 transition-colors">
                            Position
                        </label>
                        <div class="relative">
                            <select id="emp-position" name="position"
                                class="w-full bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-4 text-white focus:outline-none focus:ring-2 focus:ring-green-400/50 focus:border-green-400/50 transition-all duration-300 hover:bg-white/15 appearance-none cursor-pointer">
                                <option value="" class="bg-slate-800">Select Position</option>
                                <option value="Customer Service" class="bg-slate-800">Customer Service</option>
                                <option value="Personal Banker" class="bg-slate-800">Personal Banker</option>
                                <option value="Loan Officer" class="bg-slate-800">Loan Officer</option>
                                <option value="Bank Teller" class="bg-slate-800">Bank Teller</option>
                                <option value="Branch Manager" class="bg-slate-800">Branch Manager</option>
                                <option value="Financial Advisor" class="bg-slate-800">Financial Advisor</option>
                            </select>
                            <div
                                class="absolute right-4 top-1/2 transform -translate-y-1/2 text-white/30 pointer-events-none">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Hire Date -->
                    <div class="group">
                        <label for="emp-hire-date"
                            class="block text-white/90 font-semibold text-lg mb-3 group-hover:text-yellow-300 transition-colors">
                            Hire Date
                        </label>
                        <div class="relative">
                            <input type="date" id="emp-hire-date" name="hire-date"
                                class="w-full bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-4 text-white focus:outline-none focus:ring-2 focus:ring-yellow-400/50 focus:border-yellow-400/50 transition-all duration-300 hover:bg-white/15"
                                style="color-scheme: dark;" />
                        </div>
                    </div>

                    <!-- Branch ID - spans full width on large screens -->
                    <div class="group lg:col-span-2">
                        <label for="emp-branch-id"
                            class="block text-white/90 font-semibold text-lg mb-3 group-hover:text-indigo-300 transition-colors">
                            Branch ID
                        </label>
                        <div class="relative max-w-md mx-auto lg:mx-0">
                            <input type="number" id="emp-branch-id" name="branch-id"
                                class="w-full bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-4 text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-indigo-400/50 focus:border-indigo-400/50 transition-all duration-300 hover:bg-white/15"
                                placeholder="Enter branch ID" min="1" />
                            <div class="absolute right-4 top-1/2 transform -translate-y-1/2 text-white/30">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                    </path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center">
                    <button id="confirm-add-employee"
                        class="group relative px-12 py-4 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 text-white font-bold text-lg rounded-2xl shadow-lg hover:shadow-2xl transform hover:scale-105 transition-all duration-300 animate-pulse-glow overflow-hidden">

                        <!-- Button background animation -->
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>

                        <!-- Button content -->
                        <div class="relative flex items-center gap-3">
                            <svg class="w-6 h-6 group-hover:rotate-12 transition-transform duration-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Add Employee
                        </div>

                        <!-- Ripple effect -->
                        <div
                            class="absolute inset-0 rounded-2xl opacity-0 group-active:opacity-100 bg-white/20 transition-opacity duration-150">
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>


</body>

</html>
