<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {

        Schema::create('assunto_livro', function (Blueprint $table) {
            $table->foreignId('livro_id')->constrained()->cascadeOnDelete();
            $table->foreignId('assunto_id')->constrained()->cascadeOnDelete();
            $table->primary(['livro_id', 'assunto_id']);
        });
    }

    public function down(): void
    {
            Schema::dropIfExists('assunto_livro');
    }
};
