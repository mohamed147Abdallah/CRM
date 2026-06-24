<a {{ $attributes->merge(['class' => 'block w-full px-6 py-3 text-start text-[10px] font-mono font-medium uppercase tracking-[0.2em] text-gray-400 hover:bg-white/5 hover:text-white focus:outline-none focus:bg-white/5 transition duration-150 ease-in-out relative group']) }}>
    <!-- Decorative Left Indicator -->
    <div class="absolute left-0 top-0 h-full w-0 bg-white transition-all group-hover:w-1"></div>
    
    <span class="relative z-10">
        {{ $slot }}
    </span>
</a>