@extends('layouts.main_layout')

@section('content')
<main 
    class="flex overflow-hidden flex-col items-center px-20 pt-9 pb-56 bg-cover bg-center max-md:px-5 max-md:pb-24"
    style="background-image: url('{{ asset('storage/assets/fondo2.png') }}'); background-attachment: fixed;"
>
    <section class="flex flex-col w-full max-w-[985px] max-md:max-w-full">
        <article class="flex flex-col items-center px-14 pt-3 pb-14 w-full bg-white rounded-3xl shadow-lg max-md:px-5">
            
            <!-- Datos Personales -->
            <div class="flex justify-center mt-6 w-full">
                <section class="flex flex-col w-full text-2xl font-bold text-slate-900 text-center">
                    <div 
                        class="flex gap-2 px-4 py-2 bg-blue-100 rounded-xl border-b border-slate-900 shadow-md transition-transform transform hover:scale-105 items-center cursor-pointer justify-center"
                        role="presentation"
                    >
                        <h2 class="my-auto font-bold">Datos Personales</h2>
                        <img 
                            loading="lazy"
                            src="{{ asset('storage/assets/sobremi.png') }}"
                            class="object-contain shrink-0 aspect-[0.87] w-[45px]"
                            alt="Configuration icon"
                        />
                    </div>
                </section>
            </div>

            <!-- Contenedor principal para foto y formulario -->
            <div class="flex flex-wrap justify-between mt-6 w-full">
                <!-- Imagen del perfil -->
                <div class="w-full md:w-1/3 flex flex-col justify-center items-center">
                    <div class="bg-red-600 p-2 rounded-full">
                        <img 
                            id="profilePhotoPreview"
                            loading="lazy"
                            src="{{ $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : asset('storage/assets/default-profile.png') }}" 
                            alt="Foto de perfil" 
                            class="object-cover rounded-full w-[160px] h-[160px] shadow-md" 
                        />
                    </div>
                    <!-- Botón para cambiar foto de perfil -->
                    <label 
                        for="profile_photo"
                        class="mt-4 px-4 py-2 bg-blue-100 rounded-md border-b-2 border-slate-900 text-neutral-700 font-semibold shadow-md transition-transform transform hover:scale-105 flex items-center justify-center cursor-pointer"
                    >
                        <img 
                            loading="lazy"
                            src="{{ asset('storage/assets/camera.png') }}" 
                            class="w-6 h-6 mr-2" 
                            alt="Icono de edición"
                        />
                        Editar
                    </label>
                    <input type="file" id="profile_photo" name="profile_photo" accept="image/*" style="display: none;" />
                </div>

                <!-- Formulario de Datos Personales -->
                <form 
                    id="profileForm"
                    class="w-full md:w-2/3 mt-6 md:mt-0 space-y-6 bg-white p-6 rounded-xl shadow-lg border border-gray-200 transition-all duration-300 hover:shadow-xl hover:border-gray-300"
                    enctype="multipart/form-data"
                >
                    @csrf
                    <!-- Campo oculto para la foto de perfil -->
                    <input type="file" id="profile_photo1" name="profile_photo" accept="image/*" style="display: none;" />

                    <!-- Campo Nombre -->
                    <div class="flex flex-col space-y-2">
                        <label for="name" class="text-xl font-bold text-slate-900 pl-2">Nombre</label>
                        <input
                            id="name"
                            name="name"
                            type="text"
                            class="px-4 py-4 w-full bg-blue-100 rounded-md border-b-2 border-slate-900 text-neutral-700"
                            placeholder="Tu nombre completo"
                            value="{{ $user->name }}"
                        />
                    </div>

                    <!-- Campo Correo Electrónico -->
                    <div class="flex flex-col space-y-2">
                        <label for="email" class="text-xl font-bold text-slate-900 pl-2">Correo Electrónico</label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            class="px-4 py-4 w-full bg-blue-100 rounded-md border-b-2 border-slate-900 text-neutral-700"
                            placeholder="email@ejemplo.com"
                            value="{{ $user->email }}"
                        />
                    </div>

                    <!-- Campo Número de Teléfono -->
                    <div class="flex flex-col space-y-2">
                        <label for="phone" class="text-xl font-bold text-slate-900 pl-2">Número de Teléfono</label>
                        <input
                            id="phone"
                            name="phone"
                            type="tel"
                            class="px-4 py-4 w-full bg-blue-100 rounded-md border-b-2 border-slate-900 text-neutral-700"
                            placeholder="(123) 456-7890"
                            value="{{ $user->telefono }}"
                        />
                    </div>

                    <!-- Campo Ubicación -->
                    <div class="flex flex-col space-y-2">
                        <label for="location" class="text-xl font-bold text-slate-900 pl-2">Ubicación</label>
                        <input
                            id="location"
                            name="location"
                            type="text"
                            class="px-4 py-4 w-full bg-blue-100 rounded-md border-b-2 border-slate-900 text-neutral-700"
                            placeholder="Tu ubicación"
                            value="{{ $user->ubicacion }}"
                        />
                    </div>

                    <!-- Botón Guardar al final del formulario -->
                    <button
                        type="submit"
                        class="mt-6 px-6 py-3 bg-green-100 rounded-xl border-b-2 border-slate-900 text-neutral-700 font-semibold shadow-md transition-transform transform hover:scale-105 flex items-center justify-center"
                    >
                        <img 
                            loading="lazy"
                            src="{{ asset('storage/assets/ok.png') }}" 
                            class="w-6 h-6 mr-2" 
                            alt="Save icon"
                        />
                        Guardar Información
                    </button>
                </form>
            </div>

            <!-- Secciones de Información -->
            <section class="w-full mt-8 space-y-6">
                <!-- Sobre mí -->
                <div class="info-section">
                    <div class="flex items-center">
                        <h2 class="text-2xl font-bold text-slate-900">Sobre mí</h2>
                        <img src="{{ asset('storage/assets/sobremi.png') }}" alt="Arrow icon" class="w-6 h-6 ml-2" />
                    </div>
                    <div class="flex flex-col space-y-2">
                        <!-- Campo de Título -->
                        <input 
                            type="text" 
                            id="sobreMiTitulo" 
                            name="sobre_mi_titulo" 
                            class="px-4 py-2 w-full bg-white-100 rounded-md border-b-2 border-slate-900 text-neutral-700" 
                            placeholder="Sobre ti" 
                            aria-label="Título importante" 
                            value="{{ $user->sobre_mi_titulo }}"
                        />
                        <!-- Campo de Descripción -->
                        <textarea 
                        id="sobreMiContenido" 
                        name="sobre_mi_contenido" 
                        class="mt-2 w-full bg-white rounded-md border-b-2 border-slate-900 text-neutral-700 p-4 resize-none"
                        rows="4"
                        placeholder="Escribe algo sobre ti..."
                        aria-label="Sobre mí"
                    >{{ $user->sobre_mi_contenido }}</textarea>
                    <button id="editSobreMiBtn" class="mt-4 px-4 py-2 bg-blue-100 rounded-md border-b-2 border-slate-900 text-neutral-700 font-semibold shadow-md transition-transform transform hover:scale-105 flex items-center justify-center cursor-pointer">
                        Guardar "Sobre mí"
                    </button>
                </div>
                </div>

        
            </section>


            <!-- Sección de experiencia laboral -->
            <div class="flex flex-col items-center mt-6 w-full">
                <section class="flex flex-col w-full text-2xl font-bold text-slate-900 text-center">
                    <div class="flex gap-2 px-4 py-2 bg-blue-100 rounded-xl border-b border-slate-900 shadow-md transition-transform transform hover:scale-105 items-center cursor-pointer justify-center">
                        <h2 class="my-auto font-bold">Experiencia Laboral</h2>
                        <img 
                            loading="lazy"
                            src="{{ asset('storage/assets/expe.png') }}"
                            class="object-contain shrink-0 aspect-[0.87] w-[45px]"
                            alt="Experience icon"
                        />
                    </div>
                </section>

                <!-- Botón "Añadir experiencia" -->
                <button
                    id="toggleExperienceBtn"
                    type="button"
                    class="mt-4 px-6 py-2 bg-blue-100 rounded-xl border-b-2 border-slate-900 text-neutral-700 font-semibold shadow-md transition-transform transform hover:scale-105 flex items-center justify-center"
                >
                    <img 
                        loading="lazy"
                        src="{{ asset('storage/assets/mass.png') }}" 
                        class="w-6 h-6 mr-2" 
                        alt="Add icon"
                    />
                    <span>Añadir experiencia</span>
                </button>
<!-- Formulario de experiencia laboral -->
<form 
    id="experienceForm"
    data-form-type="experience"
    class="form-transition form-hidden mt-4 w-full max-w-[985px] bg-white p-6 rounded-xl shadow-lg border border-gray-200 transition-all duration-300 hover:shadow-xl hover:border-gray-300"
    style="display: none;"
    method="POST"
    action="{{ route('experience.store') }}"
>
    @csrf
    <!-- Remove or comment out the following line to prevent overriding the POST method -->
     <input type="hidden"  name="_method" value="PUT"> 
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="flex flex-col space-y-2">
            <label for="company" class="text-slate-900 font-semibold">Empresa</label>
            <input type="text" id="company" name="empresa" class="px-4 py-2 w-full bg-white rounded-md border-b-2 border-slate-900 text-neutral-700" required>
        </div>
        <div class="flex flex-col space-y-2">
            <label for="position" class="text-slate-900 font-semibold">Cargo</label>
            <input type="text" id="position" name="cargo" class="px-4 py-2 w-full bg-white rounded-md border-b-2 border-slate-900 text-neutral-700" required>
        </div>
        <div class="flex flex-col space-y-2">
            <label for="startDate" class="text-slate-900 font-semibold">Fecha de Inicio</label>
            <input type="date" id="startDate" name="fecha_inicio" class="px-4 py-2 w-full bg-white rounded-md border-b-2 border-slate-900 text-neutral-700" required>
        </div>
        <div class="flex flex-col space-y-2">
            <label for="endDate" class="text-slate-900 font-semibold">Fecha de Fin</label>
            <input type="date" id="endDate" name="fecha_finalizacion" class="px-4 py-2 w-full bg-white rounded-md border-b-2 border-slate-900 text-neutral-700">
        </div>
    </div>
    <div class="flex flex-col space-y-2 mt-4">
        <label for="description" class="text-slate-900 font-semibold">Descripción</label>
        <textarea id="description" name="descripcion" class="px-4 py-2 w-full bg-white rounded-md border-b-2 border-slate-900 text-neutral-700" rows="4" required></textarea>
    </div>
    <div class="mt-6 flex justify-end">
        <button type="submit" class="px-6 py-3 bg-green-100 rounded-xl border-b-2 border-slate-900 text-neutral-700 font-semibold shadow-md transition-transform transform hover:scale-105 flex items-center justify-center">
            <span>Guardar experiencia</span>
        </button>
    </div>
</form>

                <!-- Lista de experiencias existentes -->
                @foreach($experienciaLaboral as $exp)
                <div class="mt-4 w-full max-w-[985px] bg-white p-6 rounded-xl shadow-lg border border-gray-200">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-xl font-bold text-slate-900">{{ $exp->cargo }}</h3>
                            <p class="text-lg text-slate-700">{{ $exp->empresa }}</p>
                            <p class="text-sm text-slate-600">
                                {{ \Carbon\Carbon::parse($exp->fecha_inicio)->format('M Y') }} - 
                                {{ $exp->fecha_fin ? \Carbon\Carbon::parse($exp->fecha_fin)->format('M Y') : 'Presente' }}
                            </p>
                            <p class="mt-2 text-slate-700">{{ $exp->descripcion }}</p>
                        </div>
                        <div class="flex gap-2">
                            <button 
                                onclick="editExperience({{ $exp->id }})"
                                class="p-2 bg-blue-100 rounded-md hover:bg-blue-200"
                            >
                                <img src="{{ asset('storage/assets/editar.png') }}" alt="Editar" class="w-5 h-5">
                            </button>
                            <button 
                                onclick="deleteExperience({{ $exp->id }})"
                                class="p-2 bg-red-100 rounded-md hover:bg-red-200"
                            >
                                <img src="{{ asset('storage/assets/eliminar.png') }}" alt="Eliminar" class="w-5 h-5">
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Sección de Formación Académica -->
            <div class="flex flex-col items-center mt-6 w-full">
                <section class="flex flex-col w-full text-2xl font-bold text-slate-900 text-center">
                    <div 
                        class="flex gap-2 px-4 py-2 bg-blue-100 rounded-xl border-b border-slate-900 shadow-md transition-transform transform hover:scale-105 items-center cursor-pointer justify-center"
                        role="presentation"
                    >
                        <h2 class="my-auto font-bold">Formación Académica</h2>
                        <img 
                            loading="lazy"
                            src="{{ asset('storage/assets/edu.png') }}"
                            class="object-contain shrink-0 aspect-[0.87] w-[45px]"
                            alt="Education icon"
                        />
                    </div>
                </section>

                <!-- Botón "Añadir formación" -->
                <button
                    id="toggleEducationBtn"
                    class="mt-4 px-6 py-2 bg-blue-100 rounded-xl border-b-2 border-slate-900 text-neutral-700 font-semibold shadow-md transition-transform transform hover:scale-105 flex items-center justify-center"
                >
                    <img 
                        loading="lazy"
                        src="{{ asset('storage/assets/mass.png') }}" 
                        class="w-6 h-6 mr-2" 
                        alt="Add icon"
                    />
                    <span id="educationButtonText">Añadir formación</span>
                </button>

                <!-- Formulario de formación académica -->
                <form 
                    id="educationForm"
                    data-form-type="education"
                    class="form-transition form-hidden mt-4 w-full max-w-[985px] bg-white p-6 rounded-xl shadow-lg border border-gray-200"
                    style="display: none;"
                >
                    @csrf
                    <!-- Remove the action attribute if you are submitting via JavaScript -->
                    <!-- action="{{ route('education.store') }}" -->

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex flex-col space-y-2">
                            <label for="institucion" class="text-xl font-bold text-slate-900">Institución Educativa</label>
                            <input id="institucion" name="institucion" type="text" class="px-4 py-2 w-full bg-blue-100 rounded-md border-b-2 border-slate-900 text-neutral-700" required />
                        </div>

                        <div class="flex flex-col space-y-2">
                            <label for="titulo_grado" class="text-xl font-bold text-slate-900">Título o Grado</label>
                            <input id="titulo_grado" name="titulo_grado" type="text" class="px-4 py-2 w-full bg-blue-100 rounded-md border-b-2 border-slate-900 text-neutral-700" required />
                        </div>

                        <div class="flex flex-col space-y-2">
                            <label for="campo_estudio" class="text-xl font-bold text-slate-900">Campo de Estudio</label>
                            <input id="campo_estudio" name="campo_estudio" type="text" class="px-4 py-2 w-full bg-blue-100 rounded-md border-b-2 border-slate-900 text-neutral-700" required />
                        </div>

                        <div class="flex flex-col space-y-2">
                            <label for="eduStartDate" class="text-xl font-bold text-slate-900">Fecha de Inicio</label>
                            <input id="eduStartDate" name="fecha_inicio" type="date" class="px-4 py-2 w-full bg-blue-100 rounded-md border-b-2 border-slate-900 text-neutral-700" required />
                        </div>

                        <div class="flex flex-col space-y-2">
                            <label for="eduEndDate" class="text-xl font-bold text-slate-900">Fecha de Finalización</label>
                            <input id="eduEndDate" name="fecha_fin" type="date" class="px-4 py-2 w-full bg-blue-100 rounded-md border-b-2 border-slate-900 text-neutral-700" />
                        </div>
                    </div>

                    <div class="flex flex-col space-y-2 mt-4">
                        <label for="eduDescription" class="text-xl font-bold text-slate-900">Descripción</label>
                        <textarea id="eduDescription" name="descripcion" rows="4" class="px-4 py-2 w-full bg-blue-100 rounded-md border-b-2 border-slate-900 text-neutral-700 resize-none"></textarea>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <button type="submit" class="px-6 py-2 bg-blue-100 rounded-xl border-b-2 border-slate-900 text-neutral-700 font-semibold shadow-md transition-transform transform hover:scale-105 flex items-center justify-center">
                            <img 
                                loading="lazy"
                                src="{{ asset('storage/assets/ok.png') }}" 
                                class="w-6 h-6 mr-2" 
                                alt="Save icon"
                            />
                            Guardar formación
                        </button>
                    </div>
                </form>

                <!-- Lista de formaciones académicas existentes -->
                @foreach($educaciones as $edu)
                <div class="mt-4 w-full max-w-[985px] bg-white p-6 rounded-xl shadow-lg border border-gray-200">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-xl font-bold text-slate-900">{{ $edu->titulo_grado }}</h3>
                            <p class="text-lg text-slate-700">{{ $edu->institucion }}</p>
                            <p class="text-sm text-slate-600">
                                {{ $edu->fecha_inicio }} - {{ $edu->fecha_fin ?? 'Presente' }}
                            </p>
                            <p class="mt-2 text-slate-700">{{ $edu->descripcion }}</p>
                        </div>
                        <div class="flex gap-2">
                            <button class="p-2 bg-blue-100 rounded-md hover:bg-blue-200">
                                <!-- Icono de editar -->
                            </button>
                            <button onclick="deleteEducation({{ $edu->id }})" class="p-2 bg-red-100 rounded-md hover:bg-red-200">
                                <!-- Icono de eliminar -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Sección de Habilidades y Competencias -->
            <div class="flex flex-col items-center mt-6 w-full">
                <section class="flex flex-col w-full text-2xl font-bold text-slate-900 text-center">
                    <div class="flex gap-2 px-4 py-2 bg-blue-100 rounded-xl border-b border-slate-900 shadow-md transition-transform transform hover:scale-105 items-center cursor-pointer justify-center">
                        <h2 class="my-auto font-bold">Habilidades y Competencias</h2>
                        <img 
                            loading="lazy"
                            src="{{ asset('storage/assets/contacto.png') }}" 
                            class="object-contain shrink-0 aspect-[0.87] w-[45px]"
                            alt="Skills icon"
                        />
                    </div>
                </section>

                <!-- Botón "Añadir Habilidad Blanda" -->
                <button
                    id="toggleSoftSkillBtn"
                    type="button"
                    class="mt-4 px-6 py-2 bg-blue-100 rounded-xl border-b-2 border-slate-900 text-neutral-700 font-semibold shadow-md transition-transform transform hover:scale-105 flex items-center justify-center"
                >
                    <img 
                        loading="lazy"
                        src="{{ asset('storage/assets/mass.png') }}" 
                        class="w-6 h-6 mr-2" 
                        alt="Add icon"
                    />
                    <span>Añadir habilidad blanda</span>
                </button>

                <!-- Formulario de habilidad blanda -->
                <form 
                    id="softSkillForm"
                    data-form-type="soft-skills"
                    class="form-transition form-hidden mt-4 w-full max-w-[985px] bg-white p-6 rounded-xl shadow-lg border border-gray-200"
                    style="display: none;"
                >
                    @csrf
                    <div class="flex flex-col space-y-2">
                        <label for="softSkill" class="text-xl font-bold text-slate-900">Habilidad Blanda</label>
                        <input 
                            id="softSkill" 
                            name="nombre" 
                            type="text" 
                            class="px-4 py-2 w-full bg-blue-100 rounded-md border-b-2 border-slate-900 text-neutral-700" 
                            required 
                        />
                    </div>
                    
                    <div class="mt-6 flex justify-end">
                        <button type="submit" class="px-6 py-2 bg-blue-100 rounded-xl border-b-2 border-slate-900 text-neutral-700 font-semibold shadow-md transition-transform transform hover:scale-105 flex items-center justify-center">
                            <img 
                                loading="lazy"
                                src="{{ asset('storage/assets/ok.png') }}" 
                                class="w-6 h-6 mr-2" 
                                alt="Save icon"
                            />
                            Guardar habilidad blanda
                        </button>
                    </div>
                </form>

                <!-- Botón "Añadir Habilidad Técnica" -->
                <button
                    id="toggleHardSkillBtn"
                    type="button"
                    class="mt-4 px-6 py-2 bg-blue-100 rounded-xl border-b-2 border-slate-900 text-neutral-700 font-semibold shadow-md transition-transform transform hover:scale-105 flex items-center justify-center"
                >
                    <img 
                        loading="lazy"
                        src="{{ asset('storage/assets/mass.png') }}" 
                        class="w-6 h-6 mr-2" 
                        alt="Add icon"
                    />
                    <span>Añadir habilidad técnica</span>
                </button>

                <!-- Formulario de habilidad técnica -->
                <form 
                    id="hardSkillForm"
                    data-form-type="hard-skills"
                    class="form-transition form-hidden mt-4 w-full max-w-[985px] bg-white p-6 rounded-xl shadow-lg border border-gray-200"
                    style="display: none;"
                >
                    @csrf
                    <div class="flex flex-col space-y-2">
                        <label for="hardSkill" class="text-xl font-bold text-slate-900">Habilidad Técnica</label>
                        <input 
                            id="hardSkill" 
                            name="nombre" 
                            type="text" 
                            class="px-4 py-2 w-full bg-blue-100 rounded-md border-b-2 border-slate-900 text-neutral-700" 
                            required 
                        />
                    </div>

                    <div class="mt-6 flex justify-end">
                        <button type="submit" class="px-6 py-2 bg-blue-100 rounded-xl border-b-2 border-slate-900 text-neutral-700 font-semibold shadow-md transition-transform transform hover:scale-105 flex items-center justify-center">
                            <img 
                                loading="lazy"
                                src="{{ asset('storage/assets/ok.png') }}" 
                                class="w-6 h-6 mr-2" 
                                alt="Save icon"
                            />
                            Guardar habilidad técnica
                        </button>
                    </div>
                </form>

                <!-- Lista de habilidades existentes -->
                <div class="mt-6 w-full max-w-[985px] grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Habilidades Blandas -->
                    <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200">
                        <h3 class="text-xl font-bold text-slate-900 mb-4">Habilidades Blandas</h3>
                        @foreach($habilidades as $habilidad)
                            @if($habilidad->tipo_habilidad === 'soft')
                            <div class="flex justify-between items-center mb-2 p-2 bg-blue-50 rounded-md">
                                <span class="text-slate-700">{{ $habilidad->nombre }}</span>
                                <button 
                                    onclick="deleteSkill({{ $habilidad->id }})"
                                    class="p-1 bg-red-100 rounded-md hover:bg-red-200"
                                >
                                    <img src="{{ asset('storage/assets/eliminar.png') }}" alt="Eliminar" class="w-4 h-4">
                                </button>
                            </div>
                            @endif
                        @endforeach
                    </div>

                    <!-- Habilidades Técnicas -->
                    <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200">
                        <h3 class="text-xl font-bold text-slate-900 mb-4">Habilidades Técnicas</h3>
                        @foreach($habilidades as $habilidad)
                            @if($habilidad->tipo_habilidad === 'hard')
                            <div class="flex justify-between items-center mb-2 p-2 bg-blue-50 rounded-md">
                                <span class="text-slate-700">{{ $habilidad->nombre }}</span>
                                <button 
                                    onclick="deleteSkill({{ $habilidad->id }})"
                                    class="p-1 bg-red-100 rounded-md hover:bg-red-200"
                                >
                                    <img src="{{ asset('storage/assets/eliminar.png') }}" alt="Eliminar" class="w-4 h-4">
                                </button>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- Sección de Idiomas -->
            <div class="flex flex-col items-center mt-6 w-full">
                <section class="flex flex-col w-full text-2xl font-bold text-slate-900 text-center">
                    <div class="flex gap-2 px-4 py-2 bg-blue-100 rounded-xl border-b border-slate-900 shadow-md transition-transform transform hover:scale-105 items-center cursor-pointer justify-center">
                        <h2 class="my-auto font-bold">Idiomas</h2>
                        <img 
                            loading="lazy"
                            src="{{ asset('storage/assets/idiomas.png') }}"
                            class="object-contain shrink-0 aspect-[0.87] w-[45px]"
                            alt="Language icon"
                        />
                    </div>
                </section>

                <!-- Botón "Añadir idioma" -->
                <button
                    id="toggleLanguageBtn"
                    type="button"
                    class="mt-4 px-6 py-2 bg-blue-100 rounded-xl border-b-2 border-slate-900 text-neutral-700 font-semibold shadow-md transition-transform transform hover:scale-105 flex items-center justify-center"
                >
                    <img 
                        loading="lazy"
                        src="{{ asset('storage/assets/mass.png') }}" 
                        class="w-6 h-6 mr-2" 
                        alt="Add icon"
                    />
                    <span>Añadir idioma</span>
                </button>

                <!-- Formulario de idiomas -->
                <form 
                    id="languageForm"
                    data-form-type="languages"
                    class="form-transition form-hidden mt-4 w-full max-w-[985px] bg-white p-6 rounded-xl shadow-lg border border-gray-200"
                    style="display: none;"
                >
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex flex-col space-y-2">
                            <label for="language" class="text-xl font-bold text-slate-900">Idioma</label>
                            <input 
                                id="language" 
                                name="nombre" 
                                type="text" 
                                class="px-4 py-2 w-full bg-blue-100 rounded-md border-b-2 border-slate-900 text-neutral-700" 
                                required 
                            />
                        </div>

                        <div class="flex flex-col space-y-2">
                            <label for="proficiency" class="text-xl font-bold text-slate-900">Nivel de Dominio</label>
                            <select 
                                id="proficiency" 
                                name="nivel_dominio" 
                                class="px-4 py-2 w-full bg-blue-100 rounded-md border-b-2 border-slate-900 text-neutral-700"
                                required
                            >
                                <option value="">Selecciona un nivel</option>
                                <option value="Básico">Básico</option>
                                <option value="Intermedio">Intermedio</option>
                                <option value="Avanzado">Avanzado</option>
                                <option value="Nativo">Nativo</option>
                            </select>
                        </div>

                        <div class="flex flex-col space-y-2">
                            <label for="certification" class="text-xl font-bold text-slate-900">Certificación (Opcional)</label>
                            <input 
                                id="certification" 
                                name="certificacion" 
                                type="text" 
                                class="px-4 py-2 w-full bg-blue-100 rounded-md border-b-2 border-slate-900 text-neutral-700" 
                            />
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <button type="submit" class="px-6 py-2 bg-blue-100 rounded-xl border-b-2 border-slate-900 text-neutral-700 font-semibold shadow-md transition-transform transform hover:scale-105 flex items-center justify-center">
                            <img 
                                loading="lazy"
                                src="{{ asset('storage/assets/ok.png') }}" 
                                class="w-6 h-6 mr-2" 
                                alt="Save icon"
                            />
                            Guardar idioma
                        </button>
                    </div>
                </form>

                <!-- Lista de idiomas existentes -->
                <div class="mt-6 w-full max-w-[985px]">
                    @foreach($idiomas as $idioma)
                    <div class="mb-4 bg-white p-6 rounded-xl shadow-lg border border-gray-200">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-xl font-bold text-slate-900">{{ $idioma->nombre }}</h3>
                                <p class="text-lg text-slate-700">Nivel: {{ $idioma->nivel_dominio }}</p>
                                @if($idioma->certificacion)
                                    <p class="text-sm text-slate-600">Certificación: {{ $idioma->certificacion }}</p>
                                @endif
                            </div>
                            <div class="flex gap-2">
                                <button 
                                    onclick="editLanguage({{ $idioma->id }})"
                                    class="p-2 bg-blue-100 rounded-md hover:bg-blue-200"
                                >
                                    <img src="{{ asset('storage/assets/editar.png') }}" alt="Editar" class="w-5 h-5">
                                </button>
                                <button 
                                    onclick="deleteLanguage({{ $idioma->id }})"
                                    class="p-2 bg-red-100 rounded-md hover:bg-red-200"
                                >
                                    <img src="{{ asset('storage/assets/eliminar.png') }}" alt="Eliminar" class="w-5 h-5">
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Sección de Proyectos -->
            <div class="flex flex-col items-center mt-6 w-full">
                <section class="flex flex-col w-full text-2xl font-bold text-slate-900 text-center">
                    <div class="flex gap-2 px-4 py-2 bg-blue-100 rounded-xl border-b border-slate-900 shadow-md transition-transform transform hover:scale-105 items-center cursor-pointer justify-center">
                        <h2 class="my-auto font-bold">Proyectos</h2>
                        <img 
                            loading="lazy"
                            src="{{ asset('storage/assets/expe.png') }}"
                            class="object-contain shrink-0 aspect-[0.87] w-[45px]"
                            alt="Project icon"
                        />
                    </div>
                </section>

                <!-- Botón "Añadir Proyecto Personal" -->
                <button
                    id="togglePersonalProjectBtn"
                    type="button"
                    class="mt-4 px-6 py-2 bg-blue-100 rounded-xl border-b-2 border-slate-900 text-neutral-700 font-semibold shadow-md transition-transform transform hover:scale-105 flex items-center justify-center"
                >
                    <img 
                        loading="lazy"
                        src="{{ asset('storage/assets/mass.png') }}" 
                        class="w-6 h-6 mr-2" 
                        alt="Add icon"
                    />
                    <span>Añadir proyecto personal</span>
                </button>

                <!-- Formulario de Proyecto Personal -->
                <form 
                    id="personalProjectForm"
                    data-form-type="personal-projects"
                    class="form-transition form-hidden mt-4 w-full max-w-[985px] bg-white p-6 rounded-xl shadow-lg border border-gray-200"
                    style="display: none;"
                >
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex flex-col space-y-2">
                            <label for="personalProjectName" class="text-xl font-bold text-slate-900">Nombre del Proyecto</label>
                            <input 
                                id="personalProjectName" 
                                name="nombre" 
                                type="text" 
                                class="px-4 py-2 w-full bg-blue-100 rounded-md border-b-2 border-slate-900 text-neutral-700" 
                                required 
                            />
                        </div>

                        <div class="flex flex-col space-y-2">
                            <label for="personalProjectUrl" class="text-xl font-bold text-slate-900">URL del Proyecto (Opcional)</label>
                            <input 
                                id="personalProjectUrl" 
                                name="url" 
                                type="url" 
                                class="px-4 py-2 w-full bg-blue-100 rounded-md border-b-2 border-slate-900 text-neutral-700" 
                                placeholder="https://ejemplo.com"
                            />
                        </div>

                        <div class="flex flex-col space-y-2">
                            <label for="personalProjectStartDate" class="text-xl font-bold text-slate-900">Fecha de Inicio</label>
                            <input 
                                id="personalProjectStartDate" 
                                name="fecha_inicio" 
                                type="date" 
                                class="px-4 py-2 w-full bg-blue-100 rounded-md border-b-2 border-slate-900 text-neutral-700" 
                                required 
                            />
                        </div>

                        <div class="flex flex-col space-y-2">
                            <label for="personalProjectEndDate" class="text-xl font-bold text-slate-900">Fecha de Finalización</label>
                            <input 
                                id="personalProjectEndDate" 
                                name="fecha_fin" 
                                type="date" 
                                class="px-4 py-2 w-full bg-blue-100 rounded-md border-b-2 border-slate-900 text-neutral-700" 
                            />
                        </div>
                    </div>

                    <div class="flex flex-col space-y-2 mt-4">
                        <label for="personalProjectDescription" class="text-xl font-bold text-slate-900">Descripción</label>
                        <textarea 
                            id="personalProjectDescription" 
                            name="descripcion" 
                            rows="4" 
                            class="px-4 py-2 w-full bg-blue-100 rounded-md border-b-2 border-slate-900 text-neutral-700 resize-none"
                            required
                        ></textarea>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <button type="submit" class="px-6 py-2 bg-blue-100 rounded-xl border-b-2 border-slate-900 text-neutral-700 font-semibold shadow-md transition-transform transform hover:scale-105 flex items-center justify-center">
                            <img 
                                loading="lazy"
                                src="{{ asset('storage/assets/ok.png') }}" 
                                class="w-6 h-6 mr-2" 
                                alt="Save icon"
                            />
                            Guardar proyecto personal
                        </button>
                    </div>
                </form>

                <!-- Botón "Añadir Proyecto Académico" -->
                <button
                    id="toggleAcademicProjectBtn"
                    type="button"
                    class="mt-4 px-6 py-2 bg-blue-100 rounded-xl border-b-2 border-slate-900 text-neutral-700 font-semibold shadow-md transition-transform transform hover:scale-105 flex items-center justify-center"
                >
                    <img 
                        loading="lazy"
                        src="{{ asset('storage/assets/mass.png') }}" 
                        class="w-6 h-6 mr-2" 
                        alt="Add icon"
                    />
                    <span>Añadir proyecto académico</span>
                </button>

                <!-- Formulario de Proyecto Académico -->
                <form 
                    id="academicProjectForm"
                    data-form-type="academic-projects"
                    class="form-transition form-hidden mt-4 w-full max-w-[985px] bg-white p-6 rounded-xl shadow-lg border border-gray-200"
                    style="display: none;"
                >
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex flex-col space-y-2">
                            <label for="academicProjectName" class="text-xl font-bold text-slate-900">Nombre del Proyecto</label>
                            <input 
                                id="academicProjectName" 
                                name="nombre" 
                                type="text" 
                                class="px-4 py-2 w-full bg-blue-100 rounded-md border-b-2 border-slate-900 text-neutral-700" 
                                required 
                            />
                        </div>

                        <div class="flex flex-col space-y-2">
                            <label for="academicProjectTech" class="text-xl font-bold text-slate-900">Tecnologías Utilizadas</label>
                            <input 
                                id="academicProjectTech" 
                                name="tecnologias" 
                                type="text" 
                                class="px-4 py-2 w-full bg-blue-100 rounded-md border-b-2 border-slate-900 text-neutral-700" 
                                required 
                            />
                        </div>

                        <div class="flex flex-col space-y-2">
                            <label for="academicProjectStartDate" class="text-xl font-bold text-slate-900">Fecha de Inicio</label>
                            <input 
                                id="academicProjectStartDate" 
                                name="fecha_inicio" 
                                type="date" 
                                class="px-4 py-2 w-full bg-blue-100 rounded-md border-b-2 border-slate-900 text-neutral-700" 
                                required 
                            />
                        </div>

                        <div class="flex flex-col space-y-2">
                            <label for="academicProjectEndDate" class="text-xl font-bold text-slate-900">Fecha de Finalización</label>
                            <input 
                                id="academicProjectEndDate" 
                                name="fecha_fin" 
                                type="date" 
                                class="px-4 py-2 w-full bg-blue-100 rounded-md border-b-2 border-slate-900 text-neutral-700" 
                            />
                        </div>

                        <div class="flex flex-col space-y-2">
                            <label for="academicProjectUrl" class="text-xl font-bold text-slate-900">URL del Proyecto (Opcional)</label>
                            <input 
                                id="academicProjectUrl" 
                                name="url" 
                                type="url" 
                                class="px-4 py-2 w-full bg-blue-100 rounded-md border-b-2 border-slate-900 text-neutral-700" 
                                placeholder="https://ejemplo.com"
                            />
                        </div>
                    </div>

                    <div class="flex flex-col space-y-2 mt-4">
                        <label for="academicProjectDescription" class="text-xl font-bold text-slate-900">Descripción</label>
                        <textarea 
                            id="academicProjectDescription" 
                            name="descripcion" 
                            rows="4" 
                            class="px-4 py-2 w-full bg-blue-100 rounded-md border-b-2 border-slate-900 text-neutral-700 resize-none"
                            required
                        ></textarea>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <button type="submit" class="px-6 py-2 bg-blue-100 rounded-xl border-b-2 border-slate-900 text-neutral-700 font-semibold shadow-md transition-transform transform hover:scale-105 flex items-center justify-center">
                            <img 
                                loading="lazy"
                                src="{{ asset('storage/assets/ok.png') }}" 
                                class="w-6 h-6 mr-2" 
                                alt="Save icon"
                            />
                            Guardar proyecto académico
                        </button>
                    </div>
                </form>

                <!-- Lista de proyectos existentes -->
                <div class="mt-6 w-full max-w-[985px] grid grid-cols-1 gap-4">
                    <!-- Proyectos Personales -->
                    <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200">
                        <h3 class="text-xl font-bold text-slate-900 mb-4">Proyectos Personales</h3>
                        @foreach($proyectos as $proyecto)
                            @if($proyecto->tipo === 'personal')
                            <div class="mb-4 p-4 bg-blue-50 rounded-lg">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="text-lg font-semibold text-slate-900">{{ $proyecto->nombre }}</h4>
                                        <p class="text-sm text-slate-600">
                                            {{ \Carbon\Carbon::parse($proyecto->fecha_inicio)->format('M Y') }} - 
                                            {{ $proyecto->fecha_fin ? \Carbon\Carbon::parse($proyecto->fecha_fin)->format('M Y') : 'Presente' }}
                                        </p>
                                        <p class="mt-2 text-slate-700">{{ $proyecto->descripcion }}</p>
                                        @if($proyecto->url)
                                            <a href="{{ $proyecto->url }}" target="_blank" class="text-blue-600 hover:text-blue-800 mt-2 inline-block">
                                                Ver proyecto
                                            </a>
                                        @endif
                                    </div>
                                    <div class="flex gap-2">
                                        <button 
                                            onclick="editProject({{ $proyecto->id }})"
                                            class="p-2 bg-blue-100 rounded-md hover:bg-blue-200"
                                        >
                                            <img src="{{ asset('storage/assets/editar.png') }}" alt="Editar" class="w-5 h-5">
                                        </button>
                                        <button 
                                            onclick="deleteProject({{ $proyecto->id }})"
                                            class="p-2 bg-red-100 rounded-md hover:bg-red-200"
                                        >
                                            <img src="{{ asset('storage/assets/eliminar.png') }}" alt="Eliminar" class="w-5 h-5">
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>

                    <!-- Proyectos Académicos -->
                    <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200">
                        <h3 class="text-xl font-bold text-slate-900 mb-4">Proyectos Académicos</h3>
                        @foreach($proyectos as $proyecto)
                            @if($proyecto->tipo === 'academico')
                            <div class="mb-4 p-4 bg-blue-50 rounded-lg">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="text-lg font-semibold text-slate-900">{{ $proyecto->nombre }}</h4>
                                        <p class="text-sm text-slate-600">
                                            {{ \Carbon\Carbon::parse($proyecto->fecha_inicio)->format('M Y') }} - 
                                            {{ $proyecto->fecha_fin ? \Carbon\Carbon::parse($proyecto->fecha_fin)->format('M Y') : 'Presente' }}
                                        </p>
                                        <p class="text-sm font-medium text-slate-700">Tecnologías: {{ $proyecto->tecnologias }}</p>
                                        <p class="mt-2 text-slate-700">{{ $proyecto->descripcion }}</p>
                                        @if($proyecto->url)
                                            <a href="{{ $proyecto->url }}" target="_blank" class="text-blue-600 hover:text-blue-800 mt-2 inline-block">
                                                Ver proyecto
                                            </a>
                                        @endif
                                    </div>
                                    <div class="flex gap-2">
                                        <button 
                                            onclick="editProject({{ $proyecto->id }})"
                                            class="p-2 bg-blue-100 rounded-md hover:bg-blue-200"
                                        >
                                            <img src="{{ asset('storage/assets/editar.png') }}" alt="Editar" class="w-5 h-5">
                                        </button>
                                        <button 
                                            onclick="deleteProject({{ $proyecto->id }})"
                                            class="p-2 bg-red-100 rounded-md hover:bg-red-200"
                                        >
                                            <img src="{{ asset('storage/assets/eliminar.png') }}" alt="Eliminar" class="w-5 h-5">
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </article>
    </section>
</main>

<style>
.info-section {
    padding: 1rem;
    background-color: #e0e7ff;
    border-radius: 0.5rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}
.info-section:hover {
    transform: scale(1.05);
}
</style>

<script>
function deleteExperience(id) {
        if (confirm('¿Estás seguro de que deseas eliminar esta experiencia?')) {
            fetch(`/experience/${id}`, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    window.location.reload();
                } else {
                    alert(data.message || 'Error al eliminar la experiencia');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al eliminar la experiencia');
            });
        }
    }function editExperience(id) {
    const form = document.getElementById('experienceForm');
    const submitBtn = form.querySelector('button[type="submit"]');
    
    console.log('Editando experiencia ID:', id); // Debug
    
    fetch(`/experience/${id}`, {
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('Datos recibidos:', data); // Debug
            
            // Rellenar el formulario con los datos
            form.querySelector('#company').value = data.experience.empresa;
            form.querySelector('#position').value = data.experience.cargo;
            form.querySelector('#startDate').value = data.experience.fecha_inicio;
            form.querySelector('#endDate').value = data.experience.fecha_finalizacion || '';
            form.querySelector('#description').value = data.experience.descripcion;
            
            // Establecer el método y la acción
            form.querySelector('input[name="_method"]').value = 'PUT';
            form.setAttribute('action', `/experience/${id}`);
            console.log('URL del formulario:', form.action);
            
            console.log('Método del formulario:', form.querySelector('input[name="_method"]').value); // Debug
            console.log('Acción del formulario:', form.action); // Debug
            
            // Mostrar el formulario
            toggleFormVisibility('experienceForm', 'toggleExperienceBtn', 'isExperienceFormVisible');
            
            // Cambiar el texto del botón
            submitBtn.querySelector('span').textContent = 'Actualizar experiencia';
            
            // Agregar un event listener para el submit
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                console.log('Formulario enviado');
                console.log('Método:', form.querySelector('input[name="_method"]').value);
                console.log('Acción:', form.action);
                
                // Enviar el formulario manualmente
                const formData = new FormData(form);
                
                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'X-HTTP-Method-Override': 'PUT'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Experiencia actualizada correctamente');
                        window.location.reload();
                    } else {
                        alert(data.message || 'Error al actualizar la experiencia');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al actualizar la experiencia');
                });
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error al cargar los datos de la experiencia');
    });
}
     // Variables para controlar la visibilidad de los formularios
     let state = {
        isEducationFormVisible: false,
        isExperienceFormVisible: false,
        isSoftSkillFormVisible: false,
        isHardSkillFormVisible: false,
        isLanguageFormVisible: false,
        isPersonalProjectFormVisible: false,
        isAcademicProjectFormVisible: false
    };
    function toggleFormVisibility(formId, buttonId, formType) {
        const form = document.getElementById(formId);
        const button = document.getElementById(buttonId);
        
        if (!form || !button) {
            console.error(`No se encontró el formulario ${formId} o el botón ${buttonId}`);
            return;
        }
        
        state[formType] = !state[formType];
        
        if (state[formType]) {
            // Primero hacemos visible el formulario
            form.style.display = 'block';
            // Esperamos un momento para que el navegador procese el cambio
            setTimeout(() => {
                form.classList.remove('form-hidden');
                form.classList.add('form-visible');
                button.querySelector('span').textContent = `Ocultar formulario`;
            }, 10);
        } else {
            form.classList.remove('form-visible');
            form.classList.add('form-hidden');
            // Esperamos a que termine la transición antes de ocultar
            setTimeout(() => {
                form.style.display = 'none';
            }, 500);
            button.querySelector('span').textContent = `Añadir ${formType.replace('is', '').replace('FormVisible', '')}`;
        }
    }
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('profile_photo');
    const previewImage = document.getElementById('profilePhotoPreview');
    const form = document.getElementById('profileForm');

    fileInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
            }
            reader.readAsDataURL(file);
            
            // Actualizar el campo oculto del formulario
            const formFileInput = document.getElementById('profile_photo1');
            formFileInput.files = fileInput.files;
        }
    });

    form.addEventListener('submit', function(event) {
        event.preventDefault();
        
        const formData = new FormData(form);
        
        // Depurar los datos que se están enviando
        console.log('Datos del formulario:');
        for (let pair of formData.entries()) {
            console.log(pair[0] + ': ' + pair[1]);
        }
        
        // Si hay un archivo seleccionado en el input visible, añadirlo al FormData
        if (fileInput.files[0]) {
            formData.set('profile_photo', fileInput.files[0]);
            console.log('Archivo adjunto:', fileInput.files[0].name);
        }
        
        fetch('{{ route('user.update-profile') }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            credentials: 'same-origin'
        })
        .then(response => response.json())
        .then(data => {
            console.log('Respuesta del servidor:', data);
            if (data.success) {
                alert(data.message);
                window.location.reload();
            } else {
                alert(data.message || 'No se realizaron cambios');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al actualizar el perfil: ' + error.message);
        });
    });

   

    // Función para alternar la visibilidad de los formularios
   

    // Agregar los estilos CSS necesarios
    const style = document.createElement('style');
    style.textContent = `
        .form-transition {
            transition: all 0.5s ease-in-out;
            overflow: hidden;
        }
        
        .form-visible {
            opacity: 1;
            max-height: 2000px; /* Valor suficientemente grande para el contenido */
            margin-top: 1rem;
        }
        
        .form-hidden {
            opacity: 0;
            max-height: 0;
            margin-top: 0;
        }
    `;
    document.head.appendChild(style);

    // Asegurarnos de que el formulario de idiomas tenga las clases correctas
    const languageForm = document.getElementById('languageForm');
    if (languageForm) {
        languageForm.classList.add('form-transition', 'form-hidden');
    }
    
    // Event listener específico para el botón de idiomas
    document.getElementById('toggleLanguageBtn').addEventListener('click', () => {
        toggleFormVisibility('languageForm', 'toggleLanguageBtn', 'isLanguageFormVisible');
    });

    // Event listeners para los botones
    document.getElementById('toggleExperienceBtn').addEventListener('click', () => {
        toggleFormVisibility('experienceForm', 'toggleExperienceBtn', 'isExperienceFormVisible');
    });

    document.getElementById('toggleEducationBtn').addEventListener('click', () => {
        toggleFormVisibility('educationForm', 'toggleEducationBtn', 'isEducationFormVisible');
    });

    document.getElementById('toggleSoftSkillBtn').addEventListener('click', () => {
        toggleFormVisibility('softSkillForm', 'toggleSoftSkillBtn', 'isSoftSkillFormVisible');
    });

    document.getElementById('toggleHardSkillBtn').addEventListener('click', () => {
        toggleFormVisibility('hardSkillForm', 'toggleHardSkillBtn', 'isHardSkillFormVisible');
    });

    // Manejadores de formularios - Modificar esta sección
    const forms = document.querySelectorAll('form[data-form-type]');
    forms.forEach(form => {
        // Primero removemos cualquier event listener existente
        const newForm = form.cloneNode(true);
        form.parentNode.replaceChild(newForm, form);
        
        newForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formType = this.dataset.formType;
            const formData = new FormData(this);
            
            try {
                const response = await fetch(`/${formType}`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                });
                
                const data = await response.json();
                
                if (data.success) {
                    alert(data.message);
                    window.location.reload();
                } else {
                    alert(data.message || 'Error al guardar');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Error al procesar la solicitud');
            }
        });
    });

    // Remover el event listener específico de idiomas que está duplicado
    // Eliminar o comentar esta sección ya que ahora está manejada por el código anterior
    /*
    document.getElementById('languageForm').addEventListener('submit', async function(e) {
        // ... código del event listener ...
    });
    */

    // Agregar dentro del bloque script existente

   

    

    // Agregar dentro del bloque script existente

    function editEducation(id) {
        const form = document.getElementById('educationForm');
        const submitBtn = form.querySelector('button[type="submit"]');
        
        fetch(`/education/${id}`, {
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                form.querySelector('#institution').value = data.education.institucion;
                form.querySelector('#degree').value = data.education.titulo_grado;
                form.querySelector('#fieldOfStudy').value = data.education.campo_estudio;
                form.querySelector('#eduStartDate').value = data.education.fecha_inicio;
                form.querySelector('#eduEndDate').value = data.education.fecha_fin || '';
                form.querySelector('#eduDescription').value = data.education.descripcion || '';
                
                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'PUT';
                form.appendChild(methodInput);
                
                form.action = `/education/${id}`;
                toggleFormVisibility('educationForm', 'toggleEducationBtn', 'isEducationFormVisible');
                submitBtn.querySelector('span').textContent = 'Actualizar formación';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al cargar los datos de la formación académica');
        });
    }

    // Agregar el event listener para el formulario de educación
    document.getElementById('educationForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        
        try {
            const response = await fetch(this.action || '/education', {
                method: this.querySelector('input[name="_method"]')?.value || 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            });
            
            const data = await response.json();
            
            if (data.success) {
                alert(data.message);
                window.location.reload();
            } else {
                alert(data.message || 'Error al guardar la formación académica');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Error al procesar la solicitud');
        }
    });
});
document.getElementById('editSobreMiBtn').addEventListener('click', function() {
    document.getElementById('sobreMiForm').classList.toggle('hidden');
});
document.addEventListener('DOMContentLoaded', function() {
    const editSobreMiBtn = document.getElementById('editSobreMiBtn');
    const sobreMiTitulo = document.getElementById('sobreMiTitulo');
    const sobreMiContenido = document.getElementById('sobreMiContenido');

    if (editSobreMiBtn && sobreMiTitulo && sobreMiContenido) {
        editSobreMiBtn.addEventListener('click', async function() {
            const titulo = sobreMiTitulo.value;
            const contenido = sobreMiContenido.value;

            try {
                const response = await fetch('/profile/sobre-mi', {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        sobre_mi_titulo: titulo,
                        sobre_mi_contenido: contenido
                    })
                });

                const data = await response.json();
                if (data.success) {
                    alert(data.message);
                    window.location.reload();
                } else {
                    alert(data.message || 'No se realizaron cambios');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Error al actualizar el perfil: ' + error.message);
            }
        });
    } else {
        console.error('Elementos no encontrados en el DOM');
    }
});
document.getElementById('educationForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    
    try {
        const response = await fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        });
        
        const data = await response.json();
        
        if (data.success) {
            alert(data.message);
            window.location.reload();
        } else {
            alert(data.message || 'Error al guardar la formación académica');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Error al procesar la solicitud');
    }
});
function deleteEducation(id) {
    if (confirm('¿Estás seguro de que deseas eliminar esta formación académica?')) {
        fetch(`/education/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                window.location.reload();
            } else {
                alert(data.message || 'Error al eliminar la formación académica');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al procesar la solicitud');
        });
    }
}

// Agregar manejador para el formulario de idiomas
document.getElementById('languageForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    try {
        const formData = new FormData(this);
        const response = await fetch('/languages', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: formData
        });
        
        const data = await response.json();
        
        if (data.success) {
            alert(data.message);
            window.location.reload();
        } else {
            alert(data.message || 'Error al guardar el idioma');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Error al procesar la solicitud');
    }
});

// Función para eliminar idioma
function deleteLanguage(id) {
    if (confirm('¿Estás seguro de que deseas eliminar este idioma?')) {
        fetch(`/languages/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                window.location.reload();
            } else {
                alert(data.message || 'Error al eliminar el idioma');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al procesar la solicitud');
        });
    }
}

// Función para editar idioma
function editLanguage(id) {
    fetch(`/languages/${id}`, {
        headers: {
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const form = document.getElementById('languageForm');
            form.querySelector('#language').value = data.language.nombre;
            form.querySelector('#proficiency').value = data.language.nivel_dominio;
            form.querySelector('#certification').value = data.language.certificacion || '';
            
            // Cambiar el método a PUT
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'PUT';
            form.appendChild(methodInput);
            
            // Cambiar la acción del formulario
            form.action = `/languages/${id}`;
            
            // Mostrar el formulario
            toggleFormVisibility('languageForm', 'toggleLanguageBtn', 'isLanguageFormVisible');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error al cargar los datos del idioma');
    });
}
</script>
@endsection
