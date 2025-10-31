<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClubeSessao extends Model
{
    use HasFactory;

    protected $table = 'clube_sessoes';

    protected $fillable = [
        'livro_id',
        'status',
        'data_discussao',
    ];

    public function livro()
    {
        return $this->belongsTo(Livro::class);
    }

    public function comentarios()
    {
        return $this->hasMany(ClubeComentario::class);
    }
}

