@props(['id', 'title', 'color', 'customers'])

@php
    $headerColor = match($color) {
        'blue' => 'text-blue-500 border-blue-600',
        'yellow' => 'text-yellow-500 border-yellow-500',
        'green' => 'text-green-500 border-green-500',
        'red' => 'text-red-600 border-red-600',
        default => 'text-gray-500 border-gray-600',
    };
@endphp

<div class="flex flex-col h-full">
    <!-- Column Header -->
    <div class="flex items-center justify-between mb-4 border-b-2 {{ explode(' ', $headerColor)[1] }} pb-2">
        <h3 class="text-sm font-bold {{ explode(' ', $headerColor)[0] }} uppercase tracking-widest">{{ $title }}</h3>
        <span class="text-[10px] text-gray-600 font-mono">{{ $customers->count() }} TARGETS</span>
    </div>

    <!-- Drop Zone -->
    <div id="{{ $id }}" class="flex-1 bg-black border border-white/5 p-4 space-y-4 min-h-[500px] custom-scrollbar overflow-y-auto" data-status="{{ $id }}">
        @foreach($customers as $customer)
            <x-kanban-card :customer="$customer" :color="$color" />
        @endforeach
    </div>
</div>