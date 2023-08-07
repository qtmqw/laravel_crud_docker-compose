<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|max:60',
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

        $post = new Post();
        $post->image = $request->input('image');
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->save();

        return response()->json(['message' => 'Post created successfully'], 201);
    }

    public function index()
    {
        $posts = Post::all();
        return response()->json($posts);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|max:60',
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

        $post = Post::findOrFail($id);
        $post->image = $request->input('image');
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->save();

        return response()->json(['message' => 'Post updated successfully'], 200);
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return response()->json(['message' => 'Post deleted successfully'], 200);
    }
}