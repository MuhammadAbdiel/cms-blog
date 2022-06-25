<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $heading = 'Posts';

        if (request()->has('category')) {
            $category = Category::where('slug', request()->category)->firstOrFail();
            $heading = "Posts in {$category->name}";
        }

        if (request()->has('author')) {
            $author = User::where('username', request()->author)->firstOrFail();
            $heading = "Posts by {$author->name}";
        }

        return view('home', [
            'title' => 'Home',
            'heading' => $heading,
            'posts' => Post::latest()->where('slug', '!=', null)->filter(request(['search', 'category', 'author']))->take(9)->get(),
        ]);
    }

    public function posts()
    {
        $heading = 'All Posts';

        if (request()->has('category')) {
            $category = Category::where('slug', request()->category)->firstOrFail();
            $heading = "Posts in {$category->name}";
        }

        if (request()->has('author')) {
            $author = User::where('username', request()->author)->firstOrFail();
            $heading = "Posts by {$author->name}";
        }

        return view('posts', [
            'title' => 'Posts',
            'heading' => $heading,
            'posts' => Post::latest()->where('slug', '!=', null)->filter(request(['search', 'category', 'author']))->paginate(9)->withQueryString(),
        ]);
    }

    public function post(Post $post)
    {
        return view('post', [
            'title' => $post->title,
            'post' => $post,
        ]);
    }

    public function categories()
    {
        return view('categories', [
            'title' => 'Categories',
            'categories' => Category::all()

        ]);
    }

    public function authors()
    {
        return view('authors', [
            'title' => 'Authors',
            'authors' => User::where('is_admin', false)->get()
        ]);
    }
}
