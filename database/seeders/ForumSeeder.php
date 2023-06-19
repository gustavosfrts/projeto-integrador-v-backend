<?php

namespace Database\Seeders;

use App\Models\Forum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ForumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Forum::create([
            'titulo' => 'Como fazer uma transferência?',
            'descricao' => 'Estou com dificuldades para fazer uma transferência, alguém pode me ajudar?',
            'usuario_id' => 1,
        ]);
        Forum::create([
            'titulo' => 'Como fazer atualização de firmware?',
            'descricao' => 'Estou com dificuldades para fazer uma atualização de firmware, alguém pode me ajudar?',
            'usuario_id' => 1,
        ]);
        Forum::create([
            'titulo' => 'Como fazer uma compra?',
            'descricao' => 'Estou com dificuldades para fazer uma compra, alguém pode me ajudar?',
            'usuario_id' => 2,
        ]);
    }
}
