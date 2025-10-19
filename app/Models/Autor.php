<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
   protected $table = 'autores';

    protected $fillable = [
        'nome',
        'dt_nascimento',
        'dt_falecimento'
    ];
    
    public function livros(){
        return $this->belongsToMany(Livro::class);
    }
}
