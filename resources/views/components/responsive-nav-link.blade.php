@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-4 pe-4 py-3 border-l-2 border-white text-[10px] font-mono font-bold text-white bg-white/5 focus:outline-none transition duration-150 ease-in-out uppercase tracking-[0.2em]'
            : 'block w-full ps-4 pe-4 py-3 border-l-2 border-transparent text-[10px] font-mono font-medium text-gray-500 hover:text-white hover:bg-white/5 hover:border-white/20 focus:outline-none transition duration-150 ease-in-out uppercase tracking-[0.2em]';
@endphp

<a {{ $attributes->merge(['class' => $classes . ' relative group overflow-hidden']) }}>
    <!-- Decorative side indicator for active/hover -->
    <div class="absolute left-0 top-0 h-full w-0.5 bg-white/10 group-hover:bg-white/30 transition-colors"></div>
    
    <span class="relative z-10 flex items-center justify-between">
        {{ $slot }}
        
        @if($active ?? false)
            <span class="text-[8px] opacity-40 font-mono tracking-tighter">SELECTED_NODE</span>
        @endif
    </span>
</a>