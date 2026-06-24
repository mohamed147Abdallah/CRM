<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AgentController extends Controller
{
    /**
     * Display the personnel roster (Active Agents list).
     * Filtered to only show operatives with 'active' status.
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Security Check: Access restricted to System Administrators
        if (!$user->isAdmin()) {
            abort(403, 'RESTRICTED AREA: Admin Clearance Required.');
        }

        // Fetch only agents with 'active' status to display in the roster
        $agents = User::where('role', 'agent')
            ->where('status', 'active')
            ->withCount('customers')
            ->latest()
            ->get();

        return view('agents.index', compact('agents'));
    }

    /**
     * Initialize a new agent account manually via Admin Terminal.
     */
    public function store(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Security Authorization
        if (!$user->isAdmin()) {
            abort(403, 'RESTRICTED AREA: Admin Clearance Required.');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', Rules\Password::defaults()],
        ]);

        // Create new account with active status by default when manually added by Admin
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'agent', 
            'status' => 'active',
        ]);

        return redirect()->route('agents.index')->with('status', 'AGENT_INITIALIZED');
    }

    /**
     * Revoke Clearance (Deactivate Agent).
     * Logic: Updates status to 'inactive' to preserve account data while removing access.
     */
    public function destroy(User $user)
    {
        /** @var \App\Models\User $currentUser */
        $currentUser = Auth::user();

        // Security Authorization
        if (!$currentUser->isAdmin()) {
            abort(403, 'RESTRICTED AREA: Admin Clearance Required.');
        }

        // Safety Protocol: Prevent Administrator from deactivating their own master account
        if ($user->id === $currentUser->id) {
            return back()->withErrors(['error' => 'PROTOCOL_ERROR: Cannot deactivate master account.']);
        }

        // Execution: Demote operative status to 'inactive'
        // The user remains in the database as an 'agent' but is excluded from active rosters.
        $user->update([
            'status' => 'inactive'
        ]);

        return redirect()->route('agents.index')->with('status', 'CLEARANCE_REVOKED: Operative deactivated.');
    }
}