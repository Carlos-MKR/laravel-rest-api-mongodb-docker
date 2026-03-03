<?php

namespace App\Http\Controllers;

// use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('category')->orderBy('date', 'desc')->get();
        if ($posts->isEmpty()) {
            return response()->json([
                'status' => 'ok',
                'message' => 'No posts found',
                'posts' => []
            ], Response::HTTP_OK);
        }
        return response()->json([
            'status' => 'ok',
            'posts' => $posts
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|min:3|unique:posts,name',
            'description' => 'required|string|max:255|min:10',
            'category_id' => 'required|exists:categories,_id',
        ]);

        $post = Post::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
            'description' => $request->description,
            'category_id' => $request->category_id,
            'date' => now(),
        ]);

        return response()->json([
            'status' => 'ok',
            'message' => 'Post created successfully',
            'post' => $post
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::with('category')->find($id);
        if (!$post) {
            return response()->json([
                'status' => 'error',
                'message' => 'Post not found'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'status' => 'ok',
            'post' => $post
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:100|min:3|unique:posts,name,' . $id,
            'description' => 'sometimes|required|string|max:255|min:10',
            'category_id' => 'sometimes|required|exists:categories,_id',
        ]);

        $post = Post::find($id);
        if (!$post) {
            return response()->json([
                'status' => 'error',
                'message' => 'Post not found'
            ], Response::HTTP_NOT_FOUND);
        }

        $post->update([
            'name' => $request->name ?? $post->name,
            'slug' => Str::slug($request->name ?? $post->name, '-'),
            'description' => $request->description ?? $post->description,
            'category_id' => $request->category_id ?? $post->category_id,   
        ]);

        return response()->json([
            'status' => 'ok',
            'message' => 'Post updated successfully',
            'post' => $post
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);
        if (!$post) {
            return response()->json([
                'status' => 'error',
                'message' => 'Post not found'
            ], Response::HTTP_NOT_FOUND);
        }

        $post->delete();

        return response()->json([
            'status' => 'ok',
            'message' => 'Post deleted successfully'
        ], Response::HTTP_OK);
    }
}
