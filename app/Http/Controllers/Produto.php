<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Produto as ModelProduto;
use App\Models\Usuario;
use App\Models\UsuarioProduto;
use App\Models\Garantia;
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

            if($usuario_produto->primeiro_usuario) {
                $usuario_produto->data_compra = date('Y-m-d', strtotime(date("Y-m-d"). ' + 1 years'));
            }

            $usuario_produto->usuario_id = $new_user->id;
            $usuario_produto->primeiro_usuario = 0;
            $garantia = Garantia::where('usuario_produto_id', $usuario_produto->id)->first();
            $garantia->usuario_id = $new_user->id;

            $usuario_produto->save();
            $garantia->save();

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
