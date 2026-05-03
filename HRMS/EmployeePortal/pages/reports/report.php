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

    const reportSamples = {
        'Employee Info': {
            summary: [['Employees', '128'], ['Active', '119'], ['Departments', '8']],
            columns: ['Employee', 'Branch', 'Department', 'Position', 'Status'],
            rows: [
                ['Cabdiraxmaan Cali (EMP-0001)', 'Idaacada Branch', 'Human Resource', 'HR Director', 'Active'],
                ['Fadumo Xasan (EMP-0002)', 'Xero Awr Branch', 'Finance', 'Finance Lead', 'Active'],
                ['Mahad Axmed (EMP-0003)', 'Togdheer Branch', 'Operations', 'Operations Manager', 'Active'],
                ['Sahra Maxamed (EMP-0004)', 'Calaamada Branch', 'Marketing', 'Marketing Manager', 'On Leave']
            ]
        },
        'Attendance Reports': {
            summary: [['Present', '112'], ['Absent', '6'], ['On Leave', '10']],
            columns: ['Employee', 'Branch', 'Date', 'Clock In', 'Status'],
            rows: [
                ['Cabdiraxmaan Cali', 'Idaacada Branch', 'May 1, 2026', '08:02 AM', 'Present'],
                ['Fadumo Xasan', 'Xero Awr Branch', 'May 1, 2026', '08:14 AM', 'Present'],
                ['Sahra Maxamed', 'Calaamada Branch', 'May 1, 2026', '-', 'On Leave'],
                ['Ahmed Jama', 'Calaamada Branch', 'May 1, 2026', '-', 'Absent']
            ]
        },
        'Leave Reports': {
            summary: [['Approved', '14'], ['Pending', '5'], ['Rejected', '2']],
            columns: ['Employee', 'Leave Type', 'Start Date', 'End Date', 'Status'],
            rows: [
                ['Sahra Maxamed', 'Annual Leave', 'Apr 29, 2026', 'May 3, 2026', 'Approved'],
                ['Ahmed Jama', 'Sick Leave', 'May 1, 2026', 'May 2, 2026', 'Pending'],
                ['Fadumo Xasan', 'Emergency Leave', 'Apr 24, 2026', 'Apr 25, 2026', 'Approved'],
                ['Mahad Axmed', 'Annual Leave', 'May 5, 2026', 'May 8, 2026', 'Pending']
            ]
        },
        'Retirement Reports': {
            summary: [['Due This Year', '7'], ['Due In 90 Days', '2'], ['Processed', '4']],
            columns: ['Employee', 'Branch', 'Role', 'Retirement Date', 'Status'],
            rows: [
                ['Jaamac Muuse', 'Idaacada Branch', 'Senior Advisor', 'Jun 30, 2026', 'Due Soon'],
                ['Aamina Yusuf', 'Togdheer Branch', 'Payroll Officer', 'Aug 15, 2026', 'Planning'],
                ['Cabdi Nuur', 'Xero Awr Branch', 'Admin Officer', 'Nov 20, 2026', 'Eligible'],
                ['Hodan Barre', 'Calaamada Branch', 'Trainer', 'Dec 8, 2026', 'Eligible']
            ]
        },
        'Training Reports': {
            summary: [['Completed', '46'], ['In Progress', '18'], ['Registered', '31']],
            columns: ['Employee', 'Training', 'Provider', 'Date', 'Status'],
            rows: [
                ['Cabdiraxmaan Cali', 'Leadership Certificate', 'HRMS Academy', 'Apr 18, 2026', 'Completed'],
                ['Fadumo Xasan', 'Payroll Compliance', 'Finance Institute', 'Apr 22, 2026', 'Completed'],
                ['Mahad Axmed', 'Operations Planning', 'HRMS Academy', 'May 4, 2026', 'Registered'],
                ['Sahra Maxamed', 'Performance Coaching', 'HRMS Academy', 'May 9, 2026', 'In Progress']
            ]
        },
        'Employee Ranking': {
            summary: [['Eligible', '18'], ['Needs Review', '9'], ['Top Score', '92%']],
            columns: ['Employee', 'Current Role', 'Rank', 'Performance', 'Eligibility'],
            rows: [
                ['Cabdiraxmaan Cali', 'HR Director', 'Director I', '92%', 'Eligible'],
                ['Fadumo Xasan', 'Finance Lead', 'Manager II', '89%', 'Eligible'],
                ['Mahad Axmed', 'Operations Manager', 'Manager I', '84%', 'Near Eligible'],
                ['Sahra Maxamed', 'Marketing Manager', 'Manager I', '76%', 'Review']
            ]
        },
        'Agenda Reports': {
            summary: [['Total Agendas', '24'], ['Completed', '17'], ['Pending', '7']],
            columns: ['Agenda', 'Owner', 'Department', 'Due Date', 'Status'],
            rows: [
                ['Quarterly Review', 'Cabdiraxmaan Cali', 'HR', 'May 6, 2026', 'Pending'],
                ['Payroll Audit', 'Fadumo Xasan', 'Finance', 'May 9, 2026', 'In Progress'],
                ['Branch Staffing Plan', 'Mahad Axmed', 'Operations', 'May 12, 2026', 'Pending'],
                ['Training Calendar', 'Sahra Maxamed', 'Marketing', 'Apr 28, 2026', 'Completed']
            ]
        },
        'Employee Review Reports': {
            summary: [['Reviewed', '82'], ['Pending', '31'], ['Average Score', '81%']],
            columns: ['Employee', 'Reviewer', 'Period', 'Score', 'Result'],
            rows: [
                ['Cabdiraxmaan Cali', 'CEO Office', 'Q1 2026', '92%', 'Excellent'],
                ['Fadumo Xasan', 'Finance Director', 'Q1 2026', '88%', 'Strong'],
                ['Mahad Axmed', 'Operations Director', 'Q1 2026', '81%', 'Good'],
                ['Ahmed Jama', 'Marketing Lead', 'Q1 2026', '68%', 'Needs Improvement']
            ]
        },
        'Top Performers': {
            summary: [['Top Employees', '10'], ['Average Score', '91%'], ['Promotable', '6']],
            columns: ['Rank', 'Employee', 'Department', 'Score', 'Recommendation'],
            rows: [
                ['1', 'Cabdiraxmaan Cali', 'Human Resource', '92%', 'Promote'],
                ['2', 'Fadumo Xasan', 'Finance', '90%', 'Bonus'],
                ['3', 'Mahad Axmed', 'Operations', '88%', 'Retain'],
                ['4', 'Sahra Maxamed', 'Marketing', '86%', 'Training Lead']
            ]
        },
        'Need Improvement': {
            summary: [['Employees', '8'], ['Coaching Plans', '6'], ['Due Reviews', '3']],
            columns: ['Employee', 'Department', 'Issue', 'Action Plan', 'Due Date'],
            rows: [
                ['Ahmed Jama', 'Marketing', 'Low attendance', 'Attendance coaching', 'May 15, 2026'],
                ['Nimco Ali', 'Operations', 'Late tasks', 'Weekly check-in', 'May 20, 2026'],
                ['Yusuf Omar', 'Finance', 'Error rate', 'Technical refresh', 'May 22, 2026'],
                ['Ayaan Said', 'HR', 'Policy gaps', 'Mentorship', 'May 25, 2026']
            ]
        },
        'Promotion Requests': {
            summary: [['Submitted', '15'], ['Approved', '6'], ['Pending', '9']],
            columns: ['Employee', 'Current Role', 'Proposed Role', 'Stage', 'Status'],
            rows: [
                ['Cabdiraxmaan Cali', 'HR Manager', 'HR Director', 'Final Review', 'Pending'],
                ['Fadumo Xasan', 'Accountant', 'Finance Lead', 'Approved', 'Approved'],
                ['Mahad Axmed', 'Supervisor', 'Operations Manager', 'HR Review', 'Pending'],
                ['Sahra Maxamed', 'Officer', 'Marketing Manager', 'Manager Review', 'Pending']
            ]
        },
        'Promotion History': {
            summary: [['Promotions', '22'], ['This Quarter', '5'], ['Average Raise', '12%']],
            columns: ['Employee', 'Previous Role', 'New Role', 'Effective Date', 'Approved By'],
            rows: [
                ['Fadumo Xasan', 'Accountant', 'Finance Lead', 'Mar 1, 2026', 'Finance Director'],
                ['Mahad Axmed', 'Supervisor', 'Operations Manager', 'Feb 15, 2026', 'COO'],
                ['Sahra Maxamed', 'Officer', 'Marketing Manager', 'Jan 10, 2026', 'CEO Office'],
                ['Cabdi Nuur', 'Admin Clerk', 'Admin Officer', 'Dec 1, 2025', 'HR Director']
            ]
        },
        'Salary Reports': {
            summary: [['Gross Payroll', '$84,250'], ['Employees', '128'], ['Average Salary', '$658']],
            columns: ['Employee', 'Grade', 'Basic Salary', 'Allowance', 'Net Salary'],
            rows: [
                ['Cabdiraxmaan Cali', 'G9', '$1,250', '$180', '$1,430'],
                ['Fadumo Xasan', 'G8', '$1,050', '$150', '$1,200'],
                ['Mahad Axmed', 'G7', '$920', '$120', '$1,040'],
                ['Sahra Maxamed', 'G7', '$880', '$100', '$980']
            ]
        },
        'Paid Payroll': {
            summary: [['Paid Amount', '$78,400'], ['Paid Employees', '119'], ['Payment Runs', '2']],
            columns: ['Employee', 'Payroll Month', 'Payment Date', 'Method', 'Amount'],
            rows: [
                ['Cabdiraxmaan Cali', 'April 2026', 'Apr 28, 2026', 'Bank Transfer', '$1,430'],
                ['Fadumo Xasan', 'April 2026', 'Apr 28, 2026', 'Bank Transfer', '$1,200'],
                ['Mahad Axmed', 'April 2026', 'Apr 28, 2026', 'Bank Transfer', '$1,040'],
                ['Sahra Maxamed', 'April 2026', 'Apr 28, 2026', 'Bank Transfer', '$980']
            ]
        },
        'Total Deductions': {
            summary: [['Deductions', '$5,850'], ['Employees', '31'], ['Highest', '$240']],
            columns: ['Employee', 'Deduction Type', 'Month', 'Reason', 'Amount'],
            rows: [
                ['Ahmed Jama', 'Attendance', 'April 2026', 'Absence', '$120'],
                ['Nimco Ali', 'Performance', 'April 2026', 'Target Missed', '$90'],
                ['Yusuf Omar', 'Loan', 'April 2026', 'Staff Loan', '$180'],
                ['Ayaan Said', 'Attendance', 'April 2026', 'Late Days', '$45']
            ]
        },
        'Absence Deductions': {
            summary: [['Absence Amount', '$1,240'], ['Absent Days', '18'], ['Employees', '9']],
            columns: ['Employee', 'Branch', 'Absent Days', 'Rate', 'Deduction'],
            rows: [
                ['Ahmed Jama', 'Calaamada Branch', '3', '$40', '$120'],
                ['Nimco Ali', 'Togdheer Branch', '2', '$35', '$70'],
                ['Yusuf Omar', 'Xero Awr Branch', '1', '$45', '$45'],
                ['Ayaan Said', 'Idaacada Branch', '2', '$30', '$60']
            ]
        },
        'Perfomance Deductions': {
            summary: [['Deducted', '$930'], ['Low Scores', '7'], ['Review Pending', '3']],
            columns: ['Employee', 'Review Period', 'Score', 'Policy', 'Deduction'],
            rows: [
                ['Ahmed Jama', 'Q1 2026', '62%', 'Below target', '$110'],
                ['Nimco Ali', 'Q1 2026', '65%', 'Below target', '$90'],
                ['Yusuf Omar', 'Q1 2026', '68%', 'Quality errors', '$80'],
                ['Ayaan Said', 'Q1 2026', '69%', 'Policy review', '$65']
            ]
        },
        'Outstanding Payroll': {
            summary: [['Outstanding', '$4,620'], ['Employees', '9'], ['Oldest Batch', 'Apr 2026']],
            columns: ['Employee', 'Payroll Month', 'Reason', 'Due Date', 'Amount'],
            rows: [
                ['Hodan Barre', 'April 2026', 'Bank validation', 'May 3, 2026', '$760'],
                ['Cabdi Nuur', 'April 2026', 'Missing approval', 'May 4, 2026', '$690'],
                ['Aamina Yusuf', 'April 2026', 'Account update', 'May 5, 2026', '$720'],
                ['Jaamac Muuse', 'April 2026', 'Final review', 'May 5, 2026', '$810']
            ]
        },
        'Dashboard Summary': {
            summary: [['Employees', '128'], ['Attendance', '88%'], ['Open Tasks', '14']],
            columns: ['Metric', 'Current Value', 'Previous Value', 'Change', 'Status'],
            rows: [
                ['Active Employees', '119', '117', '+2', 'Good'],
                ['Attendance Rate', '88%', '85%', '+3%', 'Improving'],
                ['Leave Requests', '21', '18', '+3', 'Monitor'],
                ['Promotion Requests', '15', '11', '+4', 'Active']
            ]
        },
        'Branch Attendance': {
            summary: [['Branches', '4'], ['Best Branch', 'Idaacada'], ['Average', '88%']],
            columns: ['Branch', 'Employees', 'Present', 'Absent', 'Attendance Rate'],
            rows: [
                ['Idaacada Branch', '42', '39', '3', '93%'],
                ['Xero Awr Branch', '31', '27', '4', '87%'],
                ['Togdheer Branch', '28', '24', '4', '86%'],
                ['Calaamada Branch', '27', '22', '5', '81%']
            ]
        },
        'Training Summary': {
            summary: [['Programs', '12'], ['Completions', '46'], ['Completion Rate', '74%']],
            columns: ['Program', 'Registered', 'Completed', 'In Progress', 'Completion Rate'],
            rows: [
                ['Leadership Certificate', '18', '12', '6', '67%'],
                ['Payroll Compliance', '14', '11', '3', '79%'],
                ['Operations Planning', '20', '15', '5', '75%'],
                ['Performance Coaching', '10', '8', '2', '80%']
            ]
        },
        'Leave Summary': {
            summary: [['Requests', '21'], ['Approved', '14'], ['Approval Rate', '67%']],
            columns: ['Leave Type', 'Requests', 'Approved', 'Pending', 'Rejected'],
            rows: [
                ['Annual Leave', '9', '6', '2', '1'],
                ['Sick Leave', '6', '5', '1', '0'],
                ['Emergency Leave', '4', '2', '1', '1'],
                ['Maternity Leave', '2', '1', '1', '0']
            ]
        },
        'Retirement Summary': {
            summary: [['Eligible', '13'], ['This Year', '7'], ['Processed', '4']],
            columns: ['Period', 'Eligible Employees', 'Documents Ready', 'Pending Review', 'Processed'],
            rows: [
                ['Q1 2026', '3', '3', '0', '2'],
                ['Q2 2026', '4', '2', '2', '1'],
                ['Q3 2026', '3', '1', '2', '1'],
                ['Q4 2026', '3', '1', '2', '0']
            ]
        },
        'Promotion Summary': {
            summary: [['Eligible', '18'], ['Requests', '15'], ['Approved', '6']],
            columns: ['Department', 'Eligible', 'Requested', 'Approved', 'Pending'],
            rows: [
                ['Human Resource', '5', '4', '2', '2'],
                ['Finance', '4', '3', '1', '2'],
                ['Operations', '6', '5', '2', '3'],
                ['Marketing', '3', '3', '1', '2']
            ]
        }
    };

    const systemEmployees = [
        ['Cabdiraxmaan Cali (EMP-0001)', 'Idaacada Branch', 'Human Resource', 'Human Resource Director', 'Active'],
        ['Fadumo Xasan (EMP-0002)', 'Xero Awr Branch', 'Finance', 'Finance Officer', 'On Leave'],
        ['Mahad Axmed (EMP-0003)', 'Togdheer Branch', 'Operations', 'Operations Supervisor', 'Active'],
        ['Sahra Maxamed (EMP-0004)', 'Calaamada Branch', 'Marketing', 'Marketing Coordinator', 'Inactive']
    ];

    const systemAttendance = [
        ['Cabdiraxmaan Cali (EMP-0001)', 'Human Resource', 'Idaacada Branch', '07:58 AM', 'Present'],
        ['Fadumo Xasan (EMP-0002)', 'Finance', 'Xero Awr Branch', '08:17 AM', 'Late'],
        ['Mahad Axmed (EMP-0003)', 'Operations', 'Togdheer Branch', '--', 'Absent'],
        ['Sahra Maxamed (EMP-0004)', 'Marketing', 'Calaamada Branch', '07:41 AM', 'Early'],
        ['Hodan Ali (EMP-0005)', 'Administration', 'Masalaha Branch', '08:04 AM', 'Present'],
        ['Mustafe Cabdi (EMP-0006)', 'Information Technology', 'Jigjiga Yar Branch', '08:26 AM', 'Late'],
        ['Amina Yusuf (EMP-0007)', 'Human Resource', 'Idaacada Branch', '08:00 AM', 'Present'],
        ['Roda Jama (EMP-0008)', 'Finance', 'Xero Awr Branch', '--', 'Absent'],
        ['Sakariye Noor (EMP-0009)', 'Operations', 'Togdheer Branch', '07:46 AM', 'Early'],
        ['Nimco Ahmed (EMP-0010)', 'Marketing', 'Calaamada Branch', '08:09 AM', 'Late']
    ];

    const systemLeaveRequests = [
        ['Cabdiraxmaan Cali (EMP-0001)', 'Human Resource', 'Idaacada Branch', 'Annual Leave', '4 days', '2026-04-28 to 2026-05-01', 'Approved'],
        ['Fadumo Xasan (EMP-0002)', 'Finance', 'Xero Awr Branch', 'Sick Leave', '2 days', '2026-04-26 to 2026-04-27', 'Approved'],
        ['Mahad Axmed (EMP-0003)', 'Operations', 'Togdheer Branch', 'Emergency Leave', '1 day', '2026-04-29 to 2026-04-29', 'Pending'],
        ['Sahra Maxamed (EMP-0004)', 'Marketing', 'Calaamada Branch', 'Casual Leave', '3 days', '2026-05-03 to 2026-05-05', 'Rejected'],
        ['Hodan Ali (EMP-0005)', 'Administration', 'Masalaha Branch', 'Annual Leave', '5 days', '2026-05-10 to 2026-05-14', 'Approved'],
        ['Mustafe Cabdi (EMP-0006)', 'Information Technology', 'Jigjiga Yar Branch', 'Sick Leave', '2 days', '2026-04-30 to 2026-05-01', 'Pending'],
        ['Amina Yusuf (EMP-0007)', 'Human Resource', 'Idaacada Branch', 'Study Leave', '4 days', '2026-05-06 to 2026-05-09', 'Rejected'],
        ['Roda Jama (EMP-0008)', 'Finance', 'Xero Awr Branch', 'Casual Leave', '1 day', '2026-04-27 to 2026-04-27', 'Approved'],
        ['Mahad Axmed (EMP-0003)', 'Operations', 'Togdheer Branch', 'Annual Leave', '2 days', '2026-05-02 to 2026-05-03', 'Pending'],
        ['Sahra Maxamed (EMP-0004)', 'Marketing', 'Calaamada Branch', 'Sick Leave', '1 day', '2026-04-26 to 2026-04-26', 'Rejected'],
        ['Fadumo Xasan (EMP-0002)', 'Finance', 'Xero Awr Branch', 'Emergency Leave', '2 days', '2026-05-04 to 2026-05-05', 'Approved'],
        ['Mustafe Cabdi (EMP-0006)', 'Information Technology', 'Jigjiga Yar Branch', 'Casual Leave', '3 days', '2026-05-07 to 2026-05-09', 'Pending']
    ];

    const systemRetirements = [
        ['Mohamed Nuur (EMP-0011)', 'Information Technology', 'Jigjiga Yar Branch', '59', '2026-04-28', '2 days left'],
        ['Hodan Maxamed (EMP-0012)', 'Finance', 'Xero Awr Branch', '60', '2026-04-29', '3 days left'],
        ['Fadumo Cabdi (EMP-0013)', 'Human Resource', 'Idaacada Branch', '60', '2026-04-30', '4 days left'],
        ['Cabdirisaaq Xasan (EMP-0014)', 'Operations', 'Togdheer Branch', '59', '2026-05-10', '14 days left'],
        ['Nimco Aadan (EMP-0015)', 'Administration', 'Masalaha Branch', '59', '2026-05-24', '28 days left']
    ];

    const systemTrainings = [
        ['TRN-001', 'Workplace Safety Refresher', 'Mandatory', 'Operations', 'Togdheer Branch', '2026-01-16', 'Completed'],
        ['TRN-002', 'Payroll Controls Workshop', 'Mandatory', 'Finance', 'Xero Awr Branch', '2026-01-28', 'Completed'],
        ['TRN-003', 'Performance Coaching Lab', 'Optional', 'Human Resource', 'Idaacada Branch', '2026-02-13', 'Completed'],
        ['TRN-006', 'Compliance Policy Update', 'Mandatory', 'Administration', 'Masalaha Branch', '2026-03-19', 'In Progress'],
        ['TRN-009', 'HR Interview Calibration', 'Mandatory', 'Human Resource', 'Idaacada Branch', '2026-05-02', 'Scheduled'],
        ['TRN-012', 'Helpdesk Service Excellence', 'Optional', 'Information Technology', 'Jigjiga Yar Branch', '2026-05-22', 'In Progress']
    ];

    const systemPayroll = [
        ['Cabdiraxmaan Cali (EMP-0001)', 'Human Resource Manager', 'Idaacada Branch', '$850', '$15', '$0', '$835'],
        ['Fadumo Xasan (EMP-0002)', 'Head of Finances', 'Xero Awr Branch', '$920', '$20', '$0', '$900'],
        ['Mahad Axmed (EMP-0003)', 'Operations Manager', 'Togdheer Branch', '$880', '$35', '$0', '$845'],
        ['Sahra Maxamed (EMP-0004)', 'Marketing Manager', 'Calaamada Branch', '$650', '$25', '$30', '$595'],
        ['Mustafe Cabdi (EMP-0006)', 'IT Manager', 'Jigjiga Yar Branch', '$780', '$45', '$15', '$720'],
        ['Nimco Abdi (EMP-0012)', 'Operations Manager', 'Togdheer Branch', '$640', '$55', '$45', '$540'],
        ['Hodan Ali (EMP-0005)', 'Manager', 'Masalaha Branch', '$720', '$10', '$0', '$710'],
        ['Roda Jama (EMP-0007)', 'Head of Finances', 'Xero Awr Branch', '$800', '$0', '$0', '$800'],
        ['Amina Yusuf (EMP-0008)', 'Human Resource Manager', 'Idaacada Branch', '$760', '$0', '$0', '$760'],
        ['Ahmed Jama (EMP-0009)', 'Marketing Manager', 'Calaamada Branch', '$620', '$40', '$55', '$525'],
        ['Mohamed Yusuf (EMP-0010)', 'Manager', 'Masalaha Branch', '$700', '$15', '$0', '$685'],
        ['Ilwad Noor (EMP-0011)', 'IT Manager', 'Jigjiga Yar Branch', '$900', '$0', '$0', '$900']
    ];

    const systemRanking = [
        ['Cabdiraxmaan Cali (EMP-0001)', 'Human Resource Director', 'Director I', '92%', 'Eligible'],
        ['Fadumo Xasan (EMP-0002)', 'Head of Finances', 'Manager II', '89%', 'Eligible'],
        ['Mahad Axmed (EMP-0003)', 'Operations Manager', 'Manager I', '84%', 'Near Eligible'],
        ['Sahra Maxamed (EMP-0004)', 'Marketing Manager', 'Manager I', '76%', 'Review']
    ];

    const systemPerformanceRows = [
        ['Cabdiraxmaan Cali (EMP-0001)', 'Human Resource Manager', 'Staff Follow Up', '92%', 'Top Performer'],
        ['Fadumo Xasan (EMP-0002)', 'Head of Finances', 'Audit Follow Up', '95%', 'Top Performer'],
        ['Mahad Axmed (EMP-0003)', 'Operations Manager', 'Branch Follow Up', '90%', 'Top Performer'],
        ['Sahra Maxamed (EMP-0004)', 'Marketing Manager', 'Customer Follow Up', '76%', 'Pending Review'],
        ['Hodan Ali (EMP-0005)', 'Manager', 'Office Work Follow Up', '84%', 'Completed'],
        ['Ahmed Jama (EMP-0009)', 'Marketing Manager', 'Customer Follow Up', '69%', 'Pending Review'],
        ['Nimco Abdi (EMP-0012)', 'Operations Manager', 'Branch Follow Up', '71%', 'Pending Review']
    ];

    const systemAgendaRows = [
        ['Human Resource Manager', 'Staff Follow Up', 'Check staff attendance; Follow up staff leave; Update employee files', '2 employees'],
        ['Head of Finances', 'Audit Follow Up', 'Check payment records; Follow up missing receipts; Prepare simple finance report', '2 employees'],
        ['Operations Manager', 'Branch Follow Up', 'Check branch work; Follow up daily problems; Report unfinished tasks', '2 employees'],
        ['Marketing Manager', 'Customer Follow Up', 'Call customers; Share new offers; Write customer feedback', '2 employees'],
        ['Manager', 'Office Work Follow Up', 'Check office records; Arrange daily work; Follow up pending documents', '2 employees'],
        ['IT Manager', 'Computer And Website Check', 'Diagnose website problems; Fix computers; Help staff with system issues', '2 employees']
    ];

    Object.assign(reportSamples, {
        'Employee Info': {
            summary: [['Total Employees', '1,420'], ['Active Employees', '1,284'], ['On Leave Employees', '46']],
            columns: ['Employee', 'Branch', 'Department', 'Designation', 'Status'],
            rows: systemEmployees
        },
        'Attendance Reports': {
            summary: [['Present', '3'], ['Late', '3'], ['Absent', '2']],
            columns: ['Employee', 'Department', 'Branch', 'Check In', 'Status'],
            rows: systemAttendance
        },
        'Leave Reports': {
            summary: [['Allowed Leaves', '40 Days'], ['Approved', '5 Requests'], ['Rejected', '3 Requests']],
            columns: ['Employee', 'Department', 'Branch', 'Leave Type', 'Days', 'Dates', 'Status'],
            rows: systemLeaveRequests
        },
        'Retirement Reports': {
            summary: [['Tracked Employees', '10'], ['Eligible Now', '3'], ['Within 1 Month', '5']],
            columns: ['Employee', 'Department', 'Location', 'Age', 'Retirement Date', 'Remaining'],
            rows: systemRetirements
        },
        'Training Reports': {
            summary: [['Courses Created', '12'], ['Mandatory', '7 Sessions'], ['Completed', '6 Sessions']],
            columns: ['Code', 'Training', 'Type', 'Department', 'Branch', 'Date', 'Status'],
            rows: systemTrainings
        },
        'Employee Ranking': {
            summary: [['Eligible', '2'], ['Needs Review', '1'], ['Top Score', '92%']],
            columns: ['Employee', 'Current Role', 'Rank', 'Performance', 'Eligibility'],
            rows: systemRanking
        },
        'Agenda Reports': {
            summary: [['Agendas', '6'], ['Departments', '6'], ['Assigned Employees', '12']],
            columns: ['Department', 'Agenda', 'Agenda Points', 'Assigned Employees'],
            rows: systemAgendaRows
        },
        'Employee Review Reports': {
            summary: [['Reviews Completed', '9'], ['Top Performers', '5'], ['Need Improvement', '2']],
            columns: ['Employee', 'Department', 'Agenda', 'System Performance', 'Status'],
            rows: systemPerformanceRows
        },
        'Top Performers': {
            summary: [['Top Performers', '5'], ['Highest Score', '95%'], ['Completed Reviews', '9']],
            columns: ['Employee', 'Department', 'Agenda', 'System Performance', 'Status'],
            rows: systemPerformanceRows.filter(row => Number(row[3].replace('%', '')) >= 86)
        },
        'Need Improvement': {
            summary: [['Need Improvement', '2'], ['Pending Reviews', '3'], ['Lowest Score', '69%']],
            columns: ['Employee', 'Department', 'Agenda', 'System Performance', 'Status'],
            rows: systemPerformanceRows.filter(row => Number(row[3].replace('%', '')) < 76)
        },
        'Salary Reports': {
            summary: [['Employees', '12'], ['Gross Salary', '$9,220'], ['Net Salary', '$8,815']],
            columns: ['Employee', 'Department', 'Branch', 'Original Salary', 'Absence Deduction', 'Performance Deduction', 'Net Salary'],
            rows: systemPayroll
        },
        'Paid Payroll': {
            summary: [['Payroll Records', '12'], ['Paid Net Salary', '$8,815'], ['Paid Branches', '6']],
            columns: ['Employee', 'Department', 'Branch', 'Original Salary', 'Absence Deduction', 'Performance Deduction', 'Net Salary'],
            rows: systemPayroll
        },
        'Total Deductions': {
            summary: [['Total Deductions', '$405'], ['Absence Deductions', '$260'], ['Performance Deductions', '$145']],
            columns: ['Employee', 'Department', 'Branch', 'Original Salary', 'Absence Deduction', 'Performance Deduction', 'Net Salary'],
            rows: systemPayroll.filter(row => row[4] !== '$0' || row[5] !== '$0')
        },
        'Absence Deductions': {
            summary: [['Absence Deductions', '$260'], ['Affected Employees', '9'], ['Highest Deduction', '$55']],
            columns: ['Employee', 'Department', 'Branch', 'Original Salary', 'Absence Deduction', 'Performance Deduction', 'Net Salary'],
            rows: systemPayroll.filter(row => row[4] !== '$0')
        },
        'Perfomance Deductions': {
            summary: [['Performance Deductions', '$145'], ['Affected Employees', '4'], ['Highest Deduction', '$55']],
            columns: ['Employee', 'Department', 'Branch', 'Original Salary', 'Absence Deduction', 'Performance Deduction', 'Net Salary'],
            rows: systemPayroll.filter(row => row[5] !== '$0')
        },
        'Outstanding Payroll': {
            summary: [['Outstanding Payroll', '$0'], ['Pending Records', '0'], ['Processed Records', '12']],
            columns: ['Employee', 'Department', 'Branch', 'Original Salary', 'Absence Deduction', 'Performance Deduction', 'Net Salary'],
            rows: systemPayroll
        },
        'Branch Attendance': {
            summary: [['Branches', '6'], ['Present', '3'], ['Absent', '2']],
            columns: ['Employee', 'Department', 'Branch', 'Check In', 'Status'],
            rows: systemAttendance
        },
        'Training Summary': {
            summary: [['Courses Created', '12'], ['In Progress', '3 Sessions'], ['Scheduled', '3 Sessions']],
            columns: ['Code', 'Training', 'Type', 'Department', 'Branch', 'Date', 'Status'],
            rows: systemTrainings
        },
        'Leave Summary': {
            summary: [['Allowed Leaves', '40 Days'], ['Approved', '5 Requests'], ['Rejected', '3 Requests']],
            columns: ['Employee', 'Department', 'Branch', 'Leave Type', 'Days', 'Dates', 'Status'],
            rows: systemLeaveRequests
        },
        'Retirement Summary': {
            summary: [['Tracked Employees', '10'], ['Eligible Now', '3'], ['Within 5 Months', '9']],
            columns: ['Employee', 'Department', 'Location', 'Age', 'Retirement Date', 'Remaining'],
            rows: systemRetirements
        },
        'Promotion Requests': {
            summary: [['Eligible Employees', '2'], ['Near Eligible', '1'], ['Under Review', '1']],
            columns: ['Employee', 'Current Role', 'Rank', 'Performance', 'Eligibility'],
            rows: systemRanking
        },
        'Promotion History': {
            summary: [['Ranking Records', '4'], ['Eligible', '2'], ['Review', '1']],
            columns: ['Employee', 'Current Role', 'Rank', 'Performance', 'Eligibility'],
            rows: systemRanking
        },
        'Promotion Summary': {
            summary: [['Eligible Employees', '2'], ['Near Eligible', '1'], ['Top Score', '92%']],
            columns: ['Employee', 'Current Role', 'Rank', 'Performance', 'Eligibility'],
            rows: systemRanking
        }
    });

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
        const generatedDate = 'May 1, 2026';
        const report = reportSamples[reportTitle] || reportSamples['Employee Info'];
        const summaryBoxes = report.summary.map(([label, value]) => `
            <div class="box">${label}<strong>${value}</strong></div>
        `).join('');
        const headings = report.columns.map(column => `<th>${column}</th>`).join('');
        const rows = report.rows.map((row, index) => `
            <tr>
                <td>${index + 1}</td>
                ${row.map(value => `<td>${value}</td>`).join('')}
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
                    .meta { text-align: right; }
                    @media print { button { display: none; } body { margin: 18px; } }
                    @media (max-width: 720px) { .header, .summary { display: block; } .box { margin-top: 10px; } .meta { text-align: left; } }
                </style>
            </head>
            <body>
                <div class="header">
                    <div>
                        <h1>${reportTitle}</h1>
                        <p>${moduleName} report sample generated from HRMS modules.</p>
                    </div>
                    <div class="meta">
                        <p><strong>Generated:</strong> ${generatedDate}</p>
                        <p><strong>Branch:</strong> All Hargeisa Branches</p>
                        <p><strong>Module:</strong> ${moduleName}</p>
                    </div>
                </div>
                <div class="summary">${summaryBoxes}</div>
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            ${headings}
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
