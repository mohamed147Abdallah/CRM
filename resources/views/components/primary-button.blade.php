<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-8 py-3 bg-white border border-transparent rounded-none font-mono font-bold text-xs text-black uppercase tracking-[0.2em] hover:bg-gray-200 focus:outline-none transition-all duration-150 active:scale-95 shadow-lg shadow-white/10 relative group overflow-hidden']) }}>
    <!-- Decorative side line -->
    <div class="absolute left-0 top-0 h-full w-0.5 bg-black/10 group-hover:bg-black/20 transition-colors"></div>
    
    <span class="relative z-10 flex items-center">
        {{ $slot }}
    </span>

    <!-- Technical detail -->
    <div class="absolute right-1 bottom-0.5 text-[6px] text-black/30 font-mono tracking-tighter">
        SYS_PRM_01
    </div>
</button>