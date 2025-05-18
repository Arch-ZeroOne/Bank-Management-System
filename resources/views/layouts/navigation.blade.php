<nav x-data="{ open: false }" class="bg-[#EFEFEF] shadow-xl   border-b border-gray-100 dark:border-gray-700 "
    style="width:25%">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-5">
        <div class="flex justify-between h-16 flex-col  ">
            <div class="flex flex-col item-center  gap-5  ">
                <!-- Logo -->
                <div class="shrink-0 flex self-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="flex gap-5 flex-col">
                    <div class=" sm:-my-px sm:ms-10 sm:flex flex items-center gap-1" style="margin-left: 0;">
                        <i class="fa-solid fa-gauge"></i>
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                    </div>
                    <div class=" sm:-my-px sm:ms-10 sm:flex flex items-center gap-1" style="margin-left: 0">
                        <i class="fa-solid fa-user"></i>
                        <x-nav-link :href="route('user')" :active="request()->routeIs('user')">
                            {{ __('Accounts') }}
                        </x-nav-link>
                    </div>
                    <div class="  sm:-my-px sm:ms-10 sm:flex flex items-center gap-1" style="margin-left: 0">
                        <i class="fa-solid fa-bell"></i>
                        <x-nav-link :href="route('loanrequests')" :active="request()->routeIs('loanrequests')">
                            {{ __('Loan Requests') }}
                        </x-nav-link>
                    </div>
                    <div class="  sm:-my-px sm:ms-10 sm:flex flex items-center gap-1" style="margin-left: 0">
                        <i class="fa-solid fa-landmark"></i>
                        <x-nav-link :href="route('loans')" :active="request()->routeIs('loans')">
                            {{ __('Loans') }}
                        </x-nav-link>
                    </div>
                    <div class="  sm:-my-px sm:ms-10 sm:flex flex items-center gap-1" style="margin-left: 0">
                        <i class="fa-solid fa-bars-staggered"></i>
                        <x-nav-link :href="route('transactions')" :active="request()->routeIs('transactions')">
                            {{ __('Transactions') }}
                        </x-nav-link>
                    </div>
                </div>



            </div>





            <!-- Responsive Navigation Menu -->
            <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>
                </div>

                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                    <div class="px-4">
                        <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}
                        </div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <x-responsive-nav-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-responsive-nav-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-responsive-nav-link>
                        </form>
                    </div>
                </div>
            </div>
</nav>
