<?php

namespace Database\Seeders;

use App\Models\LikeComentario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LikeComentarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LikeComentario::create([
            'usuario_id' => 1,
            'comentario_id' => 1,
        ]);
        LikeComentario::create([
            'usuario_id' => 2,
            'comentario_id' => 1,
        ]);
        LikeComentario::create([
            'usuario_id' => 1,
            'comentario_id' => 2,
        ]);
        LikeComentario::create([
            'usuario_id' => 2,
            'comentario_id' => 3,
        ]);
    }
}
