<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Models\Deposit;
use App\Models\Withdrawal;

class AdminController extends Controller // <-- Ensure this line exists
{
    public function __construct()
    {
 
    }
    
    public function index() {
        dd('Admin route accessed');
    }

    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    
   

    public function dashboard()
    {
         $totalUsers = User::count();
        return view('admin.dashboard', compact('totalUsers'));
    }

    // view All Users
    public function users()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admin.users')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    // Delete User
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return back()->with('success', 'User deleted successfully.');
    }

    // Admin Logout
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    // Show Fund Wallet Page for All Users
    public function showFundWallet()
    {
        $users = User::all();
        return view('admin.fund_wallet', compact('users'));
    }

    // Process Wallet Funding
    public function fundWallet(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:1',
        ]);

        $user = User::find($request->user_id);
        $user->wallet += $request->amount;
        $user->save();

        Transaction::create([
            'user_id' => $user->id,
            'amount' => $request->amount,
            'type' => 'credit',
            'description' => 'Wallet funded by admin',
        ]);

        return back()->with('success', 'Wallet funded successfully!');
    }

    // Toggle Ban
    public function toggleBan($id)
    {
        $user = User::findOrFail($id);
        $user->is_banned = !$user->is_banned;
        $user->save();

        return back()->with('success', 'User ban status updated.');
    }

    // nd Single User View
    public function fundUserWallet($id)
    {
        $user = User::findOrFail($id);
        return view('admin.wallet.fund-single', compact('user'));
    }
    
    public function viewWithdrawals()
{
    $withdrawals = Withdrawal::with('user')->latest()->get();
    return view('admin.withdrawals.index', compact('withdrawals'));
}

public function approveWithdrawal($id)
{
    $withdrawal = Withdrawal::findOrFail($id);
    $withdrawal->status = 'approved';
    $withdrawal->save();

    return redirect()->back()->with('success', 'Withdrawal approved successfully.');
}

  public function withdrawals()
{
    $withdrawals = Withdrawal::latest()->get();
    return view('admin.withdrawals.index', compact('withdrawals'));
}

public function deposits()
{
    $deposits = Deposit::latest()->get();
    return view('admin.deposits.index', compact('deposits'));
}

}
