@extends('site.innerPages.layout.master')


@section('content')
    <div class="content-header">
        <h1>Company Profile</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Knowledge Center</a></li>
                <li class="breadcrumb-item active">Critical & Strategic Knowledge</li>
            </ol>
        </nav>
    </div>

    <div class="content-body">
        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col-md-8">
                <h4 class="mb-2">
                    <i class="fas fa-star text-danger me-2"></i> Critical & Strategic Knowledge
                </h4>
                <p class="text-muted">High-level decisions, promotion stories, and leadership insights</p>
            </div>
            <div class="col-md-4 text-end">
                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#createCriticalModal">
                    <i class="fas fa-plus me-2"></i> Add Strategic Insight
                </button>
            </div>
        </div>

        <!-- Filters & Search -->
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" class="form-control" placeholder="Search strategic knowledge...">
                </div>
            </div>
            <div class="col-md-3">
                <select class="form-select">
                    <option value="">Content Type</option>
                    <option value="promotion">Promotion Stories</option>
                    <option value="decision">Big Decisions</option>
                    <option value="leadership">Leadership Insights</option>
                    <option value="strategy">Strategy</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select">
                    <option value="">All Status</option>
                    <option value="approved">Approved</option>
                    <option value="pending">Pending</option>
                    <option value="confidential">Confidential</option>
                </select>
            </div>
        </div>

        <!-- Critical Knowledge Cards -->
        <div class="row g-4">
            <!-- Promotion Story -->
            <div class="col-12">
                <div class="critical-card promotion-story">
                    <div class="critical-ribbon">
                        <i class="fas fa-trophy"></i> PROMOTION STORY
                    </div>
                    <div class="critical-header">
                        <div class="critical-icon">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <div class="critical-title-section">
                            <h4>Sarah Ahmed - Promoted to HR Director</h4>
                            <p class="text-muted mb-0">A journey of dedication and exceptional performance</p>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-light" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> View</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="critical-body">
                        <div class="row">
                            <div class="col-md-8">
                                <h6 class="section-heading">Journey & Achievements</h6>
                                <p>Sarah joined as HR Coordinator 3 years ago and consistently demonstrated exceptional
                                    leadership. Key achievements include:</p>
                                <ul class="achievement-list">
                                    <li>Reduced employee turnover by 35% through improved retention programs</li>
                                    <li>Implemented new performance review system adopted company-wide</li>
                                    <li>Led successful recruitment drive that brought in 50+ top talents</li>
                                    <li>Mentored 5 junior HR team members who received promotions</li>
                                </ul>
                                <h6 class="section-heading mt-3">Key Skills & Qualities</h6>
                                <div class="skills-tags">
                                    <span class="skill-tag">Leadership</span>
                                    <span class="skill-tag">Strategic Thinking</span>
                                    <span class="skill-tag">Team Building</span>
                                    <span class="skill-tag">Data-Driven</span>
                                    <span class="skill-tag">Communication</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="promotion-stats">
                                    <div class="stat-box">
                                        <div class="stat-label">Time in Company</div>
                                        <div class="stat-value">3 Years</div>
                                    </div>
                                    <div class="stat-box">
                                        <div class="stat-label">Previous Role</div>
                                        <div class="stat-value">HR Coordinator</div>
                                    </div>
                                    <div class="stat-box">
                                        <div class="stat-label">New Role</div>
                                        <div class="stat-value">HR Director</div>
                                    </div>
                                    <div class="stat-box">
                                        <div class="stat-label">Promotion Date</div>
                                        <div class="stat-value">Jan 2025</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Big Decision -->
            <div class="col-lg-6">
                <div class="critical-card decision-card">
                    <div class="critical-card-header">
                        <div class="card-type-badge type-critical">
                            <i class="fas fa-lightbulb"></i> Strategic Decision
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-light" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> View</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="critical-card-body">
                        <h5 class="card-title-critical">Q4 2024: Pivot to Cloud-First Strategy</h5>
                        <div class="decision-meta">
                            <span class="meta-badge"><i class="fas fa-calendar"></i> December 2024</span>
                            <span class="meta-badge"><i class="fas fa-user"></i> Ahmad Khaled</span>
                            <span class="meta-badge confidential-badge"><i class="fas fa-lock"></i> Confidential</span>
                        </div>
                        <div class="decision-section">
                            <h6><i class="fas fa-question-circle text-primary"></i> The Decision</h6>
                            <p>Migrate all infrastructure to cloud (AWS) instead of building on-premise data center.</p>
                        </div>

                        <div class="decision-section">
                            <h6><i class="fas fa-balance-scale text-warning"></i> Reasoning</h6>
                            <ul class="decision-list">
                                <li>Lower upfront capital expenditure ($2M saved)</li>
                                <li>Faster scalability for growing customer base</li>
                                <li>Reduced maintenance overhead</li>
                            </ul>
                        </div>

                        <div class="decision-section">
                            <h6><i class="fas fa-chart-line text-success"></i> Impact</h6>
                            <p>Successfully migrated in Q1 2025. 40% cost reduction, 99.9% uptime achieved.</p>
                        </div>
                    </div>
                    <div class="critical-card-footer">
                        <span class="status-badge status-active">Implemented</span>
                        <button class="btn btn-sm btn-outline-danger">
                            <i class="fas fa-eye me-1"></i> View Full Analysis
                        </button>
                    </div>
                </div>
            </div>

            <!-- Leadership Insight -->
            <div class="col-lg-6">
                <div class="critical-card leadership-card">
                    <div class="critical-card-header">
                        <div class="card-type-badge type-critical">
                            <i class="fas fa-user-tie"></i> Leadership Insight
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
                    <div class="critical-card-body">
                        <h5 class="card-title-critical">Building High-Performance Teams</h5>
                        <div class="decision-meta">
                            <span class="meta-badge"><i class="fas fa-calendar"></i> January 2025</span>
                            <span class="meta-badge"><i class="fas fa-user"></i> Leadership Team</span>
                        </div>

                        <div class="decision-section">
                            <h6><i class="fas fa-lightbulb text-warning"></i> Key Insight</h6>
                            <p>Focus on psychological safety and clear objectives drives team performance more than
                                individual talent.</p>
                        </div>

                        <div class="decision-section">
                            <h6><i class="fas fa-tasks text-info"></i> Action Items</h6>
                            <ul class="decision-list">
                                <li>Implement weekly team retrospectives</li>
                                <li>Encourage open feedback culture</li>
                                <li>Set clear, measurable team goals</li>
                                <li>Celebrate small wins regularly</li>
                            </ul>
                        </div>

                        <div class="decision-section">
                            <h6><i class="fas fa-quote-left text-primary"></i> Quote</h6>
                            <blockquote class="leadership-quote">
                                "Great teams are built on trust, not talent alone. Create an environment where people feel
                                safe to take risks."
                            </blockquote>
                        </div>
                    </div>
                    <div class="critical-card-footer">
                        <span class="status-badge status-active">Active</span>
                        <button class="btn btn-sm btn-outline-danger">
                            <i class="fas fa-eye me-1"></i> Read More
                        </button>
                    </div>
                </div>
            </div>

            <!-- Strategic Planning -->
            <div class="col-lg-6">
                <div class="critical-card strategy-card">
                    <div class="critical-card-header">
                        <div class="card-type-badge type-critical">
                            <i class="fas fa-chess"></i> Strategy
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
                    <div class="critical-card-body">
                        <h5 class="card-title-critical">2025 Growth Strategy</h5>
                        <div class="decision-meta">
                            <span class="meta-badge"><i class="fas fa-calendar"></i> January 2025</span>
                            <span class="meta-badge"><i class="fas fa-user"></i> Executive Team</span>
                            <span class="meta-badge confidential-badge"><i class="fas fa-lock"></i> Confidential</span>
                        </div>

                        <div class="decision-section">
                            <h6><i class="fas fa-bullseye text-danger"></i> Strategic Goals</h6>
                            <ul class="decision-list">
                                <li>Expand to 3 new markets in MENA region</li>
                                <li>Achieve 50% revenue growth YoY</li>
                                <li>Launch 2 new product lines</li>
                                <li>Double customer base to 10,000</li>
                            </ul>
                        </div>

                        <div class="decision-section">
                            <h6><i class="fas fa-sitemap text-primary"></i> Key Initiatives</h6>
                            <p>Product innovation, market expansion, talent acquisition, and operational excellence.</p>
                        </div>
                    </div>
                    <div class="critical-card-footer">
                        <span class="status-badge status-pending">In Progress</span>
                        <button class="btn btn-sm btn-outline-danger">
                            <i class="fas fa-eye me-1"></i> View Strategy
                        </button>
                    </div>
                </div>
            </div>

            <!-- Market Entry Decision -->
            <div class="col-lg-6">
                <div class="critical-card decision-card">
                    <div class="critical-card-header">
                        <div class="card-type-badge type-critical">
                            <i class="fas fa-globe"></i> Market Decision
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
                    <div class="critical-card-body">
                        <h5 class="card-title-critical">Entry into Saudi Market</h5>
                        <div class="decision-meta">
                            <span class="meta-badge"><i class="fas fa-calendar"></i> November 2024</span>
                            <span class="meta-badge"><i class="fas fa-user"></i> Ahmad Khaled</span>
                        </div>

                        <div class="decision-section">
                            <h6><i class="fas fa-flag text-success"></i> Decision</h6>
                            <p>Establish physical presence in Riyadh with local sales and support team.</p>
                        </div>

                        <div class="decision-section">
                            <h6><i class="fas fa-chart-bar text-info"></i> Market Analysis</h6>
                            <ul class="decision-list">
                                <li>Market size: $500M+ opportunity</li>
                                <li>3 major competitors identified</li>
                                <li>Strong demand for our solution</li>
                                <li>Local partnerships secured</li>
                            </ul>
                        </div>

                        <div class="decision-section">
                            <h6><i class="fas fa-trophy text-warning"></i> Results (6 months)</h6>
                            <p>$2M in revenue, 50+ customers acquired, team of 8 local employees.</p>
                        </div>
                    </div>
                    <div class="critical-card-footer">
                        <span class="status-badge status-active">Successful</span>
                        <button class="btn btn-sm btn-outline-danger">
                            <i class="fas fa-eye me-1"></i> View Case Study
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endsection
