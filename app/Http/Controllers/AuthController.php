<?php

namespace App\Http\Controllers;

use App\Models\ImagemPerfil;
use App\Models\Usuario;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');
            $token = auth('api')->attempt($credentials);

            if (!$token) {
                return response()->json([
                    'error' => 'Senha ou email inválido.'
                ], 500);
            }

            $user = Usuario::where('email', $request->email)->first();

            $user['token'] = $token;
            return response()->json($user, 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Erro: ' . $e->getMessage()
            ], 500);
        }
    }

    function register(Request $request)
    {
        try {
            $data = $request->only(
                'name',
                'email',
                'cpfcnpj',
                'telefone',
                'password'
            );

            $user = Usuario::create([
                'nome' => $data['name'],
                'email' => $data['email'],
                'cpfcnpj' => $data['cpfcnpj'],
                'telefone' => $data['telefone'],
                'password' => Hash::make($data['password']),
            ]);
            $user->save();
            ImagemPerfil::postImagemPerfil($user->id, $request->only('foto_perfil')['foto_perfil']);

            $token = auth('api')->attempt(
                [$data['email'], $data['password']]
            );

            return response()->json([
                'user' => $user,
                'token' => $token
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Erro: ' . $e->getMessage()
            ], 500);
        }
    }
}
