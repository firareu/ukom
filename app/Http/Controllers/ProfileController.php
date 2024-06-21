<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // validate user input
        $request->user()->fill($request->validated());

        // if user change email, make user verify their email
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // save updated user data
        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // validate user input
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        // query current user
        $user = $request->user();

        // make user logged out from system
        Auth::logout();

        // delete user record from database
        $user->delete();

        // remove and invalidate session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
