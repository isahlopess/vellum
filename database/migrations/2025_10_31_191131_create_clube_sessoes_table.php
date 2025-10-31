<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clube_sessoes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('livro_id')->constrained('livros')->cascadeOnDelete();

            $table->string('status')->default('planejado');

            $table->dateTime('data_discussao')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clube_sessoes');
    }
};
