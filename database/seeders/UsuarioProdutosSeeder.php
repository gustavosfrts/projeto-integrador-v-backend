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
            'data_compra' => '2021-05-21'
        ]);
        UsuarioProduto::create([
            'usuario_id' => 1,
            'produto_id' => 2,
            'data_compra' => '2020-12-25'
        ]);
        UsuarioProduto::create([
            'usuario_id' => 1,
            'produto_id' => 3,
            'data_compra' => '2020-06-01',
            'primeiro_usuario' => false,
        ]);
        UsuarioProduto::create([
            'usuario_id' => 1,
            'produto_id' => 3,
            'data_compra' => '2023-06-01',
            'primeiro_usuario' => false,
        ]);
    }
}
