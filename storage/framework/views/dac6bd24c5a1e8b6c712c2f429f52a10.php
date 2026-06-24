<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="dark scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NEXUS | Enterprise CRM</title>

    <!-- Fonts: Inter & Space Grotesk (Sharp & Technical) -->
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
                        mono: ['"Space Grotesk"', 'monospace'], // For headings (Sharp)
                        sans: ['"Inter"', 'sans-serif'], // For body (Clean)
                    },
                    colors: {
                        black: '#030303', // Deepest Black
                        zinc: {
                            850: '#1f1f22',
                            900: '#18181b',
                            950: '#09090b',
                        },
                        brand: {
                            500: '#ffffff', // White is the new brand color for sharpness
                            accent: '#3b82f6', // Electric Blue for tiny details
                        }
                    },
                    backgroundImage: {
                        'gradient-glow': 'conic-gradient(from 180deg at 50% 50%, #2a8af6 0deg, #a853ba 180deg, #e92a67 360deg)',
                    },
                    animation: {
                        'aurora': 'aurora 10s linear infinite',
                        'pulse-slow': 'pulse 6s cubic-bezier(0.4, 0, 0.6, 1) infinite',
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
        /* Smooth Scroll & Selection */
        html { scroll-behavior: smooth; }
        ::selection { background: #3b82f6; color: white; }
        
        /* Aurora Background Effect */
        .aurora-blob {
            position: absolute;
            filter: blur(80px);
            opacity: 0.4;
            z-index: 0;
            animation: aurora 15s infinite alternate;
        }

        /* Glassmorphism that doesn't look cheap */
        .glass-nav {
            background: rgba(3, 3, 3, 0.6);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .glass-card {
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.03) 0%, rgba(255, 255, 255, 0.01) 100%);
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .glass-card:hover {
            border-color: rgba(255, 255, 255, 0.15);
            transform: translateY(-2px);
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.05) 0%, rgba(255, 255, 255, 0.02) 100%);
            box-shadow: 0 20px 40px -10px rgba(0,0,0,0.5);
        }

        /* Text Gradient for Headings */
        .text-gradient-silver {
            background: linear-gradient(to bottom right, #fff 30%, #9ca3af 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body class="bg-black text-white font-sans antialiased overflow-x-hidden">

    <!-- Ambient Living Background -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="aurora-blob w-[500px] h-[500px] bg-blue-900/30 top-[-10%] left-[20%] rounded-full"></div>
        <div class="aurora-blob w-[400px] h-[400px] bg-purple-900/20 bottom-[10%] right-[10%] rounded-full animation-delay-2000"></div>
        <!-- Grid Overlay -->
        <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 brightness-100 contrast-150"></div>
        <div class="absolute inset-0" style="background-image: linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px), linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px); background-size: 60px 60px; mask-image: linear-gradient(to bottom, transparent, black 20%, black 80%, transparent);"></div>
    </div>

    <!-- Sharp Navbar -->
    <nav class="fixed top-0 w-full z-50 glass-nav">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <div class="flex items-center gap-4 group cursor-pointer">
                <div class="w-8 h-8 border border-white/20 flex items-center justify-center rotate-45 group-hover:rotate-0 transition-transform duration-500 bg-white/5">
                    <div class="w-2 h-2 bg-white rounded-full"></div>
                </div>
                <span class="font-mono font-bold text-xl tracking-wider text-white">NEXUS<span class="text-gray-500">_CRM</span></span>
            </div>

            <div class="hidden md:flex items-center gap-8">
                <?php if(Route::has('login')): ?>
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(url('/dashboard')); ?>" class="text-sm font-mono text-gray-400 hover:text-white transition-colors">DASHBOARD</a>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" class="text-sm font-mono text-gray-400 hover:text-white transition-colors relative group">
                            LOG IN
                            <span class="absolute -bottom-1 left-0 w-0 h-px bg-white transition-all group-hover:w-full"></span>
                        </a>
                        <?php if(Route::has('register')): ?>
                            <a href="<?php echo e(route('register')); ?>" class="group relative px-6 py-2 bg-white text-black font-mono font-bold text-sm hover:bg-gray-200 transition-all clip-path-slant">
                                GET ACCESS
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative z-10 min-h-screen flex flex-col justify-center items-center pt-20">
        <div class="max-w-5xl mx-auto px-6 text-center">
            
            <!-- Dynamic Badge -->
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-none border border-white/10 bg-white/5 backdrop-blur mb-10 group hover:border-white/30 transition-colors cursor-default">
                <span class="w-1.5 h-1.5 bg-green-500 animate-pulse"></span>
                <span class="text-xs font-mono text-gray-300 tracking-widest uppercase">System Operational v2.4</span>
            </div>

            <!-- Main Heading with Sharp Typography -->
            <h1 class="font-mono font-bold text-6xl md:text-8xl leading-none tracking-tighter mb-8">
                <span class="text-gradient-silver block">TOTAL</span>
                <span class="text-gradient-silver block">CONTROL</span>
            </h1>

            <p class="max-w-xl mx-auto text-lg text-gray-400 mb-12 font-light leading-relaxed">
                The CRM for teams who demand precision. Zero latency, infinite scalability, and a UI designed for high-velocity sales.
            </p>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
                <?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(url('/dashboard')); ?>" class="w-full sm:w-auto px-10 py-4 bg-white text-black font-mono font-bold tracking-wide hover:bg-gray-200 transition-all hover:scale-105 active:scale-95">
                        ENTER DASHBOARD ->
                    </a>
                <?php else: ?>
                    <a href="<?php echo e(route('register')); ?>" class="w-full sm:w-auto px-10 py-4 bg-white text-black font-mono font-bold tracking-wide hover:bg-gray-200 transition-all hover:scale-105 active:scale-95">
                        START TRIAL ->
                    </a>
                <?php endif; ?>
                <a href="#features" class="w-full sm:w-auto px-10 py-4 border border-white/20 text-white font-mono hover:bg-white/5 transition-all">
                    SYSTEM SPECS
                </a>
            </div>

            <!-- Abstract UI Visualization -->
            <div class="mt-24 relative w-full max-w-4xl mx-auto perspective-1000">
                <!-- Floating Card -->
                <div class="relative bg-[#050505] border border-white/10 aspect-video rounded-sm overflow-hidden shadow-2xl shadow-blue-900/10 transform rotate-x-6 hover:rotate-x-0 transition-transform duration-1000 ease-out">
                    <!-- Fake UI Header -->
                    <div class="h-12 border-b border-white/5 flex items-center justify-between px-6 bg-white/5">
                        <div class="flex gap-2">
                            <div class="w-20 h-2 bg-white/10 rounded-full"></div>
                            <div class="w-10 h-2 bg-white/10 rounded-full"></div>
                        </div>
                        <div class="w-3 h-3 border border-white/20 rounded-full"></div>
                    </div>
                    <!-- Fake UI Body -->
                    <div class="p-8 flex gap-8 h-full">
                        <!-- Sidebar -->
                        <div class="w-48 border-r border-white/5 space-y-4 hidden sm:block">
                            <div class="h-8 w-full bg-white/10 rounded-sm"></div>
                            <div class="h-4 w-2/3 bg-white/5 rounded-sm"></div>
                            <div class="h-4 w-1/2 bg-white/5 rounded-sm"></div>
                            <div class="h-4 w-3/4 bg-white/5 rounded-sm"></div>
                        </div>
                        <!-- Content -->
                        <div class="flex-1 space-y-6">
                            <div class="flex justify-between items-end">
                                <div class="space-y-2">
                                    <div class="h-4 w-32 bg-white/5 rounded-sm"></div>
                                    <div class="h-8 w-64 bg-gradient-to-r from-blue-600 to-purple-600 rounded-sm"></div>
                                </div>
                                <div class="h-12 w-12 border border-white/10 rounded-full flex items-center justify-center">
                                    <div class="w-6 h-6 border-2 border-white/80 rounded-full border-t-transparent animate-spin"></div>
                                </div>
                            </div>
                            <!-- Grid -->
                            <div class="grid grid-cols-3 gap-4 mt-8">
                                <div class="h-24 border border-white/5 bg-white/5 rounded-sm hover:border-blue-500/50 transition-colors"></div>
                                <div class="h-24 border border-white/5 bg-white/5 rounded-sm hover:border-purple-500/50 transition-colors"></div>
                                <div class="h-24 border border-white/5 bg-white/5 rounded-sm hover:border-pink-500/50 transition-colors"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Glow Effect underneath -->
                <div class="absolute -bottom-10 left-0 right-0 h-40 bg-blue-600/20 blur-[100px] pointer-events-none"></div>
            </div>
        </div>
    </section>

    <!-- Features Section (Bento Grid) -->
    <section id="features" class="relative z-10 py-32 border-t border-white/5 bg-[#030303]">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6">
                <div>
                    <h2 class="font-mono text-3xl md:text-4xl font-bold mb-4">SYSTEM MODULES</h2>
                    <p class="text-gray-500 max-w-md">Engineered components designed for maximum efficiency and minimal friction.</p>
                </div>
                <div class="h-px bg-white/20 w-full md:w-auto md:flex-1 ml-0 md:ml-12"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Large Feature -->
                <div class="md:col-span-2 glass-card p-10 min-h-[400px] flex flex-col justify-between group">
                    <div>
                        <div class="w-12 h-12 border border-white/10 bg-white/5 flex items-center justify-center mb-6 group-hover:bg-white group-hover:text-black transition-all duration-300">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="square" stroke-linejoin="miter" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        </div>
                        <h3 class="font-mono text-2xl font-bold mb-4">Pipeline Velocity</h3>
                        <p class="text-gray-400 max-w-lg leading-relaxed">
                            Visualize deal flow with a high-fidelity Kanban board. Drag, drop, and automate stage transitions with zero lag.
                        </p>
                    </div>
                    <!-- Decorative Line -->
                    <div class="w-full h-px bg-gradient-to-r from-transparent via-white/20 to-transparent mt-8 group-hover:via-white/50 transition-all"></div>
                </div>

                <!-- Vertical Feature -->
                <div class="glass-card p-10 flex flex-col justify-center group relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative z-10">
                        <div class="mb-6 font-mono text-blue-400 text-sm tracking-widest">DATABASE</div>
                        <h3 class="font-mono text-2xl font-bold mb-4 text-white">Unified Ledger</h3>
                        <p class="text-gray-400 text-sm leading-relaxed">
                            Single source of truth for all client interactions, emails, and logs.
                        </p>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="glass-card p-10 group">
                    <div class="flex items-center justify-between mb-8">
                        <h3 class="font-mono text-xl font-bold">Analytics</h3>
                        <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-center gap-3 text-sm text-gray-400 group-hover:text-white transition-colors">
                            <span class="w-1 h-1 bg-white rounded-full"></span> Real-time Revenue
                        </div>
                        <div class="flex items-center gap-3 text-sm text-gray-400 group-hover:text-white transition-colors">
                            <span class="w-1 h-1 bg-white rounded-full"></span> Conversion Rates
                        </div>
                        <div class="flex items-center gap-3 text-sm text-gray-400 group-hover:text-white transition-colors">
                            <span class="w-1 h-1 bg-white rounded-full"></span> Team Performance
                        </div>
                    </div>
                </div>

                <!-- Feature 4 -->
                <div class="md:col-span-2 glass-card p-10 flex items-center justify-between group">
                    <div>
                        <h3 class="font-mono text-2xl font-bold mb-2">API First</h3>
                        <p class="text-gray-400">Integrate with your existing stack via our REST API.</p>
                    </div>
                    <div class="w-16 h-16 border border-white/10 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform bg-white/5">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="square" stroke-linejoin="miter" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <footer class="border-t border-white/10 bg-black py-12">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-6">
            <span class="font-mono font-bold text-lg tracking-wider">NEXUS_CRM</span>
            <div class="text-gray-600 text-sm font-mono">
                SYSTEM STATUS: <span class="text-green-500">OPTIMAL</span>
            </div>
            <p class="text-gray-600 text-xs font-mono">© <?php echo e(date('Y')); ?> ALL RIGHTS RESERVED.</p>
        </div>
    </footer>

</body>
</html><?php /**PATH C:\Users\ASUS\OneDrive\Desktop\laravel\my-crm\resources\views/welcome.blade.php ENDPATH**/ ?>