<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRM System - Payroll Integration</title>
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
    <?php $currentMenu = 'payroll_integration'; ?>
    <?php include __DIR__ . '/../../includes/header_sidebar.php'; ?>

    <div class="mx-auto w-full max-w-[1440px] p-4 md:p-8">
        <div class="mb-8 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-slate-800">Payroll Integration</h2>
                <p class="text-sm text-slate-500">Payroll integration workspace.</p>
            </div>
        </div>

        <div class="mb-8 grid grid-cols-1 gap-5 md:grid-cols-3">
            <div class="glass-card insight-card border-l-4 border-indigo-500 p-5">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Total Deductions</p>
                        <h3 id="totalDeductionsCard" class="mt-2 text-2xl font-bold text-slate-800">$0</h3>
                    </div>
                    <div class="rounded-xl bg-indigo-50 p-3 text-indigo-600">
                        <i class="fa-solid fa-file-invoice-dollar text-lg"></i>
                    </div>
                </div>
                <p class="mt-4 text-[11px] font-medium text-slate-400">All deductions for this payroll run</p>
            </div>

            <div class="glass-card insight-card border-l-4 border-amber-500 p-5">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Absence Deductions</p>
                        <h3 id="absenceDeductionsCard" class="mt-2 text-2xl font-bold text-slate-800">$0</h3>
                    </div>
                    <div class="rounded-xl bg-amber-50 p-3 text-amber-600">
                        <i class="fa-solid fa-user-clock text-lg"></i>
                    </div>
                </div>
                <p class="mt-4 text-[11px] font-medium text-slate-400">Deductions from absence and late attendance</p>
            </div>

            <div class="glass-card insight-card border-l-4 border-rose-500 p-5">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Perfomance Deductions</p>
                        <h3 id="performanceDeductionsCard" class="mt-2 text-2xl font-bold text-slate-800">$0</h3>
                    </div>
                    <div class="rounded-xl bg-rose-50 p-3 text-rose-600">
                        <i class="fa-solid fa-arrow-trend-down text-lg"></i>
                    </div>
                </div>
                <p class="mt-4 text-[11px] font-medium text-slate-400">Deductions from low perfomance reviews</p>
            </div>
        </div>

        <div class="glass-card p-6">
            <div class="mb-5">
                <h3 class="text-base font-semibold text-slate-800">Employee Payroll Deductions</h3>
                <p class="text-xs text-slate-400">Employee salary list with absence and perfomance deductions.</p>
            </div>
            <div class="table-scroll overflow-x-auto">
                <table class="min-w-full text-left">
                    <thead>
                        <tr class="border-b border-slate-100 text-[11px] uppercase tracking-wider text-slate-400">
                            <th class="px-4 py-4 font-semibold">Employee Name &amp; ID</th>
                            <th class="px-4 py-4 font-semibold">Department</th>
                            <th class="px-4 py-4 font-semibold">Branch</th>
                            <th class="px-4 py-4 font-semibold">Original Salary</th>
                            <th class="px-4 py-4 font-semibold">Absence Deduction</th>
                            <th class="px-4 py-4 font-semibold">Perfomance Deduction</th>
                            <th class="px-4 py-4 font-semibold">Total Deduction</th>
                            <th class="px-4 py-4 font-semibold">Net Salary</th>
                        </tr>
                    </thead>
                    <tbody id="payrollDeductionTableBody" class="divide-y divide-slate-50"></tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<script>
    const sidebarToggle = document.getElementById('sidebarToggle');
    const mobileSidebarToggle = document.getElementById('mobileSidebarToggle');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    const payrollDeductionTableBody = document.getElementById('payrollDeductionTableBody');

    const payrollRecords = [
        { name: 'Cabdiraxmaan Cali', employeeId: 'EMP-0001', department: 'Human Resource Manager', branch: 'Idaacada Branch', originalSalary: 850, absenceDeduction: 15, performanceDeduction: 0 },
        { name: 'Fadumo Xasan', employeeId: 'EMP-0002', department: 'Head of Finances', branch: 'Xero Awr Branch', originalSalary: 920, absenceDeduction: 20, performanceDeduction: 0 },
        { name: 'Mahad Axmed', employeeId: 'EMP-0003', department: 'Operations Manager', branch: 'Togdheer Branch', originalSalary: 880, absenceDeduction: 35, performanceDeduction: 0 },
        { name: 'Sahra Maxamed', employeeId: 'EMP-0004', department: 'Marketing Manager', branch: 'Calaamada Branch', originalSalary: 650, absenceDeduction: 25, performanceDeduction: 30 },
        { name: 'Hodan Ali', employeeId: 'EMP-0005', department: 'Manager', branch: 'Masalaha Branch', originalSalary: 720, absenceDeduction: 10, performanceDeduction: 0 },
        { name: 'Mustafe Cabdi', employeeId: 'EMP-0006', department: 'IT Manager', branch: 'Jigjiga Yar Branch', originalSalary: 780, absenceDeduction: 45, performanceDeduction: 15 },
        { name: 'Roda Jama', employeeId: 'EMP-0007', department: 'Head of Finances', branch: 'Xero Awr Branch', originalSalary: 800, absenceDeduction: 0, performanceDeduction: 0 },
        { name: 'Amina Yusuf', employeeId: 'EMP-0008', department: 'Human Resource Manager', branch: 'Idaacada Branch', originalSalary: 760, absenceDeduction: 0, performanceDeduction: 0 },
        { name: 'Ahmed Jama', employeeId: 'EMP-0009', department: 'Marketing Manager', branch: 'Calaamada Branch', originalSalary: 620, absenceDeduction: 40, performanceDeduction: 55 },
        { name: 'Mohamed Yusuf', employeeId: 'EMP-0010', department: 'Manager', branch: 'Masalaha Branch', originalSalary: 700, absenceDeduction: 15, performanceDeduction: 0 },
        { name: 'Ilwad Noor', employeeId: 'EMP-0011', department: 'IT Manager', branch: 'Jigjiga Yar Branch', originalSalary: 900, absenceDeduction: 0, performanceDeduction: 0 },
        { name: 'Nimco Abdi', employeeId: 'EMP-0012', department: 'Operations Manager', branch: 'Togdheer Branch', originalSalary: 640, absenceDeduction: 55, performanceDeduction: 45 }
    ];

    function formatCurrency(amount) {
        return `$${amount.toLocaleString()}`;
    }

    function toggleSidebar() {
        document.body.classList.toggle('sidebar-collapsed');
    }

    function toggleMobileSidebar() {
        document.body.classList.toggle('sidebar-open');
    }

    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', toggleSidebar);
    }

    if (mobileSidebarToggle) {
        mobileSidebarToggle.addEventListener('click', toggleMobileSidebar);
    }

    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', toggleMobileSidebar);
    }

    function renderPayrollSummary() {
        const absenceDeductions = payrollRecords.reduce((total, record) => total + record.absenceDeduction, 0);
        const performanceDeductions = payrollRecords.reduce((total, record) => total + record.performanceDeduction, 0);

        document.getElementById('absenceDeductionsCard').textContent = formatCurrency(absenceDeductions);
        document.getElementById('performanceDeductionsCard').textContent = formatCurrency(performanceDeductions);
        document.getElementById('totalDeductionsCard').textContent = formatCurrency(absenceDeductions + performanceDeductions);
    }

    function renderPayrollTable() {
        payrollDeductionTableBody.innerHTML = payrollRecords.map((record) => {
            const totalDeduction = record.absenceDeduction + record.performanceDeduction;
            const netSalary = record.originalSalary - totalDeduction;

            return `
                <tr class="text-sm text-slate-600">
                    <td class="px-4 py-4">
                        <div class="font-semibold text-slate-800">${record.name}</div>
                        <div class="text-xs text-slate-400">${record.employeeId}</div>
                    </td>
                    <td class="px-4 py-4">${record.department}</td>
                    <td class="px-4 py-4">${record.branch}</td>
                    <td class="px-4 py-4 font-semibold text-slate-800">${formatCurrency(record.originalSalary)}</td>
                    <td class="px-4 py-4 text-amber-600">${formatCurrency(record.absenceDeduction)}</td>
                    <td class="px-4 py-4 text-rose-600">${formatCurrency(record.performanceDeduction)}</td>
                    <td class="px-4 py-4 font-semibold text-slate-800">${formatCurrency(totalDeduction)}</td>
                    <td class="px-4 py-4 font-semibold text-emerald-600">${formatCurrency(netSalary)}</td>
                </tr>
            `;
        }).join('');
    }

    renderPayrollSummary();
    renderPayrollTable();
</script>
</body>
</html>
