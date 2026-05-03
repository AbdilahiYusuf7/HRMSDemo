<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRM System - Promotion Rules</title>
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

        .status-active {
            background: #dcfce7;
            color: #166534;
        }

        .status-review {
            background: #fef3c7;
            color: #92400e;
        }

        .status-draft {
            background: #e2e8f0;
            color: #475569;
        }

        .modal-backdrop {
            background: rgba(15, 23, 42, 0.45);
            backdrop-filter: blur(4px);
        }

        .dialog-panel {
            border-radius: 1.75rem;
            border: 1px solid rgba(226, 232, 240, 0.9);
            box-shadow: 0 30px 80px -35px rgba(15, 23, 42, 0.45);
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
    <?php $currentMenu = 'promotion_rules'; ?>
    <?php include __DIR__ . '/../../includes/header_sidebar.php'; ?>

    <div class="mx-auto w-full max-w-[1440px] p-4 md:p-8">
        <div class="mb-8 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-slate-800">Promotion Rules</h2>
                <p class="text-sm text-slate-500">Review active promotion rules, qualification requirements, approval routing, and rules due for review.</p>
            </div>
            <button id="openAddPromotionRuleModal" type="button" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700">
                <i class="fa-solid fa-plus text-sm"></i>
                <span>Add Promotion Rule</span>
            </button>
        </div>

        <div id="promotionRuleCards" class="mb-8 grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-4"></div>

        <div class="glass-card mb-8 p-6">
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-5">
                <div>
                    <label for="promotionRuleDepartmentFilter" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Department</label>
                    <select id="promotionRuleDepartmentFilter" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                        <option value="All Departments">All Departments</option>
                    </select>
                </div>
                <div>
                    <label for="promotionRuleFamilyFilter" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Role Family</label>
                    <select id="promotionRuleFamilyFilter" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                        <option value="All">All</option>
                    </select>
                </div>
                <div>
                    <label for="promotionRuleRankFilter" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Rank</label>
                    <select id="promotionRuleRankFilter" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                        <option value="All Ranks">All Ranks</option>
                    </select>
                </div>
                <div>
                    <label for="promotionRuleTypeFilter" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Rule Type</label>
                    <select id="promotionRuleTypeFilter" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                        <option value="All">All</option>
                    </select>
                </div>
                <div>
                    <label for="promotionRuleStatusFilter" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Status</label>
                    <select id="promotionRuleStatusFilter" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                        <option value="All">All</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="glass-card overflow-hidden">
            <div class="border-b border-slate-100 px-6 py-5">
                <h3 class="text-base font-semibold text-slate-800">Promotion Rule Register</h3>
                <p class="mt-1 text-xs text-slate-400">Promotion rules are static mock UI records and ready for future backend wiring.</p>
            </div>
            <div class="table-scroll overflow-x-auto">
                <table class="min-w-full text-left">
                    <thead>
                        <tr class="border-b border-slate-100 text-[11px] uppercase tracking-[0.18em] text-slate-400">
                            <th class="px-5 py-4 font-semibold">Rule Name</th>
                            <th class="px-5 py-4 font-semibold">Department</th>
                            <th class="px-5 py-4 font-semibold">Applies To Role / Rank</th>
                            <th class="px-5 py-4 font-semibold">Rule Type</th>
                            <th class="px-5 py-4 font-semibold">Condition Summary</th>
                            <th class="px-5 py-4 font-semibold">Approval Flow</th>
                            <th class="px-5 py-4 font-semibold">Status</th>
                            <th class="px-5 py-4 font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="promotionRuleTableBody" class="divide-y divide-slate-50"></tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="addPromotionRuleModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 sm:p-6">
        <div class="modal-backdrop absolute inset-0"></div>
        <div class="glass-card dialog-panel relative z-10 mx-auto flex max-h-[calc(100vh-3rem)] w-full max-w-4xl flex-col overflow-hidden">
            <div class="flex items-start justify-between gap-4 border-b border-slate-100 px-6 py-5 sm:px-7">
                <div>
                    <h3 class="text-lg font-semibold text-slate-800">Add Promotion Rule</h3>
                    <p class="mt-1 text-sm text-slate-500">Create a new mock promotion rule record that updates the rule register instantly.</p>
                </div>
                <button id="closeAddPromotionRuleModal" type="button" class="flex h-12 w-12 items-center justify-center rounded-2xl border border-slate-200 bg-white text-slate-600 transition hover:bg-slate-50 hover:text-slate-800">
                    <i class="fa-solid fa-xmark text-base"></i>
                </button>
            </div>
            <div class="max-h-[calc(100vh-13rem)] overflow-y-auto">
                <form id="addPromotionRuleForm" class="grid gap-5 p-6 md:grid-cols-2 sm:px-7 sm:pb-7">
                    <div>
                        <label for="newRuleName" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Rule Name</label>
                        <input id="newRuleName" type="text" required class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100" placeholder="Enter rule name">
                    </div>
                    <div>
                        <label for="newRuleDepartment" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Department</label>
                        <select id="newRuleDepartment" required class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                            <option value="Human Resource">Human Resource</option>
                            <option value="Finance">Finance</option>
                            <option value="Operations">Operations</option>
                            <option value="Marketing">Marketing</option>
                            <option value="Administration">Administration</option>
                            <option value="Information Technology">Information Technology</option>
                            <option value="All Departments">All Departments</option>
                        </select>
                    </div>
                    <div>
                        <label for="newRuleFamily" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Role Family</label>
                        <input id="newRuleFamily" type="text" required class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100" placeholder="Enter role family">
                    </div>
                    <div>
                        <label for="newRuleRank" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Rank</label>
                        <input id="newRuleRank" type="text" required class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100" placeholder="Enter rank">
                    </div>
                    <div>
                        <label for="newRuleType" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Rule Type</label>
                        <select id="newRuleType" required class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                            <option value="Department Rule">Department Rule</option>
                            <option value="Qualification Rule">Qualification Rule</option>
                            <option value="Succession Rule">Succession Rule</option>
                            <option value="Tenure Rule">Tenure Rule</option>
                        </select>
                    </div>
                    <div>
                        <label for="newRuleStatus" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Status</label>
                        <select id="newRuleStatus" required class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                            <option value="Active">Active</option>
                            <option value="Needs Review">Needs Review</option>
                            <option value="Draft">Draft</option>
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <label for="newRuleAppliesTo" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Applies To Role / Rank</label>
                        <input id="newRuleAppliesTo" type="text" required class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100" placeholder="Example: Finance Officer / Officer III">
                    </div>
                    <div class="md:col-span-2">
                        <label for="newRuleConditionSummary" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Condition Summary</label>
                        <textarea id="newRuleConditionSummary" rows="4" required class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100" placeholder="Enter rule condition summary"></textarea>
                    </div>
                    <div class="md:col-span-2">
                        <label for="newRuleApprovalFlow" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Approval Flow</label>
                        <input id="newRuleApprovalFlow" type="text" required class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100" placeholder="Example: Manager > Director > Committee">
                    </div>
                </form>
            </div>
            <div class="flex flex-col gap-3 border-t border-slate-100 px-6 py-5 sm:flex-row sm:items-center sm:justify-end sm:px-7">
                <button id="cancelAddPromotionRuleModal" type="button" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">
                    Cancel
                </button>
                <button form="addPromotionRuleForm" type="submit" class="inline-flex items-center justify-center rounded-2xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700">
                    Save Rule
                </button>
            </div>
        </div>
    </div>

    <script>
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const desktopSidebarBreakpoint = window.matchMedia('(min-width: 1024px)');
        const promotionRuleCards = document.getElementById('promotionRuleCards');
        const promotionRuleTableBody = document.getElementById('promotionRuleTableBody');
        const promotionRuleDepartmentFilter = document.getElementById('promotionRuleDepartmentFilter');
        const promotionRuleFamilyFilter = document.getElementById('promotionRuleFamilyFilter');
        const promotionRuleRankFilter = document.getElementById('promotionRuleRankFilter');
        const promotionRuleTypeFilter = document.getElementById('promotionRuleTypeFilter');
        const promotionRuleStatusFilter = document.getElementById('promotionRuleStatusFilter');
        const openAddPromotionRuleModal = document.getElementById('openAddPromotionRuleModal');
        const addPromotionRuleModal = document.getElementById('addPromotionRuleModal');
        const closeAddPromotionRuleModal = document.getElementById('closeAddPromotionRuleModal');
        const cancelAddPromotionRuleModal = document.getElementById('cancelAddPromotionRuleModal');
        const addPromotionRuleForm = document.getElementById('addPromotionRuleForm');
        const newRuleName = document.getElementById('newRuleName');
        const newRuleDepartment = document.getElementById('newRuleDepartment');
        const newRuleFamily = document.getElementById('newRuleFamily');
        const newRuleRank = document.getElementById('newRuleRank');
        const newRuleType = document.getElementById('newRuleType');
        const newRuleStatus = document.getElementById('newRuleStatus');
        const newRuleAppliesTo = document.getElementById('newRuleAppliesTo');
        const newRuleConditionSummary = document.getElementById('newRuleConditionSummary');
        const newRuleApprovalFlow = document.getElementById('newRuleApprovalFlow');

        const promotionRuleRecords = [
            { ruleName: 'HR Senior Progression Rule', department: 'Human Resource', roleFamily: 'People Operations', rank: 'Officer II', appliesTo: 'Human Resource Officer / Officer II', ruleType: 'Qualification Rule', conditionSummary: 'Minimum 24 months in role, Bachelor Degree, and performance score above 85%.', approvalFlow: 'Manager > HR Director > Promotion Committee', status: 'Active', reviewDue: false },
            { ruleName: 'Finance Lead Readiness Rule', department: 'Finance', roleFamily: 'Finance', rank: 'Officer III', appliesTo: 'Finance Officer / Officer III', ruleType: 'Department Rule', conditionSummary: 'Requires audit readiness ownership, 2 successful review cycles, and leadership recommendation.', approvalFlow: 'Finance Lead > Director > Promotion Committee', status: 'Active', reviewDue: false },
            { ruleName: 'Operations Branch Leadership Rule', department: 'Operations', roleFamily: 'Operations', rank: 'Supervisor', appliesTo: 'Operations Supervisor / Supervisor', ruleType: 'Department Rule', conditionSummary: 'Minimum 36 months of branch leadership exposure and safety compliance completion.', approvalFlow: 'Branch Head > Operations Director > Committee', status: 'Needs Review', reviewDue: true },
            { ruleName: 'Marketing Promotion Qualification Gate', department: 'Marketing', roleFamily: 'Commercial', rank: 'Coordinator', appliesTo: 'Marketing Coordinator / Coordinator', ruleType: 'Qualification Rule', conditionSummary: 'Requires campaign portfolio evidence and updated professional certification.', approvalFlow: 'Marketing Lead > HR > Committee', status: 'Active', reviewDue: false },
            { ruleName: 'Administration Attendance Threshold Rule', department: 'Administration', roleFamily: 'Administration', rank: 'Officer I', appliesTo: 'Administration Officer / Officer I', ruleType: 'Department Rule', conditionSummary: 'Attendance above 95%, no compliance incidents, and one completed process improvement project.', approvalFlow: 'Admin Manager > Director > Committee', status: 'Active', reviewDue: false },
            { ruleName: 'IT Certification Advancement Rule', department: 'Information Technology', roleFamily: 'Technology', rank: 'Engineer I', appliesTo: 'Systems Support Engineer / Engineer I', ruleType: 'Qualification Rule', conditionSummary: 'Professional certification plus delivery score above 80% in the last two quarters.', approvalFlow: 'IT Lead > CTO > Committee', status: 'Active', reviewDue: false },
            { ruleName: 'Cross-Department Successor Rule', department: 'All Departments', roleFamily: 'Leadership', rank: 'Officer III', appliesTo: 'Leadership Pipeline / Officer III', ruleType: 'Succession Rule', conditionSummary: 'High-potential employees with succession nomination and committee panel score above threshold.', approvalFlow: 'Department Head > HRBP > Committee', status: 'Draft', reviewDue: false },
            { ruleName: 'Legacy Officer Promotion Rule', department: 'Operations', roleFamily: 'Operations', rank: 'Officer I', appliesTo: 'Operations Officer / Officer I', ruleType: 'Department Rule', conditionSummary: 'Legacy rule pending update to current performance framework and qualification standards.', approvalFlow: 'Operations Manager > HR > Committee', status: 'Needs Review', reviewDue: true }
        ];

        const promotionRuleCardConfig = [
            { key: 'activeRules', label: 'Active Rules', border: 'border-indigo-500', iconBg: 'bg-indigo-50', iconColor: 'text-indigo-600', icon: 'fa-scale-balanced', helper: 'Rules currently active in the mock promotion rules register.' },
            { key: 'departmentRules', label: 'Department Rules', border: 'border-emerald-500', iconBg: 'bg-emerald-50', iconColor: 'text-emerald-600', icon: 'fa-building', helper: 'Rules focused on department-specific promotion criteria.' },
            { key: 'qualificationRules', label: 'Qualification Rules', border: 'border-sky-500', iconBg: 'bg-sky-50', iconColor: 'text-sky-600', icon: 'fa-graduation-cap', helper: 'Rules that depend on formal qualifications or certification evidence.' },
            { key: 'rulesNeedingReview', label: 'Rules Needing Review', border: 'border-amber-500', iconBg: 'bg-amber-50', iconColor: 'text-amber-600', icon: 'fa-triangle-exclamation', helper: 'Rules flagged for policy update or review refresh.' }
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

        function getRuleStatusClass(status) {
            if (status === 'Active') {
                return 'status-active';
            }

            if (status === 'Needs Review') {
                return 'status-review';
            }

            return 'status-draft';
        }

        function buildPromotionRuleSummary(records) {
            return {
                activeRules: `${records.filter(record => record.status === 'Active').length} Rules`,
                departmentRules: `${records.filter(record => record.ruleType === 'Department Rule').length} Rules`,
                qualificationRules: `${records.filter(record => record.ruleType === 'Qualification Rule').length} Rules`,
                rulesNeedingReview: `${records.filter(record => record.reviewDue).length} Rules`
            };
        }

        function renderInsightCards(records) {
            const summary = buildPromotionRuleSummary(records);

            promotionRuleCards.innerHTML = promotionRuleCardConfig.map(card => `
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

        function populatePromotionRuleFilters() {
            const filterMap = [
                { element: promotionRuleDepartmentFilter, key: 'department', allLabel: 'All Departments' },
                { element: promotionRuleFamilyFilter, key: 'roleFamily', allLabel: 'All' },
                { element: promotionRuleRankFilter, key: 'rank', allLabel: 'All Ranks' },
                { element: promotionRuleTypeFilter, key: 'ruleType', allLabel: 'All' },
                { element: promotionRuleStatusFilter, key: 'status', allLabel: 'All' }
            ];

            filterMap.forEach(filterItem => {
                const currentValue = filterItem.element.value;
                const values = [...new Set(promotionRuleRecords.map(record => record[filterItem.key]))].sort();
                filterItem.element.innerHTML = [`<option value="${filterItem.allLabel}">${filterItem.allLabel}</option>`]
                    .concat(values.map(value => `<option value="${value}">${value}</option>`))
                    .join('');
                filterItem.element.value = values.includes(currentValue) || currentValue === filterItem.allLabel
                    ? currentValue
                    : filterItem.allLabel;
            });
        }

        function resetPromotionRuleFilters() {
            promotionRuleDepartmentFilter.value = 'All Departments';
            promotionRuleFamilyFilter.value = 'All';
            promotionRuleRankFilter.value = 'All Ranks';
            promotionRuleTypeFilter.value = 'All';
            promotionRuleStatusFilter.value = 'All';
        }

        function showAddPromotionRuleModal() {
            addPromotionRuleModal.classList.remove('hidden');
            addPromotionRuleModal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
            newRuleName.focus();
        }

        function hideAddPromotionRuleModal() {
            addPromotionRuleModal.classList.add('hidden');
            addPromotionRuleModal.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        }

        function resetAddPromotionRuleForm() {
            addPromotionRuleForm.reset();
            newRuleDepartment.value = 'Human Resource';
            newRuleType.value = 'Department Rule';
            newRuleStatus.value = 'Active';
        }

        function getFilteredPromotionRules() {
            return promotionRuleRecords.filter(record => {
                const matchesDepartment = promotionRuleDepartmentFilter.value === 'All Departments' || record.department === promotionRuleDepartmentFilter.value;
                const matchesFamily = promotionRuleFamilyFilter.value === 'All' || record.roleFamily === promotionRuleFamilyFilter.value;
                const matchesRank = promotionRuleRankFilter.value === 'All Ranks' || record.rank === promotionRuleRankFilter.value;
                const matchesType = promotionRuleTypeFilter.value === 'All' || record.ruleType === promotionRuleTypeFilter.value;
                const matchesStatus = promotionRuleStatusFilter.value === 'All' || record.status === promotionRuleStatusFilter.value;

                return matchesDepartment && matchesFamily && matchesRank && matchesType && matchesStatus;
            });
        }

        function renderPromotionRuleTable(records) {
            promotionRuleTableBody.innerHTML = records.map((record, index) => `
                <tr class="transition-colors hover:bg-slate-50/70">
                    <td class="px-5 py-4 text-sm font-semibold text-slate-700">${record.ruleName}</td>
                    <td class="px-5 py-4 text-sm text-slate-600">${record.department}</td>
                    <td class="px-5 py-4 text-sm text-slate-600">${record.appliesTo}</td>
                    <td class="px-5 py-4 text-sm text-slate-600">${record.ruleType}</td>
                    <td class="px-5 py-4 text-sm text-slate-600">${record.conditionSummary}</td>
                    <td class="px-5 py-4 text-sm text-slate-600">${record.approvalFlow}</td>
                    <td class="px-5 py-4"><span class="status-pill ${getRuleStatusClass(record.status)}">${record.status}</span></td>
                    <td class="px-5 py-4">
                        <button type="button" class="view-promotion-rule inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-600 transition hover:bg-slate-50" data-record-index="${index}">
                            <i class="fa-regular fa-eye"></i>
                            <span>View</span>
                        </button>
                    </td>
                </tr>
            `).join('');
        }

        function renderPromotionRulePage() {
            const records = getFilteredPromotionRules();
            renderInsightCards(records);
            renderPromotionRuleTable(records);
        }

        function showPromotionRuleDetail(record) {
            let modal = document.getElementById('promotionRuleDetailModal');

            if (!modal) {
                document.body.insertAdjacentHTML('beforeend', `
                    <div id="promotionRuleDetailModal" class="modal-backdrop fixed inset-0 z-50 hidden items-center justify-center p-4">
                        <div class="glass-card w-full max-w-3xl overflow-hidden">
                            <div class="flex items-start justify-between gap-4 border-b border-slate-100 px-6 py-5">
                                <div>
                                    <h3 id="promotionRuleDetailTitle" class="text-lg font-semibold text-slate-800"></h3>
                                    <p id="promotionRuleDetailSubtitle" class="mt-1 text-sm text-slate-500"></p>
                                </div>
                                <button id="closePromotionRuleDetailModal" type="button" class="flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-500 transition hover:bg-slate-50 hover:text-slate-800">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                            <div id="promotionRuleDetailBody" class="grid gap-3 p-6 sm:grid-cols-2"></div>
                        </div>
                    </div>
                `);

                modal = document.getElementById('promotionRuleDetailModal');
                const closeModal = () => {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                    document.body.classList.remove('overflow-hidden');
                };
                document.getElementById('closePromotionRuleDetailModal').addEventListener('click', closeModal);
                modal.addEventListener('click', event => {
                    if (event.target === modal) {
                        closeModal();
                    }
                });
            }

            const rows = [
                ['Department', record.department],
                ['Role Family', record.roleFamily],
                ['Rank', record.rank],
                ['Applies To', record.appliesTo],
                ['Rule Type', record.ruleType],
                ['Condition Summary', record.conditionSummary],
                ['Approval Flow', record.approvalFlow],
                ['Status', record.status],
                ['Review Due', record.reviewDue ? 'Yes' : 'No']
            ];

            document.getElementById('promotionRuleDetailTitle').textContent = record.ruleName;
            document.getElementById('promotionRuleDetailSubtitle').textContent = 'Promotion rule detail';
            document.getElementById('promotionRuleDetailBody').innerHTML = rows.map(([label, value]) => `
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
            promotionRuleDepartmentFilter,
            promotionRuleFamilyFilter,
            promotionRuleRankFilter,
            promotionRuleTypeFilter,
            promotionRuleStatusFilter
        ].forEach(filterElement => {
            filterElement.addEventListener('input', renderPromotionRulePage);
            filterElement.addEventListener('change', renderPromotionRulePage);
        });

        promotionRuleTableBody.addEventListener('click', event => {
            const trigger = event.target.closest('.view-promotion-rule');

            if (!trigger) {
                return;
            }

            const record = getFilteredPromotionRules()[Number(trigger.dataset.recordIndex)];

            if (record) {
                showPromotionRuleDetail(record);
            }
        });

        sidebarToggle.addEventListener('click', handleSidebarToggle);
        sidebarOverlay.addEventListener('click', closeMobileSidebar);
        window.addEventListener('resize', syncSidebarMode);
        openAddPromotionRuleModal.addEventListener('click', showAddPromotionRuleModal);
        closeAddPromotionRuleModal.addEventListener('click', hideAddPromotionRuleModal);
        cancelAddPromotionRuleModal.addEventListener('click', hideAddPromotionRuleModal);
        addPromotionRuleModal.addEventListener('click', event => {
            if (event.target === addPromotionRuleModal || event.target.classList.contains('modal-backdrop')) {
                hideAddPromotionRuleModal();
            }
        });
        addPromotionRuleForm.addEventListener('submit', event => {
            event.preventDefault();

            promotionRuleRecords.push({
                ruleName: newRuleName.value.trim(),
                department: newRuleDepartment.value,
                roleFamily: newRuleFamily.value.trim(),
                rank: newRuleRank.value.trim(),
                appliesTo: newRuleAppliesTo.value.trim(),
                ruleType: newRuleType.value,
                conditionSummary: newRuleConditionSummary.value.trim(),
                approvalFlow: newRuleApprovalFlow.value.trim(),
                status: newRuleStatus.value,
                reviewDue: newRuleStatus.value === 'Needs Review'
            });

            populatePromotionRuleFilters();
            resetPromotionRuleFilters();
            renderPromotionRulePage();
            hideAddPromotionRuleModal();
            resetAddPromotionRuleForm();
        });

        populatePromotionRuleFilters();
        resetAddPromotionRuleForm();
        renderPromotionRulePage();
        syncSidebarMode();
    </script>
</body>
</html>
