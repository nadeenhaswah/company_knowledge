@extends('site.innerPages.layout.master')


@section('content')
    <div class="content-header">
        <h1>Knowledge Center</h1>
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
            {{-- <div class="col-md-4 text-end">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createOperationalModal">
                    <i class="fas fa-plus me-2"></i> Create Operational Card
                </button>
            </div> --}}
        </div>

        <!-- Filters & Search -->
        <div class="row g-3 mb-4">
            <form method="GET" action="{{ url()->current() }}">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" name="q" value="{{ $q ?? request('q') }}" class="form-control"
                        placeholder="Search...">
                </div>
            </form>

        </div>
        {{-- <div class="col-md-3">
            <select class="form-select">
                <option value="">All Departments</option>
                <option value="it">IT Department</option>
                <option value="sales">Sales Department</option>
                <option value="operations">Operations</option>
            </select>
        </div> --}}
        {{-- <div class="col-md-2">
            <select class="form-select">
                <option value="">Task Type</option>
                <option value="daily">Daily</option>
                <option value="weekly">Weekly</option>
                <option value="monthly">Monthly</option>
            </select>
        </div> --}}
        {{-- <div class="col-md-2">
            <button class="btn btn-outline-primary w-100">
                <i class="fas fa-download me-1"></i> Export
            </button>
        </div> --}}
    </div>

    <!-- Operational Cards -->
    <div class="row g-4">
        @forelse($entries as $entry)
            <div class="col-lg-6">
                <div class="knowledge-card">
                    <div class="knowledge-card-body">
                        <h5 class="card-title-knowledge">{{ $entry->title }}</h5>
                        <p class="card-description">{{ \Illuminate\Support\Str::limit($entry->summary, 170) }}</p>

                        <div class="card-meta">
                            <span class="meta-item">
                                <i class="fas fa-building text-primary"></i> {{ $entry->department?->name }}
                            </span>
                            <span class="meta-item">
                                <i class="fas fa-user text-success"></i> {{ $entry->author?->name }}
                            </span>
                            <span class="meta-item">
                                <i class="fas fa-clock text-muted"></i>
                                {{ optional($entry->approved_at)->diffForHumans() }}
                            </span>
                        </div>
                    </div>

                    <div class="knowledge-card-footer">
                        <span class="status-badge status-active">Approved</span>
                        <div class="card-actions">
                            <button type="button" class="btn btn-sm btn-outline-primary"
                                onclick="openOperationalDetails({{ $entry->id }})">
                                <i class="fas fa-eye me-1"></i> View
                            </button>

                        </div>
                    </div>

                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="p-4 text-center text-muted">No cards found.</div>
            </div>
        @endforelse
    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $entries->links() }}
    </div>


    </div>

    <!-- Operational Details Modal -->
<div class="modal fade" id="operationalDetailsModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-eye me-2"></i> Operational Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body" id="operationalDetailsBody">
                <div class="text-center text-muted py-4">Loading...</div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
<script>
    async function openOperationalDetails(id) {
        const modalEl = document.getElementById('operationalDetailsModal');
        const bodyEl  = document.getElementById('operationalDetailsBody');

        bodyEl.innerHTML = `<div class="text-center text-muted py-4">Loading...</div>`;
        const modal = new bootstrap.Modal(modalEl);
        modal.show();

        // ✅ route() + replace لضمان URL صحيح
        const url = `{{ route('shared.operationalDetails', ['entry' => '__ID__']) }}`.replace('__ID__', id);

        try {
            const res = await fetch(url, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });

            if (!res.ok) throw new Error(`HTTP ${res.status}`);

            const data = await res.json();
            if (!data.ok) throw new Error(data.message || 'Failed');

            bodyEl.innerHTML = data.html;

        } catch (e) {
            bodyEl.innerHTML = `
                <div class="alert alert-danger mb-0">
                    Failed to load details. (${e.message})
                </div>
            `;
        }
    }
</script>
@endsection
