@php
    use Illuminate\Support\Facades\Storage;

    $extra = (array) ($entry->extra ?? []);

    // critical extra fields from your store() rules:
    $story          = data_get($extra, 'story');
    $category       = data_get($extra, 'category');          // promotion, project, decision, challenge, other
    $successFactors = data_get($extra, 'success_factors');   // required
    $advice         = data_get($extra, 'advice');            // required
    $skills         = data_get($extra, 'skills');            // nullable (string)

    // helper: split multiline text to list
    $toLines = function ($text) {
        $text = trim((string) $text);
        if ($text === '') return [];
        $lines = preg_split("/\r\n|\n|\r/", $text);
        return array_values(array_filter(array_map('trim', $lines), fn($v) => $v !== ''));
    };

    $skillsArr = $toLines($skills);

    // attachments source:
    // if controller passed $attachments array => use it
    // else fallback to $entry->attachments
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

    // Optional fields if exist in DB:
    $viewsCount = $entry->views_count ?? null;

    // Review fields (if you have them in table):
    $approvedAt = $entry->approved_at ?? null;
    $approvedBy = $entry->approved_by ?? null;
    $approvalComment = $entry->approval_comment ?? null;

    $rejectedAt = $entry->rejected_at ?? null;
    $rejectedBy = $entry->rejected_by ?? null;
    $rejectionReason = $entry->rejection_reason ?? null;
    $rejectionComment = $entry->rejection_comment ?? null;

    $submittedAt = $entry->submitted_at ?? null;
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

                @if(!empty($entry->visibility))
                    <span class="badge bg-danger bg-opacity-25 text-danger px-3 py-2">
                        <i class="fas fa-lock me-1"></i> {{ ucfirst($entry->visibility) }}
                    </span>
                @endif
            </div>
        </div>

        @if(!empty($category))
            <span class="badge bg-gradient bg-danger text-white fs-6 px-4 py-3 shadow-sm rounded-pill">
                <i class="fas fa-star me-2"></i> {{ ucfirst($category) }}
            </span>
        @endif
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
        <p class="mb-0 text-dark fs-6">{{ $entry->summary ?: '—' }}</p>
    </div>
</div>

{{-- Full Content Card --}}
@if(!empty($entry->content))
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
@endif

{{-- Critical Details Card --}}
<div class="card border-0 shadow-sm mb-4 overflow-hidden">
    <div class="card-header bg-gradient bg-danger text-white border-0">
        <h5 class="mb-0">
            <i class="fas fa-shield-alt me-2"></i> Critical Details
        </h5>
    </div>
    <div class="card-body p-4">
        <div class="row g-4">
            {{-- Story --}}
            <div class="col-12">
                <div class="card border-0 shadow-sm bg-white">
                    <div class="card-body">
                        <h6 class="fw-bold text-primary mb-3 d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-2">
                                <i class="fas fa-book-open text-primary"></i>
                            </div>
                            Story
                        </h6>
                        <div class="text-muted ps-5">
                            @if(!empty($story))
                                {!! nl2br(e($story)) !!}
                            @else
                                <em class="text-black-50">No story provided</em>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Success Factors --}}
            <div class="col-md-6">
                <div class="card border-0 shadow-sm bg-white h-100">
                    <div class="card-body">
                        <h6 class="fw-bold text-success mb-3 d-flex align-items-center">
                            <div class="bg-success bg-opacity-10 rounded-circle p-2 me-2">
                                <i class="fas fa-trophy text-success"></i>
                            </div>
                            Success Factors
                        </h6>
                        <div class="text-muted ps-5">
                            @if(!empty($successFactors))
                                {!! nl2br(e($successFactors)) !!}
                            @else
                                <em class="text-black-50">No factors provided</em>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Advice --}}
            <div class="col-md-6">
                <div class="card border-0 shadow-sm bg-white h-100">
                    <div class="card-body">
                        <h6 class="fw-bold text-warning mb-3 d-flex align-items-center">
                            <div class="bg-warning bg-opacity-10 rounded-circle p-2 me-2">
                                <i class="fas fa-comment-dots text-warning"></i>
                            </div>
                            Advice
                        </h6>
                        <div class="text-muted ps-5">
                            @if(!empty($advice))
                                {!! nl2br(e($advice)) !!}
                            @else
                                <em class="text-black-50">No advice provided</em>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Skills / Tags --}}
            <div class="col-12">
                <div class="card border-0 shadow-sm bg-white">
                    <div class="card-body">
                        <h6 class="fw-bold text-info mb-3 d-flex align-items-center">
                            <div class="bg-info bg-opacity-10 rounded-circle p-2 me-2">
                                <i class="fas fa-brain text-info"></i>
                            </div>
                            Skills / Helpful Tags
                        </h6>

                        <div class="ps-5">
                            {{-- skills from extra --}}
                            @if(count($skillsArr))
                                <div class="mb-2">
                                    @foreach($skillsArr as $s)
                                        <span class="badge bg-light text-dark border border-secondary rounded-pill px-3 py-2 me-2 mb-2">
                                            <i class="fas fa-check-circle text-success me-1"></i> {{ $s }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif

                            {{-- tags relation --}}
                            @if($entry->tags?->count())
                                <div>
                                    @foreach($entry->tags as $tag)
                                        <span class="badge bg-secondary bg-opacity-75 text-white rounded-pill px-3 py-2 me-2 mb-2">
                                            <i class="fas fa-tag me-1"></i> {{ $tag->name }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif

                            @if(!count($skillsArr) && !($entry->tags?->count()))
                                <em class="text-black-50">No skills or tags provided</em>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Attachments Card --}}
@if(!empty($attList) && count($attList))
    <div class="card border-0 shadow-sm mb-4 overflow-hidden">
        <div class="card-header bg-gradient bg-secondary text-white border-0">
            <h5 class="mb-0">
                <i class="fas fa-paperclip me-2"></i> Attachments ({{ count($attList) }})
            </h5>
        </div>
        <div class="card-body p-0">
            <ul class="list-group list-group-flush">
                @foreach($attList as $att)
                    <li class="list-group-item py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center gap-3 flex-grow-1">
                                <div class="bg-secondary bg-opacity-10 rounded-3 p-3">
                                    <i class="fas fa-file text-secondary fs-4"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="fw-bold mb-1 text-dark">{{ $att['original_name'] ?? 'Attachment' }}</div>
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
                                <a class="btn btn-outline-secondary btn-sm rounded-pill px-4" href="{{ $att['url'] }}" target="_blank">
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

{{-- Audit / Review Info Card --}}
<div class="card border-0 shadow-sm overflow-hidden">
    <div class="card-header bg-gradient bg-dark text-white border-0">
        <h5 class="mb-0">
            <i class="fas fa-info-circle me-2"></i> Audit / Review Info
        </h5>
    </div>
    <div class="card-body p-4">
        <div class="row g-4">
            {{-- Left Side: Creation & Submission --}}
            <div class="col-lg-6">
                <div class="card border-0 bg-light h-100">
                    <div class="card-body">
                        <h6 class="text-primary fw-bold mb-3 border-bottom border-primary pb-2">
                            <i class="fas fa-calendar-plus me-2"></i> Timeline
                        </h6>

                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-1">
                                <i class="fas fa-circle text-primary me-2" style="font-size: 8px;"></i>
                                <strong class="text-dark">Created at</strong>
                            </div>
                            <div class="ps-4 text-muted small">{{ $entry->created_at ?? '—' }}</div>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-1">
                                <i class="fas fa-circle text-success me-2" style="font-size: 8px;"></i>
                                <strong class="text-dark">Updated at</strong>
                            </div>
                            <div class="ps-4 text-muted small">{{ $entry->updated_at ?? '—' }}</div>
                        </div>

                        <div>
                            <div class="d-flex align-items-center mb-1">
                                <i class="fas fa-circle text-info me-2" style="font-size: 8px;"></i>
                                <strong class="text-dark">Submitted at</strong>
                            </div>
                            <div class="ps-4 text-muted small">{{ $submittedAt ?: '—' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right Side: Approval / Rejection --}}
            <div class="col-lg-6">
                <div class="card border-0 bg-light h-100">
                    <div class="card-body">
                        <h6 class="text-success fw-bold mb-3 border-bottom border-success pb-2">
                            <i class="fas fa-check-circle me-2"></i> Review Status
                        </h6>

                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-1">
                                <i class="fas fa-circle text-success me-2" style="font-size: 8px;"></i>
                                <strong class="text-dark">Approved at</strong>
                            </div>
                            <div class="ps-4 text-muted small">{{ $approvedAt ?: '—' }}</div>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-1">
                                <i class="fas fa-circle text-warning me-2" style="font-size: 8px;"></i>
                                <strong class="text-dark">Approved by</strong>
                            </div>
                            <div class="ps-4 text-muted small">{{ $approvedBy ?: '—' }}</div>
                        </div>

                        @if(!empty($approvalComment))
                            <div class="alert alert-success border-0 shadow-sm mb-0 mt-3">
                                <div class="fw-bold mb-1">
                                    <i class="fas fa-comment-dots me-1"></i> Approval Comment
                                </div>
                                <div class="small fst-italic">{{ $approvalComment }}</div>
                            </div>
                        @endif

                        @if($rejectedAt || $rejectedBy || $rejectionReason || $rejectionComment)
                            <div class="alert alert-danger border-0 shadow-sm mb-0 mt-3">
                                <h6 class="fw-bold text-danger mb-2">
                                    <i class="fas fa-times-circle me-1"></i> Rejection Details
                                </h6>

                                <div class="mb-2 small">
                                    <strong>Rejected at:</strong> {{ $rejectedAt ?: '—' }}
                                </div>
                                <div class="mb-2 small">
                                    <strong>Rejected by:</strong> {{ $rejectedBy ?: '—' }}
                                </div>

                                @if(!empty($rejectionReason))
                                    <div class="mb-2 small">
                                        <strong>Reason:</strong> <span class="badge bg-danger">{{ $rejectionReason }}</span>
                                    </div>
                                @endif

                                @if(!empty($rejectionComment))
                                    <div class="small">
                                        <strong>Comment:</strong> <em>{{ $rejectionComment }}</em>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
