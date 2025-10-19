<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Idioma extends Model
{
    protected $fillable = [
        'code'  
    ];
    
    public function livros(){
        return $this->belongsToMany(Livro::class);
    }
}
