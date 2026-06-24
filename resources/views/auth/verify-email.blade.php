<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NEXUS | Identity Verification</title>

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
<body class="font-sans antialiased overflow-x-hidden selection:bg-blue-600 selection:text-white">

    <!-- Background -->
    <div class="fixed inset-0 pointer-events-none">
        <div class="aurora-blob w-[600px] h-[600px] bg-blue-900/15 top-[-20%] left-[-10%] rounded-full"></div>
        <div class="aurora-blob w-[500px] h-[500px] bg-indigo-900/10 bottom-[-10%] right-[-10%] rounded-full animation-delay-2000"></div>
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
                <h1 class="font-mono font-bold text-2xl tracking-[0.2em] text-white mt-4">NEXUS<span class="text-gray-600">_VERIFY</span></h1>
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
                Action Required: Pending Verification
            </div>

            <div class="mb-8 text-sm font-mono text-gray-400 leading-relaxed">
                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
            </div>

            <!-- Session Status -->
            @if (session('status') == 'verification-link-sent')
                <div class="mb-6 font-mono text-xs font-medium text-green-400 border border-green-500/20 bg-green-500/5 p-4">
                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                </div>
            @endif

            <div class="flex flex-col space-y-6">
                <!-- Resend Email Form -->
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="w-full px-8 py-3 bg-white text-black font-mono font-bold text-xs tracking-widest hover:bg-gray-200 transition-all hover:scale-[1.02] active:scale-95 border border-transparent">
                        RESEND_PROTOCOL_LINK ->
                    </button>
                </form>

                <!-- Logout Form -->
                <form method="POST" action="{{ route('logout') }}" class="text-center">
                    @csrf
                    <button type="submit" class="text-[10px] text-gray-600 hover:text-red-400 font-mono transition-colors tracking-wider uppercase border-b border-transparent hover:border-red-500/50 pb-0.5">
                        {{ __('Abort Session (Log Out)') }}
                    </button>
                </form>
            </div>
        </div>
        
        <div class="mt-8 text-[10px] font-mono text-gray-700 uppercase tracking-widest">
            Awaiting_Client_Response...
        </div>
    </div>
</body>
</html>