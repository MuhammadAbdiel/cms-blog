<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Template;
use Illuminate\Http\Request;

class DashboardHomeController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'title' => 'Home',
            'posts' => Post::all()->count(),
            'categories' => Category::all()->count(),
            'authors' => User::all()->count(),
            'templates' => Template::all()->count()
        ]);
    }
}
