<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Template;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.posts.index', [
            'title' => 'Posts',
            'posts' => Post::latest()->paginate(6)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.posts.create', [
            'title' => 'Select Template',
            'templates' => Template::latest()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post;
        $post->user_id = auth()->user()->id;
        $post->template_id = $request->id;
        $post->slug = Str::slug('post slug');
        $post->thumbnail = $request->thumbnail;
        $post->lb_content = $request->content;
        $post->save();

        return redirect('/dashboard/posts')->with('success', 'Post created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('dashboard.posts.show', [
            'title' => 'Show Post',
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('dashboard.posts.edit', [
            'title' => 'Edit Post',
            'post' => $post,
            'categories' => Category::latest()->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required',
            'thumbnail' => 'image|file|max:5120',
        ]);

        $post->user_id = auth()->user()->id;
        $post->title = $request->title;

        if ($post->slug != $request->slug) {
            $request->validate([
                'slug' => 'required|unique:posts'
            ]);
            $post->slug = $request->slug;
        }

        $post->category_id = $request->category_id;
        $post->excerpt = Str::limit(strip_tags($post->template->lb_content), 200);
        $post->lb_content = $request->content;

        $postThumbnail = explode('/', $post->thumbnail);

        if ($request->file('thumbnail')) {
            if (Storage::disk()->exists('post-thumbnails/' . $postThumbnail[1])) {
                if ($request->oldThumbnail) {
                    Storage::delete($request->oldThumbnail);
                }
            }
            $post->thumbnail = $request->file('thumbnail')->store('post-thumbnails');
        }

        $post->update();

        return redirect('/dashboard/posts')->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $postThumbnail = explode('/', $post->thumbnail);

        if (Storage::disk()->exists('post-thumbnails/' . $postThumbnail[1])) {
            if ($post->thumbnail) {
                Storage::delete($post->thumbnail);
            }
        }
        Post::destroy($post->id);
        return redirect('/dashboard/posts');
    }

    public function checkSlug(Request $request)
    {
        $slug = Str::slug($request->title);
        return response()->json(['slug' => $slug]);
    }
}
