<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('livros_favoritos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('livro_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();

        });
    }


    public function down(): void
    {
        Schema::dropIfExists('livros_favoritos');
    }
};
