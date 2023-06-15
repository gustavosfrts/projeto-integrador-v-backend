<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Garantia extends Model
{
    use HasFactory;
    static function listagemGarantias($userId)
    {
        $response = DB::table('usuarios')
            ->select("usuario_produtos.id as usuario_produto_id", 'garantias.id', 'garantias.hash', 'imagem_produtos.caminho', 'produtos.descricao', 'produtos.nome', 'usuario_produtos.primeiro_usuario')
            ->join('garantias', 'garantias.usuario_id', '=', "usuarios.id")
            ->join('usuario_produtos', 'garantias.usuario_produto_id', 'usuario_produtos.id')
            ->join('produtos', 'usuario_produtos.produto_id', '=', 'produtos.id')
            ->join('imagem_produtos', 'produtos.id', '=', 'imagem_produtos.produto_id')
            ->where('usuarios.id', '=', $userId)
            ->get();
        return $response;
    }
}
