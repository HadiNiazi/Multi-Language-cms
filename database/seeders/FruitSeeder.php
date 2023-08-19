<?php

namespace Database\Seeders;

use App\Models\Fruit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FruitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Fruit::create([
            'title' => 'Fruits are awesome',
            'heading_title_1' => 'Heading title 1',
            'heading_title_2' => 'Heading title 2',
            'heading_title_3' => 'Heading title 3',
            'is_visible' => rand(0, 1)
        ]);

    }
}
