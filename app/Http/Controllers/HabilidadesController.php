<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HabilidadesController extends Controller
{
    public function skills(Request $request)
    {
        $skills = $request->user()->skills; // Relación 'hasMany' en el modelo User

        return response()->json([
            'success' => true,
            'skills' => $skills,
        ], 200); // HTTP 200 para éxito
    }

    public function addSkill(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo_habilidad' => 'required|string'
        ]);
    
        $request->user()->skills()->create($validated);
    
        return response()->json([
            'success' => true,
            'message' => 'Skill added successfully.',
        ], 201); // HTTP 201 para recurso creado
    }

    public function updateSkill(Request $request, $skillId)
    {
        $skill = $request->user()->skills()->findOrFail($skillId);

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo_habilidad' => 'required|string'
        ]);

        $skill->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Skill updated successfully.',
        ], 200); // HTTP 200 para éxito
    }

    public function deleteSkill(Request $request, $id)
    {
        $skill = $request->user()->skills()->findOrFail($id);
        $skill->delete();

        return response()->json([
            'success' => true,
            'message' => 'Habilidad eliminada exitosamente.',
        ], 200);
    }
}
