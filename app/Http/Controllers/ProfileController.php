<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
   public function show()
{
    $user = Auth::user();
    if (!$user) {
        // This usually won't be hit if you have ->middleware('auth') on the route,
        // as the middleware would redirect to login first.
        return redirect()->route('login');
    }
    if ($user->role === 'customer') {
        // Path: resources/views/customer/custprofile.blade.php
        return view('customer.custprofile', ['user' => $user]);
    } elseif ($user->role === 'owner') {
        // Path: resources/views/owner/ownerprofile.blade.php
        return view('owner.ownerprofile', ['user' => $user]);
    } else {
         abort(403, 'You do not have a profile page associated with your account type.');
    }
}

    // ... update method remains the same
    public function update(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'phone_number' => 'nullable|string|max:20',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'receive_notifications' => 'nullable|boolean',
        ]);

        $updateData = $validatedData;

        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }
            $path = $request->file('profile_photo')->store('profile_pictures', 'public');
            $updateData['profile_photo_path'] = $path;
        }

        $updateData['receive_notifications'] = $request->boolean('receive_notifications');

        $user->update($updateData);

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
    }
}