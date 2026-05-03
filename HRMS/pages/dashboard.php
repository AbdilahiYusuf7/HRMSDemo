<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRM Dashboard - Employee Management</title>
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

        .stat-card:hover {
            transform: translateY(-2px);
            transition: all 0.3s ease;
        }

        .insight-card {
            transition: all 0.3s ease;
        }

        .insight-card.is-clickable {
            cursor: pointer;
        }

        .insight-card.is-clickable:focus {
            outline: 2px solid #6366f1;
            outline-offset: 3px;
        }

        body.modal-open {
            overflow: hidden;
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .status-pill {
            padding: 4px 12px;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .status-present { background: #dcfce7; color: #166534; }
        .status-absent { background: #fee2e2; color: #991b1b; }
        .status-leave { background: #fef3c7; color: #92400e; }
    </style>
</head>
<body class="flex min-h-screen bg-slate-50">
    <?php $menuBasePath = '../'; ?>
    <?php $currentMenu = 'dashboard'; ?>
    <?php include __DIR__ . '/../includes/header_sidebar.php'; ?>
    <div class="mx-auto w-full max-w-[1440px] p-4 md:p-8">
        <!-- Insight Cards -->
        <div id="dashboardInsightCards" class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-8"></div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Nightingale Chart (Department Overview) -->
        <div class="glass-card p-6 flex flex-col">
            <div class="flex justify-between items-center mb-6">
                <h3 class="font-bold text-slate-800">Department Overview</h3>
                <i class="fa-solid fa-ellipsis-vertical text-slate-400 cursor-pointer"></i>
            </div>
            <div class="flex-grow flex items-center justify-center">
                <canvas id="deptChart" height="280"></canvas>
            </div>
        </div>

        <!-- Spline Chart (Weekly Attendance) -->
        <div class="glass-card p-6 lg:col-span-2">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                <div>
                    <h3 class="font-bold text-slate-800">Weekly Attendance Rate</h3>
                    <p class="text-xs text-slate-400">Daily presence comparison trend</p>
                </div>
                <select class="bg-slate-50 border border-slate-200 text-slate-600 text-xs rounded-lg px-3 py-2 outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="weekly">Weekly</option>
                    <option value="monthly">Monthly</option>
                    <option value="daily">Daily</option>
                </select>
            </div>
            <div class="h-[280px]">
                <canvas id="attendanceChart"></canvas>
            </div>
        </div>
        </div>

        <!-- Bottom Section: Table and Branches -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        <!-- Attendance Table -->
        <div class="glass-card p-6 lg:col-span-3 overflow-hidden">
            <div class="flex justify-between items-center mb-6">
                <h3 class="font-bold text-slate-800">Today's Attendance</h3>
                <a href="attendance/list_attendance.php" class="text-indigo-600 text-xs font-bold hover:underline">View All</a>
            </div>
            <div class="overflow-x-auto custom-scrollbar">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-slate-400 text-[11px] uppercase tracking-wider border-b border-slate-100">
                            <th class="pb-4 font-semibold">Employee</th>
                            <th class="pb-4 font-semibold">Location</th>
                            <th class="pb-4 font-semibold">Check-In</th>
                            <th class="pb-4 font-semibold">Status</th>
                            <th class="pb-4 font-semibold">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="py-4">
                                <div class="flex items-center gap-3">
                                    <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Abdirahman" class="w-8 h-8 rounded-full bg-slate-100">
                                    <div>
                                        <p class="text-sm font-bold text-slate-700">Cabdiraxmaan Cali</p>
                                        <p class="text-[10px] text-slate-400">+252 61 555-0101</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4">
                                <p class="text-sm text-slate-600 font-medium">Idaacada Branch</p>
                            </td>
                            <td class="py-4">
                                <p class="text-sm text-slate-500">08:00 AM</p>
                            </td>
                            <td class="py-4">
                                <span class="status-pill status-present text-[10px]">Present</span>
                            </td>
                            <td class="py-4">
                                <button class="p-2 text-slate-400 hover:text-indigo-600"><i class="fa-solid fa-ellipsis"></i></button>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="py-4">
                                <div class="flex items-center gap-3">
                                    <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Faisa" class="w-8 h-8 rounded-full bg-slate-100">
                                    <div>
                                        <p class="text-sm font-bold text-slate-700">Faaisa Jaamac</p>
                                        <p class="text-[10px] text-slate-400">+252 61 555-0202</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4">
                                <p class="text-sm text-slate-600 font-medium">Togdheer Branch</p>
                            </td>
                            <td class="py-4">
                                <p class="text-sm text-slate-500">08:15 AM</p>
                            </td>
                            <td class="py-4">
                                <span class="status-pill status-present text-[10px]">Present</span>
                            </td>
                            <td class="py-4">
                                <button class="p-2 text-slate-400 hover:text-indigo-600"><i class="fa-solid fa-ellipsis"></i></button>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="py-4">
                                <div class="flex items-center gap-3">
                                    <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Mustafe" class="w-8 h-8 rounded-full bg-slate-100">
                                    <div>
                                        <p class="text-sm font-bold text-slate-700">Mustafe Caydiid</p>
                                        <p class="text-[10px] text-slate-400">+252 61 555-0303</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4">
                                <p class="text-sm text-slate-600 font-medium">Xero Awr Branch</p>
                            </td>
                            <td class="py-4">
                                <p class="text-sm text-slate-500">-- : --</p>
                            </td>
                            <td class="py-4">
                                <span class="status-pill status-absent text-[10px]">Absent</span>
                            </td>
                            <td class="py-4">
                                <button class="p-2 text-slate-400 hover:text-indigo-600"><i class="fa-solid fa-ellipsis"></i></button>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="py-4">
                                <div class="flex items-center gap-3">
                                    <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Xaawo" class="w-8 h-8 rounded-full bg-slate-100">
                                    <div>
                                        <p class="text-sm font-bold text-slate-700">Xaawo Axmed</p>
                                        <p class="text-[10px] text-slate-400">+252 61 555-0404</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4">
                                <p class="text-sm text-slate-600 font-medium">Hargaysa Branch</p>
                            </td>
                            <td class="py-4">
                                <p class="text-sm text-slate-500">08:05 AM</p>
                            </td>
                            <td class="py-4">
                                <span class="status-pill status-leave text-[10px]">Leave</span>
                            </td>
                            <td class="py-4">
                                <button class="p-2 text-slate-400 hover:text-indigo-600"><i class="fa-solid fa-ellipsis"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Location Overview -->
        <div class="glass-card p-6 flex flex-col">
            <h3 class="font-bold text-slate-800 mb-6">Regional Branches — Somaliland</h3>
            <div class="space-y-6 flex-grow">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-10 bg-indigo-500 rounded-full"></div>
                        <div>
                            <p class="text-sm font-bold text-slate-700">Idaacada</p>
                            <p class="text-[10px] text-slate-400">Hargeysa — Maroodi Jeex</p>
                        </div>
                    </div>
                    <p class="text-sm font-bold text-indigo-600">450</p>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-10 bg-emerald-500 rounded-full"></div>
                        <div>
                            <p class="text-sm font-bold text-slate-700">Togdheer</p>
                            <p class="text-[10px] text-slate-400">Burco — Togdheer</p>
                        </div>
                    </div>
                    <p class="text-sm font-bold text-emerald-600">320</p>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-10 bg-amber-500 rounded-full"></div>
                        <div>
                            <p class="text-sm font-bold text-slate-700">Berbera</p>
                            <p class="text-[10px] text-slate-400">Berbera — Sahil</p>
                        </div>
                    </div>
                    <p class="text-sm font-bold text-amber-600">280</p>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-10 bg-rose-500 rounded-full"></div>
                        <div>
                            <p class="text-sm font-bold text-slate-700">Borama</p>
                            <p class="text-[10px] text-slate-400">Borama — Awdal</p>
                        </div>
                    </div>
                    <p class="text-sm font-bold text-rose-600">190</p>
                </div>
            </div>
            <button id="viewLocationMapButton" type="button" class="mt-8 w-full py-3 bg-slate-50 text-slate-600 text-xs font-bold rounded-xl hover:bg-slate-100 transition-colors border border-slate-200">
                View Location Map
            </button>
        </div>
        </div>
    </div>
    </main>

    <div id="attendanceInsightModal" class="fixed inset-0 z-[70] hidden items-center justify-center bg-slate-950/50 p-4">
        <div class="glass-card w-full max-w-5xl overflow-hidden bg-white">
            <div class="flex items-start justify-between gap-4 border-b border-slate-100 px-6 py-5">
                <div>
                    <h3 id="attendanceInsightModalTitle" class="text-lg font-bold text-slate-800">Attendance Details</h3>
                    <p id="attendanceInsightModalSubtitle" class="mt-1 text-xs text-slate-400">Employees matching the selected attendance insight.</p>
                </div>
                <button id="closeAttendanceInsightModal" type="button" class="flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-500 transition hover:bg-slate-50 hover:text-slate-800">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="max-h-[70vh] overflow-y-auto p-6">
                <div class="overflow-x-auto custom-scrollbar">
                    <table class="min-w-full text-left">
                        <thead>
                            <tr class="border-b border-slate-100 text-[11px] uppercase tracking-wider text-slate-400">
                                <th class="px-4 py-4 font-semibold">Employee</th>
                                <th class="px-4 py-4 font-semibold">Department</th>
                                <th class="px-4 py-4 font-semibold">Original Check In</th>
                                <th class="px-4 py-4 font-semibold">Actual Check In</th>
                                <th class="px-4 py-4 font-semibold">Minutes Late</th>
                            </tr>
                        </thead>
                        <tbody id="attendanceInsightModalBody" class="divide-y divide-slate-50"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="retirementSoonModal" class="fixed inset-0 z-[70] hidden items-center justify-center bg-slate-950/50 p-4">
        <div class="glass-card w-full max-w-5xl overflow-hidden bg-white">
            <div class="flex items-start justify-between gap-4 border-b border-slate-100 px-6 py-5">
                <div>
                    <h3 class="text-lg font-bold text-slate-800">Nearest Retiring Employees</h3>
                    <p class="mt-1 text-xs text-slate-400">Employees approaching retirement with remaining days, months, and years.</p>
                </div>
                <button id="closeRetirementSoonModal" type="button" class="flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-500 transition hover:bg-slate-50 hover:text-slate-800">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="max-h-[70vh] overflow-y-auto p-6">
                <div class="overflow-x-auto custom-scrollbar">
                    <table class="min-w-full text-left">
                        <thead>
                            <tr class="border-b border-slate-100 text-[11px] uppercase tracking-wider text-slate-400">
                                <th class="px-4 py-4 font-semibold">Employee</th>
                                <th class="px-4 py-4 font-semibold">Department</th>
                                <th class="px-4 py-4 font-semibold">Retirement Date</th>
                                <th class="px-4 py-4 font-semibold">Days</th>
                                <th class="px-4 py-4 font-semibold">Months</th>
                                <th class="px-4 py-4 font-semibold">Years</th>
                            </tr>
                        </thead>
                        <tbody id="retirementSoonModalBody" class="divide-y divide-slate-50"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="locationMapModal" class="fixed inset-0 z-[70] hidden items-center justify-center bg-slate-950/50 p-4">
        <div class="glass-card w-full max-w-4xl overflow-hidden bg-white">
            <div class="flex items-start justify-between gap-4 border-b border-slate-100 px-6 py-5">
                <div>
                    <h3 class="text-lg font-bold text-slate-800">Regional Branch Locations</h3>
                    <p class="mt-1 text-xs text-slate-400">Branch coverage and employee totals by region.</p>
                </div>
                <button id="closeLocationMapModal" type="button" class="flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-500 transition hover:bg-slate-50 hover:text-slate-800">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="max-h-[70vh] overflow-y-auto p-6">
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="rounded-xl border border-slate-100 bg-slate-50 p-5">
                        <div class="mb-3 h-2 w-12 rounded-full bg-indigo-500"></div>
                        <h4 class="text-sm font-bold text-slate-800">Idaacada</h4>
                        <p class="mt-1 text-xs text-slate-500">Hargeysa / Maroodi Jeex</p>
                        <p class="mt-4 text-xl font-bold text-indigo-600">450</p>
                        <p class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Employees</p>
                    </div>
                    <div class="rounded-xl border border-slate-100 bg-slate-50 p-5">
                        <div class="mb-3 h-2 w-12 rounded-full bg-emerald-500"></div>
                        <h4 class="text-sm font-bold text-slate-800">Togdheer</h4>
                        <p class="mt-1 text-xs text-slate-500">Burco / Togdheer</p>
                        <p class="mt-4 text-xl font-bold text-emerald-600">320</p>
                        <p class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Employees</p>
                    </div>
                    <div class="rounded-xl border border-slate-100 bg-slate-50 p-5">
                        <div class="mb-3 h-2 w-12 rounded-full bg-amber-500"></div>
                        <h4 class="text-sm font-bold text-slate-800">Berbera</h4>
                        <p class="mt-1 text-xs text-slate-500">Berbera / Sahil</p>
                        <p class="mt-4 text-xl font-bold text-amber-600">280</p>
                        <p class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Employees</p>
                    </div>
                    <div class="rounded-xl border border-slate-100 bg-slate-50 p-5">
                        <div class="mb-3 h-2 w-12 rounded-full bg-rose-500"></div>
                        <h4 class="text-sm font-bold text-slate-800">Borama</h4>
                        <p class="mt-1 text-xs text-slate-500">Borama / Awdal</p>
                        <p class="mt-4 text-xl font-bold text-rose-600">190</p>
                        <p class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Employees</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const desktopSidebarBreakpoint = window.matchMedia('(min-width: 1024px)');
        const dashboardInsightCards = document.getElementById('dashboardInsightCards');
        const attendanceInsightModal = document.getElementById('attendanceInsightModal');
        const attendanceInsightModalTitle = document.getElementById('attendanceInsightModalTitle');
        const attendanceInsightModalSubtitle = document.getElementById('attendanceInsightModalSubtitle');
        const attendanceInsightModalBody = document.getElementById('attendanceInsightModalBody');
        const closeAttendanceInsightModal = document.getElementById('closeAttendanceInsightModal');
        const retirementSoonModal = document.getElementById('retirementSoonModal');
        const retirementSoonModalBody = document.getElementById('retirementSoonModalBody');
        const closeRetirementSoonModal = document.getElementById('closeRetirementSoonModal');
        const viewLocationMapButton = document.getElementById('viewLocationMapButton');
        const locationMapModal = document.getElementById('locationMapModal');
        const closeLocationMapModal = document.getElementById('closeLocationMapModal');

        const attendanceInsightRecords = [
            { employee: 'Fadumo Xasan', department: 'Finance', originalCheckIn: '08:00 AM', actualCheckIn: '10:15 AM', minutesLate: 135, late: true, outOfWindow: true, absent: false },
            { employee: 'Mahad Axmed', department: 'Operations', originalCheckIn: '08:00 AM', actualCheckIn: '--', minutesLate: '--', late: false, outOfWindow: false, absent: true },
            { employee: 'Hodan Ali', department: 'Administration', originalCheckIn: '08:00 AM', actualCheckIn: '08:04 AM', minutesLate: 4, late: true, outOfWindow: false, absent: false },
            { employee: 'Mustafe Cabdi', department: 'Information Technology', originalCheckIn: '08:00 AM', actualCheckIn: '10:22 AM', minutesLate: 142, late: true, outOfWindow: true, absent: false },
            { employee: 'Roda Jama', department: 'Finance', originalCheckIn: '08:00 AM', actualCheckIn: '--', minutesLate: '--', late: false, outOfWindow: false, absent: true },
            { employee: 'Nimco Ahmed', department: 'Marketing', originalCheckIn: '08:00 AM', actualCheckIn: '10:08 AM', minutesLate: 128, late: true, outOfWindow: true, absent: false }
        ];

        const retirementSoonRecords = [
            { employee: 'Mohamed Nuur', department: 'Information Technology', retirementDate: '2026-04-28' },
            { employee: 'Hodan Maxamed', department: 'Finance', retirementDate: '2026-04-29' },
            { employee: 'Fadumo Cabdi', department: 'Human Resource', retirementDate: '2026-04-30' },
            { employee: 'Cabdirisaaq Xasan', department: 'Operations', retirementDate: '2026-05-10' },
            { employee: 'Nimco Aadan', department: 'Administration', retirementDate: '2026-05-24' },
            { employee: 'Ayan Cali', department: 'Marketing', retirementDate: '2026-06-18' },
            { employee: 'Maxamed Faarax', department: 'Administration', retirementDate: '2026-09-28' },
            { employee: 'Sahra Warsame', department: 'Finance', retirementDate: '2027-04-28' },
            { employee: 'Khadar Cabdi', department: 'Operations', retirementDate: '2028-04-28' }
        ];

        const bestPerformer = {
            employee: 'Mahad Axmed',
            department: 'Operations',
            score: '97%'
        };

        const dashboardCardConfig = [
            { key: 'training', label: 'Training', value: '18', border: 'border-sky-500', iconBg: 'bg-sky-50', iconColor: 'text-sky-600', icon: 'fa-graduation-cap', helper: 'Active and upcoming training sessions' },
            { key: 'performance', label: 'Performance Statistics', value: '86%', border: 'border-emerald-500', iconBg: 'bg-emerald-50', iconColor: 'text-emerald-600', icon: 'fa-chart-line', helper: 'Average employee performance score' },
            { key: 'bestPerformer', label: 'Best Performer', border: 'border-violet-500', iconBg: 'bg-violet-50', iconColor: 'text-violet-600', icon: 'fa-medal', helper: `${bestPerformer.department} · ${bestPerformer.score} performance score` },
            { key: 'retiringSoon', label: 'Nearest Retiring', border: 'border-slate-500', iconBg: 'bg-slate-100', iconColor: 'text-slate-600', icon: 'fa-person-cane', helper: 'Employees closest to retirement date' },
            { key: 'late', label: 'Late', border: 'border-amber-500', iconBg: 'bg-amber-50', iconColor: 'text-amber-600', icon: 'fa-clock', helper: 'Employees who checked in after schedule', modalTitle: 'Late Employees', modalSubtitle: 'Employees who came late today.' },
            { key: 'outOfWindow', label: 'Out of Window', border: 'border-indigo-500', iconBg: 'bg-indigo-50', iconColor: 'text-indigo-600', icon: 'fa-triangle-exclamation', helper: 'Checked in 2+ hours after scheduled time', modalTitle: 'Out of Window Check Ins', modalSubtitle: 'Employees whose check-in was at least 2 hours after their scheduled start time.' },
            { key: 'absent', label: 'Absent', border: 'border-rose-500', iconBg: 'bg-rose-50', iconColor: 'text-rose-600', icon: 'fa-user-xmark', helper: 'Employees absent from duty today', modalTitle: 'Absent Employees', modalSubtitle: 'Employees without a check-in record today.' }
        ];

        function buildDashboardSummary() {
            return {
                training: '18',
                performance: '86%',
                bestPerformer: bestPerformer.employee,
                retiringSoon: String(retirementSoonRecords.length),
                late: String(attendanceInsightRecords.filter(record => record.late).length),
                outOfWindow: String(attendanceInsightRecords.filter(record => record.outOfWindow).length),
                absent: String(attendanceInsightRecords.filter(record => record.absent).length)
            };
        }

        function renderDashboardInsightCards() {
            const summary = buildDashboardSummary();

            dashboardInsightCards.innerHTML = dashboardCardConfig.map(card => {
                const isAttendanceClickable = ['late', 'outOfWindow', 'absent'].includes(card.key);
                const isRetirementClickable = card.key === 'retiringSoon';
                const isClickable = isAttendanceClickable || isRetirementClickable;
                const clickAttributes = isAttendanceClickable
                    ? `role="button" tabindex="0" data-insight="${card.key}"`
                    : isRetirementClickable
                        ? 'role="button" tabindex="0" data-retirement-insight="retiringSoon"'
                        : '';

                return `
                    <div class="glass-card insight-card stat-card ${isClickable ? 'is-clickable' : ''} border-l-4 ${card.border} p-6" ${clickAttributes}>
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm text-slate-500 font-medium">${card.label}</p>
                                <h3 class="text-2xl font-bold text-slate-800 mt-1">${summary[card.key]}</h3>
                            </div>
                            <div class="p-3 ${card.iconBg} rounded-xl ${card.iconColor}">
                                <i class="fa-solid ${card.icon} text-xl"></i>
                            </div>
                        </div>
                        <p class="text-[11px] text-slate-400 mt-4">${card.helper}</p>
                    </div>
                `;
            }).join('');
        }

        function getAttendanceInsightRows(insightKey) {
            return attendanceInsightRecords.filter(record => record[insightKey]);
        }

        function openAttendanceInsightModal(insightKey) {
            const card = dashboardCardConfig.find(item => item.key === insightKey);
            const rows = getAttendanceInsightRows(insightKey);

            if (!card) {
                return;
            }

            attendanceInsightModalTitle.textContent = card.modalTitle;
            attendanceInsightModalSubtitle.textContent = card.modalSubtitle;
            attendanceInsightModalBody.innerHTML = rows.map(row => `
                <tr class="transition-colors hover:bg-slate-50/70">
                    <td class="px-4 py-4 text-sm font-semibold text-slate-700">${row.employee}</td>
                    <td class="px-4 py-4 text-sm text-slate-600">${row.department}</td>
                    <td class="px-4 py-4 text-sm text-slate-600">${row.originalCheckIn}</td>
                    <td class="px-4 py-4 text-sm text-slate-600">${row.actualCheckIn}</td>
                    <td class="px-4 py-4 text-sm text-slate-600">${row.minutesLate}</td>
                </tr>
            `).join('');

            if (!rows.length) {
                attendanceInsightModalBody.innerHTML = `
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-sm text-slate-400">No employees found for this insight.</td>
                    </tr>
                `;
            }

            attendanceInsightModal.classList.remove('hidden');
            attendanceInsightModal.classList.add('flex');
            document.body.classList.add('modal-open');
        }

        function closeAttendanceModal() {
            attendanceInsightModal.classList.add('hidden');
            attendanceInsightModal.classList.remove('flex');
            document.body.classList.remove('modal-open');
        }

        function getDaysUntilRetirement(retirementDate) {
            const today = new Date('2026-04-28T00:00:00');
            const targetDate = new Date(`${retirementDate}T00:00:00`);
            const millisecondsPerDay = 24 * 60 * 60 * 1000;

            return Math.max(0, Math.ceil((targetDate - today) / millisecondsPerDay) + 1);
        }

        function getRetirementTimeParts(retirementDate) {
            const totalDays = getDaysUntilRetirement(retirementDate);
            const years = Math.floor(totalDays / 365);
            const remainingAfterYears = totalDays % 365;
            const months = Math.floor(remainingAfterYears / 30);
            const days = remainingAfterYears % 30;

            return {
                totalDays,
                years,
                months,
                days
            };
        }

        function getRetirementSoonRows() {
            return retirementSoonRecords
                .map(record => {
                    const remaining = getRetirementTimeParts(record.retirementDate);

                    return {
                        ...record,
                        remaining
                    };
                })
                .sort((left, right) => left.remaining.totalDays - right.remaining.totalDays);
        }

        function openRetirementSoonModal() {
            const rows = getRetirementSoonRows();

            retirementSoonModalBody.innerHTML = rows.map(row => `
                <tr class="transition-colors hover:bg-slate-50/70">
                    <td class="px-4 py-4 text-sm font-semibold text-slate-700">${row.employee}</td>
                    <td class="px-4 py-4 text-sm text-slate-600">${row.department}</td>
                    <td class="px-4 py-4 text-sm text-slate-600">${row.retirementDate}</td>
                    <td class="px-4 py-4 text-sm text-slate-600">${row.remaining.days}</td>
                    <td class="px-4 py-4 text-sm text-slate-600">${row.remaining.months}</td>
                    <td class="px-4 py-4 text-sm text-slate-600">${row.remaining.years}</td>
                </tr>
            `).join('');

            if (!rows.length) {
                retirementSoonModalBody.innerHTML = `
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-sm text-slate-400">No retiring employees found.</td>
                    </tr>
                `;
            }

            retirementSoonModal.classList.remove('hidden');
            retirementSoonModal.classList.add('flex');
            document.body.classList.add('modal-open');
        }

        function closeRetirementModal() {
            retirementSoonModal.classList.add('hidden');
            retirementSoonModal.classList.remove('flex');
            document.body.classList.remove('modal-open');
        }

        function openLocationMapModal() {
            locationMapModal.classList.remove('hidden');
            locationMapModal.classList.add('flex');
            document.body.classList.add('modal-open');
        }

        function closeLocationModal() {
            locationMapModal.classList.add('hidden');
            locationMapModal.classList.remove('flex');
            document.body.classList.remove('modal-open');
        }

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

        sidebarToggle.addEventListener('click', handleSidebarToggle);
        sidebarOverlay.addEventListener('click', closeMobileSidebar);
        window.addEventListener('resize', syncSidebarMode);
        closeAttendanceInsightModal.addEventListener('click', closeAttendanceModal);
        closeRetirementSoonModal.addEventListener('click', closeRetirementModal);
        viewLocationMapButton.addEventListener('click', openLocationMapModal);
        closeLocationMapModal.addEventListener('click', closeLocationModal);
        attendanceInsightModal.addEventListener('click', event => {
            if (event.target === attendanceInsightModal) {
                closeAttendanceModal();
            }
        });
        retirementSoonModal.addEventListener('click', event => {
            if (event.target === retirementSoonModal) {
                closeRetirementModal();
            }
        });
        locationMapModal.addEventListener('click', event => {
            if (event.target === locationMapModal) {
                closeLocationModal();
            }
        });
        dashboardInsightCards.addEventListener('click', event => {
            const card = event.target.closest('[data-insight]');
            const retirementCard = event.target.closest('[data-retirement-insight]');

            if (card) {
                openAttendanceInsightModal(card.dataset.insight);
            }

            if (retirementCard) {
                openRetirementSoonModal();
            }
        });
        dashboardInsightCards.addEventListener('keydown', event => {
            const card = event.target.closest('[data-insight]');
            const retirementCard = event.target.closest('[data-retirement-insight]');

            if (card && (event.key === 'Enter' || event.key === ' ')) {
                event.preventDefault();
                openAttendanceInsightModal(card.dataset.insight);
            }

            if (retirementCard && (event.key === 'Enter' || event.key === ' ')) {
                event.preventDefault();
                openRetirementSoonModal();
            }
        });
        document.addEventListener('keydown', event => {
            if (event.key === 'Escape' && !attendanceInsightModal.classList.contains('hidden')) {
                closeAttendanceModal();
            }

            if (event.key === 'Escape' && !retirementSoonModal.classList.contains('hidden')) {
                closeRetirementModal();
            }

            if (event.key === 'Escape' && !locationMapModal.classList.contains('hidden')) {
                closeLocationModal();
            }
        });
        syncSidebarMode();
        renderDashboardInsightCards();

        // Nightingale Rose Chart (Polar Area)
        const deptCtx = document.getElementById('deptChart').getContext('2d');
        new Chart(deptCtx, {
            type: 'polarArea',
            data: {
                labels: ['IT', 'HR', 'Marketing', 'Finance', 'Operations'],
                datasets: [{
                    label: 'Employees',
                    data: [25, 15, 20, 22, 30],
                    backgroundColor: [
                        'rgba(99, 102, 241, 0.7)',
                        'rgba(16, 185, 129, 0.7)',
                        'rgba(245, 158, 11, 0.7)',
                        'rgba(239, 68, 68, 0.7)',
                        'rgba(139, 92, 246, 0.7)'
                    ],
                    borderWidth: 2,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    r: {
                        display: false
                    }
                },
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true,
                            font: { size: 10 }
                        }
                    }
                }
            }
        });

        // Spline Attendance Chart
        const attendanceCtx = document.getElementById('attendanceChart').getContext('2d');
        const gradient = attendanceCtx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(99, 102, 241, 0.2)');
        gradient.addColorStop(1, 'rgba(99, 102, 241, 0)');

        new Chart(attendanceCtx, {
            type: 'line',
            data: {
                labels: ['Sat', 'Sun', 'Mon', 'Tue', 'Wed', 'Thu'],
                datasets: [{
                    label: 'Attendance (%)',
                    data: [92, 88, 95, 94, 91, 85],
                    borderColor: '#6366f1',
                    backgroundColor: gradient,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 5,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#6366f1',
                    pointBorderWidth: 2,
                    pointHoverRadius: 7,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: false,
                        min: 80,
                        grid: { color: '#f1f5f9' },
                        ticks: { color: '#94a3b8', font: { size: 10 } }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { color: '#94a3b8', font: { size: 10 } }
                    }
                }
            }
        });
    </script>
</body>
</html>
