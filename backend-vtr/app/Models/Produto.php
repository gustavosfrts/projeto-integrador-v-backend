<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Produto extends Model
{
    use HasFactory;

    static function listagemProduto(){
        $response = DB::table('produtos')
                    ->select('produtos.nome', 'produtos.descricao', 'imagem_produtos.caminho')
                    ->join('imagem_produtos', 'produtos.id', '=', 'imagem_produtos.produto_id')
                    ->get();
        return $response;
    }
}
