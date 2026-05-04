<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Portal - My Trainings</title>
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
        .status-pill { padding: 4px 12px; border-radius: 9999px; font-size: .75rem; font-weight: 600; }
        .status-completed { background: #dcfce7; color: #166534; }
        .status-registered { background: #fef3c7; color: #92400e; }
        .status-progress { background: #dbeafe; color: #1d4ed8; }
        .modal-backdrop { background: rgba(15,23,42,.45); backdrop-filter: blur(4px); }
        @media (max-width: 1023px) { #dashboardMain { margin-left: 0 !important; } .sidebar-shell { width: 17rem; } body.sidebar-open .sidebar-shell { transform: translateX(0); } body.sidebar-open #sidebarOverlay { opacity: 1; pointer-events: auto; } }
    </style>
</head>
<body class="flex min-h-screen bg-slate-50">
    <?php $menuBasePath = '../../'; ?>
    <?php $currentMenu = 'employee_training'; ?>
    <?php $headerUserName = 'Cabdiraxmaan Cali'; ?>
    <?php $headerUserRole = 'Employee Portal'; ?>
    <?php $headerUserAvatar = '/HRMS/ceo.jpg'; ?>
    <?php include __DIR__ . '/../../includes/header_sidebar.php'; ?>
    <div class="mx-auto w-full max-w-[1440px] p-4 md:p-8">
        <div class="mb-8 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
            <div><h2 class="text-2xl font-semibold text-slate-800">My Trainings</h2><p class="text-sm text-slate-500">Continue current trainings and check newly assigned courses.</p></div>
            <button id="openTrainingCatalog" class="rounded-xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-indigo-500"><i class="fa-solid fa-magnifying-glass mr-2"></i>Browse New Trainings</button>
        </div>
        <div class="mb-8 grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">
            <div class="glass-card border-l-4 border-indigo-500 p-5"><p class="text-sm text-slate-500">Registered</p><h3 class="mt-2 text-2xl font-bold text-slate-800">2 Courses</h3></div>
            <div class="glass-card border-l-4 border-emerald-500 p-5"><p class="text-sm text-slate-500">Completed</p><h3 class="mt-2 text-2xl font-bold text-slate-800">1 Course</h3></div>
            <div class="glass-card border-l-4 border-amber-500 p-5"><p class="text-sm text-slate-500">Upcoming</p><h3 class="mt-2 text-2xl font-bold text-slate-800">1 Course</h3></div>
            <div class="glass-card border-l-4 border-sky-500 p-5"><p class="text-sm text-slate-500">Completion</p><h3 class="mt-2 text-2xl font-bold text-slate-800">50%</h3></div>
        </div>
        <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">
            <div class="glass-card p-6">
                <h3 class="text-base font-semibold text-slate-800">My Registered Courses</h3>
                <div class="mt-5 space-y-4">
                    <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4"><div class="flex items-start justify-between gap-4"><div><p class="text-sm font-semibold text-slate-800">Performance Coaching Lab</p><p class="mt-1 text-xs text-slate-400">TRN-003 · 2026-02-13</p></div><span class="status-pill status-completed">Completed</span></div><button class="mt-4 rounded-xl bg-white px-4 py-2 text-xs font-semibold text-slate-600">View Certificate</button></div>
                    <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4"><div class="flex items-start justify-between gap-4"><div><p class="text-sm font-semibold text-slate-800">HR Interview Calibration</p><p class="mt-1 text-xs text-slate-400">TRN-009 · 2026-05-02</p></div><span class="status-pill status-registered">Registered</span></div><button class="continue-training mt-4 rounded-xl bg-indigo-600 px-4 py-2 text-xs font-semibold text-white">Continue Training</button></div>
                </div>
            </div>
            <div class="glass-card p-6">
                <h3 class="text-base font-semibold text-slate-800">Recommended Trainings</h3>
                <div class="mt-5 space-y-4">
                    <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4"><p class="text-sm font-semibold text-slate-800">HR Mediation Certification</p><p class="mt-1 text-xs text-slate-400">Recommended for HR Officers</p><button class="mt-4 rounded-xl bg-white px-4 py-2 text-xs font-semibold text-indigo-600">Register</button></div>
                    <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4"><p class="text-sm font-semibold text-slate-800">Leadership Certificate</p><p class="mt-1 text-xs text-slate-400">Supports promotion readiness</p><button class="mt-4 rounded-xl bg-white px-4 py-2 text-xs font-semibold text-indigo-600">Register</button></div>
                </div>
            </div>
        </div>
    </div>
    <div id="trainingCatalogModal" class="modal-backdrop fixed inset-0 z-50 hidden items-center justify-center p-4"><div class="glass-card w-full max-w-xl p-6"><div class="mb-5 flex justify-between"><h3 class="text-lg font-semibold text-slate-800">Training Catalog</h3><button id="closeTrainingCatalog"><i class="fa-solid fa-xmark text-slate-400"></i></button></div><p class="text-sm text-slate-500">Available employee trainings are shown in the recommended section. Registration actions are UI-ready for backend wiring.</p></div></div>
    <script>
        const sidebarToggle = document.getElementById('sidebarToggle'), sidebarOverlay = document.getElementById('sidebarOverlay'), desktopSidebarBreakpoint = window.matchMedia('(min-width: 1024px)'), modal = document.getElementById('trainingCatalogModal');
        sidebarToggle.addEventListener('click', () => document.body.classList.toggle('sidebar-open')); sidebarOverlay.addEventListener('click', () => { if (!desktopSidebarBreakpoint.matches) document.body.classList.remove('sidebar-open'); }); window.addEventListener('resize', () => { if (desktopSidebarBreakpoint.matches) document.body.classList.remove('sidebar-open'); });
        document.getElementById('openTrainingCatalog').addEventListener('click', () => modal.classList.replace('hidden','flex')); document.getElementById('closeTrainingCatalog').addEventListener('click', () => modal.classList.replace('flex','hidden')); modal.addEventListener('click', event => { if (event.target === modal) modal.classList.replace('flex','hidden'); });
        document.querySelectorAll('.continue-training').forEach(button => button.addEventListener('click', () => { button.textContent = 'Training Opened'; button.classList.replace('bg-indigo-600','bg-emerald-600'); }));
    </script>
</body>
</html>
