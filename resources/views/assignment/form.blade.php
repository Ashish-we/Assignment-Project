<div class="form-group">
    <label for="title">Title</label>
    <input id="title" type="text" value="{{ old('title', $item->title) }}" class="form-control" name="title" required autofocus>
    <span class="text-danger">
        @error('title')
        {{ $message }}
        @enderror
    </span>
</div>

<div class="form-group">
    <label for="details">Details</label>
    <textarea id="details" class="form-control" name="details" rows="5" required>{{ old('title', $item->details) }}</textarea>
    <span class="text-danger">
        @error('details')
        {{ $message }}
        @enderror
    </span>
</div>