<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index_profile()
    {
        $user = Auth::users();
        return view('profile', compact('user'));
    }
    public function editProfile()
{
    $user = Auth::user();
    return view('editProfile', compact('user'));
}

public function updateProfile(Request $request)
{
    $request->validate([
        'username' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
        'password' => 'nullable|string|min:5|confirmed',
    ]);

    /** @var \App\Models\User $user **/
    $user = Auth::user();
    $user->username = $request->input('username');
    $user->email = $request->input('email');

    if ($request->filled('password')) {
        $user->password = Hash::make($request->input('password'));
    }
    if ($user->isDirty()) {
        History::create([
            'user_id' => Auth::id(),
            'product_id' => 0,
            'action' => 'Ubah Profil',
            'quantity' => 0,
            'details' => "Berhasil melakukan perubahan profil ",
            'action_time' => now(),
        ]);
    }
    $user->save();

    return redirect()->route('showProfile')->with('success', 'Profile updated successfully!');
}

}
