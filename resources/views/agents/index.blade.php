<x-app-layout>
@push('styles')
<style>
/* ── Personnel / Agents Page ── */
.ag-panel {
    background: var(--card-bg);
    border: 1px solid var(--border);
    border-radius: 14px;
    box-shadow: var(--card-shadow);
}

.ag-table th {
    font-family: 'Space Grotesk', monospace;
    font-size: 9px; font-weight: 700; letter-spacing: 0.16em;
    text-transform: uppercase; color: var(--text-3);
    padding: 11px 16px; border-bottom: 1px solid var(--border);
    background: var(--bg-3); text-align: left;
}
.ag-table th:first-child { padding-left: 20px; border-radius: 8px 0 0 0; }
.ag-table th:last-child  { border-radius: 0 8px 0 0; }
.ag-table td { padding: 14px 16px; border-bottom: 1px solid var(--border); vertical-align: middle; }
.ag-table td:first-child { padding-left: 20px; }
.ag-table tbody tr { transition: background 0.15s; }
.ag-table tbody tr:hover { background: var(--bg-3); }
.ag-table tbody tr:last-child td { border-bottom: none; }
</style>
@endpush

<x-slot name="header">
    <div class="flex items-center gap-4">
        <div class="w-1 h-8 rounded-full" style="background: linear-gradient(180deg, #8b5cf6, #6366f1);"></div>
        <div>
            <h1 class="nx-page-title">Personnel</h1>
            <p class="text-xs mt-0.5 font-mono-nexus font-semibold tracking-widest uppercase" style="color: #8b5cf6;">Admin Clearance Required</p>
        </div>
    </div>
</x-slot>

<div class="py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto" style="min-height: calc(100vh - 130px);">

    {{-- Status notification --}}
    @if(session('status'))
        <div class="flex items-center gap-3 px-4 py-3 mb-6 rounded-10 text-xs font-mono-nexus font-semibold tracking-wide"
             style="background: rgba(34,197,94,0.08); border: 1px solid rgba(34,197,94,0.25); color: #22c55e; border-radius: 10px;">
            <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
            {{ session('status') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- ── Active Operatives Table ── --}}
        <div class="lg:col-span-2 ag-panel overflow-hidden">
            <div class="flex items-center gap-3 px-5 py-4" style="border-bottom: 1px solid var(--border);">
                <div class="w-1.5 h-5 rounded-full" style="background: linear-gradient(180deg, #8b5cf6, #6366f1);"></div>
                <h3 class="font-mono-nexus font-bold text-sm tracking-wide" style="color: var(--text);">Active Operatives</h3>
                <span class="nx-badge" style="background: rgba(139,92,246,0.1); color: #8b5cf6; border: 1px solid rgba(139,92,246,0.2);">
                    {{ $agents->count() }} agents
                </span>
            </div>

            <table class="w-full ag-table">
                <thead>
                    <tr>
                        <th>Node ID</th>
                        <th>Identity</th>
                        <th>Clearance</th>
                        <th>Workload</th>
                        <th style="text-align: right; padding-right: 20px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($agents as $agent)
                        <tr>
                            <td>
                                <span class="font-mono-nexus text-xs font-bold" style="color: #8b5cf6;">
                                    #AGT-{{ str_pad($agent->id, 3, '0', STR_PAD_LEFT) }}
                                </span>
                            </td>
                            <td>
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg flex items-center justify-center text-xs font-bold text-white flex-shrink-0"
                                         style="background: linear-gradient(135deg, #6366f1, #8b5cf6);">
                                        {{ substr($agent->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="font-semibold text-sm" style="color: var(--text);">{{ $agent->name }}</div>
                                        <div class="text-xs" style="color: var(--text-3);">{{ $agent->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($agent->isAdmin())
                                    <span class="nx-badge nx-badge-red">Admin</span>
                                @else
                                    <span class="nx-badge nx-badge-blue">Agent</span>
                                @endif
                            </td>
                            <td>
                                <span class="font-mono-nexus text-xs font-bold px-2.5 py-1 rounded-lg"
                                      style="background: var(--bg-3); border: 1px solid var(--border); color: var(--text-2);">
                                    {{ $agent->customers_count ?? 0 }} customers
                                </span>
                            </td>
                            <td style="text-align: right; padding-right: 20px;">
                                @if($agent->id !== auth()->id())
                                    <form action="{{ route('agents.destroy', $agent->id) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                                class="font-mono-nexus text-xs font-bold uppercase tracking-wider transition-colors px-3 py-1.5 rounded-lg"
                                                style="color: #ef4444; border: 1px solid rgba(239,68,68,0.2); background: transparent;"
                                                onmouseover="this.style.background='rgba(239,68,68,0.08)'; this.style.borderColor='rgba(239,68,68,0.4)';"
                                                onmouseout="this.style.background='transparent'; this.style.borderColor='rgba(239,68,68,0.2)';"
                                                onclick="return confirm('Remove this agent permanently?')">
                                            Remove
                                        </button>
                                    </form>
                                @else
                                    <span class="text-xs font-mono-nexus" style="color: var(--text-3);">You</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-16 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: var(--border-2);">
                                        <path stroke-linecap="round" stroke-width="1.2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <span class="text-sm font-semibold" style="color: var(--text-3);">No agents yet</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- ── Invite Panel ── --}}
        <div class="space-y-5">
            <div class="ag-panel p-6 overflow-hidden" style="border-top: 3px solid #8b5cf6;">
                <div class="flex items-center gap-2 mb-5">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: #8b5cf6;">
                        <path stroke-linecap="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <h3 class="font-mono-nexus font-bold text-sm tracking-wide" style="color: var(--text);">Invite Agent</h3>
                </div>

                <form method="POST" action="{{ route('agents.invite.send') }}" class="space-y-4">
                    @csrf
                    <input type="hidden" name="role" value="agent">

                    <div>
                        <label class="nx-label block mb-2">Email Address</label>
                        <input type="email" name="email" required
                               class="nx-input" placeholder="agent@company.com">
                        @error('email')
                            <p class="text-xs mt-1.5 font-semibold" style="color: #ef4444;">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="nx-btn-primary" style="width: 100%; height: 42px; margin-top: 4px;">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                        Send Invitation
                    </button>
                </form>

                {{-- Invite link --}}
                @if(session('inviteLink'))
                    <div class="mt-5 pt-5" style="border-top: 1px solid var(--border);">
                        <p class="nx-label mb-2">Invite Link Ready</p>
                        <div class="flex items-center gap-2">
                            <input type="text" readonly
                                   value="{{ session('inviteLink') }}"
                                   id="invite-link-input"
                                   class="nx-input text-xs"
                                   style="font-size: 10px; height: 36px; border-color: rgba(139,92,246,0.4);">
                            <button onclick="copyInviteLink()" title="Copy link"
                                    class="flex-shrink-0 w-9 h-9 rounded-lg flex items-center justify-center transition-all"
                                    style="background: rgba(139,92,246,0.1); border: 1px solid rgba(139,92,246,0.3); color: #8b5cf6;"
                                    onmouseover="this.style.background='rgba(139,92,246,0.2)'"
                                    onmouseout="this.style.background='rgba(139,92,246,0.1)'">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                </svg>
                            </button>
                        </div>
                        <p class="text-xs mt-2" style="color: var(--text-3);">Expires in 72 hours</p>
                    </div>
                @endif
            </div>

            {{-- Info card --}}
            <div class="ag-panel p-5" style="border-left: 3px solid rgba(99,102,241,0.5);">
                <div class="space-y-3 text-xs" style="color: var(--text-2);">
                    <div class="flex items-start gap-2">
                        <svg class="w-3.5 h-3.5 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: var(--accent);"><path stroke-linecap="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Invited agents can manage their own customers only.
                    </div>
                    <div class="flex items-start gap-2">
                        <svg class="w-3.5 h-3.5 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: var(--accent);"><path stroke-linecap="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        Admin access is granted manually only.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function copyInviteLink() {
    var el = document.getElementById('invite-link-input');
    el.select(); el.setSelectionRange(0, 99999);
    document.execCommand('copy');
    if (typeof showNxToast === 'function') showNxToast('Link copied!', 'success');
}
</script>
</x-app-layout>