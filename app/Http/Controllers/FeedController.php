<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function index()
    {
        // Datos de ejemplo para la vista
        $events = collect([
            (object)[
                'image' => asset('storage/assets/default-event.png'),
                'title' => 'Evento de ejemplo',
                'description' => 'Descripción del evento de ejemplo'
            ]
        ]);

        $posts = collect([
            (object)[
                'user' => 'Usuario de ejemplo',
                'time' => 'Hace 1 hora',
                'title' => 'Publicación de ejemplo',
                'content' => 'Contenido de ejemplo',
                'type' => 'status',
                'status' => 'Activo',
                'statusClass' => 'bg-green-200'
            ]
        ]);

        return view('feed', compact('events', 'posts'));
    }
}
