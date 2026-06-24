<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvitationController extends Controller
{
    /**
     * Phase 1: Dispatch an invitation protocol (Restricted to Administrators).
     */
    public function send(Request $request)
    {
        // 1. Authorization: Verify Admin clearance level
        if (!Auth::user()->isAdmin()) {
            abort(403, 'ACCESS_DENIED: INSUFFICIENT_SECURITY_CLEARANCE');
        }

        // 2. Identification: Ensure target email exists in the system ledger
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $email = $request->email;
        $targetUser = User::where('email', $email)->first();

        // 3. Security Constraint: Administrators cannot be downgraded via this protocol
        if ($targetUser->role === 'admin') {
            return back()->withErrors(['email' => 'PROTOCOL_ERROR: Target already holds Administrator clearance.']);
        }

        /**
         * 4. THE FIX: Maintenance
         * مسح أي دعوة سابقة (سواء كانت معلقة، مقبولة، أو منتهية) لهذا الإيميل
         * لتفادي خطأ Duplicate Entry 1062 والسماح بإعادة دعوة الموظف من جديد.
         */
        Invitation::where('email', $email)->delete();

        // 5. Initialization: Create new invitation record assigned to 'agent' role
        $invitation = Invitation::create([
            'email' => $email,
            'role' => 'agent' 
        ]);

        // 6. Response: Generate the secure access link for the recipient's terminal
        $inviteLink = route('invitation.show', $invitation->token);

        return back()->with('status', 'AUTH_REQUEST_DISPATCHED_SUCCESSFULLY')
                     ->with('inviteLink', $inviteLink);
    }

    /**
     * Phase 2: Render the invitation decision terminal.
     */
    public function showInvitation($token)
    {
        $invitation = Invitation::where('token', $token)->firstOrFail();

        // Security check: Verify token integrity, status, and expiry
        if (!$invitation->isValid()) {
            abort(403, 'PROTOCOL_EXPIRED_OR_ALREADY_EXECUTED');
        }

        // Fetch target operative data for decision terminal rendering
        $user = User::where('email', $invitation->email)->firstOrFail();

        return view('auth.invitation-decision', compact('invitation', 'user'));
    }

    /**
     * Phase 3: ACCEPT Protocol execution.
     */
    public function accept(Request $request, $token)
    {
        $invitation = Invitation::where('token', $token)->firstOrFail();

        if (!$invitation->isValid()) {
            abort(403, 'UNAUTHORIZED_PROTOCOL_EXECUTION');
        }

        // Execution: Update master user table with new clearance and active status
        User::where('email', $invitation->email)->update([
            'role' => 'agent',
            'status' => 'active'
        ]);

        // Protocol Conclusion: Mark invitation as successfully accepted
        $invitation->update(['accepted' => true]);

        return redirect()->route('dashboard')->with('status', 'NODE_ACTIVATED: CLEARANCE_LEVEL_AGENT_GRANTED');
    }

    /**
     * Phase 4: REJECT Protocol execution.
     */
    public function reject(Request $request, $token)
    {
        $invitation = Invitation::where('token', $token)->firstOrFail();

        // Protocol Purge: Remove the request from the ledger
        $invitation->delete();

        return redirect('/')->with('status', 'PROTOCOL_REJECTED_BY_OPERATIVE');
    }
}