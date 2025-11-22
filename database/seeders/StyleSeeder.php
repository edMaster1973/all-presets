<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StyleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $styles = [
            [
                'nome' => 'Rock',
                'descricao' => 'Estilo musical caracterizado por ritmos fortes e guitarras elétricas.',
                'segment_id' => 1,
            ],
            [
                'nome' => 'Metal',
                'descricao' => 'Estilo musical pesado com guitarras distorcidas e baterias intensas.',
                'segment_id' => 1,
            ],
            [
                'nome' => 'Pop',
                'descricao' => 'Estilo musical popular com melodias cativantes e produção acessível.',
                'segment_id' => 1,
            ],
            [
                'nome' => 'Blues',
                'descricao' => 'Estilo musical que expressa emoções profundas através de melodias e letras.',
                'segment_id' => 1,
            ],
            [
                'nome' => 'Country',
                'descricao' => 'Estilo musical que combina elementos folclóricos e tradicionais.',
                'segment_id' => 1,
            ],
            [
                'nome' => 'Jazz',
                'descricao' => 'Estilo musical conhecido por sua improvisação e complexidade harmônica.',
                'segment_id' => 1,
            ],
            [
                'nome' => 'Fusion',
                'descricao' => 'Estilo musical que combina elementos de diferentes gêneros, criando uma sonoridade única.',
                'segment_id' => 1,
            ],
            [
                'nome' => 'Folk',
                'descricao' => 'Folk é um estilo atemporal que conecta o ouvinte com histórias humanas profundas, usando uma sonoridade geralmente suave, orgânica e acústica.',
                'segment_id' => 1,
            ],
            [
                'nome' => 'Funk',
                'descricao' => 'Estilo musical rítmico e dançante com ênfase na linha de baixo.',
                'segment_id' => 1,
            ],
            [
                'nome' => 'Punk',
                'descricao' => 'Estilo musical agressivo e direto, frequentemente associado a atitudes rebeldes.',
                'segment_id' => 1,
            ],
            [
                'nome' => 'Acústico',
                'descricao' => 'Estilo musical caracterizado pelo uso de instrumentos acústicos e sonoridade suave.',
                'segment_id' => 1,
            ],
            [
                'nome' => 'Reggae',
                'descricao' => 'Estilo musical originário da Jamaica, conhecido por seu ritmo relaxado e mensagens sociais.',
                'segment_id' => 1,
            ],
            [
                'nome' => 'Clássico',
                'descricao' => 'Estilo musical que abrange composições orquestrais e tradicionais.',
                'segment_id' => 1,
            ],
            [
                'nome' => 'Eletrônico',
                'descricao' => 'Estilo musical que utiliza instrumentos eletrônicos e tecnologia de produção.',
                'segment_id' => 1,
            ],
            [
                'nome' => 'Outros',
                'descricao' => 'Estilo musical que não se encaixa em nenhuma das categorias acima.',
                'segment_id' => 1,
            ],
            [
                'nome' => 'Clean',
                'descricao' => 'Som Limpo.',
                'segment_id' => 2,
            ],
            [
                'nome' => 'Hi Gain',
                'descricao' => 'Som com ganho elevado, ideal para solos de guitarra.',
                'segment_id' => 2,
            ],
            [
                'nome' => 'Distortion',
                'descricao' => 'Som com ganho elevado, ideal para solos de guitarra.',
                'segment_id' => 2,
            ],
            [
                'nome' => 'Overdrive',
                'descricao' => 'Som transparente, que preserva as características do timbre original.',
                'segment_id' => 2,
            ],

        ];
        foreach ($styles as $style) {
            \App\Models\Style::create($style);
        }
    }
}
