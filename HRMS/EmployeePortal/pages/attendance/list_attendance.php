<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Portal - My Attendance</title>
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
        .sidebar-label,.sidebar-brand-text,.sidebar-support-label { transition: opacity .2s ease, transform .2s ease; }
        .sidebar-scroll-area { scrollbar-width: thin; scroll-behavior: smooth; scrollbar-gutter: stable; }
        .sidebar-scroll-area::-webkit-scrollbar { width: 6px; }
        .sidebar-scroll-area::-webkit-scrollbar-track { background: transparent; }
        .sidebar-scroll-area::-webkit-scrollbar-thumb { background: transparent; border-radius: 9999px; }
        .sidebar-shell:hover .sidebar-scroll-area::-webkit-scrollbar-thumb { background: #cbd5e1; }
        .insight-card:hover { transform: translateY(-2px); transition: all .3s ease; }
        .status-pill { padding: 4px 12px; border-radius: 9999px; font-size: .75rem; font-weight: 600; }
        .status-present { background: #dcfce7; color: #166534; }
        .status-late { background: #fef3c7; color: #92400e; }
        .table-scroll::-webkit-scrollbar { height: 6px; width: 6px; }
        .table-scroll::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 9999px; }
        @media (max-width: 1023px) { #dashboardMain { margin-left: 0 !important; } .sidebar-shell { width: 17rem; } body.sidebar-open .sidebar-shell { transform: translateX(0); } body.sidebar-open #sidebarOverlay { opacity: 1; pointer-events: auto; } }
    </style>
</head>
<body class="flex min-h-screen bg-slate-50">
    <?php $menuBasePath = '../../'; ?>
    <?php $currentMenu = 'employee_attendance'; ?>
    <?php $headerUserName = 'Cabdiraxmaan Cali'; ?>
    <?php $headerUserRole = 'Employee Portal'; ?>
    <?php $headerUserAvatar = '/HRMS/ceo.jpg'; ?>
    <?php include __DIR__ . '/../../includes/header_sidebar.php'; ?>
    <div class="mx-auto w-full max-w-[1440px] p-4 md:p-8">
        <div class="mb-8 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
            <div><h2 class="text-2xl font-semibold text-slate-800">My Attendance</h2><p class="text-sm text-slate-500">Check your check-ins, late minutes, and monthly attendance pattern.</p></div>
            <button id="checkInButton" class="rounded-xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-indigo-500"><i class="fa-solid fa-clock mr-2"></i>Check In</button>
        </div>
        <div class="mb-8 grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">
            <div class="glass-card insight-card border-l-4 border-emerald-500 p-5"><p class="text-sm text-slate-500">Present Days</p><h3 class="mt-2 text-2xl font-bold text-slate-800">22</h3><p class="mt-4 text-xs text-slate-400">This month</p></div>
            <div class="glass-card insight-card border-l-4 border-amber-500 p-5"><p class="text-sm text-slate-500">Late Entries</p><h3 class="mt-2 text-2xl font-bold text-slate-800">1</h3><p class="mt-4 text-xs text-slate-400">4 minutes total</p></div>
            <div class="glass-card insight-card border-l-4 border-sky-500 p-5"><p class="text-sm text-slate-500">Average Check In</p><h3 class="mt-2 text-2xl font-bold text-slate-800">07:59</h3><p class="mt-4 text-xs text-slate-400">Before schedule</p></div>
            <div class="glass-card insight-card border-l-4 border-indigo-500 p-5"><p class="text-sm text-slate-500">Attendance Rate</p><h3 class="mt-2 text-2xl font-bold text-slate-800">96%</h3><p class="mt-4 text-xs text-slate-400">Current month</p></div>
        </div>
        <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">
            <div class="glass-card p-6 xl:col-span-2">
                <h3 class="text-base font-semibold text-slate-800">Attendance Log</h3>
                <div class="mt-5 table-scroll overflow-x-auto">
                    <table class="min-w-full text-left">
                        <thead><tr class="border-b border-slate-100 text-[11px] uppercase tracking-wider text-slate-400"><th class="px-4 py-4">Date</th><th class="px-4 py-4">Schedule</th><th class="px-4 py-4">Check In</th><th class="px-4 py-4">Check Out</th><th class="px-4 py-4">Minutes Late</th><th class="px-4 py-4">Status</th></tr></thead>
                        <tbody class="divide-y divide-slate-50">
                            <tr><td class="px-4 py-4 text-sm text-slate-600">2026-04-28</td><td class="px-4 py-4 text-sm text-slate-600">08:00-16:00</td><td class="px-4 py-4 text-sm text-slate-600">07:58 AM</td><td class="px-4 py-4 text-sm text-slate-600">04:10 PM</td><td class="px-4 py-4 text-sm text-slate-600">0</td><td class="px-4 py-4"><span class="status-pill status-present">Present</span></td></tr>
                            <tr><td class="px-4 py-4 text-sm text-slate-600">2026-04-27</td><td class="px-4 py-4 text-sm text-slate-600">08:00-16:00</td><td class="px-4 py-4 text-sm text-slate-600">08:04 AM</td><td class="px-4 py-4 text-sm text-slate-600">04:03 PM</td><td class="px-4 py-4 text-sm text-slate-600">4</td><td class="px-4 py-4"><span class="status-pill status-late">Late</span></td></tr>
                            <tr><td class="px-4 py-4 text-sm text-slate-600">2026-04-26</td><td class="px-4 py-4 text-sm text-slate-600">08:00-16:00</td><td class="px-4 py-4 text-sm text-slate-600">07:55 AM</td><td class="px-4 py-4 text-sm text-slate-600">04:00 PM</td><td class="px-4 py-4 text-sm text-slate-600">0</td><td class="px-4 py-4"><span class="status-pill status-present">Present</span></td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="glass-card p-6"><h3 class="text-base font-semibold text-slate-800">Weekly Pattern</h3><div class="mt-4 h-[280px]"><canvas id="attendanceChart"></canvas></div></div>
        </div>
    </div>
    <script>
        const sidebarToggle = document.getElementById('sidebarToggle'), sidebarOverlay = document.getElementById('sidebarOverlay'), desktopSidebarBreakpoint = window.matchMedia('(min-width: 1024px)');
        sidebarToggle.addEventListener('click', () => document.body.classList.toggle('sidebar-open')); sidebarOverlay.addEventListener('click', () => { if (!desktopSidebarBreakpoint.matches) document.body.classList.remove('sidebar-open'); }); window.addEventListener('resize', () => { if (desktopSidebarBreakpoint.matches) document.body.classList.remove('sidebar-open'); });
        document.getElementById('checkInButton').addEventListener('click', event => { event.currentTarget.innerHTML = '<i class="fa-solid fa-circle-check mr-2"></i>Checked In'; event.currentTarget.classList.replace('bg-indigo-600', 'bg-emerald-600'); });
        new Chart(document.getElementById('attendanceChart'), { type: 'bar', data: { labels: ['Sat','Sun','Mon','Tue','Wed','Thu'], datasets: [{ data: [8,8,7.9,8.2,8,7.8], backgroundColor: '#6366f1', borderRadius: 8 }] }, options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true }, x: { grid: { display: false } } } } });
    </script>
</body>
</html>
