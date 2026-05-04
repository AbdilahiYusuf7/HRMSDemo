<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRM System - Eligibility Reviews</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        .status-nearly {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .status-qualification {
            background: #fee2e2;
            color: #991b1b;
        }

        .status-tenure {
            background: #fef3c7;
            color: #92400e;
        }

        .status-performance {
            background: #ede9fe;
            color: #6d28d9;
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
    <?php $currentMenu = 'eligibility_reviews'; ?>
    <?php include __DIR__ . '/../../includes/header_sidebar.php'; ?>

    <div class="mx-auto w-full max-w-[1440px] p-4 md:p-8">
        <div class="mb-8 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-slate-800">Eligibility Reviews</h2>
                <p class="text-sm text-slate-500">Track promotion readiness outcomes, blockers, qualification gaps, and next role recommendations across teams.</p>
            </div>
        </div>

        <div id="eligibilityInsightCards" class="mb-8 grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-3"></div>

        <div class="mb-8 grid grid-cols-1 gap-6 xl:grid-cols-2">
            <div class="glass-card p-6">
                <div class="mb-5">
                    <h3 class="text-base font-semibold text-slate-800">Eligibility by Department</h3>
                    <p class="mt-1 text-xs text-slate-400">Current review outcomes grouped by department.</p>
                </div>
                <div class="h-80">
                    <canvas id="eligibilityByDepartmentChart"></canvas>
                </div>
            </div>
            <div class="glass-card p-6">
                <div class="mb-5">
                    <h3 class="text-base font-semibold text-slate-800">Block Reason Breakdown</h3>
                    <p class="mt-1 text-xs text-slate-400">Main reasons employees are not promotion-ready yet.</p>
                </div>
                <div class="h-80">
                    <canvas id="blockReasonBreakdownChart"></canvas>
                </div>
            </div>
        </div>

        <div class="glass-card mb-8 p-6">
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-5">
                <div>
                    <label for="eligibilityDepartmentFilter" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Department</label>
                    <select id="eligibilityDepartmentFilter" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                        <option value="All Departments">All Departments</option>
                    </select>
                </div>
                <div>
                    <label for="eligibilityRoleFilter" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Role</label>
                    <select id="eligibilityRoleFilter" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                        <option value="All Roles">All Roles</option>
                    </select>
                </div>
                <div>
                    <label for="eligibilityRankFilter" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Rank</label>
                    <select id="eligibilityRankFilter" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                        <option value="All Ranks">All Ranks</option>
                    </select>
                </div>
                <div>
                    <label for="eligibilityStatusFilter" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Eligibility Status</label>
                    <select id="eligibilityStatusFilter" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                        <option value="All">All</option>
                    </select>
                </div>
                <div>
                    <label for="qualificationStatusFilter" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Qualification Status</label>
                    <select id="qualificationStatusFilter" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                        <option value="All">All</option>
                    </select>
                </div>
                <div>
                    <label for="trainingCompletionFilter" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Training Completion</label>
                    <select id="trainingCompletionFilter" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                        <option value="All">All</option>
                    </select>
                </div>
                <div>
                    <label for="performanceRangeFilter" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Performance Range</label>
                    <select id="performanceRangeFilter" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                        <option value="All">All</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="glass-card overflow-hidden">
            <div class="border-b border-slate-100 px-6 py-5">
                <h3 class="text-base font-semibold text-slate-800">Eligibility Review Queue</h3>
                <p class="mt-1 text-xs text-slate-400">Operational table for readiness results, missing requirements, and suggested next role.</p>
            </div>
            <div class="table-scroll overflow-x-auto">
                <table class="min-w-full text-left">
                    <thead>
                        <tr class="border-b border-slate-100 text-[11px] uppercase tracking-[0.18em] text-slate-400">
                            <th class="px-5 py-4 font-semibold">Employee</th>
                            <th class="px-5 py-4 font-semibold">Current Role</th>
                            <th class="px-5 py-4 font-semibold">Rank</th>
                            <th class="px-5 py-4 font-semibold">Eligibility Result</th>
                            <th class="px-5 py-4 font-semibold">Missing Requirement</th>
                            <th class="px-5 py-4 font-semibold">Suggested Next Role</th>
                            <th class="px-5 py-4 font-semibold">Estimated Time</th>
                            <th class="px-5 py-4 font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="eligibilityReviewTableBody" class="divide-y divide-slate-50"></tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const desktopSidebarBreakpoint = window.matchMedia('(min-width: 1024px)');
        const eligibilityInsightCards = document.getElementById('eligibilityInsightCards');
        const eligibilityReviewTableBody = document.getElementById('eligibilityReviewTableBody');
        const eligibilityDepartmentFilter = document.getElementById('eligibilityDepartmentFilter');
        const eligibilityRoleFilter = document.getElementById('eligibilityRoleFilter');
        const eligibilityRankFilter = document.getElementById('eligibilityRankFilter');
        const eligibilityStatusFilter = document.getElementById('eligibilityStatusFilter');
        const qualificationStatusFilter = document.getElementById('qualificationStatusFilter');
        const trainingCompletionFilter = document.getElementById('trainingCompletionFilter');
        const performanceRangeFilter = document.getElementById('performanceRangeFilter');

        let eligibilityByDepartmentChart;
        let blockReasonBreakdownChart;

        const eligibilityReviewRecords = [
            { employee: 'Amina Xasan', employeeId: 'EMP-0001', department: 'Operations', currentRole: 'Senior Officer', rank: 'Rank II', eligibilityResult: 'Eligible Now', missingRequirement: 'None', suggestedNextRole: 'Branch Operations Lead', estimatedTime: 'Ready now', qualificationStatus: 'Complete', trainingCompletion: 'Completed', performanceRange: 'High', blockReason: 'None' },
            { employee: 'Mahad Axmed', employeeId: 'EMP-0002', department: 'Finance', currentRole: 'Finance Officer', rank: 'Rank III', eligibilityResult: 'Nearly Eligible', missingRequirement: 'Final review cycle completion', suggestedNextRole: 'Senior Finance Officer', estimatedTime: '1 Month', qualificationStatus: 'Complete', trainingCompletion: 'Completed', performanceRange: 'High', blockReason: 'Readiness Review' },
            { employee: 'Sahra Cali', employeeId: 'EMP-0003', department: 'Human Resource', currentRole: 'HR Officer', rank: 'Rank II', eligibilityResult: 'Missing Qualification', missingRequirement: 'Leadership certificate required', suggestedNextRole: 'Senior HR Officer', estimatedTime: '2 Months', qualificationStatus: 'Missing Qualification', trainingCompletion: 'Completed', performanceRange: 'High', blockReason: 'Qualification Gap' },
            { employee: 'Cabdirahman Faarax', employeeId: 'EMP-0004', department: 'Administration', currentRole: 'Admin Officer', rank: 'Rank I', eligibilityResult: 'Missing Tenure', missingRequirement: '6 more months in current role', suggestedNextRole: 'Senior Admin Officer', estimatedTime: '6 Months', qualificationStatus: 'Complete', trainingCompletion: 'Completed', performanceRange: 'Mid', blockReason: 'Tenure Gap' },
            { employee: 'Ifrah Maxamed', employeeId: 'EMP-0005', department: 'Marketing', currentRole: 'Marketing Coordinator', rank: 'Rank II', eligibilityResult: 'Missing Performance', missingRequirement: 'Performance score must reach threshold', suggestedNextRole: 'Marketing Lead', estimatedTime: 'Next cycle', qualificationStatus: 'Complete', trainingCompletion: 'In Progress', performanceRange: 'Low', blockReason: 'Performance Threshold' },
            { employee: 'Khadar Xuseen', employeeId: 'EMP-0006', department: 'Information Technology', currentRole: 'Systems Engineer', rank: 'Rank II', eligibilityResult: 'Eligible Now', missingRequirement: 'None', suggestedNextRole: 'Senior Systems Engineer', estimatedTime: 'Ready now', qualificationStatus: 'Complete', trainingCompletion: 'Completed', performanceRange: 'High', blockReason: 'None' },
            { employee: 'Nasteexo Warsame', employeeId: 'EMP-0007', department: 'Operations', currentRole: 'Field Supervisor', rank: 'Supervisor', eligibilityResult: 'Nearly Eligible', missingRequirement: 'Panel review pending', suggestedNextRole: 'Area Supervisor', estimatedTime: '2 Weeks', qualificationStatus: 'Complete', trainingCompletion: 'Completed', performanceRange: 'High', blockReason: 'Readiness Review' },
            { employee: 'Fadumo Xasan', employeeId: 'EMP-0008', department: 'Human Resource', currentRole: 'Recruitment Officer', rank: 'Rank I', eligibilityResult: 'Missing Qualification', missingRequirement: 'Diploma upgrade not yet verified', suggestedNextRole: 'Talent Acquisition Specialist', estimatedTime: '3 Months', qualificationStatus: 'Missing Qualification', trainingCompletion: 'Completed', performanceRange: 'Mid', blockReason: 'Qualification Gap' },
            { employee: 'Yuusuf Cabdi', employeeId: 'EMP-0009', department: 'Finance', currentRole: 'Accounts Officer', rank: 'Rank I', eligibilityResult: 'Missing Tenure', missingRequirement: 'Needs 8 more months in role', suggestedNextRole: 'Senior Accounts Officer', estimatedTime: '8 Months', qualificationStatus: 'Complete', trainingCompletion: 'In Progress', performanceRange: 'Mid', blockReason: 'Tenure Gap' },
            { employee: 'Hodan Aadan', employeeId: 'EMP-0010', department: 'Administration', currentRole: 'Compliance Officer', rank: 'Rank II', eligibilityResult: 'Missing Performance', missingRequirement: 'Performance plan still open', suggestedNextRole: 'Compliance Lead', estimatedTime: 'Next cycle', qualificationStatus: 'Complete', trainingCompletion: 'Completed', performanceRange: 'Low', blockReason: 'Performance Threshold' }
        ];

        const insightCardConfig = [
            { key: 'eligibleNow', label: 'Eligible Now', border: 'border-emerald-500', iconBg: 'bg-emerald-50', iconColor: 'text-emerald-600', icon: 'fa-badge-check', helper: 'Employees ready to move into promotion request routing.' },
            { key: 'nearlyEligible', label: 'Nearly Eligible', border: 'border-sky-500', iconBg: 'bg-sky-50', iconColor: 'text-sky-600', icon: 'fa-hourglass-half', helper: 'Employees close to readiness with a small remaining gap.' },
            { key: 'missingQualification', label: 'Missing Qualification', border: 'border-rose-500', iconBg: 'bg-rose-50', iconColor: 'text-rose-600', icon: 'fa-graduation-cap', helper: 'Employees blocked mainly by qualification evidence or credentials.' },
            { key: 'missingTenure', label: 'Missing Tenure', border: 'border-amber-500', iconBg: 'bg-amber-50', iconColor: 'text-amber-600', icon: 'fa-calendar-days', helper: 'Employees who need more time in their current role.' },
            { key: 'missingPerformance', label: 'Missing Performance', border: 'border-violet-500', iconBg: 'bg-violet-50', iconColor: 'text-violet-600', icon: 'fa-chart-line', helper: 'Employees below the current promotion performance threshold.' }
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

        function getEligibilityClass(result) {
            if (result === 'Eligible Now') {
                return 'status-eligible';
            }

            if (result === 'Nearly Eligible') {
                return 'status-nearly';
            }

            if (result === 'Missing Qualification') {
                return 'status-qualification';
            }

            if (result === 'Missing Tenure') {
                return 'status-tenure';
            }

            return 'status-performance';
        }

        function buildInsightSummary(records) {
            return {
                eligibleNow: `${records.filter(record => record.eligibilityResult === 'Eligible Now').length} Employees`,
                nearlyEligible: `${records.filter(record => record.eligibilityResult === 'Nearly Eligible').length} Employees`,
                missingQualification: `${records.filter(record => record.eligibilityResult === 'Missing Qualification').length} Employees`,
                missingTenure: `${records.filter(record => record.eligibilityResult === 'Missing Tenure').length} Employees`,
                missingPerformance: `${records.filter(record => record.eligibilityResult === 'Missing Performance').length} Employees`
            };
        }

        function renderInsightCards(records) {
            const summary = buildInsightSummary(records);

            eligibilityInsightCards.innerHTML = insightCardConfig.map(card => `
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

        function populateFilters() {
            const filterMap = [
                { element: eligibilityDepartmentFilter, key: 'department', allLabel: 'All Departments' },
                { element: eligibilityRoleFilter, key: 'currentRole', allLabel: 'All Roles' },
                { element: eligibilityRankFilter, key: 'rank', allLabel: 'All Ranks' },
                { element: eligibilityStatusFilter, key: 'eligibilityResult', allLabel: 'All' },
                { element: qualificationStatusFilter, key: 'qualificationStatus', allLabel: 'All' },
                { element: trainingCompletionFilter, key: 'trainingCompletion', allLabel: 'All' },
                { element: performanceRangeFilter, key: 'performanceRange', allLabel: 'All' }
            ];

            filterMap.forEach(filterItem => {
                const values = [...new Set(eligibilityReviewRecords.map(record => record[filterItem.key]))].sort();
                filterItem.element.innerHTML = [`<option value="${filterItem.allLabel}">${filterItem.allLabel}</option>`]
                    .concat(values.map(value => `<option value="${value}">${value}</option>`))
                    .join('');
            });
        }

        function getFilteredRecords() {
            return eligibilityReviewRecords.filter(record => {
                const matchesDepartment = eligibilityDepartmentFilter.value === 'All Departments' || record.department === eligibilityDepartmentFilter.value;
                const matchesRole = eligibilityRoleFilter.value === 'All Roles' || record.currentRole === eligibilityRoleFilter.value;
                const matchesRank = eligibilityRankFilter.value === 'All Ranks' || record.rank === eligibilityRankFilter.value;
                const matchesEligibilityStatus = eligibilityStatusFilter.value === 'All' || record.eligibilityResult === eligibilityStatusFilter.value;
                const matchesQualificationStatus = qualificationStatusFilter.value === 'All' || record.qualificationStatus === qualificationStatusFilter.value;
                const matchesTrainingCompletion = trainingCompletionFilter.value === 'All' || record.trainingCompletion === trainingCompletionFilter.value;
                const matchesPerformanceRange = performanceRangeFilter.value === 'All' || record.performanceRange === performanceRangeFilter.value;

                return matchesDepartment
                    && matchesRole
                    && matchesRank
                    && matchesEligibilityStatus
                    && matchesQualificationStatus
                    && matchesTrainingCompletion
                    && matchesPerformanceRange;
            });
        }

        function buildEligibilityByDepartment(records) {
            const departmentMap = new Map();

            records.forEach(record => {
                if (!departmentMap.has(record.department)) {
                    departmentMap.set(record.department, 0);
                }

                if (record.eligibilityResult === 'Eligible Now' || record.eligibilityResult === 'Nearly Eligible') {
                    departmentMap.set(record.department, departmentMap.get(record.department) + 1);
                }
            });

            return {
                labels: [...departmentMap.keys()],
                values: [...departmentMap.values()]
            };
        }

        function buildBlockReasonBreakdown(records) {
            const blockReasons = ['Qualification Gap', 'Tenure Gap', 'Performance Threshold', 'Readiness Review'];
            return {
                labels: blockReasons,
                values: blockReasons.map(reason => records.filter(record => record.blockReason === reason).length)
            };
        }

        function renderCharts(records) {
            const departmentData = buildEligibilityByDepartment(records);
            const blockReasonData = buildBlockReasonBreakdown(records);

            if (eligibilityByDepartmentChart) {
                eligibilityByDepartmentChart.destroy();
            }

            if (blockReasonBreakdownChart) {
                blockReasonBreakdownChart.destroy();
            }

            eligibilityByDepartmentChart = new Chart(document.getElementById('eligibilityByDepartmentChart'), {
                type: 'bar',
                data: {
                    labels: departmentData.labels,
                    datasets: [{
                        label: 'Ready or Nearly Ready',
                        data: departmentData.values,
                        backgroundColor: 'rgba(99, 102, 241, 0.75)',
                        borderRadius: 10,
                        maxBarThickness: 42
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#64748b'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0,
                                color: '#64748b'
                            },
                            grid: {
                                color: 'rgba(148, 163, 184, 0.12)'
                            }
                        }
                    }
                }
            });

            blockReasonBreakdownChart = new Chart(document.getElementById('blockReasonBreakdownChart'), {
                type: 'doughnut',
                data: {
                    labels: blockReasonData.labels,
                    datasets: [{
                        data: blockReasonData.values,
                        backgroundColor: [
                            'rgba(244, 63, 94, 0.82)',
                            'rgba(245, 158, 11, 0.82)',
                            'rgba(139, 92, 246, 0.82)',
                            'rgba(14, 165, 233, 0.82)'
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '68%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                usePointStyle: true,
                                boxWidth: 10,
                                color: '#475569',
                                padding: 18
                            }
                        }
                    }
                }
            });
        }

        function renderEligibilityTable(records) {
            eligibilityReviewTableBody.innerHTML = records.map((record, index) => `
                <tr class="transition-colors hover:bg-slate-50/70">
                    <td class="px-5 py-4">
                        <div>
                            <p class="text-sm font-semibold text-slate-700">${record.employee}</p>
                            <p class="text-[11px] text-slate-400">${record.employeeId} · ${record.department}</p>
                        </div>
                    </td>
                    <td class="px-5 py-4 text-sm text-slate-600">${record.currentRole}</td>
                    <td class="px-5 py-4 text-sm text-slate-600">${record.rank}</td>
                    <td class="px-5 py-4"><span class="status-pill ${getEligibilityClass(record.eligibilityResult)}">${record.eligibilityResult}</span></td>
                    <td class="px-5 py-4 text-sm text-slate-600">${record.missingRequirement}</td>
                    <td class="px-5 py-4 text-sm text-slate-600">${record.suggestedNextRole}</td>
                    <td class="px-5 py-4 text-sm text-slate-600">${record.estimatedTime}</td>
                    <td class="px-5 py-4">
                        <button type="button" class="view-eligibility-review inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-600 transition hover:bg-slate-50" data-record-index="${index}">
                            <i class="fa-regular fa-eye"></i>
                            <span>View</span>
                        </button>
                    </td>
                </tr>
            `).join('');
        }

        function renderEligibilityPage() {
            const filteredRecords = getFilteredRecords();
            renderInsightCards(filteredRecords);
            renderCharts(filteredRecords);
            renderEligibilityTable(filteredRecords);
        }

        function showEligibilityReviewDetail(record) {
            let modal = document.getElementById('eligibilityReviewDetailModal');

            if (!modal) {
                document.body.insertAdjacentHTML('beforeend', `
                    <div id="eligibilityReviewDetailModal" class="modal-backdrop fixed inset-0 z-50 hidden items-center justify-center p-4">
                        <div class="glass-card w-full max-w-3xl overflow-hidden">
                            <div class="flex items-start justify-between gap-4 border-b border-slate-100 px-6 py-5">
                                <div>
                                    <h3 id="eligibilityReviewDetailTitle" class="text-lg font-semibold text-slate-800"></h3>
                                    <p id="eligibilityReviewDetailSubtitle" class="mt-1 text-sm text-slate-500"></p>
                                </div>
                                <button id="closeEligibilityReviewDetailModal" type="button" class="flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-500 transition hover:bg-slate-50 hover:text-slate-800">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                            <div id="eligibilityReviewDetailBody" class="grid gap-3 p-6 sm:grid-cols-2"></div>
                        </div>
                    </div>
                `);

                modal = document.getElementById('eligibilityReviewDetailModal');
                const closeModal = () => {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                    document.body.classList.remove('overflow-hidden');
                };
                document.getElementById('closeEligibilityReviewDetailModal').addEventListener('click', closeModal);
                modal.addEventListener('click', event => {
                    if (event.target === modal) {
                        closeModal();
                    }
                });
            }

            const rows = [
                ['Employee ID', record.employeeId],
                ['Department', record.department],
                ['Current Role', record.currentRole],
                ['Rank', record.rank],
                ['Eligibility Result', record.eligibilityResult],
                ['Missing Requirement', record.missingRequirement],
                ['Suggested Next Role', record.suggestedNextRole],
                ['Estimated Time', record.estimatedTime],
                ['Qualification Status', record.qualificationStatus],
                ['Training Completion', record.trainingCompletion],
                ['Performance Range', record.performanceRange],
                ['Block Reason', record.blockReason]
            ];

            document.getElementById('eligibilityReviewDetailTitle').textContent = record.employee;
            document.getElementById('eligibilityReviewDetailSubtitle').textContent = 'Eligibility review detail';
            document.getElementById('eligibilityReviewDetailBody').innerHTML = rows.map(([label, value]) => `
                <div class="rounded-xl border border-slate-100 bg-slate-50 p-4">
                    <p class="text-[11px] font-semibold uppercase tracking-wide text-slate-400">${label}</p>
                    <p class="mt-1 text-sm font-semibold text-slate-700">${value}</p>
                </div>
            `).join('');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
        }

        [
            eligibilityDepartmentFilter,
            eligibilityRoleFilter,
            eligibilityRankFilter,
            eligibilityStatusFilter,
            qualificationStatusFilter,
            trainingCompletionFilter,
            performanceRangeFilter
        ].forEach(filterElement => {
            filterElement.addEventListener('input', renderEligibilityPage);
            filterElement.addEventListener('change', renderEligibilityPage);
        });

        eligibilityReviewTableBody.addEventListener('click', event => {
            const trigger = event.target.closest('.view-eligibility-review');

            if (!trigger) {
                return;
            }

            const record = getFilteredRecords()[Number(trigger.dataset.recordIndex)];

            if (record) {
                showEligibilityReviewDetail(record);
            }
        });

        sidebarToggle.addEventListener('click', handleSidebarToggle);
        sidebarOverlay.addEventListener('click', closeMobileSidebar);
        window.addEventListener('resize', syncSidebarMode);

        populateFilters();
        renderEligibilityPage();
        syncSidebarMode();
    </script>
</body>
</html>
