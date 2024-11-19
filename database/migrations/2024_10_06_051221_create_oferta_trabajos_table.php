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
        Schema::create('oferta_trabajos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained("users");
            $table->string('titulo');
            $table->text('descripcion');
            $table->string('empresa');
            $table->string('ubicacion');
            $table->string('habilidades_requeridas');
            $table->dateTime('fecha_expiracion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oferta_trabajos');
    }
};
