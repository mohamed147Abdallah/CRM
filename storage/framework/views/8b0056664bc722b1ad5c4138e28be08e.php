<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="dark" id="html-root">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(config('app.name', 'Laravel')); ?> | NEXUS CRM</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,300;0,14..32,400;0,14..32,500;0,14..32,600;1,14..32,400&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        mono: ['"Space Grotesk"', 'monospace'],
                        sans: ['"Inter"', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <style>
        /* ============================================================
           NEXUS CRM — Design System v3
           Theme: Sharp & Clean | White + Indigo | Dark/Light
        ============================================================ */

        /* ── CSS Variables ── */
        :root {
            /* Light mode */
            --bg:        #f8f9fc;
            --bg-2:      #ffffff;
            --bg-3:      #f1f3f8;
            --surface:   #ffffff;
            --border:    #e4e7ef;
            --border-2:  #d0d5e8;
            --text:      #0f1629;
            --text-2:    #4a5578;
            --text-3:    #8892aa;
            --accent:    #4f46e5;
            --accent-2:  #6366f1;
            --accent-glow: rgba(79,70,229,0.15);
            --header-bg: rgba(248,249,252,0.85);
            --card-bg:   #ffffff;
            --card-shadow: 0 1px 3px rgba(15,22,41,0.06), 0 4px 16px rgba(15,22,41,0.04);
            --card-shadow-hover: 0 4px 12px rgba(15,22,41,0.1), 0 16px 40px rgba(79,70,229,0.08);
            --nav-bg:    rgba(255,255,255,0.9);
        }

        .dark {
            /* Dark mode */
            --bg:        #080b14;
            --bg-2:      #0d1120;
            --bg-3:      #111827;
            --surface:   #111827;
            --border:    rgba(255,255,255,0.07);
            --border-2:  rgba(255,255,255,0.13);
            --text:      #f0f4ff;
            --text-2:    #8892aa;
            --text-3:    #4a5578;
            --accent:    #6366f1;
            --accent-2:  #818cf8;
            --accent-glow: rgba(99,102,241,0.2);
            --header-bg: rgba(8,11,20,0.9);
            --card-bg:   #111827;
            --card-shadow: 0 1px 3px rgba(0,0,0,0.4), 0 4px 20px rgba(0,0,0,0.3);
            --card-shadow-hover: 0 4px 20px rgba(0,0,0,0.5), 0 0 40px rgba(99,102,241,0.08);
            --nav-bg:    rgba(8,11,20,0.9);
        }

        /* ── Base ── */
        html, body { background-color: var(--bg); color: var(--text); }

        body {
            font-family: 'Inter', sans-serif;
            -webkit-font-smoothing: antialiased;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        /* Light mode grid overlay */
        html:not(.dark) body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(rgba(79,70,229,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(79,70,229,0.03) 1px, transparent 1px);
            background-size: 60px 60px;
            pointer-events: none;
            z-index: 0;
        }

        /* Dark mode ambient */
        .dark body::before {
            content: '';
            position: fixed;
            inset: 0;
            background:
                radial-gradient(ellipse 70% 50% at 15% 0%, rgba(99,102,241,0.06) 0%, transparent 55%),
                radial-gradient(ellipse 50% 40% at 85% 100%, rgba(139,92,246,0.04) 0%, transparent 50%);
            pointer-events: none;
            z-index: 0;
        }

        /* ── Scrollbar ── */
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: var(--border-2); border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--accent); }

        /* ── Selection ── */
        ::selection { background: var(--accent-glow); color: var(--accent-2); }

        /* ── Card / Panel ── */
        .nx-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            box-shadow: var(--card-shadow);
            border-radius: 12px;
            transition: box-shadow 0.25s ease, border-color 0.25s ease, transform 0.25s ease;
        }
        .nx-card:hover {
            box-shadow: var(--card-shadow-hover);
            border-color: var(--border-2);
        }

        /* ── Stat Card ── */
        .nx-stat {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            transition: all 0.25s ease;
            position: relative;
            overflow: hidden;
        }
        .nx-stat:hover { transform: translateY(-2px); box-shadow: var(--card-shadow-hover); }
        .nx-stat::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, var(--accent-glow) 0%, transparent 60%);
            opacity: 0;
            transition: opacity 0.3s;
        }
        .nx-stat:hover::after { opacity: 1; }

        /* ── Badge ── */
        .nx-badge {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 3px 10px; border-radius: 20px;
            font-size: 10px; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase;
            font-family: 'Space Grotesk', monospace;
        }
        .nx-badge-blue   { background: rgba(59,130,246,0.1);  color: #3b82f6; border: 1px solid rgba(59,130,246,0.2); }
        .nx-badge-green  { background: rgba(34,197,94,0.1);   color: #22c55e; border: 1px solid rgba(34,197,94,0.2); }
        .nx-badge-yellow { background: rgba(234,179,8,0.1);   color: #ca8a04; border: 1px solid rgba(234,179,8,0.2); }
        .nx-badge-red    { background: rgba(239,68,68,0.1);   color: #ef4444; border: 1px solid rgba(239,68,68,0.2); }
        .nx-badge-gray   { background: rgba(107,114,128,0.1); color: #6b7280; border: 1px solid rgba(107,114,128,0.2); }

        /* Light-mode badge adjustments */
        html:not(.dark) .nx-badge-yellow { color: #92400e; }

        /* ── Input ── */
        .nx-input {
            width: 100%;
            background: var(--bg-3);
            border: 1.5px solid var(--border);
            color: var(--text);
            font-family: 'Space Grotesk', monospace;
            font-size: 13px;
            height: 44px;
            padding: 0 14px;
            border-radius: 8px;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
            outline: none;
        }
        .nx-input:focus {
            border-color: var(--accent);
            background: var(--bg-2);
            box-shadow: 0 0 0 3px var(--accent-glow);
        }
        .nx-input::placeholder { color: var(--text-3); }
        select.nx-input {
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 10px center;
            background-repeat: no-repeat;
            background-size: 16px;
            padding-right: 36px;
            cursor: pointer;
        }
        select.nx-input option { background: var(--bg-2); color: var(--text); }

        /* ── Button ── */
        .nx-btn-primary {
            display: inline-flex; align-items: center; justify-content: center; gap: 7px;
            padding: 0 20px; height: 40px; border-radius: 8px;
            background: var(--accent); color: white;
            font-family: 'Space Grotesk', monospace; font-size: 12px; font-weight: 700;
            letter-spacing: 0.06em; text-transform: uppercase;
            border: 1px solid transparent;
            box-shadow: 0 2px 8px rgba(79,70,229,0.25), 0 0 0 0 rgba(79,70,229,0);
            transition: all 0.2s ease; cursor: pointer;
        }
        .nx-btn-primary:hover {
            background: var(--accent-2);
            box-shadow: 0 4px 16px rgba(99,102,241,0.4), 0 0 20px rgba(99,102,241,0.15);
            transform: translateY(-1px);
        }
        .nx-btn-primary:active { transform: scale(0.97); }

        .nx-btn-ghost {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 0 14px; height: 36px; border-radius: 8px;
            color: var(--text-2); font-family: 'Space Grotesk', monospace;
            font-size: 11px; font-weight: 600; letter-spacing: 0.05em;
            background: transparent; border: 1.5px solid var(--border);
            transition: all 0.2s ease; cursor: pointer;
        }
        .nx-btn-ghost:hover { border-color: var(--accent); color: var(--accent); background: var(--accent-glow); }

        /* ── Headings ── */
        .nx-page-title {
            font-family: 'Space Grotesk', monospace;
            font-weight: 700; font-size: 22px; letter-spacing: -0.01em;
            color: var(--text);
        }
        .nx-label {
            font-family: 'Space Grotesk', monospace;
            font-size: 10px; font-weight: 700; letter-spacing: 0.12em;
            text-transform: uppercase; color: var(--text-3);
        }

        /* ── Header ── */
        .nx-header {
            background: var(--header-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
        }

        /* ── Navigation ── */
        .nx-nav {
            background: var(--nav-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
        }

        /* ── Progress bar ── */
        .nx-progress-track { height: 4px; background: var(--bg-3); border-radius: 2px; overflow: hidden; }
        .nx-progress-fill  { height: 100%; border-radius: 2px; transition: width 1.6s cubic-bezier(0.165,0.84,0.44,1); }

        /* ── Toast ── */
        #toast-notification {
            position: fixed; bottom: 28px; left: 50%;
            transform: translateX(-50%) translateY(80px);
            opacity: 0;
            transition: all 0.4s cubic-bezier(0.34,1.56,0.64,1);
            z-index: 9999;
        }
        #toast-notification.show {
            transform: translateX(-50%) translateY(0);
            opacity: 1;
        }

        /* ── Util ── */
        .font-mono-nexus { font-family: 'Space Grotesk', monospace; }
        .nx-divider { height: 1px; background: var(--border); }
        .nx-text-muted { color: var(--text-2); }
        .nx-text-faint { color: var(--text-3); }

        /* ── Theme toggle animation ── */
        #theme-toggle { transition: transform 0.3s ease; }
        #theme-toggle:hover { transform: rotate(20deg) scale(1.1); }

        /* ── Page transition ── */
        .nx-page-content {
            animation: nx-fade-up 0.4s cubic-bezier(0.4,0,0.2,1) both;
        }
        @keyframes nx-fade-up {
            from { opacity: 0; transform: translateY(12px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body class="antialiased min-h-screen" style="background: var(--bg); color: var(--text);">

    <!-- ══════════════════════════════════════════════════
         THEMATIC INTRO ANIMATION (once per session)
    ══════════════════════════════════════════════════ -->
    <div id="nx-intro" style="
        position: fixed; inset: 0; z-index: 99999;
        background: #080b14;
        display: flex; flex-direction: column;
        align-items: center; justify-content: center;
        overflow: hidden;
    ">
        <!-- Grid lines -->
        <div style="
            position: absolute; inset: 0;
            background-image: linear-gradient(rgba(99,102,241,0.08) 1px, transparent 1px),
                              linear-gradient(90deg, rgba(99,102,241,0.08) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: nx-grid-in 1.2s ease both;
        "></div>

        <!-- Glow orbs -->
        <div style="
            position: absolute; width: 500px; height: 500px; border-radius: 50%;
            background: radial-gradient(circle, rgba(99,102,241,0.15) 0%, transparent 70%);
            top: 50%; left: 50%; transform: translate(-50%,-50%);
            animation: nx-orb-pulse 2s ease-in-out infinite alternate;
        "></div>

        <!-- Logo mark -->
        <div style="
            width: 72px; height: 72px;
            border: 2px solid rgba(99,102,241,0.6);
            border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
            position: relative;
            animation: nx-logo-in 0.6s 0.2s cubic-bezier(0.34,1.56,0.64,1) both;
            box-shadow: 0 0 40px rgba(99,102,241,0.3), inset 0 0 20px rgba(99,102,241,0.1);
        " id="intro-logo">
            <div style="
                width: 28px; height: 28px; border-radius: 6px;
                background: linear-gradient(135deg, #6366f1, #818cf8);
                box-shadow: 0 0 20px rgba(99,102,241,0.6);
                animation: nx-inner-spin 2s linear infinite;
            "></div>
            <!-- Corner dots -->
            <div style="position:absolute;top:6px;right:6px;width:5px;height:5px;border-radius:50%;background:#6366f1;box-shadow:0 0 8px #6366f1;"></div>
            <div style="position:absolute;bottom:6px;left:6px;width:3px;height:3px;border-radius:50%;background:rgba(99,102,241,0.5);"></div>
        </div>

        <!-- Wordmark -->
        <div style="
            margin-top: 28px;
            font-family: 'Space Grotesk', monospace; font-weight: 700; font-size: 28px;
            letter-spacing: 0.25em; color: white; text-transform: uppercase;
            animation: nx-text-in 0.6s 0.5s ease both;
        ">
            NEXUS<span style="color:#6366f1;">_CRM</span>
        </div>

        <!-- Tagline -->
        <div style="
            margin-top: 10px;
            font-family: 'Space Grotesk', monospace; font-size: 10px; font-weight: 600;
            letter-spacing: 0.4em; color: rgba(99,102,241,0.7); text-transform: uppercase;
            animation: nx-text-in 0.6s 0.7s ease both;
        ">ENTERPRISE SUITE v2.4</div>

        <!-- Loading bar -->
        <div style="
            margin-top: 48px; width: 200px; height: 2px;
            background: rgba(255,255,255,0.06); border-radius: 2px; overflow: hidden;
            animation: nx-text-in 0.4s 0.9s ease both;
        ">
            <div id="intro-bar" style="
                height: 100%; width: 0%;
                background: linear-gradient(90deg, #6366f1, #a5b4fc);
                border-radius: 2px;
                box-shadow: 0 0 10px rgba(99,102,241,0.7);
                transition: width 1.2s cubic-bezier(0.4,0,0.2,1);
            "></div>
        </div>

        <!-- Status text -->
        <div id="intro-status" style="
            margin-top: 16px;
            font-family: 'Space Grotesk', monospace; font-size: 9px; font-weight: 600;
            letter-spacing: 0.3em; color: rgba(255,255,255,0.25); text-transform: uppercase;
            animation: nx-text-in 0.4s 1s ease both;
        ">Initializing...</div>
    </div>

    <style>
        @keyframes nx-grid-in     { from { opacity: 0; } to { opacity: 1; } }
        @keyframes nx-orb-pulse   { from { transform: translate(-50%,-50%) scale(0.8); opacity: 0.5; } to { transform: translate(-50%,-50%) scale(1.2); opacity: 1; } }
        @keyframes nx-logo-in     { from { opacity: 0; transform: scale(0.5) rotate(-10deg); } to { opacity: 1; transform: scale(1) rotate(0); } }
        @keyframes nx-inner-spin  { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
        @keyframes nx-text-in     { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes nx-intro-exit  {
            0%   { opacity: 1; transform: scale(1); }
            80%  { opacity: 1; transform: scale(1.02); }
            100% { opacity: 0; transform: scale(0.98); pointer-events: none; }
        }
        .nx-intro-leaving { animation: nx-intro-exit 0.6s cubic-bezier(0.4,0,1,1) forwards; }
    </style>

    <script>
        // Run intro only once per session
        (function() {
            var INTRO_KEY = 'nx_intro_shown';
            var intro = document.getElementById('nx-intro');
            if (sessionStorage.getItem(INTRO_KEY)) {
                // Already shown — hide instantly
                intro.style.display = 'none';
                return;
            }

            // Set theme from localStorage before intro ends
            var saved = localStorage.getItem('nx-theme');
            if (saved === 'light') document.getElementById('html-root').classList.remove('dark');

            var steps = ['Authenticating session...', 'Loading pipeline data...', 'Syncing ledger nodes...', 'System online.'];
            var bar = document.getElementById('intro-bar');
            var status = document.getElementById('intro-status');
            var stepIdx = 0;

            setTimeout(function() { bar.style.width = '35%';  status.textContent = steps[stepIdx++]; }, 200);
            setTimeout(function() { bar.style.width = '65%';  status.textContent = steps[stepIdx++]; }, 700);
            setTimeout(function() { bar.style.width = '90%';  status.textContent = steps[stepIdx++]; }, 1200);
            setTimeout(function() { bar.style.width = '100%'; status.textContent = steps[stepIdx++]; }, 1700);

            setTimeout(function() {
                intro.classList.add('nx-intro-leaving');
                sessionStorage.setItem(INTRO_KEY, '1');
                setTimeout(function() { intro.style.display = 'none'; }, 650);
            }, 2200);
        })();
    </script>
    <!-- ══ END INTRO ══ -->

    <!-- Toast -->
    <div id="toast-notification"
         class="flex items-center gap-3 px-5 py-3 font-mono-nexus shadow-2xl"
         style="background: var(--bg-2); border: 1px solid var(--border-2); border-radius: 100px; min-width: 240px;">
        <div id="toast-dot" class="w-2 h-2 rounded-full animate-pulse" style="background: var(--accent);"></div>
        <span id="toast-message" class="text-xs font-bold tracking-widest uppercase" style="color: var(--text);">System message</span>
    </div>

    <!-- App shell -->
    <div class="relative z-10 min-h-screen flex flex-col">
        <?php echo $__env->make('layouts.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <?php if(isset($header)): ?>
            <header class="nx-header">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5">
                    <?php echo e($header); ?>

                </div>
            </header>
        <?php endif; ?>

        <main class="flex-1 nx-page-content">
            <?php echo e($slot); ?>

        </main>
    </div>

    <!-- Theme toggle script -->
    <script>
        function toggleTheme() {
            var html = document.getElementById('html-root');
            if (html.classList.contains('dark')) {
                html.classList.remove('dark');
                localStorage.setItem('nx-theme', 'light');
            } else {
                html.classList.add('dark');
                localStorage.setItem('nx-theme', 'dark');
            }
            updateThemeIcon();
        }

        function updateThemeIcon() {
            var html = document.getElementById('html-root');
            var icon = document.getElementById('theme-icon');
            if (!icon) return;
            if (html.classList.contains('dark')) {
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707M17.657 17.657l-.707-.707M6.343 6.343l-.707-.707M12 7a5 5 0 100 10A5 5 0 0012 7z"/>';
            } else {
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>';
            }
        }

        // Restore theme on load
        (function() {
            var saved = localStorage.getItem('nx-theme');
            var html = document.getElementById('html-root');
            if (saved === 'light') {
                html.classList.remove('dark');
            } else {
                html.classList.add('dark'); // default dark
            }
        })();

        document.addEventListener('DOMContentLoaded', updateThemeIcon);
    </script>

    <!-- Global toast helper -->
    <script>
        function showNxToast(message, type) {
            var toast = document.getElementById('toast-notification');
            var msg   = document.getElementById('toast-message');
            var dot   = document.getElementById('toast-dot');
            msg.textContent = message;
            var colors = { success: '#22c55e', error: '#ef4444', info: '#6366f1', warn: '#f59e0b' };
            dot.style.background = colors[type] || colors.info;
            toast.classList.add('show');
            clearTimeout(window._nxToastTimer);
            window._nxToastTimer = setTimeout(function() { toast.classList.remove('show'); }, 3500);
        }
    </script>
</body>
</html><?php /**PATH C:\Users\ASUS\OneDrive\Desktop\laravel\my-crm\resources\views/layouts/app.blade.php ENDPATH**/ ?>