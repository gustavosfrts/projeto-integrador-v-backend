<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Garantia as ModelGarantia;
use Exception;
use Illuminate\Support\Facades\Auth;

class Garantia extends Controller
{
    function listagemGarantias(Request $request)
    {
        try {
            $response = ModelGarantia::listagemGarantias(Auth::user()->id);
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
