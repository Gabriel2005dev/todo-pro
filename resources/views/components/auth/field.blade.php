@props([
    'label',
    'name',
    'type' => 'text',
    'required' => false,
    'autofocus' => false,
    'autocomplete' => null,
])

<div {{ $attributes->merge(['class' => 'auth-field']) }}>
    <label for="{{ $name }}" class="auth-field__label">{{ $label }}</label>
    <input
        id="{{ $name }}"
        name="{{ $name }}"
        type="{{ $type }}"
        value="{{ old($name) }}"
        @if ($required) required @endif
        @if ($autofocus) autofocus @endif
        @if ($autocomplete) autocomplete="{{ $autocomplete }}" @endif
        class="auth-field__input @error($name) auth-field__input--error @enderror"
    />
    @error($name)
        <p class="auth-field__error">{{ $message }}</p>
    @enderror
</div>
