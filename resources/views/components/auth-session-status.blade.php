@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-mono text-xs font-medium text-green-400 bg-green-500/10 border border-green-500/20 p-4 rounded-none mb-6 relative overflow-hidden group']) }}>
        <!-- Background decorative line -->
        <div class="absolute top-0 left-0 h-full w-1 bg-green-500"></div>
        
        <div class="flex items-center gap-3">
            <!-- Pulsing indicator -->
            <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
            </span>
            
            <span class="tracking-[0.2em] uppercase">
                <span class="opacity-50">// SUCCESS:</span> {{ $status }}
            </span>
        </div>

        <!-- Technical decoration -->
        <div class="absolute right-2 bottom-1 text-[8px] text-green-500/30 font-mono tracking-tighter pointer-events-none">
            PROTOCOL_EXECUTED_OK
        </div>
    </div>
@endif