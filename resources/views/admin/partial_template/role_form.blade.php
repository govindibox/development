<label for="name">Name:</label>
<input type="text" id="name" name="name" value="{{ old('name', optional($role ?? null)->name) }}">
@error('name')
    {{ $message }}
@enderror