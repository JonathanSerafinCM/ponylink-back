<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Experiencia_laboral;

class ExperienciaLaboralController extends Controller
{
    public function workExperience(Request $request)
    {
        $experiences = $request->user()->workExperiences; // Relación 'hasMany' en el modelo User

        return response()->json([
            'experiences' => $experiences
        ]);
    }

    public function addWorkExperience(Request $request)
    {
        $validated = $request->validate([
            'empresa' => 'required|string|max:255',
            'cargo' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_finalizacion' => 'required|date',
            'descripcion' => 'required|string'
        ]);
    
        $experience = $request->user()->experienciaLaboral()->create($validated);
    
        return response()->json([
            'success' => true,
            'message' => 'Experiencia laboral creada',
            'experience' => $experience
        ]);
    }
    public function updateWorkExperience(Request $request, $experienceId)
    {
        try {
            $experience = $request->user()->workExperiences()->findOrFail($experienceId);
            \Log::info('Método de la petición: ' . $request->method()); // Debug
            \Log::info('Datos recibidos: ', $request->all()); // Debug
        
            $validated = $request->validate([
                'empresa' => 'required|string|max:255',
                'cargo' => 'required|string|max:255',
                'fecha_inicio' => 'required|date',
                'fecha_finalizacion' => 'required|date',
                'descripcion' => 'required|string'
            ]);
        
            $experience->update($validated);
        
            return response()->json([
                'message' => 'Experiencia laboral actualizada'
            ]);
        } catch (\Exception $e) {
            \Log::error('Error al actualizar la experiencia laboral: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la experiencia laboral'
            ], 500);
        }
    }

    public function deleteWorkExperience(Request $request, $experienceId)
    {
        $experience = $request->user()->experienciaLaboral()->findOrFail($experienceId);
        $experience->delete();

        return response()->json([
            'message' => 'Experiencia laboral eliminada exitosamente'
        ]);
    }

    public function getWorkExperience($id)
    {
        try {
            $experience = Experiencia_laboral::findOrFail($id);
        
            return response()->json([
                'success' => true,
                'experience' => $experience
            ]);
        } catch (\Exception $e) {
            \Log::error('Error al obtener la experiencia laboral: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener la experiencia laboral'
            ], 500);
        }
    }

}
