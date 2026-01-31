<div class="mb-2">
    <span class="badge bg-warning text-dark">{{ strtoupper($entry->status) }}</span>
    <span class="badge bg-secondary">{{ $entry->type }}</span>
</div>

<h5 class="mb-2">{{ $entry->title }}</h5>
<p class="text-muted mb-3">{{ $entry->summary }}</p>

<div class="row g-3 mb-3">
    <div class="col-md-6">
        <div class="border rounded p-2">
            <small class="text-muted d-block">Author</small>
            <strong>{{ $entry->author?->name }}</strong>
            <div class="text-muted">{{ $entry->author?->email }}</div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="border rounded p-2">
            <small class="text-muted d-block">Department</small>
            <strong>{{ $entry->department?->name }}</strong>
            <div class="text-muted">Submitted: {{ optional($entry->submitted_at)->diffForHumans() }}</div>
        </div>
    </div>
</div>

<div class="mb-3">
    <h6 class="mb-2">Content</h6>
    <div class="border rounded p-3 bg-light">
        {!! nl2br(e($entry->content)) !!}
    </div>
</div>

@if(!empty($entry->extra))
    <div class="mb-3">
        <h6 class="mb-2">Extra Details</h6>
        <pre class="bg-dark text-white p-3 rounded mb-0" style="white-space: pre-wrap;">{{ json_encode($entry->extra, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
    </div>
@endif

@if($attachments->count())
    <div class="mb-2">
        <h6 class="mb-2">Attachments</h6>
        <ul class="list-group">
            @foreach($attachments as $att)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-paperclip"></i>
                        @if($att['url'])
                            <a href="{{ $att['url'] }}" target="_blank">{{ $att['original_name'] }}</a>
                        @else
                            <span>{{ $att['original_name'] }}</span>
                        @endif
                    </div>
                    <span class="badge bg-secondary">{{ $att['type'] }}</span>
                </li>
            @endforeach
        </ul>
        <small class="text-muted d-block mt-2">Click file name to open in a new tab.</small>
    </div>
@endif
