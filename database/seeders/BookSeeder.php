<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $literatura = Category::where('name', 'Literatura Salvadoreña')->first()->id;
        $infantil   = Category::where('name', 'Infantil y Juvenil')->first()->id;
        $historia   = Category::where('name', 'Historia y Cultura')->first()->id;
        $academico  = Category::where('name', 'Académico y Educación')->first()->id;
        $ciencia    = Category::where('name', 'Ciencia y Tecnología')->first()->id;

        $books = [
            [
                'title' => 'Cuentos de Cipotes',
                'author' => 'Salarrué (Salvador Salazar Arrué)',
                'description' => 'Colección de relatos sobre la infancia en El Salvador.',
                'published_year' => 1945,
                'category_id' => $infantil,
            ],
            [
                'title' => 'Cuentos de Barro',
                'author' => 'Salarrué',
                'description' => 'Relatos costumbristas de la vida rural salvadoreña.',
                'published_year' => 1933,
                'category_id' => $literatura,
            ],
            [
                'title' => 'Un día en la vida',
                'author' => 'Manlio Argueta',
                'description' => 'Novela sobre la guerra civil salvadoreña vista desde una comunidad rural.',
                'published_year' => 1980,
                'category_id' => $literatura,
            ],
            [
                'title' => 'Poemas clandestinos',
                'author' => 'Roque Dalton',
                'description' => 'Poesía escrita durante su estancia en prisión.',
                'published_year' => 1968,
                'category_id' => $literatura,
            ],
            [
                'title' => 'Sobrevivo',
                'author' => 'Claribel Alegría',
                'description' => 'Poemario dedicado a su hermana, refugiada política.',
                'published_year' => 1978,
                'category_id' => $literatura,
            ],
            [
                'title' => 'El asco',
                'author' => 'Horacio Castellanos Moya',
                'description' => 'Novela controvertida sobre el regreso de un exiliado a El Salvador.',
                'published_year' => 1997,
                'category_id' => $literatura,
            ],
            [
                'title' => 'Historia de El Salvador',
                'author' => 'Tomás A. Chicas',
                'description' => 'Síntesis de la historia nacional desde la época precolombina.',
                'published_year' => 2015,
                'category_id' => $historia,
            ],
            [
                'title' => 'Matemáticas para bachillerato',
                'author' => 'Ministerio de Educación de El Salvador',
                'description' => 'Texto escolar oficial para segundo ciclo de educación básica.',
                'published_year' => 2020,
                'category_id' => $academico,
            ],
            [
                'title' => 'Introducción a la programación con Python',
                'author' => 'Carlos Membreño',
                'description' => 'Guía práctica de algoritmos y programación para estudiantes salvadoreños.',
                'published_year' => 2022,
                'category_id' => $ciencia,
            ],
        ];

        foreach ($books as $book) {
            Book::firstOrCreate(
                ['title' => $book['title'], 'author' => $book['author']],
                $book
            );
        }
    }
}
