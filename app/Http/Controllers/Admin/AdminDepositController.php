<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deposit;

class AdminDepositController extends Controller
{
    public function index()
    {
        $deposits = Deposit::with('user')->latest()->get();
        return view('admin.deposits.index', compact('deposits'));
    }

    public function updateStatus($id, $status)
    {
        $deposit = Deposit::findOrFail($id);

        if ($deposit->status !== 'pending') {
            return back()->with('error', 'Action already taken.');
        }

        $deposit->status = $status;
        $deposit->save();

        // You can optionally notify the user here...

        return back()->with('success', 'Deposit status updated successfully.');
    }
}