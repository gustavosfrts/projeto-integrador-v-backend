<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto as ModelProduto;
use App\Models\Usuario;
use App\Models\UsuarioProduto;
use Exception;
use Illuminate\Support\Facades\Auth;

class Produto extends Controller
{
    function listagemProdutos(Request $request)
    {
        try {
            $response = ModelProduto::listagemProduto();
            return response()->json([
                'data' => $response,
                'error' => null
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'data' => null,
                'error' => 'Erro: ' . $e->getMessage()
            ], 500);
        }
    }
    function listagemProdutosLogado(Request $request)
    {
        try {
            $response = ModelProduto::listagemProdutoLogado(Auth::user()->id);
            return response()->json([
                'data' => $response,
                'error' => null
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'data' => null,
                'error' => 'Erro: ' . $e->getMessage()
            ], 500);
        }
    }

    function transferencia(Request $request)
    {
        try {
            $params = $request->only('usuario_produto_id', 'new_user_email');
            $new_user = Usuario::where('email', $params['new_user_email'])->first();
            if (!$new_user) {
                return response()->json([
                    'data' => null,
                    'error' => 'Usuário não encontrado'
                ], 404);
            }
            $usuario_produto = UsuarioProduto::where('id', $params['usuario_produto_id'])->first();
            if (!$usuario_produto) {
                return response()->json([
                    'data' => null,
                    'error' => 'Usuário produto não encontrado'
                ], 404);
            }
            $usuario_produto->usuario_id = $new_user->id;
            $usuario_produto->save();
            return response()->json([
                'data' => $usuario_produto,
                'error' => null
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'data' => null,
                'error' => 'Erro: ' . $e->getMessage()
            ], 500);
        }
    }
}
