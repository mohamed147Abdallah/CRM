<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\InvitationController;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes (NEXUS CRM Core)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// 1. Dashboard (Command Center)
Route::get('/dashboard', function (Request $request) {
    /** @var \App\Models\User $user */
    $user = $request->user();
    $query = Customer::with('user'); 
    
    // Privacy Logic: Agents only see their nodes, Admins see all
    if (!$user->isAdmin()) {
        $query->where('user_id', $user->id);
    }
    
    return view('dashboard', [
        'total_customers' => (clone $query)->count(),
        'new_customers' => (clone $query)->where('status', 'new')->count(),
        'won_customers' => (clone $query)->where('status', 'won')->count(),
        'negotiation_customers' => (clone $query)->where('status', 'negotiation')->count(),
        'latest_customers' => (clone $query)->latest()->take(5)->get(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

// 2. Mission Control (Kanban / Tactical Grid)
Route::get('/kanban', function (Request $request) {
    /** @var \App\Models\User $user */
    $user = $request->user();
   
    $query = Customer::with('user'); 
    
    if (!$user->isAdmin()) {
        $query->where('user_id', $user->id);
    }
    
    return view('customers.kanban', [
        'new_leads' => (clone $query)->where('status', 'new')->latest()->get(),
        'negotiations' => (clone $query)->where('status', 'negotiation')->latest()->get(),
        'won_deals' => (clone $query)->where('status', 'won')->latest()->get(),
        'lost_deals' => (clone $query)->where('status', 'lost')->latest()->get(),
    ]);
})->middleware(['auth', 'verified'])->name('kanban');

// 3. Personnel Management (Admin Restricted)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/personnel', [AgentController::class, 'index'])->name('agents.index');
    Route::post('/personnel', [AgentController::class, 'store'])->name('agents.store');
    Route::delete('/personnel/{user}', [AgentController::class, 'destroy'])->name('agents.destroy');

    // Invitation Protocol Dispatch
    Route::post('/invite-operative', [InvitationController::class, 'send'])->name('agents.invite.send');
});

// 4. Invitation Decision Interface (Public Guest/User Access)
Route::get('/join/{token}', [InvitationController::class, 'showInvitation'])->name('invitation.show');
Route::post('/join/{token}/accept', [InvitationController::class, 'accept'])->name('invitation.accept');
Route::post('/join/{token}/reject', [InvitationController::class, 'reject'])->name('invitation.reject');

// 5. Operative Resources (Customers & Intel Notes)
Route::resource('customers', CustomerController::class)->middleware(['auth', 'verified']);

Route::post('/customers/{customer}/notes', function (Request $request, Customer $customer) {
    $request->validate(['content' => 'required|string']);
    // تم استبدال auth()->id() بـ $request->user()->id لإرضاء إضافة Intelephense
    $customer->notes()->create(['user_id' => $request->user()->id, 'content' => $request->content]);
    return back()->with('status', 'INTEL_LOGGED_SUCCESSFULLY');
})->middleware(['auth'])->name('customers.notes.store');

Route::patch('/customers/{customer}/update-status', [CustomerController::class, 'updateStatus'])
    ->middleware(['auth', 'verified'])->name('customers.update-status');

// 6. User Profile Protocol
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 7. Demo Login Route for Portfolio
Route::get('/demo-login', function () {
    $user = \App\Models\User::where('email', 'admin@nexus.com')->first();
    if ($user) {
        \Illuminate\Support\Facades\Auth::login($user);
    }
    return redirect()->route('dashboard');
})->name('demo.login');

require __DIR__.'/auth.php';