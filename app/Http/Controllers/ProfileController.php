<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    // Show profile
    public function show()
    {
        $user = User::findOrFail(Session::get('user_id'));
        return view('profile.show', compact('user'));
    }

    // Update profile
    public function update(Request $request)
    {
        $user = User::findOrFail(Session::get('user_id'));

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Update session name
        Session::put('user_name', $user->name);

        return back()->with('success', 'Profile updated successfully!');
    }
}