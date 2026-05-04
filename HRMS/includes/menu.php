<?php
$menuBasePath = isset($menuBasePath) ? $menuBasePath : '';
$currentMenu = isset($currentMenu) ? $currentMenu : '';
$promotionMenus = [
    'promotion_dashboard',
    'employee_ranking',
    'promotion_requests',
    'promotion_history',
    'promotion_rules',
    'eligibility_reviews',
    'promotion_reports'
];
$promotionMenuOpen = in_array($currentMenu, $promotionMenus, true);
$promotionMenuSelected = $promotionMenuOpen;
?>

<nav class="px-4 space-y-2">
    <a href="<?= $menuBasePath; ?>pages/dashboard.php" class="sidebar-link <?= $currentMenu === 'dashboard' ? 'active' : 'text-slate-500'; ?> flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition-all font-medium">
        <i class="fa-solid fa-chart-pie w-4"></i>
        <span class="sidebar-label">Dashboard</span>
    </a>
    <a href="<?= $menuBasePath; ?>pages/employees/list_employee.php" class="sidebar-link <?= $currentMenu === 'employees' ? 'active' : 'text-slate-500'; ?> flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition-all font-medium">
        <i class="fa-solid fa-users w-4"></i>
        <span class="sidebar-label">Employees</span>
    </a>
    <a href="<?= $menuBasePath; ?>pages/attendance/list_attendance.php" class="sidebar-link <?= $currentMenu === 'attendance' ? 'active' : 'text-slate-500'; ?> flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition-all font-medium">
        <i class="fa-solid fa-calendar-check w-4"></i>
        <span class="sidebar-label">Attendance</span>
    </a>
    <a href="<?= $menuBasePath; ?>pages/leave management/list_leaves.php" class="sidebar-link <?= $currentMenu === 'leave_management' ? 'active' : 'text-slate-500'; ?> flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition-all font-medium">
        <i class="fa-solid fa-umbrella-beach w-4"></i>
        <span class="sidebar-label">Leave Management</span>
    </a>
    <a href="<?= $menuBasePath; ?>pages/training and development/list_training.php" class="sidebar-link <?= $currentMenu === 'training_development' ? 'active' : 'text-slate-500'; ?> flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition-all font-medium">
        <i class="fa-solid fa-graduation-cap w-4"></i>
        <span class="sidebar-label">Training &amp; Development</span>
    </a>
    <details class="group" <?= $promotionMenuOpen ? 'open' : ''; ?>>
        <summary class="sidebar-link <?= $promotionMenuSelected ? 'text-slate-700 bg-slate-50' : 'text-slate-500'; ?> flex cursor-pointer list-none items-center justify-between gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all hover:bg-slate-50">
            <span class="flex items-center gap-3">
                <i class="fa-solid fa-trophy w-4"></i>
                <span class="sidebar-label">Promotion &amp; Ranking</span>
            </span>
            <i class="fa-solid fa-chevron-down text-[10px] transition-transform group-open:rotate-180"></i>
        </summary>
        <div class="relative mt-2 ml-5 space-y-1 border-l border-slate-200 pl-5">
            <a href="<?= $menuBasePath; ?>pages/perfomanceRanknig/dashboard.php" class="sidebar-link <?= $currentMenu === 'promotion_dashboard' ? 'bg-indigo-50 text-indigo-600' : 'text-slate-500'; ?> relative flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-medium transition-all hover:bg-slate-50 hover:text-slate-700">
                <span class="absolute -left-[1.45rem] h-px w-4 bg-slate-200"></span>
                <span class="<?= $currentMenu === 'promotion_dashboard' ? 'bg-indigo-600' : 'bg-slate-300'; ?> absolute -left-[1.65rem] h-2.5 w-2.5 rounded-full border-2 border-white"></span>
                <span class="sidebar-label">Dashboard</span>
            </a>
            <a href="<?= $menuBasePath; ?>pages/perfomanceRanknig/employee_ranking.php" class="sidebar-link <?= $currentMenu === 'employee_ranking' ? 'bg-indigo-50 text-indigo-600' : 'text-slate-500'; ?> relative flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-medium transition-all hover:bg-slate-50 hover:text-slate-700">
                <span class="absolute -left-[1.45rem] h-px w-4 bg-slate-200"></span>
                <span class="<?= $currentMenu === 'employee_ranking' ? 'bg-indigo-600' : 'bg-slate-300'; ?> absolute -left-[1.65rem] h-2.5 w-2.5 rounded-full border-2 border-white"></span>
                <span class="sidebar-label">Employee Ranking</span>
            </a>
            <a href="<?= $menuBasePath; ?>pages/perfomanceRanknig/promotion_requests.php" class="sidebar-link <?= $currentMenu === 'promotion_requests' ? 'bg-indigo-50 text-indigo-600' : 'text-slate-500'; ?> relative flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-medium transition-all hover:bg-slate-50 hover:text-slate-700">
                <span class="absolute -left-[1.45rem] h-px w-4 bg-slate-200"></span>
                <span class="<?= $currentMenu === 'promotion_requests' ? 'bg-indigo-600' : 'bg-slate-300'; ?> absolute -left-[1.65rem] h-2.5 w-2.5 rounded-full border-2 border-white"></span>
                <span class="sidebar-label">Promotion Requests</span>
            </a>
            <a href="<?= $menuBasePath; ?>pages/perfomanceRanknig/promotion_history.php" class="sidebar-link <?= $currentMenu === 'promotion_history' ? 'bg-indigo-50 text-indigo-600' : 'text-slate-500'; ?> relative flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-medium transition-all hover:bg-slate-50 hover:text-slate-700">
                <span class="absolute -left-[1.45rem] h-px w-4 bg-slate-200"></span>
                <span class="<?= $currentMenu === 'promotion_history' ? 'bg-indigo-600' : 'bg-slate-300'; ?> absolute -left-[1.65rem] h-2.5 w-2.5 rounded-full border-2 border-white"></span>
                <span class="sidebar-label">Promotion History</span>
            </a>
            <a href="<?= $menuBasePath; ?>pages/perfomanceRanknig/promotion_rules.php" class="sidebar-link <?= $currentMenu === 'promotion_rules' ? 'bg-indigo-50 text-indigo-600' : 'text-slate-500'; ?> relative flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-medium transition-all hover:bg-slate-50 hover:text-slate-700">
                <span class="absolute -left-[1.45rem] h-px w-4 bg-slate-200"></span>
                <span class="<?= $currentMenu === 'promotion_rules' ? 'bg-indigo-600' : 'bg-slate-300'; ?> absolute -left-[1.65rem] h-2.5 w-2.5 rounded-full border-2 border-white"></span>
                <span class="sidebar-label">Promotion Rules</span>
            </a>
            <a href="<?= $menuBasePath; ?>pages/perfomanceRanknig/eligibility_reviews.php" class="sidebar-link <?= $currentMenu === 'eligibility_reviews' ? 'bg-indigo-50 text-indigo-600' : 'text-slate-500'; ?> relative flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-medium transition-all hover:bg-slate-50 hover:text-slate-700">
                <span class="absolute -left-[1.45rem] h-px w-4 bg-slate-200"></span>
                <span class="<?= $currentMenu === 'eligibility_reviews' ? 'bg-indigo-600' : 'bg-slate-300'; ?> absolute -left-[1.65rem] h-2.5 w-2.5 rounded-full border-2 border-white"></span>
                <span class="sidebar-label">Eligibility Reviews</span>
            </a>
            <a href="<?= $menuBasePath; ?>pages/perfomanceRanknig/reports_insights.php" class="sidebar-link <?= $currentMenu === 'promotion_reports' ? 'bg-indigo-50 text-indigo-600' : 'text-slate-500'; ?> relative flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-medium transition-all hover:bg-slate-50 hover:text-slate-700">
                <span class="absolute -left-[1.45rem] h-px w-4 bg-slate-200"></span>
                <span class="<?= $currentMenu === 'promotion_reports' ? 'bg-indigo-600' : 'bg-slate-300'; ?> absolute -left-[1.65rem] h-2.5 w-2.5 rounded-full border-2 border-white"></span>
                <span class="sidebar-label">Reports &amp; Insights</span>
            </a>
        </div>
    </details>
    <a href="<?= $menuBasePath; ?>pages/retirement/list_retirement.php" class="sidebar-link <?= $currentMenu === 'retirement' ? 'active' : 'text-slate-500'; ?> flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition-all font-medium">
        <i class="fa-solid fa-user-clock w-4"></i>
        <span class="sidebar-label">Retirement</span>
    </a>
    <a href="<?= $menuBasePath; ?>pages/perfomance/list_perfomance.php" class="sidebar-link <?= $currentMenu === 'performance' ? 'active' : 'text-slate-500'; ?> flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition-all font-medium">
        <i class="fa-solid fa-chart-line w-4"></i>
        <span class="sidebar-label">Perfomance</span>
    </a>
    <a href="<?= $menuBasePath; ?>pages/payrol integration/payroll_integration.php" class="sidebar-link <?= $currentMenu === 'payroll_integration' ? 'active' : 'text-slate-500'; ?> flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition-all font-medium">
        <i class="fa-solid fa-file-invoice-dollar w-4"></i>
        <span class="sidebar-label">Payroll Integration</span>
    </a>
    <a href="<?= $menuBasePath; ?>pages/reports/report.php" class="sidebar-link <?= $currentMenu === 'report' ? 'active' : 'text-slate-500'; ?> flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition-all font-medium">
        <i class="fa-solid fa-chart-column w-4"></i>
        <span class="sidebar-label">Report</span>
    </a>
    <div class="sidebar-support-label pt-4 pb-2 px-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Support</div>
    <a href="#" class="sidebar-link <?= $currentMenu === 'settings' ? 'active' : 'text-slate-500'; ?> flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition-all font-medium">
        <i class="fa-solid fa-gear w-4"></i>
        <span class="sidebar-label">Settings</span>
    </a>
    <a href="<?= $menuBasePath; ?>logout.php" class="sidebar-link text-slate-500 flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition-all font-medium">
        <i class="fa-solid fa-right-from-bracket w-4"></i>
        <span class="sidebar-label">Logout</span>
    </a>
</nav>
