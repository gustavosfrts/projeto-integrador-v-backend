<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notificacao;
use Illuminate\Support\Facades\Auth;
use App\Models\Produto;

class NotificationController extends Controller
{
    function cadastroNotificacao(Request $request) {
        Notificacao::cadastroNotificacao(Auth::user()->id, $request->get('token'));
    }
    function resgatarNotificacao() {
        try {
            $token = Notificacao::resgateNotificacao(Auth::user()->id);
            return response()->json([
                'data' => $token,
                'error' => null
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'data' => null,
                'error' => 'Erro: ' . $e->getMessage()
            ], 500);
        }
    }

    function enviarNotificacao(Request $request) {
        try {
            $produto_id = $request->get('produto_id');
            $tokens = Notificacao::enviarNotificacao($produto_id);
            foreach ($tokens as $token) {
                Notificacao::envio($token->token, Produto::nomeProduto($produto_id));
            }
        } catch (Exception $e) {
            return response()->json([
                'data' => null,
                'error' => 'Erro: ' . $e->getMessage()
            ], 500);
        }
    }
}
