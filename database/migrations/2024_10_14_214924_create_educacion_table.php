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
        Schema::create('educacion', function (Blueprint $table) {
            $table->id();
            $table->string('institucion');
            $table->string('titulo_grado');
            $table->string('campo_estudio');
            $table->date('fecha_inicio');
            $table->date('fecha_finalizacion');
            $table->string('descripcion');
            $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educacion');
    }
};
