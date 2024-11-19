<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('foto_perfil')->nullable();
            $table->string('telefono')->nullable();
            $table->string('ubicacion')->nullable();
            $table->string('sobre_mi_titulo')->nullable();
            $table->string('sobre_mi_contenido')->nullable();
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        DB::unprepared('
            CREATE OR REPLACE FUNCTION update_user_profile(
                p_user_id INT,
                p_name VARCHAR,
                p_email VARCHAR,
                p_telefono VARCHAR,
                p_profile_photo_path VARCHAR,
                p_ubicacion VARCHAR,
                p_sobre_mi_titulo VARCHAR,
                p_sobre_mi_contenido TEXT
            )
            RETURNS VOID AS $$
            BEGIN
                UPDATE users
                SET
                    name = p_name,
                    email = p_email,
                    telefono = p_telefono,
                    profile_photo_path = p_profile_photo_path,
                    ubicacion = p_ubicacion,
                    sobre_mi_titulo = p_sobre_mi_titulo,
                    sobre_mi_contenido = p_sobre_mi_contenido
                WHERE id = p_user_id;
            END;
            $$ LANGUAGE plpgsql;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
        DB::unprepared('DROP FUNCTION IF EXISTS update_user_profile');
    }
};
