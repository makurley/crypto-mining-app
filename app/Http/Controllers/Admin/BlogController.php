<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\BlogPost;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::latest()->paginate(10);
        return view('admin.blog.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.blog.create');
    }

   public function store(Request $request)
{
    $data = $request->validate([
        'title' => 'required|string|max:255',
        'category' => 'required|string|max:100',
        'body' => 'required',
        'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        'published' => 'nullable|boolean',
    ]);

    $data['slug'] = Str::slug($data['title']);
    $data['published'] = $request->has('published');
    $data['category'] = $request->input('category');

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('blogs', 'public');
    }

    BlogPost::create($data);

    return redirect()->route('admin.blogs.index')->with('success', 'Blog post created successfully.');
}


    public function edit($id)
    {
         $post = BlogPost::findOrFail($id);
    return view('admin.blog.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $post = BlogPost::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',

            'body' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'published' => 'nullable|boolean',
        ]);

        $data['slug'] = Str::slug($data['title']);
        $data['published'] = $request->has('published');
        $data['category'] = $request->input('category');
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('blogs', 'public');
        }

        $post->update($data);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog post updated successfully.');
    }
}
