@php
    $fieldValue = old($name, data_get($data ?? null, $name));
@endphp

<div class="form-group">
    <label for="{{ $name }}" class="form-label">
        {{ $label }}
    </label>

    <textarea
        name="{{ $name }}"
        id="{{ $name }}"
        rows="{{ $rows ?? 3 }}"
        class="form-control"
        placeholder="{{ $placeholder ?? 'Masukkan ' . strtolower($label) }}"
    >{{ $fieldValue }}</textarea>

    @error($name)
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
