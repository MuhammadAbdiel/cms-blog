<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        return view('dashboard.profile.index', [
            'title' => 'Profile',
            'user' => auth()->user(),
        ]);
    }

    public function update(Request $request, User $user)
    {
        $validateData = $request->validate([
            'profileImage' => 'required|image|file|max:5120'
        ]);

        if ($request->file('profileImage')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validateData['profileImage'] =  $request->file('profileImage')->store('profile-image');
        }

        User::where('id', $user->id)->update($validateData);

        return redirect('/dashboard/profile/user')->with('success', 'Profile image updated successfully!');
    }
}
