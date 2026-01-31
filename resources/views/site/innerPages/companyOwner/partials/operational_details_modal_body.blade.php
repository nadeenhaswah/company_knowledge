@php
    $extra = (array) ($entry->extra ?? []);

    // operational extra fields from your store() rules
    $taskName     = data_get($extra, 'task_name');
    $frequency    = data_get($extra, 'frequency');     // daily, weekly, monthly, as-needed
    $tools        = data_get($extra, 'tools');
    $links        = data_get($extra, 'links');         // string (could be multiline)
    $steps        = data_get($extra, 'steps');         // string (multiline)
    $commonIssues = data_get($extra, 'common_issues'); // string (multiline)

    $toLines = function ($text) {
        $text = trim((string) $text);
        if ($text === '') return [];
        $lines = preg_split("/\r\n|\n|\r/", $text);
        return array_values(array_filter(array_map('trim', $lines), fn($v) => $v !== ''));
    };

    $stepsArr  = $toLines($steps);
    $issuesArr = $toLines($commonIssues);

    // links: split lines, auto add scheme if missing
    $linksArr = array_map(function ($l) {
        $u = trim($l);
        if ($u === '') return null;
        if (!preg_match('/^https?:\/\//i', $u)) $u = 'https://' . $u;
        return $u;
    }, $toLines($links));
    $linksArr = array_values(array_filter($linksArr));
@endphp

{{-- Header Section --}}
<div class="mb-4">
    <h3 class="mb-3 fw-bold text-dark">{{ $entry->title }}</h3>

    <div class="d-flex flex-wrap gap-2 mb-3">
        <span class="badge bg-info bg-opacity-10 text-info border border-info px-3 py-2">
            <i class="fas fa-building me-1"></i> {{ $entry->department?->name ?? '—' }}
        </span>
        <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary px-3 py-2">
            <i class="fas fa-user me-1"></i> {{ $entry->author?->name ?? '—' }}
        </span>
        <span class="badge bg-dark bg-opacity-10 text-dark border border-dark px-3 py-2">
            <i class="fas fa-clock me-1"></i> {{ optional($entry->approved_at ?? $entry->created_at)->diffForHumans() }}
        </span>
    </div>

    <div class="d-flex flex-wrap gap-2">
        <span class="badge bg-success bg-opacity-25 text-success px-3 py-2">
            <i class="fas fa-check-circle me-1"></i> {{ ucfirst($entry->status) }}
        </span>

        @if(!empty($taskName))
            <span class="badge bg-primary bg-opacity-25 text-primary px-3 py-2">
                <i class="fas fa-tasks me-1"></i> {{ $taskName }}
            </span>
        @endif

        @if(!empty($frequency))
            <span class="badge bg-warning bg-opacity-25 text-warning px-3 py-2">
                <i class="fas fa-sync-alt me-1"></i> {{ ucfirst($frequency) }}
            </span>
        @endif
    </div>
</div>

{{-- Summary Card --}}
<div class="card border-0 shadow-sm mb-3 overflow-hidden">
    <div class="card-header bg-success bg-opacity-10 border-0 border-start border-success border-3 py-2">
        <h6 class="mb-0 text-success fw-bold">
            <i class="fas fa-align-left me-2"></i> Summary
        </h6>
    </div>
    <div class="card-body py-3">
        <p class="mb-0 text-dark">{{ $entry->summary ?: '—' }}</p>
    </div>
</div>

{{-- Full Content Card --}}
@if(!empty($entry->content))
    <div class="card border-0 shadow-sm mb-3 overflow-hidden">
        <div class="card-header bg-primary bg-opacity-10 border-0 border-start border-primary border-3 py-2">
            <h6 class="mb-0 text-primary fw-bold">
                <i class="fas fa-file-alt me-2"></i> Full Content
            </h6>
        </div>
        <div class="card-body py-3">
            <div class="p-3 bg-light rounded">{!! nl2br(e($entry->content)) !!}</div>
        </div>
    </div>
@endif

{{-- Operational Details Card --}}
<div class="card border-0 shadow-sm mb-3 overflow-hidden">
    <div class="card-header bg-success bg-opacity-10 border-0 border-start border-success border-3 py-2">
        <h6 class="mb-0 text-success fw-bold">
            <i class="fas fa-cogs me-2"></i> Operational Details
        </h6>
    </div>
    <div class="card-body p-3">
        <div class="row g-3">
            {{-- Tools --}}
            <div class="col-md-6">
                <div class="card border-0 bg-light h-100">
                    <div class="card-body py-3">
                        <h6 class="fw-bold text-primary mb-2">
                            <i class="fas fa-tools me-2"></i> Tools
                        </h6>
                        <div class="text-muted small">
                            @if(!empty($tools))
                                {!! nl2br(e($tools)) !!}
                            @else
                                <em class="text-black-50">No tools specified</em>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Helpful Links --}}
            <div class="col-md-6">
                <div class="card border-0 bg-light h-100">
                    <div class="card-body py-3">
                        <h6 class="fw-bold text-info mb-2">
                            <i class="fas fa-link me-2"></i> Helpful Links
                        </h6>

                        @if(count($linksArr))
                            <ul class="mb-0 ps-3 small">
                                @foreach($linksArr as $u)
                                    <li class="mb-2">
                                        <a href="{{ $u }}" target="_blank" rel="noopener" class="text-decoration-none">
                                            <i class="fas fa-external-link-alt me-1"></i>
                                            {{ Str::limit($u, 40) }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @elseif(!empty($links))
                            <div class="text-muted small">{!! nl2br(e($links)) !!}</div>
                        @else
                            <em class="text-black-50 small">No links provided</em>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Steps --}}
            <div class="col-12">
                <div class="card border-0 bg-light">
                    <div class="card-body py-3">
                        <h6 class="fw-bold text-success mb-3">
                            <i class="fas fa-list-ol me-2"></i> Steps
                        </h6>

                        @if(count($stepsArr))
                            <ol class="mb-0 ps-4 small">
                                @foreach($stepsArr as $s)
                                    <li class="mb-2 text-dark">{{ $s }}</li>
                                @endforeach
                            </ol>
                        @elseif(!empty($steps))
                            <div class="text-muted small">{!! nl2br(e($steps)) !!}</div>
                        @else
                            <em class="text-black-50 small">No steps provided</em>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Common Issues --}}
            <div class="col-12">
                <div class="card border-0 bg-light">
                    <div class="card-body py-3">
                        <h6 class="fw-bold text-warning mb-3">
                            <i class="fas fa-exclamation-triangle me-2"></i> Common Issues
                        </h6>

                        @if(count($issuesArr))
                            <ul class="mb-0 ps-4 small">
                                @foreach($issuesArr as $i)
                                    <li class="mb-2 text-dark">{{ $i }}</li>
                                @endforeach
                            </ul>
                        @elseif(!empty($commonIssues))
                            <div class="text-muted small">{!! nl2br(e($commonIssues)) !!}</div>
                        @else
                            <em class="text-black-50 small">No common issues listed</em>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Tags Card --}}
@if($entry->tags?->count())
    <div class="card border-0 shadow-sm mb-3 overflow-hidden">
        <div class="card-header bg-secondary bg-opacity-10 border-0 border-start border-secondary border-3 py-2">
            <h6 class="mb-0 text-secondary fw-bold">
                <i class="fas fa-tags me-2"></i> Helpful Tags
            </h6>
        </div>
        <div class="card-body py-3">
            <div class="d-flex flex-wrap gap-2">
                @foreach($entry->tags as $tag)
                    <span class="badge bg-secondary bg-opacity-75 text-white rounded-pill px-3 py-2">
                        <i class="fas fa-tag me-1"></i> {{ $tag->name }}
                    </span>
                @endforeach
            </div>
        </div>
    </div>
@endif

{{-- Attachments Card --}}
@if(!empty($attachments) && count($attachments))
    <div class="card border-0 shadow-sm mb-3 overflow-hidden">
        <div class="card-header bg-info bg-opacity-10 border-0 border-start border-info border-3 py-2">
            <h6 class="mb-0 text-info fw-bold">
                <i class="fas fa-paperclip me-2"></i> Attachments ({{ count($attachments) }})
            </h6>
        </div>
        <div class="card-body p-0">
            <ul class="list-group list-group-flush">
                @foreach($attachments as $att)
                    <li class="list-group-item py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center gap-3 flex-grow-1">
                                <div class="bg-info bg-opacity-10 rounded p-2">
                                    <i class="fas fa-file text-info fs-5"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="fw-semibold text-dark small mb-1">{{ $att['original_name'] ?? 'Attachment' }}</div>
                                    <div class="d-flex flex-wrap gap-2">
                                        <span class="badge bg-light text-dark border rounded-pill">
                                            {{ strtoupper($att['type'] ?? 'file') }}
                                        </span>
                                        @if(!empty($att['mime']))
                                            <span class="badge bg-light text-muted border rounded-pill">{{ $att['mime'] }}</span>
                                        @endif
                                        @if(!empty($att['size']))
                                            <span class="badge bg-light text-muted border rounded-pill">
                                                <i class="fas fa-hdd me-1"></i> {{ number_format($att['size'] / 1024, 1) }} KB
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            @if(!empty($att['url']))
                                <a class="btn btn-outline-info btn-sm rounded-pill px-3" href="{{ $att['url'] }}" target="_blank">
                                    <i class="fas fa-external-link-alt me-1"></i> Open
                                </a>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

{{-- Audit Info Card --}}
<div class="card border-0 shadow-sm overflow-hidden">
    <div class="card-header bg-dark bg-opacity-10 border-0 border-start border-dark border-3 py-2">
        <h6 class="mb-0 text-dark fw-bold">
            <i class="fas fa-info-circle me-2"></i> Audit Info
        </h6>
    </div>
    <div class="card-body py-3">
        <div class="row g-3">
            <div class="col-md-6">
                <div class="small">
                    <div class="mb-2">
                        <i class="fas fa-calendar-plus text-primary me-2"></i>
                        <strong>Created:</strong>
                        <span class="text-muted">{{ $entry->created_at ?? '—' }}</span>
                    </div>
                    <div>
                        <i class="fas fa-calendar-check text-success me-2"></i>
                        <strong>Updated:</strong>
                        <span class="text-muted">{{ $entry->updated_at ?? '—' }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="small">
                    <div class="mb-2">
                        <i class="fas fa-paper-plane text-info me-2"></i>
                        <strong>Submitted:</strong>
                        <span class="text-muted">{{ $entry->submitted_at ?? '—' }}</span>
                    </div>
                    <div>
                        <i class="fas fa-check-circle text-success me-2"></i>
                        <strong>Approved:</strong>
                        <span class="text-muted">{{ $entry->approved_at ?? '—' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
