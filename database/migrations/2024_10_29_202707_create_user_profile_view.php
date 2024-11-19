<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            CREATE OR REPLACE VIEW user_profile_view AS
            SELECT
                users.id AS user_id,
                users.name AS user_name,
                users.email,
                users.profile_photo_path,
                users.ubicacion,
                users.telefono,
                users.sobre_mi_titulo,
                users.sobre_mi_contenido,
                STRING_AGG(DISTINCT habilidades.nombre, ', ') AS habilidades,
                STRING_AGG(DISTINCT experiencia_laboral.cargo, ', ') AS experiencia_laboral,
                STRING_AGG(DISTINCT educacion.titulo_grado, ', ') AS educacion,
                STRING_AGG(DISTINCT idiomas.nombre, ', ') AS idiomas,
                STRING_AGG(DISTINCT proyectos.nombre, ', ') AS proyectos
            FROM users
            LEFT JOIN habilidades ON habilidades.usuario_id = users.id
            LEFT JOIN experiencia_laboral ON experiencia_laboral.usuario_id = users.id
            LEFT JOIN educacion ON educacion.usuario_id = users.id
            LEFT JOIN idiomas ON idiomas.usuario_id = users.id
            LEFT JOIN proyectos ON proyectos.user_id = users.id
            GROUP BY users.id
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS user_profile_view");
    }
};