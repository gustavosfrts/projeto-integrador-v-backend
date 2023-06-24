<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ImagemPerfil extends Model
{
    use HasFactory;
    protected $table = 'imagem_perfis';
    protected $fillable = [
        'usuario_id',
        'caminho'
    ];
    static function getImagemPerfil($user_id)
    {
        return DB::table('imagem_perfis')->where("usuario_id", "=", $user_id)->first();
    }

    static function postImagemPerfil(int $user_id, string $nova_foto) {
        try {
            if (self::where('usuario_id', $user_id)->exists()) {
                $image = self::where('usuario_id', $user_id)->first();
                $antiga_foto = $image->caminho;
                $antiga_foto = public_path('/storage/') . substr($antiga_foto, strpos($antiga_foto, 'imagem_perfil/'));
                File::delete($antiga_foto);
                DB::table('imagem_perfis')->where('usuario_id', $user_id)->delete();
            }

            self::create([
                'usuario_id' => $user_id,
                'caminho' => $nova_foto
            ]);
            return true;
        } catch (\Exception  $e) {
            return false;
        }

    }
}
