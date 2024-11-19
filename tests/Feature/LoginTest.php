<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\Response;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function un_usuario_puede_iniciar_sesion_con_credenciales_correctas()
    {
        // Crear un usuario
        $user = User::factory()->create([
            'email' => 'juan@example.com',
            'password' => bcrypt('password123'),
        ]);

        // Datos de inicio de sesión correctos
        $loginData = [
            'email' => 'juan@example.com',
            'password' => 'password123',
        ];

        // Hacer una solicitud POST a la ruta de login
        $response = $this->postJson('/api/login', $loginData);

        // Verificar que la respuesta tenga un token y sea exitosa
        $response->assertStatus(Response::HTTP_OK)
                 ->assertJsonStructure(['token']);
    }
}