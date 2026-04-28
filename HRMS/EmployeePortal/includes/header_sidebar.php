<div id="sidebarOverlay" class="fixed inset-0 z-40 bg-slate-950/30 opacity-0 pointer-events-none transition-opacity duration-300 lg:hidden"></div>

<!-- Sidebar -->
<aside id="appSidebar" class="sidebar-shell fixed inset-y-0 left-0 z-50 flex w-64 -translate-x-full flex-col border-r border-slate-200 bg-white transition-all duration-300 ease-out lg:translate-x-0">
    <div class="border-b border-slate-100 p-6">
        <div class="flex items-center gap-3 text-indigo-600">
            <div class="sidebar-brand-icon flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-600 text-white">
                <i class="fa-solid fa-bolt-lightning text-xl"></i>
            </div>
            <span class="sidebar-brand-text font-bold text-xl tracking-tight text-slate-800">HRMS Pro</span>
        </div>
    </div>

    <div class="min-h-0 flex-1 px-2 py-4">
        <div id="sidebarMenuScroll" class="sidebar-scroll-area min-h-0 h-full overflow-y-auto px-1">
            <?php include __DIR__ . '/menu.php'; ?>
        </div>
    </div>
</aside>

<!-- Main Content Area -->
<main id="dashboardMain" class="min-w-0 flex-grow transition-all duration-300 lg:ml-64">
    <!-- Top Header -->
    <header class="sticky top-0 z-40 bg-white/80 backdrop-blur-md border-b border-slate-200 px-4 md:px-8 py-4 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <button type="button" id="sidebarToggle" class="flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-500 transition-colors hover:bg-slate-50 hover:text-indigo-600 lg:hidden">
                <i class="fa-solid fa-bars-staggered"></i>
            </button>
            <div class="flex items-center rounded-xl border border-slate-200 bg-slate-100 px-4 py-2.5 focus-within:ring-2 focus-within:ring-indigo-500 transition-all w-full max-w-xl">
                <i class="fa-solid fa-magnifying-glass text-slate-400 mr-3 text-sm"></i>
                <input type="text" placeholder="Search employee..." class="w-full bg-transparent border-none outline-none text-sm text-slate-600">
            </div>
        </div>

        <div class="flex items-center gap-3 md:gap-6">
            <div class="flex items-center gap-2 md:gap-4">
                <div class="relative group">
                    <button class="p-2.5 text-slate-500 hover:bg-slate-100 rounded-xl transition-colors">
                        <i class="fa-solid fa-bell"></i>
                        <span class="absolute top-2.5 right-2.5 w-2 h-2 bg-rose-500 rounded-full border-2 border-white"></span>
                    </button>
                </div>

                <div class="h-8 w-[1px] bg-slate-200 mx-1"></div>

                <div class="flex items-center gap-3 cursor-pointer group">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-bold text-slate-700 group-hover:text-indigo-600 transition-colors"><?= isset($headerUserName) ? htmlspecialchars($headerUserName) : 'Cali Maxamed'; ?></p>
                        <p class="text-[10px] text-slate-400"><?= isset($headerUserRole) ? htmlspecialchars($headerUserRole) : 'Admin Account'; ?></p>
                    </div>
                    <img src="<?= isset($headerUserAvatar) ? htmlspecialchars($headerUserAvatar) : 'https://api.dicebear.com/7.x/avataaars/svg?seed=Ahmed'; ?>" alt="<?= isset($headerUserName) ? htmlspecialchars($headerUserName) : 'Admin'; ?>" class="w-10 h-10 rounded-xl bg-slate-100 border border-slate-200 shadow-sm">
                    <i class="fa-solid fa-chevron-down text-[10px] text-slate-400 hidden sm:block"></i>
                </div>
            </div>
        </div>
    </header>
