<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * GET /categories
     */
    public function index()
    {
        $categories = Category::withCount('books')->orderBy('name')->get();

        return response()->json($categories, 200);
    }

    /**
     * POST /categories
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create($request->validated());

        return response()->json([
            'message' => 'Categoría creada correctamente.',
            'data'    => $category,
        ], 201);
    }

    /**
     * DELETE /categories/{id}
     * Solo permite eliminar si la categoría no tiene libros asociados.
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Categoría no encontrada.'], 404);
        }

        if ($category->books()->exists()) {
            return response()->json([
                'message' => 'No se puede eliminar la categoría porque tiene libros asociados.',
            ], 409); // 409 Conflict
        }

        $category->delete();

        return response()->json(['message' => 'Categoría eliminada correctamente.'], 200);
    }
}
