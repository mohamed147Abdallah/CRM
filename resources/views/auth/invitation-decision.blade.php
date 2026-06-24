<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NEXUS | Invitation Decision</title>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { background-color: #030303; color: white; font-family: 'Space Grotesk', sans-serif; }
        .glass-panel {
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.03) 0%, transparent 100%);
            border: 1px solid rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(12px);
        }
    </style>
</head>
<body class="antialiased flex items-center justify-center min-h-screen">
    
    <div class="max-w-md w-full px-6 py-12 glass-panel text-center relative overflow-hidden">
        {{-- Technical Accents --}}
        <div class="absolute top-0 left-0 w-2 h-2 border-t border-l border-white/40"></div>
        <div class="absolute bottom-0 right-0 w-2 h-2 border-b border-r border-white/40"></div>

        <div class="mb-10">
            <div class="w-16 h-16 border border-white/20 flex items-center justify-center rotate-45 bg-white/5 mx-auto mb-6">
                <div class="w-3 h-3 bg-white rounded-full animate-pulse"></div>
            </div>
            <h1 class="text-xl font-bold tracking-[0.3em] uppercase">Auth_Protocol_Inbound</h1>
            <p class="text-[10px] text-gray-500 mt-4 uppercase tracking-widest">Target_Identity: {{ $user->name }}</p>
        </div>

        <div class="mb-10 p-6 bg-white/5 border border-white/10">
            <p class="text-sm text-gray-300 leading-relaxed uppercase tracking-wider">
                System Administration has requested to upgrade your terminal clearance to <span class="text-white font-bold">FIELD_AGENT</span>.
            </p>
        </div>

        <div class="flex flex-col gap-4">
            {{-- Accept Form --}}
            <form action="{{ route('invitation.accept', $invitation->token) }}" method="POST">
                @csrf
                <button type="submit" class="w-full py-4 bg-white text-black font-bold text-xs tracking-[0.3em] uppercase hover:bg-gray-200 transition-all">
                    ACCEPT_CLEARANCE ->
                </button>
            </form>

            {{-- Reject Form --}}
            <form action="{{ route('invitation.reject', $invitation->token) }}" method="POST">
                @csrf
                <button type="submit" class="w-full py-3 border border-red-900/50 text-red-500 font-bold text-[10px] tracking-[0.3em] uppercase hover:bg-red-500/10 transition-all">
                    REJECT_UPGRADE
                </button>
            </form>
        </div>

        <div class="mt-12 text-[8px] text-gray-700 font-mono tracking-widest uppercase">
            NEXUS_SECURITY_SERVICE // PROTOCOL_ID_{{ $invitation->id }}
        </div>
    </div>

</body>
</html>