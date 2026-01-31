@php
    use Illuminate\Support\Facades\Storage;

    $extra = (array) ($entry->extra ?? []);

    $mistake = data_get($extra, 'mistake');
    $impact  = data_get($extra, 'impact_level'); // low, medium, high
    $solution= data_get($extra, 'solution');
    $lessons = data_get($extra, 'lessons');

    $impactLabel = $impact ? strtoupper($impact) : null;

    $attList = [];
    if (isset($attachments) && is_array($attachments)) {
        $attList = $attachments;
    } elseif ($entry->relationLoaded('attachments') && $entry->attachments) {
        $attList = $entry->attachments->map(function ($att) {
            $url = $att->path ? Storage::disk('public')->url($att->path) : null;
            return [
                'type' => $att->type ?? 'file',
                'original_name' => $att->original_name ?? ($att->path ?? 'Attachment'),
                'url' => $url,
                'size' => $att->size ?? null,
                'mime' => $att->mime ?? null,
            ];
        })->toArray();
    }

    $viewsCount = $entry->views_count ?? null;

    $approvedAt = $entry->approved_at ?? null;
    $approvedBy = $entry->approved_by ?? null;
    $approvalComment = $entry->approval_comment ?? null;

    $submittedAt = $entry->submitted_at ?? null;
@endphp

{{-- Header Section --}}
<div class="mb-4">
    <div class="d-flex justify-content-between align-items-start">
        <div class="flex-grow-1">
            <h3 class="mb-3 fw-bold text-dark">{{ $entry->title }}</h3>

            <div class="d-flex flex-wrap gap-3 mb-2">
                <span class="badge bg-primary bg-opacity-10 text-primary border border-primary px-3 py-2">
                    <i class="fas fa-tag me-1"></i> {{ ucfirst($entry->type) }}
                </span>
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

                @if(!is_null($viewsCount))
                    <span class="badge bg-warning bg-opacity-25 text-warning px-3 py-2">
                        <i class="fas fa-eye me-1"></i> {{ $viewsCount }} Views
                    </span>
                @endif
            </div>
        </div>

        @if($impactLabel)
            @php
                $impactClass = match($impact) {
                    'high' => 'bg-danger text-white',
                    'medium' => 'bg-warning text-dark',
                    'low' => 'bg-info text-white',
                    default => 'bg-light text-dark',
                };
            @endphp
            <span class="badge {{ $impactClass }} fs-6 px-4 py-3 shadow-sm">
                <i class="fas fa-exclamation-triangle me-2"></i> {{ $impactLabel }} IMPACT
            </span>
        @endif
    </div>
</div>

{{-- Summary Card --}}
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-warning bg-opacity-10 border-0 border-start border-warning border-4">
        <h5 class="mb-0 text-warning">
            <i class="fas fa-align-left me-2"></i> Summary
        </h5>
    </div>
    <div class="card-body">
        <p class="mb-0 text-dark">{{ $entry->summary ?: '—' }}</p>
    </div>
</div>

{{-- Full Content Card --}}
@if(!empty($entry->content))
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-primary bg-opacity-10 border-0 border-start border-primary border-4">
            <h5 class="mb-0 text-primary">
                <i class="fas fa-file-alt me-2"></i> Full Content
            </h5>
        </div>
        <div class="card-body bg-light">
            <div class="p-3">{!! nl2br(e($entry->content)) !!}</div>
        </div>
    </div>
@endif

{{-- Mistake Details Card --}}
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-danger bg-opacity-10 border-0 border-start border-danger border-4">
        <h5 class="mb-0 text-danger">
            <i class="fas fa-bug me-2"></i> Mistake Details
        </h5>
    </div>
    <div class="card-body">
        <div class="row g-3">
            {{-- What Happened --}}
            <div class="col-12">
                <div class="card border border-danger border-opacity-25 h-100">
                    <div class="card-body">
                        <h6 class="fw-bold text-danger mb-3">
                            <i class="fas fa-exclamation-circle me-2"></i> What Happened
                        </h6>
                        <div class="text-muted">
                            @if(!empty($mistake))
                                {!! nl2br(e($mistake)) !!}
                            @else
                                <em class="text-black-50">No details provided</em>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Solution --}}
            <div class="col-md-6">
                <div class="card border border-success border-opacity-25 h-100">
                    <div class="card-body">
                        <h6 class="fw-bold text-success mb-3">
                            <i class="fas fa-wrench me-2"></i> Solution
                        </h6>
                        <div class="text-muted">
                            @if(!empty($solution))
                                {!! nl2br(e($solution)) !!}
                            @else
                                <em class="text-black-50">No solution provided</em>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Lessons Learned --}}
            <div class="col-md-6">
                <div class="card border border-warning border-opacity-25 h-100">
                    <div class="card-body">
                        <h6 class="fw-bold text-warning mb-3">
                            <i class="fas fa-lightbulb me-2"></i> Lessons Learned
                        </h6>
                        <div class="text-muted">
                            @if(!empty($lessons))
                                {!! nl2br(e($lessons)) !!}
                            @else
                                <em class="text-black-50">No lessons provided</em>
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
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-secondary bg-opacity-10 border-0 border-start border-secondary border-4">
            <h5 class="mb-0 text-secondary">
                <i class="fas fa-tags me-2"></i> Helpful Tags
            </h5>
        </div>
        <div class="card-body">
            <div class="d-flex flex-wrap gap-2">
                @foreach($entry->tags as $tag)
                    <span class="badge bg-light text-dark border border-secondary px-3 py-2 fs-6">
                        <i class="fas fa-tag me-1"></i> {{ $tag->name }}
                    </span>
                @endforeach
            </div>
        </div>
    </div>
@endif

{{-- Attachments Card --}}
@if(!empty($attList) && count($attList))
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-info bg-opacity-10 border-0 border-start border-info border-4">
            <h5 class="mb-0 text-info">
                <i class="fas fa-paperclip me-2"></i> Attachments ({{ count($attList) }})
            </h5>
        </div>
        <div class="card-body p-0">
            <ul class="list-group list-group-flush">
                @foreach($attList as $att)
                    <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-info bg-opacity-10 rounded p-3">
                                <i class="fas fa-file text-info fs-4"></i>
                            </div>
                            <div>
                                <div class="fw-bold mb-1">{{ $att['original_name'] ?? 'Attachment' }}</div>
                                <div class="d-flex flex-wrap gap-2">
                                    <span class="badge bg-light text-dark border">
                                        {{ strtoupper($att['type'] ?? 'file') }}
                                    </span>
                                    @if(!empty($att['mime']))
                                        <span class="badge bg-light text-muted border">{{ $att['mime'] }}</span>
                                    @endif
                                    @if(!empty($att['size']))
                                        <span class="badge bg-light text-muted border">
                                            <i class="fas fa-hdd me-1"></i> {{ number_format($att['size'] / 1024, 1) }} KB
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        @if(!empty($att['url']))
                            <a class="btn btn-outline-info btn-sm px-3" href="{{ $att['url'] }}" target="_blank">
                                <i class="fas fa-external-link-alt me-1"></i> Open
                            </a>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

{{-- Audit / Review Info Card --}}
<div class="card border-0 shadow-sm">
    <div class="card-header bg-primary bg-opacity-10 border-0 border-start border-primary border-4">
        <h5 class="mb-0 text-primary">
            <i class="fas fa-info-circle me-2"></i> Audit / Review Info
        </h5>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <div class="border-start border-primary border-3 ps-3">
                    <div class="mb-2">
                        <strong class="text-dark d-block mb-1">
                            <i class="fas fa-calendar-plus text-primary me-2"></i> Created at
                        </strong>
                        <span class="text-muted">{{ $entry->created_at ?? '—' }}</span>
                    </div>
                    <div class="mb-2">
                        <strong class="text-dark d-block mb-1">
                            <i class="fas fa-calendar-check text-success me-2"></i> Updated at
                        </strong>
                        <span class="text-muted">{{ $entry->updated_at ?? '—' }}</span>
                    </div>
                    <div>
                        <strong class="text-dark d-block mb-1">
                            <i class="fas fa-paper-plane text-info me-2"></i> Submitted at
                        </strong>
                        <span class="text-muted">{{ $submittedAt ?: '—' }}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="border-start border-success border-3 ps-3">
                    <div class="mb-2">
                        <strong class="text-dark d-block mb-1">
                            <i class="fas fa-check-circle text-success me-2"></i> Approved at
                        </strong>
                        <span class="text-muted">{{ $approvedAt ?: '—' }}</span>
                    </div>
                    <div class="mb-2">
                        <strong class="text-dark d-block mb-1">
                            <i class="fas fa-user-check text-warning me-2"></i> Approved by
                        </strong>
                        <span class="text-muted">{{ $approvedBy ?: '—' }}</span>
                    </div>

                    @if(!empty($approvalComment))
                        <div class="mt-3 p-3 bg-light rounded">
                            <strong class="text-dark d-block mb-2">
                                <i class="fas fa-comment-dots text-primary me-2"></i> Approval Comment
                            </strong>
                            <span class="text-muted fst-italic">{{ $approvalComment }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
