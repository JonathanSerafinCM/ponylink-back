<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\UserProfileView;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }
    public function show(Request $request)
    {
        $userId = $request->user()->id;
        $userProfile = UserProfileView::find($userId);

        return view('profile', ['userProfile' => $userProfile]);
    }
    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }
        public function updateSobreMi(Request $request)
        {
            $request->validate([
                'sobre_mi_titulo' => 'required|string|max:255',
                'sobre_mi_contenido' => 'required|string',
            ]);

            $user = Auth::user();
            $user->sobre_mi_titulo = $request->input('sobre_mi_titulo');
            $user->sobre_mi_contenido = $request->input('sobre_mi_contenido');
            $user->save();

            return response()->json(['success' => true, 'message' => 'Perfil actualizado correctamente']);
        }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    public function storeExperience(Request $request)
    {
        $request->validate([
            'empresa' => 'required|string|max:255',
            'cargo' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date',
            'descripcion' => 'required|string',
        ]);

        $experience = new ExperienciaLaboral();
        $experience->usuario_id = Auth::id();
        $experience->empresa = $request->input('empresa');
        $experience->cargo = $request->input('cargo');
        $experience->fecha_inicio = $request->input('fecha_inicio');
        $experience->fecha_fin = $request->input('fecha_fin');
        $experience->descripcion = $request->input('descripcion');
        $experience->save();

        return response()->json(['success' => true, 'message' => 'Experiencia laboral añadida correctamente']);
    }

    public function updateExperience(Request $request, $id)
    {
        $request->validate([
            'empresa' => 'required|string|max:255',
            'cargo' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date',
            'descripcion' => 'required|string',
        ]);

        $experience = ExperienciaLaboral::findOrFail($id);
        $experience->empresa = $request->input('empresa');
        $experience->cargo = $request->input('cargo');
        $experience->fecha_inicio = $request->input('fecha_inicio');
        $experience->fecha_fin = $request->input('fecha_fin');
        $experience->descripcion = $request->input('descripcion');
        $experience->save();

        return response()->json(['success' => true, 'message' => 'Experiencia laboral actualizada correctamente']);
    }

    public function deleteExperience($id)
    {
        $experience = ExperienciaLaboral::findOrFail($id);
        $experience->delete();

        return response()->json(['success' => true, 'message' => 'Experiencia laboral eliminada correctamente']);
    }
}
