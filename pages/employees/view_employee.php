<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRM System - View Employee</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background:
                radial-gradient(circle at top left, rgba(14, 165, 233, 0.14), transparent 30%),
                radial-gradient(circle at top right, rgba(244, 114, 182, 0.14), transparent 28%),
                linear-gradient(135deg, #f8fafc 0%, #eef2ff 45%, #fff7ed 100%);
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

        .status-leave {
            background: #fef3c7;
            color: #92400e;
        }

        .status-inactive {
            background: #fee2e2;
            color: #991b1b;
        }

        .status-late {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .status-pending {
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

        .status-warning {
            background: #ffedd5;
            color: #9a3412;
        }

        .status-critical {
            background: #ffe4e6;
            color: #be123c;
        }

        .status-monitoring {
            background: #e0f2fe;
            color: #0369a1;
        }

        .modal-backdrop {
            background: rgba(15, 23, 42, 0.45);
            backdrop-filter: blur(4px);
        }

        .promotion-glass-panel {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .promotion-timeline-track {
            position: relative;
            height: 2px;
            background: #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .promotion-timeline-progress {
            position: absolute;
            left: 0;
            height: 100%;
            background: linear-gradient(90deg, #3b82f6, #8b5cf6);
            transition: width 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
            z-index: 1;
        }

        .promotion-step-node {
            position: relative;
            z-index: 2;
            width: 12px;
            height: 12px;
            background: #cbd5e1;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .promotion-step-node.active {
            background: #3b82f6;
            transform: scale(1.5);
            box-shadow: 0 0 0 6px rgba(59, 130, 246, 0.15);
        }

        .promotion-year-indicator {
            position: absolute;
            top: -32px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 0.75rem;
            font-weight: 800;
            color: #94a3b8;
            transition: color 0.3s;
            white-space: nowrap;
        }

        .promotion-step-node.active .promotion-year-indicator {
            color: #1e293b;
        }

        .promotion-content-card {
            display: none;
            animation: promotionSlideUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .promotion-content-card.active {
            display: block;
        }

        @keyframes promotionSlideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .promotion-skill-tag {
            background: rgba(59, 130, 246, 0.08);
            color: #2563eb;
            border: 1px solid rgba(59, 130, 246, 0.1);
        }

        .metric-card:hover {
            transform: translateY(-2px);
            transition: all 0.3s ease;
        }

        .metric-card:nth-child(4n + 1),
        .tab-panel > .space-y-6 > .grid .glass-card:nth-child(4n + 1) {
            background: linear-gradient(135deg, rgba(14, 165, 233, 0.16), rgba(255, 255, 255, 0.96) 58%);
            border-color: rgba(14, 165, 233, 0.22);
        }

        .metric-card:nth-child(4n + 2),
        .tab-panel > .space-y-6 > .grid .glass-card:nth-child(4n + 2) {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.16), rgba(255, 255, 255, 0.96) 58%);
            border-color: rgba(16, 185, 129, 0.22);
        }

        .metric-card:nth-child(4n + 3),
        .tab-panel > .space-y-6 > .grid .glass-card:nth-child(4n + 3) {
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.18), rgba(255, 255, 255, 0.96) 58%);
            border-color: rgba(245, 158, 11, 0.24);
        }

        .metric-card:nth-child(4n + 4),
        .tab-panel > .space-y-6 > .grid .glass-card:nth-child(4n + 4) {
            background: linear-gradient(135deg, rgba(236, 72, 153, 0.14), rgba(255, 255, 255, 0.96) 58%);
            border-color: rgba(236, 72, 153, 0.22);
        }

        .tab-button {
            transition: all 0.2s ease;
        }

        .tab-button.active {
            background: linear-gradient(135deg, #0ea5e9, #6366f1 55%, #ec4899);
            color: #ffffff;
            box-shadow: 0 10px 20px -12px rgba(99, 102, 241, 0.55);
        }

        .tab-panel {
            display: none;
        }

        .tab-panel.active {
            display: block;
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

        @media print {
            #sidebarOverlay,
            #appSidebar,
            #sidebarToggle,
            .employee-page-actions {
                display: none !important;
            }

            #dashboardMain {
                margin-left: 0 !important;
            }

            body {
                background: #ffffff;
            }

            .glass-card {
                box-shadow: none;
                border-color: #e2e8f0;
            }
        }
    </style>
</head>
<body class="flex min-h-screen bg-slate-50">
    <?php $menuBasePath = '../../'; ?>
    <?php $currentMenu = 'employees'; ?>
    <?php include __DIR__ . '/../../includes/header_sidebar.php'; ?>

    <div class="mx-auto w-full max-w-[1440px] p-4 md:p-8">
        <div class="employee-page-actions mb-6 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
            <button type="button" onclick="history.back()" class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50">
                <i class="fa-solid fa-arrow-left text-xs"></i>
                <span>Go Back</span>
            </button>

            <button type="button" onclick="window.print()" class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-indigo-100 transition hover:bg-indigo-700">
                <i class="fa-solid fa-print text-xs"></i>
                <span>Print Employee Info</span>
            </button>
        </div>

        <div class="glass-card mb-6 overflow-hidden">
            <div class="grid grid-cols-1 gap-0 xl:grid-cols-[320px_minmax(0,1fr)]">
                <div class="border-b border-slate-100 bg-slate-50/70 p-8 xl:border-b-0 xl:border-r">
                    <div class="flex flex-col items-center text-center">
                        <img src="/HRMS/ceo.jpg" alt="Employee Avatar" class="h-28 w-28 rounded-3xl border border-slate-200 bg-white p-2 shadow-sm" data-employee-image="avatar">
                        <h2 class="mt-5 text-2xl font-semibold text-slate-800" data-employee-field="name">Cabdiraxmaan Cali</h2>
                        <p class="mt-1 text-sm text-slate-500" data-employee-field="designation">Human Resource Director</p>
                        <div class="mt-4 flex items-center gap-2">
                            <span class="status-pill status-active" data-employee-status>Active</span>
                            <span class="rounded-full bg-indigo-50 px-3 py-1 text-[11px] font-semibold text-indigo-600" data-employee-field="employeeNumber">EMP-0001</span>
                        </div>
                    </div>
                </div>

                <div class="p-8">
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
                        <div class="glass-card metric-card border border-slate-100 p-4">
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Department</p>
                            <p class="mt-2 text-sm font-semibold text-slate-700" data-employee-field="department">Human Resource</p>
                        </div>
                        <div class="glass-card metric-card border border-slate-100 p-4">
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Branch</p>
                            <p class="mt-2 text-sm font-semibold text-slate-700" data-employee-field="branch">Idaacada Branch</p>
                        </div>
                        <div class="glass-card metric-card border border-slate-100 p-4">
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Join Date</p>
                            <p class="mt-2 text-sm font-semibold text-slate-700" data-employee-field="joinDate">2024-01-12</p>
                        </div>
                        <div class="glass-card metric-card border border-slate-100 p-4">
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Phone Number</p>
                            <p class="mt-2 text-sm font-semibold text-slate-700" data-employee-field="phone">+252 61 555 0101</p>
                        </div>
                    </div>

                    <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div class="rounded-2xl border border-slate-100 bg-slate-50 px-5 py-4">
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Email Address</p>
                            <p class="mt-2 text-sm text-slate-700" data-employee-field="email">cabdirahman.cali@hrms.local</p>
                        </div>
                        <div class="rounded-2xl border border-slate-100 bg-slate-50 px-5 py-4">
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Current Location</p>
                            <p class="mt-2 text-sm text-slate-700" data-employee-field="location">Idaacada, Hargeisa</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-6 flex flex-wrap gap-3">
            <button type="button" class="tab-button active rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-600" data-tab="basic-info">Basic Info</button>
            <button type="button" class="tab-button rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-600" data-tab="attendance">Attendance</button>
            <button type="button" class="tab-button rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-600" data-tab="warnings">Warnings</button>
            <button type="button" class="tab-button rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-600" data-tab="leaves">Leaves</button>
            <button type="button" class="tab-button rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-600" data-tab="promotion">Promotion</button>
            <button type="button" class="tab-button rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-600" data-tab="payroll">Payroll</button>
            <button type="button" class="tab-button rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-600" data-tab="training">Training</button>
            <button type="button" class="tab-button rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-600" data-tab="pension">Pension</button>
            <button type="button" class="tab-button rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-600" data-tab="roster">Roster</button>
            <button type="button" class="tab-button rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-600" data-tab="documents">Documents</button>
            <button type="button" class="tab-button rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-600" data-tab="job-experience">Job Experience</button>
            <button type="button" class="tab-button rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-600" data-tab="academic">Academic Background</button>
        </div>

        <div id="basic-info" class="tab-panel active">
            <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">
                <div class="glass-card p-6 xl:col-span-2">
                    <div class="mb-5">
                        <h3 class="text-base font-semibold text-slate-800">Personal Information</h3>
                        <p class="text-xs text-slate-400">Overview of employee personal and employment details.</p>
                    </div>
                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Full Name</p>
                            <p class="mt-2 text-sm text-slate-700" data-employee-field="name">Cabdiraxmaan Cali</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Employee Number</p>
                            <p class="mt-2 text-sm text-slate-700" data-employee-field="employeeNumber">EMP-0001</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Gender</p>
                            <p class="mt-2 text-sm text-slate-700" data-employee-field="gender">Male</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Date Of Birth</p>
                            <p class="mt-2 text-sm text-slate-700" data-employee-field="dob">1992-04-18</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Phone Number</p>
                            <p class="mt-2 text-sm text-slate-700" data-employee-field="phone">+252 61 555 0101</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Email Address</p>
                            <p class="mt-2 text-sm text-slate-700" data-employee-field="email">cabdirahman.cali@hrms.local</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Department</p>
                            <p class="mt-2 text-sm text-slate-700" data-employee-field="department">Human Resource</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Branch</p>
                            <p class="mt-2 text-sm text-slate-700" data-employee-field="branch">Idaacada Branch</p>
                        </div>
                    </div>
                </div>

                <div class="glass-card p-6">
                    <div class="mb-5">
                        <h3 class="text-base font-semibold text-slate-800">Employment Summary</h3>
                        <p class="text-xs text-slate-400">Current job and contract snapshot.</p>
                    </div>
                    <div class="space-y-4">
                        <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4">
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Designation</p>
                            <p class="mt-2 text-sm font-semibold text-slate-700" data-employee-field="designation">Human Resource Director</p>
                        </div>
                        <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4">
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Join Date</p>
                            <p class="mt-2 text-sm font-semibold text-slate-700" data-employee-field="joinDate">2024-01-12</p>
                        </div>
                        <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4">
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Employment Type</p>
                            <p class="mt-2 text-sm font-semibold text-slate-700" data-employee-field="employmentType">Full Time</p>
                        </div>
                        <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4">
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Reporting Manager</p>
                            <p class="mt-2 text-sm font-semibold text-slate-700" data-employee-field="reportingManager">Asha Mohamed</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="attendance" class="tab-panel">
            <div class="space-y-6">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-5">
                    <div class="glass-card border border-slate-100 p-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Late Attendance</p>
                                <p class="mt-2 text-2xl font-semibold text-slate-800" data-attendance-metric="lateAttendance">00h 00m</p>
                            </div>
                            <div class="rounded-2xl bg-amber-50 p-3 text-amber-600">
                                <i class="fa-regular fa-clock text-lg"></i>
                            </div>
                        </div>
                        <p class="mt-3 text-xs text-slate-400">Total late time recorded this month.</p>
                    </div>

                    <div class="glass-card border border-slate-100 p-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Absenteeism</p>
                                <p class="mt-2 text-2xl font-semibold text-slate-800" data-attendance-metric="absenteeism">0 Days</p>
                            </div>
                            <div class="rounded-2xl bg-rose-50 p-3 text-rose-600">
                                <i class="fa-solid fa-user-xmark text-lg"></i>
                            </div>
                        </div>
                        <p class="mt-3 text-xs text-slate-400">Absent days logged in the current month.</p>
                    </div>

                    <div class="glass-card border border-slate-100 p-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Present</p>
                                <p class="mt-2 text-2xl font-semibold text-slate-800" data-attendance-metric="present">0 Days</p>
                            </div>
                            <div class="rounded-2xl bg-emerald-50 p-3 text-emerald-600">
                                <i class="fa-solid fa-user-check text-lg"></i>
                            </div>
                        </div>
                        <p class="mt-3 text-xs text-slate-400">On-time attendance entries this month.</p>
                    </div>

                    <div class="glass-card border border-slate-100 p-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Late Arrivals</p>
                                <p class="mt-2 text-2xl font-semibold text-slate-800" data-attendance-metric="lateArrivals">0 Times</p>
                            </div>
                            <div class="rounded-2xl bg-sky-50 p-3 text-sky-600">
                                <i class="fa-solid fa-business-time text-lg"></i>
                            </div>
                        </div>
                        <p class="mt-3 text-xs text-slate-400">Days where check-in was after the target time.</p>
                    </div>

                    <div class="glass-card border border-slate-100 p-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Attendance Rate</p>
                                <p class="mt-2 text-2xl font-semibold text-slate-800" data-attendance-metric="attendanceRate">0%</p>
                            </div>
                            <div class="rounded-2xl bg-indigo-50 p-3 text-indigo-600">
                                <i class="fa-solid fa-chart-line text-lg"></i>
                            </div>
                        </div>
                        <p class="mt-3 text-xs text-slate-400">Attendance score based on logged working days.</p>
                    </div>
                </div>

                <div class="glass-card p-6">
                    <div class="mb-5 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                        <div>
                            <h3 class="text-base font-semibold text-slate-800">Attendance History</h3>
                            <p class="text-xs text-slate-400">Track the employee attendance trend by day, week, or month.</p>
                        </div>

                        <select id="attendanceRangeFilter" class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-600 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                            <option value="daily">Daily</option>
                            <option value="weekly">Weekly</option>
                            <option value="monthly" selected>Monthly</option>
                        </select>
                    </div>

                    <div class="h-[320px]">
                        <canvas id="attendanceHistoryChart"></canvas>
                    </div>
                </div>

                <div class="glass-card p-6">
                    <div class="mb-5">
                        <h3 class="text-base font-semibold text-slate-800">Monthly Attendance Log</h3>
                        <p class="text-xs text-slate-400"><span id="attendanceLogMonthLabel">April 2026</span> attendance records including today.</p>
                    </div>

                    <div class="table-scroll overflow-x-auto">
                        <table class="min-w-full text-left">
                            <thead>
                                <tr class="border-b border-slate-100 text-[11px] uppercase tracking-wider text-slate-400">
                                    <th class="px-2 py-4 font-semibold">Date</th>
                                    <th class="px-2 py-4 font-semibold">Check In</th>
                                    <th class="px-2 py-4 font-semibold">Check Out</th>
                                    <th class="px-2 py-4 font-semibold">Work Hours</th>
                                    <th class="px-2 py-4 font-semibold">Late By</th>
                                    <th class="px-2 py-4 font-semibold">Status</th>
                                </tr>
                            </thead>
                            <tbody id="attendanceLogTableBody" class="divide-y divide-slate-50"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div id="warnings" class="tab-panel">
            <div class="space-y-6">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
                    <div class="glass-card border border-slate-100 p-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Total Warnings</p>
                                <p class="mt-2 text-2xl font-semibold text-slate-800" data-warning-metric="totalWarnings">0</p>
                            </div>
                            <div class="rounded-2xl bg-orange-50 p-3 text-orange-600">
                                <i class="fa-solid fa-triangle-exclamation text-lg"></i>
                            </div>
                        </div>
                        <p class="mt-3 text-xs text-slate-400">All warning records currently attached to this employee.</p>
                    </div>

                    <div class="glass-card border border-slate-100 p-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Attendance Issues</p>
                                <p class="mt-2 text-2xl font-semibold text-slate-800" data-warning-metric="attendanceIssues">0</p>
                            </div>
                            <div class="rounded-2xl bg-sky-50 p-3 text-sky-600">
                                <i class="fa-solid fa-user-clock text-lg"></i>
                            </div>
                        </div>
                        <p class="mt-3 text-xs text-slate-400">Warnings related to missing attendance or late reporting.</p>
                    </div>

                    <div class="glass-card border border-slate-100 p-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Low Performance</p>
                                <p class="mt-2 text-2xl font-semibold text-slate-800" data-warning-metric="performanceIssues">0</p>
                            </div>
                            <div class="rounded-2xl bg-violet-50 p-3 text-violet-600">
                                <i class="fa-solid fa-chart-line text-lg"></i>
                            </div>
                        </div>
                        <p class="mt-3 text-xs text-slate-400">Performance warnings requiring manager follow-up.</p>
                    </div>

                    <div class="glass-card border border-slate-100 p-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Rule Violations</p>
                                <p class="mt-2 text-2xl font-semibold text-slate-800" data-warning-metric="ruleViolations">0</p>
                            </div>
                            <div class="rounded-2xl bg-rose-50 p-3 text-rose-600">
                                <i class="fa-solid fa-scale-balanced text-lg"></i>
                            </div>
                        </div>
                        <p class="mt-3 text-xs text-slate-400">Company policy violations and disciplinary notices.</p>
                    </div>
                </div>

                <div class="glass-card p-6">
                    <div class="mb-5">
                        <h3 class="text-base font-semibold text-slate-800">Employee Warnings</h3>
                        <p class="text-xs text-slate-400">Warning history with letters sent to the employee and violation evidence.</p>
                    </div>
                    <div class="table-scroll overflow-x-auto">
                        <table class="min-w-full text-left">
                            <thead>
                                <tr class="border-b border-slate-100 text-[11px] uppercase tracking-wider text-slate-400">
                                    <th class="px-2 py-4 font-semibold">Date</th>
                                    <th class="px-2 py-4 font-semibold">Type</th>
                                    <th class="px-2 py-4 font-semibold">Warning</th>
                                    <th class="px-2 py-4 font-semibold">Issued By</th>
                                    <th class="px-2 py-4 font-semibold">Status</th>
                                    <th class="px-2 py-4 font-semibold">Action</th>
                                </tr>
                            </thead>
                            <tbody id="warningHistoryTableBody" class="divide-y divide-slate-50"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div id="leaves" class="tab-panel">
            <div class="space-y-6">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
                    <div class="glass-card border border-slate-100 p-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Leaves Left</p>
                                <p class="mt-2 text-2xl font-semibold text-slate-800" data-leave-metric="leavesLeft">0 Days</p>
                            </div>
                            <div class="rounded-2xl bg-emerald-50 p-3 text-emerald-600">
                                <i class="fa-solid fa-calendar-check text-lg"></i>
                            </div>
                        </div>
                        <p class="mt-3 text-xs text-slate-400">Current leave balance available to the employee.</p>
                    </div>

                    <div class="glass-card border border-slate-100 p-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Leaves Used</p>
                                <p class="mt-2 text-2xl font-semibold text-slate-800" data-leave-metric="leavesUsed">0 Days</p>
                            </div>
                            <div class="rounded-2xl bg-indigo-50 p-3 text-indigo-600">
                                <i class="fa-solid fa-calendar-minus text-lg"></i>
                            </div>
                        </div>
                        <p class="mt-3 text-xs text-slate-400">Approved leave days already taken this year.</p>
                    </div>

                    <div class="glass-card border border-slate-100 p-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Rejected Leaves</p>
                                <p class="mt-2 text-2xl font-semibold text-slate-800" data-leave-metric="rejectedLeaves">0 Requests</p>
                            </div>
                            <div class="rounded-2xl bg-rose-50 p-3 text-rose-600">
                                <i class="fa-solid fa-calendar-xmark text-lg"></i>
                            </div>
                        </div>
                        <p class="mt-3 text-xs text-slate-400">Requests that were declined by management.</p>
                    </div>

                    <div class="glass-card border border-slate-100 p-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Approved Leaves</p>
                                <p class="mt-2 text-2xl font-semibold text-slate-800" data-leave-metric="approvedLeaves">0 Requests</p>
                            </div>
                            <div class="rounded-2xl bg-sky-50 p-3 text-sky-600">
                                <i class="fa-solid fa-file-circle-check text-lg"></i>
                            </div>
                        </div>
                        <p class="mt-3 text-xs text-slate-400">Leave requests approved for this employee.</p>
                    </div>
                </div>

                <div class="glass-card p-6">
                    <div class="mb-5">
                        <h3 class="text-base font-semibold text-slate-800">Leave History</h3>
                        <p class="text-xs text-slate-400">Complete leave request list with access to supporting evidence.</p>
                    </div>
                    <div class="table-scroll overflow-x-auto">
                        <table class="min-w-full text-left">
                            <thead>
                                <tr class="border-b border-slate-100 text-[11px] uppercase tracking-wider text-slate-400">
                                    <th class="px-2 py-4 font-semibold">Leave Type</th>
                                    <th class="px-2 py-4 font-semibold">Applied On</th>
                                    <th class="px-2 py-4 font-semibold">Start Date</th>
                                    <th class="px-2 py-4 font-semibold">End Date</th>
                                    <th class="px-2 py-4 font-semibold">Days</th>
                                    <th class="px-2 py-4 font-semibold">Reason</th>
                                    <th class="px-2 py-4 font-semibold">Status</th>
                                    <th class="px-2 py-4 font-semibold">Action</th>
                                </tr>
                            </thead>
                            <tbody id="leaveHistoryTableBody" class="divide-y divide-slate-50"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div id="promotion" class="tab-panel">
            <div class="space-y-6">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">
                    <div class="glass-card border border-slate-100 p-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Total Promotions</p>
                                <p class="mt-2 text-2xl font-semibold text-slate-800" data-promotion-metric="promotionCount">0 Times</p>
                            </div>
                            <div class="rounded-2xl bg-indigo-50 p-3 text-indigo-600">
                                <i class="fa-solid fa-arrow-trend-up text-lg"></i>
                            </div>
                        </div>
                        <p class="mt-3 text-xs text-slate-400">Number of times the employee has been promoted.</p>
                    </div>

                    <div class="glass-card border border-slate-100 p-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Last Promotion Date</p>
                                <p class="mt-2 text-2xl font-semibold text-slate-800" data-promotion-metric="lastPromotionDate">--</p>
                            </div>
                            <div class="rounded-2xl bg-emerald-50 p-3 text-emerald-600">
                                <i class="fa-solid fa-calendar-check text-lg"></i>
                            </div>
                        </div>
                        <p class="mt-3 text-xs text-slate-400">Most recent approved promotion date on record.</p>
                    </div>

                    <div class="glass-card border border-slate-100 p-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Current Role</p>
                                <p class="mt-2 text-2xl font-semibold text-slate-800" data-promotion-metric="currentRole">--</p>
                            </div>
                            <div class="rounded-2xl bg-sky-50 p-3 text-sky-600">
                                <i class="fa-solid fa-user-tie text-lg"></i>
                            </div>
                        </div>
                        <p class="mt-3 text-xs text-slate-400">Employee's current role after promotion updates.</p>
                    </div>
                </div>

                <section class="promotion-glass-panel rounded-[2rem] p-8 md:p-12 shadow-2xl shadow-blue-500/5">
                    <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between mb-12">
                        <div>
                            <h2 class="text-3xl font-extrabold tracking-tight text-slate-900">Promotion History</h2>
                            <p class="mt-1 font-medium text-slate-500">Journey through employee role milestones</p>
                        </div>

                        <div class="flex items-center gap-3">
                            <button type="button" id="promotionPrevBtn" class="flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 bg-white shadow-sm transition-all hover:border-blue-400 hover:text-blue-600 disabled:cursor-not-allowed disabled:opacity-30">
                                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M15 18l-6-6 6-6"/></svg>
                            </button>
                            <button type="button" id="promotionNextBtn" class="flex h-10 w-10 items-center justify-center rounded-full bg-slate-900 text-white shadow-lg transition-all hover:bg-blue-600 disabled:cursor-not-allowed disabled:opacity-30">
                                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg>
                            </button>
                        </div>
                    </div>

                    <div class="mb-16 px-6">
                        <div class="promotion-timeline-track" id="promotionRail">
                            <div class="promotion-timeline-progress" id="promotionProgressFill"></div>
                        </div>
                    </div>

                    <div id="promotionDisplayArea" class="min-h-[200px]"></div>

                    <div class="mt-12 flex flex-wrap gap-8 border-t border-slate-100 pt-8">
                        <div class="flex flex-col">
                            <span class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Promotion Span</span>
                            <span class="text-xl font-bold text-slate-800" id="promotionStatTenure">0 Years</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Current Branch</span>
                            <span class="text-xl font-bold text-slate-800" id="promotionStatBranch">--</span>
                        </div>
                    </div>
                </section>

                <div class="glass-card p-6">
                    <div class="mb-5">
                        <h3 class="text-base font-semibold text-slate-800">Promotion Documents</h3>
                        <p class="text-xs text-slate-400">Promotion details and supporting documents for each employee promotion.</p>
                    </div>
                    <div class="table-scroll overflow-x-auto">
                        <table class="min-w-full text-left">
                            <thead>
                                <tr class="border-b border-slate-100 text-[11px] uppercase tracking-wider text-slate-400">
                                    <th class="px-2 py-4 font-semibold">Promotion Date</th>
                                    <th class="px-2 py-4 font-semibold">From Role</th>
                                    <th class="px-2 py-4 font-semibold">To Role</th>
                                    <th class="px-2 py-4 font-semibold">Department</th>
                                    <th class="px-2 py-4 font-semibold">Approved By</th>
                                    <th class="px-2 py-4 font-semibold">Action</th>
                                </tr>
                            </thead>
                            <tbody id="promotionHistoryTableBody" class="divide-y divide-slate-50"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div id="payroll" class="tab-panel">
            <div class="space-y-6">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">
                    <div class="glass-card border border-slate-100 p-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Base Salary</p>
                                <p class="mt-2 text-2xl font-semibold text-slate-800" data-payroll-metric="baseSalary">$0</p>
                            </div>
                            <div class="rounded-2xl bg-indigo-50 p-3 text-indigo-600">
                                <i class="fa-solid fa-sack-dollar text-lg"></i>
                            </div>
                        </div>
                        <p class="mt-3 text-xs text-slate-400">Current fixed salary amount for the employee.</p>
                    </div>

                    <div class="glass-card border border-slate-100 p-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Total Bonuses</p>
                                <p class="mt-2 text-2xl font-semibold text-slate-800" data-payroll-metric="totalBonuses">$0</p>
                            </div>
                            <div class="rounded-2xl bg-emerald-50 p-3 text-emerald-600">
                                <i class="fa-solid fa-coins text-lg"></i>
                            </div>
                        </div>
                        <p class="mt-3 text-xs text-slate-400">Total bonus value across listed payroll records.</p>
                    </div>

                    <div class="glass-card border border-slate-100 p-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Total Deductions</p>
                                <p class="mt-2 text-2xl font-semibold text-slate-800" data-payroll-metric="totalDeductions">$0</p>
                            </div>
                            <div class="rounded-2xl bg-rose-50 p-3 text-rose-600">
                                <i class="fa-solid fa-file-invoice-dollar text-lg"></i>
                            </div>
                        </div>
                        <p class="mt-3 text-xs text-slate-400">All deductions recorded in the payroll list below.</p>
                    </div>
                </div>

                <div class="glass-card p-6">
                    <div class="mb-5">
                        <h3 class="text-base font-semibold text-slate-800">Payroll Breakdown</h3>
                        <p class="text-xs text-slate-400">Visual split between base salary, bonuses, and deductions.</p>
                    </div>
                    <div class="mx-auto h-[320px] max-w-md">
                        <canvas id="payrollBreakdownChart"></canvas>
                    </div>
                </div>

                <div class="glass-card p-6">
                    <div class="mb-5">
                        <h3 class="text-base font-semibold text-slate-800">Payroll History</h3>
                        <p class="text-xs text-slate-400">Monthly payroll records with reference slip view.</p>
                    </div>
                    <div class="table-scroll overflow-x-auto">
                        <table class="min-w-full text-left">
                            <thead>
                                <tr class="border-b border-slate-100 text-[11px] uppercase tracking-wider text-slate-400">
                                    <th class="px-2 py-4 font-semibold">Payment Date</th>
                                    <th class="px-2 py-4 font-semibold">Month</th>
                                    <th class="px-2 py-4 font-semibold">Base Salary</th>
                                    <th class="px-2 py-4 font-semibold">Bonuses</th>
                                    <th class="px-2 py-4 font-semibold">Deductions</th>
                                    <th class="px-2 py-4 font-semibold">Net Pay</th>
                                    <th class="px-2 py-4 font-semibold">Action</th>
                                </tr>
                            </thead>
                            <tbody id="payrollHistoryTableBody" class="divide-y divide-slate-50"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div id="training" class="tab-panel">
            <div class="space-y-6">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-5">
                    <div class="glass-card border border-slate-100 p-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Trainings Completed</p>
                                <p class="mt-2 text-2xl font-semibold text-slate-800" data-training-metric="completed">0</p>
                            </div>
                            <div class="rounded-2xl bg-emerald-50 p-3 text-emerald-600">
                                <i class="fa-solid fa-graduation-cap text-lg"></i>
                            </div>
                        </div>
                        <p class="mt-3 text-xs text-slate-400">Training sessions completed by the employee.</p>
                    </div>

                    <div class="glass-card border border-slate-100 p-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Average Score</p>
                                <p class="mt-2 text-2xl font-semibold text-slate-800" data-training-metric="averageScore">0%</p>
                            </div>
                            <div class="rounded-2xl bg-indigo-50 p-3 text-indigo-600">
                                <i class="fa-solid fa-chart-simple text-lg"></i>
                            </div>
                        </div>
                        <p class="mt-3 text-xs text-slate-400">Average score across completed and graded trainings.</p>
                    </div>

                    <div class="glass-card border border-slate-100 p-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Passed</p>
                                <p class="mt-2 text-2xl font-semibold text-slate-800" data-training-metric="passed">0</p>
                            </div>
                            <div class="rounded-2xl bg-sky-50 p-3 text-sky-600">
                                <i class="fa-solid fa-circle-check text-lg"></i>
                            </div>
                        </div>
                        <p class="mt-3 text-xs text-slate-400">Trainings passed successfully by the employee.</p>
                    </div>

                    <div class="glass-card border border-slate-100 p-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Failed</p>
                                <p class="mt-2 text-2xl font-semibold text-slate-800" data-training-metric="failed">0</p>
                            </div>
                            <div class="rounded-2xl bg-rose-50 p-3 text-rose-600">
                                <i class="fa-solid fa-circle-xmark text-lg"></i>
                            </div>
                        </div>
                        <p class="mt-3 text-xs text-slate-400">Trainings marked as failed or not passed.</p>
                    </div>

                    <div class="glass-card border border-slate-100 p-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Ongoing</p>
                                <p class="mt-2 text-2xl font-semibold text-slate-800" data-training-metric="ongoing">0</p>
                            </div>
                            <div class="rounded-2xl bg-amber-50 p-3 text-amber-600">
                                <i class="fa-solid fa-spinner text-lg"></i>
                            </div>
                        </div>
                        <p class="mt-3 text-xs text-slate-400">Trainings still pending or currently ongoing.</p>
                    </div>
                </div>

                <div class="glass-card p-6">
                    <div class="mb-5">
                        <h3 class="text-base font-semibold text-slate-800">Training History</h3>
                        <p class="text-xs text-slate-400">Training list with provider, date, score, and completion status.</p>
                    </div>
                    <div class="table-scroll overflow-x-auto">
                        <table class="min-w-full text-left">
                            <thead>
                                <tr class="border-b border-slate-100 text-[11px] uppercase tracking-wider text-slate-400">
                                    <th class="px-2 py-4 font-semibold">Training</th>
                                    <th class="px-2 py-4 font-semibold">Provider</th>
                                    <th class="px-2 py-4 font-semibold">Date</th>
                                    <th class="px-2 py-4 font-semibold">Score</th>
                                    <th class="px-2 py-4 font-semibold">Status</th>
                                    <th class="px-2 py-4 font-semibold">Action</th>
                                </tr>
                            </thead>
                            <tbody id="trainingHistoryTableBody" class="divide-y divide-slate-50"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div id="pension" class="tab-panel">
            <div class="space-y-6">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
                    <div class="glass-card border border-slate-100 p-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Fund Balance</p>
                                <p class="mt-2 text-2xl font-semibold text-slate-800" data-pension-metric="fundBalance">$0</p>
                            </div>
                            <div class="rounded-2xl bg-indigo-50 p-3 text-indigo-600">
                                <i class="fa-solid fa-wallet text-lg"></i>
                            </div>
                        </div>
                        <p class="mt-3 text-xs text-slate-400">Current accumulated pension balance.</p>
                    </div>

                    <div class="glass-card border border-slate-100 p-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Employee Share</p>
                                <p class="mt-2 text-2xl font-semibold text-slate-800" data-pension-metric="employeeShare">$0</p>
                            </div>
                            <div class="rounded-2xl bg-emerald-50 p-3 text-emerald-600">
                                <i class="fa-solid fa-user-shield text-lg"></i>
                            </div>
                        </div>
                        <p class="mt-3 text-xs text-slate-400">Total contribution made by the employee.</p>
                    </div>

                    <div class="glass-card border border-slate-100 p-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Employer Share</p>
                                <p class="mt-2 text-2xl font-semibold text-slate-800" data-pension-metric="employerShare">$0</p>
                            </div>
                            <div class="rounded-2xl bg-sky-50 p-3 text-sky-600">
                                <i class="fa-solid fa-building-circle-check text-lg"></i>
                            </div>
                        </div>
                        <p class="mt-3 text-xs text-slate-400">Total contribution covered by the employer.</p>
                    </div>

                    <div class="glass-card border border-slate-100 p-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Vesting Status</p>
                                <p class="mt-2 text-2xl font-semibold text-slate-800" data-pension-metric="vestingStatus">--</p>
                            </div>
                            <div class="rounded-2xl bg-amber-50 p-3 text-amber-600">
                                <i class="fa-solid fa-badge-check text-lg"></i>
                            </div>
                        </div>
                        <p class="mt-3 text-xs text-slate-400">Current vesting stage of the pension plan.</p>
                    </div>
                </div>

                <div class="glass-card p-6">
                    <div class="mb-5">
                        <h3 class="text-base font-semibold text-slate-800">Beneficiaries</h3>
                        <p class="text-xs text-slate-400">Registered pension beneficiaries including spouse and children.</p>
                    </div>
                    <div id="pensionBeneficiariesGrid" class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3"></div>
                </div>

                <div class="glass-card p-6">
                    <div class="mb-5">
                        <h3 class="text-base font-semibold text-slate-800">Contribution History</h3>
                        <p class="text-xs text-slate-400">Monthly pension contribution history for the employee and employer.</p>
                    </div>
                    <div class="table-scroll overflow-x-auto">
                        <table class="min-w-full text-left">
                            <thead>
                                <tr class="border-b border-slate-100 text-[11px] uppercase tracking-wider text-slate-400">
                                    <th class="px-2 py-4 font-semibold">Month</th>
                                    <th class="px-2 py-4 font-semibold">Contribution Date</th>
                                    <th class="px-2 py-4 font-semibold">Employee Share</th>
                                    <th class="px-2 py-4 font-semibold">Employer Share</th>
                                    <th class="px-2 py-4 font-semibold">Total</th>
                                    <th class="px-2 py-4 font-semibold">Fund Balance</th>
                                </tr>
                            </thead>
                            <tbody id="pensionContributionTableBody" class="divide-y divide-slate-50"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div id="roster" class="tab-panel">
            <div class="space-y-6">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
                    <div class="glass-card border border-slate-100 p-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Current Shift</p>
                                <p class="mt-2 text-2xl font-semibold text-slate-800" data-roster-metric="currentShift">--</p>
                            </div>
                            <div class="rounded-2xl bg-indigo-50 p-3 text-indigo-600">
                                <i class="fa-solid fa-clock text-lg"></i>
                            </div>
                        </div>
                        <p class="mt-3 text-xs text-slate-400">Assigned shift currently active for this employee.</p>
                    </div>

                    <div class="glass-card border border-slate-100 p-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Current Status</p>
                                <p class="mt-2 text-2xl font-semibold text-slate-800" data-roster-metric="currentStatus">--</p>
                            </div>
                            <div class="rounded-2xl bg-emerald-50 p-3 text-emerald-600">
                                <i class="fa-solid fa-user-check text-lg"></i>
                            </div>
                        </div>
                        <p class="mt-3 text-xs text-slate-400">Live roster state based on the latest duty assignment.</p>
                    </div>

                    <div class="glass-card border border-slate-100 p-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Swap Request</p>
                                <p class="mt-2 text-2xl font-semibold text-slate-800" data-roster-metric="swapRequest">0</p>
                            </div>
                            <div class="rounded-2xl bg-amber-50 p-3 text-amber-600">
                                <i class="fa-solid fa-rotate text-lg"></i>
                            </div>
                        </div>
                        <p class="mt-3 text-xs text-slate-400">Total open or recent roster swap requests.</p>
                    </div>

                    <div class="glass-card border border-slate-100 p-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Assigned Group</p>
                                <p class="mt-2 text-2xl font-semibold text-slate-800" data-roster-metric="assignedGroup">--</p>
                            </div>
                            <div class="rounded-2xl bg-sky-50 p-3 text-sky-600">
                                <i class="fa-solid fa-users-line text-lg"></i>
                            </div>
                        </div>
                        <p class="mt-3 text-xs text-slate-400">Current duty team or rotation group assignment.</p>
                    </div>
                </div>

                <div class="glass-card p-6">
                    <div class="mb-5">
                        <h3 class="text-base font-semibold text-slate-800">Weekly Duty Roster</h3>
                        <p class="text-xs text-slate-400">Assigned weekly duty schedule for the employee.</p>
                    </div>
                    <div class="table-scroll overflow-x-auto">
                        <table class="min-w-full text-left">
                            <thead>
                                <tr class="border-b border-slate-100 text-[11px] uppercase tracking-wider text-slate-400">
                                    <th class="px-2 py-4 font-semibold">Day</th>
                                    <th class="px-2 py-4 font-semibold">Shift</th>
                                    <th class="px-2 py-4 font-semibold">Time</th>
                                    <th class="px-2 py-4 font-semibold">Location</th>
                                    <th class="px-2 py-4 font-semibold">Group</th>
                                    <th class="px-2 py-4 font-semibold">Status</th>
                                </tr>
                            </thead>
                            <tbody id="rosterWeeklyTableBody" class="divide-y divide-slate-50"></tbody>
                        </table>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">
                    <div class="glass-card p-6">
                        <div class="mb-5">
                            <h3 class="text-base font-semibold text-slate-800">Recent Duty Assignments</h3>
                            <p class="text-xs text-slate-400">Latest shifts and duty allocations assigned to the employee.</p>
                        </div>
                        <div id="rosterAssignmentsList" class="space-y-4"></div>
                    </div>

                    <div class="glass-card p-6">
                        <div class="mb-5">
                            <h3 class="text-base font-semibold text-slate-800">Swap Requests</h3>
                            <p class="text-xs text-slate-400">Recent submitted or reviewed shift swap requests.</p>
                        </div>
                        <div id="rosterSwapRequestsList" class="space-y-4"></div>
                    </div>
                </div>
            </div>
        </div>

        <div id="documents" class="tab-panel">
            <div class="space-y-6">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">
                    <div class="glass-card border border-slate-100 p-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Qualifications</p>
                                <p class="mt-2 text-2xl font-semibold text-slate-800" data-document-metric="qualifications">0</p>
                            </div>
                            <div class="rounded-2xl bg-indigo-50 p-3 text-indigo-600">
                                <i class="fa-solid fa-user-graduate text-lg"></i>
                            </div>
                        </div>
                        <p class="mt-3 text-xs text-slate-400">Academic and professional qualifications on file.</p>
                    </div>

                    <div class="glass-card border border-slate-100 p-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Certificates</p>
                                <p class="mt-2 text-2xl font-semibold text-slate-800" data-document-metric="certificates">0</p>
                            </div>
                            <div class="rounded-2xl bg-emerald-50 p-3 text-emerald-600">
                                <i class="fa-solid fa-certificate text-lg"></i>
                            </div>
                        </div>
                        <p class="mt-3 text-xs text-slate-400">Issued certificates and professional course evidence.</p>
                    </div>

                    <div class="glass-card border border-slate-100 p-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Identity Docs</p>
                                <p class="mt-2 text-2xl font-semibold text-slate-800" data-document-metric="identityDocs">0</p>
                            </div>
                            <div class="rounded-2xl bg-amber-50 p-3 text-amber-600">
                                <i class="fa-solid fa-id-card text-lg"></i>
                            </div>
                        </div>
                        <p class="mt-3 text-xs text-slate-400">Identity and compliance documents currently available.</p>
                    </div>
                </div>

                <div class="glass-card p-6">
                    <div class="mb-5">
                        <h3 class="text-base font-semibold text-slate-800">Documents & Qualifications</h3>
                        <p class="text-xs text-slate-400">Employee document register with sample document preview action.</p>
                    </div>
                    <div class="table-scroll overflow-x-auto">
                        <table class="min-w-full text-left">
                            <thead>
                                <tr class="border-b border-slate-100 text-[11px] uppercase tracking-wider text-slate-400">
                                    <th class="px-2 py-4 font-semibold">Type</th>
                                    <th class="px-2 py-4 font-semibold">Document</th>
                                    <th class="px-2 py-4 font-semibold">Category</th>
                                    <th class="px-2 py-4 font-semibold">Status</th>
                                    <th class="px-2 py-4 font-semibold">Updated</th>
                                    <th class="px-2 py-4 font-semibold">Action</th>
                                </tr>
                            </thead>
                            <tbody id="documentHistoryTableBody" class="divide-y divide-slate-50"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Job Experience Tab -->
        <div id="job-experience" class="tab-panel">
            <div class="space-y-6">
                <div class="glass-card p-6">
                    <div class="mb-5">
                        <h3 class="text-base font-semibold text-slate-800">Professional Skills</h3>
                        <p class="text-xs text-slate-400">Core competencies and technical expertise of the employee.</p>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <span class="rounded-full border border-indigo-100 bg-indigo-50 px-3 py-1.5 text-sm font-semibold text-indigo-700">HR Policy Development</span>
                        <span class="rounded-full border border-indigo-100 bg-indigo-50 px-3 py-1.5 text-sm font-semibold text-indigo-700">Talent Acquisition</span>
                        <span class="rounded-full border border-indigo-100 bg-indigo-50 px-3 py-1.5 text-sm font-semibold text-indigo-700">Performance Management</span>
                        <span class="rounded-full border border-emerald-100 bg-emerald-50 px-3 py-1.5 text-sm font-semibold text-emerald-700">Employee Relations</span>
                        <span class="rounded-full border border-emerald-100 bg-emerald-50 px-3 py-1.5 text-sm font-semibold text-emerald-700">Conflict Resolution</span>
                        <span class="rounded-full border border-sky-100 bg-sky-50 px-3 py-1.5 text-sm font-semibold text-sky-700">Payroll Administration</span>
                        <span class="rounded-full border border-sky-100 bg-sky-50 px-3 py-1.5 text-sm font-semibold text-sky-700">Labour Law Compliance</span>
                        <span class="rounded-full border border-amber-100 bg-amber-50 px-3 py-1.5 text-sm font-semibold text-amber-700">Staff Training</span>
                        <span class="rounded-full border border-amber-100 bg-amber-50 px-3 py-1.5 text-sm font-semibold text-amber-700">Organizational Development</span>
                        <span class="rounded-full border border-violet-100 bg-violet-50 px-3 py-1.5 text-sm font-semibold text-violet-700">HRMS Software</span>
                    </div>
                </div>

                <div class="glass-card p-6">
                    <div class="mb-6">
                        <h3 class="text-base font-semibold text-slate-800">Career Roadmap</h3>
                        <p class="text-xs text-slate-400">Previous organizations and roles held by the employee.</p>
                    </div>
                    <div class="relative">
                        <div class="absolute left-5 top-0 h-full w-0.5 bg-slate-100"></div>
                        <div class="space-y-8">
                            <div class="relative flex gap-5">
                                <div class="relative z-10 flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-indigo-600 text-white shadow-lg shadow-indigo-100">
                                    <i class="fa-solid fa-briefcase text-sm"></i>
                                </div>
                                <div class="flex-grow rounded-2xl border border-slate-100 bg-slate-50 p-5">
                                    <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
                                        <div>
                                            <p class="text-sm font-bold text-slate-800">Human Resource Director</p>
                                            <p class="text-xs font-medium text-indigo-600">HRMS Somaliland (Current)</p>
                                        </div>
                                        <span class="rounded-full bg-indigo-50 px-3 py-1 text-[11px] font-bold text-indigo-600">Jan 2024 &mdash; Present</span>
                                    </div>
                                    <p class="mt-3 text-xs text-slate-500">Overseeing all HR operations across Somaliland branches including recruitment, employee relations, payroll, and compliance with local labour standards.</p>
                                </div>
                            </div>
                            <div class="relative flex gap-5">
                                <div class="relative z-10 flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-emerald-500 text-white shadow-lg shadow-emerald-100">
                                    <i class="fa-solid fa-briefcase text-sm"></i>
                                </div>
                                <div class="flex-grow rounded-2xl border border-slate-100 bg-slate-50 p-5">
                                    <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
                                        <div>
                                            <p class="text-sm font-bold text-slate-800">Senior HR Officer</p>
                                            <p class="text-xs font-medium text-emerald-600">Somaliland Civil Service Commission</p>
                                        </div>
                                        <span class="rounded-full bg-emerald-50 px-3 py-1 text-[11px] font-bold text-emerald-600">Mar 2021 &mdash; Dec 2023</span>
                                    </div>
                                    <p class="mt-3 text-xs text-slate-500">Managed recruitment drives, policy documentation, staff welfare programs, and inter-departmental coordination for government ministry staffing needs.</p>
                                </div>
                            </div>
                            <div class="relative flex gap-5">
                                <div class="relative z-10 flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-amber-500 text-white shadow-lg shadow-amber-100">
                                    <i class="fa-solid fa-briefcase text-sm"></i>
                                </div>
                                <div class="flex-grow rounded-2xl border border-slate-100 bg-slate-50 p-5">
                                    <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
                                        <div>
                                            <p class="text-sm font-bold text-slate-800">HR Assistant</p>
                                            <p class="text-xs font-medium text-amber-600">Dahabshiil Group &mdash; Hargeisa</p>
                                        </div>
                                        <span class="rounded-full bg-amber-50 px-3 py-1 text-[11px] font-bold text-amber-600">Jun 2018 &mdash; Feb 2021</span>
                                    </div>
                                    <p class="mt-3 text-xs text-slate-500">Supported HR administration tasks including contract management, attendance tracking, employee records maintenance, and onboarding coordination.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Academic Background Tab -->
        <div id="academic" class="tab-panel">
            <div class="space-y-6">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                    <div class="glass-card border border-slate-100 p-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Degrees</p>
                                <p class="mt-2 text-2xl font-semibold text-slate-800">2</p>
                            </div>
                            <div class="rounded-2xl bg-indigo-50 p-3 text-indigo-600">
                                <i class="fa-solid fa-graduation-cap text-lg"></i>
                            </div>
                        </div>
                        <p class="mt-3 text-xs text-slate-400">Formal academic degrees on record.</p>
                    </div>
                    <div class="glass-card border border-slate-100 p-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Certificates</p>
                                <p class="mt-2 text-2xl font-semibold text-slate-800">3</p>
                            </div>
                            <div class="rounded-2xl bg-emerald-50 p-3 text-emerald-600">
                                <i class="fa-solid fa-certificate text-lg"></i>
                            </div>
                        </div>
                        <p class="mt-3 text-xs text-slate-400">Professional certificates earned.</p>
                    </div>
                    <div class="glass-card border border-slate-100 p-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Highest Level</p>
                                <p class="mt-2 text-lg font-semibold text-slate-800">Master's</p>
                            </div>
                            <div class="rounded-2xl bg-violet-50 p-3 text-violet-600">
                                <i class="fa-solid fa-user-graduate text-lg"></i>
                            </div>
                        </div>
                        <p class="mt-3 text-xs text-slate-400">Highest academic qualification attained.</p>
                    </div>
                </div>

                <div class="glass-card p-6">
                    <div class="mb-6">
                        <h3 class="text-base font-semibold text-slate-800">Education History</h3>
                        <p class="text-xs text-slate-400">Academic qualifications ordered from most recent.</p>
                    </div>
                    <div class="space-y-4">
                        <div class="flex gap-4 rounded-2xl border border-slate-100 bg-slate-50 p-5">
                            <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-2xl bg-indigo-600 text-white">
                                <i class="fa-solid fa-graduation-cap"></i>
                            </div>
                            <div class="flex-grow">
                                <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
                                    <p class="text-sm font-bold text-slate-800">Master of Business Administration (MBA)</p>
                                    <span class="rounded-full bg-indigo-50 px-3 py-1 text-[11px] font-bold text-indigo-600">2019 &mdash; 2021</span>
                                </div>
                                <p class="mt-1 text-xs font-medium text-indigo-600">University of Hargeisa &mdash; Hargeisa, Somaliland</p>
                                <p class="mt-2 text-xs text-slate-500">Major: Human Resource Management. GPA: 3.8/4.0. Thesis: Effective HR Practices in Developing Economies.</p>
                            </div>
                        </div>
                        <div class="flex gap-4 rounded-2xl border border-slate-100 bg-slate-50 p-5">
                            <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-2xl bg-emerald-500 text-white">
                                <i class="fa-solid fa-graduation-cap"></i>
                            </div>
                            <div class="flex-grow">
                                <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
                                    <p class="text-sm font-bold text-slate-800">Bachelor of Arts &mdash; Management Studies</p>
                                    <span class="rounded-full bg-emerald-50 px-3 py-1 text-[11px] font-bold text-emerald-600">2015 &mdash; 2018</span>
                                </div>
                                <p class="mt-1 text-xs font-medium text-emerald-600">Amoud University &mdash; Borama, Somaliland</p>
                                <p class="mt-2 text-xs text-slate-500">Focus: Organizational Behaviour and Public Administration. Graduated with Honours.</p>
                            </div>
                        </div>
                        <div class="flex gap-4 rounded-2xl border border-slate-100 bg-slate-50 p-5">
                            <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-2xl bg-amber-500 text-white">
                                <i class="fa-solid fa-certificate"></i>
                            </div>
                            <div class="flex-grow">
                                <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
                                    <p class="text-sm font-bold text-slate-800">Certificate in HR Leadership</p>
                                    <span class="rounded-full bg-amber-50 px-3 py-1 text-[11px] font-bold text-amber-600">2022</span>
                                </div>
                                <p class="mt-1 text-xs font-medium text-amber-600">Alpha Training Institute &mdash; Hargeisa, Somaliland</p>
                                <p class="mt-2 text-xs text-slate-500">6-month professional development course covering leadership, team dynamics, and advanced HR analytics.</p>
                            </div>
                        </div>
                        <div class="flex gap-4 rounded-2xl border border-slate-100 bg-slate-50 p-5">
                            <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-2xl bg-sky-500 text-white">
                                <i class="fa-solid fa-certificate"></i>
                            </div>
                            <div class="flex-grow">
                                <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
                                    <p class="text-sm font-bold text-slate-800">Certificate in Labour Law &amp; Compliance</p>
                                    <span class="rounded-full bg-sky-50 px-3 py-1 text-[11px] font-bold text-sky-600">2020</span>
                                </div>
                                <p class="mt-1 text-xs font-medium text-sky-600">Somaliland Business School &mdash; Hargeisa</p>
                                <p class="mt-2 text-xs text-slate-500">Covered Somaliland labour regulations, employee rights, contract law, and HR compliance frameworks.</p>
                            </div>
                        </div>
                        <div class="flex gap-4 rounded-2xl border border-slate-100 bg-slate-50 p-5">
                            <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-2xl bg-violet-500 text-white">
                                <i class="fa-solid fa-certificate"></i>
                            </div>
                            <div class="flex-grow">
                                <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
                                    <p class="text-sm font-bold text-slate-800">Certificate in HRMS &amp; Payroll Systems</p>
                                    <span class="rounded-full bg-violet-50 px-3 py-1 text-[11px] font-bold text-violet-600">2023</span>
                                </div>
                                <p class="mt-1 text-xs font-medium text-violet-600">TechBridge Academy &mdash; Hargeisa, Somaliland</p>
                                <p class="mt-2 text-xs text-slate-500">Practical training on digital HR management systems, payroll processing software, and data-driven workforce planning.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="warningDetailModal" class="fixed inset-0 z-[70] hidden items-center justify-center p-4">
        <div class="modal-backdrop absolute inset-0"></div>
        <div class="glass-card relative z-10 w-full max-w-3xl overflow-hidden">
            <div class="flex items-center justify-between border-b border-slate-100 px-6 py-5">
                <div>
                    <h3 class="text-lg font-semibold text-slate-800">Warning Details</h3>
                    <p class="text-xs text-slate-400" id="warningDetailSubtitle">Review warning documents and violation evidence.</p>
                </div>
                <button type="button" id="closeWarningDetailModal" class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-50 text-slate-500 transition hover:bg-slate-100 hover:text-slate-700">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="max-h-[80vh] overflow-y-auto p-6">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                    <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Warning Type</p>
                        <p class="mt-2 text-sm font-semibold text-slate-700" id="warningDetailType">--</p>
                    </div>
                    <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Issued Date</p>
                        <p class="mt-2 text-sm font-semibold text-slate-700" id="warningDetailDate">--</p>
                    </div>
                    <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Status</p>
                        <p class="mt-2 text-sm font-semibold text-slate-700" id="warningDetailStatus">--</p>
                    </div>
                </div>
                <div class="mt-4 rounded-2xl border border-slate-100 bg-slate-50 p-4">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Warning Note</p>
                    <p class="mt-2 text-sm text-slate-700" id="warningDetailNote">Warning details and HR decision.</p>
                </div>
                <div class="mt-4 grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Letters Sent</p>
                        <div id="warningDetailLetters" class="mt-3 space-y-3"></div>
                    </div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Evidence Files</p>
                        <div id="warningDetailEvidence" class="mt-3 space-y-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="leaveEvidenceModal" class="fixed inset-0 z-[70] hidden items-center justify-center p-4">
        <div class="modal-backdrop absolute inset-0"></div>
        <div class="glass-card relative z-10 w-full max-w-2xl overflow-hidden">
            <div class="flex items-center justify-between border-b border-slate-100 px-6 py-5">
                <div>
                    <h3 class="text-lg font-semibold text-slate-800">Leave Supporting Evidence</h3>
                    <p class="text-xs text-slate-400" id="leaveEvidenceSubtitle">Review the submitted evidence for this leave request.</p>
                </div>
                <button type="button" id="closeLeaveEvidenceModal" class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-50 text-slate-500 transition hover:bg-slate-100 hover:text-slate-700">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="max-h-[80vh] overflow-y-auto p-6">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Leave Type</p>
                        <p class="mt-2 text-sm font-semibold text-slate-700" id="leaveEvidenceType">Annual Leave</p>
                    </div>
                    <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Status</p>
                        <p class="mt-2 text-sm font-semibold text-slate-700" id="leaveEvidenceStatus">Approved</p>
                    </div>
                </div>
                <div class="mt-4 rounded-2xl border border-slate-100 bg-slate-50 p-4">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Evidence Note</p>
                    <p class="mt-2 text-sm text-slate-700" id="leaveEvidenceNote">Medical documents and supporting files attached by the employee.</p>
                </div>
                <div class="mt-4">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Attached Files</p>
                    <div id="leaveEvidenceFiles" class="mt-3 space-y-3"></div>
                </div>
            </div>
        </div>
    </div>

    <div id="promotionEvidenceModal" class="fixed inset-0 z-[70] hidden items-center justify-center p-4">
        <div class="modal-backdrop absolute inset-0"></div>
        <div class="glass-card relative z-10 w-full max-w-2xl overflow-hidden">
            <div class="flex items-center justify-between border-b border-slate-100 px-6 py-5">
                <div>
                    <h3 class="text-lg font-semibold text-slate-800">Promotion Supporting Documents</h3>
                    <p class="text-xs text-slate-400" id="promotionEvidenceSubtitle">Review supporting documents for the selected promotion.</p>
                </div>
                <button type="button" id="closePromotionEvidenceModal" class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-50 text-slate-500 transition hover:bg-slate-100 hover:text-slate-700">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="max-h-[80vh] overflow-y-auto p-6">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Promotion Date</p>
                        <p class="mt-2 text-sm font-semibold text-slate-700" id="promotionEvidenceDate">--</p>
                    </div>
                    <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Role Change</p>
                        <p class="mt-2 text-sm font-semibold text-slate-700" id="promotionEvidenceRole">--</p>
                    </div>
                </div>
                <div class="mt-4 rounded-2xl border border-slate-100 bg-slate-50 p-4">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Promotion Note</p>
                    <p class="mt-2 text-sm text-slate-700" id="promotionEvidenceNote">Promotion memo and supporting documents attached.</p>
                </div>
                <div class="mt-4">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Attached Files</p>
                    <div id="promotionEvidenceFiles" class="mt-3 space-y-3"></div>
                </div>
            </div>
        </div>
    </div>

    <div id="payrollSlipModal" class="fixed inset-0 z-[70] hidden items-center justify-center p-4">
        <div class="modal-backdrop absolute inset-0"></div>
        <div class="glass-card relative z-10 w-full max-w-2xl overflow-hidden">
            <div class="flex items-center justify-between border-b border-slate-100 px-6 py-5">
                <div>
                    <h3 class="text-lg font-semibold text-slate-800">Payment Slip</h3>
                    <p class="text-xs text-slate-400" id="payrollSlipSubtitle">Simple payroll reference information for the selected payment.</p>
                </div>
                <button type="button" id="closePayrollSlipModal" class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-50 text-slate-500 transition hover:bg-slate-100 hover:text-slate-700">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="max-h-[80vh] overflow-y-auto p-6">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Payment Date</p>
                        <p class="mt-2 text-sm font-semibold text-slate-700" id="payrollSlipDate">--</p>
                    </div>
                    <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Month</p>
                        <p class="mt-2 text-sm font-semibold text-slate-700" id="payrollSlipMonth">--</p>
                    </div>
                    <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Base Salary</p>
                        <p class="mt-2 text-sm font-semibold text-slate-700" id="payrollSlipBaseSalary">$0</p>
                    </div>
                    <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Net Pay</p>
                        <p class="mt-2 text-sm font-semibold text-slate-700" id="payrollSlipNetPay">$0</p>
                    </div>
                </div>
                <div class="mt-4 grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Bonuses</p>
                        <p class="mt-2 text-sm text-slate-700" id="payrollSlipBonuses">$0</p>
                    </div>
                    <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Deductions</p>
                        <p class="mt-2 text-sm text-slate-700" id="payrollSlipDeductions">$0</p>
                    </div>
                </div>
                <div class="mt-4 rounded-2xl border border-slate-100 bg-slate-50 p-4">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Reference Note</p>
                    <p class="mt-2 text-sm text-slate-700" id="payrollSlipNote">Payroll reference note and slip details.</p>
                </div>
                <div class="mt-4">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Attached References</p>
                    <div id="payrollSlipFiles" class="mt-3 space-y-3"></div>
                </div>
            </div>
        </div>
    </div>

    <div id="trainingDetailModal" class="fixed inset-0 z-[70] hidden items-center justify-center p-4">
        <div class="modal-backdrop absolute inset-0"></div>
        <div class="glass-card relative z-10 w-full max-w-2xl overflow-hidden">
            <div class="flex items-center justify-between border-b border-slate-100 px-6 py-5">
                <div>
                    <h3 class="text-lg font-semibold text-slate-800">Training Details</h3>
                    <p class="text-xs text-slate-400" id="trainingDetailSubtitle">Review certificate, progress, or failure reason for the selected training.</p>
                </div>
                <button type="button" id="closeTrainingDetailModal" class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-50 text-slate-500 transition hover:bg-slate-100 hover:text-slate-700">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="max-h-[80vh] overflow-y-auto p-6">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Training</p>
                        <p class="mt-2 text-sm font-semibold text-slate-700" id="trainingDetailName">--</p>
                    </div>
                    <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Status</p>
                        <p class="mt-2 text-sm font-semibold text-slate-700" id="trainingDetailStatus">--</p>
                    </div>
                </div>
                <div class="mt-4 rounded-2xl border border-slate-100 bg-slate-50 p-4">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400" id="trainingDetailSectionTitle">Details</p>
                    <p class="mt-2 text-sm text-slate-700" id="trainingDetailText">Training detail information.</p>
                </div>
                <div class="mt-4">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">References</p>
                    <div id="trainingDetailFiles" class="mt-3 space-y-3"></div>
                </div>
            </div>
        </div>
    </div>

    <div id="documentViewerModal" class="fixed inset-0 z-[70] hidden items-center justify-center p-4">
        <div class="modal-backdrop absolute inset-0"></div>
        <div class="glass-card relative z-10 w-full max-w-2xl overflow-hidden">
            <div class="flex items-center justify-between border-b border-slate-100 px-6 py-5">
                <div>
                    <h3 class="text-lg font-semibold text-slate-800">Sample Document</h3>
                    <p class="text-xs text-slate-400" id="documentViewerSubtitle">Preview metadata for the selected sample document.</p>
                </div>
                <button type="button" id="closeDocumentViewerModal" class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-50 text-slate-500 transition hover:bg-slate-100 hover:text-slate-700">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="max-h-[80vh] overflow-y-auto p-6">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Document</p>
                        <p class="mt-2 text-sm font-semibold text-slate-700" id="documentViewerName">--</p>
                    </div>
                    <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Status</p>
                        <p class="mt-2 text-sm font-semibold text-slate-700" id="documentViewerStatus">--</p>
                    </div>
                </div>
                <div class="mt-4 rounded-2xl border border-slate-100 bg-slate-50 p-4">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Sample Reference</p>
                    <p class="mt-2 text-sm text-slate-700" id="documentViewerText">Sample document details.</p>
                </div>
                <div class="mt-4">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Attached Sample File</p>
                    <div id="documentViewerFiles" class="mt-3 space-y-3"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const desktopSidebarBreakpoint = window.matchMedia('(min-width: 1024px)');
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabPanels = document.querySelectorAll('.tab-panel');
        const employeeFields = document.querySelectorAll('[data-employee-field]');
        const employeeAvatar = document.querySelector('[data-employee-image="avatar"]');
        const employeeStatus = document.querySelector('[data-employee-status]');
        const attendanceMetricFields = document.querySelectorAll('[data-attendance-metric]');
        const attendanceRangeFilter = document.getElementById('attendanceRangeFilter');
        const attendanceLogTableBody = document.getElementById('attendanceLogTableBody');
        const attendanceLogMonthLabel = document.getElementById('attendanceLogMonthLabel');
        const attendanceHistoryChartCanvas = document.getElementById('attendanceHistoryChart');
        const warningMetricFields = document.querySelectorAll('[data-warning-metric]');
        const warningHistoryTableBody = document.getElementById('warningHistoryTableBody');
        const warningDetailModal = document.getElementById('warningDetailModal');
        const closeWarningDetailModal = document.getElementById('closeWarningDetailModal');
        const warningDetailSubtitle = document.getElementById('warningDetailSubtitle');
        const warningDetailType = document.getElementById('warningDetailType');
        const warningDetailDate = document.getElementById('warningDetailDate');
        const warningDetailStatus = document.getElementById('warningDetailStatus');
        const warningDetailNote = document.getElementById('warningDetailNote');
        const warningDetailLetters = document.getElementById('warningDetailLetters');
        const warningDetailEvidence = document.getElementById('warningDetailEvidence');
        const leaveMetricFields = document.querySelectorAll('[data-leave-metric]');
        const leaveHistoryTableBody = document.getElementById('leaveHistoryTableBody');
        const leaveEvidenceModal = document.getElementById('leaveEvidenceModal');
        const closeLeaveEvidenceModal = document.getElementById('closeLeaveEvidenceModal');
        const leaveEvidenceSubtitle = document.getElementById('leaveEvidenceSubtitle');
        const leaveEvidenceType = document.getElementById('leaveEvidenceType');
        const leaveEvidenceStatus = document.getElementById('leaveEvidenceStatus');
        const leaveEvidenceNote = document.getElementById('leaveEvidenceNote');
        const leaveEvidenceFiles = document.getElementById('leaveEvidenceFiles');
        const promotionMetricFields = document.querySelectorAll('[data-promotion-metric]');
        const promotionRail = document.getElementById('promotionRail');
        const promotionDisplayArea = document.getElementById('promotionDisplayArea');
        const promotionPrevBtn = document.getElementById('promotionPrevBtn');
        const promotionNextBtn = document.getElementById('promotionNextBtn');
        const promotionStatTenure = document.getElementById('promotionStatTenure');
        const promotionStatBranch = document.getElementById('promotionStatBranch');
        const promotionHistoryTableBody = document.getElementById('promotionHistoryTableBody');
        const promotionEvidenceModal = document.getElementById('promotionEvidenceModal');
        const closePromotionEvidenceModal = document.getElementById('closePromotionEvidenceModal');
        const promotionEvidenceSubtitle = document.getElementById('promotionEvidenceSubtitle');
        const promotionEvidenceDate = document.getElementById('promotionEvidenceDate');
        const promotionEvidenceRole = document.getElementById('promotionEvidenceRole');
        const promotionEvidenceNote = document.getElementById('promotionEvidenceNote');
        const promotionEvidenceFiles = document.getElementById('promotionEvidenceFiles');
        const payrollMetricFields = document.querySelectorAll('[data-payroll-metric]');
        const payrollBreakdownChartCanvas = document.getElementById('payrollBreakdownChart');
        const payrollHistoryTableBody = document.getElementById('payrollHistoryTableBody');
        const payrollSlipModal = document.getElementById('payrollSlipModal');
        const closePayrollSlipModal = document.getElementById('closePayrollSlipModal');
        const payrollSlipSubtitle = document.getElementById('payrollSlipSubtitle');
        const payrollSlipDate = document.getElementById('payrollSlipDate');
        const payrollSlipMonth = document.getElementById('payrollSlipMonth');
        const payrollSlipBaseSalary = document.getElementById('payrollSlipBaseSalary');
        const payrollSlipNetPay = document.getElementById('payrollSlipNetPay');
        const payrollSlipBonuses = document.getElementById('payrollSlipBonuses');
        const payrollSlipDeductions = document.getElementById('payrollSlipDeductions');
        const payrollSlipNote = document.getElementById('payrollSlipNote');
        const payrollSlipFiles = document.getElementById('payrollSlipFiles');
        const trainingMetricFields = document.querySelectorAll('[data-training-metric]');
        const trainingHistoryTableBody = document.getElementById('trainingHistoryTableBody');
        const trainingDetailModal = document.getElementById('trainingDetailModal');
        const closeTrainingDetailModal = document.getElementById('closeTrainingDetailModal');
        const trainingDetailSubtitle = document.getElementById('trainingDetailSubtitle');
        const trainingDetailName = document.getElementById('trainingDetailName');
        const trainingDetailStatus = document.getElementById('trainingDetailStatus');
        const trainingDetailSectionTitle = document.getElementById('trainingDetailSectionTitle');
        const trainingDetailText = document.getElementById('trainingDetailText');
        const trainingDetailFiles = document.getElementById('trainingDetailFiles');
        const pensionMetricFields = document.querySelectorAll('[data-pension-metric]');
        const pensionBeneficiariesGrid = document.getElementById('pensionBeneficiariesGrid');
        const pensionContributionTableBody = document.getElementById('pensionContributionTableBody');
        const rosterMetricFields = document.querySelectorAll('[data-roster-metric]');
        const rosterWeeklyTableBody = document.getElementById('rosterWeeklyTableBody');
        const rosterAssignmentsList = document.getElementById('rosterAssignmentsList');
        const rosterSwapRequestsList = document.getElementById('rosterSwapRequestsList');
        const documentMetricFields = document.querySelectorAll('[data-document-metric]');
        const documentHistoryTableBody = document.getElementById('documentHistoryTableBody');
        const documentViewerModal = document.getElementById('documentViewerModal');
        const closeDocumentViewerModal = document.getElementById('closeDocumentViewerModal');
        const documentViewerSubtitle = document.getElementById('documentViewerSubtitle');
        const documentViewerName = document.getElementById('documentViewerName');
        const documentViewerStatus = document.getElementById('documentViewerStatus');
        const documentViewerText = document.getElementById('documentViewerText');
        const documentViewerFiles = document.getElementById('documentViewerFiles');
        let attendanceHistoryChart = null;
        let payrollBreakdownChart = null;
        let currentEmployeeNumber = 'EMP-0001';
        let currentAttendanceProfile = null;
        let currentWarningProfile = null;
        let currentLeaveProfile = null;
        let currentPromotionProfile = null;
        let currentPayrollProfile = null;
        let currentTrainingProfile = null;
        let currentPensionProfile = null;
        let currentRosterProfile = null;
        let currentDocumentProfile = null;
        let activePromotionStep = 0;

        const attendanceProfiles = {
            'EMP-0001': {
                monthlyTrend: [88, 91, 94, 96, 93, 95],
                monthLog: [
                    ['2026-04-24', '08:01 AM', '05:12 PM', '09h 11m', 'Present', 1],
                    ['2026-04-23', '08:18 AM', '05:05 PM', '08h 47m', 'Late', 18],
                    ['2026-04-22', '--', '--', '00h 00m', 'Absent', 0],
                    ['2026-04-21', '07:58 AM', '05:04 PM', '09h 06m', 'Present', 0],
                    ['2026-04-20', '08:07 AM', '05:01 PM', '08h 54m', 'Late', 7],
                    ['2026-04-17', '07:55 AM', '05:10 PM', '09h 15m', 'Present', 0],
                    ['2026-04-16', '08:00 AM', '05:00 PM', '09h 00m', 'Present', 0],
                    ['2026-04-15', '08:26 AM', '05:03 PM', '08h 37m', 'Late', 26],
                    ['2026-04-14', '07:57 AM', '05:08 PM', '09h 11m', 'Present', 0],
                    ['2026-04-13', '08:04 AM', '05:00 PM', '08h 56m', 'Late', 4],
                    ['2026-04-10', '07:54 AM', '05:06 PM', '09h 12m', 'Present', 0],
                    ['2026-04-09', '08:02 AM', '05:11 PM', '09h 09m', 'Present', 2]
                ]
            },
            'EMP-0002': {
                monthlyTrend: [84, 86, 88, 90, 87, 89],
                monthLog: [
                    ['2026-04-24', '08:12 AM', '05:08 PM', '08h 56m', 'Late', 12],
                    ['2026-04-23', '08:05 AM', '05:00 PM', '08h 55m', 'Late', 5],
                    ['2026-04-22', '07:59 AM', '05:04 PM', '09h 05m', 'Present', 0],
                    ['2026-04-21', '--', '--', '00h 00m', 'Absent', 0],
                    ['2026-04-20', '08:21 AM', '05:02 PM', '08h 41m', 'Late', 21],
                    ['2026-04-17', '08:03 AM', '05:06 PM', '09h 03m', 'Late', 3],
                    ['2026-04-16', '07:56 AM', '05:09 PM', '09h 13m', 'Present', 0],
                    ['2026-04-15', '08:09 AM', '05:01 PM', '08h 52m', 'Late', 9],
                    ['2026-04-14', '--', '--', '00h 00m', 'Absent', 0],
                    ['2026-04-13', '08:02 AM', '05:10 PM', '09h 08m', 'Present', 2],
                    ['2026-04-10', '07:58 AM', '05:04 PM', '09h 06m', 'Present', 0],
                    ['2026-04-09', '08:15 AM', '05:00 PM', '08h 45m', 'Late', 15]
                ]
            },
            'EMP-0003': {
                monthlyTrend: [90, 92, 93, 95, 94, 96],
                monthLog: [
                    ['2026-04-24', '07:53 AM', '05:14 PM', '09h 21m', 'Present', 0],
                    ['2026-04-23', '07:58 AM', '05:09 PM', '09h 11m', 'Present', 0],
                    ['2026-04-22', '08:10 AM', '05:00 PM', '08h 50m', 'Late', 10],
                    ['2026-04-21', '08:00 AM', '05:06 PM', '09h 06m', 'Present', 0],
                    ['2026-04-20', '07:57 AM', '05:03 PM', '09h 06m', 'Present', 0],
                    ['2026-04-17', '--', '--', '00h 00m', 'Absent', 0],
                    ['2026-04-16', '08:05 AM', '05:05 PM', '09h 00m', 'Late', 5],
                    ['2026-04-15', '07:55 AM', '05:08 PM', '09h 13m', 'Present', 0],
                    ['2026-04-14', '07:59 AM', '05:02 PM', '09h 03m', 'Present', 0],
                    ['2026-04-13', '08:06 AM', '05:00 PM', '08h 54m', 'Late', 6],
                    ['2026-04-10', '07:52 AM', '05:11 PM', '09h 19m', 'Present', 0],
                    ['2026-04-09', '07:56 AM', '05:07 PM', '09h 11m', 'Present', 0]
                ]
            },
            'EMP-0004': {
                monthlyTrend: [78, 81, 84, 86, 83, 85],
                monthLog: [
                    ['2026-04-24', '08:20 AM', '04:48 PM', '08h 28m', 'Late', 20],
                    ['2026-04-23', '--', '--', '00h 00m', 'Absent', 0],
                    ['2026-04-22', '08:14 AM', '04:57 PM', '08h 43m', 'Late', 14],
                    ['2026-04-21', '08:02 AM', '05:00 PM', '08h 58m', 'Late', 2],
                    ['2026-04-20', '07:59 AM', '05:02 PM', '09h 03m', 'Present', 0],
                    ['2026-04-17', '--', '--', '00h 00m', 'Absent', 0],
                    ['2026-04-16', '08:17 AM', '04:55 PM', '08h 38m', 'Late', 17],
                    ['2026-04-15', '08:06 AM', '05:01 PM', '08h 55m', 'Late', 6],
                    ['2026-04-14', '07:58 AM', '05:04 PM', '09h 06m', 'Present', 0],
                    ['2026-04-13', '08:09 AM', '04:59 PM', '08h 50m', 'Late', 9],
                    ['2026-04-10', '08:04 AM', '05:03 PM', '08h 59m', 'Late', 4],
                    ['2026-04-09', '07:57 AM', '05:06 PM', '09h 09m', 'Present', 0]
                ]
            }
        };

        const warningProfiles = {
            'EMP-0001': {
                records: [
                    {
                        date: '2026-04-22',
                        type: 'Missing Attendance',
                        title: 'Unexplained absence recorded',
                        issuedBy: 'Asha Mohamed',
                        status: 'Open',
                        note: 'Employee was marked absent without an approved leave request or supervisor exception. HR sent a first attendance warning and requested written explanation.',
                        letters: ['first-attendance-warning-letter.pdf', 'absence-explanation-request.pdf'],
                        evidence: ['attendance-log-2026-04-22.pdf', 'shift-roster-screenshot.png']
                    },
                    {
                        date: '2026-04-15',
                        type: 'Low Performance',
                        title: 'Monthly KPI score below threshold',
                        issuedBy: 'Asha Mohamed',
                        status: 'Monitoring',
                        note: 'Performance score fell below the department target for the review cycle. Employee is under a short improvement plan with weekly supervisor check-ins.',
                        letters: ['performance-improvement-notice.pdf'],
                        evidence: ['kpi-review-april.pdf', 'supervisor-review-note.pdf']
                    },
                    {
                        date: '2026-03-28',
                        type: 'Rule Violation',
                        title: 'Late submission of confidential files',
                        issuedBy: 'HR Compliance Office',
                        status: 'Closed',
                        note: 'Branch file submission was delayed after the compliance deadline. Warning was closed after employee acknowledged the policy and completed follow-up action.',
                        letters: ['policy-warning-letter.pdf', 'employee-acknowledgement.pdf'],
                        evidence: ['file-submission-audit.pdf', 'deadline-email-thread.pdf']
                    }
                ]
            },
            'EMP-0002': {
                records: [
                    {
                        date: '2026-04-21',
                        type: 'Missing Attendance',
                        title: 'Absent day without final approval',
                        issuedBy: 'Mohamed Yusuf',
                        status: 'Open',
                        note: 'Attendance register shows an absent day while the leave request was still pending. HR issued an attendance clarification warning.',
                        letters: ['attendance-clarification-warning.pdf'],
                        evidence: ['daily-attendance-register.pdf', 'pending-leave-request.pdf']
                    },
                    {
                        date: '2026-04-09',
                        type: 'Missing Attendance',
                        title: 'Repeated late arrival pattern',
                        issuedBy: 'Finance Manager',
                        status: 'Monitoring',
                        note: 'Several late arrivals were recorded during the payroll close period. Supervisor requested punctuality improvement for the next month.',
                        letters: ['late-arrival-warning.pdf'],
                        evidence: ['biometric-late-arrivals.pdf', 'payroll-close-roster.pdf']
                    }
                ]
            },
            'EMP-0003': {
                records: [
                    {
                        date: '2026-04-17',
                        type: 'Missing Attendance',
                        title: 'Missed field check-in',
                        issuedBy: 'Hodan Ali',
                        status: 'Closed',
                        note: 'Employee missed the field location check-in. Warning was closed after supervisor confirmed the supporting field report.',
                        letters: ['field-checkin-warning.pdf'],
                        evidence: ['field-roster.pdf', 'supervisor-confirmation.pdf']
                    }
                ]
            },
            'EMP-0004': {
                records: [
                    {
                        date: '2026-04-24',
                        type: 'Low Performance',
                        title: 'Campaign deliverables below target',
                        issuedBy: 'Ahmed Jama',
                        status: 'Open',
                        note: 'Campaign deliverables missed the expected weekly target. Employee received a performance warning and a corrective action schedule.',
                        letters: ['performance-warning-letter.pdf', 'corrective-action-plan.pdf'],
                        evidence: ['campaign-kpi-report.pdf', 'manager-review-summary.pdf']
                    },
                    {
                        date: '2026-04-23',
                        type: 'Missing Attendance',
                        title: 'Unapproved absence during campaign week',
                        issuedBy: 'Marketing Office',
                        status: 'Open',
                        note: 'Employee was absent during a scheduled campaign shift with no approved leave. HR attached roster and attendance evidence.',
                        letters: ['absence-warning-letter.pdf'],
                        evidence: ['campaign-roster.pdf', 'attendance-register.pdf']
                    },
                    {
                        date: '2026-04-16',
                        type: 'Rule Violation',
                        title: 'Missed approval workflow',
                        issuedBy: 'Branch Compliance',
                        status: 'Monitoring',
                        note: 'Campaign material was routed after the required approval step. Employee is being monitored for process compliance.',
                        letters: ['workflow-compliance-warning.pdf'],
                        evidence: ['approval-workflow-log.pdf', 'campaign-material-history.pdf']
                    }
                ]
            }
        };

        const leaveProfiles = {
            'EMP-0001': {
                leavesLeft: 18,
                leavesUsed: 12,
                records: [
                    ['Annual Leave', '2026-03-18', '2026-04-02', '2026-04-05', 4, 'Family visit in Berbera', 'Approved', 'Approved leave letter and travel ticket copy', ['travel-ticket.pdf', 'approval-letter.pdf']],
                    ['Sick Leave', '2026-02-07', '2026-02-08', '2026-02-09', 2, 'Seasonal flu recovery', 'Approved', 'Clinic note and pharmacy receipt submitted', ['clinic-note.pdf', 'pharmacy-receipt.jpg']],
                    ['Emergency Leave', '2026-01-11', '2026-01-12', '2026-01-12', 1, 'Urgent family matter', 'Approved', 'Supervisor acknowledgement attached', ['supervisor-note.pdf']],
                    ['Casual Leave', '2025-12-21', '2025-12-24', '2025-12-24', 1, 'Personal appointment', 'Rejected', 'Request rejected due to year-end staffing gap', ['rejection-comment.txt']]
                ]
            },
            'EMP-0002': {
                leavesLeft: 14,
                leavesUsed: 16,
                records: [
                    ['Annual Leave', '2026-04-01', '2026-04-14', '2026-04-18', 5, 'Quarter break with family', 'Approved', 'Approval email and leave plan attached', ['approval-email.pdf', 'leave-plan.xlsx']],
                    ['Sick Leave', '2026-03-09', '2026-03-10', '2026-03-11', 2, 'Migraine and rest recommendation', 'Approved', 'Medical consultation summary attached', ['medical-summary.pdf']],
                    ['Maternity Clinic', '2026-02-16', '2026-02-18', '2026-02-18', 1, 'Routine clinic follow-up', 'Pending', 'Appointment slip received and awaiting manager review', ['appointment-slip.jpg']],
                    ['Casual Leave', '2026-01-25', '2026-01-27', '2026-01-27', 1, 'Home maintenance emergency', 'Rejected', 'Supporting explanation reviewed but request declined', ['maintenance-request.pdf']]
                ]
            },
            'EMP-0003': {
                leavesLeft: 21,
                leavesUsed: 9,
                records: [
                    ['Annual Leave', '2026-03-03', '2026-03-20', '2026-03-22', 3, 'Short family holiday', 'Approved', 'Leave approval memo attached', ['approval-memo.pdf']],
                    ['Compassionate Leave', '2026-02-01', '2026-02-02', '2026-02-04', 3, 'Family bereavement', 'Approved', 'Community letter and supervisor note submitted', ['community-letter.pdf', 'supervisor-note.pdf']],
                    ['Sick Leave', '2026-01-14', '2026-01-15', '2026-01-15', 1, 'Dental procedure recovery', 'Approved', 'Dental clinic discharge note attached', ['dental-note.pdf']],
                    ['Casual Leave', '2025-12-10', '2025-12-12', '2025-12-12', 1, 'Personal errand', 'Rejected', 'Rejected because of operational handover timing', ['review-note.txt']]
                ]
            },
            'EMP-0004': {
                leavesLeft: 12,
                leavesUsed: 18,
                records: [
                    ['Annual Leave', '2026-04-05', '2026-04-28', '2026-04-30', 3, 'Family travel to Burao', 'Approved', 'Travel booking and branch approval attached', ['travel-booking.pdf', 'branch-approval.pdf']],
                    ['Sick Leave', '2026-03-01', '2026-03-04', '2026-03-05', 2, 'Back pain treatment', 'Approved', 'Doctor assessment and prescription provided', ['doctor-assessment.pdf', 'prescription.jpg']],
                    ['Study Leave', '2026-02-11', '2026-02-13', '2026-02-14', 2, 'Marketing certification exam', 'Pending', 'Exam registration and course letter submitted', ['exam-registration.pdf', 'course-letter.pdf']],
                    ['Casual Leave', '2026-01-08', '2026-01-09', '2026-01-09', 1, 'Personal day request', 'Rejected', 'Request declined because of campaign launch week', ['manager-comment.txt']]
                ]
            }
        };

        const promotionProfiles = {
            'EMP-0001': {
                currentRole: 'Human Resource Officer',
                branch: 'Idaacada Branch',
                promotions: [
                    {
                        year: '2021',
                        date: '2021-06-12',
                        fromRole: 'HR Assistant',
                        toRole: 'Senior HR Assistant',
                        department: 'Human Resource',
                        approvedBy: 'Asha Mohamed',
                        company: 'Idaacada Branch',
                        desc: 'Promoted after leading onboarding coordination and improving employee file processing turnaround.',
                        skills: ['Onboarding', 'Employee Files', 'HR Support'],
                        note: 'Promotion supported by HR performance review and staff service recommendation.',
                        files: ['hr-performance-review.pdf', 'service-recommendation.pdf']
                    },
                    {
                        year: '2023',
                        date: '2023-02-20',
                        fromRole: 'Senior HR Assistant',
                        toRole: 'HR Executive',
                        department: 'Human Resource',
                        approvedBy: 'Asha Mohamed',
                        company: 'Idaacada Branch',
                        desc: 'Moved into a broader HR execution role with responsibility for branch staffing coordination.',
                        skills: ['Recruitment', 'Reporting', 'Compliance'],
                        note: 'Included branch approval memo and internal competency assessment.',
                        files: ['branch-approval-memo.pdf', 'competency-assessment.pdf']
                    },
                    {
                        year: '2024',
                        date: '2024-09-03',
                        fromRole: 'HR Executive',
                        toRole: 'Human Resource Officer',
                        department: 'Human Resource',
                        approvedBy: 'Asha Mohamed',
                        company: 'Idaacada Branch',
                        desc: 'Promoted to current officer role after strong service delivery, policy follow-up, and cross-branch support.',
                        skills: ['Leadership', 'Policy Follow-up', 'Coordination'],
                        note: 'Supported by promotion letter, degree copy, and leadership certificate.',
                        files: ['promotion-letter.pdf', 'business-degree.pdf', 'leadership-certificate.pdf']
                    }
                ]
            },
            'EMP-0002': {
                currentRole: 'Finance Officer',
                branch: 'Xero Awr Branch',
                promotions: [
                    {
                        year: '2020',
                        date: '2020-04-18',
                        fromRole: 'Accounts Clerk',
                        toRole: 'Finance Assistant',
                        department: 'Finance',
                        approvedBy: 'Mohamed Yusuf',
                        company: 'Xero Awr Branch',
                        desc: 'Promoted after improving monthly reconciliation accuracy and vendor payment follow-up.',
                        skills: ['Reconciliation', 'Invoices', 'Reporting'],
                        note: 'Finance review summary and recommendation letter attached.',
                        files: ['finance-review-summary.pdf', 'recommendation-letter.pdf']
                    },
                    {
                        year: '2022',
                        date: '2022-11-09',
                        fromRole: 'Finance Assistant',
                        toRole: 'Senior Finance Assistant',
                        department: 'Finance',
                        approvedBy: 'Mohamed Yusuf',
                        company: 'Xero Awr Branch',
                        desc: 'Took ownership of branch petty cash oversight and reporting quality improvements.',
                        skills: ['Petty Cash', 'Audit Prep', 'Controls'],
                        note: 'Includes internal audit note and accounting certificate.',
                        files: ['internal-audit-note.pdf', 'accounting-certificate.pdf']
                    },
                    {
                        year: '2025',
                        date: '2025-08-27',
                        fromRole: 'Senior Finance Assistant',
                        toRole: 'Finance Officer',
                        department: 'Finance',
                        approvedBy: 'Mohamed Yusuf',
                        company: 'Xero Awr Branch',
                        desc: 'Promoted to lead branch finance operations after sustained strong accuracy and budget support.',
                        skills: ['Budgeting', 'Forecasting', 'Branch Finance'],
                        note: 'Promotion letter, finance diploma, and tax compliance certificate attached.',
                        files: ['promotion-letter.pdf', 'finance-diploma.pdf', 'tax-compliance-certificate.pdf']
                    }
                ]
            },
            'EMP-0003': {
                currentRole: 'Operations Supervisor',
                branch: 'Togdheer Branch',
                promotions: [
                    {
                        year: '2019',
                        date: '2019-03-11',
                        fromRole: 'Operations Assistant',
                        toRole: 'Operations Coordinator',
                        department: 'Operations',
                        approvedBy: 'Hodan Ali',
                        company: 'Togdheer Branch',
                        desc: 'Promoted after improving task dispatch coordination and daily operations reporting.',
                        skills: ['Coordination', 'Reporting', 'Scheduling'],
                        note: 'Attached recommendation and internal scorecard.',
                        files: ['recommendation.pdf', 'internal-scorecard.pdf']
                    },
                    {
                        year: '2021',
                        date: '2021-12-06',
                        fromRole: 'Operations Coordinator',
                        toRole: 'Senior Operations Coordinator',
                        department: 'Operations',
                        approvedBy: 'Hodan Ali',
                        company: 'Togdheer Branch',
                        desc: 'Recognized for process improvements that reduced daily operational delays.',
                        skills: ['Process Improvement', 'Field Ops', 'Team Support'],
                        note: 'Includes operations training certificate and branch memo.',
                        files: ['operations-training-certificate.pdf', 'branch-memo.pdf']
                    },
                    {
                        year: '2024',
                        date: '2024-06-14',
                        fromRole: 'Senior Operations Coordinator',
                        toRole: 'Operations Supervisor',
                        department: 'Operations',
                        approvedBy: 'Hodan Ali',
                        company: 'Togdheer Branch',
                        desc: 'Moved into current supervisory role to manage shift planning and operations quality control.',
                        skills: ['Supervision', 'Quality Control', 'Planning'],
                        note: 'Supported by promotion approval, degree, and supervisor certification.',
                        files: ['promotion-approval.pdf', 'operations-degree.pdf', 'supervisor-certification.pdf']
                    }
                ]
            },
            'EMP-0004': {
                currentRole: 'Marketing Coordinator',
                branch: 'Calaamada Branch',
                promotions: [
                    {
                        year: '2022',
                        date: '2022-05-10',
                        fromRole: 'Marketing Assistant',
                        toRole: 'Campaign Officer',
                        department: 'Marketing',
                        approvedBy: 'Ahmed Jama',
                        company: 'Calaamada Branch',
                        desc: 'Promoted after delivering several successful outreach campaigns and improving lead tracking.',
                        skills: ['Campaigns', 'Lead Tracking', 'Content'],
                        note: 'Includes campaign summary and certificate in digital media.',
                        files: ['campaign-summary.pdf', 'digital-media-certificate.pdf']
                    },
                    {
                        year: '2025',
                        date: '2025-01-29',
                        fromRole: 'Campaign Officer',
                        toRole: 'Marketing Coordinator',
                        department: 'Marketing',
                        approvedBy: 'Ahmed Jama',
                        company: 'Calaamada Branch',
                        desc: 'Promoted to current coordination role after showing strong planning and campaign execution capability.',
                        skills: ['Coordination', 'Branding', 'Execution'],
                        note: 'Promotion letter, media certificate, and portfolio review attached.',
                        files: ['promotion-letter.pdf', 'media-certificate.pdf', 'portfolio-review.pdf']
                    }
                ]
            }
        };

        const payrollProfiles = {
            'EMP-0001': {
                baseSalary: 350,
                records: [
                    ['2026-04-30', 'April 2026', 350, 25, 8, 'Payroll processed with punctuality bonus and light statutory deductions.', ['april-payslip.pdf', 'bank-transfer-reference.pdf']],
                    ['2026-03-31', 'March 2026', 350, 20, 7, 'Monthly salary cleared with HR performance bonus.', ['march-payslip.pdf']],
                    ['2026-02-28', 'February 2026', 350, 18, 6, 'Standard payroll run with branch allowance included.', ['february-payslip.pdf']],
                    ['2026-01-31', 'January 2026', 350, 15, 5, 'Opening year payroll with attendance-linked bonus.', ['january-payslip.pdf']]
                ]
            },
            'EMP-0002': {
                baseSalary: 350,
                records: [
                    ['2026-04-30', 'April 2026', 350, 25, 9, 'Finance branch payroll with budget closing bonus.', ['april-payslip.pdf', 'bonus-approval.pdf']],
                    ['2026-03-31', 'March 2026', 350, 22, 8, 'Regular payroll with finance reporting incentive.', ['march-payslip.pdf']],
                    ['2026-02-28', 'February 2026', 350, 24, 10, 'Payroll including quarterly reporting allowance.', ['february-payslip.pdf']],
                    ['2026-01-31', 'January 2026', 350, 18, 7, 'January payroll with normal deductions.', ['january-payslip.pdf']]
                ]
            },
            'EMP-0003': {
                baseSalary: 350,
                records: [
                    ['2026-04-30', 'April 2026', 350, 25, 10, 'Operations payroll with supervision performance bonus.', ['april-payslip.pdf', 'operations-bonus-note.pdf']],
                    ['2026-03-31', 'March 2026', 350, 23, 8, 'Monthly pay with field operations incentive.', ['march-payslip.pdf']],
                    ['2026-02-28', 'February 2026', 350, 20, 7, 'Payroll settled with supervisor duty allowance.', ['february-payslip.pdf']],
                    ['2026-01-31', 'January 2026', 350, 19, 6, 'January payroll with standard branch deductions.', ['january-payslip.pdf']]
                ]
            },
            'EMP-0004': {
                baseSalary: 350,
                records: [
                    ['2026-04-30', 'April 2026', 350, 25, 9, 'Marketing payroll with campaign completion bonus.', ['april-payslip.pdf', 'campaign-bonus-reference.pdf']],
                    ['2026-03-31', 'March 2026', 350, 21, 8, 'Payroll with outreach performance bonus.', ['march-payslip.pdf']],
                    ['2026-02-28', 'February 2026', 350, 20, 7, 'Monthly salary with design task bonus.', ['february-payslip.pdf']],
                    ['2026-01-31', 'January 2026', 350, 16, 6, 'January payroll with standard deductions.', ['january-payslip.pdf']]
                ]
            }
        };

        const trainingProfiles = {
            'EMP-0001': {
                records: [
                    ['Workplace Ethics & Compliance', 'HR Academy', '2026-02-10', 91, 'Passed', 'Certificate issued after successfully completing the ethics and compliance assessment.', ['ethics-certificate.pdf']],
                    ['Employee Records Management', 'Talent Hub', '2026-01-18', 88, 'Passed', 'Digital certificate and completion transcript available for this course.', ['records-management-certificate.pdf', 'completion-transcript.pdf']],
                    ['Conflict Resolution Basics', 'People First Institute', '2025-12-06', 54, 'Failed', 'Assessment score did not meet the 60% pass mark. Employee needs to retake the final scenario test.', ['failure-report.pdf']],
                    ['Leadership Development Workshop', 'HR Academy', '2026-05-06', null, 'Pending', 'Training is 65% complete. Final workshop presentation and assessment are still pending.', ['progress-report.pdf']]
                ]
            },
            'EMP-0002': {
                records: [
                    ['Financial Controls & Compliance', 'Finance Edge', '2026-02-15', 93, 'Passed', 'Certificate awarded for excellent performance in finance controls.', ['finance-controls-certificate.pdf']],
                    ['Budget Planning Workshop', 'Finance Edge', '2026-01-20', 89, 'Passed', 'Completion certificate and workshop summary are available.', ['budget-planning-certificate.pdf', 'workshop-summary.pdf']],
                    ['Advanced Excel for Finance', 'SkillBridge', '2025-12-11', 61, 'Passed', 'Course passed and certificate generated after final spreadsheet test.', ['advanced-excel-certificate.pdf']],
                    ['Tax Reporting Masterclass', 'SkillBridge', '2026-05-12', null, 'Pending', 'Training is 40% complete. Remaining modules cover filing workflow and tax reconciliation.', ['tax-masterclass-progress.pdf']]
                ]
            },
            'EMP-0003': {
                records: [
                    ['Operations Quality Control', 'Ops Academy', '2026-02-05', 95, 'Passed', 'Certificate of excellence issued for top score in quality control assessment.', ['quality-control-certificate.pdf']],
                    ['Shift Planning & Scheduling', 'Ops Academy', '2026-01-16', 84, 'Passed', 'Course certificate available with planning workshop attendance note.', ['shift-planning-certificate.pdf', 'attendance-note.pdf']],
                    ['Workplace Safety Review', 'Field Support Center', '2025-12-02', 48, 'Failed', 'Failed due to incomplete safety drill submission and low final quiz score.', ['safety-failure-note.pdf']],
                    ['Supervisor Leadership Program', 'Field Support Center', '2026-05-20', null, 'Pending', 'Program progress is at 55%. Coaching sessions are ongoing before final evaluation.', ['leadership-progress-update.pdf']]
                ]
            },
            'EMP-0004': {
                records: [
                    ['Campaign Planning Essentials', 'Creative Growth', '2026-02-12', 87, 'Passed', 'Certificate issued after successful campaign planning case study submission.', ['campaign-planning-certificate.pdf']],
                    ['Brand Communication Workshop', 'Creative Growth', '2026-01-25', 79, 'Passed', 'Workshop certificate and facilitator remarks are available.', ['brand-communication-certificate.pdf', 'facilitator-remarks.pdf']],
                    ['Digital Media Reporting', 'MediaLab', '2025-12-14', 52, 'Failed', 'Failed because the reporting dashboard exercise was incomplete and below passing threshold.', ['digital-media-failure-note.pdf']],
                    ['Creative Leadership Sprint', 'MediaLab', '2026-05-14', null, 'Pending', 'Sprint progress stands at 72%. Final project presentation remains outstanding.', ['creative-leadership-progress.pdf']]
                ]
            }
        };

        const pensionProfiles = {
            'EMP-0001': {
                vestingStatus: 'Fully Vested',
                beneficiaries: [
                    ['Amina Hassan', 'Wife', '40%'],
                    ['Ahmed Cabdiraxmaan', 'Son', '30%'],
                    ['Hibo Cabdiraxmaan', 'Daughter', '30%']
                ],
                contributionMonths: ['January 2026', 'February 2026', 'March 2026', 'April 2026'],
                openingBalance: 1662
            },
            'EMP-0002': {
                vestingStatus: 'Fully Vested',
                beneficiaries: [
                    ['Abdullahi Yusuf', 'Husband', '50%'],
                    ['Rooda Cabdilaahi', 'Daughter', '25%'],
                    ['Hamse Cabdilaahi', 'Son', '25%']
                ],
                contributionMonths: ['January 2026', 'February 2026', 'March 2026', 'April 2026'],
                openingBalance: 1534
            },
            'EMP-0003': {
                vestingStatus: 'Fully Vested',
                beneficiaries: [
                    ['Ugbaad Maxamed', 'Wife', '45%'],
                    ['Sakariye Mahad', 'Son', '30%'],
                    ['Raxma Mahad', 'Daughter', '25%']
                ],
                contributionMonths: ['January 2026', 'February 2026', 'March 2026', 'April 2026'],
                openingBalance: 1758
            },
            'EMP-0004': {
                vestingStatus: 'Partially Vested',
                beneficiaries: [
                    ['Mohamed Jama', 'Husband', '55%'],
                    ['Nimco Mohamed', 'Daughter', '25%'],
                    ['Leyla Mohamed', 'Daughter', '20%']
                ],
                contributionMonths: ['January 2026', 'February 2026', 'March 2026', 'April 2026'],
                openingBalance: 1310
            }
        };

        const rosterProfiles = {
            'EMP-0001': {
                currentShift: 'Morning Shift',
                currentStatus: 'On Duty',
                swapRequest: '1 Open',
                assignedGroup: 'Group A',
                weeklyRoster: [
                    ['Monday', 'Morning Shift', '08:00 AM - 04:00 PM', 'Idaacada Branch', 'Group A', 'Assigned'],
                    ['Tuesday', 'Morning Shift', '08:00 AM - 04:00 PM', 'Idaacada Branch', 'Group A', 'Assigned'],
                    ['Wednesday', 'Morning Shift', '08:00 AM - 04:00 PM', 'Idaacada Branch', 'Group A', 'Assigned'],
                    ['Thursday', 'Morning Shift', '08:00 AM - 04:00 PM', 'Idaacada Branch', 'Group A', 'Assigned'],
                    ['Friday', 'Half Day', '08:00 AM - 01:00 PM', 'Idaacada Branch', 'Group A', 'Assigned']
                ],
                assignments: [
                    ['2026-04-25', 'Morning Shift', 'Admissions Desk Coverage', 'Assigned by Asha Mohamed'],
                    ['2026-04-24', 'Morning Shift', 'Staff File Verification', 'Assigned by HR Office'],
                    ['2026-04-23', 'Morning Shift', 'Interview Panel Support', 'Assigned by Branch Admin']
                ],
                swaps: [
                    ['2026-04-24', 'Friday Morning Shift', 'Requested swap with Fadumo Xasan', 'Pending'],
                    ['2026-04-18', 'Wednesday Morning Shift', 'Swap approved with Mahad Axmed', 'Approved']
                ]
            },
            'EMP-0002': {
                currentShift: 'Mid Shift',
                currentStatus: 'Scheduled',
                swapRequest: '2 Open',
                assignedGroup: 'Group B',
                weeklyRoster: [
                    ['Monday', 'Mid Shift', '09:00 AM - 05:00 PM', 'Xero Awr Branch', 'Group B', 'Assigned'],
                    ['Tuesday', 'Mid Shift', '09:00 AM - 05:00 PM', 'Xero Awr Branch', 'Group B', 'Assigned'],
                    ['Wednesday', 'Mid Shift', '09:00 AM - 05:00 PM', 'Xero Awr Branch', 'Group B', 'Assigned'],
                    ['Thursday', 'Mid Shift', '09:00 AM - 05:00 PM', 'Xero Awr Branch', 'Group B', 'Assigned'],
                    ['Friday', 'Half Day', '09:00 AM - 01:30 PM', 'Xero Awr Branch', 'Group B', 'Assigned']
                ],
                assignments: [
                    ['2026-04-25', 'Mid Shift', 'Daily Cashbook Review', 'Assigned by Mohamed Yusuf'],
                    ['2026-04-24', 'Mid Shift', 'Vendor Payment Follow-up', 'Assigned by Finance Office'],
                    ['2026-04-23', 'Mid Shift', 'Monthly Report Preparation', 'Assigned by Branch Finance Lead']
                ],
                swaps: [
                    ['2026-04-25', 'Tuesday Mid Shift', 'Requested swap with Sahra Maxamed', 'Pending'],
                    ['2026-04-21', 'Thursday Mid Shift', 'Swap reviewed by branch manager', 'Pending']
                ]
            },
            'EMP-0003': {
                currentShift: 'Early Shift',
                currentStatus: 'Active',
                swapRequest: '0 Open',
                assignedGroup: 'Operations Team 1',
                weeklyRoster: [
                    ['Monday', 'Early Shift', '07:00 AM - 03:00 PM', 'Togdheer Branch', 'Operations Team 1', 'Assigned'],
                    ['Tuesday', 'Early Shift', '07:00 AM - 03:00 PM', 'Togdheer Branch', 'Operations Team 1', 'Assigned'],
                    ['Wednesday', 'Early Shift', '07:00 AM - 03:00 PM', 'Togdheer Branch', 'Operations Team 1', 'Assigned'],
                    ['Thursday', 'Early Shift', '07:00 AM - 03:00 PM', 'Togdheer Branch', 'Operations Team 1', 'Assigned'],
                    ['Friday', 'Half Day', '07:00 AM - 12:00 PM', 'Togdheer Branch', 'Operations Team 1', 'Assigned']
                ],
                assignments: [
                    ['2026-04-25', 'Early Shift', 'Field Operations Oversight', 'Assigned by Hodan Ali'],
                    ['2026-04-24', 'Early Shift', 'Warehouse Dispatch Coordination', 'Assigned by Ops Office'],
                    ['2026-04-23', 'Early Shift', 'Shift Briefing Lead', 'Assigned by Branch Operations']
                ],
                swaps: [
                    ['2026-04-19', 'Monday Early Shift', 'No swap request submitted this week', 'Closed'],
                    ['2026-04-10', 'Thursday Early Shift', 'Previous swap completed successfully', 'Approved']
                ]
            },
            'EMP-0004': {
                currentShift: 'Flexible Shift',
                currentStatus: 'Pending Confirmation',
                swapRequest: '1 Open',
                assignedGroup: 'Campaign Team',
                weeklyRoster: [
                    ['Monday', 'Flexible Shift', '10:00 AM - 06:00 PM', 'Calaamada Branch', 'Campaign Team', 'Assigned'],
                    ['Tuesday', 'Flexible Shift', '10:00 AM - 06:00 PM', 'Calaamada Branch', 'Campaign Team', 'Assigned'],
                    ['Wednesday', 'Flexible Shift', '10:00 AM - 06:00 PM', 'Calaamada Branch', 'Campaign Team', 'Assigned'],
                    ['Thursday', 'Flexible Shift', '10:00 AM - 06:00 PM', 'Calaamada Branch', 'Campaign Team', 'Assigned'],
                    ['Friday', 'Half Day', '10:00 AM - 02:00 PM', 'Calaamada Branch', 'Campaign Team', 'Assigned']
                ],
                assignments: [
                    ['2026-04-25', 'Flexible Shift', 'Campaign Planning Review', 'Assigned by Ahmed Jama'],
                    ['2026-04-24', 'Flexible Shift', 'Content Approval Follow-up', 'Assigned by Marketing Office'],
                    ['2026-04-23', 'Flexible Shift', 'Digital Reach Reporting', 'Assigned by Brand Team']
                ],
                swaps: [
                    ['2026-04-24', 'Wednesday Flexible Shift', 'Requested swap for external campaign meeting', 'Pending'],
                    ['2026-04-15', 'Monday Flexible Shift', 'Earlier swap approved by campaign lead', 'Approved']
                ]
            }
        };

        const documentProfiles = {
            'EMP-0001': {
                records: [
                    ['Qualification', 'Bachelor of Business Administration', 'Academic', 'Verified', '2026-04-12', 'Verified degree copy used for employee qualification record.', ['bba-degree.pdf']],
                    ['Certificate', 'HR Compliance Certificate', 'Professional', 'Verified', '2026-03-21', 'Sample certificate uploaded after compliance training completion.', ['hr-compliance-certificate.pdf']],
                    ['Identity Doc', 'National ID', 'Identity', 'Verified', '2026-01-18', 'National identity document on file for employee verification.', ['national-id-scan.pdf']],
                    ['Document', 'Employment Contract', 'Employment', 'Pending Review', '2026-02-05', 'Latest contract copy is pending final admin review.', ['employment-contract.pdf']]
                ]
            },
            'EMP-0002': {
                records: [
                    ['Qualification', 'Diploma in Accounting', 'Academic', 'Verified', '2026-04-10', 'Accounting diploma copy approved and recorded.', ['accounting-diploma.pdf']],
                    ['Certificate', 'Financial Controls Certificate', 'Professional', 'Verified', '2026-03-17', 'Finance controls training certificate attached.', ['financial-controls-certificate.pdf']],
                    ['Identity Doc', 'Passport Copy', 'Identity', 'Verified', '2026-01-25', 'Passport used as supporting identification.', ['passport-copy.pdf']],
                    ['Document', 'Tax Compliance File', 'Compliance', 'Pending Review', '2026-02-14', 'Tax compliance supporting file awaiting sign-off.', ['tax-compliance-file.pdf']]
                ]
            },
            'EMP-0003': {
                records: [
                    ['Qualification', 'Operations Management Degree', 'Academic', 'Verified', '2026-04-08', 'Operations degree document approved and archived.', ['operations-degree.pdf']],
                    ['Certificate', 'Supervisor Certification', 'Professional', 'Verified', '2026-03-12', 'Supervisor certification attached for promotion and personnel file.', ['supervisor-certification.pdf']],
                    ['Identity Doc', 'National ID', 'Identity', 'Verified', '2026-01-19', 'National ID record updated in employee file.', ['national-id.pdf']],
                    ['Document', 'Branch Assignment Letter', 'Employment', 'Verified', '2026-02-11', 'Branch assignment reference added to personnel documents.', ['branch-assignment-letter.pdf']]
                ]
            },
            'EMP-0004': {
                records: [
                    ['Qualification', 'Media Studies Degree', 'Academic', 'Verified', '2026-04-15', 'Media studies degree copy verified and uploaded.', ['media-studies-degree.pdf']],
                    ['Certificate', 'Digital Marketing Certificate', 'Professional', 'Verified', '2026-03-29', 'Digital marketing certificate stored in employee profile.', ['digital-marketing-certificate.pdf']],
                    ['Identity Doc', 'Passport Copy', 'Identity', 'Verified', '2026-01-22', 'Passport copy retained as identity evidence.', ['passport-scan.pdf']],
                    ['Document', 'Campaign Portfolio', 'Professional', 'Pending Review', '2026-02-18', 'Campaign portfolio submitted for review and classification.', ['campaign-portfolio.pdf']]
                ]
            }
        };

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

        function switchTab(targetTab) {
            tabButtons.forEach(button => {
                button.classList.toggle('active', button.dataset.tab === targetTab);
            });

            tabPanels.forEach(panel => {
                panel.classList.toggle('active', panel.id === targetTab);
            });

            if (targetTab === 'attendance') {
                renderAttendanceChart(currentAttendanceProfile || attendanceProfiles[currentEmployeeNumber]);
            }

            if (targetTab === 'payroll') {
                renderPayrollChart(currentPayrollProfile || payrollProfiles[currentEmployeeNumber]);
            }
        }

        function formatLateMinutes(totalMinutes) {
            if (!totalMinutes) {
                return '00h 00m';
            }

            const hours = Math.floor(totalMinutes / 60);
            const minutes = totalMinutes % 60;

            return `${String(hours).padStart(2, '0')}h ${String(minutes).padStart(2, '0')}m`;
        }

        function formatLateByMinutes(totalMinutes) {
            if (!totalMinutes) {
                return '--';
            }

            return `${totalMinutes} min`;
        }

        function getAttendanceStatusClass(status) {
            if (status === 'Late') {
                return 'status-late';
            }

            if (status === 'Absent') {
                return 'status-inactive';
            }

            return 'status-active';
        }

        function getLeaveStatusClass(status) {
            if (status === 'Approved') {
                return 'status-approved';
            }

            if (status === 'Rejected') {
                return 'status-rejected';
            }

            return 'status-pending';
        }

        function formatCurrency(amount) {
            return `$${Number(amount).toLocaleString('en-US')}`;
        }

        function getTrainingStatusClass(status) {
            if (status === 'Passed') {
                return 'status-approved';
            }

            if (status === 'Failed') {
                return 'status-rejected';
            }

            return 'status-pending';
        }

        function buildPromotionMetrics(profile) {
            const promotionCount = profile.promotions.length;
            const lastPromotion = profile.promotions[promotionCount - 1];

            return {
                promotionCount: `${promotionCount} Times`,
                lastPromotionDate: lastPromotion ? lastPromotion.date : '--',
                currentRole: profile.currentRole
            };
        }

        function getAttendanceScore(status) {
            if (status === 'Present') {
                return 100;
            }

            if (status === 'Late') {
                return 75;
            }

            return 0;
        }

        function getWeekLabelFromDate(dateString) {
            const dayOfMonth = Number(dateString.split('-')[2]);

            return `Week ${Math.floor((dayOfMonth - 1) / 7) + 1}`;
        }

        function buildAttendanceMetrics(monthLog) {
            const presentCount = monthLog.filter(entry => entry.status === 'Present').length;
            const lateCount = monthLog.filter(entry => entry.status === 'Late').length;
            const absentCount = monthLog.filter(entry => entry.status === 'Absent').length;
            const lateMinutes = monthLog.reduce((sum, entry) => sum + entry.lateMinutes, 0);
            const attendanceRate = monthLog.length ? Math.round(((presentCount + lateCount) / monthLog.length) * 100) : 0;

            return {
                lateAttendance: formatLateMinutes(lateMinutes),
                absenteeism: `${absentCount} Days`,
                present: `${presentCount} Days`,
                lateArrivals: `${lateCount} Times`,
                attendanceRate: `${attendanceRate}%`
            };
        }

        function buildAttendanceHistory(profile, range) {
            if (range === 'daily') {
                const dailyLog = [...profile.monthLog]
                    .slice(0, 7)
                    .reverse()
                    .map(entry => ({
                        label: entry.date.slice(5),
                        value: getAttendanceScore(entry.status)
                    }));

                return {
                    labels: dailyLog.map(entry => entry.label),
                    values: dailyLog.map(entry => entry.value)
                };
            }

            if (range === 'weekly') {
                const weeklyMap = {};

                [...profile.monthLog].reverse().forEach(entry => {
                    const weekLabel = getWeekLabelFromDate(entry.date);

                    if (!weeklyMap[weekLabel]) {
                        weeklyMap[weekLabel] = { attended: 0, total: 0 };
                    }

                    weeklyMap[weekLabel].total += 1;

                    if (entry.status !== 'Absent') {
                        weeklyMap[weekLabel].attended += 1;
                    }
                });

                const weekLabels = Object.keys(weeklyMap);

                return {
                    labels: weekLabels,
                    values: weekLabels.map(label => Math.round((weeklyMap[label].attended / weeklyMap[label].total) * 100))
                };
            }

            return {
                labels: ['Nov 2025', 'Dec 2025', 'Jan 2026', 'Feb 2026', 'Mar 2026', 'Apr 2026'],
                values: profile.monthlyTrend
            };
        }

        function renderAttendanceMetrics(profile) {
            const metrics = buildAttendanceMetrics(profile.monthLog.map(entry => ({
                date: entry[0],
                checkIn: entry[1],
                checkOut: entry[2],
                workHours: entry[3],
                status: entry[4],
                lateMinutes: entry[5]
            })));

            attendanceMetricFields.forEach(field => {
                const metricName = field.dataset.attendanceMetric;

                if (metrics[metricName]) {
                    field.textContent = metrics[metricName];
                }
            });
        }

        function renderAttendanceChart(profile) {
            if (!attendanceHistoryChartCanvas || typeof Chart === 'undefined') {
                return;
            }

            const selectedRange = attendanceRangeFilter ? attendanceRangeFilter.value : 'monthly';
            const historyData = buildAttendanceHistory(profile, selectedRange);

            if (attendanceHistoryChart) {
                attendanceHistoryChart.destroy();
            }

            attendanceHistoryChart = new Chart(attendanceHistoryChartCanvas, {
                type: 'line',
                data: {
                    labels: historyData.labels,
                    datasets: [{
                        label: 'Attendance %',
                        data: historyData.values,
                        fill: true,
                        borderColor: '#4f46e5',
                        backgroundColor: 'rgba(79, 70, 229, 0.12)',
                        borderWidth: 3,
                        tension: 0.35,
                        pointRadius: 4,
                        pointHoverRadius: 5,
                        pointBackgroundColor: '#4f46e5'
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
                        y: {
                            min: 0,
                            max: 100,
                            ticks: {
                                stepSize: 20,
                                callback: function (value) {
                                    return `${value}%`;
                                }
                            },
                            grid: {
                                color: 'rgba(226, 232, 240, 0.85)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        }

        function renderAttendanceLog(profile) {
            if (!attendanceLogTableBody) {
                return;
            }

            const monthLog = profile.monthLog.map(entry => ({
                date: entry[0],
                checkIn: entry[1],
                checkOut: entry[2],
                workHours: entry[3],
                status: entry[4],
                lateMinutes: entry[5]
            }));

            attendanceLogTableBody.innerHTML = monthLog.map(entry => `
                <tr>
                    <td class="px-2 py-4 text-sm text-slate-600">${entry.date}</td>
                    <td class="px-2 py-4 text-sm text-slate-600">${entry.checkIn}</td>
                    <td class="px-2 py-4 text-sm text-slate-600">${entry.checkOut}</td>
                    <td class="px-2 py-4 text-sm text-slate-600">${entry.workHours}</td>
                    <td class="px-2 py-4 text-sm text-slate-600">${formatLateByMinutes(entry.lateMinutes)}</td>
                    <td class="px-2 py-4"><span class="status-pill ${getAttendanceStatusClass(entry.status)}">${entry.status}</span></td>
                </tr>
            `).join('');

            if (attendanceLogMonthLabel && monthLog.length) {
                const [year, month] = monthLog[0].date.split('-');
                const monthName = new Date(Number(year), Number(month) - 1, 1).toLocaleString('en-US', {
                    month: 'long',
                    year: 'numeric'
                });

                attendanceLogMonthLabel.textContent = monthName;
            }
        }

        function renderAttendanceSection(employeeNumber) {
            currentEmployeeNumber = employeeNumber;
            currentAttendanceProfile = attendanceProfiles[employeeNumber] || attendanceProfiles['EMP-0001'];

            renderAttendanceMetrics(currentAttendanceProfile);
            renderAttendanceChart(currentAttendanceProfile);
            renderAttendanceLog(currentAttendanceProfile);
        }

        function getWarningStatusClass(status) {
            if (status === 'Open') {
                return 'status-critical';
            }

            if (status === 'Monitoring') {
                return 'status-monitoring';
            }

            return 'status-approved';
        }

        function buildWarningMetrics(profile) {
            return {
                totalWarnings: String(profile.records.length),
                attendanceIssues: String(profile.records.filter(record => record.type === 'Missing Attendance').length),
                performanceIssues: String(profile.records.filter(record => record.type === 'Low Performance').length),
                ruleViolations: String(profile.records.filter(record => record.type === 'Rule Violation').length)
            };
        }

        function renderWarningMetrics(profile) {
            const metrics = buildWarningMetrics(profile);

            warningMetricFields.forEach(field => {
                const metricName = field.dataset.warningMetric;

                if (metrics[metricName]) {
                    field.textContent = metrics[metricName];
                }
            });
        }

        function renderWarningHistory(profile) {
            if (!warningHistoryTableBody) {
                return;
            }

            warningHistoryTableBody.innerHTML = profile.records.map((record, index) => `
                <tr>
                    <td class="px-2 py-4 text-sm text-slate-600">${record.date}</td>
                    <td class="px-2 py-4 text-sm font-medium text-slate-700">${record.type}</td>
                    <td class="px-2 py-4 text-sm text-slate-600">${record.title}</td>
                    <td class="px-2 py-4 text-sm text-slate-600">${record.issuedBy}</td>
                    <td class="px-2 py-4"><span class="status-pill ${getWarningStatusClass(record.status)}">${record.status}</span></td>
                    <td class="px-2 py-4">
                        <button type="button" class="view-warning-detail inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-600 transition hover:bg-slate-50" data-warning-index="${index}">
                            <i class="fa-regular fa-eye text-[11px]"></i>
                            <span>View</span>
                        </button>
                    </td>
                </tr>
            `).join('');
        }

        function renderWarningFileList(files, helperText, iconClass) {
            return files.map(file => `
                <div class="rounded-2xl border border-slate-100 bg-slate-50 px-4 py-3 text-sm text-slate-700">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-orange-50 text-orange-600">
                            <i class="${iconClass}"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-700">${file}</p>
                            <p class="text-xs text-slate-400">${helperText}</p>
                        </div>
                    </div>
                </div>
            `).join('');
        }

        function showWarningDetail(index) {
            if (!currentWarningProfile || !currentWarningProfile.records[index] || !warningDetailModal) {
                return;
            }

            const record = currentWarningProfile.records[index];

            warningDetailSubtitle.textContent = `${record.title} issued by ${record.issuedBy}.`;
            warningDetailType.textContent = record.type;
            warningDetailDate.textContent = record.date;
            warningDetailStatus.textContent = record.status;
            warningDetailNote.textContent = record.note;
            warningDetailLetters.innerHTML = renderWarningFileList(record.letters, 'Letter sent to the employee.', 'fa-solid fa-envelope-open-text');
            warningDetailEvidence.innerHTML = renderWarningFileList(record.evidence, 'Evidence attached to this warning.', 'fa-solid fa-file-shield');

            warningDetailModal.classList.remove('hidden');
            warningDetailModal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
        }

        function hideWarningDetail() {
            if (!warningDetailModal) {
                return;
            }

            warningDetailModal.classList.add('hidden');
            warningDetailModal.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        }

        function renderWarningSection(employeeNumber) {
            currentWarningProfile = warningProfiles[employeeNumber] || warningProfiles['EMP-0001'];

            renderWarningMetrics(currentWarningProfile);
            renderWarningHistory(currentWarningProfile);
        }

        function buildLeaveMetrics(profile) {
            const approvedLeaves = profile.records.filter(record => record[6] === 'Approved').length;
            const rejectedLeaves = profile.records.filter(record => record[6] === 'Rejected').length;

            return {
                leavesLeft: `${profile.leavesLeft} Days`,
                leavesUsed: `${profile.leavesUsed} Days`,
                rejectedLeaves: `${rejectedLeaves} Requests`,
                approvedLeaves: `${approvedLeaves} Requests`
            };
        }

        function renderLeaveMetrics(profile) {
            const metrics = buildLeaveMetrics(profile);

            leaveMetricFields.forEach(field => {
                const metricName = field.dataset.leaveMetric;

                if (metrics[metricName]) {
                    field.textContent = metrics[metricName];
                }
            });
        }

        function renderLeaveHistory(profile) {
            if (!leaveHistoryTableBody) {
                return;
            }

            leaveHistoryTableBody.innerHTML = profile.records.map((record, index) => `
                <tr>
                    <td class="px-2 py-4 text-sm font-medium text-slate-700">${record[0]}</td>
                    <td class="px-2 py-4 text-sm text-slate-600">${record[1]}</td>
                    <td class="px-2 py-4 text-sm text-slate-600">${record[2]}</td>
                    <td class="px-2 py-4 text-sm text-slate-600">${record[3]}</td>
                    <td class="px-2 py-4 text-sm text-slate-600">${record[4]} Day${record[4] > 1 ? 's' : ''}</td>
                    <td class="px-2 py-4 text-sm text-slate-600">${record[5]}</td>
                    <td class="px-2 py-4"><span class="status-pill ${getLeaveStatusClass(record[6])}">${record[6]}</span></td>
                    <td class="px-2 py-4">
                        <button type="button" class="view-leave-evidence inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-600 transition hover:bg-slate-50" data-leave-index="${index}">
                            <i class="fa-regular fa-eye text-[11px]"></i>
                            <span>View Evidence</span>
                        </button>
                    </td>
                </tr>
            `).join('');
        }

        function showLeaveEvidence(index) {
            if (!currentLeaveProfile || !currentLeaveProfile.records[index] || !leaveEvidenceModal) {
                return;
            }

            const record = currentLeaveProfile.records[index];

            leaveEvidenceSubtitle.textContent = `${record[0]} evidence submitted on ${record[1]}.`;
            leaveEvidenceType.textContent = record[0];
            leaveEvidenceStatus.textContent = record[6];
            leaveEvidenceNote.textContent = record[7];
            leaveEvidenceFiles.innerHTML = record[8].map(file => `
                <div class="rounded-2xl border border-slate-100 bg-slate-50 px-4 py-3 text-sm text-slate-700">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600">
                            <i class="fa-solid fa-paperclip"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-700">${file}</p>
                            <p class="text-xs text-slate-400">Supporting file attached to this leave request.</p>
                        </div>
                    </div>
                </div>
            `).join('');

            leaveEvidenceModal.classList.remove('hidden');
            leaveEvidenceModal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
        }

        function hideLeaveEvidence() {
            if (!leaveEvidenceModal) {
                return;
            }

            leaveEvidenceModal.classList.add('hidden');
            leaveEvidenceModal.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        }

        function renderLeaveSection(employeeNumber) {
            currentLeaveProfile = leaveProfiles[employeeNumber] || leaveProfiles['EMP-0001'];

            renderLeaveMetrics(currentLeaveProfile);
            renderLeaveHistory(currentLeaveProfile);
        }

        function renderPromotionMetrics(profile) {
            const metrics = buildPromotionMetrics(profile);

            promotionMetricFields.forEach(field => {
                const metricName = field.dataset.promotionMetric;

                if (metrics[metricName]) {
                    field.textContent = metrics[metricName];
                }
            });
        }

        function syncPromotionProgress() {
            const promotionProgressElement = document.getElementById('promotionProgressFill');

            if (!currentPromotionProfile || !promotionProgressElement) {
                return;
            }

            const promotionCount = currentPromotionProfile.promotions.length;
            const progress = promotionCount > 1 ? (activePromotionStep / (promotionCount - 1)) * 100 : 0;

            promotionProgressElement.style.width = `${progress}%`;

            if (promotionStatTenure) {
                const firstDate = currentPromotionProfile.promotions[0]?.date;
                const lastDate = currentPromotionProfile.promotions[promotionCount - 1]?.date;

                if (firstDate && lastDate) {
                    promotionStatTenure.textContent = `${new Date(lastDate).getFullYear() - new Date(firstDate).getFullYear() + 1} Years`;
                } else {
                    promotionStatTenure.textContent = '0 Years';
                }
            }

            if (promotionStatBranch) {
                promotionStatBranch.textContent = currentPromotionProfile.branch;
            }

            if (promotionPrevBtn) {
                promotionPrevBtn.disabled = activePromotionStep === 0;
            }

            if (promotionNextBtn) {
                promotionNextBtn.disabled = activePromotionStep === promotionCount - 1;
            }
        }

        function jumpToPromotion(index) {
            activePromotionStep = index;
            renderPromotionTimeline();
        }

        function renderPromotionTimeline() {
            if (!currentPromotionProfile || !promotionRail || !promotionDisplayArea) {
                return;
            }

            promotionRail.innerHTML = '<div class="promotion-timeline-progress" id="promotionProgressFill"></div>';
            promotionDisplayArea.innerHTML = '';

            currentPromotionProfile.promotions.forEach((item, index) => {
                const node = document.createElement('div');
                node.className = `promotion-step-node ${index <= activePromotionStep ? 'active' : ''}`;
                node.innerHTML = `<span class="promotion-year-indicator">${item.year}</span>`;
                node.addEventListener('click', function () {
                    jumpToPromotion(index);
                });
                promotionRail.appendChild(node);

                const card = document.createElement('div');
                card.className = `promotion-content-card ${index === activePromotionStep ? 'active' : ''}`;
                card.innerHTML = `
                    <div class="grid gap-8 md:grid-cols-[1fr_220px]">
                        <div>
                            <div class="mb-2 inline-flex items-center gap-2">
                                <div class="h-2 w-2 rounded-full bg-blue-500"></div>
                                <span class="text-sm font-bold uppercase tracking-tight text-blue-600">${item.company}</span>
                            </div>
                            <p class="mb-2 text-sm font-semibold text-slate-500">${item.date}</p>
                            <h3 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-slate-900">${item.toRole}</h3>
                            <p class="mb-3 text-sm font-semibold text-slate-500">Promoted from ${item.fromRole}</p>
                            <p class="text-lg font-medium leading-relaxed text-slate-600">${item.desc}</p>
                        </div>
                        <div class="flex flex-wrap content-start items-start gap-2">
                            ${item.skills.map(skill => `<span class="promotion-skill-tag rounded-full px-3 py-1.5 text-xs font-bold tracking-wide">${skill}</span>`).join('')}
                        </div>
                    </div>
                `;
                promotionDisplayArea.appendChild(card);
            });

            syncPromotionProgress();
        }

        function renderPromotionHistoryTable(profile) {
            if (!promotionHistoryTableBody) {
                return;
            }

            promotionHistoryTableBody.innerHTML = profile.promotions.map((promotion, index) => `
                <tr>
                    <td class="px-2 py-4 text-sm text-slate-600">${promotion.date}</td>
                    <td class="px-2 py-4 text-sm text-slate-600">${promotion.fromRole}</td>
                    <td class="px-2 py-4 text-sm font-medium text-slate-700">${promotion.toRole}</td>
                    <td class="px-2 py-4 text-sm text-slate-600">${promotion.department}</td>
                    <td class="px-2 py-4 text-sm text-slate-600">${promotion.approvedBy}</td>
                    <td class="px-2 py-4">
                        <button type="button" class="view-promotion-evidence inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-600 transition hover:bg-slate-50" data-promotion-index="${index}">
                            <i class="fa-regular fa-eye text-[11px]"></i>
                            <span>View</span>
                        </button>
                    </td>
                </tr>
            `).join('');
        }

        function showPromotionEvidence(index) {
            if (!currentPromotionProfile || !currentPromotionProfile.promotions[index] || !promotionEvidenceModal) {
                return;
            }

            const promotion = currentPromotionProfile.promotions[index];

            promotionEvidenceSubtitle.textContent = `${promotion.toRole} promotion documents from ${promotion.date}.`;
            promotionEvidenceDate.textContent = promotion.date;
            promotionEvidenceRole.textContent = `${promotion.fromRole} to ${promotion.toRole}`;
            promotionEvidenceNote.textContent = promotion.note;
            promotionEvidenceFiles.innerHTML = promotion.files.map(file => `
                <div class="rounded-2xl border border-slate-100 bg-slate-50 px-4 py-3 text-sm text-slate-700">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600">
                            <i class="fa-solid fa-file-lines"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-700">${file}</p>
                            <p class="text-xs text-slate-400">Supporting promotion document.</p>
                        </div>
                    </div>
                </div>
            `).join('');

            promotionEvidenceModal.classList.remove('hidden');
            promotionEvidenceModal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
        }

        function hidePromotionEvidence() {
            if (!promotionEvidenceModal) {
                return;
            }

            promotionEvidenceModal.classList.add('hidden');
            promotionEvidenceModal.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        }

        function renderPromotionSection(employeeNumber) {
            currentPromotionProfile = promotionProfiles[employeeNumber] || promotionProfiles['EMP-0001'];
            activePromotionStep = currentPromotionProfile.promotions.length - 1;

            renderPromotionMetrics(currentPromotionProfile);
            renderPromotionTimeline();
            renderPromotionHistoryTable(currentPromotionProfile);
        }

        function buildPayrollMetrics(profile) {
            const totalBonuses = profile.records.reduce((sum, record) => sum + record[3], 0);
            const totalDeductions = profile.records.reduce((sum, record) => sum + record[4], 0);

            return {
                baseSalary: formatCurrency(profile.baseSalary),
                totalBonuses: formatCurrency(totalBonuses),
                totalDeductions: formatCurrency(totalDeductions)
            };
        }

        function renderPayrollMetrics(profile) {
            const metrics = buildPayrollMetrics(profile);

            payrollMetricFields.forEach(field => {
                const metricName = field.dataset.payrollMetric;

                if (metrics[metricName]) {
                    field.textContent = metrics[metricName];
                }
            });
        }

        function renderPayrollChart(profile) {
            if (!payrollBreakdownChartCanvas || typeof Chart === 'undefined') {
                return;
            }

            const totalBonuses = profile.records.reduce((sum, record) => sum + record[3], 0);
            const totalDeductions = profile.records.reduce((sum, record) => sum + record[4], 0);

            if (payrollBreakdownChart) {
                payrollBreakdownChart.destroy();
            }

            payrollBreakdownChart = new Chart(payrollBreakdownChartCanvas, {
                type: 'doughnut',
                data: {
                    labels: ['Base Salary', 'Bonuses', 'Deductions'],
                    datasets: [{
                        data: [profile.baseSalary, totalBonuses, totalDeductions],
                        backgroundColor: ['#4f46e5', '#10b981', '#ef4444'],
                        borderColor: ['#ffffff', '#ffffff', '#ffffff'],
                        borderWidth: 4,
                        hoverOffset: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '64%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                boxWidth: 12,
                                color: '#475569',
                                font: {
                                    size: 12,
                                    weight: '600'
                                }
                            }
                        }
                    }
                }
            });
        }

        function renderPayrollHistory(profile) {
            if (!payrollHistoryTableBody) {
                return;
            }

            payrollHistoryTableBody.innerHTML = profile.records.map((record, index) => {
                const netPay = record[2] + record[3] - record[4];

                return `
                    <tr>
                        <td class="px-2 py-4 text-sm text-slate-600">${record[0]}</td>
                        <td class="px-2 py-4 text-sm text-slate-600">${record[1]}</td>
                        <td class="px-2 py-4 text-sm font-medium text-slate-700">${formatCurrency(record[2])}</td>
                        <td class="px-2 py-4 text-sm text-slate-600">${formatCurrency(record[3])}</td>
                        <td class="px-2 py-4 text-sm text-slate-600">${formatCurrency(record[4])}</td>
                        <td class="px-2 py-4 text-sm text-slate-600">${formatCurrency(netPay)}</td>
                        <td class="px-2 py-4">
                            <button type="button" class="view-payroll-slip inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-600 transition hover:bg-slate-50" data-payroll-index="${index}">
                                <i class="fa-regular fa-eye text-[11px]"></i>
                                <span>View</span>
                            </button>
                        </td>
                    </tr>
                `;
            }).join('');
        }

        function showPayrollSlip(index) {
            if (!currentPayrollProfile || !currentPayrollProfile.records[index] || !payrollSlipModal) {
                return;
            }

            const record = currentPayrollProfile.records[index];
            const netPay = record[2] + record[3] - record[4];

            payrollSlipSubtitle.textContent = `${record[1]} payroll reference details.`;
            payrollSlipDate.textContent = record[0];
            payrollSlipMonth.textContent = record[1];
            payrollSlipBaseSalary.textContent = formatCurrency(record[2]);
            payrollSlipNetPay.textContent = formatCurrency(netPay);
            payrollSlipBonuses.textContent = formatCurrency(record[3]);
            payrollSlipDeductions.textContent = formatCurrency(record[4]);
            payrollSlipNote.textContent = record[5];
            payrollSlipFiles.innerHTML = record[6].map(file => `
                <div class="rounded-2xl border border-slate-100 bg-slate-50 px-4 py-3 text-sm text-slate-700">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600">
                            <i class="fa-solid fa-receipt"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-700">${file}</p>
                            <p class="text-xs text-slate-400">Reference file attached to this payroll entry.</p>
                        </div>
                    </div>
                </div>
            `).join('');

            payrollSlipModal.classList.remove('hidden');
            payrollSlipModal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
        }

        function hidePayrollSlip() {
            if (!payrollSlipModal) {
                return;
            }

            payrollSlipModal.classList.add('hidden');
            payrollSlipModal.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        }

        function renderPayrollSection(employeeNumber) {
            currentPayrollProfile = payrollProfiles[employeeNumber] || payrollProfiles['EMP-0001'];

            renderPayrollMetrics(currentPayrollProfile);
            renderPayrollChart(currentPayrollProfile);
            renderPayrollHistory(currentPayrollProfile);
        }

        function buildTrainingMetrics(profile) {
            const completedRecords = profile.records.filter(record => record[4] !== 'Pending');
            const passedCount = profile.records.filter(record => record[4] === 'Passed').length;
            const failedCount = profile.records.filter(record => record[4] === 'Failed').length;
            const ongoingCount = profile.records.filter(record => record[4] === 'Pending').length;
            const scoredRecords = profile.records.filter(record => record[3] !== null);
            const averageScore = scoredRecords.length
                ? Math.round(scoredRecords.reduce((sum, record) => sum + record[3], 0) / scoredRecords.length)
                : 0;

            return {
                completed: String(completedRecords.length),
                averageScore: `${averageScore}%`,
                passed: String(passedCount),
                failed: String(failedCount),
                ongoing: String(ongoingCount)
            };
        }

        function renderTrainingMetrics(profile) {
            const metrics = buildTrainingMetrics(profile);

            trainingMetricFields.forEach(field => {
                const metricName = field.dataset.trainingMetric;

                if (metrics[metricName]) {
                    field.textContent = metrics[metricName];
                }
            });
        }

        function renderTrainingHistory(profile) {
            if (!trainingHistoryTableBody) {
                return;
            }

            trainingHistoryTableBody.innerHTML = profile.records.map((record, index) => `
                <tr>
                    <td class="px-2 py-4 text-sm font-medium text-slate-700">${record[0]}</td>
                    <td class="px-2 py-4 text-sm text-slate-600">${record[1]}</td>
                    <td class="px-2 py-4 text-sm text-slate-600">${record[2]}</td>
                    <td class="px-2 py-4 text-sm text-slate-600">${record[3] === null ? '--' : `${record[3]}%`}</td>
                    <td class="px-2 py-4"><span class="status-pill ${getTrainingStatusClass(record[4])}">${record[4]}</span></td>
                    <td class="px-2 py-4">
                        <button type="button" class="view-training-detail inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-600 transition hover:bg-slate-50" data-training-index="${index}">
                            <i class="fa-regular fa-eye text-[11px]"></i>
                            <span>View</span>
                        </button>
                    </td>
                </tr>
            `).join('');
        }

        function showTrainingDetail(index) {
            if (!currentTrainingProfile || !currentTrainingProfile.records[index] || !trainingDetailModal) {
                return;
            }

            const record = currentTrainingProfile.records[index];
            let sectionTitle = 'Details';

            if (record[4] === 'Passed') {
                sectionTitle = 'Certificate';
            } else if (record[4] === 'Pending') {
                sectionTitle = 'Progress';
            } else if (record[4] === 'Failed') {
                sectionTitle = 'Failure Reason';
            }

            trainingDetailSubtitle.textContent = `${record[0]} details from ${record[2]}.`;
            trainingDetailName.textContent = record[0];
            trainingDetailStatus.textContent = record[4];
            trainingDetailSectionTitle.textContent = sectionTitle;
            trainingDetailText.textContent = record[5];
            trainingDetailFiles.innerHTML = record[6].map(file => `
                <div class="rounded-2xl border border-slate-100 bg-slate-50 px-4 py-3 text-sm text-slate-700">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600">
                            <i class="fa-solid fa-file-lines"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-700">${file}</p>
                            <p class="text-xs text-slate-400">Training reference document.</p>
                        </div>
                    </div>
                </div>
            `).join('');

            trainingDetailModal.classList.remove('hidden');
            trainingDetailModal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
        }

        function hideTrainingDetail() {
            if (!trainingDetailModal) {
                return;
            }

            trainingDetailModal.classList.add('hidden');
            trainingDetailModal.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        }

        function renderTrainingSection(employeeNumber) {
            currentTrainingProfile = trainingProfiles[employeeNumber] || trainingProfiles['EMP-0001'];

            renderTrainingMetrics(currentTrainingProfile);
            renderTrainingHistory(currentTrainingProfile);
        }

        function buildPensionMetrics(profile) {
            return {
                fundBalance: formatCurrency(profile.fundBalance),
                employeeShare: formatCurrency(profile.employeeShare),
                employerShare: formatCurrency(profile.employerShare),
                vestingStatus: profile.vestingStatus
            };
        }

        function buildPensionProfile(employeeNumber) {
            const pensionProfile = pensionProfiles[employeeNumber] || pensionProfiles['EMP-0001'];
            const payrollProfile = payrollProfiles[employeeNumber] || payrollProfiles['EMP-0001'];
            const baseSalary = payrollProfile.baseSalary;
            const employeeMonthlyShare = Math.round(baseSalary * 0.05);
            const employerMonthlyShare = Math.round(baseSalary * 0.07);
            const employeeShare = employeeMonthlyShare * pensionProfile.contributionMonths.length;
            const employerShare = employerMonthlyShare * pensionProfile.contributionMonths.length;
            let runningBalance = pensionProfile.openingBalance;

            const contributions = pensionProfile.contributionMonths.map(monthLabel => {
                const contributionDate = new Date(`${monthLabel} 01`);
                const contributionYear = contributionDate.getFullYear();
                const contributionMonth = String(contributionDate.getMonth() + 1).padStart(2, '0');
                const contributionDay = new Date(contributionYear, contributionDate.getMonth() + 1, 0).getDate();
                const total = employeeMonthlyShare + employerMonthlyShare;

                runningBalance += total;

                return [
                    monthLabel,
                    `${contributionYear}-${contributionMonth}-${String(contributionDay).padStart(2, '0')}`,
                    employeeMonthlyShare,
                    employerMonthlyShare,
                    total,
                    runningBalance
                ];
            });

            return {
                vestingStatus: pensionProfile.vestingStatus,
                beneficiaries: pensionProfile.beneficiaries,
                employeeShare,
                employerShare,
                fundBalance: runningBalance,
                contributions
            };
        }

        function renderPensionMetrics(profile) {
            const metrics = buildPensionMetrics(profile);

            pensionMetricFields.forEach(field => {
                const metricName = field.dataset.pensionMetric;

                if (metrics[metricName]) {
                    field.textContent = metrics[metricName];
                }
            });
        }

        function renderPensionBeneficiaries(profile) {
            if (!pensionBeneficiariesGrid) {
                return;
            }

            pensionBeneficiariesGrid.innerHTML = profile.beneficiaries.map(beneficiary => `
                <div class="rounded-2xl border border-slate-100 bg-slate-50 p-5">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <p class="text-sm font-semibold text-slate-700">${beneficiary[0]}</p>
                            <p class="mt-1 text-xs text-slate-400">${beneficiary[1]}</p>
                        </div>
                        <span class="rounded-full bg-indigo-50 px-3 py-1 text-[11px] font-semibold text-indigo-600">${beneficiary[2]}</span>
                    </div>
                    <p class="mt-4 text-xs text-slate-400">Beneficiary allocation under the current pension nomination.</p>
                </div>
            `).join('');
        }

        function renderPensionContributions(profile) {
            if (!pensionContributionTableBody) {
                return;
            }

            pensionContributionTableBody.innerHTML = profile.contributions.map(record => `
                <tr>
                    <td class="px-2 py-4 text-sm text-slate-600">${record[0]}</td>
                    <td class="px-2 py-4 text-sm text-slate-600">${record[1]}</td>
                    <td class="px-2 py-4 text-sm text-slate-600">${formatCurrency(record[2])}</td>
                    <td class="px-2 py-4 text-sm text-slate-600">${formatCurrency(record[3])}</td>
                    <td class="px-2 py-4 text-sm font-medium text-slate-700">${formatCurrency(record[4])}</td>
                    <td class="px-2 py-4 text-sm text-slate-600">${formatCurrency(record[5])}</td>
                </tr>
            `).join('');
        }

        function renderPensionSection(employeeNumber) {
            currentPensionProfile = buildPensionProfile(employeeNumber);

            renderPensionMetrics(currentPensionProfile);
            renderPensionBeneficiaries(currentPensionProfile);
            renderPensionContributions(currentPensionProfile);
        }

        function buildRosterMetrics(profile) {
            return {
                currentShift: profile.currentShift,
                currentStatus: profile.currentStatus,
                swapRequest: profile.swapRequest,
                assignedGroup: profile.assignedGroup
            };
        }

        function getRosterStatusClass(status) {
            if (status === 'Pending' || status === 'Pending Confirmation') {
                return 'status-pending';
            }

            if (status === 'Approved' || status === 'Assigned' || status === 'Active' || status === 'On Duty' || status === 'Scheduled' || status === 'Closed' || status === 'Verified') {
                return 'status-approved';
            }

            return 'status-active';
        }

        function renderRosterMetrics(profile) {
            const metrics = buildRosterMetrics(profile);

            rosterMetricFields.forEach(field => {
                const metricName = field.dataset.rosterMetric;

                if (metrics[metricName]) {
                    field.textContent = metrics[metricName];
                }
            });
        }

        function renderRosterWeeklyTable(profile) {
            if (!rosterWeeklyTableBody) {
                return;
            }

            rosterWeeklyTableBody.innerHTML = profile.weeklyRoster.map(record => `
                <tr>
                    <td class="px-2 py-4 text-sm font-medium text-slate-700">${record[0]}</td>
                    <td class="px-2 py-4 text-sm text-slate-600">${record[1]}</td>
                    <td class="px-2 py-4 text-sm text-slate-600">${record[2]}</td>
                    <td class="px-2 py-4 text-sm text-slate-600">${record[3]}</td>
                    <td class="px-2 py-4 text-sm text-slate-600">${record[4]}</td>
                    <td class="px-2 py-4"><span class="status-pill ${getRosterStatusClass(record[5])}">${record[5]}</span></td>
                </tr>
            `).join('');
        }

        function renderRosterAssignments(profile) {
            if (!rosterAssignmentsList) {
                return;
            }

            rosterAssignmentsList.innerHTML = profile.assignments.map(record => `
                <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4">
                    <div class="flex items-center justify-between gap-3">
                        <div>
                            <p class="text-sm font-semibold text-slate-700">${record[1]}</p>
                            <p class="mt-1 text-xs text-slate-400">${record[0]}</p>
                        </div>
                        <span class="rounded-full bg-indigo-50 px-3 py-1 text-[11px] font-semibold text-indigo-600">Duty</span>
                    </div>
                    <p class="mt-3 text-sm text-slate-600">${record[2]}</p>
                    <p class="mt-2 text-xs text-slate-400">${record[3]}</p>
                </div>
            `).join('');
        }

        function renderRosterSwapRequests(profile) {
            if (!rosterSwapRequestsList) {
                return;
            }

            rosterSwapRequestsList.innerHTML = profile.swaps.map(record => `
                <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4">
                    <div class="flex items-center justify-between gap-3">
                        <div>
                            <p class="text-sm font-semibold text-slate-700">${record[1]}</p>
                            <p class="mt-1 text-xs text-slate-400">${record[0]}</p>
                        </div>
                        <span class="status-pill ${getRosterStatusClass(record[3])}">${record[3]}</span>
                    </div>
                    <p class="mt-3 text-sm text-slate-600">${record[2]}</p>
                </div>
            `).join('');
        }

        function renderRosterSection(employeeNumber) {
            currentRosterProfile = rosterProfiles[employeeNumber] || rosterProfiles['EMP-0001'];

            renderRosterMetrics(currentRosterProfile);
            renderRosterWeeklyTable(currentRosterProfile);
            renderRosterAssignments(currentRosterProfile);
            renderRosterSwapRequests(currentRosterProfile);
        }

        function buildDocumentMetrics(profile) {
            const qualifications = profile.records.filter(record => record[0] === 'Qualification').length;
            const certificates = profile.records.filter(record => record[0] === 'Certificate').length;
            const identityDocs = profile.records.filter(record => record[2] === 'Identity').length;

            return {
                qualifications: String(qualifications),
                certificates: String(certificates),
                identityDocs: String(identityDocs)
            };
        }

        function renderDocumentMetrics(profile) {
            const metrics = buildDocumentMetrics(profile);

            documentMetricFields.forEach(field => {
                const metricName = field.dataset.documentMetric;

                if (metrics[metricName]) {
                    field.textContent = metrics[metricName];
                }
            });
        }

        function renderDocumentHistory(profile) {
            if (!documentHistoryTableBody) {
                return;
            }

            documentHistoryTableBody.innerHTML = profile.records.map((record, index) => `
                <tr>
                    <td class="px-2 py-4 text-sm font-medium text-slate-700">${record[0]}</td>
                    <td class="px-2 py-4 text-sm text-slate-600">${record[1]}</td>
                    <td class="px-2 py-4 text-sm text-slate-600">${record[2]}</td>
                    <td class="px-2 py-4"><span class="status-pill ${getRosterStatusClass(record[3])}">${record[3]}</span></td>
                    <td class="px-2 py-4 text-sm text-slate-600">${record[4]}</td>
                    <td class="px-2 py-4">
                        <button type="button" class="view-document-sample inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-600 transition hover:bg-slate-50" data-document-index="${index}">
                            <i class="fa-regular fa-eye text-[11px]"></i>
                            <span>View</span>
                        </button>
                    </td>
                </tr>
            `).join('');
        }

        function showDocumentSample(index) {
            if (!currentDocumentProfile || !currentDocumentProfile.records[index] || !documentViewerModal) {
                return;
            }

            const record = currentDocumentProfile.records[index];

            documentViewerSubtitle.textContent = `${record[1]} sample reference updated on ${record[4]}.`;
            documentViewerName.textContent = record[1];
            documentViewerStatus.textContent = record[3];
            documentViewerText.textContent = record[5];
            documentViewerFiles.innerHTML = record[6].map(file => `
                <div class="rounded-2xl border border-slate-100 bg-slate-50 px-4 py-3 text-sm text-slate-700">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600">
                            <i class="fa-solid fa-file-lines"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-700">${file}</p>
                            <p class="text-xs text-slate-400">Sample reference file attached to this document row.</p>
                        </div>
                    </div>
                </div>
            `).join('');

            documentViewerModal.classList.remove('hidden');
            documentViewerModal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
        }

        function hideDocumentSample() {
            if (!documentViewerModal) {
                return;
            }

            documentViewerModal.classList.add('hidden');
            documentViewerModal.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        }

        function renderDocumentSection(employeeNumber) {
            currentDocumentProfile = documentProfiles[employeeNumber] || documentProfiles['EMP-0001'];

            renderDocumentMetrics(currentDocumentProfile);
            renderDocumentHistory(currentDocumentProfile);
        }

        function populateEmployeeDetails() {
            const employeeParams = new URLSearchParams(window.location.search);

            if (!employeeParams.toString()) {
                renderAttendanceSection(currentEmployeeNumber);
                renderWarningSection(currentEmployeeNumber);
                renderLeaveSection(currentEmployeeNumber);
                renderPromotionSection(currentEmployeeNumber);
                renderPayrollSection(currentEmployeeNumber);
                renderTrainingSection(currentEmployeeNumber);
                renderPensionSection(currentEmployeeNumber);
                renderRosterSection(currentEmployeeNumber);
                renderDocumentSection(currentEmployeeNumber);
                return;
            }

            employeeFields.forEach(field => {
                const fieldName = field.dataset.employeeField;
                const fieldValue = employeeParams.get(fieldName);

                if (fieldValue) {
                    field.textContent = fieldValue;
                }
            });

            if (employeeAvatar) {
                const employeeName = employeeParams.get('name') || 'Employee';

                employeeAvatar.src = '/HRMS/ceo.jpg';
                employeeAvatar.alt = `${employeeName} Avatar`;
            }

            if (employeeStatus) {
                const statusValue = employeeParams.get('status');
                const statusClass = employeeParams.get('statusClass');

                if (statusValue) {
                    employeeStatus.textContent = statusValue;
                }

                employeeStatus.classList.remove('status-active', 'status-leave', 'status-inactive');
                employeeStatus.classList.add(statusClass || 'status-active');
            }

            if (employeeParams.get('name')) {
                document.title = `HRM System - ${employeeParams.get('name')}`;
            }

            renderAttendanceSection(employeeParams.get('employeeNumber') || currentEmployeeNumber);
            renderWarningSection(employeeParams.get('employeeNumber') || currentEmployeeNumber);
            renderLeaveSection(employeeParams.get('employeeNumber') || currentEmployeeNumber);
            renderPromotionSection(employeeParams.get('employeeNumber') || currentEmployeeNumber);
            renderPayrollSection(employeeParams.get('employeeNumber') || currentEmployeeNumber);
            renderTrainingSection(employeeParams.get('employeeNumber') || currentEmployeeNumber);
            renderPensionSection(employeeParams.get('employeeNumber') || currentEmployeeNumber);
            renderRosterSection(employeeParams.get('employeeNumber') || currentEmployeeNumber);
            renderDocumentSection(employeeParams.get('employeeNumber') || currentEmployeeNumber);
        }

        sidebarToggle.addEventListener('click', handleSidebarToggle);
        sidebarOverlay.addEventListener('click', closeMobileSidebar);
        window.addEventListener('resize', syncSidebarMode);

        tabButtons.forEach(button => {
            button.addEventListener('click', function () {
                switchTab(button.dataset.tab);
            });
        });

        if (attendanceRangeFilter) {
            attendanceRangeFilter.addEventListener('change', function () {
                renderAttendanceChart(currentAttendanceProfile || attendanceProfiles[currentEmployeeNumber]);
            });
        }

        if (warningHistoryTableBody) {
            warningHistoryTableBody.addEventListener('click', function (event) {
                const detailButton = event.target.closest('.view-warning-detail');

                if (!detailButton) {
                    return;
                }

                showWarningDetail(Number(detailButton.dataset.warningIndex));
            });
        }

        if (closeWarningDetailModal) {
            closeWarningDetailModal.addEventListener('click', hideWarningDetail);
        }

        if (warningDetailModal) {
            warningDetailModal.addEventListener('click', function (event) {
                if (event.target === warningDetailModal || event.target.classList.contains('modal-backdrop')) {
                    hideWarningDetail();
                }
            });
        }

        if (leaveHistoryTableBody) {
            leaveHistoryTableBody.addEventListener('click', function (event) {
                const evidenceButton = event.target.closest('.view-leave-evidence');

                if (!evidenceButton) {
                    return;
                }

                showLeaveEvidence(Number(evidenceButton.dataset.leaveIndex));
            });
        }

        if (closeLeaveEvidenceModal) {
            closeLeaveEvidenceModal.addEventListener('click', hideLeaveEvidence);
        }

        if (leaveEvidenceModal) {
            leaveEvidenceModal.addEventListener('click', function (event) {
                if (event.target === leaveEvidenceModal || event.target.classList.contains('modal-backdrop')) {
                    hideLeaveEvidence();
                }
            });
        }

        if (promotionPrevBtn) {
            promotionPrevBtn.addEventListener('click', function () {
                if (activePromotionStep > 0) {
                    activePromotionStep -= 1;
                    renderPromotionTimeline();
                }
            });
        }

        if (promotionNextBtn) {
            promotionNextBtn.addEventListener('click', function () {
                if (currentPromotionProfile && activePromotionStep < currentPromotionProfile.promotions.length - 1) {
                    activePromotionStep += 1;
                    renderPromotionTimeline();
                }
            });
        }

        if (promotionHistoryTableBody) {
            promotionHistoryTableBody.addEventListener('click', function (event) {
                const evidenceButton = event.target.closest('.view-promotion-evidence');

                if (!evidenceButton) {
                    return;
                }

                showPromotionEvidence(Number(evidenceButton.dataset.promotionIndex));
            });
        }

        if (closePromotionEvidenceModal) {
            closePromotionEvidenceModal.addEventListener('click', hidePromotionEvidence);
        }

        if (promotionEvidenceModal) {
            promotionEvidenceModal.addEventListener('click', function (event) {
                if (event.target === promotionEvidenceModal || event.target.classList.contains('modal-backdrop')) {
                    hidePromotionEvidence();
                }
            });
        }

        if (payrollHistoryTableBody) {
            payrollHistoryTableBody.addEventListener('click', function (event) {
                const slipButton = event.target.closest('.view-payroll-slip');

                if (!slipButton) {
                    return;
                }

                showPayrollSlip(Number(slipButton.dataset.payrollIndex));
            });
        }

        if (closePayrollSlipModal) {
            closePayrollSlipModal.addEventListener('click', hidePayrollSlip);
        }

        if (payrollSlipModal) {
            payrollSlipModal.addEventListener('click', function (event) {
                if (event.target === payrollSlipModal || event.target.classList.contains('modal-backdrop')) {
                    hidePayrollSlip();
                }
            });
        }

        if (trainingHistoryTableBody) {
            trainingHistoryTableBody.addEventListener('click', function (event) {
                const detailButton = event.target.closest('.view-training-detail');

                if (!detailButton) {
                    return;
                }

                showTrainingDetail(Number(detailButton.dataset.trainingIndex));
            });
        }

        if (closeTrainingDetailModal) {
            closeTrainingDetailModal.addEventListener('click', hideTrainingDetail);
        }

        if (trainingDetailModal) {
            trainingDetailModal.addEventListener('click', function (event) {
                if (event.target === trainingDetailModal || event.target.classList.contains('modal-backdrop')) {
                    hideTrainingDetail();
                }
            });
        }

        if (documentHistoryTableBody) {
            documentHistoryTableBody.addEventListener('click', function (event) {
                const viewButton = event.target.closest('.view-document-sample');

                if (!viewButton) {
                    return;
                }

                showDocumentSample(Number(viewButton.dataset.documentIndex));
            });
        }

        if (closeDocumentViewerModal) {
            closeDocumentViewerModal.addEventListener('click', hideDocumentSample);
        }

        if (documentViewerModal) {
            documentViewerModal.addEventListener('click', function (event) {
                if (event.target === documentViewerModal || event.target.classList.contains('modal-backdrop')) {
                    hideDocumentSample();
                }
            });
        }

        populateEmployeeDetails();
        syncSidebarMode();
    </script>
</body>
</html>
