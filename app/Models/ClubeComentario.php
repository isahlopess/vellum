<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClubeComentario extends Model
{
    use HasFactory;

    protected $table = 'clube_comentarios';

    protected $fillable = [
        'user_id',
        'clube_sessao_id',
        'texto',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sessao()
    {
        return $this->belongsTo(ClubeSessao::class);
    }
}
