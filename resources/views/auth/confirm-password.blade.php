<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NEXUS | Security Verification</title>

    <!-- Fonts: Inter & Space Grotesk -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        mono: ['"Space Grotesk"', 'monospace'],
                        sans: ['"Inter"', 'sans-serif'],
                    },
                    colors: {
                        black: '#030303',
                        zinc: {
                            850: '#1f1f22',
                            900: '#18181b',
                            950: '#09090b',
                        },
                    },
                    animation: {
                        'aurora': 'aurora 10s linear infinite',
                    },
                    keyframes: {
                        aurora: {
                            '0%': { transform: 'rotate(0deg) scale(1)' },
                            '50%': { transform: 'rotate(180deg) scale(1.1)' },
                            '100%': { transform: 'rotate(360deg) scale(1)' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body { background-color: #030303; color: white; }
        .aurora-blob {
            position: absolute;
            filter: blur(80px);
            opacity: 0.4;
            z-index: 0;
            animation: aurora 15s infinite alternate;
        }
        .glass-card {
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.03) 0%, rgba(255, 255, 255, 0.01) 100%);
            border: 1px solid rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(12px);
        }
    </style>
</head>
<body class="font-sans antialiased overflow-hidden selection:bg-red-600 selection:text-white">

    <!-- Background -->
    <div class="fixed inset-0 pointer-events-none">
        <div class="aurora-blob w-[600px] h-[600px] bg-red-900/20 top-[-20%] left-[-10%] rounded-full"></div>
        <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 brightness-100 contrast-150"></div>
        <div class="absolute inset-0" style="background-image: linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px), linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px); background-size: 60px 60px; mask-image: linear-gradient(to bottom, transparent, black 20%, black 80%, transparent);"></div>
    </div>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative z-10">
        
        <!-- Logo -->
        <div class="mb-10 text-center">
            <div class="flex flex-col items-center gap-4 group">
                <div class="w-12 h-12 border border-red-500/30 flex items-center justify-center bg-red-900/10 shadow-2xl shadow-red-900/20">
                    <svg class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="square" stroke-linejoin="miter" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                <h1 class="font-mono font-bold text-xl tracking-[0.2em] text-red-500 mt-2">SECURITY_CHECK</h1>
            </div>
        </div>

        <!-- Auth Card -->
        <div class="w-full sm:max-w-md px-8 py-10 glass-card sm:rounded-none shadow-2xl relative group border-red-500/20">
            
            <!-- Corner Accents (Red for Security) -->
            <div class="absolute top-0 left-0 w-2 h-2 border-t border-l border-red-500/50"></div>
            <div class="absolute top-0 right-0 w-2 h-2 border-t border-r border-red-500/50"></div>
            <div class="absolute bottom-0 left-0 w-2 h-2 border-b border-l border-red-500/50"></div>
            <div class="absolute bottom-0 right-0 w-2 h-2 border-b border-r border-red-500/50"></div>

            <div class="mb-6 text-xs font-mono text-gray-400 leading-relaxed border-l-2 border-red-500/50 pl-3">
                {{ __('SECURE AREA DETECTED. PLEASE RE-AUTHENTICATE TO PROCEED.') }}
            </div>

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <!-- Password -->
                <div class="group/input">
                    <label for="password" class="block font-mono text-[10px] text-gray-500 uppercase tracking-widest mb-2 group-focus-within/input:text-red-400 transition-colors">Access Key (Password)</label>
                    <input id="password" class="block w-full bg-zinc-950/50 border border-white/10 text-white focus:border-red-500 focus:ring-0 focus:outline-none rounded-none h-12 px-4 font-mono text-sm transition-all placeholder-gray-700 hover:border-white/20"
                           type="password"
                           name="password"
                           required autocomplete="current-password"
                           placeholder="••••••••••••" />
                    @error('password')
                        <p class="mt-2 text-xs text-red-500 font-mono">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end mt-8">
                    <button type="submit" class="px-8 py-3 bg-red-600 text-white font-mono font-bold text-xs tracking-widest hover:bg-red-500 transition-all hover:scale-105 active:scale-95 border border-transparent shadow-lg shadow-red-900/20">
                        CONFIRM IDENTITY ->
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>