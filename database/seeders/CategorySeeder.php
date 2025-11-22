<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'nome' => 'PRE AMP',
                'descricao' => 'Capturas de Pré amplificadores.',
            ],
            [
                'nome' => 'AMP',
                'descricao' => 'Capturas de Amplificadores.',
            ],
            [
                'nome' => 'AMP + CAB',
                'descricao' => 'Capturas de som de amplificadores e gabinetes.',
            ],
            [
                'nome' => 'Pedal',
                'descricao' => 'Capturas de Pedais de Efeito: Overdrive, distorção.',
            ],
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}
