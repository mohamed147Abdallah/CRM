<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Display Operative Grid (مع تفعيل البحث والفلترة)
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = Customer::query();

        // 1. نظام الصلاحيات (الأدمن يرى الجميع، الموظف يرى عملاءه فقط)
        if (!$user->isAdmin()) {
            $query->where('user_id', $user->id);
        }

        // 2. تفعيل البحث (يبحث في الاسم، الإيميل، الشركة، ورقم الهاتف)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('company', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('id', 'like', "%{$search}%");
            });
        }

        // 3. تفعيل فلتر الحالة (Status)
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // 4. جلب البيانات مع الاحتفاظ بكلمة البحث في روابط الصفحات (Pagination)
        $customers = $query->latest()->paginate(10)->withQueryString();

        return view('customers.index', compact('customers'));
    }

    // ... باقي الدوال (create, store, edit, update, destroy) تبقى كما هي بدون تغيير ...
    
    /**
     * Show form to initialize a new target
     */
    public function create()
    {
        $agents = [];
        if (Auth::user()->isAdmin()) {
            $agents = User::whereIn('role', ['admin', 'agent'])
                          ->where('status', 'active')
                          ->get();
        }

        return view('customers.create', compact('agents'));
    }

    /**
     * Store new target in the ledger
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:customers,email',
            'phone'      => 'nullable|string',
            'company'    => 'nullable|string', 
            'deal_value' => 'nullable|numeric',
            'status'     => 'required|in:new,negotiation,won,lost',
            'priority'   => 'nullable|in:standard,critical',
        ]);

        $customer = new Customer($validated);
        
        if (Auth::user()->isAdmin() && $request->filled('user_id')) {
            $customer->user_id = $request->user_id;
        } else {
            $customer->user_id = Auth::id(); 
        }

        $customer->save();

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'customer' => $customer]);
        }

        return redirect()->route('kanban');
    }

    /**
     * Display Intelligence Dossier
     */
    public function show(string $id)
    {
        $customer = Customer::findOrFail($id);
        
        if (!Auth::user()->isAdmin() && $customer->user_id !== Auth::id()) {
            abort(403, 'UNAUTHORIZED ACCESS: This operative belongs to another node.');
        }

        return view('customers.show', compact('customer'));
    }

    /**
     * Show form to modify target data
     */
    public function edit(string $id)
    {
        $customer = Customer::findOrFail($id);

        if (!Auth::user()->isAdmin() && $customer->user_id !== Auth::id()) {
            abort(403, 'UNAUTHORIZED ACCESS');
        }

        $agents = [];
        if (Auth::user()->isAdmin()) {
            $agents = User::whereIn('role', ['admin', 'agent'])
                          ->where('status', 'active')
                          ->get();
        }

        return view('customers.edit', compact('customer', 'agents'));
    }

    /**
     * Update target data in the ledger
     */
    public function update(Request $request, string $id)
    {
        $customer = Customer::findOrFail($id);

        if (!Auth::user()->isAdmin() && $customer->user_id !== Auth::id()) {
            abort(403, 'UNAUTHORIZED ACCESS');
        }
        
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:customers,email,' . $id,
            'phone'      => 'nullable|string',
            'company'    => 'nullable|string',
            'deal_value' => 'nullable|numeric',
            'status'     => 'required|in:new,negotiation,won,lost',
            'priority'   => 'nullable|in:standard,critical',
        ]);

        $customer->fill($validated);
        
        if (Auth::user()->isAdmin() && $request->filled('user_id')) {
            $customer->user_id = $request->user_id;
        } 

        $customer->save();

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'customer' => $customer]);
        }

        return redirect()->route('kanban');
    }

    /**
     * Update Status
     */
    public function updateStatus(Request $request, Customer $customer)
    {
        if (!Auth::user()->isAdmin() && $customer->user_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized Access'], 403);
        }

        $request->validate(['status' => 'required|in:new,negotiation,won,lost']);
        $customer->status = $request->status;
        $customer->save();

        return response()->json(['success' => true, 'message' => 'Node status updated']);
    }

    /**
     * Purge Target
     */
    public function destroy(Request $request, string $id)
    {
        $customer = Customer::findOrFail($id);

        if (!Auth::user()->isAdmin() && $customer->user_id !== Auth::id()) {
            abort(403, 'UNAUTHORIZED ACCESS');
        }

        $customer->delete();

        if ($request->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('kanban');
    }
}