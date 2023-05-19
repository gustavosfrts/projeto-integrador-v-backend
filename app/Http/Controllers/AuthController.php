<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $token = auth('api')->attempt($credentials);

        if (!$token) {
            return response()->json(['error' => 'Senha ou email inválido.'], 500);
        }

        return response()->json(['token' => $token]);
    }

    function register(Request $request)
    {
        $data = $request->only('name', 'email', 'cpfcnpj', 'telefone', 'password');

        $user = Usuario::create([
            'nome' => $data['name'],
            'email' => $data['email'],
            'cpfcnpj' => $data['cpfcnpj'],
            'telefone' => $data['telefone'],
            'password' => Hash::make($data['password']),
        ]);

        $token = auth('api')->attempt([$data['email'], $data['password']]);

        return response()->json([
            'user' => $user,
            'token' => $token
        ], 201);
    }
}
