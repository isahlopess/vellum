<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
             Schema::create('livro_autores', function (Blueprint $table) {
            $table->foreignId('livro_id')->constrained()->cascadeOnDelete();
            $table->foreignId('autor_id')->constrained('autores')->cascadeOnDelete();
            $table->primary(['livro_id', 'autor_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('book_authors');
    }
};
