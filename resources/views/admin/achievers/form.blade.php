@php
    $journeyText = old('journey_text', collect($achiever?->journey ?? [])->map(function ($item) {
        return ($item['year'] ?? '').' | '.($item['title'] ?? '').' | '.($item['text'] ?? '');
    })->implode("\n"));

    $highlightsText = old('highlights_text', collect($achiever?->highlights ?? [])->implode("\n"));
@endphp

<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Name</label>
        <input class="form-control" name="name" value="{{ old('name', $achiever?->name) }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">URL Slug</label>
        <input class="form-control" name="slug" value="{{ old('slug', $achiever?->slug) }}" placeholder="sumit-tomar">
        <div class="help">Blank chhodne par name se automatic ban jayega. Public URL: /slug</div>
    </div>
    <div class="col-md-6">
        <label class="form-label">Role / Designation</label>
        <input class="form-control" name="role" value="{{ old('role', $achiever?->role) }}" required>
    </div>
    <div class="col-md-3">
        <label class="form-label">Badge</label>
        <input class="form-control" name="badge" value="{{ old('badge', $achiever?->badge) }}" placeholder="World Record">
    </div>
    <div class="col-md-3">
        <label class="form-label">Initials</label>
        <input class="form-control" name="initials" value="{{ old('initials', $achiever?->initials) }}" placeholder="ST">
    </div>
    <div class="col-md-4">
        <label class="form-label">Tone</label>
        <select class="form-select" name="tone">
            @foreach(['service' => 'Service / Record', 'athlete' => 'Athlete', 'leader' => 'Leader', 'education' => 'Education'] as $value => $label)
                <option value="{{ $value }}" @selected(old('tone', $achiever?->tone ?? 'service') === $value)>{{ $label }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label">Display Order</label>
        <input class="form-control" type="number" min="0" name="display_order" value="{{ old('display_order', $achiever?->display_order ?? 0) }}">
    </div>
    <div class="col-md-4">
        <label class="form-label">Photo</label>
        <input class="form-control" type="file" name="photo" accept="image/*">
        @if($achiever?->photo)
            <div class="help">Current photo: {{ $achiever->photo }}</div>
        @endif
    </div>
    <div class="col-12">
        <label class="form-label">Card Short Description</label>
        <textarea class="form-control" name="short_description" rows="3">{{ old('short_description', $achiever?->short_description) }}</textarea>
    </div>
    <div class="col-12">
        <label class="form-label">Profile Summary</label>
        <textarea class="form-control" name="profile_summary" rows="5">{{ old('profile_summary', $achiever?->profile_summary) }}</textarea>
    </div>
    <div class="col-12">
        <label class="form-label">Journey / Milestones</label>
        <textarea class="form-control" name="journey_text" rows="7" placeholder="Year | Title | Details">{{ $journeyText }}</textarea>
        <div class="help">Har line ka format: <strong>Year | Title | Details</strong></div>
    </div>
    <div class="col-12">
        <label class="form-label">Highlights</label>
        <textarea class="form-control" name="highlights_text" rows="5" placeholder="One highlight per line">{{ $highlightsText }}</textarea>
        <div class="help">Har line ek highlight ban jayegi.</div>
    </div>
    <div class="col-12">
        <label class="form-check">
            <input class="form-check-input" type="checkbox" name="is_published" value="1" @checked(old('is_published', $achiever?->is_published ?? true))>
            <span class="form-check-label fw-bold">Publish on public Who's Who page</span>
        </label>
    </div>
    <div class="col-12 d-flex gap-2">
        <button class="btn btn-success" type="submit">Save Profile</button>
        <a class="btn btn-outline-secondary" href="{{ route('admin.achievers.index') }}">Cancel</a>
    </div>
</div>
