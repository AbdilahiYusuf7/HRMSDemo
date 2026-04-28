<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRM System - Attendance Module</title>
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

        .status-pill {
            padding: 4px 12px;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .status-present {
            background: #dcfce7;
            color: #166534;
        }

        .status-late {
            background: #fef3c7;
            color: #92400e;
        }

        .status-absent {
            background: #fee2e2;
            color: #991b1b;
        }

        .status-early {
            background: #dbeafe;
            color: #1d4ed8;
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
    <?php $currentMenu = 'attendance'; ?>
    <?php include __DIR__ . '/../../includes/header_sidebar.php'; ?>

    <div class="mx-auto w-full max-w-[1440px] p-4 md:p-8">
        <div class="mb-8 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-slate-800">Attendance Module</h2>
                <p class="text-sm text-slate-500">Daily attendance overview, department comparison, and today's attendance register.</p>
            </div>
        </div>

        <div id="attendanceInsightCards" class="mb-8 grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-3"></div>

        <div class="glass-card mb-8 p-6">
            <div class="mb-6 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                <div>
                    <h3 class="text-base font-semibold text-slate-800">Department Attendance Comparison</h3>
                    <p class="text-xs text-slate-400">Pie chart visualization comparing department attendance for today.</p>
                </div>
                <div class="rounded-xl bg-slate-50 p-3 text-slate-500">
                    <i class="fa-solid fa-chart-pie text-sm"></i>
                </div>
            </div>
            <div class="mx-auto h-[340px] max-w-3xl">
                <canvas id="departmentAttendanceChart"></canvas>
            </div>
        </div>

        <div class="glass-card p-6">
            <div class="mb-5">
                <h3 class="text-base font-semibold text-slate-800">Today's Attendance Register</h3>
                <p class="text-xs text-slate-400">Employee attendance log for Saturday, April 25, 2026.</p>
            </div>
            <div class="table-scroll overflow-x-auto">
                <table class="min-w-full text-left">
                    <thead>
                        <tr class="border-b border-slate-100 text-[11px] uppercase tracking-wider text-slate-400">
                            <th class="px-4 py-4 font-semibold">Employee Name & ID</th>
                            <th class="px-4 py-4 font-semibold">Department</th>
                            <th class="px-4 py-4 font-semibold">Branch</th>
                            <th class="px-4 py-4 font-semibold">Check In Time & Date</th>
                            <th class="px-4 py-4 font-semibold">Work Hour</th>
                            <th class="px-4 py-4 font-semibold">Minutes Late</th>
                            <th class="px-4 py-4 font-semibold">Status</th>
                        </tr>
                    </thead>
                    <tbody id="todayAttendanceTableBody" class="divide-y divide-slate-50"></tbody>
                </table>
            </div>
        </div>

        <div class="glass-card mt-8 p-6">
            <div class="mb-5 flex flex-col gap-4 xl:flex-row xl:items-end xl:justify-between">
                <div>
                    <h3 class="text-base font-semibold text-slate-800">Attendance Incident Summary</h3>
                    <p class="text-xs text-slate-400">Per-employee counts for out-of-window entries, late check-ins, early check-outs, and missed attendance.</p>
                </div>
                <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 xl:grid-cols-3">
                    <div>
                        <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500">Department</label>
                        <select id="incidentDepartmentFilter" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-600 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100"></select>
                    </div>
                    <div>
                        <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500">Branch</label>
                        <select id="incidentBranchFilter" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-600 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100"></select>
                    </div>
                    <div>
                        <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500">Search</label>
                        <div class="flex items-center rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 focus-within:border-indigo-400 focus-within:ring-2 focus-within:ring-indigo-100">
                            <i class="fa-solid fa-magnifying-glass mr-3 text-sm text-slate-400"></i>
                            <input id="incidentSearchInput" type="text" placeholder="Search employee or ID..." class="w-full bg-transparent text-sm text-slate-600 outline-none">
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-scroll overflow-x-auto">
                <table class="min-w-full text-left">
                    <thead>
                        <tr class="border-b border-slate-100 text-[11px] uppercase tracking-wider text-slate-400">
                            <th class="px-4 py-4 font-semibold">Employee Name & ID</th>
                            <th class="px-4 py-4 font-semibold">Department</th>
                            <th class="px-4 py-4 font-semibold">Branch</th>
                            <th class="px-4 py-4 font-semibold">Out of Window</th>
                            <th class="px-4 py-4 font-semibold">Late Check In</th>
                            <th class="px-4 py-4 font-semibold">Early Check Out</th>
                            <th class="px-4 py-4 font-semibold">Missed Attendance</th>
                        </tr>
                    </thead>
                    <tbody id="attendanceIncidentTableBody" class="divide-y divide-slate-50"></tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const desktopSidebarBreakpoint = window.matchMedia('(min-width: 1024px)');
        const attendanceInsightCards = document.getElementById('attendanceInsightCards');
        const todayAttendanceTableBody = document.getElementById('todayAttendanceTableBody');
        const departmentAttendanceChartCanvas = document.getElementById('departmentAttendanceChart');
        const incidentDepartmentFilter = document.getElementById('incidentDepartmentFilter');
        const incidentBranchFilter = document.getElementById('incidentBranchFilter');
        const incidentSearchInput = document.getElementById('incidentSearchInput');
        const attendanceIncidentTableBody = document.getElementById('attendanceIncidentTableBody');
        let departmentAttendanceChart = null;

        const attendanceRecords = [
            {
                name: 'Cabdiraxmaan Cali',
                employeeId: 'EMP-0001',
                department: 'Human Resource',
                branch: 'Idaacada Branch',
                checkInDate: '2026-04-25',
                checkInTime: '07:58 AM',
                workHour: '08h 12m',
                minutesLate: 0,
                status: 'Present',
                checkedOut: true,
                outOfWindow: false
            },
            {
                name: 'Fadumo Xasan',
                employeeId: 'EMP-0002',
                department: 'Finance',
                branch: 'Xero Awr Branch',
                checkInDate: '2026-04-25',
                checkInTime: '08:17 AM',
                workHour: '07h 43m',
                minutesLate: 17,
                status: 'Late',
                checkedOut: true,
                outOfWindow: true
            },
            {
                name: 'Mahad Axmed',
                employeeId: 'EMP-0003',
                department: 'Operations',
                branch: 'Togdheer Branch',
                checkInDate: '2026-04-25',
                checkInTime: '--',
                workHour: '00h 00m',
                minutesLate: 0,
                status: 'Absent',
                checkedOut: false,
                outOfWindow: false
            },
            {
                name: 'Sahra Maxamed',
                employeeId: 'EMP-0004',
                department: 'Marketing',
                branch: 'Calaamada Branch',
                checkInDate: '2026-04-25',
                checkInTime: '07:41 AM',
                workHour: '06h 54m',
                minutesLate: 0,
                status: 'Early',
                checkedOut: true,
                outOfWindow: false
            },
            {
                name: 'Hodan Ali',
                employeeId: 'EMP-0005',
                department: 'Administration',
                branch: 'Masalaha Branch',
                checkInDate: '2026-04-25',
                checkInTime: '08:04 AM',
                workHour: '07h 58m',
                minutesLate: 4,
                status: 'Present',
                checkedOut: true,
                outOfWindow: false
            },
            {
                name: 'Mustafe Cabdi',
                employeeId: 'EMP-0006',
                department: 'Information Technology',
                branch: 'Jigjiga Yar Branch',
                checkInDate: '2026-04-25',
                checkInTime: '08:26 AM',
                workHour: '07h 11m',
                minutesLate: 26,
                status: 'Late',
                checkedOut: false,
                outOfWindow: true
            },
            {
                name: 'Amina Yusuf',
                employeeId: 'EMP-0007',
                department: 'Human Resource',
                branch: 'Idaacada Branch',
                checkInDate: '2026-04-25',
                checkInTime: '08:00 AM',
                workHour: '08h 01m',
                minutesLate: 0,
                status: 'Present',
                checkedOut: true,
                outOfWindow: false
            },
            {
                name: 'Roda Jama',
                employeeId: 'EMP-0008',
                department: 'Finance',
                branch: 'Xero Awr Branch',
                checkInDate: '2026-04-25',
                checkInTime: '--',
                workHour: '00h 00m',
                minutesLate: 0,
                status: 'Absent',
                checkedOut: false,
                outOfWindow: false
            },
            {
                name: 'Sakariye Noor',
                employeeId: 'EMP-0009',
                department: 'Operations',
                branch: 'Togdheer Branch',
                checkInDate: '2026-04-25',
                checkInTime: '07:46 AM',
                workHour: '08h 05m',
                minutesLate: 0,
                status: 'Early',
                checkedOut: true,
                outOfWindow: false
            },
            {
                name: 'Nimco Ahmed',
                employeeId: 'EMP-0010',
                department: 'Marketing',
                branch: 'Calaamada Branch',
                checkInDate: '2026-04-25',
                checkInTime: '08:09 AM',
                workHour: '07h 37m',
                minutesLate: 9,
                status: 'Late',
                checkedOut: false,
                outOfWindow: true
            }
        ];

        const notYetRegisteredEmployees = 3;

        const additionalAttendanceIncidents = [
            { employeeId: 'EMP-0001', name: 'Cabdiraxmaan Cali', department: 'Human Resource', branch: 'Idaacada Branch', outOfWindow: false, lateCheckIn: false, earlyCheckOut: true, missedAttendance: false },
            { employeeId: 'EMP-0001', name: 'Cabdiraxmaan Cali', department: 'Human Resource', branch: 'Idaacada Branch', outOfWindow: true, lateCheckIn: true, earlyCheckOut: false, missedAttendance: false },
            { employeeId: 'EMP-0002', name: 'Fadumo Xasan', department: 'Finance', branch: 'Xero Awr Branch', outOfWindow: true, lateCheckIn: true, earlyCheckOut: false, missedAttendance: false },
            { employeeId: 'EMP-0002', name: 'Fadumo Xasan', department: 'Finance', branch: 'Xero Awr Branch', outOfWindow: false, lateCheckIn: false, earlyCheckOut: true, missedAttendance: false },
            { employeeId: 'EMP-0003', name: 'Mahad Axmed', department: 'Operations', branch: 'Togdheer Branch', outOfWindow: false, lateCheckIn: false, earlyCheckOut: false, missedAttendance: true },
            { employeeId: 'EMP-0003', name: 'Mahad Axmed', department: 'Operations', branch: 'Togdheer Branch', outOfWindow: false, lateCheckIn: false, earlyCheckOut: false, missedAttendance: true },
            { employeeId: 'EMP-0004', name: 'Sahra Maxamed', department: 'Marketing', branch: 'Calaamada Branch', outOfWindow: false, lateCheckIn: false, earlyCheckOut: true, missedAttendance: false },
            { employeeId: 'EMP-0005', name: 'Hodan Ali', department: 'Administration', branch: 'Masalaha Branch', outOfWindow: false, lateCheckIn: true, earlyCheckOut: false, missedAttendance: false },
            { employeeId: 'EMP-0006', name: 'Mustafe Cabdi', department: 'Information Technology', branch: 'Jigjiga Yar Branch', outOfWindow: true, lateCheckIn: true, earlyCheckOut: true, missedAttendance: false },
            { employeeId: 'EMP-0007', name: 'Amina Yusuf', department: 'Human Resource', branch: 'Idaacada Branch', outOfWindow: false, lateCheckIn: false, earlyCheckOut: false, missedAttendance: false },
            { employeeId: 'EMP-0008', name: 'Roda Jama', department: 'Finance', branch: 'Xero Awr Branch', outOfWindow: false, lateCheckIn: false, earlyCheckOut: false, missedAttendance: true },
            { employeeId: 'EMP-0009', name: 'Sakariye Noor', department: 'Operations', branch: 'Togdheer Branch', outOfWindow: false, lateCheckIn: false, earlyCheckOut: true, missedAttendance: false },
            { employeeId: 'EMP-0010', name: 'Nimco Ahmed', department: 'Marketing', branch: 'Calaamada Branch', outOfWindow: true, lateCheckIn: true, earlyCheckOut: false, missedAttendance: false }
        ];

        const attendanceCardConfig = [
            { key: 'presentToday', label: 'Present Today', border: 'border-emerald-500', iconBg: 'bg-emerald-50', iconColor: 'text-emerald-600', icon: 'fa-user-check', helper: 'Employees marked present today' },
            { key: 'lateArrivals', label: 'Late Arrivals', border: 'border-amber-500', iconBg: 'bg-amber-50', iconColor: 'text-amber-600', icon: 'fa-clock', helper: 'Late check-ins recorded today' },
            { key: 'absent', label: 'Absent', border: 'border-rose-500', iconBg: 'bg-rose-50', iconColor: 'text-rose-600', icon: 'fa-user-xmark', helper: 'Employees absent from duty today' },
            { key: 'checkInVsCheckOut', label: 'Check In vs Check Out', border: 'border-sky-500', iconBg: 'bg-sky-50', iconColor: 'text-sky-600', icon: 'fa-right-left', helper: 'Checked in compared to checked out' },
            { key: 'outOfWindow', label: 'Out of Window', border: 'border-indigo-500', iconBg: 'bg-indigo-50', iconColor: 'text-indigo-600', icon: 'fa-triangle-exclamation', helper: 'Check-ins outside allowed time window' },
            { key: 'notYetRegistered', label: 'Not Yet Registered', border: 'border-slate-500', iconBg: 'bg-slate-100', iconColor: 'text-slate-600', icon: 'fa-user-clock', helper: 'Employees not yet registered today' }
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
            if (status === 'Late') {
                return 'status-late';
            }

            if (status === 'Absent') {
                return 'status-absent';
            }

            if (status === 'Early') {
                return 'status-early';
            }

            return 'status-present';
        }

        function buildAttendanceSummary() {
            const presentToday = attendanceRecords.filter(record => record.status === 'Present').length;
            const lateArrivals = attendanceRecords.filter(record => record.status === 'Late').length;
            const absent = attendanceRecords.filter(record => record.status === 'Absent').length;
            const checkIns = attendanceRecords.filter(record => record.checkInTime !== '--').length;
            const checkOuts = attendanceRecords.filter(record => record.checkedOut).length;
            const outOfWindow = attendanceRecords.filter(record => record.outOfWindow).length;

            return {
                presentToday: String(presentToday),
                lateArrivals: String(lateArrivals),
                absent: String(absent),
                checkInVsCheckOut: `${checkIns} / ${checkOuts}`,
                outOfWindow: String(outOfWindow),
                notYetRegistered: String(notYetRegisteredEmployees)
            };
        }

        function buildAttendanceIncidentRows() {
            const todayDerivedIncidents = attendanceRecords.map(record => ({
                employeeId: record.employeeId,
                name: record.name,
                department: record.department,
                branch: record.branch,
                outOfWindow: record.outOfWindow,
                lateCheckIn: record.status === 'Late',
                earlyCheckOut: record.status === 'Early',
                missedAttendance: record.status === 'Absent'
            }));

            const incidentMap = {};

            [...todayDerivedIncidents, ...additionalAttendanceIncidents].forEach(incident => {
                if (!incidentMap[incident.employeeId]) {
                    incidentMap[incident.employeeId] = {
                        employeeId: incident.employeeId,
                        name: incident.name,
                        department: incident.department,
                        branch: incident.branch,
                        outOfWindow: 0,
                        lateCheckIn: 0,
                        earlyCheckOut: 0,
                        missedAttendance: 0
                    };
                }

                incidentMap[incident.employeeId].outOfWindow += incident.outOfWindow ? 1 : 0;
                incidentMap[incident.employeeId].lateCheckIn += incident.lateCheckIn ? 1 : 0;
                incidentMap[incident.employeeId].earlyCheckOut += incident.earlyCheckOut ? 1 : 0;
                incidentMap[incident.employeeId].missedAttendance += incident.missedAttendance ? 1 : 0;
            });

            return Object.values(incidentMap).sort((a, b) => a.name.localeCompare(b.name));
        }

        function populateIncidentFilters() {
            const incidentRows = buildAttendanceIncidentRows();
            const departments = [...new Set(incidentRows.map(row => row.department))];
            const branches = [...new Set(incidentRows.map(row => row.branch))];

            incidentDepartmentFilter.innerHTML = ['<option value="all">All Departments</option>', ...departments.map(department => `<option value="${department}">${department}</option>`)].join('');
            incidentBranchFilter.innerHTML = ['<option value="all">All Branches</option>', ...branches.map(branch => `<option value="${branch}">${branch}</option>`)].join('');
        }

        function renderInsightCards() {
            const attendanceSummary = buildAttendanceSummary();

            attendanceInsightCards.innerHTML = attendanceCardConfig.map(card => `
                <div class="glass-card insight-card border-l-4 ${card.border} p-5">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-500">${card.label}</p>
                            <h3 class="mt-2 text-2xl font-bold text-slate-800">${attendanceSummary[card.key]}</h3>
                        </div>
                        <div class="rounded-xl ${card.iconBg} p-3 ${card.iconColor}">
                            <i class="fa-solid ${card.icon} text-lg"></i>
                        </div>
                    </div>
                    <p class="mt-4 text-[11px] font-medium text-slate-400">${card.helper}</p>
                </div>
            `).join('');
        }

        function buildDepartmentAttendanceData() {
            const departmentSummary = {};

            attendanceRecords.forEach(record => {
                if (!departmentSummary[record.department]) {
                    departmentSummary[record.department] = 0;
                }

                if (record.status !== 'Absent') {
                    departmentSummary[record.department] += 1;
                }
            });

            return {
                labels: Object.keys(departmentSummary),
                values: Object.values(departmentSummary)
            };
        }

        function renderDepartmentAttendanceChart() {
            if (!departmentAttendanceChartCanvas || typeof Chart === 'undefined') {
                return;
            }

            const departmentData = buildDepartmentAttendanceData();

            if (departmentAttendanceChart) {
                departmentAttendanceChart.destroy();
            }

            departmentAttendanceChart = new Chart(departmentAttendanceChartCanvas, {
                type: 'pie',
                data: {
                    labels: departmentData.labels,
                    datasets: [{
                        data: departmentData.values,
                        backgroundColor: ['#4f46e5', '#10b981', '#f59e0b', '#ef4444', '#0ea5e9', '#8b5cf6'],
                        borderColor: '#ffffff',
                        borderWidth: 4,
                        hoverOffset: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
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

        function renderTodayAttendanceTable() {
            todayAttendanceTableBody.innerHTML = attendanceRecords.map(record => `
                <tr class="transition-colors hover:bg-slate-50/70">
                    <td class="px-4 py-4">
                        <div>
                            <p class="text-sm font-semibold text-slate-700">${record.name}</p>
                            <p class="text-[11px] text-slate-400">${record.employeeId}</p>
                        </div>
                    </td>
                    <td class="px-4 py-4 text-sm text-slate-600">${record.department}</td>
                    <td class="px-4 py-4 text-sm text-slate-600">${record.branch}</td>
                    <td class="px-4 py-4 text-sm text-slate-600">${record.checkInTime} <span class="text-slate-400">|</span> ${record.checkInDate}</td>
                    <td class="px-4 py-4 text-sm text-slate-600">${record.workHour}</td>
                    <td class="px-4 py-4 text-sm text-slate-600">${record.minutesLate}</td>
                    <td class="px-4 py-4"><span class="status-pill ${getStatusClass(record.status)}">${record.status}</span></td>
                </tr>
            `).join('');
        }

        function renderAttendanceIncidentTable() {
            const departmentFilter = incidentDepartmentFilter.value || 'all';
            const branchFilter = incidentBranchFilter.value || 'all';
            const searchValue = (incidentSearchInput.value || '').trim().toLowerCase();

            const filteredRows = buildAttendanceIncidentRows().filter(row => {
                const matchesDepartment = departmentFilter === 'all' || row.department === departmentFilter;
                const matchesBranch = branchFilter === 'all' || row.branch === branchFilter;
                const matchesSearch = searchValue === ''
                    || row.name.toLowerCase().includes(searchValue)
                    || row.employeeId.toLowerCase().includes(searchValue);

                return matchesDepartment && matchesBranch && matchesSearch;
            });

            attendanceIncidentTableBody.innerHTML = filteredRows.map(row => `
                <tr class="transition-colors hover:bg-slate-50/70">
                    <td class="px-4 py-4">
                        <div>
                            <p class="text-sm font-semibold text-slate-700">${row.name}</p>
                            <p class="text-[11px] text-slate-400">${row.employeeId}</p>
                        </div>
                    </td>
                    <td class="px-4 py-4 text-sm text-slate-600">${row.department}</td>
                    <td class="px-4 py-4 text-sm text-slate-600">${row.branch}</td>
                    <td class="px-4 py-4 text-sm text-slate-600">${row.outOfWindow}</td>
                    <td class="px-4 py-4 text-sm text-slate-600">${row.lateCheckIn}</td>
                    <td class="px-4 py-4 text-sm text-slate-600">${row.earlyCheckOut}</td>
                    <td class="px-4 py-4 text-sm text-slate-600">${row.missedAttendance}</td>
                </tr>
            `).join('');

            if (!filteredRows.length) {
                attendanceIncidentTableBody.innerHTML = `
                    <tr>
                        <td colspan="7" class="px-4 py-8 text-center text-sm text-slate-400">No employees matched the selected filters.</td>
                    </tr>
                `;
            }
        }

        sidebarToggle.addEventListener('click', handleSidebarToggle);
        sidebarOverlay.addEventListener('click', closeMobileSidebar);
        window.addEventListener('resize', syncSidebarMode);
        incidentDepartmentFilter.addEventListener('change', renderAttendanceIncidentTable);
        incidentBranchFilter.addEventListener('change', renderAttendanceIncidentTable);
        incidentSearchInput.addEventListener('input', renderAttendanceIncidentTable);

        renderInsightCards();
        renderDepartmentAttendanceChart();
        renderTodayAttendanceTable();
        populateIncidentFilters();
        renderAttendanceIncidentTable();
        syncSidebarMode();
    </script>
</body>
</html>
