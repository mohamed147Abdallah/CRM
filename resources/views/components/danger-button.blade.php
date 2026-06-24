<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-6 py-3 bg-red-600 border border-transparent rounded-none font-mono font-bold text-xs text-white uppercase tracking-[0.2em] hover:bg-red-500 active:scale-95 focus:outline-none focus:ring-0 transition-all duration-150 shadow-lg shadow-red-900/20 relative group overflow-hidden']) }}>
    <!-- Decorative side line -->
    <div class="absolute left-0 top-0 h-full w-0.5 bg-white/20 group-hover:bg-white transition-colors"></div>
    
    <span class="relative z-10">
        {{ $slot }}
    </span>

    <!-- Technical detail -->
    <div class="absolute right-1 bottom-0.5 text-[6px] opacity-30 font-mono tracking-tighter">
        SEC_LVL_4
    </div>
</button>