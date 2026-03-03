<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        if ($categories->isEmpty()) {
            return response()->json([
                'status' => 'ok',
                'message' => 'No categories found',
                'categories' => []
            ], Response::HTTP_OK);
        }
        return response()->json([
            'status' => 'ok',
            'categories' => $categories
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|min:3',
        ]);

        // -- otra forma de crear un nuevo registro --
        // $category = new Category();
        // $category->name = $request->name;
        // $category->slug = Str::slug($request->name, '-');
        // $category->save();

        $category = Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
        ]);

        return response()->json([
            'status' => 'ok',
            'message' => 'Category created successfully',
            'category' => $category
        ], Response::HTTP_CREATED);
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

        return response()->json([
            'status' => 'ok',
            'category' => $category
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:100|min:3',
        ]);

        $category = Category::find($id);
        if (!$category) {
            return response()->json([
                'status' => 'error',
                'message' => 'Category not found'
            ], Response::HTTP_NOT_FOUND);
        }

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
        ]);


        return response()->json([
            'status' => 'ok',
            'message' => 'Category updated successfully',
            'category' => $category
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {      

        $category = Category::find($id);

        if ($category->posts()->count() > 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Category has posts ' . $category->posts()->count() . ', delete them first'
            ], Response::HTTP_NOT_FOUND);
        }

        if (!$category) {
            return response()->json([
                'status' => 'error',
                'message' => 'Category not found'
            ], Response::HTTP_NOT_FOUND);
        }

        $category->delete();

        return response()->json([
            'status' => 'ok',
            'message' => 'Category deleted successfully'
        ], Response::HTTP_OK);
    }
}
