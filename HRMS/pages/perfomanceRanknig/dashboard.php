<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRM System - Promotion &amp; Ranking Dashboard</title>
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

        .status-approved {
            background: #dcfce7;
            color: #166534;
        }

        .status-rejected {
            background: #fee2e2;
            color: #991b1b;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .activity-scroll::-webkit-scrollbar {
            width: 6px;
        }

        .activity-scroll::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 9999px;
        }

        .activity-scroll::-webkit-scrollbar-track {
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
    <?php $currentMenu = 'promotion_dashboard'; ?>
    <?php include __DIR__ . '/../../includes/header_sidebar.php'; ?>

    <div class="mx-auto w-full max-w-[1440px] p-4 md:p-8">
        <div class="mb-8 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-slate-800">Promotion &amp; Ranking Dashboard</h2>
                <p class="text-sm text-slate-500">Promotion pipeline overview, ranking spread, eligibility tracking, and recent movement across departments.</p>
            </div>
        </div>

        <div id="promotionInsightCards" class="mb-8 grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-3"></div>

        <div class="mb-8 grid grid-cols-1 gap-6 xl:grid-cols-2">
            <div class="glass-card p-6">
                <div class="mb-5">
                    <h3 class="text-base font-semibold text-slate-800">Promotions by Department</h3>
                    <p class="text-xs text-slate-400">Column chart showing promotion request volume by department.</p>
                </div>
                <div class="h-[320px]">
                    <canvas id="promotionDepartmentChart"></canvas>
                </div>
            </div>

            <div class="glass-card p-6">
                <div class="mb-5">
                    <h3 class="text-base font-semibold text-slate-800">Rank Distribution</h3>
                    <p class="text-xs text-slate-400">Current employee spread across rank levels.</p>
                </div>
                <div class="h-[320px]">
                    <canvas id="rankDistributionChart"></canvas>
                </div>
            </div>

            <div class="glass-card p-6">
                <div class="mb-5">
                    <h3 class="text-base font-semibold text-slate-800">Monthly Promotion Trend</h3>
                    <p class="text-xs text-slate-400">Line chart showing approved promotions across recent months.</p>
                </div>
                <div class="h-[320px]">
                    <canvas id="monthlyPromotionTrendChart"></canvas>
                </div>
            </div>

            <div class="glass-card p-6">
                <div class="mb-5">
                    <h3 class="text-base font-semibold text-slate-800">Eligibility Breakdown</h3>
                    <p class="text-xs text-slate-400">Radial view of employee eligibility review categories.</p>
                </div>
                <div class="h-[320px]">
                    <canvas id="eligibilityBreakdownChart"></canvas>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">
            <div class="glass-card p-6">
                <div class="mb-5">
                    <h3 class="text-base font-semibold text-slate-800">Recent Promotion Activity</h3>
                    <p class="text-xs text-slate-400">Latest promotion decisions and review updates.</p>
                </div>
                <div id="recentPromotionActivity" class="activity-scroll max-h-[360px] space-y-4 overflow-y-auto pr-1"></div>
            </div>

            <div class="glass-card p-6">
                <div class="mb-5">
                    <h3 class="text-base font-semibold text-slate-800">Employees Nearing Eligibility</h3>
                    <p class="text-xs text-slate-400">Employees approaching the next review window or required milestone.</p>
                </div>
                <div id="employeesNearingEligibility" class="activity-scroll max-h-[360px] space-y-4 overflow-y-auto pr-1"></div>
            </div>

            <div class="glass-card p-6">
                <div class="mb-5">
                    <h3 class="text-base font-semibold text-slate-800">Pending Approvals</h3>
                    <p class="text-xs text-slate-400">Promotion requests currently waiting for final approval.</p>
                </div>
                <div id="pendingPromotionApprovals" class="activity-scroll max-h-[360px] space-y-4 overflow-y-auto pr-1"></div>
            </div>
        </div>
    </div>

    <script>
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const desktopSidebarBreakpoint = window.matchMedia('(min-width: 1024px)');
        const promotionInsightCards = document.getElementById('promotionInsightCards');
        const recentPromotionActivity = document.getElementById('recentPromotionActivity');
        const employeesNearingEligibility = document.getElementById('employeesNearingEligibility');
        const pendingPromotionApprovals = document.getElementById('pendingPromotionApprovals');
        const promotionDepartmentChartCanvas = document.getElementById('promotionDepartmentChart');
        const rankDistributionChartCanvas = document.getElementById('rankDistributionChart');
        const monthlyPromotionTrendChartCanvas = document.getElementById('monthlyPromotionTrendChart');
        const eligibilityBreakdownChartCanvas = document.getElementById('eligibilityBreakdownChart');
        let promotionDepartmentChart = null;
        let rankDistributionChart = null;
        let monthlyPromotionTrendChart = null;
        let eligibilityBreakdownChart = null;

        const promotionRequests = [
            { employee: 'Cabdiraxmaan Cali', department: 'Human Resource', branch: 'Idaacada Branch', fromRank: 'Officer I', toRank: 'Senior Officer', status: 'Approved', requestedOn: '2026-01-14', effectiveOn: '2026-02-01', ruleRef: 'Tenure & Score' },
            { employee: 'Fadumo Xasan', department: 'Finance', branch: 'Xero Awr Branch', fromRank: 'Officer II', toRank: 'Lead Officer', status: 'Pending', requestedOn: '2026-05-02', effectiveOn: '2026-05-20', ruleRef: 'Tenure & Score' },
            { employee: 'Mahad Axmed', department: 'Operations', branch: 'Togdheer Branch', fromRank: 'Supervisor', toRank: 'Branch Lead', status: 'Approved', requestedOn: '2026-02-10', effectiveOn: '2026-02-28', ruleRef: 'Leadership Readiness' },
            { employee: 'Sahra Maxamed', department: 'Marketing', branch: 'Calaamada Branch', fromRank: 'Coordinator', toRank: 'Senior Coordinator', status: 'Rejected', requestedOn: '2026-03-18', effectiveOn: '2026-04-05', ruleRef: 'Certification Completion' },
            { employee: 'Hodan Ali', department: 'Administration', branch: 'Masalaha Branch', fromRank: 'Officer I', toRank: 'Officer II', status: 'Approved', requestedOn: '2026-03-04', effectiveOn: '2026-03-25', ruleRef: 'Attendance Threshold' },
            { employee: 'Mustafe Cabdi', department: 'Information Technology', branch: 'Jigjiga Yar Branch', fromRank: 'Support Engineer', toRank: 'Systems Analyst', status: 'Pending', requestedOn: '2026-05-10', effectiveOn: '2026-05-28', ruleRef: 'Certification Completion' },
            { employee: 'Roda Jama', department: 'Finance', branch: 'Xero Awr Branch', fromRank: 'Analyst', toRank: 'Senior Analyst', status: 'Approved', requestedOn: '2026-04-08', effectiveOn: '2026-04-27', ruleRef: 'Tenure & Score' },
            { employee: 'Amina Yusuf', department: 'Human Resource', branch: 'Idaacada Branch', fromRank: 'Talent Officer', toRank: 'HR Business Partner', status: 'Pending', requestedOn: '2026-05-12', effectiveOn: '2026-05-30', ruleRef: 'Leadership Readiness' },
            { employee: 'Ahmed Jama', department: 'Marketing', branch: 'Calaamada Branch', fromRank: 'Associate', toRank: 'Coordinator', status: 'Approved', requestedOn: '2026-01-22', effectiveOn: '2026-02-11', ruleRef: 'Attendance Threshold' },
            { employee: 'Nimco Abdi', department: 'Operations', branch: 'Togdheer Branch', fromRank: 'Officer I', toRank: 'Officer II', status: 'Rejected', requestedOn: '2026-04-16', effectiveOn: '2026-05-01', ruleRef: 'Performance Gate' },
            { employee: 'Mohamed Yusuf', department: 'Administration', branch: 'Masalaha Branch', fromRank: 'Coordinator', toRank: 'Operations Officer', status: 'Approved', requestedOn: '2026-02-06', effectiveOn: '2026-02-24', ruleRef: 'Performance Gate' },
            { employee: 'Ilwad Noor', department: 'Information Technology', branch: 'Jigjiga Yar Branch', fromRank: 'Developer I', toRank: 'Developer II', status: 'Approved', requestedOn: '2026-04-09', effectiveOn: '2026-04-29', ruleRef: 'Certification Completion' }
        ];

        const rankSpread = [
            { rank: 'Associate', count: 18 },
            { rank: 'Officer I', count: 34 },
            { rank: 'Officer II', count: 29 },
            { rank: 'Senior Officer', count: 17 },
            { rank: 'Lead', count: 10 },
            { rank: 'Manager', count: 5 }
        ];

        const eligibilityReviews = [
            { employee: 'Fadumo Xasan', department: 'Finance', status: 'Eligible Now', readiness: '98%', nextWindow: '2026-05-20' },
            { employee: 'Mustafe Cabdi', department: 'Information Technology', status: 'Under Review', readiness: '91%', nextWindow: '2026-06-02' },
            { employee: 'Amina Yusuf', department: 'Human Resource', status: 'Nearing Eligibility', readiness: '89%', nextWindow: '2026-06-10' },
            { employee: 'Sahra Maxamed', department: 'Marketing', status: 'Deferred', readiness: '72%', nextWindow: '2026-08-01' },
            { employee: 'Nimco Abdi', department: 'Operations', status: 'Nearing Eligibility', readiness: '87%', nextWindow: '2026-06-14' },
            { employee: 'Mohamed Yusuf', department: 'Administration', status: 'Eligible Now', readiness: '95%', nextWindow: '2026-05-18' },
            { employee: 'Ilwad Noor', department: 'Information Technology', status: 'Nearing Eligibility', readiness: '90%', nextWindow: '2026-06-21' },
            { employee: 'Ahmed Jama', department: 'Marketing', status: 'Under Review', readiness: '84%', nextWindow: '2026-05-27' },
            { employee: 'Roda Jama', department: 'Finance', status: 'Eligible Now', readiness: '94%', nextWindow: '2026-05-24' },
            { employee: 'Hodan Ali', department: 'Administration', status: 'Deferred', readiness: '70%', nextWindow: '2026-07-19' },
            { employee: 'Abdiqani Warsame', department: 'Operations', status: 'Nearing Eligibility', readiness: '86%', nextWindow: '2026-06-18' },
            { employee: 'Ifrah Hassan', department: 'Human Resource', status: 'Under Review', readiness: '88%', nextWindow: '2026-05-29' }
        ];

        const promotionCardConfig = [
            { key: 'totalPromotionsMade', label: 'Total Promotions Made', border: 'border-indigo-500', iconBg: 'bg-indigo-50', iconColor: 'text-indigo-600', icon: 'fa-arrow-trend-up', helper: 'All promotion cases recorded in the dashboard sample set.' },
            { key: 'approvedPromotions', label: 'Approved Promotions', border: 'border-emerald-500', iconBg: 'bg-emerald-50', iconColor: 'text-emerald-600', icon: 'fa-circle-check', helper: 'Promotion requests approved and scheduled for effect.' },
            { key: 'rejectedPromotions', label: 'Rejected Promotions', border: 'border-rose-500', iconBg: 'bg-rose-50', iconColor: 'text-rose-600', icon: 'fa-circle-xmark', helper: 'Promotion requests declined after review.' },
            { key: 'pendingPromotions', label: 'Pending Promotions', border: 'border-amber-500', iconBg: 'bg-amber-50', iconColor: 'text-amber-600', icon: 'fa-hourglass-half', helper: 'Promotion requests still awaiting a final decision.' },
            { key: 'promotionRulesAddressed', label: 'Promotion Rules Addressed', border: 'border-sky-500', iconBg: 'bg-sky-50', iconColor: 'text-sky-600', icon: 'fa-scale-balanced', helper: 'Distinct promotion rules referenced across current reviews.' }
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

        function buildPromotionSummary() {
            const totalPromotionsMade = promotionRequests.length;
            const approvedPromotions = promotionRequests.filter(item => item.status === 'Approved').length;
            const rejectedPromotions = promotionRequests.filter(item => item.status === 'Rejected').length;
            const pendingPromotions = promotionRequests.filter(item => item.status === 'Pending').length;
            const promotionRulesAddressed = new Set(promotionRequests.map(item => item.ruleRef)).size;

            return {
                totalPromotionsMade: `${totalPromotionsMade} Cases`,
                approvedPromotions: `${approvedPromotions} Approved`,
                rejectedPromotions: `${rejectedPromotions} Rejected`,
                pendingPromotions: `${pendingPromotions} Pending`,
                promotionRulesAddressed: `${promotionRulesAddressed} Rules`
            };
        }

        function renderInsightCards() {
            const summary = buildPromotionSummary();

            promotionInsightCards.innerHTML = promotionCardConfig.map(card => `
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

        function buildDepartmentPromotionData() {
            const departmentMap = {};

            promotionRequests.forEach(item => {
                if (!departmentMap[item.department]) {
                    departmentMap[item.department] = 0;
                }

                departmentMap[item.department] += 1;
            });

            return {
                labels: Object.keys(departmentMap),
                values: Object.values(departmentMap)
            };
        }

        function buildRankDistributionData() {
            return {
                labels: rankSpread.map(item => item.rank),
                values: rankSpread.map(item => item.count)
            };
        }

        function buildMonthlyTrendData() {
            const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'];
            const monthMap = { '2026-01': 0, '2026-02': 1, '2026-03': 2, '2026-04': 3, '2026-05': 4, '2026-06': 5 };
            const values = [0, 0, 0, 0, 0, 0];

            promotionRequests
                .filter(item => item.status === 'Approved')
                .forEach(item => {
                    const monthKey = item.effectiveOn.slice(0, 7);

                    if (monthMap[monthKey] !== undefined) {
                        values[monthMap[monthKey]] += 1;
                    }
                });

            return { labels, values };
        }

        function buildEligibilityBreakdownData() {
            const eligibilityMap = {};

            eligibilityReviews.forEach(item => {
                if (!eligibilityMap[item.status]) {
                    eligibilityMap[item.status] = 0;
                }

                eligibilityMap[item.status] += 1;
            });

            return {
                labels: Object.keys(eligibilityMap),
                values: Object.values(eligibilityMap)
            };
        }

        function renderPromotionDepartmentChart() {
            if (!promotionDepartmentChartCanvas || typeof Chart === 'undefined') {
                return;
            }

            const data = buildDepartmentPromotionData();

            if (promotionDepartmentChart) {
                promotionDepartmentChart.destroy();
            }

            promotionDepartmentChart = new Chart(promotionDepartmentChartCanvas, {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Promotion Cases',
                        data: data.values,
                        backgroundColor: '#4f46e5',
                        borderRadius: 10,
                        maxBarThickness: 50
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
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

        function renderRankDistributionChart() {
            if (!rankDistributionChartCanvas || typeof Chart === 'undefined') {
                return;
            }

            const data = buildRankDistributionData();

            if (rankDistributionChart) {
                rankDistributionChart.destroy();
            }

            rankDistributionChart = new Chart(rankDistributionChartCanvas, {
                type: 'line',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Employees',
                        data: data.values,
                        borderColor: '#0ea5e9',
                        backgroundColor: 'rgba(14, 165, 233, 0.12)',
                        fill: true,
                        tension: 0.42,
                        pointRadius: 4,
                        pointHoverRadius: 5,
                        pointBackgroundColor: '#0ea5e9'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
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

        function renderMonthlyPromotionTrendChart() {
            if (!monthlyPromotionTrendChartCanvas || typeof Chart === 'undefined') {
                return;
            }

            const data = buildMonthlyTrendData();

            if (monthlyPromotionTrendChart) {
                monthlyPromotionTrendChart.destroy();
            }

            monthlyPromotionTrendChart = new Chart(monthlyPromotionTrendChartCanvas, {
                type: 'line',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Approved Promotions',
                        data: data.values,
                        borderColor: '#10b981',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        fill: false,
                        tension: 0.28,
                        pointRadius: 4,
                        pointHoverRadius: 5,
                        pointBackgroundColor: '#10b981'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
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

        function renderEligibilityBreakdownChart() {
            if (!eligibilityBreakdownChartCanvas || typeof Chart === 'undefined') {
                return;
            }

            const data = buildEligibilityBreakdownData();

            if (eligibilityBreakdownChart) {
                eligibilityBreakdownChart.destroy();
            }

            eligibilityBreakdownChart = new Chart(eligibilityBreakdownChartCanvas, {
                type: 'polarArea',
                data: {
                    labels: data.labels,
                    datasets: [{
                        data: data.values,
                        backgroundColor: ['rgba(79, 70, 229, 0.75)', 'rgba(14, 165, 233, 0.75)', 'rgba(245, 158, 11, 0.75)', 'rgba(239, 68, 68, 0.75)'],
                        borderWidth: 1,
                        borderColor: '#ffffff'
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
                                font: { size: 12, weight: '600' }
                            }
                        }
                    },
                    scales: {
                        r: {
                            ticks: {
                                precision: 0,
                                backdropColor: 'transparent',
                                color: '#64748b'
                            },
                            grid: {
                                color: 'rgba(226, 232, 240, 0.85)'
                            }
                        }
                    }
                }
            });
        }

        function renderRecentPromotionActivity() {
            const records = promotionRequests
                .slice()
                .sort((left, right) => new Date(right.requestedOn) - new Date(left.requestedOn))
                .slice(0, 5);

            recentPromotionActivity.innerHTML = records.map(item => `
                <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <p class="text-sm font-semibold text-slate-700">${item.employee}</p>
                            <p class="mt-1 text-xs text-slate-400">${item.department} · ${item.branch}</p>
                        </div>
                        <span class="status-pill ${getStatusClass(item.status)}">${item.status}</span>
                    </div>
                    <p class="mt-4 text-sm text-slate-600">${item.fromRank} <span class="text-slate-300">→</span> ${item.toRank}</p>
                    <p class="mt-2 text-xs text-slate-400">Requested ${item.requestedOn} · Rule: ${item.ruleRef}</p>
                </div>
            `).join('');
        }

        function renderEmployeesNearingEligibility() {
            const records = eligibilityReviews
                .filter(item => item.status === 'Nearing Eligibility')
                .slice(0, 5);

            employeesNearingEligibility.innerHTML = records.map(item => `
                <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <p class="text-sm font-semibold text-slate-700">${item.employee}</p>
                            <p class="mt-1 text-xs text-slate-400">${item.department}</p>
                        </div>
                        <span class="rounded-full bg-sky-50 px-3 py-1 text-[11px] font-semibold text-sky-600">${item.readiness}</span>
                    </div>
                    <p class="mt-4 text-xs font-medium uppercase tracking-[0.2em] text-slate-400">Next Review Window</p>
                    <p class="mt-2 text-sm text-slate-600">${item.nextWindow}</p>
                </div>
            `).join('');
        }

        function renderPendingApprovals() {
            const records = promotionRequests
                .filter(item => item.status === 'Pending')
                .slice()
                .sort((left, right) => new Date(left.effectiveOn) - new Date(right.effectiveOn));

            pendingPromotionApprovals.innerHTML = records.map(item => `
                <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <p class="text-sm font-semibold text-slate-700">${item.employee}</p>
                            <p class="mt-1 text-xs text-slate-400">${item.department} · ${item.branch}</p>
                        </div>
                        <span class="status-pill status-pending">${item.status}</span>
                    </div>
                    <p class="mt-4 text-sm text-slate-600">${item.fromRank} <span class="text-slate-300">→</span> ${item.toRank}</p>
                    <p class="mt-2 text-xs text-slate-400">Awaiting decision before ${item.effectiveOn}</p>
                </div>
            `).join('');
        }

        function renderPromotionDashboard() {
            renderInsightCards();
            renderPromotionDepartmentChart();
            renderRankDistributionChart();
            renderMonthlyPromotionTrendChart();
            renderEligibilityBreakdownChart();
            renderRecentPromotionActivity();
            renderEmployeesNearingEligibility();
            renderPendingApprovals();
        }

        sidebarToggle.addEventListener('click', handleSidebarToggle);
        sidebarOverlay.addEventListener('click', closeMobileSidebar);
        window.addEventListener('resize', syncSidebarMode);

        renderPromotionDashboard();
        syncSidebarMode();
    </script>
</body>
</html>
