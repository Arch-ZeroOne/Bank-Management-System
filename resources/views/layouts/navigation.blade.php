<nav x-data="{ open: false }"
    class="bg-gradient-to-b from-slate-50 to-white backdrop-blur-xl 
           border-r border-slate-200/60 w-64 min-h-screen flex flex-col justify-between
           fixed shadow-xl shadow-slate-900/5"
    style="width: 25%;">

    <!-- Container -->
    <div class="px-5 py-6 flex flex-col h-full">

        <!-- Logo & Links -->
        <div class="flex flex-col gap-8">

            <!-- Logo -->
            <div class="flex justify-center mb-6">
                <a href="{{ route('dashboard') }}" class="group">
                    <div
                        class="p-3 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 shadow-lg shadow-indigo-500/25 group-hover:shadow-indigo-500/40 transition-all duration-300 group-hover:scale-105">
                        <x-application-logo class="h-8 w-auto text-white" />
                    </div>
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="flex flex-col space-y-1.5">
                <a href="{{ route('dashboard') }}"
                    class="group flex items-center gap-3 px-4 py-3.5 rounded-xl
                          text-slate-700 hover:text-indigo-700
                          hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 
                          transition-all duration-300 ease-out hover:translate-x-1
                          {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-indigo-100 to-purple-100 text-indigo-700 font-semibold shadow-sm' : '' }}">
                    <div
                        class="flex-shrink-0 w-5 h-5 flex items-center justify-center rounded-lg bg-gradient-to-br from-indigo-500 to-purple-600 text-white shadow-md group-hover:shadow-lg transition-shadow duration-300">
                        <i class="fa-solid fa-gauge text-xs"></i>
                    </div>
                    <span class="font-medium">Dashboard</span>
                    <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <i class="fa-solid fa-chevron-right text-xs text-slate-400"></i>
                    </div>
                </a>

                <a href="{{ route('user') }}"
                    class="group flex items-center gap-3 px-4 py-3.5 rounded-xl
                          text-slate-700 hover:text-indigo-700
                          hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 
                          transition-all duration-300 ease-out hover:translate-x-1
                          {{ request()->routeIs('user') ? 'bg-gradient-to-r from-indigo-100 to-purple-100 text-indigo-700 font-semibold shadow-sm' : '' }}">
                    <div
                        class="flex-shrink-0 w-5 h-5 flex items-center justify-center rounded-lg bg-gradient-to-br from-emerald-500 to-teal-600 text-white shadow-md group-hover:shadow-lg transition-shadow duration-300">
                        <i class="fa-solid fa-user text-xs"></i>
                    </div>
                    <span class="font-medium">Accounts</span>
                    <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <i class="fa-solid fa-chevron-right text-xs text-slate-400"></i>
                    </div>
                </a>

                <a href="{{ route('loanrequests') }}"
                    class="group flex items-center gap-3 px-4 py-3.5 rounded-xl
                          text-slate-700 hover:text-indigo-700
                          hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 
                          transition-all duration-300 ease-out hover:translate-x-1
                          {{ request()->routeIs('loanrequests') ? 'bg-gradient-to-r from-indigo-100 to-purple-100 text-indigo-700 font-semibold shadow-sm' : '' }}">
                    <div
                        class="flex-shrink-0 w-5 h-5 flex items-center justify-center rounded-lg bg-gradient-to-br from-amber-500 to-orange-600 text-white shadow-md group-hover:shadow-lg transition-shadow duration-300">
                        <i class="fa-solid fa-bell text-xs"></i>
                    </div>
                    <span class="font-medium">Loan Requests</span>
                    <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <i class="fa-solid fa-chevron-right text-xs text-slate-400"></i>
                    </div>
                </a>

                <a href="{{ route('loans') }}"
                    class="group flex items-center gap-3 px-4 py-3.5 rounded-xl
                          text-slate-700 hover:text-indigo-700
                          hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 
                          transition-all duration-300 ease-out hover:translate-x-1
                          {{ request()->routeIs('loans') ? 'bg-gradient-to-r from-indigo-100 to-purple-100 text-indigo-700 font-semibold shadow-sm' : '' }}">
                    <div
                        class="flex-shrink-0 w-5 h-5 flex items-center justify-center rounded-lg bg-gradient-to-br from-green-500 to-emerald-600 text-white shadow-md group-hover:shadow-lg transition-shadow duration-300">
                        <i class="fa-solid fa-money-check-dollar text-xs"></i>
                    </div>
                    <span class="font-medium">Loans</span>
                    <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <i class="fa-solid fa-chevron-right text-xs text-slate-400"></i>
                    </div>
                </a>

                <a href="{{ route('employees') }}"
                    class="group flex items-center gap-3 px-4 py-3.5 rounded-xl
                          text-slate-700 hover:text-indigo-700
                          hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 
                          transition-all duration-300 ease-out hover:translate-x-1
                          {{ request()->routeIs('employees') ? 'bg-gradient-to-r from-indigo-100 to-purple-100 text-indigo-700 font-semibold shadow-sm' : '' }}">
                    <div
                        class="flex-shrink-0 w-5 h-5 flex items-center justify-center rounded-lg bg-gradient-to-br from-blue-500 to-indigo-600 text-white shadow-md group-hover:shadow-lg transition-shadow duration-300">
                        <i class="fa-solid fa-user-tie text-xs"></i>
                    </div>
                    <span class="font-medium">Employees</span>
                    <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <i class="fa-solid fa-chevron-right text-xs text-slate-400"></i>
                    </div>
                </a>
            </div>
        </div>

        <!-- User Profile & Logout -->
        <div class="mt-auto border-t border-slate-200/60 pt-6">
            <!-- User Info Card -->
            <div class="bg-gradient-to-r from-slate-50 to-slate-100/50 rounded-2xl p-4 mb-4 shadow-sm">
                <div class="flex items-center gap-3">
                    <div class="flex-shrink-0 relative">
                        @if (Auth::user()->profile_photo_url)
                            <img src="{{ Auth::user()->profile_photo_url }}" alt="User Photo"
                                class="h-12 w-12 rounded-full object-cover ring-2 ring-indigo-500/20 shadow-md" />
                        @else
                            <div
                                class="h-12 w-12 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 ring-2 ring-indigo-500/20 shadow-md flex items-center justify-center">
                                <span class="text-white font-semibold text-sm">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}{{ strtoupper(substr(strstr(Auth::user()->name, ' '), 1, 1)) ?: strtoupper(substr(Auth::user()->name, 1, 1)) }}
                                </span>
                            </div>
                        @endif
                        <div
                            class="absolute -bottom-0.5 -right-0.5 w-4 h-4 bg-green-500 rounded-full ring-2 ring-white shadow-sm">
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-slate-900 font-semibold text-sm truncate">
                            {{ Auth::user()->name }}</p>
                        <p class="text-slate-500 text-xs truncate">{{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="space-y-1">
                <a href="{{ route('profile.edit') }}"
                    class="group flex items-center gap-3 w-full px-4 py-2.5 rounded-xl text-slate-700 hover:text-indigo-700 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 transition-all duration-300 font-medium">
                    <div
                        class="w-4 h-4 flex items-center justify-center rounded-md bg-slate-200 group-hover:bg-indigo-100 transition-colors duration-300">
                        <i class="fa-solid fa-user-gear text-xs"></i>
                    </div>
                    <span>Profile Settings</span>
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="group flex items-center gap-3 w-full px-4 py-2.5 rounded-xl text-slate-700 hover:text-red-600 hover:bg-gradient-to-r hover:from-red-50 hover:to-rose-50 transition-all duration-300 font-medium">
                        <div
                            class="w-4 h-4 flex items-center justify-center rounded-md bg-slate-200 group-hover:bg-red-100 transition-colors duration-300">
                            <i class="fa-solid fa-arrow-right-from-bracket text-xs"></i>
                        </div>
                        <span>Sign Out</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
