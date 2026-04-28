<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRM System - Promotion History</title>
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

        .insight-card:hover {
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
    <?php $currentMenu = 'promotion_history'; ?>
    <?php include __DIR__ . '/../../includes/header_sidebar.php'; ?>

    <div class="mx-auto w-full max-w-[1440px] p-4 md:p-8">
        <div class="mb-8 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-slate-800">Promotion History</h2>
                <p class="text-sm text-slate-500">Audit promotion changes, compare role movement, and review historical approval outcomes.</p>
            </div>
        </div>

        <div id="promotionHistoryCards" class="mb-8 grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-4"></div>

        <div class="glass-card mb-8 p-6">
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-5">
                <div>
                    <label for="promotionHistoryEmployeeSearch" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Employee</label>
                    <input id="promotionHistoryEmployeeSearch" type="text" placeholder="Search employee" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                </div>
                <div>
                    <label for="promotionHistoryDepartmentFilter" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Department</label>
                    <select id="promotionHistoryDepartmentFilter" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                        <option value="All Departments">All Departments</option>
                    </select>
                </div>
                <div>
                    <label for="promotionHistoryFromRoleFilter" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">From Role</label>
                    <select id="promotionHistoryFromRoleFilter" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                        <option value="All Roles">All Roles</option>
                    </select>
                </div>
                <div>
                    <label for="promotionHistoryToRoleFilter" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">To Role</label>
                    <select id="promotionHistoryToRoleFilter" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                        <option value="All Roles">All Roles</option>
                    </select>
                </div>
                <div>
                    <label for="promotionHistoryDateRangeFilter" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Date Range</label>
                    <input id="promotionHistoryDateRangeFilter" type="text" value="Apr 01, 2026 - Jun 30, 2026" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                </div>
                <div>
                    <label for="promotionHistoryReasonFilter" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Promotion Reason</label>
                    <select id="promotionHistoryReasonFilter" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                        <option value="All Reasons">All Reasons</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="glass-card overflow-hidden">
            <div class="border-b border-slate-100 px-6 py-5">
                <h3 class="text-base font-semibold text-slate-800">Promotion History Register</h3>
                <p class="mt-1 text-xs text-slate-400">Compact historical list for audit and reporting views.</p>
            </div>
            <div class="table-scroll overflow-x-auto">
                <table class="min-w-full text-left">
                    <thead>
                        <tr class="border-b border-slate-100 text-[11px] uppercase tracking-[0.18em] text-slate-400">
                            <th class="px-5 py-4 font-semibold">Employee</th>
                            <th class="px-5 py-4 font-semibold">Previous Role</th>
                            <th class="px-5 py-4 font-semibold">New Role</th>
                            <th class="px-5 py-4 font-semibold">Previous Rank / Grade</th>
                            <th class="px-5 py-4 font-semibold">New Rank / Grade</th>
                            <th class="px-5 py-4 font-semibold">Effective Date</th>
                            <th class="px-5 py-4 font-semibold">Reason</th>
                            <th class="px-5 py-4 font-semibold">Approved By</th>
                            <th class="px-5 py-4 font-semibold">Notes</th>
                            <th class="px-5 py-4 font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="promotionHistoryTableBody" class="divide-y divide-slate-50"></tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const desktopSidebarBreakpoint = window.matchMedia('(min-width: 1024px)');
        const promotionHistoryCards = document.getElementById('promotionHistoryCards');
        const promotionHistoryTableBody = document.getElementById('promotionHistoryTableBody');
        const promotionHistoryEmployeeSearch = document.getElementById('promotionHistoryEmployeeSearch');
        const promotionHistoryDepartmentFilter = document.getElementById('promotionHistoryDepartmentFilter');
        const promotionHistoryFromRoleFilter = document.getElementById('promotionHistoryFromRoleFilter');
        const promotionHistoryToRoleFilter = document.getElementById('promotionHistoryToRoleFilter');
        const promotionHistoryDateRangeFilter = document.getElementById('promotionHistoryDateRangeFilter');
        const promotionHistoryReasonFilter = document.getElementById('promotionHistoryReasonFilter');

        const promotionHistoryRecords = [
            { employee: 'Cabdiraxmaan Cali', department: 'Human Resource', previousRole: 'Human Resource Officer', newRole: 'Senior Human Resource Officer', previousRankGrade: 'Officer II / G6', newRankGrade: 'Officer III / G7', effectiveDate: '2026-04-12', reason: 'Performance based progression', approvedBy: 'Asha Mohamed', notes: 'Exceeded annual target and completed leadership training.', monthsToPromotion: 36 },
            { employee: 'Fadumo Xasan', department: 'Finance', previousRole: 'Finance Officer', newRole: 'Lead Finance Officer', previousRankGrade: 'Officer III / G7', newRankGrade: 'Lead Officer / G8', effectiveDate: '2026-05-20', reason: 'Leadership readiness', approvedBy: 'Mohamed Yusuf', notes: 'Led branch controls review and mentoring program.', monthsToPromotion: 42 },
            { employee: 'Mahad Axmed', department: 'Operations', previousRole: 'Operations Supervisor', newRole: 'Branch Lead', previousRankGrade: 'Supervisor / G8', newRankGrade: 'Lead / G9', effectiveDate: '2026-04-28', reason: 'Performance based progression', approvedBy: 'Hodan Ali', notes: 'Delivered branch readiness and emergency operations targets.', monthsToPromotion: 40 },
            { employee: 'Sahra Maxamed', department: 'Marketing', previousRole: 'Marketing Associate', newRole: 'Marketing Coordinator', previousRankGrade: 'Associate / G4', newRankGrade: 'Coordinator / G5', effectiveDate: '2026-05-08', reason: 'Qualification upgrade', approvedBy: 'Ahmed Jama', notes: 'Promotion recorded after qualification and campaign performance uplift.', monthsToPromotion: 18 },
            { employee: 'Hodan Ali', department: 'Administration', previousRole: 'Administration Officer', newRole: 'Senior Administration Officer', previousRankGrade: 'Officer I / G5', newRankGrade: 'Officer II / G6', effectiveDate: '2026-04-18', reason: 'Attendance threshold', approvedBy: 'Cali Maxamed', notes: 'Maintained full compliance and branch coordination metrics.', monthsToPromotion: 28 },
            { employee: 'Mustafe Cabdi', department: 'Information Technology', previousRole: 'Systems Support Engineer', newRole: 'Systems Analyst', previousRankGrade: 'Engineer I / G6', newRankGrade: 'Engineer II / G7', effectiveDate: '2026-06-02', reason: 'Certification completion', approvedBy: 'Ilwad Noor', notes: 'Promotion applied after systems certification completion.', monthsToPromotion: 24 },
            { employee: 'Roda Jama', department: 'Finance', previousRole: 'Financial Analyst', newRole: 'Senior Financial Analyst', previousRankGrade: 'Analyst II / G6', newRankGrade: 'Senior Analyst / G7', effectiveDate: '2026-04-26', reason: 'Performance based progression', approvedBy: 'Mohamed Yusuf', notes: 'Strong financial reporting and audit readiness performance.', monthsToPromotion: 30 },
            { employee: 'Amina Yusuf', department: 'Human Resource', previousRole: 'Talent Officer', newRole: 'HR Business Partner', previousRankGrade: 'Officer II / G6', newRankGrade: 'Officer III / G7', effectiveDate: '2026-06-10', reason: 'Leadership readiness', approvedBy: 'Asha Mohamed', notes: 'Progressed into wider HR advisory scope.', monthsToPromotion: 26 },
            { employee: 'Mohamed Yusuf', department: 'Administration', previousRole: 'Records Coordinator', newRole: 'Operations Officer', previousRankGrade: 'Coordinator / G5', newRankGrade: 'Officer I / G6', effectiveDate: '2026-05-24', reason: 'Performance based progression', approvedBy: 'Cali Maxamed', notes: 'Transitioned into expanded branch operations responsibilities.', monthsToPromotion: 32 },
            { employee: 'Ilwad Noor', department: 'Information Technology', previousRole: 'Software Developer I', newRole: 'Software Developer II', previousRankGrade: 'Developer I / G6', newRankGrade: 'Developer II / G7', effectiveDate: '2026-05-29', reason: 'Certification completion', approvedBy: 'Mustafe Cabdi', notes: 'Met delivery, architecture, and certification milestones.', monthsToPromotion: 22 }
        ];

        const promotionHistoryCardConfig = [
            { key: 'totalPromotions', label: 'Total Promotions', border: 'border-indigo-500', iconBg: 'bg-indigo-50', iconColor: 'text-indigo-600', icon: 'fa-arrow-trend-up', helper: 'Historical promotions currently available in the register.' },
            { key: 'thisMonth', label: 'This Month', border: 'border-emerald-500', iconBg: 'bg-emerald-50', iconColor: 'text-emerald-600', icon: 'fa-calendar-check', helper: 'Promotions effective in the current sample month.' },
            { key: 'thisYear', label: 'This Year', border: 'border-sky-500', iconBg: 'bg-sky-50', iconColor: 'text-sky-600', icon: 'fa-calendar-days', helper: 'Promotions effective during the current year.' },
            { key: 'avgPromotionTime', label: 'Avg Promotion Time', border: 'border-amber-500', iconBg: 'bg-amber-50', iconColor: 'text-amber-600', icon: 'fa-hourglass-half', helper: 'Average months taken to reach the promotion milestone.' }
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

        function buildPromotionHistorySummary(records) {
            const totalPromotions = records.length;
            const thisMonth = records.filter(record => record.effectiveDate.startsWith('2026-06')).length;
            const thisYear = records.filter(record => record.effectiveDate.startsWith('2026')).length;
            const averageMonths = records.length
                ? Math.round(records.reduce((total, record) => total + record.monthsToPromotion, 0) / records.length)
                : 0;

            return {
                totalPromotions: `${totalPromotions} Promotions`,
                thisMonth: `${thisMonth} Promotions`,
                thisYear: `${thisYear} Promotions`,
                avgPromotionTime: `${averageMonths} Months`
            };
        }

        function renderInsightCards(records) {
            const summary = buildPromotionHistorySummary(records);

            promotionHistoryCards.innerHTML = promotionHistoryCardConfig.map(card => `
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

        function populatePromotionHistoryFilters() {
            const filterMap = [
                { element: promotionHistoryDepartmentFilter, key: 'department', allLabel: 'All Departments' },
                { element: promotionHistoryFromRoleFilter, key: 'previousRole', allLabel: 'All Roles' },
                { element: promotionHistoryToRoleFilter, key: 'newRole', allLabel: 'All Roles' },
                { element: promotionHistoryReasonFilter, key: 'reason', allLabel: 'All Reasons' }
            ];

            filterMap.forEach(filterItem => {
                const values = [...new Set(promotionHistoryRecords.map(record => record[filterItem.key]))].sort();
                filterItem.element.innerHTML = [`<option value="${filterItem.allLabel}">${filterItem.allLabel}</option>`]
                    .concat(values.map(value => `<option value="${value}">${value}</option>`))
                    .join('');
            });
        }

        function getFilteredPromotionHistory() {
            const searchTerm = promotionHistoryEmployeeSearch.value.trim().toLowerCase();

            return promotionHistoryRecords.filter(record => {
                const matchesSearch = !searchTerm || record.employee.toLowerCase().includes(searchTerm);
                const matchesDepartment = promotionHistoryDepartmentFilter.value === 'All Departments' || record.department === promotionHistoryDepartmentFilter.value;
                const matchesFromRole = promotionHistoryFromRoleFilter.value === 'All Roles' || record.previousRole === promotionHistoryFromRoleFilter.value;
                const matchesToRole = promotionHistoryToRoleFilter.value === 'All Roles' || record.newRole === promotionHistoryToRoleFilter.value;
                const matchesReason = promotionHistoryReasonFilter.value === 'All Reasons' || record.reason === promotionHistoryReasonFilter.value;

                return matchesSearch
                    && matchesDepartment
                    && matchesFromRole
                    && matchesToRole
                    && matchesReason;
            });
        }

        function renderPromotionHistoryTable(records) {
            promotionHistoryTableBody.innerHTML = records.map(record => `
                <tr class="transition-colors hover:bg-slate-50/70">
                    <td class="px-5 py-4 text-sm font-semibold text-slate-700">${record.employee}</td>
                    <td class="px-5 py-4 text-sm text-slate-600">${record.previousRole}</td>
                    <td class="px-5 py-4 text-sm text-slate-600">${record.newRole}</td>
                    <td class="px-5 py-4 text-sm text-slate-600">${record.previousRankGrade}</td>
                    <td class="px-5 py-4 text-sm text-slate-600">${record.newRankGrade}</td>
                    <td class="px-5 py-4 text-sm text-slate-600">${record.effectiveDate}</td>
                    <td class="px-5 py-4 text-sm text-slate-600">${record.reason}</td>
                    <td class="px-5 py-4 text-sm text-slate-600">${record.approvedBy}</td>
                    <td class="px-5 py-4 text-sm text-slate-600">${record.notes}</td>
                    <td class="px-5 py-4">
                        <button type="button" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-600 transition hover:bg-slate-50">
                            <i class="fa-regular fa-eye"></i>
                            <span>View</span>
                        </button>
                    </td>
                </tr>
            `).join('');
        }

        function renderPromotionHistoryPage() {
            const records = getFilteredPromotionHistory();
            renderInsightCards(records);
            renderPromotionHistoryTable(records);
        }

        [
            promotionHistoryEmployeeSearch,
            promotionHistoryDepartmentFilter,
            promotionHistoryFromRoleFilter,
            promotionHistoryToRoleFilter,
            promotionHistoryDateRangeFilter,
            promotionHistoryReasonFilter
        ].forEach(filterElement => {
            filterElement.addEventListener('input', renderPromotionHistoryPage);
            filterElement.addEventListener('change', renderPromotionHistoryPage);
        });

        sidebarToggle.addEventListener('click', handleSidebarToggle);
        sidebarOverlay.addEventListener('click', closeMobileSidebar);
        window.addEventListener('resize', syncSidebarMode);

        populatePromotionHistoryFilters();
        renderPromotionHistoryPage();
        syncSidebarMode();
    </script>
</body>
</html>
