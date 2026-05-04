<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRM System - Employee List</title>
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
            #employeeMain {
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
    <?php $currentMenu = 'employees'; ?>
    <?php include __DIR__ . '/../../includes/header_sidebar.php'; ?>

    <div class="mx-auto w-full max-w-[1440px] p-4 md:p-8">
        <div class="mb-8 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-slate-800">Employees</h2>
                <p class="text-sm text-slate-500">Manage employee records, status, and onboarding details.</p>
            </div>
        </div>

        <div class="mb-8 grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-5">
            <div class="glass-card insight-card border-l-4 border-indigo-500 p-5">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Total Employees</p>
                        <h3 class="mt-2 text-2xl font-bold text-slate-800">1,420</h3>
                    </div>
                    <div class="rounded-xl bg-indigo-50 p-3 text-indigo-600">
                        <i class="fa-solid fa-users text-lg"></i>
                    </div>
                </div>
                <p class="mt-4 text-[11px] font-medium text-slate-400">Across all active branches</p>
            </div>

            <div class="glass-card insight-card border-l-4 border-emerald-500 p-5">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Active Employees</p>
                        <h3 class="mt-2 text-2xl font-bold text-slate-800">1,284</h3>
                    </div>
                    <div class="rounded-xl bg-emerald-50 p-3 text-emerald-600">
                        <i class="fa-solid fa-user-check text-lg"></i>
                    </div>
                </div>
                <p class="mt-4 text-[11px] font-medium text-slate-400">Currently active in the system</p>
            </div>

            <div class="glass-card insight-card border-l-4 border-amber-500 p-5">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">On Leave Employees</p>
                        <h3 class="mt-2 text-2xl font-bold text-slate-800">46</h3>
                    </div>
                    <div class="rounded-xl bg-amber-50 p-3 text-amber-600">
                        <i class="fa-solid fa-umbrella-beach text-lg"></i>
                    </div>
                </div>
                <p class="mt-4 text-[11px] font-medium text-slate-400">Approved leave requests this month</p>
            </div>

            <div class="glass-card insight-card border-l-4 border-sky-500 p-5">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">New This Month</p>
                        <h3 class="mt-2 text-2xl font-bold text-slate-800">38</h3>
                    </div>
                    <div class="rounded-xl bg-sky-50 p-3 text-sky-600">
                        <i class="fa-solid fa-user-plus text-lg"></i>
                    </div>
                </div>
                <p class="mt-4 text-[11px] font-medium text-slate-400">Newly added employee profiles</p>
            </div>

            <div class="glass-card insight-card border-l-4 border-rose-500 p-5">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Least Performing</p>
                        <h3 class="mt-2 text-xl font-bold text-slate-800">Ahmed Jama</h3>
                    </div>
                    <div class="rounded-xl bg-rose-50 p-3 text-rose-600">
                        <i class="fa-solid fa-arrow-trend-down text-lg"></i>
                    </div>
                </div>
                <p class="mt-4 text-[11px] font-medium text-slate-400">Marketing &middot; 69% performance score</p>
            </div>
        </div>

        <div class="glass-card mb-6 p-6">
            <div class="mb-5 flex items-center justify-between">
                <div>
                    <h3 class="text-base font-semibold text-slate-800">Filters</h3>
                    <p class="text-xs text-slate-400">Refine the employee list by branch, department, date, and search term.</p>
                </div>
                <div class="rounded-xl bg-slate-50 p-3 text-slate-500">
                    <i class="fa-solid fa-sliders text-sm"></i>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
                <div>
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500">Branch</label>
                    <select class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-600 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                        <option>All Hargeisa Branches</option>
                        <option>Idaacada Branch</option>
                        <option>Xero Awr Branch</option>
                        <option>Togdheer Branch</option>
                        <option>Calaamada Branch</option>
                        <option>Masalaha Branch</option>
                        <option>Jigjiga Yar Branch</option>
                    </select>
                </div>

                <div>
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500">Department</label>
                    <select class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-600 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                        <option>All Departments</option>
                        <option>Human Resource</option>
                        <option>Finance</option>
                        <option>Operations</option>
                        <option>Marketing</option>
                    </select>
                </div>

                <div>
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500">Date</label>
                    <input type="date" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-600 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                </div>

                <div>
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500">Search By Name Or Number</label>
                    <div class="flex items-center rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 focus-within:border-indigo-400 focus-within:ring-2 focus-within:ring-indigo-100">
                        <i class="fa-solid fa-magnifying-glass mr-3 text-sm text-slate-400"></i>
                        <input type="text" placeholder="Search employee..." class="w-full bg-transparent text-sm text-slate-600 outline-none">
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h3 class="text-base font-semibold text-slate-800">Employee Records</h3>
                <p class="text-xs text-slate-400">Review employee details and manage records from one place.</p>
            </div>
            <button type="button" id="openAddEmployeeModal" class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-100 transition hover:bg-indigo-700">
                <i class="fa-solid fa-plus text-xs"></i>
                <span>Add Employee</span>
            </button>
        </div>

        <div class="glass-card overflow-hidden">
            <div class="table-scroll overflow-x-auto">
                <table class="min-w-full text-left">
                    <thead>
                        <tr class="border-b border-slate-100 text-[11px] uppercase tracking-wider text-slate-400">
                            <th class="px-6 py-4 font-semibold">Full Name</th>
                            <th class="px-6 py-4 font-semibold">Department</th>
                            <th class="px-6 py-4 font-semibold">Branch</th>
                            <th class="px-6 py-4 font-semibold">Join Date</th>
                            <th class="px-6 py-4 font-semibold">Status</th>
                            <th class="px-6 py-4 font-semibold">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        <tr class="transition-colors hover:bg-slate-50/70">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="/HRMS/ceo.jpg" alt="Employee" class="h-10 w-10 rounded-full border border-slate-200 bg-slate-100">
                                    <div>
                                        <p class="text-sm font-semibold text-slate-700">Cabdiraxmaan Cali</p>
                                        <p class="text-[11px] text-slate-400">EMP-0001</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-slate-600">Human Resource</td>
                            <td class="px-6 py-4 text-sm text-slate-500">Idaacada Branch</td>
                            <td class="px-6 py-4 text-sm text-slate-500">2024-01-12</td>
                            <td class="px-6 py-4"><span class="status-pill status-active">Active</span></td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <a href="view_employee.php" class="view-employee-link flex h-9 w-9 items-center justify-center rounded-lg bg-slate-50 text-slate-500 transition hover:bg-indigo-50 hover:text-indigo-600" data-name="Cabdiraxmaan Cali" data-employee-number="EMP-0001" data-department="Human Resource" data-branch="Idaacada Branch" data-join-date="2024-01-12" data-status="Active" data-status-class="status-active" data-avatar="/HRMS/ceo.jpg" data-designation="Human Resource Director" data-phone="+252 61 555 0101" data-email="cabdiraxmaan.cali@hrms.local" data-location="Idaacada, Hargeisa" data-gender="Male" data-dob="1992-04-18" data-employment-type="Full Time" data-reporting-manager="Asha Mohamed"><i class="fa-regular fa-eye text-sm"></i></a>
                                    <button class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-50 text-slate-500 transition hover:bg-amber-50 hover:text-amber-600"><i class="fa-regular fa-pen-to-square text-sm"></i></button>
                                    <button class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-50 text-slate-500 transition hover:bg-rose-50 hover:text-rose-600"><i class="fa-solid fa-user-slash text-sm"></i></button>
                                </div>
                            </td>
                        </tr>

                        <tr class="transition-colors hover:bg-slate-50/70">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="/HRMSDemo/ceo.jpg" alt="Employee" class="h-10 w-10 rounded-full border border-slate-200 bg-slate-100">
                                    <div>
                                        <p class="text-sm font-semibold text-slate-700">Fadumo Xasan</p>
                                        <p class="text-[11px] text-slate-400">EMP-0002</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-slate-600">Finance</td>
                            <td class="px-6 py-4 text-sm text-slate-500">Xero Awr Branch</td>
                            <td class="px-6 py-4 text-sm text-slate-500">2023-11-07</td>
                            <td class="px-6 py-4"><span class="status-pill status-leave">On Leave</span></td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <a href="view_employee.php" class="view-employee-link flex h-9 w-9 items-center justify-center rounded-lg bg-slate-50 text-slate-500 transition hover:bg-indigo-50 hover:text-indigo-600" data-name="Fadumo Xasan" data-employee-number="EMP-0002" data-department="Finance" data-branch="Xero Awr Branch" data-join-date="2023-11-07" data-status="On Leave" data-status-class="status-leave" data-avatar="/HRMS/ceo.jpg" data-designation="Finance Officer" data-phone="+252 63 555 0202" data-email="fadumo.xasan@hrms.local" data-location="Xero Awr, Hargeisa" data-gender="Female" data-dob="1994-07-09" data-employment-type="Full Time" data-reporting-manager="Mohamed Yusuf"><i class="fa-regular fa-eye text-sm"></i></a>
                                    <button class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-50 text-slate-500 transition hover:bg-amber-50 hover:text-amber-600"><i class="fa-regular fa-pen-to-square text-sm"></i></button>
                                    <button class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-50 text-slate-500 transition hover:bg-rose-50 hover:text-rose-600"><i class="fa-solid fa-user-slash text-sm"></i></button>
                                </div>
                            </td>
                        </tr>

                        <tr class="transition-colors hover:bg-slate-50/70">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="/HRMS/ceo.jpg" alt="Employee" class="h-10 w-10 rounded-full border border-slate-200 bg-slate-100">
                                    <div>
                                        <p class="text-sm font-semibold text-slate-700">Mahad Axmed</p>
                                        <p class="text-[11px] text-slate-400">EMP-0003</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-slate-600">Operations</td>
                            <td class="px-6 py-4 text-sm text-slate-500">Togdheer Branch</td>
                            <td class="px-6 py-4 text-sm text-slate-500">2022-08-16</td>
                            <td class="px-6 py-4"><span class="status-pill status-active">Active</span></td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <a href="view_employee.php" class="view-employee-link flex h-9 w-9 items-center justify-center rounded-lg bg-slate-50 text-slate-500 transition hover:bg-indigo-50 hover:text-indigo-600" data-name="Mahad Axmed" data-employee-number="EMP-0003" data-department="Operations" data-branch="Togdheer Branch" data-join-date="2022-08-16" data-status="Active" data-status-class="status-active" data-avatar="/HRMS/ceo.jpg" data-designation="Operations Supervisor" data-phone="+252 65 555 0303" data-email="mahad.axmed@hrms.local" data-location="Togdheer, Hargeisa" data-gender="Male" data-dob="1990-12-01" data-employment-type="Full Time" data-reporting-manager="Hodan Ali"><i class="fa-regular fa-eye text-sm"></i></a>
                                    <button class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-50 text-slate-500 transition hover:bg-amber-50 hover:text-amber-600"><i class="fa-regular fa-pen-to-square text-sm"></i></button>
                                    <button class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-50 text-slate-500 transition hover:bg-rose-50 hover:text-rose-600"><i class="fa-solid fa-user-slash text-sm"></i></button>
                                </div>
                            </td>
                        </tr>

                        <tr class="transition-colors hover:bg-slate-50/70">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="/HRMS/ceo.jpg" alt="Employee" class="h-10 w-10 rounded-full border border-slate-200 bg-slate-100">
                                    <div>
                                        <p class="text-sm font-semibold text-slate-700">Sahra Maxamed</p>
                                        <p class="text-[11px] text-slate-400">EMP-0004</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-slate-600">Marketing</td>
                            <td class="px-6 py-4 text-sm text-slate-500">Calaamada Branch</td>
                            <td class="px-6 py-4 text-sm text-slate-500">2024-03-03</td>
                            <td class="px-6 py-4"><span class="status-pill status-inactive">Inactive</span></td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <a href="view_employee.php" class="view-employee-link flex h-9 w-9 items-center justify-center rounded-lg bg-slate-50 text-slate-500 transition hover:bg-indigo-50 hover:text-indigo-600" data-name="Sahra Maxamed" data-employee-number="EMP-0004" data-department="Marketing" data-branch="Calaamada Branch" data-join-date="2024-03-03" data-status="Inactive" data-status-class="status-inactive" data-avatar="/HRMS/ceo.jpg" data-designation="Marketing Coordinator" data-phone="+252 62 555 0404" data-email="sahra.maxamed@hrms.local" data-location="Calaamada, Hargeisa" data-gender="Female" data-dob="1996-01-23" data-employment-type="Contract" data-reporting-manager="Ahmed Jama"><i class="fa-regular fa-eye text-sm"></i></a>
                                    <button class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-50 text-slate-500 transition hover:bg-amber-50 hover:text-amber-600"><i class="fa-regular fa-pen-to-square text-sm"></i></button>
                                    <button class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-50 text-slate-500 transition hover:bg-rose-50 hover:text-rose-600"><i class="fa-solid fa-user-slash text-sm"></i></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="addEmployeeModal" class="fixed inset-0 z-[60] hidden items-center justify-center p-4 sm:p-6">
        <div class="modal-backdrop absolute inset-0"></div>
        <div class="glass-card dialog-panel relative z-10 mx-auto flex max-h-[calc(100vh-3rem)] w-full max-w-xl flex-col overflow-hidden">
            <div class="flex items-center justify-between border-b border-slate-100 px-6 py-5 sm:px-7">
                <div>
                    <h3 class="text-lg font-semibold text-slate-800">Add Employee</h3>
                    <p class="text-xs text-slate-400">Basic information and document placeholders only.</p>
                </div>
                <button type="button" id="closeAddEmployeeModal" class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-50 text-slate-500 transition hover:bg-slate-100 hover:text-slate-700">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <div class="max-h-[calc(100vh-13rem)] overflow-y-auto p-6 sm:px-7 sm:pb-7">
                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500">Full Name</label>
                        <input type="text" placeholder="Enter full name" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-600 outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                    </div>

                    <div>
                        <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500">Employee Number</label>
                        <input type="text" placeholder="EMP-0005" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-600 outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                    </div>

                    <div>
                        <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500">Branch</label>
                        <select class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-600 outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                            <option>Select branch</option>
                            <option>Idaacada Branch</option>
                            <option>Xero Awr Branch</option>
                            <option>Togdheer Branch</option>
                            <option>Calaamada Branch</option>
                            <option>Masalaha Branch</option>
                            <option>Jigjiga Yar Branch</option>
                        </select>
                    </div>

                    <div>
                        <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500">Department</label>
                        <select class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-600 outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                            <option>Select department</option>
                            <option>Human Resource</option>
                            <option>Finance</option>
                            <option>Operations</option>
                            <option>Marketing</option>
                        </select>
                    </div>

                    <div>
                        <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500">Phone Number</label>
                        <input type="text" placeholder="+252 61 555 0000" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-600 outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                    </div>

                    <div>
                        <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500">Join Date</label>
                        <input type="date" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-600 outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                    </div>
                </div>

                <div class="mt-6">
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500">Document Upload Placeholder</label>
                    <div class="rounded-2xl border-2 border-dashed border-slate-200 bg-slate-50 px-6 py-10 text-center">
                        <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600">
                            <i class="fa-solid fa-cloud-arrow-up text-xl"></i>
                        </div>
                        <p class="text-sm font-medium text-slate-600">Upload employee documents</p>
                        <p class="mt-1 text-xs text-slate-400">National ID, contract, certificates, and profile attachments.</p>
                        <button type="button" class="mt-4 rounded-xl border border-slate-200 bg-white px-4 py-2 text-xs font-semibold text-slate-600 transition hover:bg-slate-100">
                            Choose Files
                        </button>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 border-t border-slate-100 px-6 py-4">
                <button type="button" id="cancelAddEmployeeModal" class="rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50">
                    Cancel
                </button>
                <button type="button" class="rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-indigo-100 transition hover:bg-indigo-700">
                    Save Employee
                </button>
            </div>
        </div>
    </div>

    <script>
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const desktopSidebarBreakpoint = window.matchMedia('(min-width: 1024px)');
        const addEmployeeModal = document.getElementById('addEmployeeModal');
        const openAddEmployeeModal = document.getElementById('openAddEmployeeModal');
        const closeAddEmployeeModal = document.getElementById('closeAddEmployeeModal');
        const cancelAddEmployeeModal = document.getElementById('cancelAddEmployeeModal');
        const viewEmployeeLinks = document.querySelectorAll('.view-employee-link');

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

        function showAddEmployeeModal() {
            addEmployeeModal.classList.remove('hidden');
            addEmployeeModal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
        }

        function hideAddEmployeeModal() {
            addEmployeeModal.classList.add('hidden');
            addEmployeeModal.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        }

        function openEmployeeView(event) {
            event.preventDefault();

            const baseUrl = event.currentTarget.getAttribute('href');
            const employeeParams = new URLSearchParams(event.currentTarget.dataset);

            window.location.href = `${baseUrl}?${employeeParams.toString()}`;
        }

        sidebarToggle.addEventListener('click', handleSidebarToggle);
        sidebarOverlay.addEventListener('click', closeMobileSidebar);
        window.addEventListener('resize', syncSidebarMode);
        openAddEmployeeModal.addEventListener('click', showAddEmployeeModal);
        closeAddEmployeeModal.addEventListener('click', hideAddEmployeeModal);
        cancelAddEmployeeModal.addEventListener('click', hideAddEmployeeModal);
        viewEmployeeLinks.forEach(link => {
            link.addEventListener('click', openEmployeeView);
        });
        addEmployeeModal.addEventListener('click', function (event) {
            if (event.target === addEmployeeModal || event.target.classList.contains('modal-backdrop')) {
                hideAddEmployeeModal();
            }
        });

        syncSidebarMode();
    </script>
</body>
</html>
