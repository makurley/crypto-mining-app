<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Make sure this is included
use Illuminate\Support\Facades\Response;
class KycController extends Controller
{
    public function submit(Request $request)
    {
        // Validate incoming data
        $request->validate([
            'kyc_document_type' => 'required|string',
            'kyc_document' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $user = auth()->user();

        try {
            // Delete old document if exists
            if ($user->kyc_document && Storage::disk('public')->exists($user->kyc_document)) {
                Storage::disk('public')->delete($user->kyc_document);
            }

            // Upload new file
            $path = $request->file('kyc_document')->store('kyc_documents', 'public');

            // Update user's KYC data
            $user->update([
                'kyc_document_type' => $request->kyc_document_type,
                'kyc_document' => $path,
                'kyc_status' => 'pending',  // Set to 'pending' for review
                'kyc_rejection_reason' => null,
            ]);

            // Redirect back with success message
            return back()->with('success', 'KYC submitted successfully. Your verification is under review.');

        } catch (\Exception $e) {
            // In case of an error, return back with error message
            return back()->with('error', 'An error occurred while submitting your KYC. Please try again.');
        }
    }
    
public function viewDocument($filename)
{
    $path = 'kyc_documents/' . $filename;

    if (!Storage::disk('public')->exists($path)) {
        abort(404, 'File not found.');
    }

    $file = Storage::disk('public')->get($path);
    $mime = Storage::disk('public')->mimeType($path);

    return response($file, 200)->header('Content-Type', $mime);
}
}
