@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'font-mono text-[10px] uppercase tracking-wider text-red-500 space-y-1 mt-2 border-l border-red-500/50 pl-3']) }}>
        @foreach ((array) $messages as $message)
            <li class="flex items-center gap-2">
                <span class="opacity-60 select-none">// ERROR:</span>
                <span>{{ $message }}</span>
            </li>
        @endforeach
    </ul>
@endif