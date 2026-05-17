@props([
    'title',
    'helpUrl' => '#',
    'helpLabel' => 'Precisa de ajuda?',
])

<div {{ $attributes->merge(['class' => 'auth-card']) }}>
    <div class="auth-card__header">
        <a href="{{ $helpUrl }}" class="auth-card__help">{{ $helpLabel }}</a>
    </div>

    <h1 class="auth-card__title">{{ $title }}</h1>

    <div class="auth-card__body">
        {{ $slot }}
    </div>
</div>
