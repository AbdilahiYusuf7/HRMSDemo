<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRM System - Reports & Insights</title>
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
    <?php $currentMenu = 'promotion_reports'; ?>
    <?php include __DIR__ . '/../../includes/header_sidebar.php'; ?>

    <div class="mx-auto w-full max-w-[1440px] p-4 md:p-8">
        <div class="mb-8 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-slate-800">Reports &amp; Insights</h2>
                <p class="text-sm text-slate-500">Track promotion activity, qualification impact, review bottlenecks, and promotion readiness trends across the organization.</p>
            </div>
        </div>

        <div id="reportInsightCards" class="mb-8 grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-4"></div>

        <div class="mb-8 grid grid-cols-1 gap-6 xl:grid-cols-2">
            <div class="glass-card p-6">
                <div class="mb-5">
                    <h3 class="text-base font-semibold text-slate-800">Department Comparison</h3>
                    <p class="mt-1 text-xs text-slate-400">Promotion volumes by department in the current reporting window.</p>
                </div>
                <div class="h-80">
                    <canvas id="departmentComparisonChart"></canvas>
                </div>
            </div>
            <div class="glass-card p-6">
                <div class="mb-5">
                    <h3 class="text-base font-semibold text-slate-800">Rank Distribution</h3>
                    <p class="mt-1 text-xs text-slate-400">Current spread of completed promotions across rank levels.</p>
                </div>
                <div class="h-80">
                    <canvas id="rankDistributionChart"></canvas>
                </div>
            </div>
        </div>

        <div class="mb-8 grid grid-cols-1 gap-6 xl:grid-cols-2">
            <div class="glass-card p-6">
                <div class="mb-5">
                    <h3 class="text-base font-semibold text-slate-800">Completion Trend</h3>
                    <p class="mt-1 text-xs text-slate-400">Monthly line trend for completed promotions across the year.</p>
                </div>
                <div class="h-80">
                    <canvas id="completionTrendChart"></canvas>
                </div>
            </div>
            <div class="glass-card p-6">
                <div class="mb-5">
                    <h3 class="text-base font-semibold text-slate-800">Training Participation by Branch</h3>
                    <p class="mt-1 text-xs text-slate-400">Promotion-readiness training participation across branches.</p>
                </div>
                <div class="h-80">
                    <canvas id="trainingParticipationChart"></canvas>
                </div>
            </div>
        </div>

        <div class="mb-8 grid grid-cols-1 gap-6 xl:grid-cols-2">
            <div class="glass-card p-6">
                <div class="mb-5">
                    <h3 class="text-base font-semibold text-slate-800">Qualification Impact</h3>
                    <p class="mt-1 text-xs text-slate-400">How verified qualifications contribute to successful promotion movement.</p>
                </div>
                <div class="h-80">
                    <canvas id="qualificationImpactChart"></canvas>
                </div>
            </div>
            <div class="glass-card p-6">
                <div class="mb-5">
                    <h3 class="text-base font-semibold text-slate-800">Approval Bottlenecks</h3>
                    <p class="mt-1 text-xs text-slate-400">Average waiting time across each approval checkpoint.</p>
                </div>
                <div class="h-80">
                    <canvas id="approvalBottlenecksChart"></canvas>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">
            <div class="glass-card p-6">
                <div class="mb-5 flex items-center justify-between">
                    <div>
                        <h3 class="text-base font-semibold text-slate-800">Overdue Mandatory Promotion Reviews</h3>
                        <p class="mt-1 text-xs text-slate-400">Employees whose mandatory review cycles are still overdue.</p>
                    </div>
                    <span class="rounded-full bg-rose-50 px-3 py-1 text-xs font-semibold text-rose-600">4 Overdue</span>
                </div>
                <div class="space-y-4">
                    <div class="rounded-2xl border border-slate-100 bg-slate-50/80 p-4">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-sm font-semibold text-slate-800">Mahad Axmed</p>
                                <p class="mt-1 text-xs text-slate-400">Finance · Senior Finance Officer</p>
                            </div>
                            <span class="rounded-full bg-rose-100 px-3 py-1 text-[11px] font-semibold text-rose-600">12 Days Late</span>
                        </div>
                    </div>
                    <div class="rounded-2xl border border-slate-100 bg-slate-50/80 p-4">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-sm font-semibold text-slate-800">Sahra Cali</p>
                                <p class="mt-1 text-xs text-slate-400">Human Resource · Senior HR Officer</p>
                            </div>
                            <span class="rounded-full bg-rose-100 px-3 py-1 text-[11px] font-semibold text-rose-600">9 Days Late</span>
                        </div>
                    </div>
                    <div class="rounded-2xl border border-slate-100 bg-slate-50/80 p-4">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-sm font-semibold text-slate-800">Ifrah Maxamed</p>
                                <p class="mt-1 text-xs text-slate-400">Marketing · Marketing Lead</p>
                            </div>
                            <span class="rounded-full bg-rose-100 px-3 py-1 text-[11px] font-semibold text-rose-600">7 Days Late</span>
                        </div>
                    </div>
                    <div class="rounded-2xl border border-slate-100 bg-slate-50/80 p-4">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-sm font-semibold text-slate-800">Hodan Aadan</p>
                                <p class="mt-1 text-xs text-slate-400">Administration · Compliance Lead</p>
                            </div>
                            <span class="rounded-full bg-rose-100 px-3 py-1 text-[11px] font-semibold text-rose-600">5 Days Late</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="glass-card p-6">
                <div class="mb-5 flex items-center justify-between">
                    <div>
                        <h3 class="text-base font-semibold text-slate-800">Expiring Qualification Summary</h3>
                        <p class="mt-1 text-xs text-slate-400">Certificates and qualifications approaching expiry in the next review window.</p>
                    </div>
                    <span class="rounded-full bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-600">6 Expiring</span>
                </div>
                <div class="space-y-4">
                    <div class="rounded-2xl border border-slate-100 bg-slate-50/80 p-4">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-sm font-semibold text-slate-800">Leadership Certificate</p>
                                <p class="mt-1 text-xs text-slate-400">Operations Branch Supervisors</p>
                            </div>
                            <span class="rounded-full bg-amber-100 px-3 py-1 text-[11px] font-semibold text-amber-700">14 Days</span>
                        </div>
                    </div>
                    <div class="rounded-2xl border border-slate-100 bg-slate-50/80 p-4">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-sm font-semibold text-slate-800">Audit Compliance Renewal</p>
                                <p class="mt-1 text-xs text-slate-400">Finance and Administration Teams</p>
                            </div>
                            <span class="rounded-full bg-amber-100 px-3 py-1 text-[11px] font-semibold text-amber-700">18 Days</span>
                        </div>
                    </div>
                    <div class="rounded-2xl border border-slate-100 bg-slate-50/80 p-4">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-sm font-semibold text-slate-800">HR Mediation Certification</p>
                                <p class="mt-1 text-xs text-slate-400">HR Officers and HR Business Partners</p>
                            </div>
                            <span class="rounded-full bg-amber-100 px-3 py-1 text-[11px] font-semibold text-amber-700">21 Days</span>
                        </div>
                    </div>
                    <div class="rounded-2xl border border-slate-100 bg-slate-50/80 p-4">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-sm font-semibold text-slate-800">Systems Security Certificate</p>
                                <p class="mt-1 text-xs text-slate-400">IT Infrastructure Team</p>
                            </div>
                            <span class="rounded-full bg-amber-100 px-3 py-1 text-[11px] font-semibold text-amber-700">27 Days</span>
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
        const reportInsightCards = document.getElementById('reportInsightCards');

        const promotionMetrics = {
            thisMonth: 14,
            thisQuarter: 37,
            thisYear: 118,
            avgTimeToPromotion: 4.8
        };

        const reportCards = [
            { label: 'Promotions This Month', value: `${promotionMetrics.thisMonth}`, helper: 'Completed promotion actions in the current month.', border: 'border-indigo-500', iconBg: 'bg-indigo-50', iconColor: 'text-indigo-600', icon: 'fa-calendar-day' },
            { label: 'Promotions This Quarter', value: `${promotionMetrics.thisQuarter}`, helper: 'Total promotions completed during the current quarter.', border: 'border-emerald-500', iconBg: 'bg-emerald-50', iconColor: 'text-emerald-600', icon: 'fa-chart-column' },
            { label: 'Promotions This Year', value: `${promotionMetrics.thisYear}`, helper: 'Year-to-date completed promotion records across departments.', border: 'border-sky-500', iconBg: 'bg-sky-50', iconColor: 'text-sky-600', icon: 'fa-arrow-trend-up' },
            { label: 'Avg Time to Promotion', value: `${promotionMetrics.avgTimeToPromotion} Months`, helper: 'Average time from request initiation to final promotion outcome.', border: 'border-amber-500', iconBg: 'bg-amber-50', iconColor: 'text-amber-600', icon: 'fa-stopwatch' }
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

        function renderInsightCards() {
            reportInsightCards.innerHTML = reportCards.map(card => `
                <div class="glass-card insight-card border-l-4 ${card.border} p-5">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-500">${card.label}</p>
                            <h3 class="mt-2 text-2xl font-bold text-slate-800">${card.value}</h3>
                        </div>
                        <div class="rounded-xl ${card.iconBg} p-3 ${card.iconColor}">
                            <i class="fa-solid ${card.icon} text-lg"></i>
                        </div>
                    </div>
                    <p class="mt-4 text-[11px] font-medium text-slate-400">${card.helper}</p>
                </div>
            `).join('');
        }

        function buildCharts() {
            new Chart(document.getElementById('departmentComparisonChart'), {
                type: 'bar',
                data: {
                    labels: ['Operations', 'Finance', 'Human Resource', 'Administration', 'Marketing', 'IT'],
                    datasets: [{
                        label: 'Promotions',
                        data: [24, 19, 17, 15, 11, 9],
                        backgroundColor: 'rgba(99, 102, 241, 0.78)',
                        borderRadius: 10,
                        maxBarThickness: 42
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        x: {
                            grid: { display: false },
                            ticks: { color: '#64748b' }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: { precision: 0, color: '#64748b' },
                            grid: { color: 'rgba(148, 163, 184, 0.12)' }
                        }
                    }
                }
            });

            new Chart(document.getElementById('rankDistributionChart'), {
                type: 'bar',
                data: {
                    labels: ['Rank I', 'Rank II', 'Rank III', 'Supervisor', 'Manager'],
                    datasets: [{
                        label: 'Employees',
                        data: [28, 35, 24, 17, 8],
                        backgroundColor: ['#38bdf8', '#6366f1', '#8b5cf6', '#f59e0b', '#10b981'],
                        borderRadius: 10
                    }]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        x: {
                            beginAtZero: true,
                            ticks: { precision: 0, color: '#64748b' },
                            grid: { color: 'rgba(148, 163, 184, 0.12)' }
                        },
                        y: {
                            ticks: { color: '#64748b' },
                            grid: { display: false }
                        }
                    }
                }
            });

            new Chart(document.getElementById('completionTrendChart'), {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Completed Promotions',
                        data: [6, 8, 9, 11, 13, 12, 10, 14, 12, 11, 13, 15],
                        borderColor: '#0ea5e9',
                        backgroundColor: 'rgba(14, 165, 233, 0.15)',
                        fill: false,
                        tension: 0.35,
                        pointRadius: 4,
                        pointBackgroundColor: '#0ea5e9'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        x: {
                            grid: { display: false },
                            ticks: { color: '#64748b' }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: { precision: 0, color: '#64748b' },
                            grid: { color: 'rgba(148, 163, 184, 0.12)' }
                        }
                    }
                }
            });

            new Chart(document.getElementById('trainingParticipationChart'), {
                type: 'pie',
                data: {
                    labels: ['Idaacada Branch', 'Xero Awr Branch', 'Calaamada Branch', 'Masalaha Branch', 'Jigjiga Yar Branch'],
                    datasets: [{
                        data: [26, 18, 21, 15, 20],
                        backgroundColor: ['#6366f1', '#10b981', '#0ea5e9', '#f59e0b', '#8b5cf6'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                usePointStyle: true,
                                boxWidth: 10,
                                color: '#475569',
                                padding: 18
                            }
                        }
                    }
                }
            });

            new Chart(document.getElementById('qualificationImpactChart'), {
                type: 'line',
                data: {
                    labels: ['Certificate', 'Diploma', 'Degree', 'Postgraduate', 'Professional License'],
                    datasets: [{
                        label: 'Promotion Conversion',
                        data: [12, 18, 29, 34, 26],
                        borderColor: '#10b981',
                        backgroundColor: 'rgba(16, 185, 129, 0.18)',
                        fill: true,
                        tension: 0.4,
                        pointRadius: 4,
                        pointBackgroundColor: '#10b981'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        x: {
                            grid: { display: false },
                            ticks: { color: '#64748b' }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: { precision: 0, color: '#64748b' },
                            grid: { color: 'rgba(148, 163, 184, 0.12)' }
                        }
                    }
                }
            });

            new Chart(document.getElementById('approvalBottlenecksChart'), {
                type: 'line',
                data: {
                    labels: ['Manager Review', 'Department Head', 'HR Review', 'Committee', 'Final Approval'],
                    datasets: [{
                        label: 'Average Delay (Days)',
                        data: [2, 4, 3, 6, 2],
                        borderColor: '#f59e0b',
                        backgroundColor: 'rgba(245, 158, 11, 0.18)',
                        tension: 0.45,
                        pointRadius: 4,
                        pointBackgroundColor: '#f59e0b'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        x: {
                            grid: { display: false },
                            ticks: { color: '#64748b' }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: { precision: 0, color: '#64748b' },
                            grid: { color: 'rgba(148, 163, 184, 0.12)' }
                        }
                    }
                }
            });
        }

        sidebarToggle.addEventListener('click', handleSidebarToggle);
        sidebarOverlay.addEventListener('click', closeMobileSidebar);
        window.addEventListener('resize', syncSidebarMode);

        renderInsightCards();
        buildCharts();
        syncSidebarMode();
    </script>
</body>
</html>
