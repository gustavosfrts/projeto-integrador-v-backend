<?php

namespace Database\Seeders;

use App\Models\ImagemProduto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImagemPerfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ImagemProduto::create([
            'usuario_id' => 1,
            'caminho' => 'http://18.228.214.223/storage/imagem_perfil/gierot_gay.jpeg',
        ]);
    }
}
