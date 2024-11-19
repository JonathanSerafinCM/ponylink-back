@extends('layouts.main_layout')

@section('content')
    <main class="flex overflow-hidden flex-col items-center px-20 pt-9 pb-56 bg-cover bg-center max-md:px-5 max-md:pb-24" style="background-image: url('{{ asset('images/fondo2.png') }}'); background-attachment: fixed;">
        <section class="flex flex-col w-full max-w-[985px] max-md:max-w-full">
            <article class="flex flex-col items-center px-14 pt-3 pb-14 w-full bg-white rounded-3xl shadow-lg max-md:px-5 max-md:max-w-full">
                <!-- Imagen del perfil -->
                <div class="flex justify-center mt-6">
                    <div class="bg-red-600 p-2 rounded-full">
                        <img 
                            src="{{ $userProfile->profile_photo_path ? asset('storage/' . $userProfile->profile_photo_path) : asset('storage/assets/default-profile.png') }}" 
                            alt="Foto de perfil" 
                            class="object-cover rounded-full w-[160px] h-[160px] shadow-md" 
                        />
                    </div>
                </div>

                <!-- Nombre del perfil -->
                <h1 class="mt-4 text-4xl font-bold text-slate-900 text-center">
                    {{ $userProfile->user_name }}
                </h1>

                <!-- Íconos de contacto (email, teléfono, ubicación) -->
                <div class="flex flex-col items-center mt-4 space-y-4">
                    <div class="flex items-center space-x-3 w-full justify-start">
                        <img src="{{ asset('images/correo.png') }}" alt="Email icon" class="w-6 h-6">
                        <span class="text-slate-900 text-lg">{{ $userProfile->email }}</span>
                    </div>
                    
                    <div class="flex items-center space-x-3 w-full justify-start">
                        <img src="{{ asset('images/call.png') }}" alt="Phone icon" class="w-6 h-6">
                        <span class="text-slate-900 text-lg">{{ $userProfile->telefono}}</span>
                    </div>
                    
                    <div class="flex items-center space-x-3 w-full justify-start">
                        <img src="{{ asset('images/ubicacion.png') }}" alt="Location icon" class="w-6 h-6">
                        <span class="text-slate-900 text-lg">{{ $userProfile->ubicacion }}</span>
                    </div>
                </div>

                <!-- Contenedor azul claro con los iconos centrados -->
                <div class="flex justify-center items-center px-10 py-4 mt-6 bg-sky-100 bg-opacity-70 rounded-lg shadow-lg w-full">
                    <div class="flex justify-center space-x-6">
                        <div class="flex flex-col items-center">
                            <div class="flex items-center justify-center bg-zinc-300 rounded-full h-[80px] w-[80px] border-4 border-sky-900">
                                <img loading="lazy" src="{{ asset('images/contacto.png') }}" alt="Contact icon" class="object-contain w-[40px] h-[40px]" />
                            </div>
                            <h2 class="mt-2 text-xl font-semibold text-center text-slate-900">Contactar</h2>
                        </div>
                        
                        <div class="flex flex-col items-center">
                            <div class="flex items-center justify-center bg-zinc-300 rounded-full h-[80px] w-[80px] border-4 border-sky-900">
                                <img loading="lazy" src="{{ asset('images/cv.png') }}" alt="View CV icon" class="object-contain w-[40px] h-[40px]" />
                            </div>
                            <h2 class="mt-2 text-xl font-semibold text-center text-slate-900">Ver CV</h2>
                        </div>

                        <div class="flex flex-col items-center">
                            <div class="flex items-center justify-center bg-zinc-300 rounded-full h-[80px] w-[80px] border-4 border-green-600">
                                <img loading="lazy" src="{{ asset('images/buscar.png') }}" alt="Searching icon" class="object-contain w-[40px] h-[40px]" />
                            </div>
                            <h2 class="mt-2 text-xl font-semibold text-center text-slate-900">Buscando</h2>
                        </div>
                    </div>
                </div>

                                <!-- Secciones de información -->
                <section class="w-full mt-8 space-y-6">
                    <!-- Sobre mí -->
                    <div class="w-full p-4 bg-indigo-50 rounded-lg shadow-lg transition-transform transform hover:scale-105">
                        <div class="flex items-center">
                            <h2 class="text-2xl font-bold text-slate-900">{{ $userProfile->sobre_mi_titulo }}</h2>
                            <img src="{{ asset('images/sobremi.png') }}" alt="Icono de Sobre mí" class="w-6 h-6 ml-2" />
                        </div>
                        <p class="mt-2 text-slate-700">{{ $userProfile->sobre_mi_contenido }}</p>
                    </div>
                
                    <!-- Educación -->
                    <div class="w-full p-4 bg-indigo-50 rounded-lg shadow-lg transition-transform transform hover:scale-105">
                        <div class="flex items-center">
                            <h2 class="text-2xl font-bold text-slate-900">Educación</h2>
                            <img src="{{ asset('images/educacion.png') }}" alt="Icono de Educación" class="w-6 h-6 ml-2" />
                        </div>
                        <p class="mt-2 text-slate-700">{{ $userProfile->educacion }}</p>
                    </div>
                
                    <!-- Experiencia -->
                    <div class="w-full p-4 bg-indigo-50 rounded-lg shadow-lg transition-transform transform hover:scale-105">
                        <div class="flex items-center">
                            <h2 class="text-2xl font-bold text-slate-900">Experiencia</h2>
                            <img src="{{ asset('images/experiencia.png') }}" alt="Icono de Experiencia" class="w-6 h-6 ml-2" />
                        </div>
                        <p class="mt-2 text-slate-700">{{ $userProfile->experiencia_laboral }}</p>
                    </div>
                </section>

        <div class="flex justify-center mt-6">
            <section class="flex flex-col text-2xl font-bold whitespace-nowrap rounded-none max-w-[280px] text-slate-900">
                <div onclick="toggleConfig()" class="flex gap-4 px-4 py-2 bg-violet-100 rounded-xl border-b border-slate-900 shadow-md transition-transform transform hover:scale-105 items-center cursor-pointer">
                    <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/029c59522546c69e454c40a6c0b76974d1b9d531ed57ffaad4378c3fb0817e45?placeholderIfAbsent=true&apiKey=55e491f87d61487b9b7b3861f7502d13" class="object-contain shrink-0 aspect-[0.87] w-[45px]" alt="Configuration icon" />
                    <h2 class="grow shrink my-auto">Configuración</h2>
                </div>
            </section>
        </div>

        <!-- Sección de configuración desplegable -->
        <section id="config-section" class="hidden mt-4 p-4 bg-[#B6C4D6] rounded-xl shadow-md max-w-[600px] w-full">
            <h3 class="text-xl font-bold mb-4">Configuración</h3>

            <!-- Sección de Editar perfil y CV -->
            <div onclick="goToEditProfile()" class="flex gap-5 justify-between py-3.5 pl-3 bg-white rounded-xl border border-solid border-neutral-500 shadow-md transition-transform duration-300 ease-in-out hover:shadow-lg hover:scale-105">
                <div class="flex gap-3">
                    <div class="flex items-center justify-center bg-[#CCE2FF] rounded-lg h-[60px] w-[60px]">
                        <div class="flex items-center justify-center bg-[#CCE2FF] rounded-md h-[45px] w-[45px]">
                            <img src="{{ asset('assets/editar.png') }}" alt="Edit icon" class="object-contain w-[35px] h-[35px]" />
                        </div>
                    </div>
                    <div class="flex flex-col self-start mt-2.5">
                        <h2 class="text-xl font-bold text-stone-900">Editar perfil y CV</h2>
                        <p class="mt-1.5 text-sm text-stone-900">Actualizar datos personales.</p>
                    </div>
                </div>
            </div>

            <!-- Sección de Cerrar sesión -->
            <div onclick="logout()" class="flex gap-5 justify-between py-3.5 pl-3 bg-white rounded-xl border border-solid border-neutral-500 shadow-md transition-transform duration-300 ease-in-out hover:shadow-lg hover:scale-105 mt-2">
                <div class="flex gap-3">
                    <div class="flex items-center justify-center bg-[#CCE2FF] rounded-lg h-[60px] w-[60px]">
                        <div class="flex items-center justify-center bg-[#CCE2FF] rounded-md h-[45px] w-[45px]">
                            <img src="{{ asset('assets/salir.png') }}" alt="Logout icon" class="object-contain w-[35px] h-[35px]" />
                        </div>
                    </div>
                    <div class="flex flex-col self-start mt-2.5">
                        <h2 class="text-xl font-bold text-stone-900">Cerrar sesión</h2>
                        <p class="mt-1.5 text-sm text-stone-900">Cerrar sesión en tu cuenta.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('scripts')

@endsection
