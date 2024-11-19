<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function personalInfo(Request $request)
    {
        $user = Auth::user(); 
        
        return view('profile', ['user' => $user]);
    }

    public function updateProfileInfo(Request $request)
    {
        $user = $request->user();

        // Validar los datos de la solicitud, incluyendo el archivo de imagen
        $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'telefono' => 'nullable|string|max:50',
            'profile_photo_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validación de la imagen
            'ubicacion' => 'nullable|string|max:255',
            'sobre_mi_titulo' => 'nullable|string|max:255',
            'sobre_mi_contenido' => 'nullable|string'
        ]);
    
        // Manejar la imagen de perfil si se sube
        $profilePhotoPath = $user->profile_photo_path; // Ruta actual
    
        if ($request->hasFile('profile_photo_path')) {
            // Almacenar la imagen y obtener la ruta
            $profilePhotoPath = $request->file('profile_photo_path')->store('fotos_perfil', 'public');
        }
    
        // Llamar al stored procedure para actualizar el perfil con la nueva ruta de la imagen
        DB::statement('SELECT update_user_profile(?, ?, ?, ?, ?, ?, ?, ?)', [
            $user->id,
            $request->input('name'),
            $request->input('email'),
            $request->input('telefono'),
            $profilePhotoPath,
            $request->input('ubicacion'),
            $request->input('sobre_mi_titulo'),
            $request->input('sobre_mi_contenido')
        ]);
    
        return response()->json(['message' => 'Perfil actualizado correctamente.'], 200);
    }

    public function deletePersonalInfo(Request $request)
    {
        $user = $request->user();

        // Aquí puedes decidir qué información personal eliminar
        // Por ejemplo, podríamos establecer algunos campos a null o a valores predeterminados
        $user->update([
            'name' => 'Usuario Anónimo',
            'email' => 'usuario' . $user->id . '@anonimo.com',
            // Otros campos que quieras "eliminar"
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Información personal eliminada exitosamente.'
        ]);
    }

    public function editarPerfil(Request $request)
    {
        $user = $request->user();
        $educaciones = $user->educacion; // Assuming 'educacion' is the relationship in User model
        try {
            // Verificar si el usuario está autenticado
            if (!$request->user()) {
                return redirect()->route('login');
            }

            $user = $request->user();
            
            // Inicializar las variables como colecciones vacías
            $educacion = $user->educacion ?? collect([]);
            $experienciaLaboral = $user->experienciaLaboral ?? collect([]);
            $habilidades = $user->habilidades ?? collect([]);
            $idiomas = $user->idiomas ?? collect([]);
            $proyectos = $user->proyectos ?? collect([]);

            Log::info('Cargando vista editprofile con datos:', [
                'user_id' => $user->id,
                'educacion_count' => $educacion->count(),
                'experiencia_count' => $experienciaLaboral->count(),
                'habilidades_count' => $habilidades->count(),
                'idiomas_count' => $idiomas->count(),
                'proyectos_count' => $proyectos->count()
            ]);

            return view('auth.editprofile', [
                'user' => $user,
                'educaciones' => $educaciones,
                'educacion' => $educacion,
                'experienciaLaboral' => $experienciaLaboral,
                'habilidades' => $habilidades,
                'idiomas' => $idiomas,
                'proyectos' => $proyectos
            ]);
        } catch (\Exception $e) {
            Log::error('Error en editarPerfil: ' . $e->getMessage());
            return back()->with('error', 'Error al cargar el perfil: ' . $e->getMessage());
        }
    }

    public function updateProfile(Request $request)
    {
        try {
            $user = $request->user();
            
            // Depurar la request completa
            Log::info('Request completa:', [
                'all' => $request->all(),
                'files' => $request->allFiles(),
                'headers' => $request->headers->all(),
                'method' => $request->method()
            ]);

            $validated = $request->validate([
                'name' => 'nullable|string|max:255',
                'email' => 'nullable|string|email|max:255|unique:users,email,' . $user->id,
                'phone' => 'nullable|string|max:20',
                'location' => 'nullable|string|max:255',
                'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $changes = false;

            // Actualizar campos básicos si están presentes en la request
            if ($request->filled('name') && $request->input('name') !== $user->name) {
                $user->name = $request->input('name');
                $changes = true;
            }
            
            if ($request->filled('email') && $request->input('email') !== $user->email) {
                $user->email = $request->input('email');
                $changes = true;
            }
            
            if ($request->filled('phone') && $request->input('phone') !== $user->telefono) {
                $user->telefono = $request->input('phone');
                $changes = true;
            }
            
            if ($request->filled('location') && $request->input('location') !== $user->ubicacion) {
                $user->ubicacion = $request->input('location');
                $changes = true;
            }

            // Manejar la foto de perfil
            if ($request->hasFile('profile_photo')) {
                $changes = true;
                if ($user->profile_photo_path) {
                    Storage::delete('public/' . $user->profile_photo_path);
                }
                $path = $request->file('profile_photo')->store('profile_photos', 'public');
                // Guardamos solo el nombre del archivo sin 'public/'
                $user->profile_photo_path = $path;
            }

            if ($changes) {
                $user->save();
                return response()->json([
                    'success' => true,
                    'message' => 'Perfil actualizado con éxito.',
                    'user' => $user
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'No se detectaron cambios en el perfil.'
            ]);

        } catch (\Exception $e) {
            Log::error('Error en updateProfile: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el perfil: ' . $e->getMessage()
            ], 500);
        }
    }

    public function storeExperience(Request $request)
    {
        try {
            $validated = $request->validate([
                'company' => 'required|string|max:255',
                'position' => 'required|string|max:255',
                'start_date' => 'required|date',
                'end_date' => 'nullable|date|after:start_date',
                'description' => 'required|string'
            ]);

            $experience = $request->user()->experienciaLaboral()->create([
                'empresa' => $validated['company'],
                'cargo' => $validated['position'],
                'fecha_inicio' => $validated['start_date'],
                'fecha_fin' => $validated['end_date'],
                'descripcion' => $validated['description']
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Experiencia laboral agregada con éxito',
                'experience' => $experience
            ]);

        } catch (\Exception $e) {
            Log::error('Error al guardar experiencia: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al guardar la experiencia: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateExperience(Request $request, $id)
    {
        try {
            $experience = $request->user()->experienciaLaboral()->findOrFail($id);

            $validated = $request->validate([
                'company' => 'required|string|max:255',
                'position' => 'required|string|max:255',
                'start_date' => 'required|date',
                'end_date' => 'nullable|date|after:start_date',
                'description' => 'required|string'
            ]);

            $experience->update([
                'empresa' => $validated['company'],
                'cargo' => $validated['position'],
                'fecha_inicio' => $validated['start_date'],
                'fecha_fin' => $validated['end_date'],
                'descripcion' => $validated['description']
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Experiencia laboral actualizada con éxito',
                'experience' => $experience
            ]);

        } catch (\Exception $e) {
            Log::error('Error al actualizar experiencia: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la experiencia: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteExperience(Request $request, $id)
    {
        try {
            $experience = $request->user()->experienciaLaboral()->findOrFail($id);
            $experience->delete();

            return response()->json([
                'success' => true,
                'message' => 'Experiencia laboral eliminada con éxito'
            ]);

        } catch (\Exception $e) {
            Log::error('Error al eliminar experiencia: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la experiencia: ' . $e->getMessage()
            ], 500);
        }
    }

    public function storeEducation(Request $request)
    {
        try {
            $validated = $request->validate([
                'institution' => 'required|string|max:255',
                'degree' => 'required|string|max:255',
                'field_of_study' => 'required|string|max:255',
                'start_date' => 'required|date',
                'end_date' => 'nullable|date|after:start_date',
                'description' => 'nullable|string'
            ]);

            $education = $request->user()->educacion()->create([
                'institucion' => $validated['institution'],
                'titulo_grado' => $validated['degree'],
                'campo_estudio' => $validated['field_of_study'],
                'fecha_inicio' => $validated['start_date'],
                'fecha_fin' => $validated['end_date'],
                'descripcion' => $validated['description']
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

    public function updateEducation(Request $request, $id)
    {
        try {
            $education = $request->user()->educacion()->findOrFail($id);

            $validated = $request->validate([
                'institution' => 'required|string|max:255',
                'degree' => 'required|string|max:255',
                'field_of_study' => 'required|string|max:255',
                'start_date' => 'required|date',
                'end_date' => 'nullable|date|after:start_date',
                'description' => 'nullable|string'
            ]);

            $education->update([
                'institucion' => $validated['institution'],
                'titulo_grado' => $validated['degree'],
                'campo_estudio' => $validated['field_of_study'],
                'fecha_inicio' => $validated['start_date'],
                'fecha_fin' => $validated['end_date'],
                'descripcion' => $validated['description']
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Formación académica actualizada con éxito',
                'education' => $education
            ]);

        } catch (\Exception $e) {
            Log::error('Error al actualizar formación académica: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la formación académica: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteEducation(Request $request, $id)
    {
        try {
            $education = $request->user()->educacion()->findOrFail($id);
            $education->delete();

            return response()->json([
                'success' => true,
                'message' => 'Formación académica eliminada con éxito'
            ]);

        } catch (\Exception $e) {
            Log::error('Error al eliminar formación académica: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la formación académica: ' . $e->getMessage()
            ], 500);
        }
    }

    public function storeSoftSkill(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $skill = $request->user()->habilidades()->create([
            'nombre' => $validated['nombre'],
            'tipo_habilidad' => 'soft'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Habilidad blanda agregada con éxito',
            'skill' => $skill
        ]);
    }

    public function storeHardSkill(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $skill = $request->user()->habilidades()->create([
            'nombre' => $validated['nombre'],
            'tipo_habilidad' => 'hard'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Habilidad técnica agregada con éxito',
            'skill' => $skill
        ]);
    }

    public function deleteSkill(Request $request, $id)
    {
        try {
            $skill = $request->user()->habilidades()->findOrFail($id);
            $skill->delete();

            return response()->json([
                'success' => true,
                'message' => 'Habilidad eliminada con éxito'
            ]);

        } catch (\Exception $e) {
            Log::error('Error al eliminar habilidad: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la habilidad: ' . $e->getMessage()
            ], 500);
        }
    }

    public function storeLanguage(Request $request)
    {
        try {
            $validated = $request->validate([
                'nombre' => 'required|string|max:255',
                'nivel_dominio' => 'required|string|in:Básico,Intermedio,Avanzado,Nativo',
                'certificacion' => 'nullable|string|max:255'
            ]);

            $language = $request->user()->idiomas()->create([
                'nombre' => $validated['nombre'],
                'nivel_dominio' => $validated['nivel_dominio'],
                'certificacion' => $validated['certificacion']
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Idioma agregado con éxito',
                'language' => $language
            ]);

        } catch (\Exception $e) {
            Log::error('Error al guardar idioma: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al guardar el idioma: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateLanguage(Request $request, $id)
    {
        try {
            $language = $request->user()->idiomas()->findOrFail($id);

            $validated = $request->validate([
                'nombre' => 'required|string|max:255',
                'nivel_dominio' => 'required|string|in:Básico,Intermedio,Avanzado,Nativo',
                'certificacion' => 'nullable|string|max:255'
            ]);

            $language->update([
                'nombre' => $validated['nombre'],
                'nivel_dominio' => $validated['nivel_dominio'],
                'certificacion' => $validated['certificacion']
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Idioma actualizado con éxito',
                'language' => $language
            ]);

        } catch (\Exception $e) {
            Log::error('Error al actualizar idioma: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el idioma: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteLanguage(Request $request, $id)
    {
        try {
            $language = $request->user()->idiomas()->findOrFail($id);
            $language->delete();

            return response()->json([
                'success' => true,
                'message' => 'Idioma eliminado con éxito'
            ]);

        } catch (\Exception $e) {
            Log::error('Error al eliminar idioma: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el idioma: ' . $e->getMessage()
            ], 500);
        }
    }

    public function storePersonalProject(Request $request)
    {
        try {
            $validated = $request->validate([
                'nombre' => 'required|string|max:255',
                'descripcion' => 'required|string',
                'fecha_inicio' => 'required|date',
                'fecha_fin' => 'nullable|date|after:fecha_inicio',
                'url' => 'nullable|url|max:255'
            ]);

            $project = $request->user()->proyectos()->create([
                'nombre' => $validated['nombre'],
                'descripcion' => $validated['descripcion'],
                'fecha_inicio' => $validated['fecha_inicio'],
                'fecha_fin' => $validated['fecha_fin'],
                'url' => $validated['url'] ?? null,
                'tipo' => 'personal'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Proyecto personal agregado con éxito',
                'project' => $project
            ]);

        } catch (\Exception $e) {
            Log::error('Error al guardar proyecto personal: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al guardar el proyecto personal: ' . $e->getMessage()
            ], 500);
        }
    }

    public function storeAcademicProject(Request $request)
    {
        try {
            $validated = $request->validate([
                'nombre' => 'required|string|max:255',
                'descripcion' => 'required|string',
                'tecnologias' => 'required|string',
                'fecha_inicio' => 'required|date',
                'fecha_fin' => 'nullable|date|after:fecha_inicio',
                'url' => 'nullable|url|max:255'
            ]);

            $project = $request->user()->proyectos()->create([
                'nombre' => $validated['nombre'],
                'descripcion' => $validated['descripcion'],
                'tecnologias' => $validated['tecnologias'],
                'fecha_inicio' => $validated['fecha_inicio'],
                'fecha_fin' => $validated['fecha_fin'],
                'url' => $validated['url'] ?? null,
                'tipo' => 'academico'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Proyecto académico agregado con éxito',
                'project' => $project
            ]);

        } catch (\Exception $e) {
            Log::error('Error al guardar proyecto académico: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al guardar el proyecto académico: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateProject(Request $request, $id)
    {
        try {
            $project = $request->user()->proyectos()->findOrFail($id);

            $validated = $request->validate([
                'nombre' => 'required|string|max:255',
                'descripcion' => 'required|string',
                'tecnologias' => $project->tipo === 'academico' ? 'required|string' : 'nullable|string',
                'fecha_inicio' => 'required|date',
                'fecha_fin' => 'nullable|date|after:fecha_inicio',
                'url' => 'nullable|url|max:255'
            ]);

            $project->update([
                'nombre' => $validated['nombre'],
                'descripcion' => $validated['descripcion'],
                'tecnologias' => $validated['tecnologias'] ?? null,
                'fecha_inicio' => $validated['fecha_inicio'],
                'fecha_fin' => $validated['fecha_fin'],
                'url' => $validated['url'] ?? null
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Proyecto actualizado con éxito',
                'project' => $project
            ]);

        } catch (\Exception $e) {
            Log::error('Error al actualizar proyecto: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el proyecto: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteProject(Request $request, $id)
    {
        try {
            $project = $request->user()->proyectos()->findOrFail($id);
            $project->delete();

            return response()->json([
                'success' => true,
                'message' => 'Proyecto eliminado con éxito'
            ]);

        } catch (\Exception $e) {
            Log::error('Error al eliminar proyecto: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el proyecto: ' . $e->getMessage()
            ], 500);
        }
    }

}
