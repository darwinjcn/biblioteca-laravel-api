<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_lists_books_and_filters_by_category(): void
    {
        $catA = Category::create(['name' => 'Literatura']);
        $catB = Category::create(['name' => 'Infantil']);
        Book::create(['title' => 'Cuentos de Cipotes', 'author' => 'Salarrué', 'published_year' => 1945, 'category_id' => $catA->id]);
        Book::create(['title' => 'El principito', 'author' => 'Saint-Exupéry', 'published_year' => 1943, 'category_id' => $catB->id]);

        $this->getJson('/api/books')->assertOk()->assertJsonCount(2, 'data');
        $this->getJson('/api/books?category=' . $catA->id)->assertOk()->assertJsonCount(1, 'data');
    }

    public function test_creates_book_with_validation(): void
    {
        $cat = Category::create(['name' => 'Historia']);

        $this->postJson('/api/books', [
            'title' => 'Hi', 'author' => '', 'published_year' => 9999, 'category_id' => 999,
        ])->assertStatus(422);

        $this->postJson('/api/books', [
            'title' => 'Historia de El Salvador', 'author' => 'T. Chicas', 'published_year' => 2015, 'category_id' => $cat->id,
        ])->assertStatus(201);
    }

    public function test_deletes_book_and_blocks_category_with_books(): void
    {
        $cat = Category::create(['name' => 'Poesía']);
        $book = Book::create(['title' => 'Poemas clandestinos', 'author' => 'Roque Dalton', 'published_year' => 1968, 'category_id' => $cat->id]);

        $this->deleteJson('/api/books/' . $book->id)->assertOk();
        $this->deleteJson('/api/categories/' . $cat->id)->assertOk();

        $cat2 = Category::create(['name' => 'Novela']);
        Book::create(['title' => 'El asco', 'author' => 'H. C. Moya', 'published_year' => 1997, 'category_id' => $cat2->id]);
        $this->deleteJson('/api/categories/' . $cat2->id)->assertStatus(409);
    }
}
