<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
           Schema::create('livro_idiomas', function (Blueprint $table) {
            $table->foreignId('livro_id')->constrained()->cascadeOnDelete();
            $table->foreignId('idioma_id')->constrained()->cascadeOnDelete();
            $table->primary(['livro_id', 'idioma_id']);
        });
    }


    public function down(): void
    {
        Schemma::dropIfExists('livro_idiomas');
    }
};
