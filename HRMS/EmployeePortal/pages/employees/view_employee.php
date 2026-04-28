<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Portal - My Profile</title>
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
        .status-pill { padding: 4px 12px; border-radius: 9999px; font-size: .75rem; font-weight: 600; background: #dcfce7; color: #166534; }
        .modal-backdrop { background: rgba(15,23,42,.45); backdrop-filter: blur(4px); }
        @media (max-width: 1023px) { #dashboardMain { margin-left: 0 !important; } .sidebar-shell { width: 17rem; } body.sidebar-open .sidebar-shell { transform: translateX(0); } body.sidebar-open #sidebarOverlay { opacity: 1; pointer-events: auto; } }
    </style>
</head>
<body class="flex min-h-screen bg-slate-50">
    <?php $menuBasePath = '../../'; ?>
    <?php $currentMenu = 'employee_profile'; ?>
    <?php $headerUserName = 'Cabdiraxmaan Cali'; ?>
    <?php $headerUserRole = 'Employee Portal'; ?>
    <?php $headerUserAvatar = 'https://api.dicebear.com/7.x/avataaars/svg?seed=Cabdirahman'; ?>
    <?php include __DIR__ . '/../../includes/header_sidebar.php'; ?>

    <div class="mx-auto w-full max-w-[1440px] p-4 md:p-8">
        <div class="mb-8 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-slate-800">My Profile</h2>
                <p class="text-sm text-slate-500">Personal, employment, contact, and document details.</p>
            </div>
            <button id="openUpdateProfileModal" type="button" class="rounded-xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-indigo-500">
                <i class="fa-regular fa-pen-to-square mr-2"></i>Request Update
            </button>
        </div>

        <div class="grid grid-cols-1 gap-6 xl:grid-cols-[360px_1fr]">
            <div class="glass-card overflow-hidden">
                <div class="bg-indigo-600 px-6 py-8 text-white">
                    <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Cabdirahman" class="h-24 w-24 rounded-2xl border-4 border-white/30 bg-white" alt="Cabdiraxmaan Cali">
                    <h3 class="mt-5 text-xl font-bold">Cabdiraxmaan Cali</h3>
                    <p class="mt-1 text-sm text-indigo-100">Human Resource Officer</p>
                    <span class="mt-3 inline-flex rounded-full bg-white/15 px-3 py-1 text-xs font-semibold">EMP-0001</span>
                </div>
                <div class="space-y-4 p-6 text-sm">
                    <div class="flex justify-between gap-4"><span class="text-slate-400">Status</span><span class="status-pill">Active</span></div>
                    <div class="flex justify-between gap-4"><span class="text-slate-400">Employment Type</span><span class="font-semibold text-slate-700">Full Time</span></div>
                    <div class="flex justify-between gap-4"><span class="text-slate-400">Join Date</span><span class="font-semibold text-slate-700">2024-01-12</span></div>
                    <div class="flex justify-between gap-4"><span class="text-slate-400">Manager</span><span class="font-semibold text-slate-700">Asha Mohamed</span></div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="glass-card p-6">
                    <h3 class="text-base font-semibold text-slate-800">Personal Information</h3>
                    <div class="mt-5 grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="rounded-2xl bg-slate-50 p-4"><p class="text-xs text-slate-400">Full Name</p><p class="mt-2 text-sm font-semibold text-slate-700">Cabdiraxmaan Cali</p></div>
                        <div class="rounded-2xl bg-slate-50 p-4"><p class="text-xs text-slate-400">Date of Birth</p><p class="mt-2 text-sm font-semibold text-slate-700">1992-04-18</p></div>
                        <div class="rounded-2xl bg-slate-50 p-4"><p class="text-xs text-slate-400">Gender</p><p class="mt-2 text-sm font-semibold text-slate-700">Male</p></div>
                        <div class="rounded-2xl bg-slate-50 p-4"><p class="text-xs text-slate-400">Location</p><p class="mt-2 text-sm font-semibold text-slate-700">Idaacada, Hargeisa</p></div>
                    </div>
                </div>

                <div class="glass-card p-6">
                    <h3 class="text-base font-semibold text-slate-800">Contact & Department</h3>
                    <div class="mt-5 grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="rounded-2xl bg-slate-50 p-4"><p class="text-xs text-slate-400">Email</p><p class="mt-2 text-sm font-semibold text-slate-700">cabdiraxmaan.cali@hrms.local</p></div>
                        <div class="rounded-2xl bg-slate-50 p-4"><p class="text-xs text-slate-400">Phone</p><p class="mt-2 text-sm font-semibold text-slate-700">+252 61 555 0101</p></div>
                        <div class="rounded-2xl bg-slate-50 p-4"><p class="text-xs text-slate-400">Department</p><p class="mt-2 text-sm font-semibold text-slate-700">Human Resource</p></div>
                        <div class="rounded-2xl bg-slate-50 p-4"><p class="text-xs text-slate-400">Branch</p><p class="mt-2 text-sm font-semibold text-slate-700">Idaacada Branch</p></div>
                    </div>
                </div>

                <div class="glass-card p-6">
                    <h3 class="text-base font-semibold text-slate-800">My Documents</h3>
                    <div class="mt-5 grid grid-cols-1 gap-3 md:grid-cols-3">
                        <button class="rounded-2xl border border-slate-100 bg-slate-50 p-4 text-left text-sm font-semibold text-slate-700 transition hover:bg-slate-100">Employment Contract <i class="fa-regular fa-eye float-right text-slate-400"></i></button>
                        <button class="rounded-2xl border border-slate-100 bg-slate-50 p-4 text-left text-sm font-semibold text-slate-700 transition hover:bg-slate-100">National ID Copy <i class="fa-regular fa-eye float-right text-slate-400"></i></button>
                        <button class="rounded-2xl border border-slate-100 bg-slate-50 p-4 text-left text-sm font-semibold text-slate-700 transition hover:bg-slate-100">Appointment Letter <i class="fa-regular fa-eye float-right text-slate-400"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="updateProfileModal" class="modal-backdrop fixed inset-0 z-50 hidden items-center justify-center p-4">
        <div class="glass-card w-full max-w-xl p-6">
            <div class="mb-5 flex items-start justify-between">
                <div><h3 class="text-lg font-semibold text-slate-800">Request Profile Update</h3><p class="text-sm text-slate-500">Send HR a correction request.</p></div>
                <button id="closeUpdateProfileModal" type="button" class="text-slate-400 hover:text-slate-600"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <textarea class="h-32 w-full rounded-xl border border-slate-200 p-4 text-sm outline-none focus:border-indigo-400" placeholder="Describe the profile information to update"></textarea>
            <div class="mt-5 flex justify-end gap-3"><button id="cancelUpdateProfileModal" class="rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-600">Cancel</button><button class="rounded-xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white">Submit Request</button></div>
        </div>
    </div>

    <script>
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const desktopSidebarBreakpoint = window.matchMedia('(min-width: 1024px)');
        const modal = document.getElementById('updateProfileModal');
        function syncSidebarMode(){ if (desktopSidebarBreakpoint.matches) document.body.classList.remove('sidebar-open'); }
        sidebarToggle.addEventListener('click', () => document.body.classList.toggle('sidebar-open'));
        sidebarOverlay.addEventListener('click', () => { if (!desktopSidebarBreakpoint.matches) document.body.classList.remove('sidebar-open'); });
        window.addEventListener('resize', syncSidebarMode);
        document.getElementById('openUpdateProfileModal').addEventListener('click', () => modal.classList.replace('hidden', 'flex'));
        document.getElementById('closeUpdateProfileModal').addEventListener('click', () => modal.classList.replace('flex', 'hidden'));
        document.getElementById('cancelUpdateProfileModal').addEventListener('click', () => modal.classList.replace('flex', 'hidden'));
        modal.addEventListener('click', event => { if (event.target === modal) modal.classList.replace('flex', 'hidden'); });
        syncSidebarMode();
    </script>
</body>
</html>
