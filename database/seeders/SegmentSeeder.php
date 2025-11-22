<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SegmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $segments = [
            [
                'id' => 1,
                'nome' => 'Presets',
                'descricao' => 'Configurações pré-definidas que otimizam o desempenho de equipamentos eletrônicos.',
            ],
            [
                'id' => 2,
                'nome' => 'Tones',
                'descricao' => 'Timbragem de equipamentos combinando diferentes características sonoras.',
            ],
            [
                'id' => 3,
                'nome' => 'IRs',
                'descricao' => 'Impulse Response - Unidades que combinam múltiplos efeitos em um único dispositivo, permitindo aos músicos acessar uma variedade de sons e texturas.',
            ],
            [
                'id' => 4,
                'nome' => 'Clones',
                'descricao' => 'Arquivos de capturas que replicam o som de equipamentos clássicos, permitindo aos músicos acessar timbres icônicos.',
            ],
        ];

        foreach ($segments as $segment) {
            \App\Models\Segment::create($segment);
        }
    }
}
