<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRM System - Leave Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
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

        .status-approved {
            background: #dcfce7;
            color: #166534;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-rejected {
            background: #fee2e2;
            color: #991b1b;
        }

        .rule-pill {
            padding: 4px 10px;
            border-radius: 9999px;
            font-size: 0.7rem;
            font-weight: 700;
        }

        .rule-paid {
            background: #dcfce7;
            color: #166534;
        }

        .rule-unpaid {
            background: #f1f5f9;
            color: #475569;
        }

        .rule-approval {
            background: #fef3c7;
            color: #92400e;
        }

        .rule-auto {
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

        .modal-backdrop {
            background: rgba(15, 23, 42, 0.45);
            backdrop-filter: blur(4px);
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
    <?php $currentMenu = 'leave_management'; ?>
    <?php include __DIR__ . '/../../includes/header_sidebar.php'; ?>

    <div class="mx-auto w-full max-w-[1440px] p-4 md:p-8">
        <div class="mb-8 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-slate-800">Leave Management</h2>
                <p class="text-sm text-slate-500">Overview of leave allowances, approval flow, and employee leave requests.</p>
            </div>
            <button id="openLeaveTypeModal" type="button" class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-indigo-500">
                <i class="fa-solid fa-plus text-xs"></i>
                <span>Create Leave Type</span>
            </button>
        </div>

        <div id="leaveInsightCards" class="mb-8 grid grid-cols-1 gap-5 md:grid-cols-3"></div>

        <div class="mb-8 grid grid-cols-1 gap-6 xl:grid-cols-2">
            <div class="glass-card p-6">
                <div class="mb-5">
                    <h3 class="text-base font-semibold text-slate-800">Leave Type Request Stack</h3>
                    <p class="text-xs text-slate-400">Stacked request totals by leave type with approved, rejected, and pending counts.</p>
                </div>
                <div class="h-[320px]">
                    <canvas id="leaveTypeStackedChart"></canvas>
                </div>
            </div>

            <div class="glass-card p-6">
                <div class="mb-5">
                    <h3 class="text-base font-semibold text-slate-800">Department Leave Comparison</h3>
                    <p class="text-xs text-slate-400">Grouped bars showing requests, approved, and rejected counts by department.</p>
                </div>
                <div class="h-[320px]">
                    <canvas id="departmentLeaveChart"></canvas>
                </div>
            </div>
        </div>

        <div class="glass-card mb-8 p-6">
            <div class="mb-5 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                <div>
                    <h3 class="text-base font-semibold text-slate-800">Leave Types &amp; Rules</h3>
                    <p class="text-xs text-slate-400">Configured leave types with yearly limits, paid status, and approval requirements.</p>
                </div>
                <button id="openLeaveTypeModalSecondary" type="button" class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">
                    <i class="fa-solid fa-plus text-xs"></i>
                    <span>Add Type</span>
                </button>
            </div>
            <div class="table-scroll overflow-x-auto">
                <table class="min-w-full text-left">
                    <thead>
                        <tr class="border-b border-slate-100 text-[11px] uppercase tracking-wider text-slate-400">
                            <th class="px-4 py-4 font-semibold">Leave Type</th>
                            <th class="px-4 py-4 font-semibold">Max Days / Year</th>
                            <th class="px-4 py-4 font-semibold">Paid Status</th>
                            <th class="px-4 py-4 font-semibold">Approval Rule</th>
                            <th class="px-4 py-4 font-semibold">Description</th>
                        </tr>
                    </thead>
                    <tbody id="leaveTypeRulesTableBody" class="divide-y divide-slate-50"></tbody>
                </table>
            </div>
        </div>

        <div class="glass-card p-6">
            <div class="mb-5">
                <h3 class="text-base font-semibold text-slate-800">Employee Leave Requests</h3>
                <p class="text-xs text-slate-400">Recent leave requests across branches with mixed approval statuses.</p>
            </div>
            <div class="table-scroll overflow-x-auto">
                <table class="min-w-full text-left">
                    <thead>
                        <tr class="border-b border-slate-100 text-[11px] uppercase tracking-wider text-slate-400">
                            <th class="px-4 py-4 font-semibold">Employee</th>
                            <th class="px-4 py-4 font-semibold">Department</th>
                            <th class="px-4 py-4 font-semibold">Branch</th>
                            <th class="px-4 py-4 font-semibold">Leave Type</th>
                            <th class="px-4 py-4 font-semibold">Days</th>
                            <th class="px-4 py-4 font-semibold">Dates</th>
                            <th class="px-4 py-4 font-semibold">Submitted</th>
                            <th class="px-4 py-4 font-semibold">Status</th>
                            <th class="px-4 py-4 font-semibold">Action</th>
                        </tr>
                    </thead>
                    <tbody id="leaveRequestsTableBody" class="divide-y divide-slate-50"></tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="leaveTypeModal" class="modal-backdrop fixed inset-0 z-50 hidden items-center justify-center p-4">
        <div class="glass-card w-full max-w-3xl overflow-hidden">
            <div class="flex items-start justify-between gap-4 border-b border-slate-100 px-6 py-5">
                <div>
                    <h3 class="text-lg font-semibold text-slate-800">Create Leave Type</h3>
                    <p class="mt-1 text-sm text-slate-500">Define the leave allowance and approval rule.</p>
                </div>
                <button id="closeLeaveTypeModal" type="button" class="flex h-10 w-10 items-center justify-center rounded-full bg-slate-100 text-slate-500 transition hover:bg-slate-200 hover:text-slate-700">
                    <i class="fa-solid fa-xmark text-base"></i>
                </button>
            </div>
            <form id="leaveTypeForm" class="grid gap-5 p-6 md:grid-cols-2">
                <div class="md:col-span-2">
                    <label for="leaveTypeName" class="mb-2 block text-sm font-medium text-slate-600">Leave Type Name</label>
                    <input id="leaveTypeName" name="leaveTypeName" type="text" required class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400" placeholder="Example: Maternity Leave">
                </div>
                <div>
                    <label for="leaveTypeMaxDays" class="mb-2 block text-sm font-medium text-slate-600">Max Days Per Year</label>
                    <input id="leaveTypeMaxDays" name="leaveTypeMaxDays" type="number" min="1" required class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400" placeholder="30">
                </div>
                <div>
                    <label for="leaveTypePaidStatus" class="mb-2 block text-sm font-medium text-slate-600">Paid Status</label>
                    <select id="leaveTypePaidStatus" name="leaveTypePaidStatus" required class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400">
                        <option value="Paid">Paid</option>
                        <option value="Unpaid">Unpaid</option>
                    </select>
                </div>
                <div>
                    <label for="leaveTypeApprovalRule" class="mb-2 block text-sm font-medium text-slate-600">Approval Rule</label>
                    <select id="leaveTypeApprovalRule" name="leaveTypeApprovalRule" required class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400">
                        <option value="Needs Approval">Needs Approval</option>
                        <option value="Auto Approved">No Approval Needed</option>
                    </select>
                </div>
                <div>
                    <label for="leaveTypeDescription" class="mb-2 block text-sm font-medium text-slate-600">Description</label>
                    <input id="leaveTypeDescription" name="leaveTypeDescription" type="text" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400" placeholder="Short rule note">
                </div>
                <div class="md:col-span-2 flex justify-end gap-3 border-t border-slate-100 pt-5">
                    <button id="cancelLeaveTypeModal" type="button" class="rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">Cancel</button>
                    <button type="submit" class="rounded-xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-indigo-500">Save Leave Type</button>
                </div>
            </form>
        </div>
    </div>

    <div id="leaveProofModal" class="modal-backdrop fixed inset-0 z-50 hidden items-center justify-center p-4">
        <div class="glass-card w-full max-w-5xl overflow-hidden">
            <div class="flex items-start justify-between gap-4 border-b border-slate-100 px-6 py-5">
                <div>
                    <h3 class="text-lg font-semibold text-slate-800">Leave Supporting Document</h3>
                    <p id="leaveProofSubtitle" class="mt-1 text-sm text-slate-500"></p>
                </div>
                <button id="closeLeaveProofModal" type="button" class="flex h-10 w-10 items-center justify-center rounded-full bg-slate-100 text-slate-500 transition hover:bg-slate-200 hover:text-slate-700">
                    <i class="fa-solid fa-xmark text-base"></i>
                </button>
            </div>
            <div class="grid gap-5 p-6 xl:grid-cols-[260px_1fr]">
                <div class="rounded-2xl border border-slate-100 bg-slate-50 p-5">
                    <p class="text-[11px] font-semibold uppercase tracking-[0.24em] text-slate-400">Proof Notes</p>
                    <p id="leaveProofNote" class="mt-3 text-sm leading-6 text-slate-600"></p>
                </div>
                <div class="overflow-hidden rounded-2xl border border-slate-100 bg-white">
                    <div class="flex h-[70vh] flex-col">
                        <div id="leaveProofLoadingState" class="flex flex-1 flex-col items-center justify-center gap-3 px-6 text-center">
                            <div class="h-10 w-10 animate-spin rounded-full border-4 border-slate-200 border-t-indigo-600"></div>
                            <p class="text-sm font-medium text-slate-500">Loading supporting document preview...</p>
                        </div>
                        <div id="leaveProofErrorState" class="hidden flex-1 flex-col items-center justify-center gap-3 px-6 text-center">
                            <p class="text-sm font-medium text-slate-600">Preview could not be rendered inside the modal.</p>
                            <a id="leaveProofOpenLink" href="#" target="_blank" rel="noopener noreferrer" class="inline-flex items-center rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-indigo-500">
                                Open Supporting Document
                            </a>
                        </div>
                        <div id="leaveProofCanvasWrap" class="hidden flex-1 overflow-auto bg-slate-100 p-6">
                            <canvas id="leaveProofCanvas" class="mx-auto rounded-xl bg-white shadow-sm"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const desktopSidebarBreakpoint = window.matchMedia('(min-width: 1024px)');
        const leaveInsightCards = document.getElementById('leaveInsightCards');
        const openLeaveTypeModal = document.getElementById('openLeaveTypeModal');
        const openLeaveTypeModalSecondary = document.getElementById('openLeaveTypeModalSecondary');
        const leaveTypeModal = document.getElementById('leaveTypeModal');
        const closeLeaveTypeModal = document.getElementById('closeLeaveTypeModal');
        const cancelLeaveTypeModal = document.getElementById('cancelLeaveTypeModal');
        const leaveTypeForm = document.getElementById('leaveTypeForm');
        const leaveTypeRulesTableBody = document.getElementById('leaveTypeRulesTableBody');
        const leaveRequestsTableBody = document.getElementById('leaveRequestsTableBody');
        const leaveTypeStackedChartCanvas = document.getElementById('leaveTypeStackedChart');
        const departmentLeaveChartCanvas = document.getElementById('departmentLeaveChart');
        const leaveProofModal = document.getElementById('leaveProofModal');
        const closeLeaveProofModal = document.getElementById('closeLeaveProofModal');
        const leaveProofSubtitle = document.getElementById('leaveProofSubtitle');
        const leaveProofNote = document.getElementById('leaveProofNote');
        const leaveProofCanvas = document.getElementById('leaveProofCanvas');
        const leaveProofCanvasWrap = document.getElementById('leaveProofCanvasWrap');
        const leaveProofLoadingState = document.getElementById('leaveProofLoadingState');
        const leaveProofErrorState = document.getElementById('leaveProofErrorState');
        const leaveProofOpenLink = document.getElementById('leaveProofOpenLink');
        let leaveTypeStackedChart = null;
        let departmentLeaveChart = null;
        let leaveProofRenderToken = 0;

        if (window.pdfjsLib) {
            window.pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js';
        }

        const leaveRequests = [
            { name: 'Cabdiraxmaan Cali', employeeId: 'EMP-0001', department: 'Human Resource', branch: 'Idaacada Branch', leaveType: 'Annual Leave', days: 4, startDate: '2026-04-28', endDate: '2026-05-01', submittedOn: '2026-04-20', status: 'Approved', proofFile: 'sample_docs/annual_leave_proof.pdf', proofNote: 'Leave balance approval form signed by the HR branch lead and annual travel booking confirmation for the requested four days.' },
            { name: 'Fadumo Xasan', employeeId: 'EMP-0002', department: 'Finance', branch: 'Xero Awr Branch', leaveType: 'Sick Leave', days: 2, startDate: '2026-04-26', endDate: '2026-04-27', submittedOn: '2026-04-24', status: 'Approved', proofFile: 'sample_docs/medical_leave_note.pdf', proofNote: 'Clinic medical note confirming two days of rest with the doctor stamp attached as acceptable proof for approval.' },
            { name: 'Mahad Axmed', employeeId: 'EMP-0003', department: 'Operations', branch: 'Togdheer Branch', leaveType: 'Emergency Leave', days: 1, startDate: '2026-04-29', endDate: '2026-04-29', submittedOn: '2026-04-25', status: 'Pending', proofFile: 'sample_docs/emergency_leave_letter.pdf', proofNote: 'Emergency request letter submitted by the employee with branch supervisor acknowledgment pending final leave approval.' },
            { name: 'Sahra Maxamed', employeeId: 'EMP-0004', department: 'Marketing', branch: 'Calaamada Branch', leaveType: 'Casual Leave', days: 3, startDate: '2026-05-03', endDate: '2026-05-05', submittedOn: '2026-04-22', status: 'Rejected', proofFile: 'sample_docs/casual_leave_request.pdf', proofNote: 'Casual leave request form submitted without enough operational coverage approval, stored here as the supporting request record.' },
            { name: 'Hodan Ali', employeeId: 'EMP-0005', department: 'Administration', branch: 'Masalaha Branch', leaveType: 'Annual Leave', days: 5, startDate: '2026-05-10', endDate: '2026-05-14', submittedOn: '2026-04-23', status: 'Approved', proofFile: 'sample_docs/annual_leave_proof.pdf', proofNote: 'Five-day annual leave clearance form with manager signature and confirmed handover checklist.' },
            { name: 'Mustafe Cabdi', employeeId: 'EMP-0006', department: 'Information Technology', branch: 'Jigjiga Yar Branch', leaveType: 'Sick Leave', days: 2, startDate: '2026-04-30', endDate: '2026-05-01', submittedOn: '2026-04-25', status: 'Pending', proofFile: 'sample_docs/medical_leave_note.pdf', proofNote: 'Initial treatment note uploaded while the HR office waits for the finalized medical certificate before marking the request approved.' },
            { name: 'Amina Yusuf', employeeId: 'EMP-0007', department: 'Human Resource', branch: 'Idaacada Branch', leaveType: 'Study Leave', days: 4, startDate: '2026-05-06', endDate: '2026-05-09', submittedOn: '2026-04-18', status: 'Rejected', proofFile: 'sample_docs/study_leave_request.pdf', proofNote: 'Course attendance request and registration draft were submitted, but the study leave was declined due to schedule overlap.' },
            { name: 'Roda Jama', employeeId: 'EMP-0008', department: 'Finance', branch: 'Xero Awr Branch', leaveType: 'Casual Leave', days: 1, startDate: '2026-04-27', endDate: '2026-04-27', submittedOn: '2026-04-21', status: 'Approved', proofFile: 'sample_docs/casual_leave_request.pdf', proofNote: 'One-day casual leave request with same-day supervisor sign-off and attendance replacement confirmation.' },
            { name: 'Mahad Axmed', employeeId: 'EMP-0003', department: 'Operations', branch: 'Togdheer Branch', leaveType: 'Annual Leave', days: 2, startDate: '2026-05-02', endDate: '2026-05-03', submittedOn: '2026-04-24', status: 'Pending', proofFile: 'sample_docs/annual_leave_proof.pdf', proofNote: 'Annual leave request file includes balance summary and pending coverage note awaiting operations approval.' },
            { name: 'Sahra Maxamed', employeeId: 'EMP-0004', department: 'Marketing', branch: 'Calaamada Branch', leaveType: 'Sick Leave', days: 1, startDate: '2026-04-26', endDate: '2026-04-26', submittedOn: '2026-04-25', status: 'Rejected', proofFile: 'sample_docs/medical_leave_note.pdf', proofNote: 'Medical note was submitted after the requested leave date, so the evidence remains attached but the request stayed rejected.' },
            { name: 'Fadumo Xasan', employeeId: 'EMP-0002', department: 'Finance', branch: 'Xero Awr Branch', leaveType: 'Emergency Leave', days: 2, startDate: '2026-05-04', endDate: '2026-05-05', submittedOn: '2026-04-23', status: 'Approved', proofFile: 'sample_docs/emergency_leave_letter.pdf', proofNote: 'Emergency family support letter and manager verification note are attached as the approval evidence.' },
            { name: 'Mustafe Cabdi', employeeId: 'EMP-0006', department: 'Information Technology', branch: 'Jigjiga Yar Branch', leaveType: 'Casual Leave', days: 3, startDate: '2026-05-07', endDate: '2026-05-09', submittedOn: '2026-04-22', status: 'Pending', proofFile: 'sample_docs/casual_leave_request.pdf', proofNote: 'Casual leave request is on hold until the branch confirms handover coverage; the uploaded request form is available for review.' }
        ];

        const leaveTypeRules = [
            { name: 'Annual Leave', maxDaysPerYear: 30, paidStatus: 'Paid', approvalRule: 'Needs Approval', description: 'Standard yearly leave allowance for active employees.' },
            { name: 'Sick Leave', maxDaysPerYear: 14, paidStatus: 'Paid', approvalRule: 'Needs Approval', description: 'Medical note required when requested by HR.' },
            { name: 'Emergency Leave', maxDaysPerYear: 5, paidStatus: 'Paid', approvalRule: 'Needs Approval', description: 'Urgent personal or family emergency leave.' },
            { name: 'Casual Leave', maxDaysPerYear: 7, paidStatus: 'Paid', approvalRule: 'Needs Approval', description: 'Short planned leave subject to branch coverage.' },
            { name: 'Study Leave', maxDaysPerYear: 10, paidStatus: 'Unpaid', approvalRule: 'Needs Approval', description: 'Education-related absence after manager review.' }
        ];

        const leaveInsightConfig = [
            { key: 'totalAllowedLeaves', label: 'Total Allowed Leaves', border: 'border-indigo-500', iconBg: 'bg-indigo-50', iconColor: 'text-indigo-600', icon: 'fa-calendar-days', helper: 'Maximum allowance is 5 days per employee' },
            { key: 'totalLeavesApproved', label: 'Total Leaves Approved', border: 'border-emerald-500', iconBg: 'bg-emerald-50', iconColor: 'text-emerald-600', icon: 'fa-circle-check', helper: 'Requests approved in the current sample set' },
            { key: 'totalLeavesRejected', label: 'Total Leaves Rejected', border: 'border-rose-500', iconBg: 'bg-rose-50', iconColor: 'text-rose-600', icon: 'fa-circle-xmark', helper: 'Requests rejected in the current sample set' }
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
            if (status === 'Approved') {
                return 'status-approved';
            }

            if (status === 'Rejected') {
                return 'status-rejected';
            }

            return 'status-pending';
        }

        function getPaidRuleClass(paidStatus) {
            return paidStatus === 'Paid' ? 'rule-paid' : 'rule-unpaid';
        }

        function getApprovalRuleClass(approvalRule) {
            return approvalRule === 'Needs Approval' ? 'rule-approval' : 'rule-auto';
        }

        function showModal(modal) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
        }

        function hideModal(modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        }

        function buildLeaveSummary() {
            const uniqueEmployees = [...new Set(leaveRequests.map(request => request.employeeId))];
            const totalLeavesApproved = leaveRequests.filter(request => request.status === 'Approved').length;
            const totalLeavesRejected = leaveRequests.filter(request => request.status === 'Rejected').length;

            return {
                totalAllowedLeaves: `${uniqueEmployees.length * 5} Days`,
                totalLeavesApproved: `${totalLeavesApproved} Requests`,
                totalLeavesRejected: `${totalLeavesRejected} Requests`
            };
        }

        function renderInsightCards() {
            const leaveSummary = buildLeaveSummary();

            leaveInsightCards.innerHTML = leaveInsightConfig.map(card => `
                <div class="glass-card insight-card border-l-4 ${card.border} p-5">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-500">${card.label}</p>
                            <h3 class="mt-2 text-2xl font-bold text-slate-800">${leaveSummary[card.key]}</h3>
                        </div>
                        <div class="rounded-xl ${card.iconBg} p-3 ${card.iconColor}">
                            <i class="fa-solid ${card.icon} text-lg"></i>
                        </div>
                    </div>
                    <p class="mt-4 text-[11px] font-medium text-slate-400">${card.helper}</p>
                </div>
            `).join('');
        }

        function renderLeaveTypeRulesTable() {
            leaveTypeRulesTableBody.innerHTML = leaveTypeRules.map(rule => `
                <tr class="transition-colors hover:bg-slate-50/70">
                    <td class="px-4 py-4 text-sm font-semibold text-slate-700">${rule.name}</td>
                    <td class="px-4 py-4 text-sm text-slate-600">${rule.maxDaysPerYear} Days</td>
                    <td class="px-4 py-4"><span class="rule-pill ${getPaidRuleClass(rule.paidStatus)}">${rule.paidStatus}</span></td>
                    <td class="px-4 py-4"><span class="rule-pill ${getApprovalRuleClass(rule.approvalRule)}">${rule.approvalRule}</span></td>
                    <td class="px-4 py-4 text-sm text-slate-600">${rule.description || '-'}</td>
                </tr>
            `).join('');
        }

        function buildLeaveTypeStackData() {
            const leaveTypeMap = {};

            leaveRequests.forEach(request => {
                if (!leaveTypeMap[request.leaveType]) {
                    leaveTypeMap[request.leaveType] = { total: 0, approved: 0, rejected: 0, pending: 0 };
                }

                leaveTypeMap[request.leaveType].total += 1;

                if (request.status === 'Approved') {
                    leaveTypeMap[request.leaveType].approved += 1;
                } else if (request.status === 'Rejected') {
                    leaveTypeMap[request.leaveType].rejected += 1;
                } else {
                    leaveTypeMap[request.leaveType].pending += 1;
                }
            });

            const labels = Object.keys(leaveTypeMap);

            return {
                labels,
                total: labels.map(label => leaveTypeMap[label].total),
                approved: labels.map(label => leaveTypeMap[label].approved),
                rejected: labels.map(label => leaveTypeMap[label].rejected),
                pending: labels.map(label => leaveTypeMap[label].pending)
            };
        }

        function buildDepartmentGroupData() {
            const departmentMap = {};

            leaveRequests.forEach(request => {
                if (!departmentMap[request.department]) {
                    departmentMap[request.department] = { requests: 0, approved: 0, rejected: 0 };
                }

                departmentMap[request.department].requests += 1;

                if (request.status === 'Approved') {
                    departmentMap[request.department].approved += 1;
                } else if (request.status === 'Rejected') {
                    departmentMap[request.department].rejected += 1;
                }
            });

            const labels = Object.keys(departmentMap);

            return {
                labels,
                requests: labels.map(label => departmentMap[label].requests),
                approved: labels.map(label => departmentMap[label].approved),
                rejected: labels.map(label => departmentMap[label].rejected)
            };
        }

        function renderLeaveTypeStackedChart() {
            if (!leaveTypeStackedChartCanvas || typeof Chart === 'undefined') {
                return;
            }

            const stackData = buildLeaveTypeStackData();

            if (leaveTypeStackedChart) {
                leaveTypeStackedChart.destroy();
            }

            leaveTypeStackedChart = new Chart(leaveTypeStackedChartCanvas, {
                type: 'bar',
                data: {
                    labels: stackData.labels,
                    datasets: [
                        { label: 'Total Requests', data: stackData.total, backgroundColor: '#4f46e5' },
                        { label: 'Approved', data: stackData.approved, backgroundColor: '#10b981' },
                        { label: 'Rejected', data: stackData.rejected, backgroundColor: '#ef4444' },
                        { label: 'Pending', data: stackData.pending, backgroundColor: '#f59e0b' }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            stacked: true,
                            grid: { display: false }
                        },
                        y: {
                            stacked: true,
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

        function renderDepartmentLeaveChart() {
            if (!departmentLeaveChartCanvas || typeof Chart === 'undefined') {
                return;
            }

            const departmentData = buildDepartmentGroupData();

            if (departmentLeaveChart) {
                departmentLeaveChart.destroy();
            }

            departmentLeaveChart = new Chart(departmentLeaveChartCanvas, {
                type: 'bar',
                data: {
                    labels: departmentData.labels,
                    datasets: [
                        { label: 'Requests', data: departmentData.requests, backgroundColor: '#4f46e5', borderRadius: 8 },
                        { label: 'Approved', data: departmentData.approved, backgroundColor: '#10b981', borderRadius: 8 },
                        { label: 'Rejected', data: departmentData.rejected, backgroundColor: '#ef4444', borderRadius: 8 }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            stacked: false,
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

        function renderLeaveRequestsTable() {
            leaveRequestsTableBody.innerHTML = leaveRequests.map((request, index) => `
                <tr class="transition-colors hover:bg-slate-50/70">
                    <td class="px-4 py-4">
                        <div>
                            <p class="text-sm font-semibold text-slate-700">${request.name}</p>
                            <p class="text-[11px] text-slate-400">${request.employeeId}</p>
                        </div>
                    </td>
                    <td class="px-4 py-4 text-sm text-slate-600">${request.department}</td>
                    <td class="px-4 py-4 text-sm text-slate-600">${request.branch}</td>
                    <td class="px-4 py-4 text-sm text-slate-600">${request.leaveType}</td>
                    <td class="px-4 py-4 text-sm text-slate-600">${request.days}</td>
                    <td class="px-4 py-4 text-sm text-slate-600">${request.startDate} <span class="text-slate-400">to</span> ${request.endDate}</td>
                    <td class="px-4 py-4 text-sm text-slate-600">${request.submittedOn}</td>
                    <td class="px-4 py-4"><span class="status-pill ${getStatusClass(request.status)}">${request.status}</span></td>
                    <td class="px-4 py-4">
                        <button type="button" class="view-leave-proof flex h-9 w-9 items-center justify-center rounded-xl bg-slate-100 text-slate-500 transition hover:bg-indigo-50 hover:text-indigo-600" data-leave-index="${index}">
                            <i class="fa-regular fa-eye text-sm"></i>
                        </button>
                    </td>
                </tr>
            `).join('');
        }

        function setLeaveProofState(state) {
            leaveProofLoadingState.classList.toggle('hidden', state !== 'loading');
            leaveProofErrorState.classList.toggle('hidden', state !== 'error');
            leaveProofCanvasWrap.classList.toggle('hidden', state !== 'ready');
        }

        async function renderLeaveProof(proofUrl, token) {
            if (!window.pdfjsLib) {
                setLeaveProofState('error');
                return;
            }

            try {
                setLeaveProofState('loading');
                const loadingTask = window.pdfjsLib.getDocument(proofUrl);
                const pdf = await loadingTask.promise;
                const page = await pdf.getPage(1);

                if (token !== leaveProofRenderToken) {
                    return;
                }

                const viewport = page.getViewport({ scale: 1.3 });
                const context = leaveProofCanvas.getContext('2d');
                leaveProofCanvas.width = viewport.width;
                leaveProofCanvas.height = viewport.height;

                await page.render({
                    canvasContext: context,
                    viewport
                }).promise;

                if (token !== leaveProofRenderToken) {
                    return;
                }

                setLeaveProofState('ready');
            } catch (error) {
                setLeaveProofState('error');
            }
        }

        function showLeaveProof(index) {
            const request = leaveRequests[index];

            if (!request) {
                return;
            }

            leaveProofSubtitle.textContent = `${request.name} (${request.employeeId}) - ${request.leaveType}`;
            leaveProofNote.textContent = request.proofNote;
            const proofUrl = `${request.proofFile}?v=${Date.now()}`;
            leaveProofOpenLink.href = proofUrl;
            leaveProofRenderToken += 1;
            leaveProofModal.classList.remove('hidden');
            leaveProofModal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
            renderLeaveProof(proofUrl, leaveProofRenderToken);
        }

        function hideLeaveProof() {
            leaveProofModal.classList.add('hidden');
            leaveProofModal.classList.remove('flex');
            leaveProofCanvas.width = 0;
            leaveProofCanvas.height = 0;
            leaveProofRenderToken += 1;
            leaveProofOpenLink.href = '#';
            document.body.classList.remove('overflow-hidden');
            setLeaveProofState('loading');
        }

        function openLeaveTypeFormModal() {
            leaveTypeForm.reset();
            showModal(leaveTypeModal);
        }

        function closeLeaveTypeFormModal() {
            hideModal(leaveTypeModal);
        }

        sidebarToggle.addEventListener('click', handleSidebarToggle);
        sidebarOverlay.addEventListener('click', closeMobileSidebar);
        window.addEventListener('resize', syncSidebarMode);
        openLeaveTypeModal.addEventListener('click', openLeaveTypeFormModal);
        openLeaveTypeModalSecondary.addEventListener('click', openLeaveTypeFormModal);
        closeLeaveTypeModal.addEventListener('click', closeLeaveTypeFormModal);
        cancelLeaveTypeModal.addEventListener('click', closeLeaveTypeFormModal);
        leaveTypeModal.addEventListener('click', event => {
            if (event.target === leaveTypeModal) {
                closeLeaveTypeFormModal();
            }
        });
        leaveTypeForm.addEventListener('submit', event => {
            event.preventDefault();
            const formData = new FormData(leaveTypeForm);

            leaveTypeRules.unshift({
                name: formData.get('leaveTypeName'),
                maxDaysPerYear: Number(formData.get('leaveTypeMaxDays')),
                paidStatus: formData.get('leaveTypePaidStatus'),
                approvalRule: formData.get('leaveTypeApprovalRule'),
                description: formData.get('leaveTypeDescription') || 'No description added.'
            });

            renderLeaveTypeRulesTable();
            closeLeaveTypeFormModal();
        });
        closeLeaveProofModal.addEventListener('click', hideLeaveProof);
        leaveProofModal.addEventListener('click', event => {
            if (event.target === leaveProofModal) {
                hideLeaveProof();
            }
        });
        leaveRequestsTableBody.addEventListener('click', event => {
            const trigger = event.target.closest('.view-leave-proof');

            if (!trigger) {
                return;
            }

            showLeaveProof(Number(trigger.dataset.leaveIndex));
        });

        renderInsightCards();
        renderLeaveTypeRulesTable();
        renderLeaveTypeStackedChart();
        renderDepartmentLeaveChart();
        renderLeaveRequestsTable();
        syncSidebarMode();
    </script>
</body>
</html>
