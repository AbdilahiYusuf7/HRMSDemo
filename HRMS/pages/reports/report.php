<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRM System - Report</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6fb;
            overflow-x: hidden;
            zoom: 90%;
        }

        #dashboardMain {
            min-width: 0;
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

        .report-panel {
            background: #ffffff;
            border: 1px solid #dde5f0;
            border-radius: 1.85rem;
            box-shadow: 0 18px 45px -32px rgba(15, 23, 42, 0.35);
        }

        .report-item {
            background: #edf2f8;
            color: #243b58;
            border-radius: 0.9rem;
            min-height: 52px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            transition: all 0.2s ease;
        }

        .report-item:hover {
            background: #e3ebf6;
            color: #1f2f46;
            transform: translateX(2px);
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
    <?php $currentMenu = 'report'; ?>
    <?php include __DIR__ . '/../../includes/header_sidebar.php'; ?>

    <div class="mx-auto w-full max-w-[1540px] p-4 md:p-6">
        <div class="grid grid-cols-4 gap-6">
            <section class="report-panel p-6">
                <div class="mb-7 flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-blue-600">
                    <i class="fa-solid fa-user-tie text-lg"></i>
                </div>
                <h2 class="mb-5 text-xl font-bold text-slate-900">Employee</h2>
                <div class="space-y-3">
                    <a href="<?= $menuBasePath; ?>pages/employees/list_employee.php" class="report-item flex items-center px-5 text-[15px] font-medium">Employee Info</a>
                    <a href="<?= $menuBasePath; ?>pages/attendance/list_attendance.php" class="report-item flex items-center px-5 text-[15px] font-medium">Attendance Reports</a>
                    <a href="<?= $menuBasePath; ?>pages/leave management/list_leaves.php" class="report-item flex items-center px-5 text-[15px] font-medium">Leave Reports</a>
                    <a href="<?= $menuBasePath; ?>pages/retirement/list_retirement.php" class="report-item flex items-center px-5 text-[15px] font-medium">Retirement Reports</a>
                    <a href="<?= $menuBasePath; ?>pages/training and development/list_training.php" class="report-item flex items-center px-5 text-[15px] font-medium">Training Reports</a>
                    <a href="<?= $menuBasePath; ?>pages/perfomanceRanknig/employee_ranking.php" class="report-item flex items-center px-5 text-[15px] font-medium">Employee Ranking</a>
                </div>
            </section>

            <section class="report-panel p-6">
                <div class="mb-7 flex h-12 w-12 items-center justify-center rounded-2xl bg-violet-50 text-violet-600">
                    <i class="fa-solid fa-chart-line text-lg"></i>
                </div>
                <h2 class="mb-5 text-xl font-bold text-slate-900">Perfomance</h2>
                <div class="space-y-3">
                    <a href="<?= $menuBasePath; ?>pages/perfomance/list_perfomance.php" class="report-item flex items-center px-5 text-[15px] font-medium">Agenda Reports</a>
                    <a href="<?= $menuBasePath; ?>pages/perfomance/list_perfomance.php" class="report-item flex items-center px-5 text-[15px] font-medium">Employee Review Reports</a>
                    <a href="<?= $menuBasePath; ?>pages/perfomance/list_perfomance.php" class="report-item flex items-center px-5 text-[15px] font-medium">Top Performers</a>
                    <a href="<?= $menuBasePath; ?>pages/perfomance/list_perfomance.php" class="report-item flex items-center px-5 text-[15px] font-medium">Need Improvement</a>
                    <a href="<?= $menuBasePath; ?>pages/perfomanceRanknig/promotion_requests.php" class="report-item flex items-center px-5 text-[15px] font-medium">Promotion Requests</a>
                    <a href="<?= $menuBasePath; ?>pages/perfomanceRanknig/promotion_history.php" class="report-item flex items-center px-5 text-[15px] font-medium">Promotion History</a>
                </div>
            </section>

            <section class="report-panel p-6">
                <div class="mb-7 flex h-12 w-12 items-center justify-center rounded-2xl bg-orange-50 text-orange-600">
                    <i class="fa-solid fa-file-invoice-dollar text-lg"></i>
                </div>
                <h2 class="mb-5 text-xl font-bold text-slate-900">Payroll</h2>
                <div class="space-y-3">
                    <a href="<?= $menuBasePath; ?>pages/payrol integration/payroll_integration.php" class="report-item flex items-center px-5 text-[15px] font-medium">Salary Reports</a>
                    <a href="<?= $menuBasePath; ?>pages/payrol integration/payroll_integration.php" class="report-item flex items-center px-5 text-[15px] font-medium">Paid Payroll</a>
                    <a href="<?= $menuBasePath; ?>pages/payrol integration/payroll_integration.php" class="report-item flex items-center px-5 text-[15px] font-medium">Total Deductions</a>
                    <a href="<?= $menuBasePath; ?>pages/payrol integration/payroll_integration.php" class="report-item flex items-center px-5 text-[15px] font-medium">Absence Deductions</a>
                    <a href="<?= $menuBasePath; ?>pages/payrol integration/payroll_integration.php" class="report-item flex items-center px-5 text-[15px] font-medium">Perfomance Deductions</a>
                    <a href="<?= $menuBasePath; ?>pages/payrol integration/payroll_integration.php" class="report-item flex items-center px-5 text-[15px] font-medium">Outstanding Payroll</a>
                </div>
            </section>

            <section class="report-panel p-6">
                <div class="mb-7 flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600">
                    <i class="fa-solid fa-building-columns text-lg"></i>
                </div>
                <h2 class="mb-5 text-xl font-bold text-slate-900">Management</h2>
                <div class="space-y-3">
                    <a href="<?= $menuBasePath; ?>pages/dashboard.php" class="report-item flex items-center px-5 text-[15px] font-medium">Dashboard Summary</a>
                    <a href="<?= $menuBasePath; ?>pages/attendance/list_attendance.php" class="report-item flex items-center px-5 text-[15px] font-medium">Branch Attendance</a>
                    <a href="<?= $menuBasePath; ?>pages/training and development/list_training.php" class="report-item flex items-center px-5 text-[15px] font-medium">Training Summary</a>
                    <a href="<?= $menuBasePath; ?>pages/leave management/list_leaves.php" class="report-item flex items-center px-5 text-[15px] font-medium">Leave Summary</a>
                    <a href="<?= $menuBasePath; ?>pages/retirement/list_retirement.php" class="report-item flex items-center px-5 text-[15px] font-medium">Retirement Summary</a>
                    <a href="<?= $menuBasePath; ?>pages/perfomanceRanknig/reports_insights.php" class="report-item flex items-center px-5 text-[15px] font-medium">Promotion Summary</a>
                </div>
            </section>
        </div>
    </div>
</main>

<script>
    const sidebarToggle = document.getElementById('sidebarToggle');
    const mobileSidebarToggle = document.getElementById('mobileSidebarToggle');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    const reportItems = document.querySelectorAll('.report-item');

    const sampleRows = [
        { employee: 'Cabdiraxmaan Cali', employeeId: 'EMP-0001', branch: 'Idaacada Branch', department: 'Human Resource Manager', status: 'Good', amount: '$850' },
        { employee: 'Fadumo Xasan', employeeId: 'EMP-0002', branch: 'Xero Awr Branch', department: 'Head of Finances', status: 'Good', amount: '$920' },
        { employee: 'Mahad Axmed', employeeId: 'EMP-0003', branch: 'Togdheer Branch', department: 'Operations Manager', status: 'Good', amount: '$880' },
        { employee: 'Sahra Maxamed', employeeId: 'EMP-0004', branch: 'Calaamada Branch', department: 'Marketing Manager', status: 'Normal', amount: '$650' },
        { employee: 'Ahmed Jama', employeeId: 'EMP-0009', branch: 'Calaamada Branch', department: 'Marketing Manager', status: 'Needs Help', amount: '$620' }
    ];

    function toggleSidebar() {
        document.body.classList.toggle('sidebar-collapsed');
    }

    function toggleMobileSidebar() {
        document.body.classList.toggle('sidebar-open');
    }

    function getReportModule(item) {
        const section = item.closest('section');
        const heading = section ? section.querySelector('h2') : null;

        return heading ? heading.textContent.trim() : 'Report';
    }

    function buildSampleDocument(moduleName, reportTitle) {
        const generatedDate = 'April 27, 2026';
        const rows = sampleRows.map((row, index) => `
            <tr>
                <td>${index + 1}</td>
                <td>${row.employee}<br><small>${row.employeeId}</small></td>
                <td>${row.branch}</td>
                <td>${row.department}</td>
                <td>${row.status}</td>
                <td>${row.amount}</td>
            </tr>
        `).join('');

        return `
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <title>${reportTitle}</title>
                <style>
                    body { font-family: Arial, sans-serif; color: #172033; margin: 32px; }
                    .header { display: flex; justify-content: space-between; gap: 24px; border-bottom: 2px solid #e5eaf2; padding-bottom: 18px; margin-bottom: 24px; }
                    h1 { margin: 0; font-size: 24px; }
                    p { margin: 6px 0; color: #526173; }
                    table { width: 100%; border-collapse: collapse; margin-top: 18px; }
                    th, td { border: 1px solid #d9e1ec; padding: 12px; text-align: left; font-size: 13px; }
                    th { background: #eef3f9; color: #263b57; }
                    small { color: #6b7a90; }
                    .summary { display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; margin-top: 18px; }
                    .box { background: #f4f7fb; border: 1px solid #dfe7f1; border-radius: 12px; padding: 14px; }
                    .box strong { display: block; font-size: 20px; color: #172033; margin-top: 6px; }
                    @media print { button { display: none; } body { margin: 18px; } }
                </style>
            </head>
            <body>
                <div class="header">
                    <div>
                        <h1>${reportTitle}</h1>
                        <p>${moduleName} report sample generated from HRMS modules.</p>
                    </div>
                    <div>
                        <p><strong>Generated:</strong> ${generatedDate}</p>
                        <p><strong>Branch:</strong> All Hargeisa Branches</p>
                    </div>
                </div>
                <div class="summary">
                    <div class="box">Total Employees<strong>12</strong></div>
                    <div class="box">Report Type<strong>${moduleName}</strong></div>
                    <div class="box">Sample Rows<strong>${sampleRows.length}</strong></div>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Employee</th>
                            <th>Branch</th>
                            <th>Department</th>
                            <th>Status</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>${rows}</tbody>
                </table>
                <p style="margin-top: 20px;">This is sample report data for UI testing.</p>
                <button onclick="window.print()" style="margin-top: 20px; padding: 10px 16px;">Print Document</button>
            </body>
            </html>
        `;
    }

    function generateSampleDocument(item) {
        const moduleName = getReportModule(item);
        const reportTitle = item.textContent.trim();
        const reportWindow = window.open('', '_blank');

        if (!reportWindow) {
            return;
        }

        reportWindow.document.open();
        reportWindow.document.write(buildSampleDocument(moduleName, reportTitle));
        reportWindow.document.close();
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

    reportItems.forEach((item) => {
        item.addEventListener('click', (event) => {
            event.preventDefault();
            generateSampleDocument(item);
        });
    });
</script>
</body>
</html>
