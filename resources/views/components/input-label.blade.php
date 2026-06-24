@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-mono text-[10px] text-gray-500 uppercase tracking-[0.3em] mb-2 transition-colors group-focus-within:text-indigo-500']) }}>
    {{ $value ?? $slot }}
</label>