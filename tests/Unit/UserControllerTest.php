<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Habilidades;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $usuario;
    protected $controlador;
    protected $solicitud;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Crear un usuario de prueba
        $this->usuario = User::factory()->create();
        
        // Crear y configurar la solicitud con el usuario autenticado
        $this->solicitud = new Request();
        $this->solicitud->setUserResolver(function () {
            return $this->usuario;
        });
        
        $this->controlador = new UserController();
    }

    public function test_puede_almacenar_habilidad_blanda()
    {
        $this->solicitud->merge([
            'nombre' => 'Trabajo en equipo'
        ]);

        $respuesta = $this->controlador->storeSoftSkill($this->solicitud);
        $datos = json_decode($respuesta->getContent(), true);

        $this->assertTrue($datos['success']);
        $this->assertEquals('Trabajo en equipo', $datos['skill']['nombre']);
        $this->assertEquals('soft', $datos['skill']['tipo_habilidad']);
    }

    public function test_puede_almacenar_habilidad_dura()
    {
        $this->solicitud->merge([
            'nombre' => 'PHP'
        ]);

        $respuesta = $this->controlador->storeHardSkill($this->solicitud);
        $datos = json_decode($respuesta->getContent(), true);

        $this->assertTrue($datos['success']);
        $this->assertEquals('PHP', $datos['skill']['nombre']);
        $this->assertEquals('hard', $datos['skill']['tipo_habilidad']);
    }

    public function test_puede_eliminar_habilidad()
    {
        // Crear una habilidad primero
        $habilidad = $this->usuario->habilidades()->create([
            'nombre' => 'PHP',
            'tipo_habilidad' => 'hard'
        ]);

        $respuesta = $this->controlador->deleteSkill($this->solicitud, $habilidad->id);
        $datos = json_decode($respuesta->getContent(), true);

        $this->assertTrue($datos['success']);
        $this->assertDatabaseMissing('habilidades', ['id' => $habilidad->id]);
    }

    /** @test */
    public function no_puede_almacenar_habilidad_con_nombre_vacio()
    {
        $this->solicitud->merge([
            'nombre' => ''
        ]);

        $this->expectException(\Illuminate\Validation\ValidationException::class);
        
        $this->controlador->storeSoftSkill($this->solicitud);
    }
}