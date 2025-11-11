<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password; // Import the Password facade
use App\Models\User;
use App\Models\ReferralReward;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password as PasswordFacade;
use Illuminate\Http\RedirectResponse;


class AuthController extends Controller
{
    public function showLogin() {
        return view('auth.login');
    }

 public function login(Request $request)
{
    // Validate the login request
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    $credentials = $request->only('email', 'password');

    \Log::info('Login attempt with credentials:', $credentials);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        $user = Auth::user();

      return $user->role === 'admin'
    ? redirect()->route('admin.dashboard')
    : redirect()->route('dashboard');
    }

    \Log::warning('Login failed for email: ' . $request->email);

    return back()->withErrors(['email' => 'Invalid login credentials'])->withInput();
}

    public function showRegister() {
        return view('auth.register');
    }

public function register(Request $request)
{
    $request->validate([
        'username' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    // Find referrer by referral_code, not ID
    $referrer = null;
    if ($request->has('ref')) {
        $referrer = User::where('referral_code', $request->ref)->first();
    }

    // Create the user
    $user = User::create([
        'username' => $request->username,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'user',
        'referral_code' => strtoupper(Str::random(10)),
        'referred_by' => $referrer ? $referrer->id : null,
        ]);

    // Optional: send email verification
    $user->sendEmailVerificationNotification();

    Auth::login($user);
   return redirect()->route('verification.notice');
}

    public function showForgotPassword()
    {
        // Return the view for the forgot password form
        return view('auth.forgot-password');
    }

 public function sendResetLink(Request $request)
{
    // Validate the email
    $request->validate(['email' => 'required|email']);

    // Check if the email exists in the users table
    $user = User::where('email', $request->email)->first();

    if (!$user) {
        // If user not found, return an error
        return back()->withErrors(['email' => 'Email is not registered.']);
    }

    // If user exists, send the password reset link
    $status = Password::sendResetLink($request->only('email'));

    return $status === Password::RESET_LINK_SENT
        ? back()->with('status', __('Password reset link sent!'))
        : back()->withErrors(['email' => __('Unable to send reset link.')]);
}

    public function showResetPassword($token)
    {
        // Return the view for the reset password form
        return view('auth.reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
            'token' => 'required',
        ]);

        // Reset the password
        $status = PasswordFacade::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
                event(new PasswordReset($user));
            }
        );

        return $status === PasswordFacade::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __('Password has been reset!'))
            : back()->withErrors(['email' => __('Unable to reset password.')]);
    }

    public function logout() {
        Auth::logout();
        session()->flush();
        return redirect('/');
    }
    public function showRegistrationForm(Request $request)
{
    session(['ref' => $request->query('ref')]);
    return view('auth.register');
}

    public function resendVerificationEmail(Request $request): RedirectResponse
    {
        $user = Auth::user();

        if (!$user) {
            return back()->with('error', 'You must be logged in.');
        }

        if ($user->hasVerifiedEmail()) {
            return back()->with('error', 'Your email is already verified.');
        }

        try {
            $user->sendEmailVerificationNotification();
            return back()->with('status', 'Email verification link sent.');
        } catch (\Exception $e) {
            \Log::error('Failed to send verification email: ' . $e->getMessage());
            return back()->with('error', 'Not successful, try again.');
        }
    }


public function sendVerificationEmail(Request $request)
{
    $user = Auth::user();

    if ($user && !$user->hasVerifiedEmail()) {
        $user->sendEmailVerificationNotification();
        return redirect()->back()->with('status', 'Email verification link has been sent to your email.');

    }

    return back()->with('error', 'Email verification failed. Try again.');
}


}