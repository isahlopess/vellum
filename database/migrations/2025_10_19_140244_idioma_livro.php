<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
           Schema::create('idioma_livro', function (Blueprint $table) {
            $table->foreignId('livro_id')->constrained()->cascadeOnDelete();
            $table->foreignId('idioma_id')->constrained()->cascadeOnDelete();
            $table->primary(['livro_id', 'idioma_id']);
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('idioma_livro');
    }
};
