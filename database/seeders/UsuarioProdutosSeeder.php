<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UsuarioProduto;

class UsuarioProdutosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UsuarioProduto::create([
            'usuario_id' => 1,
            'produto_id' => 1,
        ]);
        UsuarioProduto::create([
            'usuario_id' => 1,
            'produto_id' => 2,
        ]);
        UsuarioProduto::create([
            'usuario_id' => 1,
            'produto_id' => 3,
        ]);
        UsuarioProduto::create([
            'usuario_id' => 1,
            'produto_id' => 3,
            'primeiro_usuario' => false,
        ]);
    }
}
