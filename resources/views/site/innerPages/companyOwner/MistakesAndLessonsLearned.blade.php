@extends('site.innerPages.layout.master')


@section('content')
    <div class="content-header">
        <h1>Company Profile</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Knowledge Center</a></li>
                <li class="breadcrumb-item active"> Mistakes & Lessons Learned </li>
            </ol>
        </nav>

        <div class="content-body">
            <!-- Page Header -->
            <div class="row mb-4">
                <div class="col-md-8">
                    <h4 class="mb-2">
                        <i class="fas fa-exclamation-triangle text-warning me-2"></i> Mistakes & Lessons Learned
                    </h4>
                    <p class="text-muted">Learn from past mistakes to prevent future issues</p>
                </div>
                <div class="col-md-4 text-end">
                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#createMistakeModal">
                        <i class="fas fa-plus me-2"></i> Document a Mistake
                    </button>
                </div>
            </div>

            <!-- Filters & Search -->
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" class="form-control" placeholder="Search mistakes and lessons...">
                    </div>
                </div>
                <div class="col-md-3">
                    <select class="form-select">
                        <option value="">All Departments</option>
                        <option value="it">IT Department</option>
                        <option value="sales">Sales Department</option>
                        <option value="marketing">Marketing Department</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select">
                        <option value="">Impact Level</option>
                        <option value="high">High Impact</option>
                        <option value="medium">Medium Impact</option>
                        <option value="low">Low Impact</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-select">
                        <option value="">All Status</option>
                        <option value="approved">Approved</option>
                        <option value="pending">Pending</option>
                    </select>
                </div>
            </div>

            <!-- High Impact Mistakes Alert -->
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <h5 class="alert-heading">
                    <i class="fas fa-exclamation-circle me-2"></i> High Impact Mistakes
                </h5>
                <p class="mb-0">There are <strong>3 high-impact mistakes</strong> documented this month. Review them
                    carefully to prevent recurrence.</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <!-- Mistakes Cards -->
            <div class="row g-4">
                <!-- High Impact Mistake -->
                <div class="col-12">
                    <div class="knowledge-card high-impact-card">
                        <div class="impact-indicator">
                            <i class="fas fa-exclamation-triangle"></i> HIGH IMPACT
                        </div>
                        <div class="knowledge-card-header">
                            <div class="card-type-badge type-mistakes">
                                <i class="fas fa-exclamation-triangle"></i> Mistake
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> View</a>
                                    </li>
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a>
                                    </li>
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-archive me-2"></i>
                                            Archive</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="knowledge-card-body">
                            <h5 class="card-title-knowledge">Customer Data Migration Error</h5>
                            <p class="card-description"><strong>What Happened:</strong> During database migration, customer
                                contact information was not properly validated, resulting in 500+ customers receiving
                                incorrect emails.</p>
                            <p class="card-description"><strong>Lesson Learned:</strong> Always implement dry-run testing
                                with validation checks before production migrations. Set up automated testing for data
                                integrity.</p>
                            <p class="card-description"><strong>Prevention:</strong> Created pre-migration checklist and
                                automated validation scripts now mandatory for all database operations.</p>
                            <div class="card-meta">
                                <span class="meta-item">
                                    <i class="fas fa-building text-primary"></i> IT Department
                                </span>
                                <span class="meta-item">
                                    <i class="fas fa-user text-success"></i> Ahmad Khaled
                                </span>
                                <span class="meta-item">
                                    <i class="fas fa-clock text-muted"></i> 5 hours ago
                                </span>
                                <span class="meta-item">
                                    <span class="badge bg-danger">High Impact</span>
                                </span>
                            </div>
                        </div>
                        <div class="knowledge-card-footer">
                            <span class="status-badge status-active">Approved</span>
                            <div class="card-actions">
                                <button class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye me-1"></i> View Full Details
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Medium Impact Mistakes -->
                <div class="col-lg-6">
                    <div class="knowledge-card">
                        <div class="knowledge-card-header">
                            <div class="card-type-badge type-mistakes">
                                <i class="fas fa-exclamation-triangle"></i> Mistake
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> View</a>
                                    </li>
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a>
                                    </li>
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-archive me-2"></i>
                                            Archive</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="knowledge-card-body">
                            <h5 class="card-title-knowledge">Incorrect Pricing in Sales Proposal</h5>
                            <p class="card-description"><strong>What Happened:</strong> Sales proposal sent with outdated
                                pricing from old template, resulting in 15% revenue loss on deal.</p>
                            <p class="card-description"><strong>Lesson:</strong> Always use latest pricing template from
                                shared drive and verify with finance before sending.</p>
                            <div class="card-meta">
                                <span class="meta-item">
                                    <i class="fas fa-building text-primary"></i> Sales Department
                                </span>
                                <span class="meta-item">
                                    <i class="fas fa-user text-success"></i> Mohammed Ali
                                </span>
                                <span class="meta-item">
                                    <span class="badge bg-warning">Medium Impact</span>
                                </span>
                            </div>
                        </div>
                        <div class="knowledge-card-footer">
                            <span class="status-badge status-active">Approved</span>
                            <div class="card-actions">
                                <button class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye me-1"></i> View
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="knowledge-card">
                        <div class="knowledge-card-header">
                            <div class="card-type-badge type-mistakes">
                                <i class="fas fa-exclamation-triangle"></i> Mistake
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> View</a>
                                    </li>
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="knowledge-card-body">
                            <h5 class="card-title-knowledge">Social Media Post Typo</h5>
                            <p class="card-description"><strong>What Happened:</strong> Product launch post contained
                                company name typo, was live for 2 hours before correction.</p>
                            <p class="card-description"><strong>Lesson:</strong> Implement mandatory peer review for all
                                public-facing content before publishing.</p>
                            <div class="card-meta">
                                <span class="meta-item">
                                    <i class="fas fa-building text-primary"></i> Marketing
                                </span>
                                <span class="meta-item">
                                    <i class="fas fa-user text-success"></i> Layla Hassan
                                </span>
                                <span class="meta-item">
                                    <span class="badge bg-info">Low Impact</span>
                                </span>
                            </div>
                        </div>
                        <div class="knowledge-card-footer">
                            <span class="status-badge status-pending">Pending Approval</span>
                            <div class="card-actions">
                                <button class="btn btn-sm btn-success">
                                    <i class="fas fa-check me-1"></i> Approve
                                </button>
                                <button class="btn btn-sm btn-danger">
                                    <i class="fas fa-times me-1"></i> Reject
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
