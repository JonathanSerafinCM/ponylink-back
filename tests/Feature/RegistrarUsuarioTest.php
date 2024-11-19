<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;
use App\Models\User;

class RegistrarUsuarioTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function puede_registrar_un_usuario_correctamente()
    {
        // Datos de ejemplo para el usuario
        $userData = [
            'name' => 'Juan Pérez',
            'email' => 'juan@example.com',
            'password' => 'password123',
        ];

        // Hacer una solicitud POST a la ruta de registro
        $response = $this->postJson('/api/registrar', $userData);

        // Verificar que la respuesta sea exitosa
        $response->assertStatus(Response::HTTP_OK)
                 ->assertJsonStructure([
                     'msg',
                     'token'
                 ]);

        // Verificar que el usuario haya sido creado en la base de datos
        $this->assertDatabaseHas('users', [
            'email' => 'juan@example.com',
        ]);
    }

}
