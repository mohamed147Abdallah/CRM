<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" id="html-root">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="theme-color" content="#080b14">
    <title>NEXUS — Sign In</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ════════════════════════════════════════════════
           NEXUS — Premium Login · Mobile-First Design
        ════════════════════════════════════════════════ */

        * { box-sizing: border-box; -webkit-tap-highlight-color: transparent; }

        :root {
            --accent: #6366f1;
            --accent-light: #818cf8;
            --accent-glow: rgba(99,102,241,0.25);
            --bg: #080b14;
            --surface: #0f1322;
            --border: rgba(255,255,255,0.08);
            --border-focus: rgba(99,102,241,0.6);
            --text: #f0f4ff;
            --text-2: #8892aa;
            --text-3: #3d4663;
        }

        html, body {
            margin: 0; padding: 0;
            min-height: 100%; min-height: 100dvh;
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            -webkit-font-smoothing: antialiased;
        }

        /* ── Animated background ── */
        .bg-scene {
            position: fixed; inset: 0; z-index: 0; overflow: hidden;
        }
        .bg-scene canvas { position: absolute; inset: 0; }

        /* Gradient mesh */
        .bg-mesh {
            position: absolute; inset: 0;
            background:
                radial-gradient(ellipse 80% 60% at 20% -10%, rgba(99,102,241,0.18) 0%, transparent 55%),
                radial-gradient(ellipse 60% 50% at 80% 110%, rgba(139,92,246,0.12) 0%, transparent 50%),
                radial-gradient(ellipse 40% 40% at 50% 50%, rgba(59,130,246,0.05) 0%, transparent 60%);
        }

        /* Floating orbs */
        .orb {
            position: absolute; border-radius: 50%;
            filter: blur(60px); pointer-events: none;
        }
        .orb-1 {
            width: 300px; height: 300px; top: -80px; right: -60px;
            background: radial-gradient(circle, rgba(99,102,241,0.2) 0%, transparent 70%);
            animation: orb-float-1 8s ease-in-out infinite;
        }
        .orb-2 {
            width: 250px; height: 250px; bottom: -60px; left: -40px;
            background: radial-gradient(circle, rgba(139,92,246,0.15) 0%, transparent 70%);
            animation: orb-float-2 10s ease-in-out infinite;
        }
        .orb-3 {
            width: 180px; height: 180px; top: 40%; left: 60%;
            background: radial-gradient(circle, rgba(59,130,246,0.1) 0%, transparent 70%);
            animation: orb-float-3 12s ease-in-out infinite;
        }

        @keyframes orb-float-1 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33%       { transform: translate(-20px, 15px) scale(1.05); }
            66%       { transform: translate(10px, -10px) scale(0.95); }
        }
        @keyframes orb-float-2 {
            0%, 100% { transform: translate(0, 0); }
            50%       { transform: translate(30px, -20px); }
        }
        @keyframes orb-float-3 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            40%       { transform: translate(-15px, -20px) scale(1.1); }
            80%       { transform: translate(10px, 10px) scale(0.9); }
        }

        /* Grid overlay */
        .bg-grid {
            position: absolute; inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.025) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.025) 1px, transparent 1px);
            background-size: 44px 44px;
            mask-image: radial-gradient(ellipse 100% 80% at 50% 50%, black 30%, transparent 100%);
        }

        /* ── Page Layout ── */
        .page-wrap {
            position: relative; z-index: 10;
            min-height: 100dvh;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            padding: 24px 20px 40px;
            padding-top: max(24px, env(safe-area-inset-top));
            padding-bottom: max(40px, env(safe-area-inset-bottom));
        }

        /* ── Logo ── */
        .logo-wrap {
            display: flex; flex-direction: column; align-items: center;
            margin-bottom: 32px;
            animation: fade-up 0.5s 0.1s ease both;
        }
        .logo-icon {
            width: 64px; height: 64px; border-radius: 18px;
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 16px;
            box-shadow:
                0 0 0 1px rgba(99,102,241,0.3),
                0 4px 24px rgba(99,102,241,0.4),
                0 0 60px rgba(99,102,241,0.15);
            position: relative;
            animation: logo-breathe 4s ease-in-out infinite;
        }
        @keyframes logo-breathe {
            0%, 100% { box-shadow: 0 0 0 1px rgba(99,102,241,0.3), 0 4px 24px rgba(99,102,241,0.4), 0 0 60px rgba(99,102,241,0.15); }
            50%       { box-shadow: 0 0 0 1px rgba(99,102,241,0.5), 0 4px 32px rgba(99,102,241,0.55), 0 0 80px rgba(99,102,241,0.25); }
        }
        .logo-icon svg { position: relative; z-index: 1; }
        .logo-ring {
            position: absolute; inset: -8px; border-radius: 24px;
            border: 1px solid rgba(99,102,241,0.2);
            animation: ring-spin 8s linear infinite;
        }
        .logo-ring::before {
            content: '';
            position: absolute; width: 6px; height: 6px; border-radius: 50%;
            background: var(--accent-light);
            top: -3px; left: 50%; transform: translateX(-50%);
            box-shadow: 0 0 8px var(--accent-light);
        }
        @keyframes ring-spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }

        .logo-name {
            font-family: 'Space Grotesk', monospace;
            font-size: 24px; font-weight: 800; letter-spacing: -0.01em;
            color: var(--text);
        }
        .logo-name span { color: var(--accent-light); }

        .logo-sub {
            font-family: 'Space Grotesk', monospace;
            font-size: 10px; font-weight: 600; letter-spacing: 0.3em;
            text-transform: uppercase; color: var(--text-3);
            margin-top: 3px;
        }

        /* ── Card ── */
        .auth-card {
            width: 100%; max-width: 400px;
            background: rgba(15, 19, 34, 0.8);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 28px 24px 32px;
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            box-shadow:
                0 0 0 1px rgba(99,102,241,0.05),
                0 8px 40px rgba(0,0,0,0.5),
                0 40px 80px rgba(0,0,0,0.3);
            animation: fade-up 0.5s 0.2s ease both;
            position: relative; overflow: hidden;
        }

        /* Top shimmer */
        .auth-card::before {
            content: '';
            position: absolute; top: 0; left: 10%; right: 10%; height: 1px;
            background: linear-gradient(90deg, transparent, rgba(99,102,241,0.8), rgba(139,92,246,0.5), transparent);
        }

        /* Card inner glow */
        .auth-card::after {
            content: '';
            position: absolute; top: -60px; left: 50%;
            width: 200px; height: 200px; border-radius: 50%;
            background: radial-gradient(circle, rgba(99,102,241,0.06) 0%, transparent 70%);
            transform: translateX(-50%);
            pointer-events: none;
        }

        /* ── Card Header ── */
        .card-header { margin-bottom: 28px; }
        .card-title {
            font-family: 'Space Grotesk', monospace;
            font-size: 22px; font-weight: 700; letter-spacing: -0.02em;
            color: var(--text); margin: 0 0 4px;
        }
        .card-subtitle { font-size: 13px; color: var(--text-2); margin: 0; }

        /* ── Form Fields ── */
        .field-group { margin-bottom: 16px; }
        .field-label {
            display: block;
            font-family: 'Space Grotesk', monospace;
            font-size: 11px; font-weight: 700; letter-spacing: 0.08em;
            text-transform: uppercase; color: var(--text-2);
            margin-bottom: 8px;
            transition: color 0.2s;
        }
        .field-group:focus-within .field-label { color: var(--accent-light); }

        .field-wrap {
            position: relative;
        }
        .field-icon {
            position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
            color: var(--text-3); pointer-events: none;
            transition: color 0.2s;
        }
        .field-wrap:focus-within .field-icon { color: var(--accent-light); }

        .field-input {
            width: 100%; height: 52px;
            background: rgba(255,255,255,0.03);
            border: 1.5px solid var(--border);
            border-radius: 14px;
            color: var(--text);
            font-family: 'Inter', sans-serif;
            font-size: 15px; font-weight: 500;
            padding: 0 46px 0 44px;
            outline: none;
            transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
            -webkit-appearance: none;
        }
        .field-input:focus {
            border-color: var(--border-focus);
            background: rgba(99,102,241,0.04);
            box-shadow: 0 0 0 4px rgba(99,102,241,0.12);
        }
        .field-input::placeholder { color: var(--text-3); font-size: 14px; }

        /* Autofill override */
        .field-input:-webkit-autofill,
        .field-input:-webkit-autofill:hover,
        .field-input:-webkit-autofill:focus {
            -webkit-box-shadow: 0 0 0 50px #0f1322 inset !important;
            -webkit-text-fill-color: var(--text) !important;
            caret-color: var(--text);
        }

        /* Eye toggle for password */
        .eye-btn {
            position: absolute; right: 14px; top: 50%; transform: translateY(-50%);
            background: none; border: none; cursor: pointer;
            color: var(--text-3); padding: 4px;
            transition: color 0.2s;
        }
        .eye-btn:hover { color: var(--text-2); }

        /* Error */
        .field-error {
            margin-top: 6px; font-size: 12px; font-weight: 500;
            color: #f87171; display: flex; align-items: center; gap: 5px;
        }

        /* ── Remember / Forgot row ── */
        .form-meta {
            display: flex; align-items: center; justify-content: space-between;
            margin: 20px 0 24px;
        }
        .remember-label {
            display: flex; align-items: center; gap: 10px;
            cursor: pointer; user-select: none;
        }
        .custom-check {
            width: 20px; height: 20px; border-radius: 6px;
            border: 1.5px solid var(--border);
            background: transparent;
            display: flex; align-items: center; justify-content: center;
            transition: all 0.2s ease; flex-shrink: 0;
        }
        .custom-check input { position: absolute; opacity: 0; pointer-events: none; }
        .check-icon { opacity: 0; transform: scale(0.5); transition: all 0.2s cubic-bezier(0.34,1.56,0.64,1); }
        .remember-label:has(input:checked) .custom-check {
            background: var(--accent); border-color: var(--accent);
            box-shadow: 0 0 12px rgba(99,102,241,0.5);
        }
        .remember-label:has(input:checked) .check-icon { opacity: 1; transform: scale(1); }
        .remember-text {
            font-size: 13px; font-weight: 500; color: var(--text-2);
        }
        .forgot-link {
            font-size: 12px; font-weight: 600;
            color: var(--accent-light);
            text-decoration: none;
            padding: 4px 0;
            border-bottom: 1px solid transparent;
            transition: border-color 0.2s;
        }
        .forgot-link:hover { border-color: var(--accent-light); }

        /* ── Submit Button ── */
        .submit-btn {
            width: 100%; height: 54px;
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white; border: none; border-radius: 14px;
            font-family: 'Space Grotesk', monospace;
            font-size: 15px; font-weight: 700; letter-spacing: 0.03em;
            cursor: pointer; position: relative; overflow: hidden;
            transition: all 0.2s ease;
            box-shadow: 0 4px 20px rgba(99,102,241,0.4), 0 0 0 1px rgba(99,102,241,0.3);
        }
        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(99,102,241,0.55), 0 0 0 1px rgba(99,102,241,0.4);
        }
        .submit-btn:active { transform: scale(0.98) translateY(0); }

        /* Shimmer effect */
        .submit-btn::before {
            content: '';
            position: absolute; top: 0; left: -100%; width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.12), transparent);
            transition: left 0.5s ease;
        }
        .submit-btn:hover::before { left: 100%; }

        .btn-content { position: relative; z-index: 1; display: flex; align-items: center; justify-content: center; gap: 8px; }

        /* Loading state */
        .submit-btn.loading .btn-label { display: none; }
        .submit-btn .btn-spinner { display: none; }
        .submit-btn.loading .btn-spinner { display: block; }

        /* ── Session status ── */
        .status-msg {
            margin-bottom: 20px; padding: 12px 14px; border-radius: 12px;
            background: rgba(34,197,94,0.08); border: 1px solid rgba(34,197,94,0.25);
            display: flex; align-items: center; gap: 10px;
            font-size: 13px; font-weight: 500; color: #4ade80;
        }

        /* ── Footer ── */
        .card-footer {
            margin-top: 24px; text-align: center;
            animation: fade-up 0.5s 0.35s ease both;
        }
        .footer-text { font-size: 12px; color: var(--text-3); }
        .footer-link { color: var(--accent-light); font-weight: 600; text-decoration: none; }
        .footer-link:hover { color: white; }

        /* ── Animations ── */
        @keyframes fade-up {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ── Haptic ring on focus (mobile feel) ── */
        @media (hover: none) {
            .field-input:focus { box-shadow: 0 0 0 3px rgba(99,102,241,0.2); }
            .submit-btn:active { transform: scale(0.96); }
        }

        /* ── Notch / safe area ── */
        @supports (padding: max(0px)) {
            .page-wrap { padding-left: max(20px, env(safe-area-inset-left)); padding-right: max(20px, env(safe-area-inset-right)); }
        }
    </style>
</head>
<body>

    <!-- Background scene -->
    <div class="bg-scene">
        <div class="bg-mesh"></div>
        <div class="bg-grid"></div>
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
    </div>

    <!-- Page -->
    <div class="page-wrap">

        <!-- Logo -->
        <div class="logo-wrap">
            <div class="logo-icon">
                <div class="logo-ring"></div>
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round">
                    <path d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <div class="logo-name">NEXUS<span>_CRM</span></div>
            <div class="logo-sub">Enterprise Suite</div>
        </div>

        <!-- Auth card -->
        <div class="auth-card">

            <!-- Status message -->
            @if (session('status'))
                <div class="status-msg">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ session('status') }}
                </div>
            @endif

            <!-- Header -->
            <div class="card-header">
                <h1 class="card-title">Welcome back 👋</h1>
                <p class="card-subtitle">Sign in to your workspace</p>
            </div>

            <form method="POST" action="{{ route('login') }}" id="login-form">
                @csrf

                <!-- Email -->
                <div class="field-group">
                    <label for="email" class="field-label">Email address</label>
                    <div class="field-wrap">
                        <svg class="field-icon" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-width="1.8" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <input id="email" type="email" name="email" class="field-input"
                               value="{{ old('email') }}" required autofocus autocomplete="email"
                               placeholder="you@company.com">
                    </div>
                    @error('email')
                        <div class="field-error">
                            <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="field-group">
                    <label for="password" class="field-label">Password</label>
                    <div class="field-wrap">
                        <svg class="field-icon" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-width="1.8" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <input id="password" type="password" name="password" class="field-input"
                               required autocomplete="current-password"
                               placeholder="••••••••••">
                        <!-- Eye toggle -->
                        <button type="button" class="eye-btn" id="eye-btn" onclick="togglePassword()" title="Show/hide password">
                            <svg id="eye-icon" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-width="1.8" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <div class="field-error">
                            <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Remember + Forgot -->
                <div class="form-meta">
                    <label class="remember-label">
                        <div class="custom-check">
                            <input type="checkbox" name="remember" id="remember_me">
                            <svg class="check-icon" width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <span class="remember-text">Remember me</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-link">Forgot password?</a>
                    @endif
                </div>

                <!-- Actions -->
                <div class="flex flex-col gap-3">
                    <button type="submit" class="submit-btn" id="submit-btn">
                        <div class="btn-content">
                            <span class="btn-label">Sign In</span>
                            <svg class="btn-label" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                            <!-- Spinner -->
                            <svg class="btn-spinner animate-spin" width="20" height="20" viewBox="0 0 24 24" fill="none">
                                <circle cx="12" cy="12" r="10" stroke="rgba(255,255,255,0.25)" stroke-width="3"/>
                                <path d="M22 12a10 10 0 00-10-10" stroke="white" stroke-width="3" stroke-linecap="round"/>
                            </svg>
                        </div>
                    </button>

                    <a href="{{ route('demo.login') }}" class="w-full flex items-center justify-center h-[54px] rounded-[14px] font-mono text-[13px] font-bold tracking-widest text-white transition-all hover:bg-white/10 active:scale-[0.98]" style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.1);">
                        <svg class="w-5 h-5 mr-2 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        TRY LIVE DEMO
                    </a>
                </div>>
            </form>
        </div>

        <!-- Footer note -->
        <div class="card-footer">
            <p class="footer-text">
                Don't have an account?
                <a href="#" class="footer-link">Request access</a>
            </p>
            <p style="margin-top: 10px; font-size: 11px; color: rgba(255,255,255,0.1); font-family: 'Space Grotesk', monospace; letter-spacing: 0.15em; text-transform: uppercase;">
                Nexus · Secure Session · v2.4
            </p>
        </div>
    </div>

    <script>
        // ── Password toggle ──
        function togglePassword() {
            var inp  = document.getElementById('password');
            var icon = document.getElementById('eye-icon');
            var show = inp.type === 'password';
            inp.type = show ? 'text' : 'password';
            icon.innerHTML = show
                ? '<path stroke-linecap="round" stroke-width="1.8" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>'
                : '<path stroke-linecap="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-width="1.8" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>';
        }

        // ── Loading state on submit ──
        document.getElementById('login-form').addEventListener('submit', function() {
            var btn = document.getElementById('submit-btn');
            btn.classList.add('loading');
            btn.disabled = true;
        });

        // ── Ripple on button tap ──
        document.getElementById('submit-btn').addEventListener('pointerdown', function(e) {
            var rect = this.getBoundingClientRect();
            var ripple = document.createElement('span');
            var size = Math.max(rect.width, rect.height) * 2;
            ripple.style.cssText = `
                position: absolute;
                width: ${size}px; height: ${size}px;
                left: ${e.clientX - rect.left - size/2}px;
                top: ${e.clientY - rect.top - size/2}px;
                background: rgba(255,255,255,0.1);
                border-radius: 50%;
                transform: scale(0);
                animation: ripple 0.5s ease-out forwards;
                pointer-events: none;
            `;
            this.appendChild(ripple);
            setTimeout(() => ripple.remove(), 600);
        });
    </script>

    <style>
        @keyframes ripple {
            to { transform: scale(1); opacity: 0; }
        }
    </style>
</body>
</html>