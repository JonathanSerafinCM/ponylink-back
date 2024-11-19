<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\UserProfileView;
use App\Http\Controllers\ExperienciaLaboralController;
use App\Http\Controllers\EducacionController;
use App\Http\Controllers\FeedController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

// Rutas protegidas con mensaje personalizado
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/editar-perfil', [UserController::class, 'editarPerfil'])
        ->name('editar-perfil')
        ->middleware('auth');
        
    // Resto de las rutas protegidas...
    Route::post('/user/update-profile', [UserController::class, 'updateProfile'])
        ->name('user.update-profile');
    
    // Rutas para formación académica
    Route::post('/education', [EducacionController::class, 'store'])
        ->name('education.store');
    Route::put('/education/{id}', [EducacionController::class, 'update'])
        ->name('education.update');
    Route::delete('/education/{id}', [EducacionController::class, 'delete'])
        ->name('education.delete');
    Route::delete('/education/{id}', [EducacionController::class, 'deleteEducation'])->name('education.delete');
    
    // Rutas para habilidades
    Route::post('/soft-skills', [UserController::class, 'storeSoftSkill'])
        ->name('soft-skills.store');
    Route::post('/hard-skills', [UserController::class, 'storeHardSkill'])
        ->name('hard-skills.store');
    Route::delete('/skills/{id}', [UserController::class, 'deleteSkill'])
        ->name('skills.delete');
    
    // Rutas para idiomas
    Route::post('/languages', [UserController::class, 'storeLanguage'])
        ->name('languages.store');
    Route::put('/languages/{id}', [UserController::class, 'updateLanguage'])
        ->name('languages.update');
    Route::delete('/languages/{id}', [UserController::class, 'deleteLanguage'])
        ->name('languages.delete');
    
    // Rutas para proyectos
    Route::post('/personal-projects', [UserController::class, 'storePersonalProject'])
        ->name('personal-projects.store');
    Route::post('/academic-projects', [UserController::class, 'storeAcademicProject'])
        ->name('academic-projects.store');
    Route::put('/projects/{id}', [UserController::class, 'updateProject'])
        ->name('projects.update');
    Route::delete('/projects/{id}', [UserController::class, 'deleteProject'])
        ->name('projects.delete');

    Route::get('/feed', [FeedController::class, 'index'])->name('feed');
});

// Rutas públicas
Route::get('login', [LoginController::class, 'showLoginForm'])
    ->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('registro', [RegisterController::class, 'showRegisterForm'])->name('registro');
Route::post('registro', [RegisterController::class, 'register']);
Route::get('/navbar', function () {
    return view('navbar');
});
Route::get('/editPassword', function () {
    return view('editPassword');
});

Route::get('/profile', [UserController::class, 'personalInfo'])->name('profile')->middleware('auth');
Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show')->middleware('auth');
Route::put('/profile/sobre-mi', [ProfileController::class, 'updateSobreMi'])->name('profile.updateSobreMi');
// Rutas para experiencia laboral
Route::get('/experience/{id}', [ExperienciaLaboralController::class, 'getWorkExperience'])->name('experience.show');
Route::post('/experience', [ExperienciaLaboralController::class, 'addWorkExperience'])->name('experience.store');
Route::put('/experience/{id}', [ExperienciaLaboralController::class, 'updateWorkExperience'])->name('experience.update');
Route::delete('/experience/{id}', [ExperienciaLaboralController::class, 'deleteWorkExperience'])->name('experience.delete');

