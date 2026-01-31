@extends('site.innerPages.layout.master')


@section('content')
    <div class="content-header">
        <h1>Company Profile</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Knowledge Center</a></li>
                <li class="breadcrumb-item active">Onboarding Knowledge </li>
            </ol>
        </nav>
    </div>

    <div class="content-body">
        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col-md-8">
                <h4 class="mb-2">
                    <i class="fas fa-graduation-cap text-primary me-2"></i> Onboarding Knowledge
                </h4>
                <p class="text-muted">Essential knowledge for new employees and team members</p>
            </div>
            <div class="col-md-4 text-end">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createOnboardingModal">
                    <i class="fas fa-plus me-2"></i> Create Onboarding Card
                </button>
            </div>
        </div>

        <!-- Filters & Search -->
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" class="form-control" placeholder="Search onboarding cards...">
                </div>
            </div>
            <div class="col-md-3">
                <select class="form-select">
                    <option value="">All Departments</option>
                    <option value="it">IT Department</option>
                    <option value="hr">HR Department</option>
                    <option value="sales">Sales Department</option>
                    <option value="marketing">Marketing Department</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select">
                    <option value="">All Status</option>
                    <option value="approved">Approved</option>
                    <option value="pending">Pending Approval</option>
                    <option value="draft">Draft</option>
                    <option value="archived">Archived</option>
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-outline-secondary w-100">
                    <i class="fas fa-filter me-2"></i> Filter
                </button>
            </div>
        </div>

        <!-- Statistics -->
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="mini-stat-card">
                    <div class="stat-value">89</div>
                    <div class="stat-label">Total Cards</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="mini-stat-card">
                    <div class="stat-value text-success">72</div>
                    <div class="stat-label">Approved</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="mini-stat-card">
                    <div class="stat-value text-warning">12</div>
                    <div class="stat-label">Pending</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="mini-stat-card">
                    <div class="stat-value text-muted">5</div>
                    <div class="stat-label">Draft</div>
                </div>
            </div>
        </div>

        <!-- Knowledge Cards Grid -->
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="knowledge-card">
                    <div class="knowledge-card-header">
                        <div class="card-type-badge type-onboarding">
                            <i class="fas fa-graduation-cap"></i> Onboarding
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
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-trash me-2"></i>
                                        Delete</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="knowledge-card-body">
                        <h5 class="card-title-knowledge">New Employee Onboarding Process</h5>
                        <p class="card-description">Complete step-by-step guide for onboarding new employees including
                            documentation, system access, and training schedule.</p>
                        <div class="card-meta">
                            <span class="meta-item">
                                <i class="fas fa-building text-primary"></i> HR Department
                            </span>
                            <span class="meta-item">
                                <i class="fas fa-user text-success"></i> Sarah Ahmed
                            </span>
                            <span class="meta-item">
                                <i class="fas fa-clock text-muted"></i> 2 hours ago
                            </span>
                        </div>
                    </div>
                    <div class="knowledge-card-footer">
                        <span class="status-badge status-pending">Pending Approval</span>
                        <div class="card-actions">
                            <button class="btn btn-sm btn-success" onclick="approveCard(1)">
                                <i class="fas fa-check me-1"></i> Approve
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="rejectCard(1)">
                                <i class="fas fa-times me-1"></i> Reject
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="knowledge-card">
                    <div class="knowledge-card-header">
                        <div class="card-type-badge type-onboarding">
                            <i class="fas fa-graduation-cap"></i> Onboarding
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
                    <div class="knowledge-card-body">
                        <h5 class="card-title-knowledge">IT Systems Access Guide</h5>
                        <p class="card-description">Instructions for setting up email, VPN, project management tools, and
                            internal systems for new IT team members.</p>
                        <div class="card-meta">
                            <span class="meta-item">
                                <i class="fas fa-building text-primary"></i> IT Department
                            </span>
                            <span class="meta-item">
                                <i class="fas fa-user text-success"></i> Ahmad Khaled
                            </span>
                            <span class="meta-item">
                                <i class="fas fa-clock text-muted"></i> 1 day ago
                            </span>
                        </div>
                    </div>
                    <div class="knowledge-card-footer">
                        <span class="status-badge status-active">Approved</span>
                        <div class="card-actions">
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye me-1"></i> View
                            </button>
                            <button class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-edit me-1"></i> Edit
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="knowledge-card">
                    <div class="knowledge-card-header">
                        <div class="card-type-badge type-onboarding">
                            <i class="fas fa-graduation-cap"></i> Onboarding
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
                    <div class="knowledge-card-body">
                        <h5 class="card-title-knowledge">Sales Team Training Program</h5>
                        <p class="card-description">Comprehensive training program covering product knowledge, CRM usage,
                            and sales methodologies for new sales representatives.</p>
                        <div class="card-meta">
                            <span class="meta-item">
                                <i class="fas fa-building text-primary"></i> Sales Department
                            </span>
                            <span class="meta-item">
                                <i class="fas fa-user text-success"></i> Mohammed Ali
                            </span>
                            <span class="meta-item">
                                <i class="fas fa-clock text-muted"></i> 3 days ago
                            </span>
                        </div>
                    </div>
                    <div class="knowledge-card-footer">
                        <span class="status-badge status-active">Approved</span>
                        <div class="card-actions">
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye me-1"></i> View
                            </button>
                            <button class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-edit me-1"></i> Edit
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="knowledge-card">
                    <div class="knowledge-card-header">
                        <div class="card-type-badge type-onboarding">
                            <i class="fas fa-graduation-cap"></i> Onboarding
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
                    <div class="knowledge-card-body">
                        <h5 class="card-title-knowledge">Marketing Tools Overview</h5>
                        <p class="card-description">Introduction to marketing automation tools, social media platforms, and
                            analytics dashboards used by the marketing team.</p>
                        <div class="card-meta">
                            <span class="meta-item">
                                <i class="fas fa-building text-primary"></i> Marketing Department
                            </span>
                            <span class="meta-item">
                                <i class="fas fa-user text-success"></i> Layla Hassan
                            </span>
                            <span class="meta-item">
                                <i class="fas fa-clock text-muted"></i> 5 days ago
                            </span>
                        </div>
                    </div>
                    <div class="knowledge-card-footer">
                        <span class="status-badge status-active">Approved</span>
                        <div class="card-actions">
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye me-1"></i> View
                            </button>
                            <button class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-edit me-1"></i> Edit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            <nav>
                <ul class="pagination">
                    <li class="page-item disabled">
                        <a class="page-link" href="#">Previous</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
@endsection
