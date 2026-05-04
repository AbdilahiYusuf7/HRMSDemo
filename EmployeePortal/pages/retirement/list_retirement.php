<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRM System - Retirement</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
            overflow-x: hidden;
        }

        #dashboardMain {
            min-width: 0;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(226, 232, 240, 0.8);
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.05), 0 2px 4px -2px rgb(0 0 0 / 0.05);
            border-radius: 1rem;
        }

        .sidebar-shell {
            box-shadow: 0 10px 30px -18px rgba(15, 23, 42, 0.3);
        }

        .sidebar-link:hover {
            background: rgba(99, 102, 241, 0.1);
            color: #6366f1;
        }

        .sidebar-link.active {
            background: #6366f1;
            color: white;
        }

        .sidebar-label,
        .sidebar-brand-text,
        .sidebar-support-label {
            transition: opacity 0.2s ease, transform 0.2s ease;
        }

        .sidebar-scroll-area {
            scrollbar-width: thin;
            scroll-behavior: smooth;
            scrollbar-gutter: stable;
        }

        .sidebar-scroll-area::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar-scroll-area::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar-scroll-area::-webkit-scrollbar-thumb {
            background: transparent;
            border-radius: 9999px;
        }

        .sidebar-shell:hover .sidebar-scroll-area::-webkit-scrollbar-thumb {
            background: #cbd5e1;
        }

        .insight-card:hover,
        .retirement-card:hover {
            transform: translateY(-2px);
            transition: all 0.3s ease;
        }

        .table-scroll::-webkit-scrollbar {
            height: 6px;
            width: 6px;
        }

        .table-scroll::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 9999px;
        }

        .table-scroll::-webkit-scrollbar-track {
            background: transparent;
        }

        .status-pill {
            padding: 4px 12px;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .status-eligible {
            background: #dcfce7;
            color: #166534;
        }

        .status-five-months {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .status-one-month {
            background: #fef3c7;
            color: #92400e;
        }

        .status-beyond {
            background: #f1f5f9;
            color: #475569;
        }

        .upcoming-retirement-summary {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.08), rgba(14, 165, 233, 0.06));
        }

        @media (max-width: 1023px) {
            #dashboardMain {
                margin-left: 0 !important;
            }

            .sidebar-shell {
                width: 17rem;
            }

            body.sidebar-open .sidebar-shell {
                transform: translateX(0);
            }

            body.sidebar-open #sidebarOverlay {
                opacity: 1;
                pointer-events: auto;
            }
        }
    </style>
</head>
<body class="flex min-h-screen bg-slate-50">
    <?php $menuBasePath = '../../'; ?>
    <?php $currentMenu = 'retirement'; ?>
    <?php include __DIR__ . '/../../includes/header_sidebar.php'; ?>

    <div class="mx-auto w-full max-w-[1440px] p-4 md:p-8">
        <div class="mb-8 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-slate-800">Retirement</h2>
                <p class="text-sm text-slate-500">Monitor retirement readiness, upcoming retirement dates, and employees currently moving through retirement tracking.</p>
            </div>
        </div>

        <div id="retirementInsightCards" class="mb-8 grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-4"></div>

        <details class="glass-card mb-8 overflow-hidden" open>
            <summary class="upcoming-retirement-summary flex cursor-pointer list-none items-center justify-between gap-4 px-6 py-5">
                <div>
                    <h3 class="text-base font-semibold text-slate-800">Upcoming Retirements This Month</h3>
                    <p class="mt-1 text-xs text-slate-400">Employees whose retirement dates fall within April 2026.</p>
                </div>
                <div class="flex items-center gap-3">
                    <span id="upcomingRetirementCount" class="rounded-full bg-white px-3 py-1 text-xs font-semibold text-indigo-600 shadow-sm">0 Employees</span>
                    <i class="fa-solid fa-chevron-down text-xs text-slate-500 transition-transform group-open:rotate-180"></i>
                </div>
            </summary>
            <div id="upcomingRetirementList" class="grid gap-4 border-t border-slate-100 px-6 py-5 md:grid-cols-2 xl:grid-cols-3"></div>
        </details>

        <div class="mb-8">
            <div class="mb-5">
                <h3 class="text-base font-semibold uppercase tracking-tight text-slate-800">Employees Approaching Retirement</h3>
                <p class="mt-1 text-sm text-slate-400">Monitor employees in retirement assessment sequence over the next 3 months.</p>
            </div>
            <div id="approachingRetirementCards" class="grid grid-cols-1 gap-6 xl:grid-cols-3"></div>
        </div>

        <div class="glass-card overflow-hidden">
            <div class="border-b border-slate-100 px-6 py-5">
                <h3 class="text-base font-semibold uppercase tracking-tight text-slate-800">Retirement Register</h3>
                <p class="mt-1 text-sm text-slate-400">Detailed list of employee retirement assessment data.</p>
            </div>
            <div class="table-scroll overflow-x-auto">
                <table class="min-w-full text-left">
                    <thead>
                        <tr class="border-b border-slate-100 text-[11px] uppercase tracking-[0.18em] text-slate-400">
                            <th class="px-5 py-4 font-semibold">Employee</th>
                            <th class="px-5 py-4 font-semibold">Department</th>
                            <th class="px-5 py-4 font-semibold">Location</th>
                            <th class="px-5 py-4 font-semibold">Age</th>
                            <th class="px-5 py-4 font-semibold">Retirement Date</th>
                            <th class="px-5 py-4 font-semibold">Remaining</th>
                            <th class="px-5 py-4 font-semibold">Status</th>
                            <th class="px-5 py-4 font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="retirementTableBody" class="divide-y divide-slate-50"></tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const desktopSidebarBreakpoint = window.matchMedia('(min-width: 1024px)');
        const retirementInsightCards = document.getElementById('retirementInsightCards');
        const upcomingRetirementCount = document.getElementById('upcomingRetirementCount');
        const upcomingRetirementList = document.getElementById('upcomingRetirementList');
        const approachingRetirementCards = document.getElementById('approachingRetirementCards');
        const retirementTableBody = document.getElementById('retirementTableBody');

        const today = new Date('2026-04-26T00:00:00');

        const retirementRecords = [
            { name: 'Mohamed Nuur', employeeId: 'EMP-0011', role: 'IT Administrator', department: 'Information Technology', location: 'Jigjiga Yar Branch', age: 59, retirementDate: '2026-04-28', remainingLabel: '2 days left' },
            { name: 'Hodan Maxamed', employeeId: 'EMP-0012', role: 'Senior Accountant', department: 'Finance', location: 'Xero Awr Branch', age: 60, retirementDate: '2026-04-29', remainingLabel: '3 days left' },
            { name: 'Fadumo Cabdi', employeeId: 'EMP-0013', role: 'HR Business Partner', department: 'Human Resource', location: 'Idaacada Branch', age: 60, retirementDate: '2026-04-30', remainingLabel: '4 days left' },
            { name: 'Cabdirisaaq Xasan', employeeId: 'EMP-0014', role: 'Operations Lead', department: 'Operations', location: 'Togdheer Branch', age: 59, retirementDate: '2026-05-10', remainingLabel: '14 days left' },
            { name: 'Nimco Aadan', employeeId: 'EMP-0015', role: 'Admin Supervisor', department: 'Administration', location: 'Masalaha Branch', age: 59, retirementDate: '2026-05-24', remainingLabel: '28 days left' },
            { name: 'Ayan Cali', employeeId: 'EMP-0016', role: 'Senior Marketing Officer', department: 'Marketing', location: 'Calaamada Branch', age: 58, retirementDate: '2026-06-18', remainingLabel: '1.8 months left' },
            { name: 'Maxamed Faarax', employeeId: 'EMP-0017', role: 'Procurement Specialist', department: 'Administration', location: 'Masalaha Branch', age: 58, retirementDate: '2026-07-08', remainingLabel: '2.5 months left' },
            { name: 'Sahra Warsame', employeeId: 'EMP-0018', role: 'Finance Analyst', department: 'Finance', location: 'Xero Awr Branch', age: 58, retirementDate: '2026-08-21', remainingLabel: '3.9 months left' },
            { name: 'Khadar Cabdi', employeeId: 'EMP-0019', role: 'Field Supervisor', department: 'Operations', location: 'Togdheer Branch', age: 57, retirementDate: '2026-09-12', remainingLabel: '4.6 months left' },
            { name: 'Ifrah Maxamed', employeeId: 'EMP-0020', role: 'Systems Support Officer', department: 'Information Technology', location: 'Jigjiga Yar Branch', age: 56, retirementDate: '2026-11-05', remainingLabel: '6.3 months left' }
        ];

        const retirementCardConfig = [
            { key: 'trackedEmployees', label: 'Employees Tracked', border: 'border-indigo-500', iconBg: 'bg-indigo-50', iconColor: 'text-indigo-600', icon: 'fa-users', helper: 'Employees currently included in the retirement tracking register.' },
            { key: 'eligibleNow', label: 'Eligible Now', border: 'border-emerald-500', iconBg: 'bg-emerald-50', iconColor: 'text-emerald-600', icon: 'fa-user-check', helper: 'Employees reaching retirement during the current month.' },
            { key: 'withinFiveMonths', label: 'Within 5 Months', border: 'border-sky-500', iconBg: 'bg-sky-50', iconColor: 'text-sky-600', icon: 'fa-hourglass-half', helper: 'Employees retiring within the next five months from today.' },
            { key: 'withinOneMonth', label: 'Within 1 Month', border: 'border-amber-500', iconBg: 'bg-amber-50', iconColor: 'text-amber-600', icon: 'fa-calendar-days', helper: 'Employees retiring within the next 30 days.' }
        ];

        function handleSidebarToggle() {
            document.body.classList.toggle('sidebar-open');
        }

        function closeMobileSidebar() {
            if (!desktopSidebarBreakpoint.matches) {
                document.body.classList.remove('sidebar-open');
            }
        }

        function syncSidebarMode() {
            if (desktopSidebarBreakpoint.matches) {
                document.body.classList.remove('sidebar-open');
            }
        }

        function getDaysUntilRetirement(retirementDate) {
            const targetDate = new Date(`${retirementDate}T00:00:00`);
            const millisecondsPerDay = 24 * 60 * 60 * 1000;
            return Math.ceil((targetDate - today) / millisecondsPerDay);
        }

        function getMonthsUntilRetirement(retirementDate) {
            return getDaysUntilRetirement(retirementDate) / 30;
        }

        function isCurrentMonthRetirement(retirementDate) {
            const targetDate = new Date(`${retirementDate}T00:00:00`);
            return targetDate.getFullYear() === today.getFullYear() && targetDate.getMonth() === today.getMonth();
        }

        function getRetirementStatus(record) {
            const daysUntilRetirement = getDaysUntilRetirement(record.retirementDate);
            const monthsUntilRetirement = getMonthsUntilRetirement(record.retirementDate);

            if (isCurrentMonthRetirement(record.retirementDate) || daysUntilRetirement <= 0) {
                return 'Eligible Now';
            }

            if (daysUntilRetirement <= 30) {
                return 'Within 1 Month';
            }

            if (monthsUntilRetirement <= 5) {
                return 'Within 5 Months';
            }

            return 'Beyond 5 Months';
        }

        function getStatusClass(status) {
            if (status === 'Eligible Now') {
                return 'status-eligible';
            }

            if (status === 'Within 1 Month') {
                return 'status-one-month';
            }

            if (status === 'Within 5 Months') {
                return 'status-five-months';
            }

            return 'status-beyond';
        }

        function getInitials(name) {
            return name
                .split(' ')
                .slice(0, 2)
                .map(part => part.charAt(0).toUpperCase())
                .join('');
        }

        function buildRetirementSummary() {
            const eligibleNow = retirementRecords.filter(record => getRetirementStatus(record) === 'Eligible Now').length;
            const withinOneMonth = retirementRecords.filter(record => getDaysUntilRetirement(record.retirementDate) > 0 && getDaysUntilRetirement(record.retirementDate) <= 30).length;
            const withinFiveMonths = retirementRecords.filter(record => getDaysUntilRetirement(record.retirementDate) > 0 && getMonthsUntilRetirement(record.retirementDate) <= 5).length;

            return {
                trackedEmployees: `${retirementRecords.length} Employees`,
                eligibleNow: `${eligibleNow} Employees`,
                withinFiveMonths: `${withinFiveMonths} Employees`,
                withinOneMonth: `${withinOneMonth} Employees`
            };
        }

        function renderInsightCards() {
            const summary = buildRetirementSummary();

            retirementInsightCards.innerHTML = retirementCardConfig.map(card => `
                <div class="glass-card insight-card border-l-4 ${card.border} p-5">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-500">${card.label}</p>
                            <h3 class="mt-2 text-2xl font-bold text-slate-800">${summary[card.key]}</h3>
                        </div>
                        <div class="rounded-xl ${card.iconBg} p-3 ${card.iconColor}">
                            <i class="fa-solid ${card.icon} text-lg"></i>
                        </div>
                    </div>
                    <p class="mt-4 text-[11px] font-medium text-slate-400">${card.helper}</p>
                </div>
            `).join('');
        }

        function renderUpcomingRetirements() {
            const currentMonthRetirements = retirementRecords
                .filter(record => isCurrentMonthRetirement(record.retirementDate))
                .sort((left, right) => new Date(left.retirementDate) - new Date(right.retirementDate));

            upcomingRetirementCount.textContent = `${currentMonthRetirements.length} Employees`;

            upcomingRetirementList.innerHTML = currentMonthRetirements.map(record => `
                <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <p class="text-sm font-semibold text-slate-800">${record.name}</p>
                            <p class="mt-1 text-xs text-slate-400">${record.role}</p>
                        </div>
                        <span class="status-pill status-eligible">Eligible Now</span>
                    </div>
                    <div class="mt-4 space-y-2 text-sm text-slate-600">
                        <div class="flex items-center justify-between gap-4">
                            <span class="text-slate-400">Department</span>
                            <span class="font-medium text-slate-700">${record.department}</span>
                        </div>
                        <div class="flex items-center justify-between gap-4">
                            <span class="text-slate-400">Retirement Date</span>
                            <span class="font-medium text-slate-700">${record.retirementDate}</span>
                        </div>
                        <div class="flex items-center justify-between gap-4">
                            <span class="text-slate-400">Remaining</span>
                            <span class="font-medium text-slate-700">${record.remainingLabel}</span>
                        </div>
                    </div>
                </div>
            `).join('');
        }

        function renderApproachingRetirementCards() {
            const nextThreeMonths = retirementRecords
                .filter(record => {
                    const daysUntilRetirement = getDaysUntilRetirement(record.retirementDate);
                    return daysUntilRetirement > 30 && daysUntilRetirement <= 90;
                })
                .sort((left, right) => new Date(left.retirementDate) - new Date(right.retirementDate))
                .slice(0, 3);

            approachingRetirementCards.innerHTML = nextThreeMonths.map(record => {
                return `
                    <div class="glass-card retirement-card rounded-[1.4rem] p-6">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex items-start gap-4">
                                <img src="/HRMS/ceo.jpg" alt="${record.name}" class="h-16 w-16 rounded-2xl border border-slate-200 bg-white object-cover shadow-sm">
                                <div>
                                    <h4 class="text-[1.65rem] font-semibold leading-tight text-slate-800">${record.name}</h4>
                                    <p class="mt-1 text-sm text-slate-400">${record.role}</p>
                                </div>
                            </div>
                            <button type="button" class="text-slate-300 transition hover:text-slate-500">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </button>
                        </div>
                        <div class="mt-7 space-y-4 border-t border-slate-100 pt-5">
                            <div class="flex items-center justify-between gap-4">
                                <span class="text-slate-400">Department</span>
                                <span class="text-right font-medium text-slate-700">${record.department}</span>
                            </div>
                            <div class="flex items-center justify-between gap-4">
                                <span class="text-slate-400">Location</span>
                                <span class="text-right font-medium text-slate-700">${record.location}</span>
                            </div>
                        </div>
                        <div class="mt-7 flex flex-wrap gap-3">
                            <span class="status-pill ${getStatusClass(getRetirementStatus(record))}">${getRetirementStatus(record)}</span>
                            <span class="rounded-full bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-500">${record.remainingLabel}</span>
                        </div>
                    </div>
                `;
            }).join('');
        }

        function renderRetirementTable() {
            const records = retirementRecords
                .slice()
                .sort((left, right) => new Date(left.retirementDate) - new Date(right.retirementDate));

            retirementTableBody.innerHTML = records.map(record => {
                const status = getRetirementStatus(record);

                return `
                    <tr class="transition-colors hover:bg-slate-50/70">
                        <td class="px-5 py-4">
                            <div>
                                <p class="text-sm font-semibold text-slate-700">${record.name}</p>
                                <p class="text-[11px] text-slate-400">${record.employeeId} · ${record.role}</p>
                            </div>
                        </td>
                        <td class="px-5 py-4 text-sm text-slate-600">${record.department}</td>
                        <td class="px-5 py-4 text-sm text-slate-600">${record.location}</td>
                        <td class="px-5 py-4 text-sm text-slate-600">${record.age}</td>
                        <td class="px-5 py-4 text-sm text-slate-600">${record.retirementDate}</td>
                        <td class="px-5 py-4 text-sm text-slate-600">${record.remainingLabel}</td>
                        <td class="px-5 py-4"><span class="status-pill ${getStatusClass(status)}">${status}</span></td>
                        <td class="px-5 py-4">
                            <button type="button" class="view-retirement-record inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-600 transition hover:bg-slate-50" data-employee-id="${record.employeeId}">
                                <i class="fa-regular fa-eye"></i>
                                <span>View</span>
                            </button>
                        </td>
                    </tr>
                `;
            }).join('');
        }

        function renderRetirementPage() {
            renderInsightCards();
            renderUpcomingRetirements();
            renderApproachingRetirementCards();
            renderRetirementTable();
        }

        function ensureRetirementDetailModal() {
            let modal = document.getElementById('retirementDetailModal');

            if (modal) {
                return modal;
            }

            document.body.insertAdjacentHTML('beforeend', `
                <div id="retirementDetailModal" class="modal-backdrop fixed inset-0 z-50 hidden items-center justify-center p-4">
                    <div class="glass-card w-full max-w-2xl overflow-hidden">
                        <div class="flex items-start justify-between gap-4 border-b border-slate-100 px-6 py-5">
                            <div>
                                <h3 id="retirementDetailTitle" class="text-lg font-semibold text-slate-800"></h3>
                                <p id="retirementDetailSubtitle" class="mt-1 text-sm text-slate-500"></p>
                            </div>
                            <button id="closeRetirementDetailModal" type="button" class="flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-500 transition hover:bg-slate-50 hover:text-slate-800">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                        <div id="retirementDetailBody" class="grid gap-3 p-6 sm:grid-cols-2"></div>
                    </div>
                </div>
            `);

            modal = document.getElementById('retirementDetailModal');
            document.getElementById('closeRetirementDetailModal').addEventListener('click', hideRetirementDetailModal);
            modal.addEventListener('click', event => {
                if (event.target === modal) {
                    hideRetirementDetailModal();
                }
            });

            return modal;
        }

        function hideRetirementDetailModal() {
            const modal = document.getElementById('retirementDetailModal');

            if (!modal) {
                return;
            }

            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        }

        function showRetirementDetail(record) {
            const modal = ensureRetirementDetailModal();
            const status = getRetirementStatus(record);
            const rows = [
                ['Employee ID', record.employeeId],
                ['Role', record.role],
                ['Department', record.department],
                ['Location', record.location],
                ['Age', record.age],
                ['Retirement Date', record.retirementDate],
                ['Remaining', record.remainingLabel],
                ['Status', status]
            ];

            document.getElementById('retirementDetailTitle').textContent = record.name;
            document.getElementById('retirementDetailSubtitle').textContent = 'Retirement tracking detail';
            document.getElementById('retirementDetailBody').innerHTML = rows.map(([label, value]) => `
                <div class="rounded-xl border border-slate-100 bg-slate-50 p-4">
                    <p class="text-[11px] font-semibold uppercase tracking-wide text-slate-400">${label}</p>
                    <p class="mt-1 text-sm font-semibold text-slate-700">${value}</p>
                </div>
            `).join('');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
        }

        sidebarToggle.addEventListener('click', handleSidebarToggle);
        sidebarOverlay.addEventListener('click', closeMobileSidebar);
        window.addEventListener('resize', syncSidebarMode);
        retirementTableBody.addEventListener('click', event => {
            const trigger = event.target.closest('.view-retirement-record');

            if (!trigger) {
                return;
            }

            const record = retirementRecords.find(item => item.employeeId === trigger.dataset.employeeId);

            if (record) {
                showRetirementDetail(record);
            }
        });

        renderRetirementPage();
        syncSidebarMode();
    </script>
</body>
</html>
