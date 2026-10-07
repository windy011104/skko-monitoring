@php
    $fieldValue = old($name, data_get($data ?? null, $name));
@endphp

<div class="form-group">
    <label for="{{ $name }}" class="form-label">
        {{ $label }}
    </label>

    <input
        type="number"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ $fieldValue }}"
        class="form-control"
        step="any"
        placeholder="{{ $placeholder ?? '0' }}"
    >

    @error($name)
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
