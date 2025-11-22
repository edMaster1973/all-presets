<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $marcas = [
            [
                'id' => 1,
                'nome' => 'Kemper Amplification',
                'descricao' => 'Kemper Amplification é uma empresa alemã conhecida por seus amplificadores de guitarra digital inovadores e de alta qualidade.',
            ],
            [
                'id' => 2,
                'nome' => 'Neural DSP',
                'descricao' => 'Neural DSP é uma empresa conhecida por seus plugins de simulação de amplificadores e efeitos para guitarra, oferecendo qualidade de estúdio em um formato digital.',
            ],
            [
                'id' => 3,
                'nome' => 'Fractal Audio',
                'descricao' => 'Fractal Audio é uma empresa americana conhecida por seus processadores de efeitos e amplificadores digitais de alta qualidade para guitarristas.',
            ],
            [
                'id' => 4,
                'nome' => 'Line 6',
                'descricao' => 'Line 6 é uma empresa americana que fabrica equipamentos de áudio, incluindo amplificadores, pedais de efeito e processadores digitais para guitarras e baixos.',
            ],
            [
                'id' => 5,
                'nome' => 'Boss',
                'descricao' => 'Boss é uma marca japonesa famosa por seus pedais de efeito para guitarra e baixo, oferecendo uma ampla gama de efeitos clássicos e modernos.',
            ],
            [
                'id' => 6,
                'nome' => 'Hotone',
                'descricao' => 'Hotone Audio é uma fabricante chinesa de equipamentos de áudio, incluindo amplificadores de guitarra e pedais de efeito, conhecida por seu design compacto e recursos inovadores.',
            ],
            [
                'id' => 7,
                'nome' => 'Sonicake',
                'descricao' => 'Sonicake é uma fabricante chinesa de pedais de efeito para guitarra, conhecida por seus designs únicos e sons inspirados em amplificadores clássicos.',
            ],
            [
                'id' => 8,
                'nome' => 'Nux',
                'descricao' => 'Nux é uma fabricante chinesa de equipamentos de áudio, incluindo amplificadores de guitarra e pedais de efeito, conhecida por seu design compacto e recursos inovadores.',
            ],
            [
                'id' => 9,
                'nome' => 'Mooer',
                'descricao' => 'Mooer é uma fabricante chinesa de pedais de efeito e amplificadores de guitarra, conhecida por seus designs compactos e inovações tecnológicas.',
            ],
            [
                'id' => 10,
                'nome' => 'Joyo',
                'descricao' => 'Joyo é uma fabricante chinesa de pedais de efeito e amplificadores de guitarra, conhecida por seus produtos acessíveis e de boa qualidade.',
            ],
            [
                'id' => 11,
                'nome' => 'Flamma',
                'descricao' => 'Flamma é uma fabricante chinesa de equipamentos de áudio, incluindo amplificadores de guitarra e pedais de efeito, conhecida por seu design compacto e recursos inovadores.',
            ],
            [
                'id' => 12,
                'nome' => 'M-vave',
                'descricao' => 'M-vave é uma fabricante de amplificadores de guitarra e equipamentos musicais, famosa por seu som distinto e designs clássicos.',
            ],
            [
                'id' => 13,
                'nome' => 'Valeton',
                'descricao' => 'Valeton é uma fabricante chinesa de equipamentos de áudio, incluindo amplificadores de guitarra e pedais de efeito, conhecida por seu design compacto e recursos inovadores.',
            ],
        ];

        foreach ($marcas as $marca) {
            \App\Models\Marca::create($marca);
        }
    }
}
