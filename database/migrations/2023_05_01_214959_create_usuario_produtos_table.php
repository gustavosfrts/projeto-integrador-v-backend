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
        Schema::create('usuario_produtos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produto_id')->references('id')->on('produtos');
            $table->foreignId('usuario_id')->references('id')->on('usuarios');
            $table->boolean('primeiro_usuario')->default(true);
            $table->date('data_compra')->default(date('Y-m-d'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('');
    }
};
