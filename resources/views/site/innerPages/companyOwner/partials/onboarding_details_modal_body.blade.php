@php
    $extra = (array) ($entry->extra ?? []);
    $timeline = data_get($extra, 'timeline');
    $takeaways = data_get($extra, 'key_takeaways');
@endphp

{{-- Header Section --}}
<div class="mb-4">
    <div class="d-flex justify-content-between align-items-start">
        <div class="flex-grow-1">
            <h2 class="mb-3 fw-bold text-dark">{{ $entry->title }}</h2>

            <div class="d-flex flex-wrap gap-2 mb-3">
                <span class="badge bg-primary bg-opacity-10 text-primary border border-primary px-3 py-2">
                    <i class="fas fa-tag me-1"></i> {{ ucfirst($entry->type) }}
                </span>
                <span class="badge bg-info bg-opacity-10 text-info border border-info px-3 py-2">
                    <i class="fas fa-building me-1"></i> {{ $entry->department?->name ?? '—' }}
                </span>
                <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary px-3 py-2">
                    <i class="fas fa-user me-1"></i> {{ $entry->author?->name ?? '—' }}
                </span>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <span class="badge bg-success bg-opacity-25 text-success px-3 py-2">
                    <i class="fas fa-check-circle me-1"></i> {{ ucfirst($entry->status) }}
                </span>
                <span class="badge bg-dark bg-opacity-10 text-dark border border-dark px-3 py-2">
                    <i class="fas fa-clock me-1"></i> {{ optional($entry->approved_at ?? $entry->created_at)->diffForHumans() }}
                </span>
                @if(!is_null($entry->views_count ?? null))
                    <span class="badge bg-warning bg-opacity-25 text-warning px-3 py-2">
                        <i class="fas fa-eye me-1"></i> {{ $entry->views_count }} Views
                    </span>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Summary Card --}}
<div class="card border-0 shadow-sm mb-4 overflow-hidden">
    <div class="card-header bg-gradient bg-primary text-white border-0">
        <h5 class="mb-0">
            <i class="fas fa-align-left me-2"></i> Summary
        </h5>
    </div>
    <div class="card-body bg-light">
        <p class="mb-0 text-dark fs-6">{{ $entry->summary }}</p>
    </div>
</div>

{{-- Full Content Card --}}
<div class="card border-0 shadow-sm mb-4 overflow-hidden">
    <div class="card-header bg-gradient bg-success text-white border-0">
        <h5 class="mb-0">
            <i class="fas fa-file-alt me-2"></i> Full Content
        </h5>
    </div>
    <div class="card-body">
        <div class="p-3 bg-light rounded">{!! nl2br(e($entry->content)) !!}</div>
    </div>
</div>

{{-- Onboarding Details Card --}}
<div class="card border-0 shadow-sm mb-4 overflow-hidden">
    <div class="card-header bg-gradient bg-info text-white border-0">
        <h5 class="mb-0">
            <i class="fas fa-info-circle me-2"></i> Onboarding Details
        </h5>
    </div>
    <div class="card-body p-4">
        <div class="row g-4">
            {{-- Timeline --}}
            <div class="col-md-6">
                <div class="card border-0 shadow-sm bg-white h-100">
                    <div class="card-body">
                        <h6 class="fw-bold text-primary mb-3 d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-2">
                                <i class="fas fa-calendar text-primary"></i>
                            </div>
                            Timeline
                        </h6>
                        <div class="text-muted ps-5">
                            @if($timeline)
                                <span class="badge bg-primary bg-opacity-25 text-primary px-3 py-2 fs-6">
                                    {{ str_replace('-', ' ', ucfirst($timeline)) }}
                                </span>
                            @else
                                <em class="text-black-50">No timeline specified</em>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Key Takeaways --}}
            <div class="col-md-6">
                <div class="card border-0 shadow-sm bg-white h-100">
                    <div class="card-body">
                        <h6 class="fw-bold text-warning mb-3 d-flex align-items-center">
                            <div class="bg-warning bg-opacity-10 rounded-circle p-2 me-2">
                                <i class="fas fa-lightbulb text-warning"></i>
                            </div>
                            Key Takeaways
                        </h6>
                        <div class="text-muted ps-5">
                            @if($takeaways)
                                {!! nl2br(e($takeaways)) !!}
                            @else
                                <em class="text-black-50">No takeaways provided</em>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Tags Card --}}
@if($entry->tags?->count())
    <div class="card border-0 shadow-sm mb-4 overflow-hidden">
        <div class="card-header bg-gradient bg-secondary text-white border-0">
            <h5 class="mb-0">
                <i class="fas fa-tags me-2"></i> Helpful Tags
            </h5>
        </div>
        <div class="card-body">
            <div class="d-flex flex-wrap gap-2">
                @foreach($entry->tags as $tag)
                    <span class="badge bg-secondary bg-opacity-75 text-white rounded-pill px-3 py-2 fs-6">
                        <i class="fas fa-tag me-1"></i> {{ $tag->name }}
                    </span>
                @endforeach
            </div>
        </div>
    </div>
@endif

{{-- Attachments Card --}}
@if(!empty($attachments) && count($attachments))
    <div class="card border-0 shadow-sm overflow-hidden">
        <div class="card-header bg-gradient bg-dark text-white border-0">
            <h5 class="mb-0">
                <i class="fas fa-paperclip me-2"></i> Attachments ({{ count($attachments) }})
            </h5>
        </div>
        <div class="card-body p-0">
            <ul class="list-group list-group-flush">
                @foreach($attachments as $att)
                    <li class="list-group-item py-3">
                        <a href="{{ $att['url'] }}" target="_blank" class="text-decoration-none d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center gap-3 flex-grow-1">
                                <div class="bg-dark bg-opacity-10 rounded-3 p-3">
                                    <i class="fas fa-file text-dark fs-4"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="fw-bold mb-1 text-dark">{{ $att['original_name'] ?? 'Attachment' }}</div>
                                    <span class="badge bg-light text-dark border rounded-pill">
                                        {{ strtoupper($att['type'] ?? 'file') }}
                                    </span>
                                </div>
                            </div>
                            <div class="btn btn-outline-dark btn-sm rounded-pill px-4">
                                <i class="fas fa-external-link-alt me-1"></i> Open
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
