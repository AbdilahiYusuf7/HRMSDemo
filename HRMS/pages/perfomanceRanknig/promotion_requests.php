<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRM System - Promotion Requests</title>
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

        .status-pill {
            padding: 4px 12px;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .status-draft {
            background: #e2e8f0;
            color: #475569;
        }

        .status-review {
            background: #fef3c7;
            color: #92400e;
        }

        .status-approved {
            background: #dcfce7;
            color: #166534;
        }

        .status-rejected {
            background: #fee2e2;
            color: #991b1b;
        }

        .status-implemented {
            background: #dbeafe;
            color: #1d4ed8;
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
    <?php $currentMenu = 'promotion_requests'; ?>
    <?php include __DIR__ . '/../../includes/header_sidebar.php'; ?>

    <div class="mx-auto w-full max-w-[1440px] p-4 md:p-8">
        <div class="mb-8 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-slate-800">Promotion Requests</h2>
                <p class="text-sm text-slate-500">Track submitted requests, approval routing, rank changes, and effective promotion dates.</p>
            </div>
        </div>

        <div id="promotionRequestCards" class="mb-8 grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-4"></div>

        <div class="glass-card mb-8 p-6">
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-5">
                <div>
                    <label for="requestStatusFilter" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Request Status</label>
                    <select id="requestStatusFilter" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                        <option value="All">All</option>
                    </select>
                </div>
                <div>
                    <label for="requestDepartmentFilter" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Department</label>
                    <select id="requestDepartmentFilter" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                        <option value="All Departments">All Departments</option>
                    </select>
                </div>
                <div>
                    <label for="currentRoleFilter" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Current Role</label>
                    <select id="currentRoleFilter" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                        <option value="All Roles">All Roles</option>
                    </select>
                </div>
                <div>
                    <label for="proposedRoleFilter" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Proposed Role</label>
                    <select id="proposedRoleFilter" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                        <option value="All Roles">All Roles</option>
                    </select>
                </div>
                <div>
                    <label for="rankChangeFilter" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Rank Change</label>
                    <select id="rankChangeFilter" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                        <option value="All">All</option>
                    </select>
                </div>
                <div>
                    <label for="effectiveDateRangeFilter" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Effective Date Range</label>
                    <input id="effectiveDateRangeFilter" type="text" value="Apr 01, 2026 - Jun 30, 2026" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                </div>
                <div>
                    <label for="requestedByFilter" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Requested By</label>
                    <select id="requestedByFilter" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                        <option value="All">All</option>
                    </select>
                </div>
                <div>
                    <label for="approvalStageFilter" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Approval Stage</label>
                    <select id="approvalStageFilter" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                        <option value="All">All</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="glass-card overflow-hidden">
            <div class="border-b border-slate-100 px-6 py-5">
                <h3 class="text-base font-semibold text-slate-800">Promotion Request Queue</h3>
                <p class="mt-1 text-xs text-slate-400">UI-only approval queue for draft, submitted, reviewed, approved, rejected, and implemented requests.</p>
            </div>
            <div class="table-scroll overflow-x-auto">
                <table class="min-w-full text-left">
                    <thead>
                        <tr class="border-b border-slate-100 text-[11px] uppercase tracking-[0.18em] text-slate-400">
                            <th class="px-5 py-4 font-semibold">Employee</th>
                            <th class="px-5 py-4 font-semibold">Current Role</th>
                            <th class="px-5 py-4 font-semibold">Proposed Role</th>
                            <th class="px-5 py-4 font-semibold">Current Rank / Grade</th>
                            <th class="px-5 py-4 font-semibold">New Rank / Grade</th>
                            <th class="px-5 py-4 font-semibold">Basis</th>
                            <th class="px-5 py-4 font-semibold">Effective Date</th>
                            <th class="px-5 py-4 font-semibold">Requested By</th>
                            <th class="px-5 py-4 font-semibold">Status</th>
                            <th class="px-5 py-4 font-semibold">Approval Stage</th>
                            <th class="px-5 py-4 font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="promotionRequestTableBody" class="divide-y divide-slate-50"></tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const desktopSidebarBreakpoint = window.matchMedia('(min-width: 1024px)');
        const promotionRequestCards = document.getElementById('promotionRequestCards');
        const promotionRequestTableBody = document.getElementById('promotionRequestTableBody');
        const requestStatusFilter = document.getElementById('requestStatusFilter');
        const requestDepartmentFilter = document.getElementById('requestDepartmentFilter');
        const currentRoleFilter = document.getElementById('currentRoleFilter');
        const proposedRoleFilter = document.getElementById('proposedRoleFilter');
        const rankChangeFilter = document.getElementById('rankChangeFilter');
        const effectiveDateRangeFilter = document.getElementById('effectiveDateRangeFilter');
        const requestedByFilter = document.getElementById('requestedByFilter');
        const approvalStageFilter = document.getElementById('approvalStageFilter');

        const promotionRequestRecords = [
            { employee: 'Cabdiraxmaan Cali', department: 'Human Resource', currentRole: 'Human Resource Officer', proposedRole: 'Senior Human Resource Officer', currentRankGrade: 'Officer II / G6', newRankGrade: 'Officer III / G7', basis: 'Performance review + qualification evidence', effectiveDate: '2026-04-12', requestedBy: 'Asha Mohamed', status: 'Approved', approvalStage: 'Committee Approved' },
            { employee: 'Fadumo Xasan', department: 'Finance', currentRole: 'Finance Officer', proposedRole: 'Lead Finance Officer', currentRankGrade: 'Officer III / G7', newRankGrade: 'Lead Officer / G8', basis: 'Leadership readiness', effectiveDate: '2026-05-20', requestedBy: 'Mohamed Yusuf', status: 'Under Review', approvalStage: 'Director Review' },
            { employee: 'Mahad Axmed', department: 'Operations', currentRole: 'Operations Supervisor', proposedRole: 'Branch Lead', currentRankGrade: 'Supervisor / G8', newRankGrade: 'Lead / G9', basis: 'Performance review + qualification evidence', effectiveDate: '2026-04-28', requestedBy: 'Hodan Ali', status: 'Approved', approvalStage: 'Implemented' },
            { employee: 'Sahra Maxamed', department: 'Marketing', currentRole: 'Marketing Coordinator', proposedRole: 'Senior Marketing Coordinator', currentRankGrade: 'Coordinator / G5', newRankGrade: 'Officer I / G6', basis: 'Qualification upgrade', effectiveDate: '2026-05-08', requestedBy: 'Ahmed Jama', status: 'Rejected', approvalStage: 'Committee Review' },
            { employee: 'Hodan Ali', department: 'Administration', currentRole: 'Administration Officer', proposedRole: 'Senior Administration Officer', currentRankGrade: 'Officer I / G5', newRankGrade: 'Officer II / G6', basis: 'Tenure and attendance threshold', effectiveDate: '2026-04-18', requestedBy: 'Cali Maxamed', status: 'Approved', approvalStage: 'Implemented' },
            { employee: 'Mustafe Cabdi', department: 'Information Technology', currentRole: 'Systems Support Engineer', proposedRole: 'Systems Analyst', currentRankGrade: 'Engineer I / G6', newRankGrade: 'Engineer II / G7', basis: 'Certification completion', effectiveDate: '2026-06-02', requestedBy: 'Ilwad Noor', status: 'Under Review', approvalStage: 'HR Review' },
            { employee: 'Roda Jama', department: 'Finance', currentRole: 'Financial Analyst', proposedRole: 'Senior Financial Analyst', currentRankGrade: 'Analyst II / G6', newRankGrade: 'Senior Analyst / G7', basis: 'Performance review + qualification evidence', effectiveDate: '2026-04-26', requestedBy: 'Mohamed Yusuf', status: 'Approved', approvalStage: 'Implemented' },
            { employee: 'Amina Yusuf', department: 'Human Resource', currentRole: 'Talent Officer', proposedRole: 'HR Business Partner', currentRankGrade: 'Officer II / G6', newRankGrade: 'Officer III / G7', basis: 'Leadership readiness', effectiveDate: '2026-06-10', requestedBy: 'Asha Mohamed', status: 'Under Review', approvalStage: 'Committee Review' },
            { employee: 'Ahmed Jama', department: 'Marketing', currentRole: 'Marketing Associate', proposedRole: 'Marketing Coordinator', currentRankGrade: 'Associate / G4', newRankGrade: 'Coordinator / G5', basis: 'Succession planning', effectiveDate: '2026-05-15', requestedBy: 'Sahra Maxamed', status: 'Draft', approvalStage: 'Drafted' },
            { employee: 'Mohamed Yusuf', department: 'Administration', currentRole: 'Records Coordinator', proposedRole: 'Operations Officer', currentRankGrade: 'Coordinator / G5', newRankGrade: 'Officer I / G6', basis: 'Performance review + qualification evidence', effectiveDate: '2026-05-24', requestedBy: 'Cali Maxamed', status: 'Under Review', approvalStage: 'Director Review' },
            { employee: 'Ilwad Noor', department: 'Information Technology', currentRole: 'Software Developer I', proposedRole: 'Software Developer II', currentRankGrade: 'Developer I / G6', newRankGrade: 'Developer II / G7', basis: 'Certification completion', effectiveDate: '2026-05-29', requestedBy: 'Mustafe Cabdi', status: 'Approved', approvalStage: 'Committee Approved' },
            { employee: 'Nimco Abdi', department: 'Operations', currentRole: 'Operations Officer', proposedRole: 'Operations Supervisor', currentRankGrade: 'Officer I / G5', newRankGrade: 'Supervisor / G7', basis: 'Leadership readiness', effectiveDate: '2026-06-18', requestedBy: 'Mahad Axmed', status: 'Rejected', approvalStage: 'HR Review' }
        ];

        const promotionRequestCardConfig = [
            { key: 'totalRequests', label: 'Total Requests', border: 'border-indigo-500', iconBg: 'bg-indigo-50', iconColor: 'text-indigo-600', icon: 'fa-layer-group', helper: 'All promotion requests currently listed in the queue.' },
            { key: 'underReview', label: 'Under Review', border: 'border-amber-500', iconBg: 'bg-amber-50', iconColor: 'text-amber-600', icon: 'fa-hourglass-half', helper: 'Requests still passing through one or more approval steps.' },
            { key: 'approved', label: 'Approved', border: 'border-emerald-500', iconBg: 'bg-emerald-50', iconColor: 'text-emerald-600', icon: 'fa-circle-check', helper: 'Requests approved for implementation or already applied.' },
            { key: 'rejected', label: 'Rejected', border: 'border-rose-500', iconBg: 'bg-rose-50', iconColor: 'text-rose-600', icon: 'fa-circle-xmark', helper: 'Requests declined after review.' }
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

        function getStatusClass(status) {
            if (status === 'Approved') {
                return 'status-approved';
            }

            if (status === 'Rejected') {
                return 'status-rejected';
            }

            if (status === 'Implemented') {
                return 'status-implemented';
            }

            if (status === 'Draft') {
                return 'status-draft';
            }

            return 'status-review';
        }

        function buildRequestSummary(records) {
            return {
                totalRequests: `${records.length} Requests`,
                underReview: `${records.filter(record => record.status === 'Under Review').length} Requests`,
                approved: `${records.filter(record => record.status === 'Approved').length} Requests`,
                rejected: `${records.filter(record => record.status === 'Rejected').length} Requests`
            };
        }

        function renderInsightCards(records) {
            const summary = buildRequestSummary(records);

            promotionRequestCards.innerHTML = promotionRequestCardConfig.map(card => `
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

        function populateRequestFilters() {
            const filterMap = [
                { element: requestStatusFilter, key: 'status', allLabel: 'All' },
                { element: requestDepartmentFilter, key: 'department', allLabel: 'All Departments' },
                { element: currentRoleFilter, key: 'currentRole', allLabel: 'All Roles' },
                { element: proposedRoleFilter, key: 'proposedRole', allLabel: 'All Roles' },
                { element: rankChangeFilter, key: 'newRankGrade', allLabel: 'All' },
                { element: requestedByFilter, key: 'requestedBy', allLabel: 'All' },
                { element: approvalStageFilter, key: 'approvalStage', allLabel: 'All' }
            ];

            filterMap.forEach(filterItem => {
                const values = [...new Set(promotionRequestRecords.map(record => record[filterItem.key]))].sort();
                filterItem.element.innerHTML = [`<option value="${filterItem.allLabel}">${filterItem.allLabel}</option>`]
                    .concat(values.map(value => `<option value="${value}">${value}</option>`))
                    .join('');
            });
        }

        function getFilteredPromotionRequests() {
            return promotionRequestRecords.filter(record => {
                const matchesStatus = requestStatusFilter.value === 'All' || record.status === requestStatusFilter.value;
                const matchesDepartment = requestDepartmentFilter.value === 'All Departments' || record.department === requestDepartmentFilter.value;
                const matchesCurrentRole = currentRoleFilter.value === 'All Roles' || record.currentRole === currentRoleFilter.value;
                const matchesProposedRole = proposedRoleFilter.value === 'All Roles' || record.proposedRole === proposedRoleFilter.value;
                const matchesRankChange = rankChangeFilter.value === 'All' || record.newRankGrade === rankChangeFilter.value;
                const matchesRequestedBy = requestedByFilter.value === 'All' || record.requestedBy === requestedByFilter.value;
                const matchesApprovalStage = approvalStageFilter.value === 'All' || record.approvalStage === approvalStageFilter.value;

                return matchesStatus
                    && matchesDepartment
                    && matchesCurrentRole
                    && matchesProposedRole
                    && matchesRankChange
                    && matchesRequestedBy
                    && matchesApprovalStage;
            });
        }

        function renderPromotionRequestTable(records) {
            promotionRequestTableBody.innerHTML = records.map((record, index) => `
                <tr class="transition-colors hover:bg-slate-50/70">
                    <td class="px-5 py-4 text-sm font-semibold text-slate-700">${record.employee}</td>
                    <td class="px-5 py-4 text-sm text-slate-600">${record.currentRole}</td>
                    <td class="px-5 py-4 text-sm text-slate-600">${record.proposedRole}</td>
                    <td class="px-5 py-4 text-sm text-slate-600">${record.currentRankGrade}</td>
                    <td class="px-5 py-4 text-sm text-slate-600">${record.newRankGrade}</td>
                    <td class="px-5 py-4 text-sm text-slate-600">${record.basis}</td>
                    <td class="px-5 py-4 text-sm text-slate-600">${record.effectiveDate}</td>
                    <td class="px-5 py-4 text-sm text-slate-600">${record.requestedBy}</td>
                    <td class="px-5 py-4"><span class="status-pill ${getStatusClass(record.status)}">${record.status}</span></td>
                    <td class="px-5 py-4 text-sm text-slate-600">${record.approvalStage}</td>
                    <td class="px-5 py-4">
                        <button type="button" class="view-promotion-request inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-600 transition hover:bg-slate-50" data-record-index="${index}">
                            <i class="fa-regular fa-eye"></i>
                            <span>View</span>
                        </button>
                    </td>
                </tr>
            `).join('');
        }

        function renderPromotionRequestPage() {
            const records = getFilteredPromotionRequests();
            renderInsightCards(records);
            renderPromotionRequestTable(records);
        }

        function showPromotionRequestDetail(record) {
            let modal = document.getElementById('promotionRequestDetailModal');

            if (!modal) {
                document.body.insertAdjacentHTML('beforeend', `
                    <div id="promotionRequestDetailModal" class="modal-backdrop fixed inset-0 z-50 hidden items-center justify-center p-4">
                        <div class="glass-card w-full max-w-3xl overflow-hidden">
                            <div class="flex items-start justify-between gap-4 border-b border-slate-100 px-6 py-5">
                                <div>
                                    <h3 id="promotionRequestDetailTitle" class="text-lg font-semibold text-slate-800"></h3>
                                    <p id="promotionRequestDetailSubtitle" class="mt-1 text-sm text-slate-500"></p>
                                </div>
                                <button id="closePromotionRequestDetailModal" type="button" class="flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-500 transition hover:bg-slate-50 hover:text-slate-800">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                            <div id="promotionRequestDetailBody" class="grid gap-3 p-6 sm:grid-cols-2"></div>
                        </div>
                    </div>
                `);

                modal = document.getElementById('promotionRequestDetailModal');
                const closeModal = () => {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                    document.body.classList.remove('overflow-hidden');
                };
                document.getElementById('closePromotionRequestDetailModal').addEventListener('click', closeModal);
                modal.addEventListener('click', event => {
                    if (event.target === modal) {
                        closeModal();
                    }
                });
            }

            const rows = [
                ['Department', record.department],
                ['Current Role', record.currentRole],
                ['Proposed Role', record.proposedRole],
                ['Current Rank / Grade', record.currentRankGrade],
                ['New Rank / Grade', record.newRankGrade],
                ['Basis', record.basis],
                ['Effective Date', record.effectiveDate],
                ['Requested By', record.requestedBy],
                ['Status', record.status],
                ['Approval Stage', record.approvalStage]
            ];

            document.getElementById('promotionRequestDetailTitle').textContent = record.employee;
            document.getElementById('promotionRequestDetailSubtitle').textContent = 'Promotion request detail';
            document.getElementById('promotionRequestDetailBody').innerHTML = rows.map(([label, value]) => `
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
            requestStatusFilter,
            requestDepartmentFilter,
            currentRoleFilter,
            proposedRoleFilter,
            rankChangeFilter,
            effectiveDateRangeFilter,
            requestedByFilter,
            approvalStageFilter
        ].forEach(filterElement => {
            filterElement.addEventListener('input', renderPromotionRequestPage);
            filterElement.addEventListener('change', renderPromotionRequestPage);
        });

        promotionRequestTableBody.addEventListener('click', event => {
            const trigger = event.target.closest('.view-promotion-request');

            if (!trigger) {
                return;
            }

            const record = getFilteredPromotionRequests()[Number(trigger.dataset.recordIndex)];

            if (record) {
                showPromotionRequestDetail(record);
            }
        });

        sidebarToggle.addEventListener('click', handleSidebarToggle);
        sidebarOverlay.addEventListener('click', closeMobileSidebar);
        window.addEventListener('resize', syncSidebarMode);

        populateRequestFilters();
        renderPromotionRequestPage();
        syncSidebarMode();
    </script>
</body>
</html>
