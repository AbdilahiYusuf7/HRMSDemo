<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Portal - My Payroll</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
        @media (max-width: 1023px) { #dashboardMain { margin-left: 0 !important; } .sidebar-shell { width: 17rem; } body.sidebar-open .sidebar-shell { transform: translateX(0); } body.sidebar-open #sidebarOverlay { opacity: 1; pointer-events: auto; } }
    </style>
</head>
<body class="flex min-h-screen bg-slate-50">
    <?php $menuBasePath = '../../'; ?>
    <?php $currentMenu = 'employee_payroll'; ?>
    <?php $headerUserName = 'Cabdiraxmaan Cali'; ?>
    <?php $headerUserRole = 'Employee Portal'; ?>
    <?php $headerUserAvatar = 'https://api.dicebear.com/7.x/avataaars/svg?seed=Cabdirahman'; ?>
    <?php include __DIR__ . '/../../includes/header_sidebar.php'; ?>
    <div class="mx-auto w-full max-w-[1440px] p-4 md:p-8">
        <div class="mb-8 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
            <div><h2 class="text-2xl font-semibold text-slate-800">My Payroll / Deductions</h2><p class="text-sm text-slate-500">View your salary, deductions, and payslip summary.</p></div>
            <button class="rounded-xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-indigo-500"><i class="fa-solid fa-download mr-2"></i>Download Payslip</button>
        </div>
        <div class="mb-8 grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">
            <div class="glass-card border-l-4 border-indigo-500 p-5"><p class="text-sm text-slate-500">Base Salary</p><h3 class="mt-2 text-2xl font-bold text-slate-800">$850</h3></div>
            <div class="glass-card border-l-4 border-rose-500 p-5"><p class="text-sm text-slate-500">Absence Deduction</p><h3 class="mt-2 text-2xl font-bold text-rose-600">$15</h3></div>
            <div class="glass-card border-l-4 border-slate-500 p-5"><p class="text-sm text-slate-500">Performance Deduction</p><h3 class="mt-2 text-2xl font-bold text-slate-800">$0</h3></div>
            <div class="glass-card border-l-4 border-emerald-500 p-5"><p class="text-sm text-slate-500">Net Pay</p><h3 class="mt-2 text-2xl font-bold text-emerald-600">$835</h3></div>
        </div>
        <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">
            <div class="glass-card p-6">
                <h3 class="text-base font-semibold text-slate-800">Deduction Breakdown</h3>
                <div class="mt-5 space-y-4">
                    <div class="rounded-2xl border border-rose-100 bg-rose-50 p-4"><div class="flex justify-between"><span class="text-sm font-semibold text-rose-700">Late attendance adjustment</span><span class="text-sm font-bold text-rose-700">$15</span></div><p class="mt-2 text-xs text-rose-500">1 late check-in recorded on 2026-04-27.</p></div>
                    <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4"><div class="flex justify-between"><span class="text-sm font-semibold text-slate-700">Performance deduction</span><span class="text-sm font-bold text-slate-700">$0</span></div><p class="mt-2 text-xs text-slate-500">No performance deduction for this payroll period.</p></div>
                </div>
            </div>
            <div class="glass-card p-6">
                <h3 class="text-base font-semibold text-slate-800">Payslip Summary</h3>
                <div class="mt-5 space-y-3 text-sm">
                    <div class="flex justify-between"><span class="text-slate-400">Employee</span><span class="font-semibold text-slate-700">Cabdiraxmaan Cali</span></div>
                    <div class="flex justify-between"><span class="text-slate-400">Period</span><span class="font-semibold text-slate-700">April 2026</span></div>
                    <div class="flex justify-between"><span class="text-slate-400">Department</span><span class="font-semibold text-slate-700">Human Resource</span></div>
                    <div class="flex justify-between"><span class="text-slate-400">Payroll Status</span><span class="font-semibold text-emerald-600">Ready</span></div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const sidebarToggle = document.getElementById('sidebarToggle'), sidebarOverlay = document.getElementById('sidebarOverlay'), desktopSidebarBreakpoint = window.matchMedia('(min-width: 1024px)');
        sidebarToggle.addEventListener('click', () => document.body.classList.toggle('sidebar-open')); sidebarOverlay.addEventListener('click', () => { if (!desktopSidebarBreakpoint.matches) document.body.classList.remove('sidebar-open'); }); window.addEventListener('resize', () => { if (desktopSidebarBreakpoint.matches) document.body.classList.remove('sidebar-open'); });
    </script>
</body>
</html>
