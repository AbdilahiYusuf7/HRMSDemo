<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRM System - Employee Ranking</title>
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

        .status-pill {
            padding: 4px 12px;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .status-eligible {
            background: #dcfce7;
            color: #166534;
        }

        .status-near {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .status-not {
            background: #fee2e2;
            color: #991b1b;
        }

        .status-review {
            background: #fef3c7;
            color: #92400e;
        }

        .performance-high {
            color: #166534;
        }

        .performance-mid {
            color: #1d4ed8;
        }

        .performance-low {
            color: #991b1b;
        }

        .action-menu {
            box-shadow: 0 20px 40px -24px rgba(15, 23, 42, 0.35);
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
    <?php $currentMenu = 'employee_ranking'; ?>
    <?php include __DIR__ . '/../../includes/header_sidebar.php'; ?>
    <style>
        #employeeRankingTableBody .ranking-action-menu a,
        #employeeRankingTableBody .ranking-action-menu button:not(:disabled) {
            background: #ffffff !important;
            border-color: transparent !important;
            color: #0f172a !important;
            box-shadow: none !important;
        }

        #employeeRankingTableBody .ranking-action-menu a:hover,
        #employeeRankingTableBody .ranking-action-menu button:not(:disabled):hover {
            background: #cde9f8 !important;
            filter: none !important;
            box-shadow: none !important;
        }
    </style>

    <div class="mx-auto w-full max-w-[1440px] p-4 md:p-8">
        <div class="mb-8 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-slate-800">Employee Ranking</h2>
                <p class="text-sm text-slate-500">Rank employees by role, grade, qualification, and promotion readiness across the organization.</p>
            </div>
        </div>

        <div id="rankingInsightCards" class="mb-8 grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-3"></div>

        <div class="glass-card mb-8 p-6">
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-5">
                <div class="xl:col-span-1">
                    <label for="employeeSearchFilter" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Employee Search</label>
                    <div class="flex items-center rounded-xl border border-slate-200 bg-white px-4 py-3 focus-within:border-indigo-400 focus-within:ring-2 focus-within:ring-indigo-100">
                        <i class="fa-solid fa-magnifying-glass mr-3 text-sm text-slate-400"></i>
                        <input id="employeeSearchFilter" type="text" placeholder="Search employee name or ID" class="w-full bg-transparent text-sm text-slate-600 outline-none">
                    </div>
                </div>
                <div>
                    <label for="organizationFilter" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Organization</label>
                    <select id="organizationFilter" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                        <option value="All Organizations">All Organizations</option>
                        <option value="HRMS Pro">HRMS Pro</option>
                    </select>
                </div>
                <div>
                    <label for="branchFilter" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Branch / Location</label>
                    <select id="branchFilter" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                        <option value="All Branches">All Branches</option>
                    </select>
                </div>
                <div>
                    <label for="departmentFilter" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Department</label>
                    <select id="departmentFilter" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                        <option value="All Departments">All Departments</option>
                    </select>
                </div>
                <div>
                    <label for="teamFilter" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Team</label>
                    <select id="teamFilter" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                        <option value="All Teams">All Teams</option>
                    </select>
                </div>
                <div>
                    <label for="roleFilter" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Role</label>
                    <select id="roleFilter" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                        <option value="All Roles">All Roles</option>
                    </select>
                </div>
                <div>
                    <label for="rankFilter" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Current Rank</label>
                    <select id="rankFilter" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                        <option value="All Ranks">All Ranks</option>
                    </select>
                </div>
                <div>
                    <label for="gradeFilter" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Current Grade</label>
                    <select id="gradeFilter" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                        <option value="All Grades">All Grades</option>
                    </select>
                </div>
                <div>
                    <label for="eligibilityStatusFilter" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Eligibility Status</label>
                    <select id="eligibilityStatusFilter" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                        <option value="All">All</option>
                        <option value="Eligible">Eligible</option>
                        <option value="Nearly Eligible">Nearly Eligible</option>
                        <option value="Not Eligible">Not Eligible</option>
                        <option value="Under Review">Under Review</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="glass-card overflow-hidden">
            <div class="border-b border-slate-100 px-6 py-5">
                <h3 class="text-base font-semibold text-slate-800">Employee Ranking Register</h3>
                <p class="mt-1 text-xs text-slate-400">Operational list of employee ranking, grades, qualifications, and eligibility status.</p>
            </div>
            <div class="table-scroll overflow-x-auto">
                <table class="min-w-full text-left">
                    <thead>
                        <tr class="border-b border-slate-100 text-[11px] uppercase tracking-[0.18em] text-slate-400">
                            <th class="px-5 py-4 font-semibold">Employee</th>
                            <th class="px-5 py-4 font-semibold">Employee ID</th>
                            <th class="px-5 py-4 font-semibold">Department</th>
                            <th class="px-5 py-4 font-semibold">Current Role</th>
                            <th class="px-5 py-4 font-semibold">Rank</th>
                            <th class="px-5 py-4 font-semibold">Grade</th>
                            <th class="px-5 py-4 font-semibold">Date Joined</th>
                            <th class="px-5 py-4 font-semibold">Years In Role</th>
                            <th class="px-5 py-4 font-semibold">Performance</th>
                            <th class="px-5 py-4 font-semibold">Qualification</th>
                            <th class="px-5 py-4 font-semibold">Eligibility</th>
                            <th class="px-5 py-4 font-semibold">Status</th>
                            <th class="px-5 py-4 font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="employeeRankingTableBody" class="divide-y divide-slate-50"></tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="startPromotionModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 sm:p-6">
        <div class="modal-backdrop absolute inset-0"></div>
        <div class="glass-card dialog-panel relative z-10 mx-auto flex max-h-[calc(100vh-3rem)] w-full max-w-5xl flex-col overflow-hidden">
            <div class="flex items-start justify-between gap-4 border-b border-slate-100 px-6 py-5 sm:px-7">
                <div>
                    <h3 class="text-lg font-semibold text-slate-800">New Promotion Request</h3>
                    <p class="mt-1 text-sm text-slate-500">Create promotion requests without backend submission logic.</p>
                </div>
                <button id="closeStartPromotionModal" type="button" class="flex h-12 w-12 items-center justify-center rounded-2xl border border-slate-200 bg-white text-slate-600 transition hover:bg-slate-50 hover:text-slate-800">
                    <i class="fa-solid fa-xmark text-base"></i>
                </button>
            </div>
            <div class="max-h-[calc(100vh-13rem)] overflow-y-auto">
                <form id="startPromotionForm" class="grid gap-5 p-6 md:grid-cols-2 sm:px-7 sm:pb-7">
                    <div>
                        <label for="promotionEmployee" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Employee</label>
                        <select id="promotionEmployee" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100"></select>
                    </div>
                    <div>
                        <label for="promotionCurrentDepartment" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Current Department</label>
                        <input id="promotionCurrentDepartment" type="text" readonly class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 outline-none">
                    </div>
                    <div>
                        <label for="promotionCurrentRole" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Current Role</label>
                        <input id="promotionCurrentRole" type="text" readonly class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 outline-none">
                    </div>
                    <div>
                        <label for="promotionCurrentRankGrade" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Current Rank / Grade</label>
                        <input id="promotionCurrentRankGrade" type="text" readonly class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 outline-none">
                    </div>
                    <div>
                        <label for="promotionProposedDepartment" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Proposed Department</label>
                        <select id="promotionProposedDepartment" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                            <option>Human Resource</option>
                            <option>Finance</option>
                            <option>Operations</option>
                            <option>Marketing</option>
                            <option>Administration</option>
                            <option>Information Technology</option>
                        </select>
                    </div>
                    <div>
                        <label for="promotionProposedRole" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Proposed Role</label>
                        <input id="promotionProposedRole" type="text" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                    </div>
                    <div>
                        <label for="promotionProposedRankGrade" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Proposed Rank / Grade</label>
                        <input id="promotionProposedRankGrade" type="text" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                    </div>
                    <div>
                        <label for="promotionEffectiveDate" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Effective Date</label>
                        <input id="promotionEffectiveDate" type="text" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                    </div>
                    <div>
                        <label for="promotionReason" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Promotion Reason</label>
                        <select id="promotionReason" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                            <option>Performance based progression</option>
                            <option>Leadership readiness</option>
                            <option>Qualification upgrade</option>
                            <option>Succession planning</option>
                        </select>
                    </div>
                    <div>
                        <label for="promotionBasis" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Basis of Promotion</label>
                        <input id="promotionBasis" type="text" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                    </div>
                    <div class="md:col-span-2">
                        <label for="promotionNotes" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Notes</label>
                        <textarea id="promotionNotes" rows="5" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100"></textarea>
                    </div>
                    <div>
                        <label for="promotionSalaryImpact" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Salary Impact Placeholder</label>
                        <input id="promotionSalaryImpact" type="text" readonly class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 outline-none">
                    </div>
                    <div>
                        <label class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Supporting Document Upload</label>
                        <div class="rounded-2xl border border-dashed border-slate-300 bg-slate-50 px-4 py-6 text-center text-sm font-medium text-slate-400">
                            Upload placeholder
                        </div>
                    </div>
                    <div class="md:col-span-2 flex justify-end gap-3 border-t border-slate-100 pt-5">
                        <button id="cancelStartPromotionModal" type="button" class="rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">Cancel</button>
                        <button type="button" class="rounded-xl bg-indigo-50 px-4 py-3 text-sm font-semibold text-indigo-600 transition hover:bg-indigo-100">Save Draft</button>
                        <button type="button" class="rounded-xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-indigo-500">Submit Request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="recordQualificationModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 sm:p-6">
        <div class="modal-backdrop absolute inset-0"></div>
        <div class="glass-card dialog-panel relative z-10 mx-auto flex max-h-[calc(100vh-3rem)] w-full max-w-5xl flex-col overflow-hidden">
            <div class="flex items-start justify-between gap-4 border-b border-slate-100 px-6 py-5 sm:px-7">
                <div>
                    <h3 class="text-lg font-semibold text-slate-800">Record Qualification</h3>
                    <p class="mt-1 text-sm text-slate-500">Qualification capture UI for promotion readiness workflows.</p>
                </div>
                <button id="closeRecordQualificationModal" type="button" class="flex h-12 w-12 items-center justify-center rounded-2xl border border-slate-200 bg-white text-slate-600 transition hover:bg-slate-50 hover:text-slate-800">
                    <i class="fa-solid fa-xmark text-base"></i>
                </button>
            </div>
            <div class="max-h-[calc(100vh-13rem)] overflow-y-auto">
                <form id="recordQualificationForm" class="grid gap-5 p-6 md:grid-cols-2 sm:px-7 sm:pb-7">
                    <div>
                        <label for="qualificationEmployee" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Employee</label>
                        <select id="qualificationEmployee" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100"></select>
                    </div>
                    <div>
                        <label for="qualificationType" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Qualification Type</label>
                        <select id="qualificationType" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                            <option>Degree</option>
                            <option>Certificate</option>
                            <option>Diploma</option>
                            <option>Professional License</option>
                        </select>
                    </div>
                    <div>
                        <label for="qualificationName" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Degree / Certificate Name</label>
                        <input id="qualificationName" type="text" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                    </div>
                    <div>
                        <label for="qualificationInstitution" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Institution / Awarding Body</label>
                        <input id="qualificationInstitution" type="text" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                    </div>
                    <div>
                        <label for="qualificationAwardDate" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Award Date</label>
                        <input id="qualificationAwardDate" type="text" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                    </div>
                    <div>
                        <label for="qualificationExpiryDate" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Expiry Date</label>
                        <input id="qualificationExpiryDate" type="text" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                    </div>
                    <div class="md:col-span-1">
                        <label for="qualificationFieldOfStudy" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Field Of Study</label>
                        <input id="qualificationFieldOfStudy" type="text" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                    </div>
                    <div class="md:col-span-2">
                        <label for="qualificationNotes" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Notes</label>
                        <textarea id="qualificationNotes" rows="5" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100"></textarea>
                    </div>
                    <div class="md:col-span-2">
                        <label class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Proof Upload</label>
                        <div class="rounded-2xl border border-dashed border-slate-300 bg-slate-50 px-4 py-6 text-center text-sm font-medium text-slate-400">
                            Upload placeholder
                        </div>
                    </div>
                    <div class="md:col-span-2 flex justify-end gap-3 border-t border-slate-100 pt-5">
                        <button id="cancelRecordQualificationModal" type="button" class="rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">Cancel</button>
                        <button type="button" class="rounded-xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-indigo-500">Save Qualification</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="eligibilityReviewModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 sm:p-6">
        <div class="modal-backdrop absolute inset-0"></div>
        <div class="glass-card dialog-panel relative z-10 mx-auto flex max-h-[calc(100vh-3rem)] w-full max-w-5xl flex-col overflow-hidden">
            <div class="flex items-start justify-between gap-4 border-b border-slate-100 px-6 py-5 sm:px-7">
                <div>
                    <h3 class="text-lg font-semibold text-slate-800">Eligibility Review</h3>
                    <p class="mt-1 text-sm text-slate-500">Static review result panel for promotion readiness checks.</p>
                </div>
                <button id="closeEligibilityReviewModal" type="button" class="flex h-12 w-12 items-center justify-center rounded-2xl border border-slate-200 bg-white text-slate-600 transition hover:bg-slate-50 hover:text-slate-800">
                    <i class="fa-solid fa-xmark text-base"></i>
                </button>
            </div>
            <div class="max-h-[calc(100vh-13rem)] overflow-y-auto px-6 py-5 sm:px-7">
                <div class="divide-y divide-slate-100">
                    <div class="grid grid-cols-[1fr_auto] items-center gap-4 py-4">
                        <p class="text-sm font-semibold text-slate-400">Employee</p>
                        <p id="eligibilityReviewEmployee" class="text-sm font-semibold text-slate-800"></p>
                    </div>
                    <div class="grid grid-cols-[1fr_auto] items-center gap-4 py-4">
                        <p class="text-sm font-semibold text-slate-400">Current Role / Rank</p>
                        <p id="eligibilityReviewRoleRank" class="text-sm font-semibold text-slate-800"></p>
                    </div>
                    <div class="grid grid-cols-[1fr_auto] items-center gap-4 py-4">
                        <p class="text-sm font-semibold text-slate-400">Performance Score</p>
                        <p id="eligibilityReviewPerformance" class="text-sm font-semibold text-slate-800"></p>
                    </div>
                    <div class="grid grid-cols-[1fr_auto] items-center gap-4 py-4">
                        <p class="text-sm font-semibold text-slate-400">Tenure</p>
                        <p id="eligibilityReviewTenure" class="text-sm font-semibold text-slate-800"></p>
                    </div>
                    <div class="grid grid-cols-[1fr_auto] items-center gap-4 py-4">
                        <p class="text-sm font-semibold text-slate-400">Qualifications</p>
                        <p id="eligibilityReviewQualification" class="text-sm font-semibold text-slate-800"></p>
                    </div>
                </div>

                <div class="mt-5 space-y-4">
                    <div class="rounded-3xl border border-slate-100 bg-slate-50 px-5 py-5">
                        <h4 class="text-sm font-semibold text-slate-800">Missing Conditions</h4>
                        <p id="eligibilityReviewMissingConditions" class="mt-3 text-sm font-medium text-slate-500"></p>
                    </div>
                    <div class="rounded-3xl border border-slate-100 bg-slate-50 px-5 py-5">
                        <h4 class="text-sm font-semibold text-slate-800">Recommendation</h4>
                        <p id="eligibilityReviewRecommendation" class="mt-3 text-sm font-medium text-slate-500"></p>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap justify-end gap-3 border-t border-slate-100 px-6 py-5 sm:px-7">
                <button id="cancelEligibilityReviewModal" type="button" class="rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">Close</button>
                <button id="openQualificationFromEligibility" type="button" class="rounded-xl bg-indigo-50 px-4 py-3 text-sm font-semibold text-indigo-600 transition hover:bg-indigo-100">Record Qualification</button>
                <button id="openPromotionFromEligibility" type="button" class="rounded-xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-indigo-500">Start Promotion</button>
            </div>
        </div>
    </div>

    <!-- Performance Review Modal -->
    <div id="performanceReviewModal" class="fixed inset-0 z-[60] hidden items-center justify-center p-4">
        <div class="modal-backdrop absolute inset-0 bg-slate-900/40 backdrop-blur-sm"></div>
        <div class="glass-card relative z-10 w-full max-w-2xl overflow-hidden">
            <div class="flex items-center justify-between border-b border-slate-100 px-6 py-5">
                <div>
                    <h3 class="text-lg font-semibold text-slate-800">Performance Review</h3>
                    <p class="text-xs text-slate-400" id="reviewModalSubtitle">Detailed performance assessment and promotion requirements.</p>
                </div>
                <button type="button" id="closePerformanceReviewModal" class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-50 text-slate-500 transition hover:bg-slate-100">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="max-h-[80vh] overflow-y-auto p-6 space-y-5">
                <!-- Employee Summary -->
                <div class="flex items-center gap-4 rounded-2xl border border-slate-100 bg-slate-50 p-4">
                    <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-indigo-600 text-white font-bold text-lg" id="reviewEmployeeAvatar">C</div>
                    <div>
                        <p class="text-sm font-bold text-slate-800" id="reviewEmployeeName">Cabdiraxmaan Cali</p>
                        <p class="text-xs text-slate-500" id="reviewEmployeeRole">Human Resource Director &middot; EMP-0001</p>
                    </div>
                    <span class="ml-auto rounded-full bg-indigo-50 px-3 py-1 text-xs font-bold text-indigo-600" id="reviewEmployeeEligibility">Eligible</span>
                </div>

                <!-- Performance Metrics -->
                <div>
                    <p class="mb-3 text-xs font-semibold uppercase tracking-wide text-slate-400">Performance Metrics</p>
                    <div class="grid grid-cols-2 gap-3 sm:grid-cols-4">
                        <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4 text-center">
                            <p class="text-xs text-slate-400">Score</p>
                            <p class="mt-1 text-xl font-bold text-indigo-600" id="reviewScore">92%</p>
                        </div>
                        <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4 text-center">
                            <p class="text-xs text-slate-400">Tenure</p>
                            <p class="mt-1 text-xl font-bold text-slate-700" id="reviewTenure">4 yrs</p>
                        </div>
                        <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4 text-center">
                            <p class="text-xs text-slate-400">Rank</p>
                            <p class="mt-1 text-base font-bold text-slate-700" id="reviewRank">Director I</p>
                        </div>
                        <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4 text-center">
                            <p class="text-xs text-slate-400">Grade</p>
                            <p class="mt-1 text-xl font-bold text-slate-700" id="reviewGrade">G9</p>
                        </div>
                    </div>
                </div>

                <!-- Promotion Requirements Checklist -->
                <div>
                    <p class="mb-3 text-xs font-semibold uppercase tracking-wide text-slate-400">Promotion Requirements</p>
                    <div class="space-y-2" id="reviewRequirementsList"></div>
                </div>

                <!-- Notes -->
                <div class="rounded-2xl border border-slate-100 bg-amber-50 p-4">
                    <p class="text-xs font-semibold uppercase tracking-wide text-amber-600">Reviewer Notes</p>
                    <p class="mt-2 text-sm text-amber-700" id="reviewNotes">All criteria are met. Employee is ready for the next promotion cycle.</p>
                </div>
            </div>
            <div class="flex flex-wrap justify-end gap-3 border-t border-slate-100 px-6 py-5">
                <button id="cancelPerformanceReviewModal" type="button" class="rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">Close</button>
                <button id="reviewRejectBtn" type="button" class="rounded-xl bg-rose-50 px-4 py-3 text-sm font-semibold text-rose-600 transition hover:bg-rose-100"><i class="fa-solid fa-xmark mr-1"></i>Reject</button>
                <button id="reviewApproveBtn" type="button" class="rounded-xl bg-emerald-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-emerald-500"><i class="fa-solid fa-check mr-1"></i>Approve</button>
            </div>
        </div>
    </div>

    <script>
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const desktopSidebarBreakpoint = window.matchMedia('(min-width: 1024px)');
        const rankingInsightCards = document.getElementById('rankingInsightCards');
        const employeeRankingTableBody = document.getElementById('employeeRankingTableBody');
        const employeeSearchFilter = document.getElementById('employeeSearchFilter');
        const organizationFilter = document.getElementById('organizationFilter');
        const branchFilter = document.getElementById('branchFilter');
        const departmentFilter = document.getElementById('departmentFilter');
        const teamFilter = document.getElementById('teamFilter');
        const roleFilter = document.getElementById('roleFilter');
        const rankFilter = document.getElementById('rankFilter');
        const gradeFilter = document.getElementById('gradeFilter');
        const eligibilityStatusFilter = document.getElementById('eligibilityStatusFilter');
        const startPromotionModal = document.getElementById('startPromotionModal');
        const closeStartPromotionModal = document.getElementById('closeStartPromotionModal');
        const cancelStartPromotionModal = document.getElementById('cancelStartPromotionModal');
        const promotionEmployee = document.getElementById('promotionEmployee');
        const promotionCurrentDepartment = document.getElementById('promotionCurrentDepartment');
        const promotionCurrentRole = document.getElementById('promotionCurrentRole');
        const promotionCurrentRankGrade = document.getElementById('promotionCurrentRankGrade');
        const promotionProposedDepartment = document.getElementById('promotionProposedDepartment');
        const promotionProposedRole = document.getElementById('promotionProposedRole');
        const promotionProposedRankGrade = document.getElementById('promotionProposedRankGrade');
        const promotionEffectiveDate = document.getElementById('promotionEffectiveDate');
        const promotionReason = document.getElementById('promotionReason');
        const promotionBasis = document.getElementById('promotionBasis');
        const promotionNotes = document.getElementById('promotionNotes');
        const promotionSalaryImpact = document.getElementById('promotionSalaryImpact');
        const recordQualificationModal = document.getElementById('recordQualificationModal');
        const closeRecordQualificationModal = document.getElementById('closeRecordQualificationModal');
        const cancelRecordQualificationModal = document.getElementById('cancelRecordQualificationModal');
        const qualificationEmployee = document.getElementById('qualificationEmployee');
        const qualificationType = document.getElementById('qualificationType');
        const qualificationName = document.getElementById('qualificationName');
        const qualificationInstitution = document.getElementById('qualificationInstitution');
        const qualificationAwardDate = document.getElementById('qualificationAwardDate');
        const qualificationExpiryDate = document.getElementById('qualificationExpiryDate');
        const qualificationFieldOfStudy = document.getElementById('qualificationFieldOfStudy');
        const qualificationNotes = document.getElementById('qualificationNotes');
        const eligibilityReviewModal = document.getElementById('eligibilityReviewModal');
        const closeEligibilityReviewModal = document.getElementById('closeEligibilityReviewModal');
        const cancelEligibilityReviewModal = document.getElementById('cancelEligibilityReviewModal');
        const openQualificationFromEligibility = document.getElementById('openQualificationFromEligibility');
        const openPromotionFromEligibility = document.getElementById('openPromotionFromEligibility');
        const eligibilityReviewEmployee = document.getElementById('eligibilityReviewEmployee');
        const eligibilityReviewRoleRank = document.getElementById('eligibilityReviewRoleRank');
        const eligibilityReviewPerformance = document.getElementById('eligibilityReviewPerformance');
        const eligibilityReviewTenure = document.getElementById('eligibilityReviewTenure');
        const eligibilityReviewQualification = document.getElementById('eligibilityReviewQualification');
        const eligibilityReviewMissingConditions = document.getElementById('eligibilityReviewMissingConditions');
        const eligibilityReviewRecommendation = document.getElementById('eligibilityReviewRecommendation');
        let activeActionMenu = null;
        let activeEligibilityEmployeeId = null;

        const employeeRankingRecords = [
            { name: 'Cabdiraxmaan Cali', employeeId: 'EMP-0001', organization: 'HRMS Pro', branch: 'Idaacada Branch', department: 'Human Resource', team: 'People Operations', currentRole: 'Human Resource Director', rank: 'Director I', grade: 'G9', dateJoined: '2021-01-12', yearsInRole: 4, performance: '92%', performanceLevel: 'high', qualification: 'Master Degree', eligibility: 'Eligible', status: 'Active' },
            { name: 'Fadumo Xasan', employeeId: 'EMP-0002', organization: 'HRMS Pro', branch: 'Xero Awr Branch', department: 'Finance', team: 'Payroll', currentRole: 'Finance Officer', rank: 'Officer III', grade: 'G7', dateJoined: '2020-11-07', yearsInRole: 4, performance: '95%', performanceLevel: 'high', qualification: 'Bachelor Degree', eligibility: 'Eligible', status: 'On Leave' },
            { name: 'Mahad Axmed', employeeId: 'EMP-0003', organization: 'HRMS Pro', branch: 'Togdheer Branch', department: 'Operations', team: 'Branch Response', currentRole: 'Operations Supervisor', rank: 'Supervisor', grade: 'G8', dateJoined: '2019-08-16', yearsInRole: 5, performance: '90%', performanceLevel: 'high', qualification: 'Advanced Diploma', eligibility: 'Eligible', status: 'Active' },
            { name: 'Sahra Maxamed', employeeId: 'EMP-0004', organization: 'HRMS Pro', branch: 'Calaamada Branch', department: 'Marketing', team: 'Campaigns', currentRole: 'Marketing Coordinator', rank: 'Coordinator', grade: 'G5', dateJoined: '2023-03-03', yearsInRole: 2, performance: '76%', performanceLevel: 'mid', qualification: 'Bachelor Degree', eligibility: 'Nearly Eligible', status: 'Inactive' },
            { name: 'Hodan Ali', employeeId: 'EMP-0005', organization: 'HRMS Pro', branch: 'Masalaha Branch', department: 'Administration', team: 'Office Operations', currentRole: 'Administration Officer', rank: 'Officer I', grade: 'G5', dateJoined: '2022-05-18', yearsInRole: 3, performance: '84%', performanceLevel: 'mid', qualification: 'Diploma', eligibility: 'Nearly Eligible', status: 'Active' },
            { name: 'Mustafe Cabdi', employeeId: 'EMP-0006', organization: 'HRMS Pro', branch: 'Jigjiga Yar Branch', department: 'Information Technology', team: 'Infrastructure', currentRole: 'Systems Support Engineer', rank: 'Engineer I', grade: 'G6', dateJoined: '2024-01-09', yearsInRole: 1, performance: '81%', performanceLevel: 'mid', qualification: 'Bachelor Degree', eligibility: 'Under Review', status: 'Active' },
            { name: 'Roda Jama', employeeId: 'EMP-0007', organization: 'HRMS Pro', branch: 'Xero Awr Branch', department: 'Finance', team: 'Reporting', currentRole: 'Financial Analyst', rank: 'Analyst II', grade: 'G6', dateJoined: '2022-09-27', yearsInRole: 3, performance: '88%', performanceLevel: 'high', qualification: 'Bachelor Degree', eligibility: 'Eligible', status: 'Active' },
            { name: 'Amina Yusuf', employeeId: 'EMP-0008', organization: 'HRMS Pro', branch: 'Idaacada Branch', department: 'Human Resource', team: 'Talent Desk', currentRole: 'Talent Officer', rank: 'Officer II', grade: 'G6', dateJoined: '2023-02-14', yearsInRole: 2, performance: '86%', performanceLevel: 'mid', qualification: 'Bachelor Degree', eligibility: 'Under Review', status: 'Active' },
            { name: 'Ahmed Jama', employeeId: 'EMP-0009', organization: 'HRMS Pro', branch: 'Calaamada Branch', department: 'Marketing', team: 'Insights', currentRole: 'Marketing Associate', rank: 'Associate', grade: 'G4', dateJoined: '2024-02-11', yearsInRole: 1, performance: '69%', performanceLevel: 'low', qualification: 'Diploma', eligibility: 'Not Eligible', status: 'Active' },
            { name: 'Mohamed Yusuf', employeeId: 'EMP-0010', organization: 'HRMS Pro', branch: 'Masalaha Branch', department: 'Administration', team: 'Records Desk', currentRole: 'Records Coordinator', rank: 'Coordinator', grade: 'G5', dateJoined: '2021-10-04', yearsInRole: 3, performance: '83%', performanceLevel: 'mid', qualification: 'Bachelor Degree', eligibility: 'Nearly Eligible', status: 'Active' },
            { name: 'Ilwad Noor', employeeId: 'EMP-0011', organization: 'HRMS Pro', branch: 'Jigjiga Yar Branch', department: 'Information Technology', team: 'Application Support', currentRole: 'Software Developer I', rank: 'Developer I', grade: 'G6', dateJoined: '2022-07-22', yearsInRole: 2, performance: '91%', performanceLevel: 'high', qualification: 'Bachelor Degree', eligibility: 'Eligible', status: 'Active' },
            { name: 'Nimco Abdi', employeeId: 'EMP-0012', organization: 'HRMS Pro', branch: 'Togdheer Branch', department: 'Operations', team: 'Field Support', currentRole: 'Operations Officer', rank: 'Officer I', grade: 'G5', dateJoined: '2024-04-03', yearsInRole: 1, performance: '71%', performanceLevel: 'low', qualification: 'Diploma', eligibility: 'Not Eligible', status: 'Active' }
        ];

        const rankingCardConfig = [
            { key: 'totalEmployees', label: 'Total Employee', border: 'border-indigo-500', iconBg: 'bg-indigo-50', iconColor: 'text-indigo-600', icon: 'fa-users', helper: 'All employees available in the ranking register.' },
            { key: 'eligibleForPromotion', label: 'Eligible For Promotion Request', border: 'border-emerald-500', iconBg: 'bg-emerald-50', iconColor: 'text-emerald-600', icon: 'fa-circle-check', helper: 'Employees currently eligible to submit promotion requests.' },
            { key: 'nearlyEligible', label: 'Nearly Eligible', border: 'border-sky-500', iconBg: 'bg-sky-50', iconColor: 'text-sky-600', icon: 'fa-hourglass-half', helper: 'Employees close to the eligibility threshold.' },
            { key: 'notEligible', label: 'Not Eligible', border: 'border-rose-500', iconBg: 'bg-rose-50', iconColor: 'text-rose-600', icon: 'fa-circle-xmark', helper: 'Employees who have not yet met the promotion criteria.' }
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

        function getEligibilityClass(eligibility) {
            if (eligibility === 'Eligible') {
                return 'status-eligible';
            }

            if (eligibility === 'Nearly Eligible') {
                return 'status-near';
            }

            if (eligibility === 'Under Review') {
                return 'status-review';
            }

            return 'status-not';
        }

        function getPerformanceClass(level) {
            if (level === 'high') {
                return 'performance-high';
            }

            if (level === 'mid') {
                return 'performance-mid';
            }

            return 'performance-low';
        }

        function closeAllActionMenus() {
            document.querySelectorAll('.ranking-action-menu').forEach(menu => {
                menu.classList.add('hidden');
            });

            activeActionMenu = null;
        }

        function buildStatusClass(status) {
            if (status === 'On Leave') {
                return 'status-leave';
            }

            if (status === 'Inactive') {
                return 'status-inactive';
            }

            return 'status-active';
        }

        function buildEmployeeLocation(branch) {
            return `${branch.replace(' Branch', '')}, Hargeisa`;
        }

        function buildEmployeeEmail(name) {
            return `${name.toLowerCase().replace(/\s+/g, '.')}@hrms.local`;
        }

        function buildEmployeePhone(employeeId) {
            const suffix = employeeId.replace(/\D/g, '').padStart(4, '0').slice(-4);
            return `+252 63 555 ${suffix}`;
        }

        function buildEmploymentType(status) {
            return status === 'Inactive' ? 'Contract' : 'Full Time';
        }

        function buildEmployeeViewUrl(record) {
            const params = new URLSearchParams({
                name: record.name,
                employeeNumber: record.employeeId,
                department: record.department,
                branch: record.branch,
                joinDate: record.dateJoined,
                status: record.status,
                statusClass: buildStatusClass(record.status),
                avatar: `/HRMS/ceo.jpg`,
                designation: record.currentRole,
                phone: buildEmployeePhone(record.employeeId),
                email: buildEmployeeEmail(record.name),
                location: buildEmployeeLocation(record.branch),
                gender: 'Not Set',
                dob: '1993-01-01',
                employmentType: buildEmploymentType(record.status),
                reportingManager: 'Promotion Committee'
            });

            return `../employees/view_employee.php?${params.toString()}`;
        }

        function buildProposedRank(rank) {
            const rankMap = {
                'Associate': 'Coordinator',
                'Coordinator': 'Officer I',
                'Officer I': 'Officer II',
                'Officer II': 'Officer III',
                'Officer III': 'Lead Officer',
                'Supervisor': 'Branch Lead',
                'Engineer I': 'Engineer II',
                'Analyst II': 'Senior Analyst',
                'Developer I': 'Developer II'
            };

            return rankMap[rank] || `Senior ${rank}`;
        }

        function buildProposedRole(currentRole) {
            const roleMap = {
                'Human Resource Director': 'Senior Human Resource Director',
                'Finance Officer': 'Lead Finance Officer',
                'Operations Supervisor': 'Branch Lead',
                'Marketing Coordinator': 'Senior Marketing Coordinator',
                'Administration Officer': 'Senior Administration Officer',
                'Systems Support Engineer': 'Systems Analyst',
                'Financial Analyst': 'Senior Financial Analyst',
                'Talent Officer': 'HR Business Partner',
                'Marketing Associate': 'Marketing Coordinator',
                'Records Coordinator': 'Operations Officer',
                'Software Developer I': 'Software Developer II',
                'Operations Officer': 'Operations Supervisor'
            };

            return roleMap[currentRole] || `Senior ${currentRole}`;
        }

        function buildProposedGrade(grade) {
            const match = grade.match(/^G(\d+)$/i);

            if (!match) {
                return grade;
            }

            return `G${Number(match[1]) + 1}`;
        }

        function buildEffectiveDate(employeeId) {
            const suffix = Number(employeeId.replace(/\D/g, '').slice(-2)) || 1;
            const day = String((suffix % 20) + 8).padStart(2, '0');
            return `2026-06-${day}`;
        }

        function buildPromotionNotes(record) {
            return `${record.name} meets the current cycle threshold for performance, tenure, and readiness indicators.`;
        }

        function populatePromotionEmployeeOptions() {
            promotionEmployee.innerHTML = employeeRankingRecords.map(record => `
                <option value="${record.employeeId}">${record.name}</option>
            `).join('');
        }

        function buildQualificationType(record) {
            return record.qualification === 'Bachelor Degree' ? 'Degree' : (record.qualification === 'Diploma' ? 'Diploma' : 'Certificate');
        }

        function buildQualificationName(record) {
            const byDepartment = {
                'Human Resource': 'HR Leadership',
                'Finance': 'Applied Finance',
                'Operations': 'Operations Management',
                'Marketing': 'Digital Marketing',
                'Administration': 'Business Administration',
                'Information Technology': 'Information Systems'
            };

            return byDepartment[record.department] || record.qualification;
        }

        function buildQualificationInstitution(record) {
            const byDepartment = {
                'Human Resource': 'University of Hargeisa',
                'Finance': 'Alpha Training Institute',
                'Operations': 'Hargeisa Management College',
                'Marketing': 'Somaliland Business School',
                'Administration': 'University of Hargeisa',
                'Information Technology': 'TechBridge Academy'
            };

            return byDepartment[record.department] || 'University of Hargeisa';
        }

        function buildQualificationField(record) {
            const byDepartment = {
                'Human Resource': 'Leadership',
                'Finance': 'Finance',
                'Operations': 'Operations',
                'Marketing': 'Marketing',
                'Administration': 'Administration',
                'Information Technology': 'Technology'
            };

            return byDepartment[record.department] || 'General Studies';
        }

        function buildQualificationAwardDate(employeeId) {
            const suffix = Number(employeeId.replace(/\D/g, '').slice(-2)) || 1;
            const month = String((suffix % 9) + 1).padStart(2, '0');
            const day = String((suffix % 20) + 10).padStart(2, '0');
            return `2024-${month}-${day}`;
        }

        function buildQualificationExpiryDate(record) {
            return record.qualification === 'Bachelor Degree' || record.qualification === 'Diploma' ? 'Not applicable' : '2027-07-12';
        }

        function buildQualificationNotes(record) {
            return 'Qualification is relevant to the next promotion step and should update the employee eligibility review.';
        }

        function populateQualificationEmployeeOptions() {
            qualificationEmployee.innerHTML = employeeRankingRecords.map(record => `
                <option value="${record.employeeId}">${record.name}</option>
            `).join('');
        }

        function updateQualificationForm(employeeId) {
            const record = employeeRankingRecords.find(item => item.employeeId === employeeId) || employeeRankingRecords[0];

            if (!record) {
                return;
            }

            qualificationEmployee.value = record.employeeId;
            qualificationType.value = buildQualificationType(record);
            qualificationName.value = buildQualificationName(record);
            qualificationInstitution.value = buildQualificationInstitution(record);
            qualificationAwardDate.value = buildQualificationAwardDate(record.employeeId);
            qualificationExpiryDate.value = buildQualificationExpiryDate(record);
            qualificationFieldOfStudy.value = buildQualificationField(record);
            qualificationNotes.value = buildQualificationNotes(record);
        }

        function showRecordQualificationModal(employeeId) {
            updateQualificationForm(employeeId);
            recordQualificationModal.classList.remove('hidden');
            recordQualificationModal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
        }

        function hideRecordQualificationModal() {
            recordQualificationModal.classList.add('hidden');
            recordQualificationModal.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        }

        function buildEligibilityScore(performance) {
            const numericScore = Number(String(performance).replace('%', ''));
            return `${(numericScore / 20).toFixed(1)} / 5`;
        }

        function buildEligibilityMissingConditions(record) {
            if (record.eligibility === 'Eligible') {
                return 'None. All mock rule conditions are met for the next promotion cycle.';
            }

            if (record.eligibility === 'Nearly Eligible') {
                return 'Complete the current review cycle and confirm one more tenure checkpoint before promotion routing.';
            }

            if (record.eligibility === 'Under Review') {
                return 'Committee review is still pending on qualification evidence and final performance sign-off.';
            }

            return 'Performance and tenure thresholds are not yet met for the current promotion cycle.';
        }

        function buildEligibilityRecommendation(record) {
            if (record.eligibility === 'Eligible') {
                return 'Move forward with promotion request preparation and department approval routing.';
            }

            if (record.eligibility === 'Nearly Eligible') {
                return 'Track the employee in the next review cycle and prepare supporting documents in advance.';
            }

            if (record.eligibility === 'Under Review') {
                return 'Wait for committee outcome, then proceed with promotion or qualification updates based on findings.';
            }

            return 'Keep the employee on the development plan and revisit promotion readiness after the next performance cycle.';
        }

        function updateEligibilityReview(employeeId) {
            const record = employeeRankingRecords.find(item => item.employeeId === employeeId) || employeeRankingRecords[0];

            if (!record) {
                return;
            }

            activeEligibilityEmployeeId = record.employeeId;
            eligibilityReviewEmployee.textContent = record.name;
            eligibilityReviewRoleRank.textContent = `${record.currentRole} / ${record.rank}`;
            eligibilityReviewPerformance.textContent = buildEligibilityScore(record.performance);
            eligibilityReviewTenure.textContent = `${record.yearsInRole} years`;
            eligibilityReviewQualification.textContent = record.qualification;
            eligibilityReviewMissingConditions.textContent = buildEligibilityMissingConditions(record);
            eligibilityReviewRecommendation.textContent = buildEligibilityRecommendation(record);
        }

        function showEligibilityReviewModal(employeeId) {
            updateEligibilityReview(employeeId);
            eligibilityReviewModal.classList.remove('hidden');
            eligibilityReviewModal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
        }

        function hideEligibilityReviewModal() {
            eligibilityReviewModal.classList.add('hidden');
            eligibilityReviewModal.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        }

        function updatePromotionForm(employeeId) {
            const record = employeeRankingRecords.find(item => item.employeeId === employeeId) || employeeRankingRecords[0];

            if (!record) {
                return;
            }

            promotionEmployee.value = record.employeeId;
            promotionCurrentDepartment.value = record.department;
            promotionCurrentRole.value = record.currentRole;
            promotionCurrentRankGrade.value = `${record.rank} / ${record.grade}`;
            promotionProposedDepartment.value = record.department;
            promotionProposedRole.value = buildProposedRole(record.currentRole);
            promotionProposedRankGrade.value = `${buildProposedRank(record.rank)} / ${buildProposedGrade(record.grade)}`;
            promotionEffectiveDate.value = buildEffectiveDate(record.employeeId);
            promotionReason.value = record.performanceLevel === 'high' ? 'Performance based progression' : 'Leadership readiness';
            promotionBasis.value = 'Performance review + qualification evidence';
            promotionNotes.value = buildPromotionNotes(record);
            promotionSalaryImpact.value = 'To be connected by payroll rules later';
        }

        function showStartPromotionModal(employeeId) {
            updatePromotionForm(employeeId);
            startPromotionModal.classList.remove('hidden');
            startPromotionModal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
        }

        function hideStartPromotionModal() {
            startPromotionModal.classList.add('hidden');
            startPromotionModal.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        }

        function populateFilterOptions() {
            const filterMap = [
                { element: branchFilter, key: 'branch', allLabel: 'All Branches' },
                { element: departmentFilter, key: 'department', allLabel: 'All Departments' },
                { element: teamFilter, key: 'team', allLabel: 'All Teams' },
                { element: roleFilter, key: 'currentRole', allLabel: 'All Roles' },
                { element: rankFilter, key: 'rank', allLabel: 'All Ranks' },
                { element: gradeFilter, key: 'grade', allLabel: 'All Grades' }
            ];

            filterMap.forEach(filterItem => {
                const values = [...new Set(employeeRankingRecords.map(record => record[filterItem.key]))].sort();
                filterItem.element.innerHTML = [`<option value="${filterItem.allLabel}">${filterItem.allLabel}</option>`]
                    .concat(values.map(value => `<option value="${value}">${value}</option>`))
                    .join('');
            });
        }

        function getFilteredRankingRecords() {
            const searchTerm = employeeSearchFilter.value.trim().toLowerCase();

            return employeeRankingRecords.filter(record => {
                const matchesSearch = !searchTerm
                    || record.name.toLowerCase().includes(searchTerm)
                    || record.employeeId.toLowerCase().includes(searchTerm);

                const matchesOrganization = organizationFilter.value === 'All Organizations' || record.organization === organizationFilter.value;
                const matchesBranch = branchFilter.value === 'All Branches' || record.branch === branchFilter.value;
                const matchesDepartment = departmentFilter.value === 'All Departments' || record.department === departmentFilter.value;
                const matchesTeam = teamFilter.value === 'All Teams' || record.team === teamFilter.value;
                const matchesRole = roleFilter.value === 'All Roles' || record.currentRole === roleFilter.value;
                const matchesRank = rankFilter.value === 'All Ranks' || record.rank === rankFilter.value;
                const matchesGrade = gradeFilter.value === 'All Grades' || record.grade === gradeFilter.value;
                const matchesEligibility = eligibilityStatusFilter.value === 'All' || record.eligibility === eligibilityStatusFilter.value;

                return matchesSearch
                    && matchesOrganization
                    && matchesBranch
                    && matchesDepartment
                    && matchesTeam
                    && matchesRole
                    && matchesRank
                    && matchesGrade
                    && matchesEligibility;
            });
        }

        function renderInsightCards(records) {
            const summary = {
                totalEmployees: `${records.length} Employees`,
                eligibleForPromotion: `${records.filter(record => record.eligibility === 'Eligible').length} Employees`,
                nearlyEligible: `${records.filter(record => record.eligibility === 'Nearly Eligible').length} Employees`,
                notEligible: `${records.filter(record => record.eligibility === 'Not Eligible').length} Employees`
            };

            rankingInsightCards.innerHTML = rankingCardConfig.map(card => `
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

        function renderRankingTable(records) {
            employeeRankingTableBody.innerHTML = records.map(record => `
                <tr class="transition-colors hover:bg-slate-50/70">
                    <td class="px-5 py-4">
                        <div>
                            <p class="text-sm font-semibold text-slate-700">${record.name}</p>
                            <p class="text-[11px] text-slate-400">${record.branch}</p>
                        </div>
                    </td>
                    <td class="px-5 py-4 text-sm text-slate-600">${record.employeeId}</td>
                    <td class="px-5 py-4 text-sm text-slate-600">${record.department}</td>
                    <td class="px-5 py-4 text-sm text-slate-600">${record.currentRole}</td>
                    <td class="px-5 py-4 text-sm text-slate-600">${record.rank}</td>
                    <td class="px-5 py-4 text-sm text-slate-600">${record.grade}</td>
                    <td class="px-5 py-4 text-sm text-slate-600">${record.dateJoined}</td>
                    <td class="px-5 py-4 text-sm text-slate-600">${record.yearsInRole} Years</td>
                    <td class="px-5 py-4 text-sm font-semibold ${getPerformanceClass(record.performanceLevel)}">${record.performance}</td>
                    <td class="px-5 py-4 text-sm text-slate-600">${record.qualification}</td>
                    <td class="px-5 py-4"><span class="status-pill ${getEligibilityClass(record.eligibility)}">${record.eligibility}</span></td>
                    <td class="px-5 py-4 text-sm text-slate-600">${record.status}</td>
                    <td class="px-5 py-4">
                        <div class="relative inline-block text-left">
                            <button type="button" class="ranking-action-toggle inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-600 transition hover:bg-slate-50">
                                <i class="fa-regular fa-eye"></i>
                                <span>View</span>
                            </button>
                            <div class="ranking-action-menu action-menu absolute right-0 z-20 mt-2 hidden w-56 overflow-hidden rounded-2xl border border-slate-100 bg-white py-2">
                                <a href="${buildEmployeeViewUrl(record)}" class="block w-full px-4 py-3 text-left text-sm font-medium text-slate-700 transition hover:bg-slate-50">View Profile</a>
                                <button type="button" class="start-promotion-action block w-full px-4 py-3 text-left text-sm font-medium text-slate-700 transition hover:bg-slate-50" data-employee-id="${record.employeeId}">Start Promotion</button>
                                <button type="button" class="record-qualification-action block w-full px-4 py-3 text-left text-sm font-medium text-slate-700 transition hover:bg-slate-50" data-employee-id="${record.employeeId}">Record Qualification</button>
                                <button type="button" class="block w-full px-4 py-3 text-left text-sm font-medium text-slate-700 transition hover:bg-slate-50">View History</button>
                                <button type="button" class="check-eligibility-action block w-full px-4 py-3 text-left text-sm font-medium text-slate-700 transition hover:bg-slate-50" data-employee-id="${record.employeeId}">Check Eligibility</button>
                                <button type="button" class="performance-review-action block w-full px-4 py-3 text-left text-sm font-semibold text-indigo-600 transition hover:bg-indigo-50" data-employee-id="${record.employeeId}"><i class="fa-solid fa-star-half-stroke mr-1 text-xs"></i>Review</button>
                            </div>
                        </div>
                    </td>
                </tr>
            `).join('');
        }

        function renderRankingPage() {
            const records = getFilteredRankingRecords();
            renderInsightCards(records);
            renderRankingTable(records);
        }

        [
            employeeSearchFilter,
            organizationFilter,
            branchFilter,
            departmentFilter,
            teamFilter,
            roleFilter,
            rankFilter,
            gradeFilter,
            eligibilityStatusFilter
        ].forEach(filterElement => {
            filterElement.addEventListener('input', renderRankingPage);
            filterElement.addEventListener('change', renderRankingPage);
        });

        employeeRankingTableBody.addEventListener('click', event => {
            const toggleButton = event.target.closest('.ranking-action-toggle');
            const startPromotionButton = event.target.closest('.start-promotion-action');
            const recordQualificationButton = event.target.closest('.record-qualification-action');
            const checkEligibilityButton = event.target.closest('.check-eligibility-action');
            const performanceReviewButton = event.target.closest('.performance-review-action');

            if (performanceReviewButton) {
                event.preventDefault();
                closeAllActionMenus();
                showPerformanceReviewModal(performanceReviewButton.dataset.employeeId);
                return;
            }

            if (startPromotionButton) {
                event.preventDefault();
                closeAllActionMenus();
                showStartPromotionModal(startPromotionButton.dataset.employeeId);
                return;
            }

            if (recordQualificationButton) {
                event.preventDefault();
                closeAllActionMenus();
                showRecordQualificationModal(recordQualificationButton.dataset.employeeId);
                return;
            }

            if (checkEligibilityButton) {
                event.preventDefault();
                closeAllActionMenus();
                showEligibilityReviewModal(checkEligibilityButton.dataset.employeeId);
                return;
            }

            if (!toggleButton) {
                return;
            }

            event.stopPropagation();
            const targetMenu = toggleButton.parentElement.querySelector('.ranking-action-menu');

            if (!targetMenu) {
                return;
            }

            const shouldOpen = targetMenu.classList.contains('hidden');
            closeAllActionMenus();

            if (shouldOpen) {
                targetMenu.classList.remove('hidden');
                activeActionMenu = targetMenu;
            }
        });

        document.addEventListener('click', event => {
            if (!activeActionMenu) {
                return;
            }

            if (!event.target.closest('.ranking-action-menu') && !event.target.closest('.ranking-action-toggle')) {
                closeAllActionMenus();
            }
        });

        promotionEmployee.addEventListener('change', event => {
            updatePromotionForm(event.target.value);
        });

        qualificationEmployee.addEventListener('change', event => {
            updateQualificationForm(event.target.value);
        });

        closeStartPromotionModal.addEventListener('click', hideStartPromotionModal);
        cancelStartPromotionModal.addEventListener('click', hideStartPromotionModal);
        startPromotionModal.addEventListener('click', event => {
            if (event.target === startPromotionModal || event.target.classList.contains('modal-backdrop')) {
                hideStartPromotionModal();
            }
        });

        closeRecordQualificationModal.addEventListener('click', hideRecordQualificationModal);
        cancelRecordQualificationModal.addEventListener('click', hideRecordQualificationModal);
        recordQualificationModal.addEventListener('click', event => {
            if (event.target === recordQualificationModal || event.target.classList.contains('modal-backdrop')) {
                hideRecordQualificationModal();
            }
        });

        closeEligibilityReviewModal.addEventListener('click', hideEligibilityReviewModal);
        cancelEligibilityReviewModal.addEventListener('click', hideEligibilityReviewModal);
        eligibilityReviewModal.addEventListener('click', event => {
            if (event.target === eligibilityReviewModal || event.target.classList.contains('modal-backdrop')) {
                hideEligibilityReviewModal();
            }
        });
        openQualificationFromEligibility.addEventListener('click', () => {
            hideEligibilityReviewModal();
            showRecordQualificationModal(activeEligibilityEmployeeId || employeeRankingRecords[0].employeeId);
        });
        openPromotionFromEligibility.addEventListener('click', () => {
            hideEligibilityReviewModal();
            showStartPromotionModal(activeEligibilityEmployeeId || employeeRankingRecords[0].employeeId);
        });

        // Performance Review Modal
        const performanceReviewModal   = document.getElementById('performanceReviewModal');
        const closePerformanceReviewModal = document.getElementById('closePerformanceReviewModal');
        const cancelPerformanceReviewModal = document.getElementById('cancelPerformanceReviewModal');
        const reviewRequirementsList   = document.getElementById('reviewRequirementsList');

        function buildReviewRequirements(record) {
            return [
                { label: 'Minimum 2 years in current role', met: record.yearsInRole >= 2 },
                { label: 'Performance score >= 75%', met: parseInt(record.performance) >= 75 },
                { label: 'Qualification on file', met: record.qualification !== 'None' },
                { label: 'Active employment status', met: record.status === 'Active' },
                { label: 'No pending disciplinary cases', met: record.eligibility !== 'Not Eligible' }
            ];
        }

        function showPerformanceReviewModal(employeeId) {
            const record = employeeRankingRecords.find(r => r.employeeId === employeeId) || employeeRankingRecords[0];
            document.getElementById('reviewEmployeeAvatar').textContent = record.name.charAt(0);
            document.getElementById('reviewEmployeeName').textContent   = record.name;
            document.getElementById('reviewEmployeeRole').textContent   = `${record.currentRole} · ${record.employeeId}`;
            document.getElementById('reviewEmployeeEligibility').textContent = record.eligibility;
            document.getElementById('reviewScore').textContent   = record.performance;
            document.getElementById('reviewTenure').textContent  = `${record.yearsInRole} yrs`;
            document.getElementById('reviewRank').textContent    = record.rank;
            document.getElementById('reviewGrade').textContent   = record.grade;
            document.getElementById('reviewNotes').textContent   = buildEligibilityMissingConditions(record);

            const reqs = buildReviewRequirements(record);
            reviewRequirementsList.innerHTML = reqs.map(r => `
                <div class="flex items-center gap-3 rounded-xl border ${r.met ? 'border-emerald-100 bg-emerald-50' : 'border-rose-100 bg-rose-50'} px-4 py-3">
                    <i class="fa-solid ${r.met ? 'fa-circle-check text-emerald-500' : 'fa-circle-xmark text-rose-400'} text-base"></i>
                    <span class="text-sm font-medium ${r.met ? 'text-emerald-700' : 'text-rose-600'}">${r.label}</span>
                </div>
            `).join('');

            performanceReviewModal.classList.remove('hidden');
            performanceReviewModal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
        }

        function hidePerformanceReviewModal() {
            performanceReviewModal.classList.add('hidden');
            performanceReviewModal.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        }

        closePerformanceReviewModal.addEventListener('click', hidePerformanceReviewModal);
        cancelPerformanceReviewModal.addEventListener('click', hidePerformanceReviewModal);
        performanceReviewModal.addEventListener('click', e => {
            if (e.target === performanceReviewModal || e.target.classList.contains('modal-backdrop')) hidePerformanceReviewModal();
        });
        document.getElementById('reviewApproveBtn').addEventListener('click', () => {
            alert('Review Approved. Promotion routing initiated.');
            hidePerformanceReviewModal();
        });
        document.getElementById('reviewRejectBtn').addEventListener('click', () => {
            alert('Review Rejected. Employee will be notified.');
            hidePerformanceReviewModal();
        });

        sidebarToggle.addEventListener('click', handleSidebarToggle);
        sidebarOverlay.addEventListener('click', closeMobileSidebar);
        window.addEventListener('resize', syncSidebarMode);

        populateFilterOptions();
        populatePromotionEmployeeOptions();
        updatePromotionForm(employeeRankingRecords[0].employeeId);
        populateQualificationEmployeeOptions();
        updateQualificationForm(employeeRankingRecords[0].employeeId);
        renderRankingPage();
        syncSidebarMode();
    </script>
</body>
</html>
