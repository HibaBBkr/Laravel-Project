<?php

namespace App\Http\Controllers; // Or App\Http\Controllers\Auth if you move it

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;     // Make sure this is imported
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Auth\Events\Registered;  // Make sure this is imported
use App\Http\Controllers\Controller;   // Make sure this is imported

class AuthController extends Controller // Assuming this is your controller name
{
    public function loginSubmit(Request $request)
    {
        // Your existing loginSubmit logic is fine as it redirects to profile.show
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            // 'form_type' => 'required|in:login' // Good to keep from your modal HTML
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            // This is correct! It goes to ProfileController@show
            return redirect()->intended(route('profile.show'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->except('password'))
          ->with('open_modal', 'login'); // To help re-open modal if JS is used
    }

    public function registerSubmit(Request $request)
    {
        $role = $request->input('role');

        // Simplified validation based on your HTML structure:
        // The HTML has two separate forms, so only one set of name/email/password will be submitted.
        $commonRules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email', // Unique across all users
            'password' => 'required|string|min:8|confirmed',
            'phone_number' => 'nullable|string|max:20', // Max length for phone
            'role' => 'required|in:customer,owner',
        ];

        $ownerRules = [];
        if ($role === 'owner') {
            $ownerRules = [
                'id_card_number' => 'required|string|max:255',
                'license_file' => 'required|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048', // 2MB max
                'terms' => 'accepted',
            ];
        }

        $rules = array_merge($commonRules, $ownerRules);

        $messages = [
            'name.required' => 'The full name is required.',
            'email.required' => 'The email is required.',
            'email.unique' => 'This email has already been taken.',
            'password.required' => 'The password is required.',
            'password.confirmed' => 'The password confirmation does not match.',
            'id_card_number.required' => 'The ID card number is required for owners.',
            'license_file.required' => 'The hall ownership license file is required for owners.',
            'terms.accepted' => 'You must accept the terms and conditions to register as an owner.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput() // This will repopulate the form fields
                ->with('open_modal', 'signup') // Helper for JS to reopen modal
                ->with('failed_role', $request->input('role')); // Helper for JS to select correct tab in signup
        }

        $validatedData = $validator->validated();

        $userData = [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'], // 'hashed' cast in User model handles hashing
            'phone_number' => $validatedData['phone_number'] ?? null,
            'role' => $validatedData['role'],
            'receive_notifications' => $request->boolean('receive_notifications', true), // Default to true if not present
        ];

        if ($validatedData['role'] === 'owner') {
            $userData['id_card_number'] = $validatedData['id_card_number'];
            if ($request->hasFile('license_file')) { // Check again, though 'required' rule covers it
                $userData['license_file_path'] = $request->file('license_file')->store('licenses', 'public');
            }
        }

        // The 'password' attribute will be automatically hashed by the 'hashed' cast in your User model
        // when User::create() is called. So, no need for Hash::make() here if cast is set.
        $user = User::create($userData);

        event(new Registered($user)); // For email verification, etc.

        Auth::login($user);

        // ** THE KEY CHANGE IS HERE **
        // Redirect to the generic profile show route.
        // ProfileController@show will then handle displaying the correct view.
        return redirect()->route('profile.show')->with('success', 'Registration successful! Welcome.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('Home'); // Assuming 'Home' is your homepage route name
    }
}