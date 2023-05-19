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
            ->select('garantias.id', 'garantias.hash', 'imagem_produtos.caminho', 'produtos.descricao', 'produtos.nome')
            ->join('garantias', 'garantias.usuario_id', '=', "usuarios.id")
            ->join('produtos', 'garantias.produto_id', '=', 'produtos.id')
            ->join('imagem_produtos', 'produtos.id', '=', 'imagem_produtos.produto_id')
            ->where('usuarios.id', '=', $userId)
            ->get();
        return $response;
    }
}
