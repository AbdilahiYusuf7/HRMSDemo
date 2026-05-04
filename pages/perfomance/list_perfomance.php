<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRM System - Perfomance List</title>
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
        .agenda-card:hover {
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

        .status-excellent {
            background: #dcfce7;
            color: #166534;
        }

        .status-good {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .status-review {
            background: #fef3c7;
            color: #92400e;
        }

        .tab-button.active {
            background: #4f46e5;
            color: white;
            box-shadow: 0 10px 25px -16px rgba(79, 70, 229, 0.7);
        }

        .modal-backdrop {
            background: rgba(15, 23, 42, 0.45);
            backdrop-filter: blur(4px);
        }

        .dialog-panel {
            border-radius: 1.25rem;
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
    <?php $currentMenu = 'performance'; ?>
    <?php include __DIR__ . '/../../includes/header_sidebar.php'; ?>

    <div class="mx-auto w-full max-w-[1440px] p-4 md:p-8">
        <div class="mb-8 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-slate-800">Perfomance</h2>
                <p class="text-sm text-slate-500">Manage departmental agendas and review employee perfomance.</p>
            </div>
        </div>

        <div class="mb-8 grid grid-cols-1 gap-5 md:grid-cols-3">
            <div class="glass-card insight-card border-l-4 border-emerald-500 p-5">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Top Performers</p>
                        <h3 id="topPerformersCount" class="mt-2 text-2xl font-bold text-slate-800">0</h3>
                    </div>
                    <div class="rounded-xl bg-emerald-50 p-3 text-emerald-600">
                        <i class="fa-solid fa-ranking-star text-lg"></i>
                    </div>
                </div>
                <p class="mt-4 text-[11px] font-medium text-slate-400">Employees with excellent review marks</p>
            </div>

            <div class="glass-card insight-card border-l-4 border-amber-500 p-5">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Need Improvement</p>
                        <h3 id="needImprovementCount" class="mt-2 text-2xl font-bold text-slate-800">0</h3>
                    </div>
                    <div class="rounded-xl bg-amber-50 p-3 text-amber-600">
                        <i class="fa-solid fa-arrow-trend-down text-lg"></i>
                    </div>
                </div>
                <p class="mt-4 text-[11px] font-medium text-slate-400">Employees requiring follow-up action</p>
            </div>

            <div class="glass-card insight-card border-l-4 border-indigo-500 p-5">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Reviews Completed</p>
                        <h3 id="reviewsCompletedCount" class="mt-2 text-2xl font-bold text-slate-800">0</h3>
                    </div>
                    <div class="rounded-xl bg-indigo-50 p-3 text-indigo-600">
                        <i class="fa-solid fa-clipboard-check text-lg"></i>
                    </div>
                </div>
                <p class="mt-4 text-[11px] font-medium text-slate-400">Completed in the active review cycle</p>
            </div>
        </div>

        <div class="glass-card p-6">
            <div class="mb-6 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div class="inline-flex rounded-xl border border-slate-200 bg-slate-50 p-1">
                    <button type="button" class="tab-button active rounded-lg px-4 py-2 text-sm font-semibold text-slate-500 transition" data-tab-target="manageAgendaTab">
                        Manage Agenda
                    </button>
                    <button type="button" class="tab-button rounded-lg px-4 py-2 text-sm font-semibold text-slate-500 transition" data-tab-target="reviewTab">
                        Review
                    </button>
                </div>
                <button id="openAgendaModalButton" type="button" class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700">
                    <i class="fa-solid fa-plus text-xs"></i>
                    Add Agenda
                </button>
            </div>

            <div id="manageAgendaTab" class="tab-panel">
                <div id="agendaCards" class="grid grid-cols-1 gap-5 lg:grid-cols-3"></div>
            </div>

            <div id="reviewTab" class="tab-panel hidden">
                <div class="mb-5">
                    <h3 class="text-base font-semibold text-slate-800">Employee Perfomance Review</h3>
                    <p class="text-xs text-slate-400">Review employees based on the agenda assigned to their department.</p>
                </div>
                <div class="table-scroll overflow-x-auto">
                    <table class="min-w-full text-left">
                        <thead>
                            <tr class="border-b border-slate-100 text-[11px] uppercase tracking-wider text-slate-400">
                                <th class="px-4 py-4 font-semibold">Employee Name &amp; ID</th>
                                <th class="px-4 py-4 font-semibold">Department</th>
                                <th class="px-4 py-4 font-semibold">Agenda</th>
                                <th class="px-4 py-4 font-semibold">System Perfomance</th>
                                <th class="px-4 py-4 font-semibold">Status</th>
                                <th class="px-4 py-4 font-semibold">Action</th>
                            </tr>
                        </thead>
                        <tbody id="reviewTableBody" class="divide-y divide-slate-50"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="agendaFormModal" class="modal-backdrop fixed inset-0 z-50 hidden items-center justify-center p-4">
        <div class="dialog-panel w-full max-w-2xl bg-white p-6">
            <div class="mb-5 flex items-start justify-between gap-4">
                <div>
                    <h3 class="text-lg font-semibold text-slate-800">Create Department Agenda</h3>
                    <p class="text-xs text-slate-400">Add a sample agenda for a department review cycle.</p>
                </div>
                <button type="button" class="close-modal rounded-lg p-2 text-slate-400 transition hover:bg-slate-50 hover:text-slate-600">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <form id="agendaForm" class="space-y-4">
                <div>
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500">Department</label>
                    <select id="agendaDepartmentInput" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-600 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                        <option value="Human Resource Manager">Human Resource Manager</option>
                        <option value="Head of Finances">Head of Finances</option>
                        <option value="Operations Manager">Operations Manager</option>
                        <option value="Marketing Manager">Marketing Manager</option>
                        <option value="Manager">Manager</option>
                        <option value="IT Manager">IT Manager</option>
                    </select>
                </div>
                <div>
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500">Agenda Title</label>
                    <input id="agendaTitleInput" type="text" required class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-600 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100" placeholder="Enter agenda title">
                </div>
                <div>
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500">Agenda Points</label>
                    <textarea id="agendaPointsInput" rows="4" required class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-600 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100" placeholder="Enter one agenda point per line"></textarea>
                </div>
                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" class="close-modal rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-500 transition hover:bg-slate-50">Cancel</button>
                    <button type="submit" class="rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700">Save Agenda</button>
                </div>
            </form>
        </div>
    </div>

    <div id="agendaDetailModal" class="modal-backdrop fixed inset-0 z-50 hidden items-center justify-center p-4">
        <div class="dialog-panel max-h-[90vh] w-full max-w-4xl overflow-y-auto bg-white p-6">
            <div class="mb-5 flex items-start justify-between gap-4">
                <div>
                    <h3 id="agendaDetailTitle" class="text-lg font-semibold text-slate-800"></h3>
                    <p id="agendaDetailMeta" class="text-xs text-slate-400"></p>
                </div>
                <button type="button" class="close-modal rounded-lg p-2 text-slate-400 transition hover:bg-slate-50 hover:text-slate-600">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="mb-6 rounded-xl bg-slate-50 p-4">
                <h4 class="mb-3 text-sm font-semibold text-slate-700">Agenda</h4>
                <ul id="agendaDetailPoints" class="space-y-2 text-sm text-slate-600"></ul>
            </div>
            <div>
                <h4 class="mb-3 text-sm font-semibold text-slate-700">Assign Agenda To Employees</h4>
                <div id="agendaEmployeeAssignments" class="grid grid-cols-1 gap-3 md:grid-cols-2"></div>
            </div>
        </div>
    </div>

    <div id="reviewModal" class="modal-backdrop fixed inset-0 z-50 hidden items-center justify-center p-4">
        <div class="dialog-panel w-full max-w-3xl bg-white p-6">
            <div class="mb-5 flex items-start justify-between gap-4">
                <div>
                    <h3 id="reviewModalTitle" class="text-lg font-semibold text-slate-800"></h3>
                    <p id="reviewModalMeta" class="text-xs text-slate-400"></p>
                </div>
                <button type="button" class="close-modal rounded-lg p-2 text-slate-400 transition hover:bg-slate-50 hover:text-slate-600">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div id="reviewSystemPerformance" class="mb-5 grid grid-cols-1 gap-3 rounded-xl bg-slate-50 p-4 sm:grid-cols-4"></div>
            <div id="reviewChecklist" class="space-y-3"></div>
            <div class="mt-6 flex justify-end gap-3">
                <button type="button" class="close-modal rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-500 transition hover:bg-slate-50">Cancel</button>
                <button type="button" class="close-modal rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700">Submit Review</button>
            </div>
        </div>
    </div>
</main>

<script>
    const sidebarToggle = document.getElementById('sidebarToggle');
    const mobileSidebarToggle = document.getElementById('mobileSidebarToggle');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    const agendaCards = document.getElementById('agendaCards');
    const reviewTableBody = document.getElementById('reviewTableBody');
    const openAgendaModalButton = document.getElementById('openAgendaModalButton');
    const agendaFormModal = document.getElementById('agendaFormModal');
    const agendaDetailModal = document.getElementById('agendaDetailModal');
    const reviewModal = document.getElementById('reviewModal');
    const agendaForm = document.getElementById('agendaForm');
    const agendaDepartmentInput = document.getElementById('agendaDepartmentInput');
    const agendaTitleInput = document.getElementById('agendaTitleInput');
    const agendaPointsInput = document.getElementById('agendaPointsInput');

    const employeeRecords = [
        { name: 'Cabdiraxmaan Cali', id: 'EMP-0001', branch: 'Idaacada Branch', department: 'Human Resource Manager', role: 'Human Resource Officer', performance: 92, performanceLevel: 'high', reviewStatus: 'Completed' },
        { name: 'Fadumo Xasan', id: 'EMP-0002', branch: 'Xero Awr Branch', department: 'Head of Finances', role: 'Finance Officer', performance: 95, performanceLevel: 'high', reviewStatus: 'Completed' },
        { name: 'Mahad Axmed', id: 'EMP-0003', branch: 'Togdheer Branch', department: 'Operations Manager', role: 'Operations Supervisor', performance: 90, performanceLevel: 'high', reviewStatus: 'Completed' },
        { name: 'Sahra Maxamed', id: 'EMP-0004', branch: 'Calaamada Branch', department: 'Marketing Manager', role: 'Marketing Coordinator', performance: 76, performanceLevel: 'mid', reviewStatus: 'Pending Review' },
        { name: 'Hodan Ali', id: 'EMP-0005', branch: 'Masalaha Branch', department: 'Manager', role: 'Administration Officer', performance: 84, performanceLevel: 'mid', reviewStatus: 'Completed' },
        { name: 'Mustafe Cabdi', id: 'EMP-0006', branch: 'Jigjiga Yar Branch', department: 'IT Manager', role: 'Systems Support Engineer', performance: 81, performanceLevel: 'mid', reviewStatus: 'Completed' },
        { name: 'Roda Jama', id: 'EMP-0007', branch: 'Xero Awr Branch', department: 'Head of Finances', role: 'Financial Analyst', performance: 88, performanceLevel: 'high', reviewStatus: 'Completed' },
        { name: 'Amina Yusuf', id: 'EMP-0008', branch: 'Idaacada Branch', department: 'Human Resource Manager', role: 'Talent Officer', performance: 86, performanceLevel: 'mid', reviewStatus: 'Completed' },
        { name: 'Ahmed Jama', id: 'EMP-0009', branch: 'Calaamada Branch', department: 'Marketing Manager', role: 'Marketing Associate', performance: 69, performanceLevel: 'low', reviewStatus: 'Pending Review' },
        { name: 'Mohamed Yusuf', id: 'EMP-0010', branch: 'Masalaha Branch', department: 'Manager', role: 'Records Coordinator', performance: 83, performanceLevel: 'mid', reviewStatus: 'Completed' },
        { name: 'Ilwad Noor', id: 'EMP-0011', branch: 'Jigjiga Yar Branch', department: 'IT Manager', role: 'Software Developer I', performance: 91, performanceLevel: 'high', reviewStatus: 'Completed' },
        { name: 'Nimco Abdi', id: 'EMP-0012', branch: 'Togdheer Branch', department: 'Operations Manager', role: 'Operations Officer', performance: 71, performanceLevel: 'low', reviewStatus: 'Pending Review' }
    ];

    const departmentEmployees = employeeRecords.reduce((departments, employee) => {
        if (!departments[employee.department]) {
            departments[employee.department] = [];
        }

        departments[employee.department].push(employee);
        return departments;
    }, {});

    const agendas = [
        {
            department: 'Human Resource Manager',
            title: 'Staff Follow Up',
            points: ['Check staff attendance', 'Follow up staff leave', 'Update employee files']
        },
        {
            department: 'Head of Finances',
            title: 'Audit Follow Up',
            points: ['Check payment records', 'Follow up missing receipts', 'Prepare simple finance report']
        },
        {
            department: 'Operations Manager',
            title: 'Branch Follow Up',
            points: ['Check branch work', 'Follow up daily problems', 'Report unfinished tasks']
        },
        {
            department: 'Marketing Manager',
            title: 'Customer Follow Up',
            points: ['Call customers', 'Share new offers', 'Write customer feedback']
        },
        {
            department: 'Manager',
            title: 'Office Work Follow Up',
            points: ['Check office records', 'Arrange daily work', 'Follow up pending documents']
        },
        {
            department: 'IT Manager',
            title: 'Computer And Website Check',
            points: ['Diagnose website problems', 'Fix computers', 'Help staff with system issues']
        }
    ];

    function toggleSidebar() {
        document.body.classList.toggle('sidebar-collapsed');
    }

    function toggleMobileSidebar() {
        document.body.classList.toggle('sidebar-open');
    }

    function showModal(modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function hideModal(modal) {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    function renderAgendaCards() {
        agendaCards.innerHTML = agendas.map((agenda, index) => {
            const employeeCount = departmentEmployees[agenda.department]?.length || 0;

            return `
                <button type="button" class="agenda-card glass-card border-l-4 border-indigo-500 p-5 text-left transition" data-agenda-index="${index}">
                    <div class="mb-4 flex items-start justify-between gap-3">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wide text-indigo-500">${agenda.department}</p>
                            <h3 class="mt-1 text-base font-semibold text-slate-800">${agenda.title}</h3>
                        </div>
                        <div class="rounded-xl bg-indigo-50 p-3 text-indigo-600">
                            <i class="fa-solid fa-list-check text-sm"></i>
                        </div>
                    </div>
                    <p class="mb-4 text-sm text-slate-500">${agenda.points[0]}</p>
                    <div class="flex items-center justify-between text-xs font-semibold text-slate-400">
                        <span>${agenda.points.length} agenda points</span>
                        <span>${employeeCount} employees</span>
                    </div>
                </button>
            `;
        }).join('');

        document.querySelectorAll('[data-agenda-index]').forEach((card) => {
            card.addEventListener('click', () => openAgendaDetail(Number(card.dataset.agendaIndex)));
        });
    }

    function renderInsightCards() {
        document.getElementById('topPerformersCount').textContent = employeeRecords.filter((employee) => employee.performanceLevel === 'high').length;
        document.getElementById('needImprovementCount').textContent = employeeRecords.filter((employee) => employee.performanceLevel === 'low').length;
        document.getElementById('reviewsCompletedCount').textContent = employeeRecords.filter((employee) => employee.reviewStatus === 'Completed').length;
    }

    function getPerformanceLabel(employee) {
        if (employee.performanceLevel === 'high') {
            return 'Good';
        }

        if (employee.performanceLevel === 'mid') {
            return 'Normal';
        }

        return 'Needs Help';
    }

    function renderReviewTable() {
        const rows = agendas.flatMap((agenda, agendaIndex) => {
            const employees = departmentEmployees[agenda.department] || [];

            return employees.map((employee) => {
                const statusClass = employee.performanceLevel === 'high' ? 'status-excellent' : employee.performanceLevel === 'mid' ? 'status-good' : 'status-review';
                const statusLabel = employee.performanceLevel === 'high' ? 'Top Performer' : employee.reviewStatus;
                const performanceLabel = getPerformanceLabel(employee);

                return `
                    <tr class="text-sm text-slate-600">
                        <td class="px-4 py-4">
                            <div class="font-semibold text-slate-800">${employee.name}</div>
                            <div class="text-xs text-slate-400">${employee.id}</div>
                        </td>
                        <td class="px-4 py-4">
                            <div>${agenda.department}</div>
                            <div class="text-xs text-slate-400">${employee.branch}</div>
                        </td>
                        <td class="px-4 py-4">${agenda.title}</td>
                        <td class="px-4 py-4">
                            <div class="font-semibold text-slate-800">${employee.performance}%</div>
                            <div class="text-xs text-slate-400">${performanceLabel}</div>
                        </td>
                        <td class="px-4 py-4"><span class="status-pill ${statusClass}">${statusLabel}</span></td>
                        <td class="px-4 py-4">
                            <button type="button" class="review-employee-button rounded-lg bg-indigo-50 px-3 py-2 text-xs font-semibold text-indigo-600 transition hover:bg-indigo-100" data-agenda-index="${agendaIndex}" data-employee-id="${employee.id}">
                                Review
                            </button>
                        </td>
                    </tr>
                `;
            });
        });

        reviewTableBody.innerHTML = rows.join('');

        document.querySelectorAll('.review-employee-button').forEach((button) => {
            button.addEventListener('click', () => openReviewModal(Number(button.dataset.agendaIndex), button.dataset.employeeId));
        });
    }

    function openAgendaDetail(index) {
        const agenda = agendas[index];
        const employees = departmentEmployees[agenda.department] || [];

        document.getElementById('agendaDetailTitle').textContent = agenda.department;
        document.getElementById('agendaDetailMeta').textContent = `${agenda.title} | ${employees.length} employees under this department`;
        document.getElementById('agendaDetailPoints').innerHTML = agenda.points.map((point) => `
            <li class="flex gap-3">
                <i class="fa-solid fa-circle-check mt-1 text-xs text-indigo-500"></i>
                <span>${point}</span>
            </li>
        `).join('');
        document.getElementById('agendaEmployeeAssignments').innerHTML = employees.map((employee) => `
            <label class="flex items-center justify-between gap-4 rounded-xl border border-slate-100 bg-slate-50 p-4">
                <span>
                    <span class="block text-sm font-semibold text-slate-700">${employee.name}</span>
                    <span class="text-xs text-slate-400">${employee.id} | ${employee.role} | ${employee.branch}</span>
                </span>
                <input type="checkbox" checked class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
            </label>
        `).join('');

        showModal(agendaDetailModal);
    }

    function openReviewModal(agendaIndex, employeeId) {
        const agenda = agendas[agendaIndex];
        const employee = (departmentEmployees[agenda.department] || []).find((item) => item.id === employeeId);
        const performanceLabel = employee ? getPerformanceLabel(employee) : '';

        document.getElementById('reviewModalTitle').textContent = employee ? employee.name : 'Employee Review';
        document.getElementById('reviewModalMeta').textContent = `${agenda.department} | ${agenda.title}`;
        document.getElementById('reviewSystemPerformance').innerHTML = employee ? `
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-wide text-slate-400">System Perfomance</p>
                <p class="mt-1 text-lg font-bold text-slate-800">${employee.performance}%</p>
                <p class="text-xs text-slate-500">${performanceLabel}</p>
            </div>
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-wide text-slate-400">Employee ID</p>
                <p class="mt-1 text-sm font-semibold text-slate-700">${employee.id}</p>
            </div>
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-wide text-slate-400">Role</p>
                <p class="mt-1 text-sm font-semibold text-slate-700">${employee.role}</p>
            </div>
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-wide text-slate-400">Branch</p>
                <p class="mt-1 text-sm font-semibold text-slate-700">${employee.branch}</p>
            </div>
        ` : '';
        document.getElementById('reviewChecklist').innerHTML = agenda.points.map((point) => `
            <div class="rounded-xl border border-slate-100 bg-slate-50 p-4">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <label class="flex items-start gap-3">
                        <input type="checkbox" class="mt-1 h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                        <span>
                            <span class="block text-sm font-semibold text-slate-700">${point}</span>
                            <span class="text-xs text-slate-400">Check if the employee worked on this agenda.</span>
                        </span>
                    </label>
                    <div class="flex items-center gap-2">
                        <input type="number" min="0" max="100" value="0" class="w-24 rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                        <span class="text-sm font-semibold text-slate-500">%</span>
                    </div>
                </div>
            </div>
        `).join('');

        showModal(reviewModal);
    }

    document.querySelectorAll('.tab-button').forEach((button) => {
        button.addEventListener('click', () => {
            document.querySelectorAll('.tab-button').forEach((item) => item.classList.remove('active'));
            document.querySelectorAll('.tab-panel').forEach((panel) => panel.classList.add('hidden'));
            button.classList.add('active');
            document.getElementById(button.dataset.tabTarget).classList.remove('hidden');
            openAgendaModalButton.classList.toggle('hidden', button.dataset.tabTarget !== 'manageAgendaTab');
        });
    });

    openAgendaModalButton.addEventListener('click', () => showModal(agendaFormModal));

    document.querySelectorAll('.close-modal').forEach((button) => {
        button.addEventListener('click', () => {
            hideModal(agendaFormModal);
            hideModal(agendaDetailModal);
            hideModal(reviewModal);
        });
    });

    [agendaFormModal, agendaDetailModal, reviewModal].forEach((modal) => {
        modal.addEventListener('click', (event) => {
            if (event.target === modal) {
                hideModal(modal);
            }
        });
    });

    agendaForm.addEventListener('submit', (event) => {
        event.preventDefault();

        agendas.push({
            department: agendaDepartmentInput.value,
            title: agendaTitleInput.value.trim(),
            points: agendaPointsInput.value.split('\n').map((point) => point.trim()).filter(Boolean)
        });

        agendaForm.reset();
        renderAgendaCards();
        renderReviewTable();
        hideModal(agendaFormModal);
    });

    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', toggleSidebar);
    }

    if (mobileSidebarToggle) {
        mobileSidebarToggle.addEventListener('click', toggleMobileSidebar);
    }

    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', toggleMobileSidebar);
    }

    renderInsightCards();
    renderAgendaCards();
    renderReviewTable();
</script>
</body>
</html>
