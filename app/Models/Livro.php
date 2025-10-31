<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    protected $fillable = [
        'titulo',
        'resumo',
        'numero_downloads'
    ];

    public function autores() {
        return $this->belongsToMany(Autor::class);
    }

    public function assuntos() {
        return $this->belongsToMany(Assunto::class);
    }

    public function estantes() {
        return $this->belongsToMany(Estante::class);
    }

    public function idiomas() {
        return $this->belongsToMany(Idioma::class);
    }

    public function formatos() {
        return $this->hasMany(Formato::class);
    }
    public function livrosFavoritos() {
        return $this->hasMany(LivroFavorito::class);
    }
}
