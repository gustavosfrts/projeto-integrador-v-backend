<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto as ModelProduto;
use Exception;
use Illuminate\Support\Facades\Auth;

class Produto extends Controller
{
    function listagemProdutos(Request $request){
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
    function listagemProdutosLogado(Request $request){
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
}
