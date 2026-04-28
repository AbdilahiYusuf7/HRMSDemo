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
    <?php $headerUserAvatar = 'https://api.dicebear.com/7.x/avataaars/svg?seed=Cabdirahman'; ?>
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
                    <div class="agenda-card rounded-2xl border border-slate-100 bg-slate-50 p-4"><div class="flex justify-between gap-3"><p class="text-sm font-semibold text-slate-800">Check staff attendance</p><span class="status-pill status-done">Done</span></div><p class="mt-4 text-xs text-slate-500">Daily verification of assigned attendance records.</p><button class="mt-4 rounded-xl bg-white px-4 py-2 text-xs font-semibold text-slate-600">View</button></div>
                    <div class="agenda-card rounded-2xl border border-slate-100 bg-slate-50 p-4"><div class="flex justify-between gap-3"><p class="text-sm font-semibold text-slate-800">Follow up staff leave</p><span class="status-pill status-progress">In Progress</span></div><p class="mt-4 text-xs text-slate-500">Confirm pending leave evidence and branch coverage.</p><button class="update-agenda mt-4 rounded-xl bg-indigo-600 px-4 py-2 text-xs font-semibold text-white">Mark Progress</button></div>
                    <div class="agenda-card rounded-2xl border border-slate-100 bg-slate-50 p-4"><div class="flex justify-between gap-3"><p class="text-sm font-semibold text-slate-800">Update employee files</p><span class="status-pill status-pending">Pending</span></div><p class="mt-4 text-xs text-slate-500">Review employee document placeholders.</p><button class="update-agenda mt-4 rounded-xl bg-indigo-600 px-4 py-2 text-xs font-semibold text-white">Start</button></div>
                </div>
            </div>
            <div class="glass-card p-6"><h3 class="text-base font-semibold text-slate-800">Score Trend</h3><div class="mt-4 h-[280px]"><canvas id="scoreChart"></canvas></div></div>
        </div>
    </div>
    <script>
        const sidebarToggle = document.getElementById('sidebarToggle'), sidebarOverlay = document.getElementById('sidebarOverlay'), desktopSidebarBreakpoint = window.matchMedia('(min-width: 1024px)');
        sidebarToggle.addEventListener('click', () => document.body.classList.toggle('sidebar-open')); sidebarOverlay.addEventListener('click', () => { if (!desktopSidebarBreakpoint.matches) document.body.classList.remove('sidebar-open'); }); window.addEventListener('resize', () => { if (desktopSidebarBreakpoint.matches) document.body.classList.remove('sidebar-open'); });
        document.querySelectorAll('.update-agenda').forEach(button => button.addEventListener('click', () => { button.textContent = 'Updated'; button.classList.replace('bg-indigo-600','bg-emerald-600'); }));
        new Chart(document.getElementById('scoreChart'), { type: 'line', data: { labels: ['Q1','Q2','Q3','Q4'], datasets: [{ data: [86,89,91,92], borderColor: '#6366f1', backgroundColor: 'rgba(99,102,241,.14)', fill: true, tension: .4 }] }, options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { y: { min: 80, max: 100 }, x: { grid: { display: false } } } } });
    </script>
</body>
</html>
