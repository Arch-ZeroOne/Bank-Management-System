<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Employee Form - Redesigned</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'float': 'float 3s ease-in-out infinite',
                        'glow-pulse': 'glowPulse 2s ease-in-out infinite alternate',
                        'slide-in': 'slideIn 0.6s ease-out',
                        'bounce-soft': 'bounceSoft 1s ease-out',
                        'shimmer': 'shimmer 2s linear infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': {
                                transform: 'translateY(0px)'
                            },
                            '50%': {
                                transform: 'translateY(-10px)'
                            }
                        },
                        glowPulse: {
                            '0%': {
                                boxShadow: '0 0 20px rgba(34, 197, 94, 0.4), 0 0 40px rgba(34, 197, 94, 0.2)'
                            },
                            '100%': {
                                boxShadow: '0 0 30px rgba(34, 197, 94, 0.6), 0 0 60px rgba(34, 197, 94, 0.3)'
                            }
                        },
                        slideIn: {
                            '0%': {
                                transform: 'translateX(-100px)',
                                opacity: '0'
                            },
                            '100%': {
                                transform: 'translateX(0)',
                                opacity: '1'
                            }
                        },
                        bounceSoft: {
                            '0%': {
                                transform: 'scale(0.8)',
                                opacity: '0'
                            },
                            '50%': {
                                transform: 'scale(1.05)'
                            },
                            '100%': {
                                transform: 'scale(1)',
                                opacity: '1'
                            }
                        },
                        shimmer: {
                            '0%': {
                                transform: 'translateX(-100%)'
                            },
                            '100%': {
                                transform: 'translateX(100%)'
                            }
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .glass-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.05) 100%);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        .input-glow:focus {
            box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.3), 0 8px 25px rgba(34, 197, 94, 0.2);
        }

        .floating-shapes::before {
            content: '';
            position: absolute;
            top: 10%;
            left: 10%;
            width: 100px;
            height: 100px;
            background: linear-gradient(45deg, #10b981, #059669);
            border-radius: 50%;
            opacity: 0.1;
            animation: float 4s ease-in-out infinite;
        }

        .floating-shapes::after {
            content: '';
            position: absolute;
            bottom: 15%;
            right: 15%;
            width: 150px;
            height: 150px;
            background: linear-gradient(45deg, #0891b2, #0e7490);
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            opacity: 0.1;
            animation: float 3s ease-in-out infinite reverse;
        }
    </style>
</head>

<body
    class="min-h-screen bg-gradient-to-br from-gray-900 via-green-900 to-cyan-900 flex items-center justify-center p-4 relative overflow-hidden">

    <!-- Floating background shapes -->
    <div class="floating-shapes fixed inset-0 pointer-events-none"></div>

    <!-- Animated particles -->
    <div class="fixed inset-0 pointer-events-none">
        <div class="absolute top-1/4 left-1/4 w-2 h-2 bg-green-400/30 rounded-full animate-ping"></div>
        <div class="absolute top-3/4 left-3/4 w-3 h-3 bg-cyan-400/20 rounded-full animate-pulse"
            style="animation-delay: 1s;"></div>
        <div class="absolute top-1/2 right-1/4 w-1 h-1 bg-emerald-400/40 rounded-full animate-bounce"
            style="animation-delay: 2s;"></div>
    </div>

    <!-- Main Modal Container -->
    <div class="fixed inset-0 z-50 bg-black/40 backdrop-blur-sm flex items-center justify-center p-4 invisible"
        id="update-employee-modal">
        <div
            class="w-full max-w-6xl glass-card rounded-3xl shadow-2xl p-8 relative animate-bounce-soft overflow-hidden">

            <!-- Shimmer effect overlay -->
            <div class="absolute inset-0 pointer-events-none overflow-hidden rounded-3xl">
                <div
                    class="absolute inset-0 bg-gradient-to-r from-transparent via-white/5 to-transparent -skew-x-12 animate-shimmer">
                </div>
            </div>

            <!-- Close Button -->
            <button id="closeEmployeeFormV2"
                class="absolute top-6 right-6 z-10 w-12 h-12 bg-red-500/20 hover:bg-red-500/30 backdrop-blur-sm rounded-xl flex items-center justify-center text-red-400 hover:text-red-300 transition-all duration-300 hover:scale-110 hover:rotate-90 group">
                <svg class="w-6 h-6 group-hover:animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>

            <div class="relative z-10">
                <!-- Header Section -->
                <div class="text-center mb-12 animate-slide-in">
                    <div class="inline-flex items-center gap-4 mb-4">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-green-400 to-cyan-500 rounded-2xl flex items-center justify-center animate-float">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <input id="employee-id" class="invisible">
                        <h2
                            class="text-5xl font-black bg-gradient-to-r from-green-400 via-cyan-400 to-blue-400 bg-clip-text text-transparent">
                            Update Employee
                        </h2>
                    </div>
                    <p class="text-white/70 text-lg font-medium">Join our amazing team today</p>
                    <div class="w-32 h-1 bg-gradient-to-r from-green-400 to-cyan-400 mx-auto mt-4 rounded-full"></div>
                </div>

                <!-- Form Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-10">

                    <!-- First Name -->
                    <div class="space-y-3 group">
                        <label for="employeeFirstNameV2"
                            class="flex items-center gap-2 text-white/90 font-bold text-sm uppercase tracking-wider group-hover:text-green-300 transition-colors">
                            <div class="w-2 h-2 bg-green-400 rounded-full group-hover:animate-ping"></div>
                            First Name
                        </label>
                        <div class="relative">
                            <input type="text" id="employeeFirstNameV2" name="firstName"
                                class="w-full bg-white/5 backdrop-blur-sm border-2 border-white/10 rounded-xl p-4 text-white placeholder-white/40 focus:outline-none focus:border-green-400/50 input-glow transition-all duration-300 hover:bg-white/10 hover:border-white/20"
                                placeholder="John" />
                            <div
                                class="absolute inset-0 rounded-xl bg-gradient-to-r from-green-400/0 to-cyan-400/0 group-hover:from-green-400/5 group-hover:to-cyan-400/5 transition-all duration-500 pointer-events-none">
                            </div>
                        </div>
                    </div>

                    <!-- Last Name -->
                    <div class="space-y-3 group">
                        <label for="employeeLastNameV2"
                            class="flex items-center gap-2 text-white/90 font-bold text-sm uppercase tracking-wider group-hover:text-cyan-300 transition-colors">
                            <div class="w-2 h-2 bg-cyan-400 rounded-full group-hover:animate-ping"></div>
                            Last Name
                        </label>
                        <div class="relative">
                            <input type="text" id="employeeLastNameV2" name="lastName"
                                class="w-full bg-white/5 backdrop-blur-sm border-2 border-white/10 rounded-xl p-4 text-white placeholder-white/40 focus:outline-none focus:border-cyan-400/50 input-glow transition-all duration-300 hover:bg-white/10 hover:border-white/20"
                                placeholder="Doe" />
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="space-y-3 group">
                        <label for="employeeEmailV2"
                            class="flex items-center gap-2 text-white/90 font-bold text-sm uppercase tracking-wider group-hover:text-blue-300 transition-colors">
                            <div class="w-2 h-2 bg-blue-400 rounded-full group-hover:animate-ping"></div>
                            Email Address
                        </label>
                        <div class="relative">
                            <input type="email" id="employeeEmailV2" name="email"
                                class="w-full bg-white/5 backdrop-blur-sm border-2 border-white/10 rounded-xl p-4 pr-12 text-white placeholder-white/40 focus:outline-none focus:border-blue-400/50 input-glow transition-all duration-300 hover:bg-white/10 hover:border-white/20"
                                placeholder="john.doe@company.com" />
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
                    <div class="space-y-3 group">
                        <label for="employeePhoneV2"
                            class="flex items-center gap-2 text-white/90 font-bold text-sm uppercase tracking-wider group-hover:text-teal-300 transition-colors">
                            <div class="w-2 h-2 bg-teal-400 rounded-full group-hover:animate-ping"></div>
                            Phone Number
                        </label>
                        <div class="relative">
                            <input type="tel" id="employeePhoneV2" name="phone"
                                class="w-full bg-white/5 backdrop-blur-sm border-2 border-white/10 rounded-xl p-4 pr-12 text-white placeholder-white/40 focus:outline-none focus:border-teal-400/50 input-glow transition-all duration-300 hover:bg-white/10 hover:border-white/20"
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
                    <div class="space-y-3 group">
                        <label for="employeePositionV2"
                            class="flex items-center gap-2 text-white/90 font-bold text-sm uppercase tracking-wider group-hover:text-emerald-300 transition-colors">
                            <div class="w-2 h-2 bg-emerald-400 rounded-full group-hover:animate-ping"></div>
                            Position
                        </label>
                        <div class="relative">
                            <select id="employeePositionV2" name="position"
                                class="w-full bg-white/5 backdrop-blur-sm border-2 border-white/10 rounded-xl p-4 pr-12 text-white focus:outline-none focus:border-emerald-400/50 input-glow transition-all duration-300 hover:bg-white/10 hover:border-white/20 appearance-none cursor-pointer">
                                <option value="" class="bg-gray-800 text-white">Select Position</option>
                                <option value="Customer Service" class="bg-gray-800 text-white">Customer Service
                                </option>
                                <option value="Personal Banker" class="bg-gray-800 text-white">Personal Banker
                                </option>
                                <option value="Loan Officer" class="bg-gray-800 text-white">Loan Officer</option>
                                <option value="Bank Teller" class="bg-gray-800 text-white">Bank Teller</option>
                                <option value="Branch Manager" class="bg-gray-800 text-white">Branch Manager</option>
                                <option value="Financial Advisor" class="bg-gray-800 text-white">Financial Advisor
                                </option>
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
                    <div class="space-y-3 group">
                        <label for="employeeHireDateV2"
                            class="flex items-center gap-2 text-white/90 font-bold text-sm uppercase tracking-wider group-hover:text-yellow-300 transition-colors">
                            <div class="w-2 h-2 bg-yellow-400 rounded-full group-hover:animate-ping"></div>
                            Hire Date
                        </label>
                        <div class="relative">
                            <input type="date" id="employeeHireDateV2" name="hireDate"
                                class="w-full bg-white/5 backdrop-blur-sm border-2 border-white/10 rounded-xl p-4 text-white focus:outline-none focus:border-yellow-400/50 input-glow transition-all duration-300 hover:bg-white/10 hover:border-white/20"
                                style="color-scheme: dark;" />
                        </div>
                    </div>
                </div>

                <!-- Branch ID - Full Width -->
                <div class="space-y-3 group mb-10">
                    <label for="employeeBranchIdV2"
                        class="flex items-center gap-2 text-white/90 font-bold text-sm uppercase tracking-wider group-hover:text-indigo-300 transition-colors">
                        <div class="w-2 h-2 bg-indigo-400 rounded-full group-hover:animate-ping"></div>
                        Branch ID
                    </label>
                    <div class="relative max-w-md mx-auto">
                        <input type="number" id="employeeBranchIdV2" name="branchId"
                            class="w-full bg-white/5 backdrop-blur-sm border-2 border-white/10 rounded-xl p-4 pr-12 text-white placeholder-white/40 focus:outline-none focus:border-indigo-400/50 input-glow transition-all duration-300 hover:bg-white/10 hover:border-white/20"
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

                <!-- Submit Button -->
                <div class="flex justify-center">
                    <button id="submitEmployeeFormV2"
                        class="group relative px-10 py-5 bg-gradient-to-r from-green-500 via-cyan-500 to-blue-500 text-white font-black text-xl rounded-2xl shadow-lg hover:shadow-2xl transform hover:scale-105 transition-all duration-300 animate-glow-pulse overflow-hidden">

                        <!-- Button glow effect -->
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-green-400 via-cyan-400 to-blue-400 opacity-0 group-hover:opacity-100 transition-opacity duration-300 blur-sm">
                        </div>

                        <!-- Button content -->
                        <div class="relative flex items-center gap-4">
                            <div
                                class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center group-hover:rotate-180 transition-transform duration-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </div>
                            <span class="uppercase tracking-wider">Update Employee</span>
                        </div>

                        <!-- Ripple effect -->
                        <div
                            class="absolute inset-0 rounded-2xl opacity-0 group-active:opacity-100 bg-white/10 transition-opacity duration-150">
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>


</body>

</html>
