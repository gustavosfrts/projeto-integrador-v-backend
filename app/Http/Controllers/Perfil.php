<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use \App\Models\ImagemPerfil;
use App\Models\Usuario;

class Perfil extends Controller
{
    public function perfil(Request $request)
    {
        try {
            $user = $request->user();
            $response = $user;
            $response['imagem_perfil'] = ImagemPerfil::getImagemPerfil($user->id);

            return response()->json($response, 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Erro: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request) {
        try {
            $fields = $request->only('nome', 'email', 'cpfcnpj', 'telefone');
            foreach ($fields as $key => $value) {
                if ($value == null) {
                    unset($fields[$key]);
                }
            }

            $user = $request->user();
            foreach ($fields as $key => $value){
                $user[$key] = $value;
            }
            $user->save();
            return response()->json(200);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Erro: ' . $e->getMessage()
            ], 500);
        }
    }

    public function putImage(Request $request)
    {
        try {
            if ($request->hasFile('image'))
            {
                $extensao = $request->file('image')->getClientOriginalExtension();
                $nomeOriginal = explode('.', $request->file('image')->getClientOriginalName())[0];
                $nome = uniqid(time()) . $nomeOriginal . ".$extensao";
                $arquivo = $request->file('image')->move(public_path('storage/imagem_perfil/'), $nome);
                return response()->json([
                    'data' => $arquivo->getFilename()
                ], 200);
            }
            return response()->json([
                'error' => 'Não foi informado nenhuma imagem.'
            ], 400);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Erro: ' . $e->getMessage()
            ], 500);
        }
    }
}
