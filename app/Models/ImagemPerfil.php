<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ImagemPerfil extends Model
{
    use HasFactory;
    static function getImagemPerfil($user_id)
    {
        return DB::table('imagem_perfis')->where("usuario_id", "=", $user_id)->first();
    }
}
