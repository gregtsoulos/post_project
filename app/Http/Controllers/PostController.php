<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\Post;

class PostController extends Controller
{

    public function index()
{
    $posts = Post::all();
    return view('posts.index', compact('posts'));
}

public function create()
{
    return view('posts.create');
}

public function store(Request $request)
{
    $validatedData = $request->validate([
        'status' => 'required',
        'title' => 'required',
        'post_text' => 'required',
        'publish_date' => 'required|date',
        'approval' => 'required',
        'hashtags' => 'nullable',
        'brand' => 'nullable',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    if ($request->hasFile('photo')) {
        $image = $request->file('photo');
        $name = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/images/posts');
        $image->move($destinationPath, $name);
        $validatedData['photo'] = $name;
    }

    Post::create($validatedData);

    return redirect()->route('posts.index')
        ->with('success', 'Post created successfully.');
}

public function edit(Post $post)
{
    return view('posts.edit', compact('post'));
}

public function update(Request $request, Post $post)
{
    $validatedData = $request->validate([
        'status' => 'required',
        'title' => 'required',
        'post_text' => 'required',
        'publish_date' => 'required|date',
        'approval' => 'required',
        'hashtags' => 'nullable',
        'brand' => 'nullable',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    if ($request->hasFile('photo')) {
        $image = $request->file('photo');
        $name = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/images/posts');
        $image->move($destinationPath, $name);
        $validatedData['photo'] = $name;
    }

    $post->update($validatedData);

    return redirect()->route('posts.index')
        ->with('success', 'Post updated successfully');
}

public function destroy(Post $post)
{
    $post->delete();

    return redirect()->route('posts.index');
}

}
