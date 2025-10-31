<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clube_comentarios', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();

            $table->foreignId('clube_sessao_id')->constrained('clube_sessoes')->cascadeOnDelete();

            $table->text('texto');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clube_comentarios');
    }
};
