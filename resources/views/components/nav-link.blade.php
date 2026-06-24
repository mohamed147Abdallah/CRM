@props(['active'])

@php
// Stripped to bare minimum — all styling handled by navigation.blade.php
$classes = 'inline-flex items-center focus:outline-none transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
