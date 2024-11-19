<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\Response;

class EmailRepetidoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function no_puede_registrar_usuario_con_email_duplicado()
    {
        // Crear un usuario en la base de datos
        User::factory()->create([
            'email' => 'juan@example.com',
        ]);

        // Datos del nuevo usuario con el mismo correo
        $userData = [
            'name' => 'Juan Pérez',
            'email' => 'juan@example.com',
            'password' => 'password123',
        ];

        // Intentar registrar otro usuario con el mismo correo electrónico
        $response = $this->postJson('/api/registrar', $userData);

        // Verificar que la respuesta tenga un código de estado 422 y el mensaje adecuado
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
                 ->assertJson([
                     'msg' => 'El correo electrónico ya está registrado.'
                 ]);
    }
}

