<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $rules = [
            'name' => 'required|max:255',
        ];

        if ($request->username != $user->username) {
            $rules['username'] = 'required|max:255|unique:users';
        }

        if ($request->email != $user->email) {
            $rules['email'] = 'required|email|max:255|unique:users';
        }

        $validateData = $request->validate($rules);
        User::where('id', $user->id)->update($validateData);

        return redirect('/dashboard/profile')->with('success', 'User Profile updated successfully!');
    }

    public function updateImage(Request $request)
    {
        $validateData = $request->validate([
            'imageProfile' => 'required|image|file|max:5120'
        ]);

        if ($request->file('imageProfile')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validateData['imageProfile'] =  $request->file('imageProfile')->store('profile-image');
        }

        User::where('id', auth()->user()->id)->update($validateData);

        return redirect('/dashboard/profile')->with('success', 'Profile image updated successfully!');
    }

    public function deleteImage()
    {
        $user = auth()->user();

        if ($user->imageProfile) {
            Storage::delete($user->imageProfile);
        }

        User::where('id', $user->id)->update([
            'imageProfile' => null
        ]);

        return redirect('/dashboard/profile');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|min:5|max:255',
            'new_password' => 'required|min:5|max:255',
            'renew_password' => 'required|same:new_password'
        ]);

        if (Hash::check($request->current_password, auth()->user()->password)) {
            User::where('id', auth()->user()->id)->update([
                'password' => bcrypt($request->new_password)
            ]);

            return redirect('/dashboard/profile')->with('success', "Password has been updated!");
        }

        return back()->with('error', "Old password doesn't matched!");
    }
}
