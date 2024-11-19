<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\Response;

class AgregarIdiomaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function un_usuario_puede_agregar_un_idioma()
    {
        // Crear un usuario y generar un token
        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->plainTextToken;

        // Datos del idioma que se quiere agregar
        $languageData = [
            'nombre' => 'Inglés',
            'nivel_dominio' => 'Avanzado',
            'certificacion_opcional' => 'TOEFL'
        ];

        // Hacer una solicitud POST a la ruta protegida de agregar idioma con el token
        $response = $this->withHeaders([
            'Authorization' => "Bearer $token",
        ])->postJson('/api/agregarIdioma', $languageData);

        // Verificar que la respuesta sea exitosa y contenga el mensaje esperado
        $response->assertStatus(Response::HTTP_OK)
                 ->assertJson([
                     'message' => 'idioma agregado'
                 ]);

        // Verificar que el idioma se haya guardado en la base de datos
        $this->assertDatabaseHas('idiomas', [
            'nombre' => 'Inglés',
            'nivel_dominio' => 'Avanzado',
            'certificacion_opcional' => 'TOEFL',
            'usuario_id' => $user->id, // Asegurarse de que esté asociado al usuario correcto
        ]);
    }

}
