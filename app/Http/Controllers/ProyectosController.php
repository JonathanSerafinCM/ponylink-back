<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProyectosController extends Controller
{
    public function projects(Request $request)
    {
        $projects = $request->user()->projects; // Relación 'hasMany' en el modelo User

        return response()->json('profile.projects', [
            'projects' => $projects,
        ]);
    }

    public function addProject(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'tipo_proyecto' => 'required|string',
            'tecnologias_usadas' => 'required|string'

        ]);

        $request->user()->proyecto()->create($validated);

        return response()->json([
            'message' => 'proyecto agregado'
        ]);
    }

    public function updateProject(Request $request, $projectId)
    {
        $project = $request->user()->projects()->findOrFail($projectId);

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'tipo_proyecto' => 'required|string',
            'tecnologias_usadas' => 'required|string'
        ]);

        $project->update($validated);

        return response()->json([
            'message'=>'proyecto actualizado'
        ]);
    }

    public function deleteProject(Request $request, $projectId)
    {
        $project = $request->user()->proyecto()->findOrFail($projectId);
        $project->delete();

        return response()->json([
            'message' => 'Proyecto eliminado exitosamente'
        ]);
    }
}
