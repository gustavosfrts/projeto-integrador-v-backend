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
            'link_video' => 'https://www.youtube.com/watch?v=bZEg7Dvsf4k',
        ]);

        ImagemProduto::create([
            'caminho' => 'http://http://18.228.214.223/storage/products/kailani.png',
            'produto_id' => 1,
        ]);

        Produto::create([
            'nome' => 'NARCISO DELAY',
            'descricao' => 'Um delay stereo de alta qualidade com uma ampla gama de opções de personalização para dar ao seu som a ambiência perfeita. Com quatros modos de delays diferentes, você pode escolher desde um clássico delay analógico até um delay com pitch bem psicodélico.',
            'link' => 'https://vtreffects.com.br/produto/narciso-delay/',
            'link_video' => 'https://www.youtube.com/watch?v=hFq0ho1UbTs',
        ]);

        ImagemProduto::create([
            'caminho' => 'http://http://18.228.214.223/storage/products/narciso.png',
            'produto_id' => 2,
        ]);

        Produto::create([
            'nome' => 'HELIOS OVERDRIVE',
            'descricao' => 'O Helios Overdrive é um pedal de overdrive analógico com recursos digitais avançados. Com uma ampla gama de opções de personalização, oferece o timbre perfeito para seu som. Desde sutis saturações até drives intensos, o Helios proporciona uma resposta dinâmica e orgânica. Com recursos únicos e versatilidade excepcional, é o pedal de overdrive ideal para elevar sua expressão musical.',
            'link' => 'https://vtreffects.com.br/produto/helios-overdrive-gold-series/',
            'link_video' => 'https://www.youtube.com/watch?v=P97v6RF0lF8',
        ]);

        ImagemProduto::create([
            'caminho' => 'http://http://18.228.214.223/storage/products/helios.png',
            'produto_id' => 3,
        ]);
    }
}
