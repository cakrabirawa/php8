<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('page-title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <!-- Welcome Section -->
        <div class="row mb-6">
            <div class="col-12">
                <div class="welcome-section">
                    <h1 class="welcome-title">Good <?php echo e(now()->format('A') === 'AM' ? 'morning' : (now()->format('H') < 18 ? 'afternoon' : 'evening')); ?>, <?php echo e(Auth::user()->name); ?>! 👋</h1>
                    <p class="welcome-subtitle">Here's what's happening with your tasks today.</p>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-6">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="stat-card stat-card-primary">
                    <div class="stat-card-icon">
                        <i class="bi bi-check-square-fill"></i>
                    </div>
                    <div class="stat-card-content">
                        <div class="stat-card-number"><?php echo e($tasksCount); ?></div>
                        <div class="stat-card-label">Active Tasks</div>
                    </div>
                    <a href="<?php echo e(route('projects.index')); ?>" class="stat-card-action">
                        <span>View all</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="stat-card stat-card-success">
                    <div class="stat-card-icon">
                        <i class="bi bi-folder-fill"></i>
                    </div>
                    <div class="stat-card-content">
                        <div class="stat-card-number"><?php echo e($projectsCount); ?></div>
                        <div class="stat-card-label">Total Projects</div>
                    </div>
                    <a href="<?php echo e(route('projects.index')); ?>" class="stat-card-action">
                        <span>Manage</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="stat-card stat-card-warning">
                    <div class="stat-card-icon">
                        <i class="bi bi-arrow-repeat"></i>
                    </div>
                    <div class="stat-card-content">
                        <div class="stat-card-number"><?php echo e($routinesCount); ?></div>
                        <div class="stat-card-label">Today's Routines</div>
                    </div>
                    <a href="<?php echo e(route('routines.index')); ?>" class="stat-card-action">
                        <span>View routines</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="stat-card stat-card-info">
                    <div class="stat-card-icon">
                        <i class="bi bi-journal-text"></i>
                    </div>
                    <div class="stat-card-content">
                        <div class="stat-card-number"><?php echo e($notesCount); ?></div>
                        <div class="stat-card-label">Saved Notes</div>
                    </div>
                    <a href="<?php echo e(route('notes.index')); ?>" class="stat-card-action">
                        <span>Browse notes</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Advanced Analytics Section -->
        <div class="row mb-6">
            <!-- Productivity Overview -->
            <div class="col-xl-8 mb-4">
                <div class="analytics-card">
                    <div class="analytics-card-header">
                        <div class="analytics-card-title">
                            <i class="bi bi-graph-up"></i>
                            <span>Productivity Overview</span>
                        </div>
                        <div class="analytics-card-actions">
                            <select class="form-select form-select-sm" id="periodSelect">
                                <option value="week">This Week</option>
                                <option value="month">This Month</option>
                                <option value="year">This Year</option>
                            </select>
                        </div>
                    </div>
                    <div class="analytics-card-content">
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <div class="metric-widget">
                                    <div class="metric-value"><?php echo e($completedTasksThisWeek); ?></div>
                                    <div class="metric-label">Tasks Completed</div>
                                    <div class="metric-trend positive">+12% from last week</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="metric-widget">
                                    <div class="metric-value"><?php echo e($completionRate); ?>%</div>
                                    <div class="metric-label">Completion Rate</div>
                                    <div class="metric-trend positive">+5% improvement</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="metric-widget">
                                    <div class="metric-value"><?php echo e($activeProjects); ?></div>
                                    <div class="metric-label">Active Projects</div>
                                    <div class="metric-trend neutral">No change</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="metric-widget">
                                    <div class="metric-value"><?php echo e($overdueTasks); ?></div>
                                    <div class="metric-label">Overdue Tasks</div>
                                    <div class="metric-trend negative">Needs attention</div>
                                </div>
                            </div>
                        </div>
                        <div class="chart-container">
                            <canvas id="productivityChart" height="100"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions & Calendar -->
            <div class="col-xl-4 mb-4">
                <div class="quick-actions-card mb-4">
                    <div class="quick-actions-header">
                        <h3>Quick Actions</h3>
                    </div>
                    <div class="quick-actions-grid">
                        <a href="<?php echo e(route('projects.create')); ?>" class="quick-action-item">
                            <div class="quick-action-icon primary">
                                <i class="bi bi-folder-plus"></i>
                            </div>
                            <span>New Project</span>
                        </a>
                        <a href="<?php echo e(route('notes.create')); ?>" class="quick-action-item">
                            <div class="quick-action-icon success">
                                <i class="bi bi-journal-plus"></i>
                            </div>
                            <span>Quick Note</span>
                        </a>
                        <a href="<?php echo e(route('reminders.create')); ?>" class="quick-action-item">
                            <div class="quick-action-icon warning">
                                <i class="bi bi-bell-plus"></i>
                            </div>
                            <span>Set Reminder</span>
                        </a>
                        <a href="<?php echo e(route('routines.create')); ?>" class="quick-action-item">
                            <div class="quick-action-icon info">
                                <i class="bi bi-arrow-clockwise"></i>
                            </div>
                            <span>Add Routine</span>
                        </a>
                    </div>
                </div>

                <div class="mini-calendar-card">
                    <div class="mini-calendar-header">
                        <h3><?php echo e(now()->format('F Y')); ?></h3>
                        <div class="calendar-nav">
                            <button class="btn btn-sm btn-outline" id="prevMonth">
                                <i class="bi bi-chevron-left"></i>
                            </button>
                            <button class="btn btn-sm btn-outline" id="nextMonth">
                                <i class="bi bi-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mini-calendar" id="miniCalendar">
                        <!-- Calendar will be generated by JavaScript -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Task Status Distribution -->
        <div class="row mb-6">
            <div class="col-xl-4 mb-4">
                <div class="status-distribution-card">
                    <div class="status-distribution-header">
                        <h3>Task Distribution</h3>
                        <span class="total-tasks"><?php echo e($tasksCount); ?> total tasks</span>
                    </div>
                    <div class="status-distribution-chart">
                        <canvas id="taskStatusChart" width="200" height="200"></canvas>
                    </div>
                    <div class="status-distribution-legend">
                        <div class="legend-item">
                            <span class="legend-color" style="background-color: var(--primary-500);"></span>
                            <span class="legend-label">To Do (<?php echo e($taskStatusDistribution['to_do']); ?>)</span>
                        </div>
                        <div class="legend-item">
                            <span class="legend-color" style="background-color: var(--warning-500);"></span>
                            <span class="legend-label">In Progress (<?php echo e($taskStatusDistribution['in_progress']); ?>)</span>
                        </div>
                        <div class="legend-item">
                            <span class="legend-color" style="background-color: var(--success-500);"></span>
                            <span class="legend-label">Completed (<?php echo e($taskStatusDistribution['completed']); ?>)</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Priority Distribution -->
            <div class="col-xl-4 mb-4">
                <div class="priority-card">
                    <div class="priority-header">
                        <h3>Priority Breakdown</h3>
                    </div>
                    <div class="priority-items">
                        <div class="priority-item high">
                            <div class="priority-indicator"></div>
                            <div class="priority-content">
                                <span class="priority-label">High Priority</span>
                                <span class="priority-count"><?php echo e($priorityDistribution['high']); ?></span>
                            </div>
                            <div class="priority-progress">
                                <div class="progress-bar high" style="width: <?php echo e($priorityPercentages['high']); ?>%"></div>
                            </div>
                        </div>
                        <div class="priority-item medium">
                            <div class="priority-indicator"></div>
                            <div class="priority-content">
                                <span class="priority-label">Medium Priority</span>
                                <span class="priority-count"><?php echo e($priorityDistribution['medium']); ?></span>
                            </div>
                            <div class="priority-progress">
                                <div class="progress-bar medium" style="width: <?php echo e($priorityPercentages['medium']); ?>%"></div>
                            </div>
                        </div>
                        <div class="priority-item low">
                            <div class="priority-indicator"></div>
                            <div class="priority-content">
                                <span class="priority-label">Low Priority</span>
                                <span class="priority-count"><?php echo e($priorityDistribution['low']); ?></span>
                            </div>
                            <div class="priority-progress">
                                <div class="progress-bar low" style="width: <?php echo e($priorityPercentages['low']); ?>%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity Timeline -->
            <div class="col-xl-4 mb-4">
                <div class="timeline-card">
                    <div class="timeline-header">
                        <h3>Recent Activity</h3>
                        <a href="#" class="view-all-link">View all</a>
                    </div>
                    <div class="timeline">
                        <?php $__currentLoopData = $recentTasks->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="timeline-item">
                            <div class="timeline-marker <?php echo e($task->status); ?>"></div>
                            <div class="timeline-content">
                                <div class="timeline-title"><?php echo e($task->title); ?></div>
                                <div class="timeline-subtitle"><?php echo e($task->project->name ?? 'No Project'); ?></div>
                                <div class="timeline-time"><?php echo e($task->updated_at->diffForHumans()); ?></div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Recent Tasks -->
            <div class="col-xl-6 col-lg-12 mb-4">
                <div class="activity-card">
                    <div class="activity-card-header">
                        <div class="activity-card-title">
                            <i class="bi bi-clock-history"></i>
                            <span>Recent Tasks</span>
                        </div>
                        <a href="<?php echo e(route('projects.index')); ?>" class="btn btn-outline btn-sm">
                            View all
                        </a>
                    </div>
                    <div class="activity-card-content">
                        <?php $__empty_1 = true; $__currentLoopData = $recentTasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="activity-item">
                                <div class="activity-item-icon task-status-<?php echo e($task->status); ?>">
                                    <i class="bi bi-<?php echo e($task->status == 'completed' ? 'check-circle-fill' : ($task->status == 'in_progress' ? 'arrow-right-circle' : 'circle')); ?>"></i>
                                </div>
                                <div class="activity-item-content">
                                    <div class="activity-item-title"><?php echo e($task->title); ?></div>
                                    <div class="activity-item-meta">
                                        <span class="task-status-badge status-<?php echo e($task->status); ?>">
                                            <?php echo e(ucwords(str_replace('_', ' ', $task->status))); ?>

                                        </span>
                                        <?php if($task->due_date != null): ?>
                                            <span class="activity-item-date"><?php echo e(\Carbon\Carbon::parse($task->due_date)->format('M d')); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="empty-state">
                                <i class="bi bi-list-check"></i>
                                <p>No recent tasks found</p>
                                <a href="<?php echo e(route('projects.create')); ?>" class="btn btn-primary btn-sm">Create Project</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Today's Routines -->
            <div class="col-xl-6 col-lg-12 mb-4">
                <div class="activity-card">
                    <div class="activity-card-header">
                        <div class="activity-card-title">
                            <i class="bi bi-calendar-day"></i>
                            <span>Today's Routines</span>
                        </div>
                        <a href="<?php echo e(route('routines.index')); ?>" class="btn btn-outline btn-sm">
                            View all
                        </a>
                    </div>
                    <div class="activity-card-content">
                        <?php $__empty_1 = true; $__currentLoopData = $todayRoutines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $routine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="activity-item">
                                <div class="activity-item-icon routine-frequency">
                                    <i class="bi bi-arrow-repeat"></i>
                                </div>
                                <div class="activity-item-content">
                                    <div class="activity-item-title"><?php echo e($routine->title); ?></div>
                                    <div class="activity-item-meta">
                                        <span class="routine-frequency-badge"><?php echo e(ucfirst($routine->frequency)); ?></span>
                                        <?php if($routine->time): ?>
                                            <span class="activity-item-date"><?php echo e($routine->time->format('H:i')); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="empty-state">
                                <i class="bi bi-arrow-repeat"></i>
                                <p>No routines for today</p>
                                <a href="<?php echo e(route('routines.create')); ?>" class="btn btn-primary btn-sm">Create Routine</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Recent Notes -->
            <div class="col-xl-6 col-lg-12 mb-4">
                <div class="activity-card">
                    <div class="activity-card-header">
                        <div class="activity-card-title">
                            <i class="bi bi-journal"></i>
                            <span>Recent Notes</span>
                        </div>
                        <a href="<?php echo e(route('notes.index')); ?>" class="btn btn-outline btn-sm">
                            View all
                        </a>
                    </div>
                    <div class="activity-card-content">
                        <?php $__empty_1 = true; $__currentLoopData = $recentNotes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="activity-item">
                                <div class="activity-item-icon note-icon">
                                    <i class="bi bi-sticky"></i>
                                </div>
                                <div class="activity-item-content">
                                    <div class="activity-item-title"><?php echo e($note->title); ?></div>
                                    <div class="activity-item-meta">
                                        <span class="activity-item-date"><?php echo e($note->created_at->format('M d, Y')); ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="empty-state">
                                <i class="bi bi-journal-plus"></i>
                                <p>No notes yet</p>
                                <a href="<?php echo e(route('notes.create')); ?>" class="btn btn-primary btn-sm">Create Note</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Upcoming Reminders -->
            <div class="col-xl-6 col-lg-12 mb-4">
                <div class="activity-card">
                    <div class="activity-card-header">
                        <div class="activity-card-title">
                            <i class="bi bi-bell"></i>
                            <span>Upcoming Reminders</span>
                        </div>
                        <a href="<?php echo e(route('reminders.index')); ?>" class="btn btn-outline btn-sm">
                            View all
                        </a>
                    </div>
                    <div class="activity-card-content">
                        <?php $__empty_1 = true; $__currentLoopData = $upcomingReminders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reminder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="activity-item">
                                <div class="activity-item-icon reminder-<?php echo e($reminder->date->isToday() ? 'today' : ($reminder->date->isPast() ? 'overdue' : 'upcoming')); ?>">
                                    <i class="bi bi-bell<?php echo e($reminder->date->isToday() ? '-fill' : ''); ?>"></i>
                                </div>
                                <div class="activity-item-content">
                                    <div class="activity-item-title"><?php echo e($reminder->title); ?></div>
                                    <div class="activity-item-meta">
                                        <span class="reminder-status-badge status-<?php echo e($reminder->date->isToday() ? 'today' : ($reminder->date->isPast() ? 'overdue' : 'upcoming')); ?>">
                                            <?php echo e($reminder->date->isToday() ? 'Today' : ($reminder->date->isPast() ? 'Overdue' : $reminder->date->format('M d'))); ?>

                                        </span>
                                        <?php if($reminder->time): ?>
                                            <span class="activity-item-date"><?php echo e(\Carbon\Carbon::parse($reminder->time)->format('H:i')); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="empty-state">
                                <i class="bi bi-bell-plus"></i>
                                <p>No upcoming reminders</p>
                                <a href="<?php echo e(route('reminders.create')); ?>" class="btn btn-primary btn-sm">Create Reminder</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/dashboard/style.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, initializing charts...');

    // Productivity Chart
    const chartCanvas = document.getElementById('productivityChart');

    if (!chartCanvas) {
        console.error('Productivity chart canvas element not found');
        return;
    } else {
        console.log('Productivity chart canvas found');
    }

    const ctx = chartCanvas.getContext('2d');

    // Fetch productivity data
    fetch('<?php echo e(route("dashboard.productivity-data")); ?>')
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            console.log('Productivity chart data received:', data);

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Tasks Completed',
                        data: data.data,
                        borderColor: '#3b82f6',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });

            console.log('Productivity chart initialized successfully');
        })
        .catch(error => {
            console.error('Error loading productivity data:', error);
        });

    // Task Status Distribution Chart
    const statusChartCanvas = document.getElementById('taskStatusChart');

    if (statusChartCanvas) {
        console.log('Status chart canvas found');

        const statusCtx = statusChartCanvas.getContext('2d');

        // Data from controller
        const statusData = {
            to_do: <?php echo e($taskStatusDistribution['to_do']); ?>,
            in_progress: <?php echo e($taskStatusDistribution['in_progress']); ?>,
            completed: <?php echo e($taskStatusDistribution['completed']); ?>

        };

        console.log('Status chart data:', statusData);

        new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: ['To Do', 'In Progress', 'Completed'],
                datasets: [{
                    data: [statusData.to_do, statusData.in_progress, statusData.completed],
                    backgroundColor: [
                        '#6366f1',  // Primary color
                        '#f59e0b',  // Warning color
                        '#10b981'   // Success color
                    ],
                    borderWidth: 0,
                    cutout: '65%'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        console.log('Status chart initialized successfully');
    } else {
        console.error('Status chart canvas element not found');
    }
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\projects\php8\task-manager\resources\views/dashboard.blade.php ENDPATH**/ ?>