<?php

use App\Http\Controllers\EducacionController;
use App\Http\Controllers\ExperienciaLaboralController;
use App\Http\Controllers\HabilidadesController;
use App\Http\Controllers\IdiomasController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProyectosController;
use App\Http\Controllers\UserController;
use Illuminate\Database\QueryException;


Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('registrar', function (Request $request) {
    try {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json([
            'msg' => 'success',
            'token' => $user->createToken($user->email . '_Tkn')->plainTextToken
        ]);
    } catch (QueryException $e) {
        if ($e->getCode() === '23505') {
            return response()->json([
                'msg' => 'El correo electrónico ya está registrado.'
            ], 422);
        }
        return response()->json([
            'msg' => 'Error al registrar usuario.'
        ], 500);
    }
});

Route::post(
    'login',[LoginController::class, 'login']
);

// Información del usuario
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('editarInfoPersonal', [UserController::class, 'updateProfileInfo']);
    Route::put('actualizarInfoPersonal', [UserController::class, 'updateProfileInfo']);
    Route::delete('eliminarInfoPersonal', [UserController::class, 'deletePersonalInfo']);
});

// Habilidades
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('agregarHabilidad', [HabilidadesController::class, 'addSkill']);
    Route::put('actualizarHabilidad/{id}', [HabilidadesController::class, 'updateSkill']);
    Route::delete('eliminarHabilidad/{id}', [HabilidadesController::class, 'deleteSkill']);
    Route::post('soft-skills', [UserController::class, 'storeSoftSkill']);
    Route::post('hard-skills', [UserController::class, 'storeHardSkill']);
    Route::delete('eliminarHabilidad/{id}', [UserController::class, 'deleteSkill']);
});

// Experiencia laboral
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('agregarExperienciaLaboral', [ExperienciaLaboralController::class, 'addWorkExperience']);
    Route::put('actualizarExperienciaLaboral/{id}', [ExperienciaLaboralController::class, 'updateWorkExperience']);
    Route::delete('eliminarExperienciaLaboral/{id}', [ExperienciaLaboralController::class, 'deleteWorkExperience']);
});

// Educación
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('agregarEducacion', [EducacionController::class, 'updateEducation']);
    Route::put('actualizarEducacion/{id}', [EducacionController::class, 'updateEducation']);
    Route::delete('eliminarEducacion/{id}', [EducacionController::class, 'deleteEducation']);
});

// Idiomas
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('agregarIdioma', [IdiomasController::class, 'addLanguage']);
    Route::put('actualizarIdioma/{id}', [IdiomasController::class, 'updateLanguage']);
    Route::delete('eliminarIdioma/{id}', [IdiomasController::class, 'deleteLanguage']);
});

// Proyectos
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('agregarProyecto', [ProyectosController::class, 'addProject']);
    Route::put('actualizarProyecto/{id}', [ProyectosController::class, 'updateProject']);
    Route::delete('eliminarProyecto/{id}', [ProyectosController::class, 'deleteProject']);
});
