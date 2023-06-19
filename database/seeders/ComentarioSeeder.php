<?php

namespace Database\Seeders;

use App\Models\Comentario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComentarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Comentario::create([
            'comentario' => 'Tenho esse produto e estou tentando fazer transferencia para meu amigo, mas não estou conseguindo.',
            'usuario_id' => 1,
            'forum_id' => 1,
            'comentario_id' => null,
        ]);
        Comentario::create([
            'comentario' => 'Olá, você pode fazer uma transferência indo em Transferência > Nova Transferência',
            'usuario_id' => 2,
            'forum_id' => 1,
            'comentario_id' => null,
        ]);
        Comentario::create([
            'comentario' => 'Obrigado, consegui fazer a transferência.',
            'usuario_id' => 1,
            'forum_id' => 1,
            'comentario_id' => 2,
        ]);
        Comentario::create([
            'comentario' => 'Tenho esse produto e estou tentando fazer atualização de firmware, mas não estou conseguindo.',
            'usuario_id' => 1,
            'forum_id' => 2,
            'comentario_id' => null,
        ]);
        Comentario::create([
            'comentario' => 'Olá, você pode fazer uma atualização de firmware indo em Atualização de Firmware > Nova Atualização de Firmware',
            'usuario_id' => 2,
            'forum_id' => 2,
            'comentario_id' => null,
        ]);
        Comentario::create([
            'comentario' => 'Obrigado, consegui fazer a atualização de firmware.',
            'usuario_id' => 1,
            'forum_id' => 2,
            'comentario_id' => 5,
        ]);
        Comentario::create([
            'comentario' => 'Tenho esse produto e estou tentando fazer uma compra, mas não estou conseguindo.',
            'usuario_id' => 2,
            'forum_id' => 3,
            'comentario_id' => null,
        ]);
        Comentario::create([
            'comentario' => 'Olá, você pode fazer uma compra indo em Compra > Nova Compra',
            'usuario_id' => 1,
            'forum_id' => 3,
            'comentario_id' => null,
        ]);
        Comentario::create([
            'comentario' => 'Obrigado, consegui fazer a compra.',
            'usuario_id' => 2,
            'forum_id' => 3,
            'comentario_id' => 8,
        ]);
    }
}
