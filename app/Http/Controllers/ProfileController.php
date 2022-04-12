<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('dashboard.profile.index', [
            'title' => 'Profile',
            'user' => auth()->user(),
        ]);
    }
}
