<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Portal - My Agendas / Performance</title>
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
        .agenda-card:hover { transform: translateY(-2px); transition: all .3s ease; }
        .status-pill { padding: 4px 12px; border-radius: 9999px; font-size: .75rem; font-weight: 600; }
        .status-done { background: #dcfce7; color: #166534; }
        .status-progress { background: #dbeafe; color: #1d4ed8; }
        .status-pending { background: #fef3c7; color: #92400e; }
        .modal-backdrop { background: rgba(15,23,42,.45); backdrop-filter: blur(4px); }
        @media (max-width: 1023px) { #dashboardMain { margin-left: 0 !important; } .sidebar-shell { width: 17rem; } body.sidebar-open .sidebar-shell { transform: translateX(0); } body.sidebar-open #sidebarOverlay { opacity: 1; pointer-events: auto; } }
    </style>
</head>
<body class="flex min-h-screen bg-slate-50">
    <?php $menuBasePath = '../../'; ?>
    <?php $currentMenu = 'employee_performance'; ?>
    <?php $headerUserName = 'Cabdiraxmaan Cali'; ?>
    <?php $headerUserRole = 'Employee Portal'; ?>
    <?php $headerUserAvatar = '/HRMS/ceo.jpg'; ?>
    <?php include __DIR__ . '/../../includes/header_sidebar.php'; ?>
    <div class="mx-auto w-full max-w-[1440px] p-4 md:p-8">
        <div class="mb-8 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
            <div><h2 class="text-2xl font-semibold text-slate-800">My Agendas / Performance</h2><p class="text-sm text-slate-500">Track assigned agendas and your latest performance review.</p></div>
            <span class="rounded-xl bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-700">Latest Score: 92%</span>
        </div>
        <div class="mb-8 grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">
            <div class="glass-card border-l-4 border-emerald-500 p-5"><p class="text-sm text-slate-500">Performance</p><h3 class="mt-2 text-2xl font-bold text-slate-800">92%</h3></div>
            <div class="glass-card border-l-4 border-indigo-500 p-5"><p class="text-sm text-slate-500">Agendas</p><h3 class="mt-2 text-2xl font-bold text-slate-800">3</h3></div>
            <div class="glass-card border-l-4 border-sky-500 p-5"><p class="text-sm text-slate-500">Completed</p><h3 class="mt-2 text-2xl font-bold text-slate-800">1</h3></div>
            <div class="glass-card border-l-4 border-amber-500 p-5"><p class="text-sm text-slate-500">Pending</p><h3 class="mt-2 text-2xl font-bold text-slate-800">1</h3></div>
        </div>
        <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">
            <div class="glass-card p-6 xl:col-span-2">
                <h3 class="text-base font-semibold text-slate-800">Assigned Agendas</h3>
                <div class="mt-5 grid grid-cols-1 gap-4 md:grid-cols-3">
                    <div class="agenda-card rounded-2xl border border-slate-100 bg-slate-50 p-4"><div class="flex justify-between gap-3"><p class="text-sm font-semibold text-slate-800">Check staff attendance</p><span class="status-pill status-done">Done</span></div><p class="mt-4 text-xs text-slate-500">Daily verification of assigned attendance records.</p><button id="viewAttendanceAgenda" type="button" class="mt-4 rounded-xl bg-white px-4 py-2 text-xs font-semibold text-slate-600">View</button></div>
                    <div class="agenda-card rounded-2xl border border-slate-100 bg-slate-50 p-4"><div class="flex justify-between gap-3"><p class="text-sm font-semibold text-slate-800">Follow up staff leave</p><span class="status-pill status-progress">In Progress</span></div><p class="mt-4 text-xs text-slate-500">Confirm pending leave evidence and branch coverage.</p><button class="update-agenda mt-4 rounded-xl bg-indigo-600 px-4 py-2 text-xs font-semibold text-white">Mark Progress</button></div>
                    <div class="agenda-card rounded-2xl border border-slate-100 bg-slate-50 p-4"><div class="flex justify-between gap-3"><p class="text-sm font-semibold text-slate-800">Update employee files</p><span class="status-pill status-pending">Pending</span></div><p class="mt-4 text-xs text-slate-500">Review employee document placeholders.</p><button class="update-agenda mt-4 rounded-xl bg-indigo-600 px-4 py-2 text-xs font-semibold text-white">Start</button></div>
                </div>
            </div>
            <div class="glass-card p-6"><h3 class="text-base font-semibold text-slate-800">Score Trend</h3><div class="mt-4 h-[280px]"><canvas id="scoreChart"></canvas></div></div>
        </div>
    </div>
    <div id="agendaDetailModal" class="modal-backdrop fixed inset-0 z-50 hidden items-center justify-center p-4">
        <div class="glass-card w-full max-w-2xl p-6">
            <div class="mb-5 flex items-start justify-between gap-4">
                <div><h3 class="text-lg font-semibold text-slate-800">Check Staff Attendance</h3><p class="text-sm text-slate-500">Completed agenda detail for today's assigned attendance verification.</p></div>
                <button id="closeAgendaDetailModal" type="button" class="text-slate-400 hover:text-slate-600"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="grid grid-cols-1 gap-4 text-sm md:grid-cols-3">
                <div class="rounded-2xl bg-slate-50 p-4"><p class="text-xs text-slate-400">Status</p><p class="mt-2 font-semibold text-emerald-700">Done</p></div>
                <div class="rounded-2xl bg-slate-50 p-4"><p class="text-xs text-slate-400">Assigned Branch</p><p class="mt-2 font-semibold text-slate-700">Idaacada Branch</p></div>
                <div class="rounded-2xl bg-slate-50 p-4"><p class="text-xs text-slate-400">Completed</p><p class="mt-2 font-semibold text-slate-700">May 1, 2026</p></div>
            </div>
            <div class="mt-5 overflow-x-auto">
                <table class="min-w-full text-left">
                    <thead><tr class="border-b border-slate-100 text-[11px] uppercase tracking-wider text-slate-400"><th class="px-4 py-3">Employee</th><th class="px-4 py-3">Check In</th><th class="px-4 py-3">Status</th></tr></thead>
                    <tbody class="divide-y divide-slate-50">
                        <tr><td class="px-4 py-3 text-sm font-semibold text-slate-700">Cabdiraxmaan Cali</td><td class="px-4 py-3 text-sm text-slate-600">07:58 AM</td><td class="px-4 py-3"><span class="status-pill status-done">Present</span></td></tr>
                        <tr><td class="px-4 py-3 text-sm font-semibold text-slate-700">Hodan Ali</td><td class="px-4 py-3 text-sm text-slate-600">08:04 AM</td><td class="px-4 py-3"><span class="status-pill status-warn">Late</span></td></tr>
                        <tr><td class="px-4 py-3 text-sm font-semibold text-slate-700">Mahad Axmed</td><td class="px-4 py-3 text-sm text-slate-600">--</td><td class="px-4 py-3"><span class="status-pill status-pending">Absent</span></td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        const sidebarToggle = document.getElementById('sidebarToggle'), sidebarOverlay = document.getElementById('sidebarOverlay'), desktopSidebarBreakpoint = window.matchMedia('(min-width: 1024px)');
        const agendaDetailModal = document.getElementById('agendaDetailModal');
        sidebarToggle.addEventListener('click', () => document.body.classList.toggle('sidebar-open')); sidebarOverlay.addEventListener('click', () => { if (!desktopSidebarBreakpoint.matches) document.body.classList.remove('sidebar-open'); }); window.addEventListener('resize', () => { if (desktopSidebarBreakpoint.matches) document.body.classList.remove('sidebar-open'); });
        document.getElementById('viewAttendanceAgenda').addEventListener('click', () => agendaDetailModal.classList.replace('hidden', 'flex'));
        document.getElementById('closeAgendaDetailModal').addEventListener('click', () => agendaDetailModal.classList.replace('flex', 'hidden'));
        agendaDetailModal.addEventListener('click', event => { if (event.target === agendaDetailModal) agendaDetailModal.classList.replace('flex', 'hidden'); });
        document.querySelectorAll('.update-agenda').forEach(button => button.addEventListener('click', () => { button.textContent = 'Updated'; button.classList.replace('bg-indigo-600','bg-emerald-600'); }));
        new Chart(document.getElementById('scoreChart'), { type: 'line', data: { labels: ['Q1','Q2','Q3','Q4'], datasets: [{ data: [86,89,91,92], borderColor: '#6366f1', backgroundColor: 'rgba(99,102,241,.14)', fill: true, tension: .4 }] }, options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { y: { min: 80, max: 100 }, x: { grid: { display: false } } } } });
    </script>
</body>
</html>
