<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NEXUS | New User Protocol</title>

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
        /* Shared Styles */
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
        /* Custom Select Styling */
        select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 1rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
        }
    </style>
</head>
<body class="font-sans antialiased overflow-x-hidden selection:bg-blue-600 selection:text-white">

    <!-- Background Decoration -->
    <div class="fixed inset-0 pointer-events-none">
        <div class="aurora-blob w-[600px] h-[600px] bg-green-900/10 top-[-20%] right-[-10%] rounded-full"></div>
        <div class="aurora-blob w-[500px] h-[500px] bg-blue-900/10 bottom-[-10%] left-[-10%] rounded-full animation-delay-2000"></div>
        <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 brightness-100 contrast-150"></div>
        <div class="absolute inset-0" style="background-image: linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px), linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px); background-size: 60px 60px; mask-image: linear-gradient(to bottom, transparent, black 20%, black 80%, transparent);"></div>
    </div>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative z-10 py-12">
        
        <!-- Logo Section -->
        <div class="mb-10 text-center">
            <a href="/" class="flex flex-col items-center gap-4 group">
                <div class="w-12 h-12 border border-white/20 flex items-center justify-center rotate-45 group-hover:rotate-0 transition-transform duration-700 bg-white/5 shadow-2xl shadow-green-900/20">
                    <div class="w-3 h-3 bg-white rounded-full"></div>
                </div>
                <h1 class="font-mono font-bold text-2xl tracking-[0.2em] text-white mt-4 uppercase">Nexus_Init</h1>
            </a>
        </div>

        <!-- Auth Card Container -->
        <div class="w-full sm:max-w-md px-8 py-10 glass-card sm:rounded-none shadow-2xl relative group">
            
            <!-- Technical Corner Accents -->
            <div class="absolute top-0 left-0 w-2 h-2 border-t border-l border-white/50"></div>
            <div class="absolute top-0 right-0 w-2 h-2 border-t border-r border-white/50"></div>
            <div class="absolute bottom-0 left-0 w-2 h-2 border-b border-l border-white/50"></div>
            <div class="absolute bottom-0 right-0 w-2 h-2 border-b border-r border-white/50"></div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name Field -->
                <div class="group/input">
                    <label for="name" class="block font-mono text-[10px] text-gray-500 uppercase tracking-widest mb-2 group-focus-within/input:text-blue-400 transition-colors">Operative Name</label>
                    <input id="name" class="block w-full bg-zinc-950/50 border border-white/10 text-white focus:border-blue-500 focus:ring-0 focus:outline-none rounded-none h-12 px-4 font-mono text-sm transition-all placeholder-gray-700 hover:border-white/20" 
                           type="text" 
                           name="name" 
                           :value="old('name')" 
                           required autofocus 
                           autocomplete="name" 
                           placeholder="FULL NAME" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Role Selection Field [NEW] -->
                <div class="mt-6 group/input">
                    <label for="role" class="block font-mono text-[10px] text-gray-500 uppercase tracking-widest mb-2 group-focus-within/input:text-blue-400 transition-colors">Clearance Level (Role)</label>
                    <select id="role" name="role" required class="block w-full bg-zinc-950/50 border border-white/10 text-white focus:border-blue-500 focus:ring-0 focus:outline-none rounded-none h-12 px-4 font-mono text-sm transition-all cursor-pointer hover:border-white/20">
                        <option value="agent" {{ old('role') == 'agent' ? 'selected' : '' }}>FIELD_AGENT (Sales)</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>SYSTEM_ADMIN (Manager)</option>
                    </select>
                    <x-input-error :messages="$errors->get('role')" class="mt-2" />
                </div>

                <!-- Email Address Field -->
                <div class="mt-6 group/input">
                    <label for="email" class="block font-mono text-[10px] text-gray-500 uppercase tracking-widest mb-2 group-focus-within/input:text-blue-400 transition-colors">Identification (Email)</label>
                    <input id="email" class="block w-full bg-zinc-950/50 border border-white/10 text-white focus:border-blue-500 focus:ring-0 focus:outline-none rounded-none h-12 px-4 font-mono text-sm transition-all placeholder-gray-700 hover:border-white/20" 
                           type="email" 
                           name="email" 
                           :value="old('email')" 
                           required 
                           autocomplete="username" 
                           placeholder="USER@NEXUS.CORP" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password Field -->
                <div class="mt-6 group/input">
                    <label for="password" class="block font-mono text-[10px] text-gray-500 uppercase tracking-widest mb-2 group-focus-within/input:text-blue-400 transition-colors">Access Key (Password)</label>
                    <input id="password" class="block w-full bg-zinc-950/50 border border-white/10 text-white focus:border-blue-500 focus:ring-0 focus:outline-none rounded-none h-12 px-4 font-mono text-sm transition-all placeholder-gray-700 hover:border-white/20"
                           type="password"
                           name="password"
                           required 
                           autocomplete="new-password"
                           placeholder="••••••••••••" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password Field -->
                <div class="mt-6 group/input">
                    <label for="password_confirmation" class="block font-mono text-[10px] text-gray-500 uppercase tracking-widest mb-2 group-focus-within/input:text-blue-400 transition-colors">Confirm Key</label>
                    <input id="password_confirmation" class="block w-full bg-zinc-950/50 border border-white/10 text-white focus:border-blue-500 focus:ring-0 focus:outline-none rounded-none h-12 px-4 font-mono text-sm transition-all placeholder-gray-700 hover:border-white/20"
                           type="password"
                           name="password_confirmation"
                           required 
                           autocomplete="new-password"
                           placeholder="••••••••••••" />
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-between mt-10">
                    <a class="text-[10px] text-gray-600 hover:text-white font-mono transition-colors tracking-wider uppercase border-b border-transparent hover:border-gray-500 pb-0.5" href="{{ route('login') }}">
                        Already authorized?
                    </a>

                    <button type="submit" class="px-8 py-3 bg-white text-black font-mono font-bold text-xs tracking-widest hover:bg-gray-200 transition-all hover:scale-105 active:scale-95 border border-transparent">
                        INITIALIZE ->
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Footer Protocol Message -->
        <div class="mt-8 text-[10px] font-mono text-gray-700 uppercase tracking-widest">
            Establishing New Workforce Entry
        </div>
    </div>
</body>
</html>