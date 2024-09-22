<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request): View
    {
        return view('resetpassword', ['request' => $request]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    public function sendResetLinkEmail(Request $request)
    {
        // Validate the email
        $request->validate([
            'email' => 'required|email'
        ]);

        // Attempt to send the password reset link
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // Check if the email was successfully sent
        if ($status == Password::RESET_LINK_SENT) {
            return back()->with('status', __($status));
        }

        // Handle failure to send reset link
        return back()->withErrors(['email' => __($status)]);
    }
}
