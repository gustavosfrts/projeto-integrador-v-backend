<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Produto;
use App\Models\ImagemProduto;

class produtoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Produto::create([
            'nome' => 'KAILANI REVERB',
            'descricao' => 'Um reverb stereo de alta qualidade com uma ampla gama de opções de personalização para dar ao seu som a ambiência perfeita. Com oito modos de reverb diferentes, você pode escolher desde um ambiente natural e espaçoso até um efeito denso e imersivo.',
            'link' => 'https://vtreffects.com.br/produto/kailani-reverb/',
        ]);

        ImagemProduto::create([
            'caminho' => asset('storage/products/kailani.png'),
            'produto_id' => 1,
        ]);

        Produto::create([
            'nome' => 'NARCISO DELAY',
            'descricao' => 'Um delay stereo de alta qualidade com uma ampla gama de opções de personalização para dar ao seu som a ambiência perfeita. Com quatros modos de delays diferentes, você pode escolher desde um clássico delay analógico até um delay com pitch bem psicodélico.',
            'link' => 'https://vtreffects.com.br/produto/narciso-delay/',
        ]);

        ImagemProduto::create([
            'caminho' => asset('storage/products/narciso.png'),
            'produto_id' => 2,
        ]);
    }
}
