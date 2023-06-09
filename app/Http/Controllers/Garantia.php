<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Garantia as ModelGarantia;
use Exception;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Garantia extends Controller
{
    function listagemGarantias(Request $request)
    {
        try {
            $garantias = ModelGarantia::listagemGarantias(Auth::user()->id);
            foreach ($garantias as $garantia) {
                if ($garantia->primeiro_usuario == 0) {
                    $date = new Carbon($garantia->data_compra);
                    $hoje = new Carbon(date("Y-m-d"));
                    if($hoje->gt($date)){
                        $garantia->hash = 'Expirada';
                        $garantia->validade = 'Expirada';
                    } else {
                        $garantia->validade = $date->addYear()->format('d/m/Y');
                    }
                } else {
                    $garantia->validade = 'Vitalícia';
                }
                //$garantia->data_compra = date('d/m/Y', $garantia->data_compra);
            }
            return response()->json([
                'data' => $garantias,
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
