<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use \App\Models\ImagemPerfil;

class Perfil extends Controller
{
    public function perfil(Request $request)
    {
        try {
            $id = $request->user()->attributesToArray()['id'];
            $imagemPerfil = ImagemPerfil::getImagemPerfil($id);

            return response()->json($imagemPerfil, 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Erro: ' . $e->getMessage()
            ], 500);
        }
    }
}
