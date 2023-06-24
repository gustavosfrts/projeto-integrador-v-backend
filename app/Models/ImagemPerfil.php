<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
                File::delete(public_path('/storage/imagem_perfil' . $antiga_foto));
                self::update(['caminho', $nova_foto])->where('usuario_id', $user_id);
                return true;
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
