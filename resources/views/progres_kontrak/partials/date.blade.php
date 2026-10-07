@php
    $fieldValue = old($name, data_get($data ?? null, $name));

    if ($fieldValue) {
        try {
            $fieldValue = \Carbon\Carbon::parse($fieldValue)->format('Y-m-d');
        } catch (\Exception $e) {
            $fieldValue = '';
        }
    }
@endphp

<div class="form-group">
    <label for="{{ $name }}" class="form-label">
        {{ $label }}
    </label>

    <input
        type="date"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ $fieldValue }}"
        class="form-control"
    >

    @error($name)
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
