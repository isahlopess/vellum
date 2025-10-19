<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formato extends Model
{
    protected $fillable = [
        'livro_id',
        'media_type',
        'url'
    ];

    public function livro(){
        return $this->belongsTo(Livro::class);
    }
}
