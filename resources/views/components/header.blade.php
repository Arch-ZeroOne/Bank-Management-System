<div class="flex items-center justify-center px-4 sm:px-6">
    <header
        class="flex items-center justify-between mt-6 mb-8 w-full max-w-7xl h-[80px] 
                   bg-gradient-to-r from-white/80 via-white/70 to-slate-50/80 
                   dark:from-slate-800/80 dark:via-slate-800/70 dark:to-slate-900/80 
                   backdrop-blur-xl shadow-xl shadow-slate-900/5 dark:shadow-slate-900/20
                   rounded-2xl px-8 border border-white/20 dark:border-slate-700/30
                   hover:shadow-2xl hover:shadow-slate-900/10 dark:hover:shadow-slate-900/30
                   transition-all duration-500 ease-out group">

        <!-- Title Section -->
        <div class="flex items-center gap-4">
            <div class="hidden sm:flex w-1 h-12 bg-gradient-to-b from-indigo-500 to-purple-600 rounded-full shadow-md">
            </div>
            <div class="flex flex-col">
                <h1 class="font-bold text-2xl sm:text-3xl text-slate-800 dark:text-white tracking-tight
                          bg-gradient-to-r from-slate-800 to-slate-600 dark:from-white dark:to-slate-200 
                          bg-clip-text text-transparent group-hover:from-indigo-600 group-hover:to-purple-600
                          transition-all duration-500"
                    style="font-family: 'Inter', 'Rubik', sans-serif;">
                    {{ $location }}
                </h1>
                <div class="flex items-center gap-2 mt-1">
                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse shadow-md shadow-green-500/50"></div>
                    <span class="text-xs text-slate-500 dark:text-slate-400 font-medium">
                        Live Dashboard
                    </span>
                </div>
            </div>
        </div>

        <!-- Right Section -->
        <div class="flex items-center gap-6">
            <!-- Status Badge -->
            <div
                class="hidden md:flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-emerald-50 to-green-50 
                        dark:from-emerald-900/20 dark:to-green-900/20 rounded-full border border-emerald-200/50 
                        dark:border-emerald-700/50 shadow-sm">
                <div class="w-2 h-2 bg-emerald-500 rounded-full shadow-md shadow-emerald-500/50"></div>
                <span class="text-xs font-semibold text-emerald-700 dark:text-emerald-300">
                    System Online
                </span>
            </div>

            <!-- Last Updated -->
            <div class="hidden sm:flex flex-col items-end">
                <div class="flex items-center gap-2 text-slate-600 dark:text-slate-300">
                    <i class="fa-solid fa-clock text-xs text-slate-400"></i>
                    <span class="text-sm font-medium">Last Updated</span>
                </div>
                <div class="flex items-center gap-1 text-xs text-slate-500 dark:text-slate-400">
                    <span>Today</span>
                    <span class="w-1 h-1 bg-slate-400 rounded-full"></span>
                    <span id="current-time">{{ date('H:i') }}</span>
                </div>
            </div>

            <!-- Action Button -->
            <button
                class="group/btn flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-indigo-500 to-purple-600 
                          hover:from-indigo-600 hover:to-purple-700 text-white rounded-xl shadow-lg shadow-indigo-500/25 
                          hover:shadow-indigo-500/40 transition-all duration-300 hover:scale-105 font-medium text-sm">
                <i class="fa-solid fa-rotate text-xs group-hover/btn:rotate-180 transition-transform duration-500"></i>
                <span class="hidden sm:inline">Refresh</span>
            </button>
        </div>
    </header>
</div>

<script>
    // Update time every minute
    function updateTime() {
        const now = new Date();
        const timeString = now.toLocaleTimeString('en-US', {
            hour12: false,
            hour: '2-digit',
            minute: '2-digit'
        });
        document.getElementById('current-time').textContent = timeString;
    }

    // Update immediately and then every minute
    updateTime();
    setInterval(updateTime, 60000);
</script>
