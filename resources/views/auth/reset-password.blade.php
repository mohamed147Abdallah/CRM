<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NEXUS | Reset Protocol</title>

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
        input:-webkit-autofill,
        input:-webkit-autofill:hover, 
        input:-webkit-autofill:focus, 
        input:-webkit-autofill:active{
            -webkit-box-shadow: 0 0 0 30px #09090b inset !important;
            -webkit-text-fill-color: white !important;
            caret-color: white;
        }
    </style>
</head>
<body class="font-sans antialiased overflow-x-hidden selection:bg-blue-600 selection:text-white">

    <!-- Background -->
    <div class="fixed inset-0 pointer-events-none">
        <div class="aurora-blob w-[600px] h-[600px] bg-blue-900/10 top-[-20%] left-[-10%] rounded-full"></div>
        <div class="aurora-blob w-[500px] h-[500px] bg-purple-900/10 bottom-[-10%] right-[-10%] rounded-full animation-delay-2000"></div>
        <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 brightness-100 contrast-150"></div>
        <div class="absolute inset-0" style="background-image: linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px), linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px); background-size: 60px 60px; mask-image: linear-gradient(to bottom, transparent, black 20%, black 80%, transparent);"></div>
    </div>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative z-10 py-12">
        
        <!-- Logo -->
        <div class="mb-10 text-center">
            <a href="/" class="flex flex-col items-center gap-4 group">
                <div class="w-12 h-12 border border-white/20 flex items-center justify-center rotate-45 group-hover:rotate-0 transition-transform duration-700 bg-white/5 shadow-2xl shadow-blue-900/20">
                    <div class="w-3 h-3 bg-white rounded-full"></div>
                </div>
                <h1 class="font-mono font-bold text-2xl tracking-[0.2em] text-white mt-4">NEXUS<span class="text-gray-600">_RESET</span></h1>
            </a>
        </div>

        <!-- Auth Card -->
        <div class="w-full sm:max-w-md px-8 py-10 glass-card sm:rounded-none shadow-2xl relative group border-white/10">
            
            <!-- Corner Accents -->
            <div class="absolute top-0 left-0 w-2 h-2 border-t border-l border-white/50"></div>
            <div class="absolute top-0 right-0 w-2 h-2 border-t border-r border-white/50"></div>
            <div class="absolute bottom-0 left-0 w-2 h-2 border-b border-l border-white/50"></div>
            <div class="absolute bottom-0 right-0 w-2 h-2 border-b border-r border-white/50"></div>

            <div class="mb-6 text-[10px] font-mono text-gray-500 uppercase tracking-[0.3em] border-l-2 border-blue-500 pl-3">
                Update Security Credentials
            </div>

            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div class="group/input">
                    <label for="email" class="block font-mono text-[10px] text-gray-500 uppercase tracking-widest mb-2 group-focus-within/input:text-blue-400 transition-colors">Identification (Email)</label>
                    <input id="email" class="block w-full bg-zinc-950/50 border border-white/10 text-white focus:border-blue-500 focus:ring-0 focus:outline-none rounded-none h-12 px-4 font-mono text-sm transition-all placeholder-gray-700 hover:border-white/20" 
                           type="email" 
                           name="email" 
                           value="{{ old('email', $request->email) }}" 
                           required autofocus 
                           autocomplete="username" 
                           placeholder="USER@NEXUS.CORP" />
                    @error('email')
                        <p class="mt-2 text-xs text-red-500 font-mono">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mt-6 group/input">
                    <label for="password" class="block font-mono text-[10px] text-gray-500 uppercase tracking-widest mb-2 group-focus-within/input:text-blue-400 transition-colors">New Access Key</label>
                    <input id="password" class="block w-full bg-zinc-950/50 border border-white/10 text-white focus:border-blue-500 focus:ring-0 focus:outline-none rounded-none h-12 px-4 font-mono text-sm transition-all placeholder-gray-700 hover:border-white/20"
                           type="password"
                           name="password"
                           required 
                           autocomplete="new-password"
                           placeholder="••••••••••••" />
                    @error('password')
                        <p class="mt-2 text-xs text-red-500 font-mono">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mt-6 group/input">
                    <label for="password_confirmation" class="block font-mono text-[10px] text-gray-500 uppercase tracking-widest mb-2 group-focus-within/input:text-blue-400 transition-colors">Confirm Key</label>
                    <input id="password_confirmation" class="block w-full bg-zinc-950/50 border border-white/10 text-white focus:border-blue-500 focus:ring-0 focus:outline-none rounded-none h-12 px-4 font-mono text-sm transition-all placeholder-gray-700 hover:border-white/20"
                           type="password"
                           name="password_confirmation"
                           required 
                           autocomplete="new-password"
                           placeholder="••••••••••••" />
                    @error('password_confirmation')
                        <p class="mt-2 text-xs text-red-500 font-mono">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-end mt-10">
                    <button type="submit" class="px-8 py-3 bg-white text-black font-mono font-bold text-xs tracking-widest hover:bg-gray-200 transition-all hover:scale-105 active:scale-95 border border-transparent">
                        UPDATE CREDENTIALS ->
                    </button>
                </div>
            </form>
        </div>
        
        <div class="mt-8 text-[10px] font-mono text-gray-700 uppercase tracking-widest">
            Protocol: Security_Override_Initiated
        </div>
    </div>
</body>
</html>