<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PostCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json([
                'status' => 'error',
                'message' => 'Category not found'
            ], Response::HTTP_NOT_FOUND);
        }

        $data = Post::with('category')->where('category_id', $id)->orderBy('date', 'desc')->get();

        if ($data->isEmpty()) {
            return response()->json([
                'status' => 'ok',
                'message' => 'No posts found',
                'category' => $category,
                'posts' => []
            ], Response::HTTP_OK);
        }

        return response()->json([
            'status' => 'ok',
            'category' => $category,
            'total_posts' => $data->count(),
            'posts' => $data,
        ], Response::HTTP_OK);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
