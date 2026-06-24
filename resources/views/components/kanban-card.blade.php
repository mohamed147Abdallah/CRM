@props(['customer', 'color'])

@php
    $borderClass = match($color) {
        'blue' => 'border-t-blue-500',
        'yellow' => 'border-t-yellow-500',
        'green' => 'border-t-green-500',
        'red' => 'border-t-red-500',
        default => 'border-t-gray-500',
    };
    $isCritical = ($customer->priority ?? 'standard') === 'critical';
    $status = $customer->status;
@endphp

@once
<style>
    .kanban-card-unit[data-status="new"] .btn-state-new {
        background-color: #3b82f6 !important; 
        color: white !important; 
        pointer-events: none !important;
    }
    .kanban-card-unit[data-status="negotiation"] .btn-state-negotiation {
        background-color: #eab308 !important; 
        color: black !important; 
        pointer-events: none !important;
    }
    .kanban-card-unit[data-status="won"] .btn-state-won {
        background-color: #22c55e !important; 
        color: black !important; 
        pointer-events: none !important;
    }
    .kanban-card-unit[data-status="lost"] .btn-state-lost {
        background-color: #ef4444 !important; 
        color: white !important; 
        pointer-events: none !important;
    }
</style>
@endonce

<div class="kanban-card-unit bg-[#0a0a0c] border border-white/5 border-t-2 {{ $borderClass }} {{ $isCritical ? 'priority-high-glow' : '' }} p-5 shadow-lg relative mb-4 group transition-all hover:border-white/20 hover:bg-[#0d0d12]" 
     data-id="{{ $customer->id }}" 
     data-deal-value="{{ $customer->deal_value ?? 0 }}"
     data-status="{{ $status }}">
    
    {{-- رأس الكارت: الآي دي وزر الحذف --}}
    <div class="flex justify-between items-start mb-4">
        <a href="{{ route('customers.show', $customer->id) }}" class="text-[9px] font-mono text-gray-500 hover:text-blue-400 transition-colors uppercase tracking-widest">
            #NEX-{{ str_pad($customer->id, 4, '0', STR_PAD_LEFT) }}
        </a>
        <button onclick='purgeSubject({{ $customer->id }})' class="opacity-0 group-hover:opacity-100 text-red-600 hover:text-red-400 text-[8px] font-mono font-bold uppercase tracking-[0.2em] transition-all">
            [PURGE]
        </button>
    </div>

    {{-- معلومات العميل الأساسية --}}
    <a href="{{ route('customers.show', $customer->id) }}" class="block">
        <h4 class="text-sm font-bold text-white mb-1 uppercase font-mono-nexus tracking-wide truncate group-hover:text-blue-400 transition-colors">
            {{ $customer->name }}
        </h4>
    </a>
    <p class="text-[10px] text-gray-500 uppercase tracking-widest mb-3 truncate">
        {{ $customer->company ?? '// REDACTED_ENTITY' }}
    </p>

    {{-- إظهار اسم الموظف ورتبته بشكل ديناميكي (ADMIN أو AGENT) --}}
    <div class="mb-4 flex items-center gap-1.5 border-l-2 border-purple-500/50 pl-2 bg-purple-500/5 py-1">
        <span class="text-[8px] text-purple-400 font-mono font-bold uppercase tracking-[0.2em] truncate">
            @if($customer->user)
                @if($customer->user->role === 'admin')
                    ADMIN: {{ $customer->user->name }}
                @else
                    AGENT: {{ $customer->user->name }}
                @endif
            @else
                SYSTEM_UNASSIGNED
            @endif
        </span>
    </div>
    
    {{-- القيمة المادية ورقم التليفون --}}
    <div class="flex items-end justify-between bg-black/50 p-3 border border-white/5 mb-4 rounded-sm">
        <div class="flex flex-col">
            <span class="text-[7px] text-gray-600 uppercase tracking-widest mb-1">Signal / Phone</span>
            <span class="text-[9px] text-gray-400 font-mono tracking-tighter">{{ $customer->phone ?? 'DISCONNECTED' }}</span>
        </div>
        <div class="flex flex-col text-right">
            <span class="text-[7px] text-gray-600 uppercase tracking-widest mb-1">Net Value</span>
            <span class="deal-value-label text-xs text-green-500 font-mono font-bold tracking-tighter">$ {{ number_format($customer->deal_value ?? 0, 2) }}</span>
        </div>
    </div>

    {{-- لوحة الأوامر: أزرار النقل التفاعلية --}}
    <div class="flex justify-between items-center gap-2 pt-2 border-t border-white/5">
        <div class="status-matrix flex w-full gap-1">
            <button onclick="changeNodeStatus({{ $customer->id }}, 'new', this)" 
                    class="status-segment-btn btn-state-new flex-1 py-1.5 text-[8px] font-bold uppercase tracking-widest transition-colors rounded-sm text-gray-500 hover:bg-white/5 hover:text-blue-400">
                NEW
            </button>
            
            <button onclick="changeNodeStatus({{ $customer->id }}, 'negotiation', this)" 
                    class="status-segment-btn btn-state-negotiation flex-1 py-1.5 text-[8px] font-bold uppercase tracking-widest transition-colors rounded-sm text-gray-500 hover:bg-white/5 hover:text-yellow-400">
                NEG
            </button>
            
            <button onclick="changeNodeStatus({{ $customer->id }}, 'won', this)" 
                    class="status-segment-btn btn-state-won flex-1 py-1.5 text-[8px] font-bold uppercase tracking-widest transition-colors rounded-sm text-gray-500 hover:bg-white/5 hover:text-green-400">
                WON
            </button>
            
            <button onclick="changeNodeStatus({{ $customer->id }}, 'lost', this)" 
                    class="status-segment-btn btn-state-lost flex-1 py-1.5 text-[8px] font-bold uppercase tracking-widest transition-colors rounded-sm text-gray-500 hover:bg-white/5 hover:text-red-400">
                LOST
            </button>
        </div>
        
        <button onclick='editViaSPA({!! $customer->toJson() !!})' class="px-2 py-1.5 text-gray-500 hover:text-white text-[8px] font-bold uppercase tracking-widest border border-white/10 hover:bg-white/10 transition-colors rounded-sm" title="Edit">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
        </button>
    </div>
</div>