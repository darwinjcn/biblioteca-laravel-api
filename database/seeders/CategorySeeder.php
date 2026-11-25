<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Literatura Salvadoreña',
            'Infantil y Juvenil',
            'Historia y Cultura',
            'Académico y Educación',
            'Ciencia y Tecnología',
        ];

        foreach ($categories as $name) {
            Category::firstOrCreate(['name' => $name]);
        }
    }
}
