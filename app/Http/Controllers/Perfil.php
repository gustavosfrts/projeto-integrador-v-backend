<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use \App\Models\ImagemPerfil;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Perfil extends Controller
{
    public function perfil(Request $request)
    {
        try {
            $user = Auth::user();
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
            $fields = $request->only('nome', 'email', 'cpfcnpj', 'telefone', 'password');
            foreach ($fields as $key => $value) {
                if ($value == null) {
                    unset($fields[$key]);
                }
            }

            if (count($fields) == 0) {
                return response()->json([
                    'error' => 'Nenhum campo foi informado.'
                ], 400);
            }

            $user = $request->user();
            foreach ($fields as $key => $value){
                if ($key == 'password') {
                    $user[$key] = Hash::make($value);
                    continue;
                }
                $user[$key] = $value;
            }
            $user->save();
            Auth::setUser($user);
            return response()->json($user,200);
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
