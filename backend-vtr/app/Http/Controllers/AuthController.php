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
        $token = Auth::attempt($credentials);

        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = Usuario::where('email', $request->email)->first();
        $token = $user->createToken('authToken')->plainTextToken;

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

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ], 201);
    }
}
