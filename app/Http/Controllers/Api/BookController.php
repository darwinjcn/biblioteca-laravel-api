<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * GET /books?category={category_id}
     * Lista todos los libros, con filtro opcional por categoría.
     */
    public function index(Request $request)
    {
        $books = Book::with('category')
            ->when($request->query('category'), function ($query, $categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->orderBy('title')
            ->paginate(10);

        return response()->json($books, 200);
    }

    /**
     * POST /books
     * Crea un nuevo libro asociado a una categoría.
     */
    public function store(StoreBookRequest $request)
    {
        $book = Book::create($request->validated());

        return response()->json([
            'message' => 'Libro creado correctamente.',
            'data'    => $book->load('category'),
        ], 201);
    }

    /**
     * GET /books/{id}
     */
    public function show($id)
    {
        $book = Book::with('category')->find($id);

        if (!$book) {
            return response()->json(['message' => 'Libro no encontrado.'], 404);
        }

        return response()->json($book, 200);
    }

    /**
     * PUT /books/{id}
     * Actualiza la información de un libro existente.
     */
    public function update(UpdateBookRequest $request, $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Libro no encontrado.'], 404);
        }

        $book->update($request->validated());

        return response()->json([
            'message' => 'Libro actualizado correctamente.',
            'data'    => $book->load('category'),
        ], 200);
    }

    /**
     * DELETE /books/{id}
     * Elimina un libro, verificando primero su existencia.
     */
    public function destroy($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Libro no encontrado.'], 404);
        }

        $book->delete();

        return response()->json(['message' => 'Libro eliminado correctamente.'], 200);
    }
}
