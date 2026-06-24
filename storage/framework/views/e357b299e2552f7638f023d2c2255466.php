<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php $__env->startPush('styles'); ?>
<style>
/* ── Dashboard Styles ── */
.dash-stat {
    background: var(--card-bg);
    border: 1px solid var(--border);
    border-radius: 14px;
    box-shadow: var(--card-shadow);
    padding: 20px;
    position: relative; overflow: hidden;
    transition: all 0.25s ease;
}
.dash-stat:hover { transform: translateY(-3px); box-shadow: var(--card-shadow-hover); }
.dash-stat-icon {
    width: 40px; height: 40px; border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
}
.dash-stat-label {
    font-family: 'Space Grotesk', monospace;
    font-size: 10px; font-weight: 700; letter-spacing: 0.12em;
    text-transform: uppercase; color: var(--text-3); margin-bottom: 4px;
}
.dash-stat-value {
    font-family: 'Space Grotesk', monospace;
    font-size: 30px; font-weight: 800; letter-spacing: -0.03em; color: var(--text);
}

.dash-progress-track { height: 4px; background: var(--bg-3); border-radius: 2px; overflow: hidden; margin-top: 14px; }
.dash-progress-fill  { height: 100%; border-radius: 2px; width: 0; transition: width 1.6s cubic-bezier(0.165,0.84,0.44,1); }

/* Stat colour variants */
.stat-green .dash-stat-icon { background: rgba(34,197,94,0.1); }
.stat-green .dash-stat-icon svg { color: #22c55e; }
.stat-green .dash-stat-value { color: #22c55e; }
.dark .stat-green .dash-stat-value { color: #4ade80; }
.stat-green .dash-progress-fill { background: linear-gradient(90deg, #16a34a, #4ade80); }

.stat-blue .dash-stat-icon { background: rgba(59,130,246,0.1); }
.stat-blue .dash-stat-icon svg { color: #3b82f6; }
.stat-blue .dash-stat-value { color: #2563eb; }
.dark .stat-blue .dash-stat-value { color: #60a5fa; }
.stat-blue .dash-progress-fill { background: linear-gradient(90deg, #2563eb, #60a5fa); }

.stat-amber .dash-stat-icon { background: rgba(245,158,11,0.1); }
.stat-amber .dash-stat-icon svg { color: #f59e0b; }
.stat-amber .dash-stat-value { color: #d97706; }
.dark .stat-amber .dash-stat-value { color: #fbbf24; }
.stat-amber .dash-progress-fill { background: linear-gradient(90deg, #d97706, #fbbf24); }

.stat-default .dash-stat-icon { background: var(--bg-3); }
.stat-default .dash-stat-icon svg { color: var(--text-2); }

/* Feed table */
.feed-table { width: 100%; border-collapse: collapse; }
.feed-table th {
    font-family: 'Space Grotesk', monospace; font-size: 9px; font-weight: 700;
    letter-spacing: 0.15em; text-transform: uppercase; color: var(--text-3);
    padding: 10px 14px; border-bottom: 1px solid var(--border);
    background: var(--bg-3); text-align: left;
}
.feed-table th:first-child { padding-left: 20px; border-radius: 8px 0 0 0; }
.feed-table th:last-child  { border-radius: 0 8px 0 0; }
.feed-table td { padding: 14px 14px; border-bottom: 1px solid var(--border); vertical-align: middle; }
.feed-table td:first-child { padding-left: 20px; }
.feed-table tbody tr { transition: background 0.15s ease; }
.feed-table tbody tr:hover { background: var(--bg-3); }
.feed-table tbody tr:last-child td { border-bottom: none; }

/* Side panels */
.side-panel {
    background: var(--card-bg);
    border: 1px solid var(--border);
    border-radius: 14px;
    box-shadow: var(--card-shadow);
}

/* Status indicator */
.status-dot {
    display: inline-block; width: 6px; height: 6px; border-radius: 50%;
}
</style>
<?php $__env->stopPush(); ?>

 <?php $__env->slot('header', null, []); ?> 
    <div class="flex items-center justify-between">
        <div>
            <h1 class="nx-page-title">Dashboard</h1>
            <div class="flex items-center gap-2 mt-1">
                <span class="status-dot animate-pulse" style="background: #22c55e; box-shadow: 0 0 6px #22c55e;"></span>
                <span class="text-xs font-mono-nexus font-semibold tracking-wide" style="color: var(--text-3);">All systems operational</span>
                <span style="color: var(--border-2);">·</span>
                <span id="sys-time" class="text-xs font-mono-nexus" style="color: var(--text-3);">—</span>
            </div>
        </div>
    </div>
 <?php $__env->endSlot(); ?>

<div class="py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto space-y-8">
    <?php
        $total = max($total_customers, 1);
        $won_pct = min(100, ($won_customers / $total) * 100);
        $neg_pct = min(100, ($negotiation_customers / $total) * 100);
        $new_pct = min(100, ($new_customers / $total) * 100);
    ?>

    <!-- ── Stat Cards ── -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

        <!-- Total -->
        <div class="dash-stat stat-default">
            <div class="flex items-start justify-between mb-3">
                <div>
                    <div class="dash-stat-label">Total Customers</div>
                    <div class="dash-stat-value"><?php echo e($total_customers ?? 0); ?></div>
                </div>
                <div class="dash-stat-icon">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-width="1.8" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
            </div>
            <div class="dash-progress-track">
                <div class="dash-progress-fill" data-width="100%" style="background: linear-gradient(90deg, var(--border-2), var(--text-2));"></div>
            </div>
        </div>

        <!-- Won -->
        <div class="dash-stat stat-green">
            <div class="flex items-start justify-between mb-3">
                <div>
                    <div class="dash-stat-label">Won Deals</div>
                    <div class="dash-stat-value"><?php echo e($won_customers ?? 0); ?></div>
                </div>
                <div class="dash-stat-icon">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-width="1.8" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <div class="dash-progress-track">
                <div class="dash-progress-fill" data-width="<?php echo e($won_pct); ?>%"></div>
            </div>
        </div>

        <!-- Negotiation -->
        <div class="dash-stat stat-amber">
            <div class="flex items-start justify-between mb-3">
                <div>
                    <div class="dash-stat-label">In Negotiation</div>
                    <div class="dash-stat-value"><?php echo e($negotiation_customers ?? 0); ?></div>
                </div>
                <div class="dash-stat-icon">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-width="1.8" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                </div>
            </div>
            <div class="dash-progress-track">
                <div class="dash-progress-fill" data-width="<?php echo e($neg_pct); ?>%"></div>
            </div>
        </div>

        <!-- New -->
        <div class="dash-stat stat-blue">
            <div class="flex items-start justify-between mb-3">
                <div>
                    <div class="dash-stat-label">New Leads</div>
                    <div class="dash-stat-value"><?php echo e($new_customers ?? 0); ?></div>
                </div>
                <div class="dash-stat-icon">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-width="1.8" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                </div>
            </div>
            <div class="dash-progress-track">
                <div class="dash-progress-fill" data-width="<?php echo e($new_pct); ?>%"></div>
            </div>
        </div>
    </div>

    <!-- ── Main Grid ── -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Recent Activity (2/3) -->
        <div class="lg:col-span-2 nx-card overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4" style="border-bottom: 1px solid var(--border);">
                <div class="flex items-center gap-3">
                    <div class="w-1.5 h-5 rounded-full" style="background: linear-gradient(180deg, var(--accent), #a5b4fc);"></div>
                    <h2 class="font-mono-nexus font-bold text-sm tracking-wide" style="color: var(--text);">Recent Activity</h2>
                    <span class="nx-badge" style="background: var(--accent-glow); color: var(--accent); border-color: transparent;">Latest 5</span>
                </div>
                <a href="<?php echo e(route('customers.index')); ?>"
                   class="text-xs font-mono-nexus font-semibold tracking-wide flex items-center gap-1 transition-colors"
                   style="color: var(--accent);"
                   onmouseover="this.style.color='var(--accent-2)'" onmouseout="this.style.color='var(--accent)'">
                    View all
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            <table class="feed-table">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Status</th>
                        <th>Value</th>
                        <th class="text-right" style="padding-right: 20px;">Updated</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $latest_customers ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php
                            $badge = match($customer->status) {
                                'new'         => 'nx-badge-blue',
                                'negotiation' => 'nx-badge-yellow',
                                'won'         => 'nx-badge-green',
                                'lost'        => 'nx-badge-red',
                                default       => 'nx-badge-gray'
                            };
                        ?>
                        <tr>
                            <td>
                                <a href="<?php echo e(route('customers.show', $customer->id)); ?>" class="block group">
                                    <div class="font-semibold text-sm transition-colors" style="color: var(--text);" onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color='var(--text)'"><?php echo e($customer->name); ?></div>
                                    <div class="text-xs mt-0.5" style="color: var(--text-3);"><?php echo e($customer->company ?? '—'); ?></div>
                                </a>
                            </td>
                            <td>
                                <span class="nx-badge <?php echo e($badge); ?>">
                                    <span class="w-1 h-1 rounded-full" style="background: currentColor;"></span>
                                    <?php echo e($customer->status); ?>

                                </span>
                            </td>
                            <td class="font-mono-nexus font-bold text-sm" style="color: #22c55e;">
                                $<?php echo e(number_format($customer->deal_value ?? 0, 0)); ?>

                            </td>
                            <td class="text-right text-xs pr-5" style="color: var(--text-3);">
                                <?php echo e($customer->updated_at->diffForHumans(null, true, true)); ?>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4" class="py-16 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: var(--border-2);"><path stroke-linecap="round" stroke-width="1.2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                    <span class="text-sm font-semibold" style="color: var(--text-3);">No activity yet</span>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Right column -->
        <div class="space-y-5">

            <!-- System Status -->
            <div class="side-panel p-5">
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-1.5 h-4 rounded-full" style="background: linear-gradient(180deg, #8b5cf6, #6366f1);"></div>
                    <h3 class="font-mono-nexus font-bold text-xs tracking-widest uppercase" style="color: var(--text);">System Status</h3>
                </div>
                <div class="space-y-3">
                    <?php $__currentLoopData = [['Core Ledger','ONLINE','#22c55e'],['API Gateway','SYNCED','#22c55e'],['Node Latency','14ms','#3b82f6']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$lbl,$val,$clr]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex items-center justify-between py-2" style="border-bottom: 1px solid var(--border);">
                        <span class="text-xs font-semibold" style="color: var(--text-2);"><?php echo e($lbl); ?></span>
                        <span class="text-xs font-bold font-mono-nexus flex items-center gap-1.5" style="color: <?php echo e($clr); ?>;">
                            <?php if($val !== '14ms'): ?>
                                <span class="w-1.5 h-1.5 rounded-full animate-pulse" style="background: <?php echo e($clr); ?>;"></span>
                            <?php endif; ?>
                            <?php echo e($val); ?>

                        </span>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="side-panel p-5">
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-1.5 h-4 rounded-full" style="background: linear-gradient(180deg, var(--accent), #a5b4fc);"></div>
                    <h3 class="font-mono-nexus font-bold text-xs tracking-widest uppercase" style="color: var(--text);">Quick Actions</h3>
                </div>
                <div class="space-y-2.5">
                    <a href="<?php echo e(route('kanban')); ?>" class="nx-btn-primary" style="display: flex; text-decoration: none;">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"/></svg>
                        Open Pipeline
                    </a>
                    <a href="<?php echo e(route('customers.create')); ?>" class="nx-btn-ghost" style="display: flex; text-decoration: none; width: 100%; justify-content: center;">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Add Customer
                    </a>
                    <button onclick="generateReport()" class="nx-btn-ghost" style="width: 100%; justify-content: center;">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <span id="report-btn-text">Generate Report</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Animate progress bars
    setTimeout(() => {
        document.querySelectorAll('.dash-progress-fill').forEach(el => {
            el.style.width = el.getAttribute('data-width');
        });
    }, 150);

    // Clock
    function tick() {
        var el = document.getElementById('sys-time');
        if (el) el.textContent = new Date().toISOString().slice(11, 19) + ' UTC';
    }
    tick(); setInterval(tick, 1000);
});

function generateReport() {
    var btn = document.getElementById('report-btn-text');
    var orig = btn.textContent;
    btn.textContent = 'Generating...';
    showNxToast('Compiling report...', 'info');
    setTimeout(() => {
        btn.textContent = orig;
        showNxToast('Report ready!', 'success');
    }, 2500);
}
</script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\Users\ASUS\OneDrive\Desktop\laravel\my-crm\resources\views/dashboard.blade.php ENDPATH**/ ?>