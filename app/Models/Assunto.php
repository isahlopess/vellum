<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assunto extends Model
{
    protected $fillable = [
        'nome'
    ];   

    public function livros(){
        return $this->belongsToMany(Livro::class);
    }
}
