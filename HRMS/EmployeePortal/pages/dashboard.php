<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Portal - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; background-color: #f8fafc; overflow-x: hidden; }
        #dashboardMain { min-width: 0; }
        .glass-card { background: rgba(255,255,255,.95); backdrop-filter: blur(10px); border: 1px solid rgba(226,232,240,.8); box-shadow: 0 4px 6px -1px rgb(0 0 0 / .05), 0 2px 4px -2px rgb(0 0 0 / .05); border-radius: 1rem; }
        .sidebar-shell { box-shadow: 0 10px 30px -18px rgba(15,23,42,.3); }
        .sidebar-link:hover { background: rgba(99,102,241,.1); color: #6366f1; }
        .sidebar-link.active { background: #6366f1; color: white; }
        .sidebar-label, .sidebar-brand-text, .sidebar-support-label { transition: opacity .2s ease, transform .2s ease; }
        .sidebar-scroll-area { scrollbar-width: thin; scroll-behavior: smooth; scrollbar-gutter: stable; }
        .sidebar-scroll-area::-webkit-scrollbar { width: 6px; }
        .sidebar-scroll-area::-webkit-scrollbar-track { background: transparent; }
        .sidebar-scroll-area::-webkit-scrollbar-thumb { background: transparent; border-radius: 9999px; }
        .sidebar-shell:hover .sidebar-scroll-area::-webkit-scrollbar-thumb { background: #cbd5e1; }
        .insight-card:hover, .action-card:hover { transform: translateY(-2px); transition: all .3s ease; }
        .status-pill { padding: 4px 12px; border-radius: 9999px; font-size: .75rem; font-weight: 600; }
        .status-good { background: #dcfce7; color: #166534; }
        .status-warn { background: #fef3c7; color: #92400e; }
        .status-info { background: #dbeafe; color: #1d4ed8; }
        .table-scroll::-webkit-scrollbar { height: 6px; width: 6px; }
        .table-scroll::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 9999px; }
        @media (max-width: 1023px) { #dashboardMain { margin-left: 0 !important; } .sidebar-shell { width: 17rem; } body.sidebar-open .sidebar-shell { transform: translateX(0); } body.sidebar-open #sidebarOverlay { opacity: 1; pointer-events: auto; } }
    </style>
</head>
<body class="flex min-h-screen bg-slate-50">
    <?php $menuBasePath = '../'; ?>
    <?php $currentMenu = 'employee_dashboard'; ?>
    <?php $headerUserName = 'Cabdiraxmaan Cali'; ?>
    <?php $headerUserRole = 'Employee Portal'; ?>
    <?php $headerUserAvatar = 'https://api.dicebear.com/7.x/avataaars/svg?seed=Cabdirahman'; ?>
    <?php include __DIR__ . '/../includes/header_sidebar.php'; ?>

    <div class="mx-auto w-full max-w-[1440px] p-4 md:p-8">
        <div class="mb-8 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-slate-800">Welcome, Cabdiraxmaan</h2>
                <p class="text-sm text-slate-500">Your self-service dashboard for attendance, leave, payroll, training, and performance.</p>
            </div>
            <span class="status-pill status-good">EMP-0001 · Active</span>
        </div>

        <div class="mb-8 grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">
            <a href="attendance/list_attendance.php" class="glass-card insight-card border-l-4 border-emerald-500 p-5">
                <p class="text-sm font-medium text-slate-500">Attendance Rate</p>
                <div class="mt-2 flex items-center justify-between"><h3 class="text-2xl font-bold text-slate-800">96%</h3><i class="fa-solid fa-calendar-check rounded-xl bg-emerald-50 p-3 text-emerald-600"></i></div>
                <p class="mt-4 text-[11px] font-medium text-slate-400">1 late check-in this month</p>
            </a>
            <a href="leave management/list_leaves.php" class="glass-card insight-card border-l-4 border-amber-500 p-5">
                <p class="text-sm font-medium text-slate-500">Leave Balance</p>
                <div class="mt-2 flex items-center justify-between"><h3 class="text-2xl font-bold text-slate-800">21 Days</h3><i class="fa-solid fa-umbrella-beach rounded-xl bg-amber-50 p-3 text-amber-600"></i></div>
                <p class="mt-4 text-[11px] font-medium text-slate-400">Annual leave remaining</p>
            </a>
            <a href="payrol integration/payroll_integration.php" class="glass-card insight-card border-l-4 border-rose-500 p-5">
                <p class="text-sm font-medium text-slate-500">Deductions</p>
                <div class="mt-2 flex items-center justify-between"><h3 class="text-2xl font-bold text-slate-800">$15</h3><i class="fa-solid fa-file-invoice-dollar rounded-xl bg-rose-50 p-3 text-rose-600"></i></div>
                <p class="mt-4 text-[11px] font-medium text-slate-400">Absence deduction from payroll</p>
            </a>
            <a href="training and development/list_training.php" class="glass-card insight-card border-l-4 border-sky-500 p-5">
                <p class="text-sm font-medium text-slate-500">Trainings</p>
                <div class="mt-2 flex items-center justify-between"><h3 class="text-2xl font-bold text-slate-800">2</h3><i class="fa-solid fa-graduation-cap rounded-xl bg-sky-50 p-3 text-sky-600"></i></div>
                <p class="mt-4 text-[11px] font-medium text-slate-400">1 upcoming course</p>
            </a>
        </div>

        <div class="mb-8 grid grid-cols-1 gap-6 xl:grid-cols-[360px_1fr]">
            <div class="glass-card overflow-hidden">
                <div class="bg-indigo-600 px-6 py-8 text-white">
                    <div class="flex items-center gap-4">
                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Cabdirahman" class="h-20 w-20 rounded-2xl border-4 border-white/30 bg-white" alt="Cabdiraxmaan Cali">
                        <div>
                            <h3 class="text-xl font-bold">Cabdiraxmaan Cali</h3>
                            <p class="mt-1 text-sm text-indigo-100">Human Resource Officer</p>
                            <p class="mt-3 text-xs font-semibold text-indigo-100">Idaacada Branch</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-4 p-6 text-sm">
                    <div class="flex justify-between gap-4"><span class="text-slate-400">Manager</span><span class="font-semibold text-slate-700">Asha Mohamed</span></div>
                    <div class="flex justify-between gap-4"><span class="text-slate-400">Email</span><span class="font-semibold text-slate-700">cabdiraxmaan.cali@hrms.local</span></div>
                    <div class="flex justify-between gap-4"><span class="text-slate-400">Phone</span><span class="font-semibold text-slate-700">+252 61 555 0101</span></div>
                    <a href="employees/view_employee.php" class="block rounded-xl bg-slate-50 px-4 py-3 text-center text-sm font-semibold text-slate-600 transition hover:bg-slate-100">View Full Profile</a>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">
                <div class="glass-card p-6">
                    <h3 class="text-base font-semibold text-slate-800">Quick Actions</h3>
                    <div class="mt-5 grid grid-cols-1 gap-3 sm:grid-cols-2">
                        <a href="leave management/list_leaves.php" class="action-card rounded-2xl border border-slate-100 bg-slate-50 p-4 text-sm font-semibold text-slate-700"><i class="fa-solid fa-plus mr-2 text-indigo-600"></i>Request Leave</a>
                        <a href="attendance/list_attendance.php" class="action-card rounded-2xl border border-slate-100 bg-slate-50 p-4 text-sm font-semibold text-slate-700"><i class="fa-solid fa-clock mr-2 text-emerald-600"></i>Check Attendance</a>
                        <a href="payrol integration/payroll_integration.php" class="action-card rounded-2xl border border-slate-100 bg-slate-50 p-4 text-sm font-semibold text-slate-700"><i class="fa-solid fa-receipt mr-2 text-rose-600"></i>View Payslip</a>
                        <a href="perfomance/list_perfomance.php" class="action-card rounded-2xl border border-slate-100 bg-slate-50 p-4 text-sm font-semibold text-slate-700"><i class="fa-solid fa-list-check mr-2 text-sky-600"></i>My Agendas</a>
                    </div>
                </div>
                <div class="glass-card p-6">
                    <h3 class="text-base font-semibold text-slate-800">Performance Trend</h3>
                    <div class="mt-4 h-[230px]"><canvas id="performanceChart"></canvas></div>
                </div>
            </div>
        </div>

        <div class="glass-card p-6">
            <h3 class="text-base font-semibold text-slate-800">Today</h3>
            <div class="mt-5 table-scroll overflow-x-auto">
                <table class="min-w-full text-left">
                    <thead><tr class="border-b border-slate-100 text-[11px] uppercase tracking-wider text-slate-400"><th class="px-4 py-4">Item</th><th class="px-4 py-4">Detail</th><th class="px-4 py-4">Status</th></tr></thead>
                    <tbody class="divide-y divide-slate-50">
                        <tr><td class="px-4 py-4 text-sm font-semibold text-slate-700">Check-in</td><td class="px-4 py-4 text-sm text-slate-600">07:58 AM at Idaacada Branch</td><td class="px-4 py-4"><span class="status-pill status-good">Present</span></td></tr>
                        <tr><td class="px-4 py-4 text-sm font-semibold text-slate-700">Upcoming Training</td><td class="px-4 py-4 text-sm text-slate-600">HR Interview Calibration · 2026-05-02</td><td class="px-4 py-4"><span class="status-pill status-warn">Registered</span></td></tr>
                        <tr><td class="px-4 py-4 text-sm font-semibold text-slate-700">Agenda</td><td class="px-4 py-4 text-sm text-slate-600">Follow up staff leave</td><td class="px-4 py-4"><span class="status-pill status-info">In Progress</span></td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const desktopSidebarBreakpoint = window.matchMedia('(min-width: 1024px)');
        function handleSidebarToggle() { document.body.classList.toggle('sidebar-open'); }
        function closeMobileSidebar() { if (!desktopSidebarBreakpoint.matches) document.body.classList.remove('sidebar-open'); }
        function syncSidebarMode() { if (desktopSidebarBreakpoint.matches) document.body.classList.remove('sidebar-open'); }
        sidebarToggle.addEventListener('click', handleSidebarToggle);
        sidebarOverlay.addEventListener('click', closeMobileSidebar);
        window.addEventListener('resize', syncSidebarMode);
        syncSidebarMode();
        new Chart(document.getElementById('performanceChart'), { type: 'line', data: { labels: ['Q1','Q2','Q3','Q4'], datasets: [{ data: [86,89,91,92], borderColor: '#6366f1', backgroundColor: 'rgba(99,102,241,.14)', fill: true, tension: .4 }] }, options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { y: { min: 80, max: 100, grid: { color: '#f1f5f9' } }, x: { grid: { display: false } } } } });
    </script>
</body>
</html>
