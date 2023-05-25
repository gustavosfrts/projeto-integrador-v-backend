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
                    ->select('produtos.id','produtos.nome', 'produtos.descricao', 'imagem_produtos.caminho', 'produtos.link_video', 'produtos.link')
                    ->join('imagem_produtos', 'produtos.id', '=', 'imagem_produtos.produto_id')
                    ->get();
        return $response;
    }

    static function listagemProdutoLogado($userId){
        $response = DB::table('usuarios')
            ->select('produtos.id','usuario_produtos.id as usuario_produto_id', 'produtos.nome', 'produtos.descricao', 'imagem_produtos.caminho', 'produtos.link_video', 'produtos.link')
            ->join('usuario_produtos', 'usuario_produtos.usuario_id', '=', "usuarios.id")
            ->join('produtos', 'usuario_produtos.produto_id', '=', 'produtos.id')
            ->join('imagem_produtos', 'produtos.id', '=', 'imagem_produtos.produto_id')
            ->where('usuarios.id', '=', $userId)
            ->get();
        return $response;
    }
}
