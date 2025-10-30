<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LivroFavorito extends Model
{
    protected $table = "livros_favoritos";

    protected $fillable = [
      'livro_id',
       'user_id',
    ];

    public function livro(){
        return $this->belongsTo(Livro::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
