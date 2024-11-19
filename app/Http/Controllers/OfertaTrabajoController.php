<?php

namespace App\Http\Controllers;

use App\Models\Oferta_trabajo;
use Illuminate\Http\Request;

class OfertaTrabajoController extends Controller
{
    public function index()
    {
        $ofertas = Oferta_trabajo::all();
        return response()->json($ofertas);
    }

    public function create()
    {
        return response()->json(['message' => 'Use POST /ofertas-trabajo to create a new job offer.']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required|exists:users,id',
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'empresa' => 'required|string|max:255',
            'ubicacion' => 'required|string|max:255',
            'habilidades_requeridas' => 'required|string',
            'fecha_expiracion' => 'required|date',
        ]);
    
        $oferta = Oferta_trabajo::create($request->all());
    
        return response()->json(['message' => 'Oferta de trabajo creada exitosamente.', 'oferta' => $oferta], 201);
    }

    public function show(Oferta_trabajo $oferta_trabajo)
    {
        return response()->json($oferta_trabajo);
    }

    public function edit(Oferta_trabajo $oferta_trabajo)
    {
        return response()->json($oferta_trabajo);
    }

    public function update(Request $request, Oferta_trabajo $oferta_trabajo)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'empresa' => 'required|string|max:255',
            'ubicacion' => 'required|string|max:255',
            'habilidades_requeridas' => 'required|string',
            'fecha_expiracion' => 'required|date',
        ]);

        $oferta_trabajo->update($request->all());

        return response()->json(['message' => 'Oferta de trabajo actualizada exitosamente.', 'oferta' => $oferta_trabajo]);
    }

    public function destroy(Oferta_trabajo $oferta_trabajo)
    {
        $oferta_trabajo->delete();

        return response()->json(['message' => 'Oferta de trabajo eliminada exitosamente.']);
    }
}