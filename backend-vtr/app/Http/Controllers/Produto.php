<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto as ModelProduto;
use mysql_xdevapi\Exception;

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
            $response = ModelProduto::listagemProduto();
            return response()->json([
                'data' => null,
                'error' => 'Erro: ' . $e->getMessage()
            ], 500);
        }
    }
}
