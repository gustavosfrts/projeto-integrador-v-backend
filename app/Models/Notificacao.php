<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Notificacao extends Model
{
    use HasFactory;

    protected $table = 'notificacao';
    protected $fillable = [
        'usuario_id',
        'token'
    ];

    static function cadastroNotificacao(int $usuario_id, string $token) {
        if (!self::where('usuario_id', $usuario_id)->exists()) {
            self::create([
               'usuario_id' => $usuario_id,
                'token' => $token
            ]);
        }
    }
    static function resgateNotificacao(int $usuario_id) {
        return self::select('token')->where('usuario_id', $usuario_id)->first();
    }
    static function enviarNotificacao(int $produto_id) {
        return self::select('notificacao.token')
            ->join('usuario_produtos', 'notificacao.usuario_id', '=', 'usuario_produtos.usuario_id')
            ->where('usuario_produtos.produto_id', $produto_id)
            ->groupBy('notificacao.token')
            ->get();
    }
    static function envio(string $token, string $produto) {
        $SERVER_API_KEY = 'AAAAIxLc7V8:APA91bGrDbbpkTGU2XO7Re2vJqOu8I6LAq32D4_k9yA9o2iaqksaTX7AJ5jGigwWQuE62vdBjwZDM50XFCC0NoMbCiIWZO6_FKglrOBUakFXXfvqQaecGi8NZWoVo_lG9UTUeEuzB5Qa';

        $data = [
            "registration_ids" => [
                $token
            ],
            "notification" => [
                "title" => "Atualização de Firmware",
                "body" => "O seu produto $produto teve uma nova atualização de firmware. Para mais informações acessar o site oficial da VTR.",
                "sound" => "default"
            ],
        ];

        $dataString = json_encode($data);

        $headers = [
            "Authorization: key= " . $SERVER_API_KEY,
            "Content-Type: application/json"
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        curl_exec($ch);
    }
}
