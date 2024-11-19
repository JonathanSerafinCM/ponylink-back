<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EducacionController extends Controller
{
    public function education(Request $request)
    {
        $educations = $request->user()->educacion; // Relación entre usuario y sus estudios
        return response()->json('profile.education', [
            'educacion' => $educations,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'institucion' => 'required|string|max:255',
                'titulo_grado' => 'required|string|max:255',
                'campo_estudio' => 'required|string|max:255',
                'fecha_inicio' => 'required|date',
                'fecha_fin' => 'nullable|date|after:fecha_inicio',
                'fecha_finalizacion' => 'nullable|date|after:fecha_inicio', // Add this line to handle both field names
                'descripcion' => 'nullable|string'
            ]);

            // Get the end date from either field name
            $fecha_fin = $validated['fecha_fin'] ?? $validated['fecha_finalizacion'] ?? null;

            $education = $request->user()->educacion()->create([
                'institucion' => $validated['institucion'],
                'titulo_grado' => $validated['titulo_grado'],
                'campo_estudio' => $validated['campo_estudio'],
                'fecha_inicio' => $validated['fecha_inicio'],
                'fecha_fin' => $fecha_fin,
                'descripcion' => $validated['descripcion']
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Formación académica agregada con éxito',
                'education' => $education
            ]);

        } catch (\Exception $e) {
            Log::error('Error al guardar formación académica: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al guardar la formación académica: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateEducation(Request $request)
    {
        $validated = $request->validate([
            'institucion' => 'required|string|max:255',
            'titulo_grado' => 'required|string|max:255',
            'campo_estudio' => 'required|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date', // Changed from fecha_finalizacion
            'descripcion' => 'required|string'
        ]);

        $request->user()->educacion()->create($validated);

        return response()->json([
            'message' => 'educacion agregada'
        ]);
    }

    public function deleteEducation(Request $request, $id)
    {
        try {
            $education = $request->user()->educacion()->findOrFail($id);
            $education->delete();

            return response()->json([
                'success' => true,
                'message' => 'Formación académica eliminada con éxito',
            ]);
        } catch (\Exception $e) {
            Log::error('Error al eliminar formación académica: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la formación académica: ' . $e->getMessage(),
            ], 500);
        }
    }
}
