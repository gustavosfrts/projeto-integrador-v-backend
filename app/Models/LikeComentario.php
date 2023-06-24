<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikeComentario extends Model
{
    use HasFactory;

    protected $table = 'like_comentarios';
    protected $fillable = ['comentario_id', 'user_id'];
}
