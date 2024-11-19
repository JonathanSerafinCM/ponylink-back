<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IdiomasController extends Controller
{
    public function languages(Request $request)
    {
        $languages = $request->user()->languages; // Relación 'hasMany' en el modelo User

        return view('profile.languages', [
            'languages' => $languages,
        ]);
    }

    public function addLanguage(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'nivel_dominio' => 'required|string|max:50',
            'certificacion_opcional' => 'nullable|string'
        ]);

        $request->user()->idioma()->create($validated);

        return response()->json([
            "message" => "idioma agregado"
        ]);
    }

    public function updateLanguage(Request $request, $languageId)
    {
        $language = $request->user()->languages()->findOrFail($languageId);

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'nivel_dominio' => 'required|string|max:50',
            'certificacion' => 'string'
        ]);

        $language->update($validated);

        return response()->json([
            "message" => "idioma actualizado"
        ]);
    }

    public function deleteLanguage(Request $request, $languageId)
    {
        $language = $request->user()->idioma()->findOrFail($languageId);
        $language->delete();

        return response()->json([
            'message' => 'Idioma eliminado exitosamente'
        ]);
    }

}
