<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('user.profile');
    }

    public function update(Request $request)
    {
        // Validate the request
        $request->validate([
            'name'    => 'required|string|max:255',
            'username'=> 'required|string|max:255|unique:users,username,' . Auth::id(),
            'email'   => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'address' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
        ]);

        // Get the currently authenticated user
        $user = Auth::user();

        // Update the user's profile
        $user->update([
            'name'     => $request->name,
            'username' => $request->username,
            'email'    => $request->email,
            'address'  => $request->address,
            'country'  => $request->country,
        ]);

        // If the request is via AJAX, return a JSON response
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully!',
            ]);
        }

        // If the request is not AJAX, return a redirect
        return back()->with('success', 'Profile updated successfully!');
    }
}
