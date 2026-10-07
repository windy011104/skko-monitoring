@php
    $fieldValue = old($name, data_get($data ?? null, $name, $value ?? ''));
@endphp

<div class="form-group">
    <label for="{{ $name }}" class="form-label">
        {{ $label }}
    </label>

    <input
        type="{{ $type ?? 'text' }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ $fieldValue }}"
        placeholder="{{ $placeholder ?? 'Masukkan ' . strtolower($label) }}"
        class="form-input"
    >

    @error($name)
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
