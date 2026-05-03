<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRM System - Training &amp; Development</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background:
                radial-gradient(circle at top left, rgba(14, 165, 233, 0.14), transparent 30%),
                radial-gradient(circle at top right, rgba(236, 72, 153, 0.12), transparent 28%),
                linear-gradient(135deg, #f8fafc 0%, #eef2ff 48%, #fff7ed 100%);
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
            background: linear-gradient(135deg, rgba(14, 165, 233, 0.12), rgba(236, 72, 153, 0.1));
            color: #0f766e;
        }

        .sidebar-link.active {
            background: linear-gradient(135deg, #0ea5e9, #6366f1 55%, #ec4899);
            color: white;
            box-shadow: 0 12px 24px -16px rgba(99, 102, 241, 0.8);
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

        .insight-card:nth-child(4n + 1),
        .glass-card:nth-child(4n + 1) {
            background: linear-gradient(135deg, rgba(14, 165, 233, 0.16), rgba(255, 255, 255, 0.96) 58%);
            border-color: rgba(14, 165, 233, 0.22);
        }

        .insight-card:nth-child(4n + 2),
        .glass-card:nth-child(4n + 2) {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.16), rgba(255, 255, 255, 0.96) 58%);
            border-color: rgba(16, 185, 129, 0.22);
        }

        .insight-card:nth-child(4n + 3),
        .glass-card:nth-child(4n + 3) {
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.18), rgba(255, 255, 255, 0.96) 58%);
            border-color: rgba(245, 158, 11, 0.24);
        }

        .insight-card:nth-child(4n + 4),
        .glass-card:nth-child(4n + 4) {
            background: linear-gradient(135deg, rgba(236, 72, 153, 0.14), rgba(255, 255, 255, 0.96) 58%);
            border-color: rgba(236, 72, 153, 0.22);
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

        .training-table {
            border-collapse: separate;
            border-spacing: 0;
        }

        .training-table th,
        .training-table td {
            vertical-align: top;
        }

        .training-table tbody tr {
            background: rgba(255, 255, 255, 0.74);
            transition: background 0.2s ease, transform 0.2s ease;
        }

        .training-table tbody tr:nth-child(even) {
            background: rgba(248, 250, 252, 0.92);
        }

        .training-table tbody tr:hover {
            background: rgba(239, 246, 255, 0.95);
        }

        .status-pill {
            padding: 4px 12px;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .status-completed {
            background: #dcfce7;
            color: #166534;
        }

        .status-progress {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .status-scheduled {
            background: #fef3c7;
            color: #92400e;
        }

        .type-pill {
            padding: 4px 12px;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .type-mandatory {
            background: #ede9fe;
            color: #6d28d9;
        }

        .type-optional {
            background: #e0f2fe;
            color: #0369a1;
        }

        .training-action-button {
            background: #e6e2ed;
            border: 1px solid #d4cce0;
            color: #4b4458;
        }

        .training-action-button:hover {
            background: #ded8e8;
            color: #3f394b;
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
    <?php $currentMenu = 'training_development'; ?>
    <?php include __DIR__ . '/../../includes/header_sidebar.php'; ?>

    <div class="mx-auto w-full max-w-[1440px] p-4 md:p-8">
        <div class="mb-8 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-slate-800">Training &amp; Development</h2>
                <p class="text-sm text-slate-500">Track training coverage, completion momentum, upcoming sessions, and team compliance.</p>
            </div>
            <button id="openTrainingModal" type="button" class="training-action-button inline-flex items-center gap-2 rounded-xl px-4 py-3 text-sm font-semibold transition">
                <i class="fa-solid fa-plus text-xs"></i>
                <span>Add Training</span>
            </button>
        </div>

        <div id="trainingInsightCards" class="mb-8 grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-3"></div>

        <div class="mb-8 space-y-6">
            <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">
                <div class="glass-card p-6">
                    <div class="mb-5">
                        <h3 class="text-base font-semibold text-slate-800">Completion Trend</h3>
                        <p class="text-xs text-slate-400">Monthly training completions across the current sample period.</p>
                    </div>
                    <div class="h-[320px]">
                        <canvas id="trainingTrendChart"></canvas>
                    </div>
                </div>

                <div class="glass-card p-6">
                    <div class="mb-5">
                        <h3 class="text-base font-semibold text-slate-800">Training Types</h3>
                        <p class="text-xs text-slate-400">Column chart showing training counts by type category.</p>
                    </div>
                    <div class="h-[320px]">
                        <canvas id="trainingTypeChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">
                <div class="glass-card p-6">
                    <div class="mb-5">
                        <h3 class="text-base font-semibold text-slate-800">Upcoming Training</h3>
                        <p class="text-xs text-slate-400">Next scheduled sessions and in-progress training activities.</p>
                    </div>
                    <div id="upcomingTrainingEvents" class="space-y-4"></div>
                </div>

                <div class="glass-card p-6">
                    <div class="mb-5">
                        <h3 class="text-base font-semibold text-slate-800">Department &amp; Team Compliance</h3>
                        <p class="text-xs text-slate-400">Mandatory training completion rate by department and by team.</p>
                    </div>
                    <div class="space-y-6">
                        <div>
                            <h4 class="text-xs font-semibold uppercase tracking-[0.22em] text-slate-400">Departments</h4>
                            <div id="departmentComplianceList" class="mt-4 space-y-4"></div>
                        </div>
                        <div>
                            <h4 class="text-xs font-semibold uppercase tracking-[0.22em] text-slate-400">Teams</h4>
                            <div id="teamComplianceList" class="mt-4 space-y-4"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="glass-card p-6">
            <div class="mb-5 flex flex-col gap-2 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <h3 class="text-base font-semibold text-slate-800">Training List</h3>
                    <p class="text-xs text-slate-400">Training catalogue with type, provider, department, team, branch, and current completion status.</p>
                </div>
                <p class="text-xs font-medium text-slate-400">New records added from the modal are appended to this list immediately.</p>
            </div>
            <div class="table-scroll overflow-x-auto">
                <table class="training-table min-w-full text-left">
                    <thead>
                        <tr class="border-b border-slate-100 text-[11px] uppercase tracking-wider text-slate-400">
                            <th class="px-4 py-4 font-semibold">Training</th>
                            <th class="px-4 py-4 font-semibold">Type</th>
                            <th class="px-4 py-4 font-semibold">Category</th>
                            <th class="px-4 py-4 font-semibold">Department</th>
                            <th class="px-4 py-4 font-semibold">Team</th>
                            <th class="px-4 py-4 font-semibold">Branch</th>
                            <th class="px-4 py-4 font-semibold">Provider</th>
                            <th class="px-4 py-4 font-semibold">Date</th>
                            <th class="px-4 py-4 font-semibold">Status</th>
                            <th class="px-4 py-4 font-semibold">Trainees</th>
                        </tr>
                    </thead>
                    <tbody id="trainingTableBody" class="divide-y divide-slate-50"></tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="registeredTraineesModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 sm:p-6">
        <div class="modal-backdrop absolute inset-0"></div>
        <div class="glass-card dialog-panel relative z-10 mx-auto flex max-h-[calc(100vh-3rem)] w-full max-w-4xl flex-col overflow-hidden">
            <div class="flex items-start justify-between gap-4 border-b border-slate-100 px-6 py-5 sm:px-7">
                <div>
                    <h3 id="registeredTraineesTitle" class="text-lg font-semibold text-slate-800">Registered Trainees</h3>
                    <p id="registeredTraineesSubtitle" class="mt-1 text-sm text-slate-500"></p>
                </div>
                <button id="closeRegisteredTraineesModal" type="button" class="training-action-button flex h-10 w-10 items-center justify-center rounded-full transition">
                    <i class="fa-solid fa-xmark text-base"></i>
                </button>
            </div>
            <div class="max-h-[70vh] overflow-y-auto p-6 sm:px-7 sm:pb-7">
                <div class="table-scroll overflow-x-auto">
                    <table class="training-table min-w-full text-left">
                        <thead>
                            <tr class="border-b border-slate-100 text-[11px] uppercase tracking-wider text-slate-400">
                                <th class="px-4 py-4 font-semibold">Employee</th>
                                <th class="px-4 py-4 font-semibold">Department</th>
                                <th class="px-4 py-4 font-semibold">Branch</th>
                                <th class="px-4 py-4 font-semibold">Registration Date</th>
                                <th class="px-4 py-4 font-semibold">Status</th>
                            </tr>
                        </thead>
                        <tbody id="registeredTraineesTableBody" class="divide-y divide-slate-50"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="trainingModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 sm:p-6">
        <div class="modal-backdrop absolute inset-0"></div>
        <div class="glass-card dialog-panel relative z-10 mx-auto flex max-h-[calc(100vh-3rem)] w-full max-w-xl flex-col overflow-hidden">
            <div class="flex items-start justify-between gap-4 border-b border-slate-100 px-6 py-5 sm:px-7">
                <div>
                    <h3 class="text-lg font-semibold text-slate-800">Add Training</h3>
                    <p class="mt-1 text-sm text-slate-500">Create a sample training record and update the dashboard immediately.</p>
                </div>
                <button id="closeTrainingModal" type="button" class="training-action-button flex h-10 w-10 items-center justify-center rounded-full transition">
                    <i class="fa-solid fa-xmark text-base"></i>
                </button>
            </div>
            <div class="max-h-[calc(100vh-13rem)] overflow-y-auto">
                <form id="trainingForm" class="grid gap-5 p-6 md:grid-cols-2 sm:px-7 sm:pb-7">
                    <div>
                        <label for="trainingName" class="mb-2 block text-sm font-medium text-slate-600">Training Name</label>
                        <input id="trainingName" name="trainingName" type="text" required class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400" placeholder="Enter training title">
                    </div>
                    <div>
                        <label for="trainingProvider" class="mb-2 block text-sm font-medium text-slate-600">Provider</label>
                        <input id="trainingProvider" name="trainingProvider" type="text" required class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400" placeholder="Enter provider">
                    </div>
                    <div>
                        <label for="trainingType" class="mb-2 block text-sm font-medium text-slate-600">Training Type</label>
                        <select id="trainingType" name="trainingType" required class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400">
                            <option value="Mandatory">Mandatory</option>
                            <option value="Optional">Optional</option>
                        </select>
                    </div>
                    <div>
                        <label for="trainingCategory" class="mb-2 block text-sm font-medium text-slate-600">Category</label>
                        <select id="trainingCategory" name="trainingCategory" required class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400">
                            <option value="Compliance">Compliance</option>
                            <option value="Technical">Technical</option>
                            <option value="Leadership">Leadership</option>
                            <option value="Safety">Safety</option>
                            <option value="Finance">Finance</option>
                        </select>
                    </div>
                    <div>
                        <label for="trainingDepartment" class="mb-2 block text-sm font-medium text-slate-600">Department</label>
                        <select id="trainingDepartment" name="trainingDepartment" required class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400">
                            <option value="Human Resource">Human Resource</option>
                            <option value="Finance">Finance</option>
                            <option value="Operations">Operations</option>
                            <option value="Marketing">Marketing</option>
                            <option value="Administration">Administration</option>
                            <option value="Information Technology">Information Technology</option>
                        </select>
                    </div>
                    <div>
                        <label for="trainingTeam" class="mb-2 block text-sm font-medium text-slate-600">Team</label>
                        <input id="trainingTeam" name="trainingTeam" type="text" required class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400" placeholder="Enter team name">
                    </div>
                    <div>
                        <label for="trainingBranch" class="mb-2 block text-sm font-medium text-slate-600">Branch</label>
                        <select id="trainingBranch" name="trainingBranch" required class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400">
                            <option value="Idaacada Branch">Idaacada Branch</option>
                            <option value="Xero Awr Branch">Xero Awr Branch</option>
                            <option value="Togdheer Branch">Togdheer Branch</option>
                            <option value="Calaamada Branch">Calaamada Branch</option>
                            <option value="Masalaha Branch">Masalaha Branch</option>
                            <option value="Jigjiga Yar Branch">Jigjiga Yar Branch</option>
                        </select>
                    </div>
                    <div>
                        <label for="trainingDate" class="mb-2 block text-sm font-medium text-slate-600">Date</label>
                        <input id="trainingDate" name="trainingDate" type="date" required class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400">
                    </div>
                    <div class="md:col-span-2">
                        <label for="trainingStatus" class="mb-2 block text-sm font-medium text-slate-600">Status</label>
                        <select id="trainingStatus" name="trainingStatus" required class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400">
                            <option value="Scheduled">Scheduled</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>
                    <div class="md:col-span-2 flex justify-end gap-3 border-t border-slate-100 pt-5">
                        <button id="cancelTrainingModal" type="button" class="training-action-button rounded-xl px-4 py-3 text-sm font-semibold transition">Cancel</button>
                        <button type="submit" class="training-action-button rounded-xl px-4 py-3 text-sm font-semibold transition">Save Training</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const desktopSidebarBreakpoint = window.matchMedia('(min-width: 1024px)');
        const trainingInsightCards = document.getElementById('trainingInsightCards');
        const trainingTableBody = document.getElementById('trainingTableBody');
        const upcomingTrainingEvents = document.getElementById('upcomingTrainingEvents');
        const departmentComplianceList = document.getElementById('departmentComplianceList');
        const teamComplianceList = document.getElementById('teamComplianceList');
        const trainingTrendChartCanvas = document.getElementById('trainingTrendChart');
        const trainingTypeChartCanvas = document.getElementById('trainingTypeChart');
        const openTrainingModal = document.getElementById('openTrainingModal');
        const trainingModal = document.getElementById('trainingModal');
        const closeTrainingModal = document.getElementById('closeTrainingModal');
        const cancelTrainingModal = document.getElementById('cancelTrainingModal');
        const trainingForm = document.getElementById('trainingForm');
        const registeredTraineesModal = document.getElementById('registeredTraineesModal');
        const closeRegisteredTraineesModal = document.getElementById('closeRegisteredTraineesModal');
        const registeredTraineesTitle = document.getElementById('registeredTraineesTitle');
        const registeredTraineesSubtitle = document.getElementById('registeredTraineesSubtitle');
        const registeredTraineesTableBody = document.getElementById('registeredTraineesTableBody');
        let trainingTrendChart = null;
        let trainingTypeChart = null;

        const trainingRecords = [
            { id: 'TRN-001', title: 'Workplace Safety Refresher', trainingType: 'Mandatory', category: 'Safety', department: 'Operations', team: 'Field Support', branch: 'Togdheer Branch', provider: 'HR Academy', date: '2026-01-16', status: 'Completed' },
            { id: 'TRN-002', title: 'Payroll Controls Workshop', trainingType: 'Mandatory', category: 'Finance', department: 'Finance', team: 'Payroll', branch: 'Xero Awr Branch', provider: 'Finance Hub', date: '2026-01-28', status: 'Completed' },
            { id: 'TRN-003', title: 'Performance Coaching Lab', trainingType: 'Optional', category: 'Leadership', department: 'Human Resource', team: 'People Operations', branch: 'Idaacada Branch', provider: 'LeadPath', date: '2026-02-13', status: 'Completed' },
            { id: 'TRN-004', title: 'Cybersecurity Awareness', trainingType: 'Mandatory', category: 'Technical', department: 'Information Technology', team: 'Infrastructure', branch: 'Jigjiga Yar Branch', provider: 'SecureLearn', date: '2026-02-21', status: 'Completed' },
            { id: 'TRN-005', title: 'Brand Messaging Sprint', trainingType: 'Optional', category: 'Leadership', department: 'Marketing', team: 'Campaigns', branch: 'Calaamada Branch', provider: 'Growth Studio', date: '2026-03-05', status: 'Completed' },
            { id: 'TRN-006', title: 'Compliance Policy Update', trainingType: 'Mandatory', category: 'Compliance', department: 'Administration', team: 'Office Operations', branch: 'Masalaha Branch', provider: 'Policy Center', date: '2026-03-19', status: 'In Progress' },
            { id: 'TRN-007', title: 'Incident Response Drill', trainingType: 'Mandatory', category: 'Safety', department: 'Operations', team: 'Branch Response', branch: 'Togdheer Branch', provider: 'SafeOps', date: '2026-04-11', status: 'In Progress' },
            { id: 'TRN-008', title: 'Advanced Excel for Finance', trainingType: 'Optional', category: 'Finance', department: 'Finance', team: 'Reporting', branch: 'Xero Awr Branch', provider: 'SkillBridge', date: '2026-04-18', status: 'Completed' },
            { id: 'TRN-009', title: 'HR Interview Calibration', trainingType: 'Mandatory', category: 'Compliance', department: 'Human Resource', team: 'Talent Desk', branch: 'Idaacada Branch', provider: 'People First', date: '2026-05-02', status: 'Scheduled' },
            { id: 'TRN-010', title: 'Customer Journey Analytics', trainingType: 'Optional', category: 'Technical', department: 'Marketing', team: 'Insights', branch: 'Calaamada Branch', provider: 'Data Sense', date: '2026-05-09', status: 'Scheduled' },
            { id: 'TRN-011', title: 'Records Management Basics', trainingType: 'Mandatory', category: 'Compliance', department: 'Administration', team: 'Records Desk', branch: 'Masalaha Branch', provider: 'Policy Center', date: '2026-05-15', status: 'Scheduled' },
            { id: 'TRN-012', title: 'Helpdesk Service Excellence', trainingType: 'Optional', category: 'Leadership', department: 'Information Technology', team: 'Helpdesk', branch: 'Jigjiga Yar Branch', provider: 'Service Lab', date: '2026-05-22', status: 'In Progress' }
        ];

        const registeredTrainees = {
            'TRN-001': [
                { name: 'Mahad Axmed', employeeId: 'EMP-0003', department: 'Operations', branch: 'Togdheer Branch', registeredOn: '2026-01-05', status: 'Completed' },
                { name: 'Nimco Abdi', employeeId: 'EMP-0012', department: 'Operations', branch: 'Togdheer Branch', registeredOn: '2026-01-06', status: 'Completed' },
                { name: 'Sakariye Noor', employeeId: 'EMP-0009', department: 'Operations', branch: 'Togdheer Branch', registeredOn: '2026-01-07', status: 'Completed' }
            ],
            'TRN-002': [
                { name: 'Fadumo Xasan', employeeId: 'EMP-0002', department: 'Finance', branch: 'Xero Awr Branch', registeredOn: '2026-01-17', status: 'Completed' },
                { name: 'Roda Jama', employeeId: 'EMP-0007', department: 'Finance', branch: 'Xero Awr Branch', registeredOn: '2026-01-18', status: 'Completed' }
            ],
            'TRN-003': [
                { name: 'Cabdiraxmaan Cali', employeeId: 'EMP-0001', department: 'Human Resource', branch: 'Idaacada Branch', registeredOn: '2026-02-01', status: 'Completed' },
                { name: 'Amina Yusuf', employeeId: 'EMP-0008', department: 'Human Resource', branch: 'Idaacada Branch', registeredOn: '2026-02-02', status: 'Completed' }
            ],
            'TRN-004': [
                { name: 'Mustafe Cabdi', employeeId: 'EMP-0006', department: 'Information Technology', branch: 'Jigjiga Yar Branch', registeredOn: '2026-02-10', status: 'Completed' },
                { name: 'Ilwad Noor', employeeId: 'EMP-0011', department: 'Information Technology', branch: 'Jigjiga Yar Branch', registeredOn: '2026-02-11', status: 'Completed' }
            ],
            'TRN-005': [
                { name: 'Sahra Maxamed', employeeId: 'EMP-0004', department: 'Marketing', branch: 'Calaamada Branch', registeredOn: '2026-02-24', status: 'Completed' },
                { name: 'Ahmed Jama', employeeId: 'EMP-0009', department: 'Marketing', branch: 'Calaamada Branch', registeredOn: '2026-02-25', status: 'Completed' }
            ],
            'TRN-006': [
                { name: 'Hodan Ali', employeeId: 'EMP-0005', department: 'Administration', branch: 'Masalaha Branch', registeredOn: '2026-03-08', status: 'In Progress' },
                { name: 'Mohamed Yusuf', employeeId: 'EMP-0010', department: 'Administration', branch: 'Masalaha Branch', registeredOn: '2026-03-09', status: 'In Progress' }
            ],
            'TRN-007': [
                { name: 'Mahad Axmed', employeeId: 'EMP-0003', department: 'Operations', branch: 'Togdheer Branch', registeredOn: '2026-04-01', status: 'In Progress' },
                { name: 'Nimco Abdi', employeeId: 'EMP-0012', department: 'Operations', branch: 'Togdheer Branch', registeredOn: '2026-04-02', status: 'In Progress' }
            ],
            'TRN-008': [
                { name: 'Fadumo Xasan', employeeId: 'EMP-0002', department: 'Finance', branch: 'Xero Awr Branch', registeredOn: '2026-04-03', status: 'Completed' },
                { name: 'Roda Jama', employeeId: 'EMP-0007', department: 'Finance', branch: 'Xero Awr Branch', registeredOn: '2026-04-04', status: 'Completed' }
            ],
            'TRN-009': [
                { name: 'Cabdiraxmaan Cali', employeeId: 'EMP-0001', department: 'Human Resource', branch: 'Idaacada Branch', registeredOn: '2026-04-20', status: 'Registered' },
                { name: 'Amina Yusuf', employeeId: 'EMP-0008', department: 'Human Resource', branch: 'Idaacada Branch', registeredOn: '2026-04-21', status: 'Registered' }
            ],
            'TRN-010': [
                { name: 'Sahra Maxamed', employeeId: 'EMP-0004', department: 'Marketing', branch: 'Calaamada Branch', registeredOn: '2026-04-24', status: 'Registered' },
                { name: 'Ahmed Jama', employeeId: 'EMP-0009', department: 'Marketing', branch: 'Calaamada Branch', registeredOn: '2026-04-25', status: 'Registered' }
            ],
            'TRN-011': [
                { name: 'Hodan Ali', employeeId: 'EMP-0005', department: 'Administration', branch: 'Masalaha Branch', registeredOn: '2026-04-26', status: 'Registered' }
            ],
            'TRN-012': [
                { name: 'Mustafe Cabdi', employeeId: 'EMP-0006', department: 'Information Technology', branch: 'Jigjiga Yar Branch', registeredOn: '2026-04-26', status: 'In Progress' },
                { name: 'Ilwad Noor', employeeId: 'EMP-0011', department: 'Information Technology', branch: 'Jigjiga Yar Branch', registeredOn: '2026-04-27', status: 'In Progress' }
            ]
        };

        const trainingCardConfig = [
            { key: 'coursesCreated', label: 'Courses Created', border: 'border-indigo-500', iconBg: 'bg-indigo-50', iconColor: 'text-indigo-600', icon: 'fa-layer-group', helper: 'All courses created in the training module.' },
            { key: 'mandatoryTraining', label: 'Mandatory Training', border: 'border-violet-500', iconBg: 'bg-violet-50', iconColor: 'text-violet-600', icon: 'fa-circle-exclamation', helper: 'Mandatory sessions that teams are expected to complete.' },
            { key: 'optionalTraining', label: 'Optional Training', border: 'border-sky-500', iconBg: 'bg-sky-50', iconColor: 'text-sky-600', icon: 'fa-lightbulb', helper: 'Elective programs for development and upskilling.' },
            { key: 'inProgress', label: 'In Progress', border: 'border-amber-500', iconBg: 'bg-amber-50', iconColor: 'text-amber-600', icon: 'fa-spinner', helper: 'Sessions currently being delivered or actively attended.' },
            { key: 'completed', label: 'Completed', border: 'border-emerald-500', iconBg: 'bg-emerald-50', iconColor: 'text-emerald-600', icon: 'fa-circle-check', helper: 'Trainings already completed in the current sample set.' }
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
            if (status === 'Completed') {
                return 'status-completed';
            }

            if (status === 'In Progress') {
                return 'status-progress';
            }

            return 'status-scheduled';
        }

        function getTypeClass(trainingType) {
            return trainingType === 'Mandatory' ? 'type-mandatory' : 'type-optional';
        }

        function buildTrainingSummary() {
            return {
                coursesCreated: `${trainingRecords.length} Courses`,
                mandatoryTraining: `${trainingRecords.filter(record => record.trainingType === 'Mandatory').length} Sessions`,
                optionalTraining: `${trainingRecords.filter(record => record.trainingType === 'Optional').length} Sessions`,
                inProgress: `${trainingRecords.filter(record => record.status === 'In Progress').length} Sessions`,
                completed: `${trainingRecords.filter(record => record.status === 'Completed').length} Sessions`
            };
        }

        function renderInsightCards() {
            const summary = buildTrainingSummary();

            trainingInsightCards.innerHTML = trainingCardConfig.map(card => `
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

        function buildTrendData() {
            const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'];
            const monthMap = { '2026-01': 0, '2026-02': 1, '2026-03': 2, '2026-04': 3, '2026-05': 4, '2026-06': 5 };
            const values = [0, 0, 0, 0, 0, 0];

            trainingRecords.forEach(record => {
                if (record.status !== 'Completed') {
                    return;
                }

                const monthKey = record.date.slice(0, 7);
                if (monthMap[monthKey] !== undefined) {
                    values[monthMap[monthKey]] += 1;
                }
            });

            return { labels, values };
        }

        function buildTrainingTypeData() {
            const categoryMap = {};

            trainingRecords.forEach(record => {
                if (!categoryMap[record.category]) {
                    categoryMap[record.category] = 0;
                }

                categoryMap[record.category] += 1;
            });

            return {
                labels: Object.keys(categoryMap),
                values: Object.values(categoryMap)
            };
        }

        function renderTrendChart() {
            if (!trainingTrendChartCanvas || typeof Chart === 'undefined') {
                return;
            }

            const trendData = buildTrendData();

            if (trainingTrendChart) {
                trainingTrendChart.destroy();
            }

            trainingTrendChart = new Chart(trainingTrendChartCanvas, {
                type: 'line',
                data: {
                    labels: trendData.labels,
                    datasets: [{
                        label: 'Completed Trainings',
                        data: trendData.values,
                        borderColor: '#4f46e5',
                        backgroundColor: 'rgba(79, 70, 229, 0.12)',
                        fill: true,
                        tension: 0.42,
                        pointRadius: 4,
                        pointHoverRadius: 5,
                        pointBackgroundColor: '#4f46e5'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            grid: { display: false }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: { precision: 0 },
                            grid: { color: 'rgba(226, 232, 240, 0.85)' }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                boxWidth: 12,
                                color: '#475569',
                                font: { size: 12, weight: '600' }
                            }
                        }
                    }
                }
            });
        }

        function renderTrainingTypeChart() {
            if (!trainingTypeChartCanvas || typeof Chart === 'undefined') {
                return;
            }

            const typeData = buildTrainingTypeData();

            if (trainingTypeChart) {
                trainingTypeChart.destroy();
            }

            trainingTypeChart = new Chart(trainingTypeChartCanvas, {
                type: 'bar',
                data: {
                    labels: typeData.labels,
                    datasets: [{
                        label: 'Training Count',
                        data: typeData.values,
                        backgroundColor: ['#4f46e5', '#0ea5e9', '#10b981', '#f59e0b', '#8b5cf6'],
                        borderRadius: 10,
                        maxBarThickness: 52
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            grid: { display: false }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: { precision: 0 },
                            grid: { color: 'rgba(226, 232, 240, 0.85)' }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                boxWidth: 12,
                                color: '#475569',
                                font: { size: 12, weight: '600' }
                            }
                        }
                    }
                }
            });
        }

        function renderUpcomingEvents() {
            const upcomingRecords = trainingRecords
                .filter(record => record.status !== 'Completed')
                .sort((left, right) => new Date(left.date) - new Date(right.date))
                .slice(0, 4);

            upcomingTrainingEvents.innerHTML = upcomingRecords.map(record => `
                <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <p class="text-sm font-semibold text-slate-700">${record.title}</p>
                            <p class="mt-1 text-xs text-slate-400">${record.department} · ${record.team}</p>
                        </div>
                        <span class="status-pill ${getStatusClass(record.status)}">${record.status}</span>
                    </div>
                    <div class="mt-4 flex items-center justify-between text-xs text-slate-500">
                        <span>${record.date}</span>
                        <span>${record.branch}</span>
                    </div>
                </div>
            `).join('');
        }

        function buildComplianceData(keyName) {
            const grouped = {};

            trainingRecords
                .filter(record => record.trainingType === 'Mandatory')
                .forEach(record => {
                    const label = record[keyName];

                    if (!grouped[label]) {
                        grouped[label] = { total: 0, completed: 0 };
                    }

                    grouped[label].total += 1;

                    if (record.status === 'Completed') {
                        grouped[label].completed += 1;
                    }
                });

            return Object.entries(grouped)
                .map(([label, values]) => ({
                    label,
                    total: values.total,
                    completed: values.completed,
                    percent: Math.round((values.completed / values.total) * 100)
                }))
                .sort((left, right) => right.percent - left.percent);
        }

        function renderComplianceList(target, entries) {
            target.innerHTML = entries.map(entry => `
                <div>
                    <div class="mb-2 flex items-center justify-between gap-3">
                        <p class="text-sm font-medium text-slate-700">${entry.label}</p>
                        <p class="text-xs font-semibold text-slate-400">${entry.completed}/${entry.total} complete</p>
                    </div>
                    <div class="h-2.5 overflow-hidden rounded-full bg-slate-100">
                        <div class="h-full rounded-full bg-indigo-500" style="width: ${entry.percent}%"></div>
                    </div>
                    <p class="mt-2 text-xs font-medium text-slate-400">${entry.percent}% compliance</p>
                </div>
            `).join('');
        }

        function renderTrainingTable() {
            trainingTableBody.innerHTML = trainingRecords
                .slice()
                .sort((left, right) => new Date(right.date) - new Date(left.date))
                .map(record => `
                    <tr class="transition-colors hover:bg-slate-50/70">
                        <td class="px-4 py-4">
                            <div>
                                <p class="text-sm font-semibold text-slate-700">${record.title}</p>
                                <p class="text-[11px] text-slate-400">${record.id}</p>
                            </div>
                        </td>
                        <td class="px-4 py-4"><span class="type-pill ${getTypeClass(record.trainingType)}">${record.trainingType}</span></td>
                        <td class="px-4 py-4 text-sm text-slate-600">${record.category}</td>
                        <td class="px-4 py-4 text-sm text-slate-600">${record.department}</td>
                        <td class="px-4 py-4 text-sm text-slate-600">${record.team}</td>
                        <td class="px-4 py-4 text-sm text-slate-600">${record.branch}</td>
                        <td class="px-4 py-4 text-sm text-slate-600">${record.provider}</td>
                        <td class="px-4 py-4 text-sm text-slate-600">${record.date}</td>
                        <td class="px-4 py-4"><span class="status-pill ${getStatusClass(record.status)}">${record.status}</span></td>
                        <td class="px-4 py-4">
                            <button type="button" class="view-registered-trainees training-action-button inline-flex items-center gap-2 rounded-xl px-3 py-2 text-xs font-semibold transition" data-training-id="${record.id}">
                                <i class="fa-regular fa-eye"></i>
                                <span>${(registeredTrainees[record.id] || []).length}</span>
                            </button>
                        </td>
                    </tr>
                `).join('');
        }

        function showRegisteredTrainees(trainingId) {
            const training = trainingRecords.find(record => record.id === trainingId);
            const trainees = registeredTrainees[trainingId] || [];

            if (!training) {
                return;
            }

            registeredTraineesTitle.textContent = 'Registered Trainees';
            registeredTraineesSubtitle.textContent = `${training.title} (${training.id}) - ${trainees.length} trainee${trainees.length === 1 ? '' : 's'}`;
            registeredTraineesTableBody.innerHTML = trainees.map(trainee => `
                <tr class="transition-colors hover:bg-slate-50/70">
                    <td class="px-4 py-4">
                        <div>
                            <p class="text-sm font-semibold text-slate-700">${trainee.name}</p>
                            <p class="text-[11px] text-slate-400">${trainee.employeeId}</p>
                        </div>
                    </td>
                    <td class="px-4 py-4 text-sm text-slate-600">${trainee.department}</td>
                    <td class="px-4 py-4 text-sm text-slate-600">${trainee.branch}</td>
                    <td class="px-4 py-4 text-sm text-slate-600">${trainee.registeredOn}</td>
                    <td class="px-4 py-4"><span class="status-pill ${getStatusClass(trainee.status)}">${trainee.status}</span></td>
                </tr>
            `).join('');

            if (!trainees.length) {
                registeredTraineesTableBody.innerHTML = `
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-sm text-slate-400">No trainees registered for this training yet.</td>
                    </tr>
                `;
            }

            registeredTraineesModal.classList.remove('hidden');
            registeredTraineesModal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
        }

        function hideRegisteredTrainees() {
            registeredTraineesModal.classList.add('hidden');
            registeredTraineesModal.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        }

        function renderTrainingDashboard() {
            renderInsightCards();
            renderTrendChart();
            renderTrainingTypeChart();
            renderUpcomingEvents();
            renderComplianceList(departmentComplianceList, buildComplianceData('department'));
            renderComplianceList(teamComplianceList, buildComplianceData('team'));
            renderTrainingTable();
        }

        function showTrainingModal() {
            trainingModal.classList.remove('hidden');
            trainingModal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
        }

        function hideTrainingModal() {
            trainingModal.classList.add('hidden');
            trainingModal.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
            trainingForm.reset();
        }

        function buildTrainingId() {
            const nextNumber = trainingRecords.length + 1;
            return `TRN-${String(nextNumber).padStart(3, '0')}`;
        }

        function handleTrainingSubmit(event) {
            event.preventDefault();

            const formData = new FormData(trainingForm);

            const trainingId = buildTrainingId();

            trainingRecords.push({
                id: trainingId,
                title: formData.get('trainingName').trim(),
                trainingType: formData.get('trainingType'),
                category: formData.get('trainingCategory'),
                department: formData.get('trainingDepartment'),
                team: formData.get('trainingTeam').trim(),
                branch: formData.get('trainingBranch'),
                provider: formData.get('trainingProvider').trim(),
                date: formData.get('trainingDate'),
                status: formData.get('trainingStatus')
            });
            registeredTrainees[trainingId] = [];

            hideTrainingModal();
            renderTrainingDashboard();
        }

        sidebarToggle.addEventListener('click', handleSidebarToggle);
        sidebarOverlay.addEventListener('click', closeMobileSidebar);
        window.addEventListener('resize', syncSidebarMode);
        openTrainingModal.addEventListener('click', showTrainingModal);
        closeTrainingModal.addEventListener('click', hideTrainingModal);
        cancelTrainingModal.addEventListener('click', hideTrainingModal);
        trainingForm.addEventListener('submit', handleTrainingSubmit);
        closeRegisteredTraineesModal.addEventListener('click', hideRegisteredTrainees);
        registeredTraineesModal.addEventListener('click', event => {
            if (event.target === registeredTraineesModal || event.target.classList.contains('modal-backdrop')) {
                hideRegisteredTrainees();
            }
        });
        trainingTableBody.addEventListener('click', event => {
            const trigger = event.target.closest('.view-registered-trainees');

            if (!trigger) {
                return;
            }

            showRegisteredTrainees(trigger.dataset.trainingId);
        });
        trainingModal.addEventListener('click', event => {
            if (event.target === trainingModal || event.target.classList.contains('modal-backdrop')) {
                hideTrainingModal();
            }
        });

        renderTrainingDashboard();
        syncSidebarMode();
    </script>
</body>
</html>
