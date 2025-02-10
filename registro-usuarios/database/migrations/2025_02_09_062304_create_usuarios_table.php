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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('curp')->unique();
            $table->integer('edad');
            $table->timestamp('fecha_registro')->default(DB::raw('CURRENT_TIMESTAMP'));  // Cambié de date a timestamp
            $table->string('foto')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('pokemon_favorito');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
