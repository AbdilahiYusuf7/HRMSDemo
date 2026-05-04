<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Portal - My Leaves</title>
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
        .insight-card:hover { transform: translateY(-2px); transition: all .3s ease; }
        .status-pill { padding: 4px 12px; border-radius: 9999px; font-size: .75rem; font-weight: 600; }
        .status-approved { background: #dcfce7; color: #166534; }
        .status-pending { background: #fef3c7; color: #92400e; }
        .modal-backdrop { background: rgba(15,23,42,.45); backdrop-filter: blur(4px); }
        .table-scroll::-webkit-scrollbar { height: 6px; width: 6px; }
        .table-scroll::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 9999px; }
        @media (max-width: 1023px) { #dashboardMain { margin-left: 0 !important; } .sidebar-shell { width: 17rem; } body.sidebar-open .sidebar-shell { transform: translateX(0); } body.sidebar-open #sidebarOverlay { opacity: 1; pointer-events: auto; } }
    </style>
</head>
<body class="flex min-h-screen bg-slate-50">
    <?php $menuBasePath = '../../'; ?>
    <?php $currentMenu = 'employee_leaves'; ?>
    <?php $headerUserName = 'Cabdiraxmaan Cali'; ?>
    <?php $headerUserRole = 'Employee Portal'; ?>
    <?php $headerUserAvatar = '/HRMS/ceo.jpg'; ?>
    <?php include __DIR__ . '/../../includes/header_sidebar.php'; ?>
    <div class="mx-auto w-full max-w-[1440px] p-4 md:p-8">
        <div class="mb-8 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
            <div><h2 class="text-2xl font-semibold text-slate-800">My Leaves</h2><p class="text-sm text-slate-500">Request leave and track your own balances and approvals.</p></div>
            <button id="openLeaveModal" class="rounded-xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-indigo-500"><i class="fa-solid fa-plus mr-2"></i>Request Leave</button>
        </div>
        <div class="mb-8 grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">
            <div class="glass-card insight-card border-l-4 border-indigo-500 p-5"><p class="text-sm text-slate-500">Annual Allowance</p><h3 class="mt-2 text-2xl font-bold text-slate-800">30 Days</h3></div>
            <div class="glass-card insight-card border-l-4 border-emerald-500 p-5"><p class="text-sm text-slate-500">Remaining</p><h3 class="mt-2 text-2xl font-bold text-slate-800">21 Days</h3></div>
            <div class="glass-card insight-card border-l-4 border-amber-500 p-5"><p class="text-sm text-slate-500">Pending</p><h3 class="mt-2 text-2xl font-bold text-slate-800">1 Request</h3></div>
            <div class="glass-card insight-card border-l-4 border-sky-500 p-5"><p class="text-sm text-slate-500">Used</p><h3 class="mt-2 text-2xl font-bold text-slate-800">9 Days</h3></div>
        </div>
        <div class="glass-card p-6">
            <h3 class="text-base font-semibold text-slate-800">Leave History</h3>
            <div class="mt-5 table-scroll overflow-x-auto">
                <table class="min-w-full text-left"><thead><tr class="border-b border-slate-100 text-[11px] uppercase tracking-wider text-slate-400"><th class="px-4 py-4">Type</th><th class="px-4 py-4">Dates</th><th class="px-4 py-4">Days</th><th class="px-4 py-4">Submitted</th><th class="px-4 py-4">Status</th></tr></thead>
                    <tbody class="divide-y divide-slate-50">
                        <tr><td class="px-4 py-4 text-sm font-semibold text-slate-700">Annual Leave</td><td class="px-4 py-4 text-sm text-slate-600">2026-04-28 to 2026-05-01</td><td class="px-4 py-4 text-sm text-slate-600">4</td><td class="px-4 py-4 text-sm text-slate-600">2026-04-20</td><td class="px-4 py-4"><span class="status-pill status-approved">Approved</span></td></tr>
                        <tr><td class="px-4 py-4 text-sm font-semibold text-slate-700">Shift Swap Request</td><td class="px-4 py-4 text-sm text-slate-600">2026-04-24</td><td class="px-4 py-4 text-sm text-slate-600">1</td><td class="px-4 py-4 text-sm text-slate-600">2026-04-22</td><td class="px-4 py-4"><span class="status-pill status-pending">Pending</span></td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="leaveModal" class="modal-backdrop fixed inset-0 z-50 hidden items-center justify-center p-4">
        <div class="glass-card w-full max-w-xl p-6">
            <div class="mb-5 flex justify-between"><div><h3 class="text-lg font-semibold text-slate-800">Request Leave</h3><p class="text-sm text-slate-500">Submit a leave request to HR.</p></div><button id="closeLeaveModal"><i class="fa-solid fa-xmark text-slate-400"></i></button></div>
            <div class="grid gap-4 md:grid-cols-2">
                <select class="rounded-xl border border-slate-200 px-4 py-3 text-sm"><option>Annual Leave</option><option>Sick Leave</option><option>Emergency Leave</option></select>
                <input type="number" min="1" placeholder="Days" class="rounded-xl border border-slate-200 px-4 py-3 text-sm">
                <input type="date" class="rounded-xl border border-slate-200 px-4 py-3 text-sm">
                <input type="date" class="rounded-xl border border-slate-200 px-4 py-3 text-sm">
                <textarea class="md:col-span-2 rounded-xl border border-slate-200 px-4 py-3 text-sm" rows="4" placeholder="Reason"></textarea>
            </div>
            <div class="mt-5 flex justify-end gap-3"><button id="cancelLeaveModal" class="rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-600">Cancel</button><button class="rounded-xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white">Submit Request</button></div>
        </div>
    </div>
    <script>
        const sidebarToggle = document.getElementById('sidebarToggle'), sidebarOverlay = document.getElementById('sidebarOverlay'), desktopSidebarBreakpoint = window.matchMedia('(min-width: 1024px)'), modal = document.getElementById('leaveModal');
        sidebarToggle.addEventListener('click', () => document.body.classList.toggle('sidebar-open')); sidebarOverlay.addEventListener('click', () => { if (!desktopSidebarBreakpoint.matches) document.body.classList.remove('sidebar-open'); }); window.addEventListener('resize', () => { if (desktopSidebarBreakpoint.matches) document.body.classList.remove('sidebar-open'); });
        document.getElementById('openLeaveModal').addEventListener('click', () => modal.classList.replace('hidden','flex')); document.getElementById('closeLeaveModal').addEventListener('click', () => modal.classList.replace('flex','hidden')); document.getElementById('cancelLeaveModal').addEventListener('click', () => modal.classList.replace('flex','hidden')); modal.addEventListener('click', event => { if (event.target === modal) modal.classList.replace('flex','hidden'); });
    </script>
</body>
</html>
