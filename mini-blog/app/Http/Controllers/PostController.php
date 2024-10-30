<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Display the list of posts
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    // Show the form for creating a new post
    public function create()
    {
        return view('posts.create');
    }

    // Store a new post
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'image' => 'image|nullable|max:2048', // Validate the image
        ]);

        if ($request->hasFile('image')) {
            $filePath = $request->file('image')->store('images', 'public');
            $validatedData['image'] = $filePath;
        }

        Post::create($validatedData);
        return redirect('/posts')->with('success', 'Post created successfully!');
    }

    // Show the form for editing a post
    public function edit($id)
    {
        $post = Post::findOrFail($id); // Find the post by ID
        return view('posts.edit', compact('post')); // Pass the post to the edit view
    }

    // Update a post
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'image' => 'image|nullable|max:2048', // Validate the image
        ]);

        $post = Post::findOrFail($id); // Find the post by ID

        if ($request->hasFile('image')) {
            // Handle the image upload
            $filePath = $request->file('image')->store('images', 'public');
            $validatedData['image'] = $filePath;
        }

        $post->update($validatedData); // Update the post with the validated data
        return redirect('/posts')->with('success', 'Post updated successfully!');
    }

    // Delete a post
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete(); // Delete the post
        return redirect('/posts')->with('success', 'Post deleted successfully!');
    }

    // Search for posts
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Search for posts by title or body
        $posts = Post::where('title', 'LIKE', "%{$query}%")
                      ->orWhere('body', 'LIKE', "%{$query}%")
                      ->get();

        return view('posts.index', compact('posts'));
    }
}
