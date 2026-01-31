@extends('site.innerPages.layout.master')


@section('content')
    <div class="content-header">
        <h1>Company Profile</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Knowledge Center</a></li>
                <li class="breadcrumb-item active">Operational Knowledge </li>
            </ol>
        </nav>
    </div>

    <div class="content-body">
        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col-md-8">
                <h4 class="mb-2">
                    <i class="fas fa-tasks text-success me-2"></i> Operational Knowledge
                </h4>
                <p class="text-muted">Day-to-day tasks, processes, and operational procedures</p>
            </div>
            <div class="col-md-4 text-end">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createOperationalModal">
                    <i class="fas fa-plus me-2"></i> Create Operational Card
                </button>
            </div>
        </div>

        <!-- Filters & Search -->
        <div class="row g-3 mb-4">
            <div class="col-md-5">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" class="form-control" placeholder="Search operational tasks and procedures...">
                </div>
            </div>
            <div class="col-md-3">
                <select class="form-select">
                    <option value="">All Departments</option>
                    <option value="it">IT Department</option>
                    <option value="sales">Sales Department</option>
                    <option value="operations">Operations</option>
                </select>
            </div>
            <div class="col-md-2">
                <select class="form-select">
                    <option value="">Task Type</option>
                    <option value="daily">Daily</option>
                    <option value="weekly">Weekly</option>
                    <option value="monthly">Monthly</option>
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-outline-primary w-100">
                    <i class="fas fa-download me-1"></i> Export
                </button>
            </div>
        </div>

        <!-- Operational Cards -->
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="operational-card">
                    <div class="operational-header">
                        <div class="task-type-badge daily-task">
                            <i class="fas fa-calendar-day"></i> Daily Task
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-light" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> View</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-archive me-2"></i> Archive</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="operational-body">
                        <h5 class="operational-title">Server Backup Procedure</h5>
                        <p class="operational-description">Daily server backup routine including verification and off-site
                            storage.</p>

                        <div class="operational-details">
                            <div class="detail-row">
                                <span class="detail-label"><i class="fas fa-user-tie text-primary"></i> Owner</span>
                                <span class="detail-value">Ahmad Khaled</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label"><i class="fas fa-tools text-success"></i> Tools</span>
                                <span class="detail-value">Veeam, AWS S3</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label"><i class="fas fa-clock text-warning"></i> Duration</span>
                                <span class="detail-value">30 minutes</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label"><i class="fas fa-building text-info"></i> Department</span>
                                <span class="detail-value">IT Department</span>
                            </div>
                        </div>
                    </div>
                    <div class="operational-footer">
                        <button class="btn btn-sm btn-outline-primary w-100">
                            <i class="fas fa-eye me-1"></i> View Full Procedure
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="operational-card">
                    <div class="operational-header">
                        <div class="task-type-badge weekly-task">
                            <i class="fas fa-calendar-week"></i> Weekly Task
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-light" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> View</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-archive me-2"></i> Archive</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="operational-body">
                        <h5 class="operational-title">Weekly Sales Report</h5>
                        <p class="operational-description">Compile and distribute weekly sales performance report to
                            management team.</p>

                        <div class="operational-details">
                            <div class="detail-row">
                                <span class="detail-label"><i class="fas fa-user-tie text-primary"></i> Owner</span>
                                <span class="detail-value">Mohammed Ali</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label"><i class="fas fa-tools text-success"></i> Tools</span>
                                <span class="detail-value">Salesforce, Excel</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label"><i class="fas fa-clock text-warning"></i> Duration</span>
                                <span class="detail-value">2 hours</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label"><i class="fas fa-building text-info"></i> Department</span>
                                <span class="detail-value">Sales Department</span>
                            </div>
                        </div>
                    </div>
                    <div class="operational-footer">
                        <button class="btn btn-sm btn-outline-primary w-100">
                            <i class="fas fa-eye me-1"></i> View Full Procedure
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="operational-card">
                    <div class="operational-header">
                        <div class="task-type-badge monthly-task">
                            <i class="fas fa-calendar-alt"></i> Monthly Task
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-light" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> View</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a>
                                </li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-archive me-2"></i>
                                        Archive</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="operational-body">
                        <h5 class="operational-title">Payroll Processing</h5>
                        <p class="operational-description">Monthly payroll calculation, verification, and payment
                            distribution process.</p>

                        <div class="operational-details">
                            <div class="detail-row">
                                <span class="detail-label"><i class="fas fa-user-tie text-primary"></i> Owner</span>
                                <span class="detail-value">Sarah Ahmed</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label"><i class="fas fa-tools text-success"></i> Tools</span>
                                <span class="detail-value">ADP, QuickBooks</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label"><i class="fas fa-clock text-warning"></i> Duration</span>
                                <span class="detail-value">4 hours</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label"><i class="fas fa-building text-info"></i> Department</span>
                                <span class="detail-value">HR Department</span>
                            </div>
                        </div>
                    </div>
                    <div class="operational-footer">
                        <button class="btn btn-sm btn-outline-primary w-100">
                            <i class="fas fa-eye me-1"></i> View Full Procedure
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="operational-card">
                    <div class="operational-header">
                        <div class="task-type-badge daily-task">
                            <i class="fas fa-calendar-day"></i> Daily Task
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-light" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> View</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="operational-body">
                        <h5 class="operational-title">Customer Support Ticket Review</h5>
                        <p class="operational-description">Daily review and prioritization of customer support tickets.</p>

                        <div class="operational-details">
                            <div class="detail-row">
                                <span class="detail-label"><i class="fas fa-user-tie text-primary"></i> Owner</span>
                                <span class="detail-value">Support Team</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label"><i class="fas fa-tools text-success"></i> Tools</span>
                                <span class="detail-value">Zendesk, Slack</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label"><i class="fas fa-clock text-warning"></i> Duration</span>
                                <span class="detail-value">1 hour</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label"><i class="fas fa-building text-info"></i> Department</span>
                                <span class="detail-value">Customer Support</span>
                            </div>
                        </div>
                    </div>
                    <div class="operational-footer">
                        <button class="btn btn-sm btn-outline-primary w-100">
                            <i class="fas fa-eye me-1"></i> View Full Procedure
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="operational-card">
                    <div class="operational-header">
                        <div class="task-type-badge weekly-task">
                            <i class="fas fa-calendar-week"></i> Weekly Task
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-light" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> View</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="operational-body">
                        <h5 class="operational-title">Inventory Stock Check</h5>
                        <p class="operational-description">Weekly inventory audit and reorder point verification.</p>

                        <div class="operational-details">
                            <div class="detail-row">
                                <span class="detail-label"><i class="fas fa-user-tie text-primary"></i> Owner</span>
                                <span class="detail-value">Operations Team</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label"><i class="fas fa-tools text-success"></i> Tools</span>
                                <span class="detail-value">SAP, Barcode Scanner</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label"><i class="fas fa-clock text-warning"></i> Duration</span>
                                <span class="detail-value">3 hours</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label"><i class="fas fa-building text-info"></i> Department</span>
                                <span class="detail-value">Operations</span>
                            </div>
                        </div>
                    </div>
                    <div class="operational-footer">
                        <button class="btn btn-sm btn-outline-primary w-100">
                            <i class="fas fa-eye me-1"></i> View Full Procedure
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="operational-card">
                    <div class="operational-header">
                        <div class="task-type-badge monthly-task">
                            <i class="fas fa-calendar-alt"></i> Monthly Task
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-light" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> View</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="operational-body">
                        <h5 class="operational-title">Financial Report Generation</h5>
                        <p class="operational-description">Monthly financial statements and budget variance analysis.</p>

                        <div class="operational-details">
                            <div class="detail-row">
                                <span class="detail-label"><i class="fas fa-user-tie text-primary"></i> Owner</span>
                                <span class="detail-value">Omar Yousef</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label"><i class="fas fa-tools text-success"></i> Tools</span>
                                <span class="detail-value">QuickBooks, Excel</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label"><i class="fas fa-clock text-warning"></i> Duration</span>
                                <span class="detail-value">6 hours</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label"><i class="fas fa-building text-info"></i> Department</span>
                                <span class="detail-value">Finance</span>
                            </div>
                        </div>
                    </div>
                    <div class="operational-footer">
                        <button class="btn btn-sm btn-outline-primary w-100">
                            <i class="fas fa-eye me-1"></i> View Full Procedure
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
