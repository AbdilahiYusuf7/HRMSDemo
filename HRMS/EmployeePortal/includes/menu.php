<?php
$menuBasePath = isset($menuBasePath) ? $menuBasePath : '';
$currentMenu = isset($currentMenu) ? $currentMenu : '';
?>

<nav class="px-4 space-y-2">
    <a href="<?= $menuBasePath; ?>pages/dashboard.php" class="sidebar-link <?= $currentMenu === 'employee_dashboard' ? 'active' : 'text-slate-500'; ?> flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition-all font-medium">
        <i class="fa-solid fa-chart-pie w-4"></i>
        <span class="sidebar-label">Dashboard</span>
    </a>
    <a href="<?= $menuBasePath; ?>pages/employees/view_employee.php" class="sidebar-link <?= $currentMenu === 'employee_profile' ? 'active' : 'text-slate-500'; ?> flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition-all font-medium">
        <i class="fa-solid fa-id-card w-4"></i>
        <span class="sidebar-label">My Profile</span>
    </a>
    <a href="<?= $menuBasePath; ?>pages/attendance/list_attendance.php" class="sidebar-link <?= $currentMenu === 'employee_attendance' ? 'active' : 'text-slate-500'; ?> flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition-all font-medium">
        <i class="fa-solid fa-calendar-check w-4"></i>
        <span class="sidebar-label">My Attendance</span>
    </a>
    <a href="<?= $menuBasePath; ?>pages/leave management/list_leaves.php" class="sidebar-link <?= $currentMenu === 'employee_leaves' ? 'active' : 'text-slate-500'; ?> flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition-all font-medium">
        <i class="fa-solid fa-umbrella-beach w-4"></i>
        <span class="sidebar-label">My Leaves</span>
    </a>
    <a href="<?= $menuBasePath; ?>pages/payrol integration/payroll_integration.php" class="sidebar-link <?= $currentMenu === 'employee_payroll' ? 'active' : 'text-slate-500'; ?> flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition-all font-medium">
        <i class="fa-solid fa-file-invoice-dollar w-4"></i>
        <span class="sidebar-label">My Payroll / Deductions</span>
    </a>
    <a href="<?= $menuBasePath; ?>pages/training and development/list_training.php" class="sidebar-link <?= $currentMenu === 'employee_training' ? 'active' : 'text-slate-500'; ?> flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition-all font-medium">
        <i class="fa-solid fa-graduation-cap w-4"></i>
        <span class="sidebar-label">My Trainings</span>
    </a>
    <a href="<?= $menuBasePath; ?>pages/perfomance/list_perfomance.php" class="sidebar-link <?= $currentMenu === 'employee_performance' ? 'active' : 'text-slate-500'; ?> flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition-all font-medium">
        <i class="fa-solid fa-list-check w-4"></i>
        <span class="sidebar-label">My Agendas / Performance</span>
    </a>
    <div class="sidebar-support-label pt-4 pb-2 px-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Account</div>
    <a href="/HRMS/logout.php" class="sidebar-link text-slate-500 flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition-all font-medium">
        <i class="fa-solid fa-right-from-bracket w-4"></i>
        <span class="sidebar-label">Logout</span>
    </a>
</nav>
