<style>
    body {
        background:
            radial-gradient(circle at top left, rgba(14, 165, 233, 0.12), transparent 30%),
            radial-gradient(circle at top right, rgba(236, 72, 153, 0.1), transparent 28%),
            linear-gradient(135deg, #f8fafc 0%, #eef2ff 48%, #fff7ed 100%);
    }

    .sidebar-link:hover {
        background: linear-gradient(135deg, rgba(14, 165, 233, 0.12), rgba(236, 72, 153, 0.1));
        color: #0f766e;
    }

    .sidebar-link.active {
        background: linear-gradient(135deg, #0ea5e9, #6366f1 55%, #ec4899);
        color: #ffffff;
        box-shadow: 0 12px 24px -16px rgba(99, 102, 241, 0.8);
    }

    button:not(:disabled) {
        background: #cde9f8 !important;
        border-color: #cde9f8 !important;
        color: #0f172a !important;
        box-shadow: 0 12px 24px -16px rgba(14, 165, 233, 0.55);
    }

    button:not(:disabled):hover {
        filter: brightness(1.04);
        box-shadow: 0 16px 30px -18px rgba(14, 165, 233, 0.6);
    }

    button:not(:disabled) i,
    button:not(:disabled) span {
        color: inherit !important;
    }

    header button:not(:disabled) {
        background: #ffffff !important;
        border-color: #e2e8f0 !important;
        color: #64748b !important;
        box-shadow: none !important;
    }

    header button:not(:disabled):hover {
        background: #ffffff !important;
        filter: none;
        box-shadow: none !important;
    }

    .action-menu,
    .ranking-action-menu {
        background: #ffffff !important;
        border-color: #e2e8f0 !important;
        box-shadow: 0 20px 40px -24px rgba(15, 23, 42, 0.35);
    }

    .action-menu a,
    .action-menu button:not(:disabled),
    .ranking-action-menu a,
    .ranking-action-menu button:not(:disabled) {
        background: #ffffff !important;
        border-color: transparent !important;
        color: #0f172a !important;
        box-shadow: none !important;
    }

    .ranking-action-toggle:not(:disabled),
    .table-scroll td:last-child button:not(:disabled),
    button[class*="action"]:not(:disabled),
    button[class*="view-"]:not(:disabled),
    button[class*="approve"]:not(:disabled),
    button[class*="reject"]:not(:disabled) {
        background: #cde9f8 !important;
        border-color: #cde9f8 !important;
        color: #0f172a !important;
        box-shadow: 0 12px 24px -16px rgba(14, 165, 233, 0.55);
    }

    .action-menu a:hover,
    .action-menu button:not(:disabled):hover,
    .ranking-action-menu a:hover,
    .ranking-action-menu button:not(:disabled):hover {
        background: #cde9f8 !important;
        filter: none;
        box-shadow: none !important;
    }

    .ranking-action-toggle:not(:disabled):hover,
    .table-scroll td:last-child button:not(:disabled):hover {
        background: #cde9f8 !important;
        filter: none;
    }

    .action-menu a,
    .action-menu button:not(:disabled),
    .ranking-action-menu a,
    .ranking-action-menu button:not(:disabled) {
        background: #ffffff !important;
        border-color: transparent !important;
        color: #0f172a !important;
        box-shadow: none !important;
    }

    .action-menu a:hover,
    .action-menu button:not(:disabled):hover,
    .ranking-action-menu a:hover,
    .ranking-action-menu button:not(:disabled):hover {
        background: #cde9f8 !important;
        filter: none;
        box-shadow: none !important;
    }

    .glass-card,
    .metric-card,
    .insight-card {
        background: linear-gradient(135deg, rgba(14, 165, 233, 0.12), rgba(255, 255, 255, 0.96) 48%, rgba(236, 72, 153, 0.1)) !important;
        border-color: rgba(125, 211, 252, 0.3) !important;
        box-shadow: 0 14px 28px -24px rgba(15, 23, 42, 0.45), inset 0 1px 0 rgba(255, 255, 255, 0.72);
    }

    #dashboardMain .rounded-2xl.border:not(button),
    #dashboardMain .rounded-xl.border:not(button),
    #dashboardMain .dialog-panel {
        background: linear-gradient(135deg, rgba(240, 249, 255, 0.96), rgba(255, 255, 255, 0.94) 56%, rgba(253, 242, 248, 0.92)) !important;
        border-color: rgba(147, 197, 253, 0.34) !important;
    }

    .glass-card:hover,
    .metric-card:hover,
    .insight-card:hover {
        transform: translateY(-2px);
        transition: all 0.25s ease;
    }

    .grid > .glass-card:nth-child(4n + 1),
    .grid > .metric-card:nth-child(4n + 1),
    .grid > .insight-card:nth-child(4n + 1) {
        background: linear-gradient(135deg, rgba(14, 165, 233, 0.16), rgba(255, 255, 255, 0.96) 58%);
        border-color: rgba(14, 165, 233, 0.22);
    }

    .grid > .glass-card:nth-child(4n + 2),
    .grid > .metric-card:nth-child(4n + 2),
    .grid > .insight-card:nth-child(4n + 2) {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.16), rgba(255, 255, 255, 0.96) 58%);
        border-color: rgba(16, 185, 129, 0.22);
    }

    .grid > .glass-card:nth-child(4n + 3),
    .grid > .metric-card:nth-child(4n + 3),
    .grid > .insight-card:nth-child(4n + 3) {
        background: linear-gradient(135deg, rgba(245, 158, 11, 0.18), rgba(255, 255, 255, 0.96) 58%);
        border-color: rgba(245, 158, 11, 0.24);
    }

    .grid > .glass-card:nth-child(4n + 4),
    .grid > .metric-card:nth-child(4n + 4),
    .grid > .insight-card:nth-child(4n + 4) {
        background: linear-gradient(135deg, rgba(236, 72, 153, 0.14), rgba(255, 255, 255, 0.96) 58%);
        border-color: rgba(236, 72, 153, 0.22);
    }

    .table-scroll table {
        border-collapse: separate;
        border-spacing: 0;
    }

    .table-scroll thead tr {
        background: linear-gradient(135deg, rgba(14, 165, 233, 0.16), rgba(99, 102, 241, 0.14), rgba(236, 72, 153, 0.14)) !important;
        border-bottom: 1px solid rgba(147, 197, 253, 0.35);
        color: #475569;
        font-size: 11px;
        letter-spacing: 0.05em;
        text-transform: uppercase;
    }

    .table-scroll tbody tr {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.86), rgba(240, 249, 255, 0.62)) !important;
        transition: background 0.2s ease;
    }

    .table-scroll tbody tr:nth-child(even) {
        background: linear-gradient(135deg, rgba(255, 247, 237, 0.72), rgba(253, 242, 248, 0.62)) !important;
    }

    .table-scroll tbody tr:hover {
        background: linear-gradient(135deg, rgba(224, 242, 254, 0.96), rgba(238, 242, 255, 0.94), rgba(252, 231, 243, 0.88)) !important;
    }

    .modal-backdrop {
        background: rgba(15, 23, 42, 0.45) !important;
        backdrop-filter: blur(4px) !important;
    }

    [id$="Modal"] > .glass-card,
    [id$="Modal"] > .dialog-panel,
    [id$="Modal"] > div.glass-card,
    [id$="Modal"] .dialog-panel {
        background: linear-gradient(135deg, rgba(240, 249, 255, 0.98), rgba(255, 255, 255, 0.98) 48%, rgba(253, 242, 248, 0.96)) !important;
        border: 1px solid rgba(226, 232, 240, 0.9) !important;
        border-radius: 1.75rem !important;
        box-shadow: 0 30px 80px -35px rgba(15, 23, 42, 0.45) !important;
        overflow: hidden;
    }

    [id$="Modal"] .border-b {
        border-color: rgba(226, 232, 240, 0.9) !important;
    }

    [id$="Modal"] input,
    [id$="Modal"] select,
    [id$="Modal"] textarea {
        background: rgba(248, 250, 252, 0.92) !important;
        border-color: rgba(203, 213, 225, 0.9) !important;
        color: #334155 !important;
    }

    [id$="Modal"] input:focus,
    [id$="Modal"] select:focus,
    [id$="Modal"] textarea:focus {
        border-color: #818cf8 !important;
        box-shadow: 0 0 0 3px rgba(129, 140, 248, 0.16) !important;
    }
</style>

<div id="sidebarOverlay" class="fixed inset-0 z-40 bg-slate-950/30 opacity-0 pointer-events-none transition-opacity duration-300 lg:hidden"></div>

<!-- Sidebar -->
<aside id="appSidebar" class="sidebar-shell fixed inset-y-0 left-0 z-50 flex w-64 -translate-x-full flex-col border-r border-sky-100 bg-white/95 transition-all duration-300 ease-out lg:translate-x-0">
    <div class="border-b border-sky-100 bg-gradient-to-r from-sky-50 via-indigo-50 to-pink-50 p-6">
        <div class="flex items-center gap-3 text-sky-600">
            <div class="sidebar-brand-icon flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-sky-500 via-indigo-500 to-pink-500 text-white shadow-lg shadow-indigo-100">
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
    <header class="sticky top-0 z-40 bg-white/85 backdrop-blur-md border-b border-sky-100 px-4 md:px-8 py-4 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <button type="button" id="sidebarToggle" class="flex h-10 w-10 items-center justify-center rounded-xl border border-sky-100 bg-white text-slate-500 transition-colors hover:bg-sky-50 hover:text-sky-600 lg:hidden">
                <i class="fa-solid fa-bars-staggered"></i>
            </button>
            <div class="flex items-center rounded-xl border border-sky-100 bg-gradient-to-r from-sky-50 via-white to-pink-50 px-4 py-2.5 focus-within:ring-2 focus-within:ring-sky-400 transition-all w-full max-w-xl">
                <i class="fa-solid fa-magnifying-glass text-sky-500 mr-3 text-sm"></i>
                <input type="text" placeholder="Search employee..." class="w-full bg-transparent border-none outline-none text-sm text-slate-600">
            </div>
        </div>

        <div class="flex items-center gap-3 md:gap-6">
            <div class="flex items-center gap-2 md:gap-4">
                <div class="relative group">
                    <button class="p-2.5 text-slate-500 hover:bg-sky-50 hover:text-sky-600 rounded-xl transition-colors">
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
                    <img src="<?= isset($headerUserAvatar) ? htmlspecialchars($headerUserAvatar) : '/HRMS/ceo.jpg'; ?>" alt="<?= isset($headerUserName) ? htmlspecialchars($headerUserName) : 'Admin'; ?>" class="w-10 h-10 rounded-xl bg-slate-100 border border-slate-200 shadow-sm">
                    <i class="fa-solid fa-chevron-down text-[10px] text-slate-400 hidden sm:block"></i>
                </div>
            </div>
        </div>
    </header>
