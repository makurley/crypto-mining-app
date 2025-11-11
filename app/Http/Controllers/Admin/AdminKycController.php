<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminKycController extends Controller
{
    // Show all users with KYC submissions
    public function index()
    {
        $kycUsers = User::whereNotNull('kyc_document')->latest()->get();
        return view('admin.kyc.index', compact('kycUsers'));
    }

    // Approve KYC
    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'kyc_status' => 'approved',
            'kyc_rejection_reason' => null,
        ]);

        return back()->with('success', "user->name}'s KYC has been approved.");
    }

    // Reject KYC with reason
    public function reject(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string|max:1000',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'kyc_status' => 'rejected',
            'kyc_rejection_reason' => $request->reason,
        ]);

        return back()->with('error', "$user->name}'s KYC has been rejected.");
    }
}
