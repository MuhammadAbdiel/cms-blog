<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreTemplateRequest;
use App\Http\Requests\UpdateTemplateRequest;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.templates.index', [
            'title' => 'Templates',
            'templates' => Template::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.templates.create', [
            'title' => 'Create Template',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTemplateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:templates|max:255',
            'thumbnail' => 'image|file|max:5120',
            'content' => 'required'
        ]);

        $template = new Template;
        $template->user_id = auth()->user()->id;
        $template->name = $request->name;
        $template->lb_content = $request->content;

        if ($request->file('thumbnail')) {
            $template->thumbnail = $request->file('thumbnail')->store('template-thumbnails');
        }

        $template->save();

        return redirect('/dashboard/templates')->with('success', 'Template created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function show(Template $template)
    {
        return view('dashboard.templates.show', [
            'title' => 'Show Template',
            'template' => $template,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function edit(Template $template)
    {
        return view('dashboard.templates.edit', [
            'title' => 'Edit Template',
            'template' => $template,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTemplateRequest  $request
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Template $template)
    {
        $request->validate([
            'thumbnail' => 'image|file|max:5120',
            'content' => 'required'
        ]);

        if ($template->name != $request->name) {
            $request->validate([
                'name' => 'required|unique:templates|max:255',
            ]);

            $template->name = $request->name;
        }

        if ($request->file('thumbnail')) {
            if ($request->oldThumbnail) {
                Storage::delete($request->oldThumbnail);
            }
            $template->thumbnail = $request->file('thumbnail')->store('template-thumbnails');
        }

        $template->lb_content = $request->content;
        $template->update();

        return redirect('/dashboard/templates')->with('success', 'Template updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function destroy(Template $template)
    {
        if ($template->thumbnail) {
            Storage::delete($template->thumbnail);
        }
        Template::destroy($template->id);
        return redirect('/dashboard/templates');
    }
}
