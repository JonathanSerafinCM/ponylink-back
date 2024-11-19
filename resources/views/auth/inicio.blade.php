@extends('layouts.main_layout')

@section('content')
    <main class="flex overflow-hidden flex-col min-h-screen bg-cover bg-center" style="background-image: url('{{ asset('storage/assets/fondo.png') }}')">
        <div class="flex justify-center items-center min-h-screen bg-black bg-opacity-40">
            <div class="flex z-10 flex-col items-center py-6 px-8 max-w-full bg-white rounded-xl shadow-[0px_4px_4px_rgba(0,0,0,0.45)] w-[450px] max-md:px-5">
                <form id="loginForm" class="flex flex-col self-stretch w-full text-base text-stone-900 max-md:max-w-full">
                    @csrf
                    <!-- Ajuste del círculo de la imagen para evitar que se corte -->
                    <div class="w-[200px] h-[200px] rounded-full overflow-hidden self-center mb-6 shadow-[0px_4px_4px_rgba(0,0,0,0.45)]">
                        <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/2fe73ee0b7d23c2c13d1e5eca1344c4389f603bac3093fea44ff18f46ac4ff25?placeholderIfAbsent=true&apiKey=55e491f87d61487b9b7b3861f7502d13" alt="Login logo" class="w-full h-full object-cover" />
                    </div>

                    <h1 class="self-start text-2xl font-semibold text-slate-900 mb-6">
                        Iniciar Sesión
                    </h1>
                    
                    <label for="email" class="sr-only">Correo electrónico o usuario</label>
                    <input id="email" name="email" type="email" placeholder="Correo electrónico" class="w-full px-4 py-4 mt-3 text-base rounded-md border-b border-sky-900 bg-neutral-100 focus:outline-none focus:ring-2 focus:ring-sky-900 focus:border-transparent" required autofocus />
                    
                    <div class="relative mb-4">
                        <input id="password" name="password" type="password" placeholder="Contraseña" class="w-full px-4 py-4 mt-3 text-base rounded-md border-b border-sky-900 bg-neutral-100 focus:outline-none focus:ring-2 focus:ring-sky-900 focus:border-transparent" required />
                        <button type="button" onclick="togglePasswordVisibility()" class="absolute right-3 top-1/2 transform -translate-y-1/2 focus:outline-none flex items-center justify-center">
                            <img id="togglePasswordIcon" loading="lazy" src="{{ asset('storage/assets/closed.png') }}" alt="Toggle password visibility" class="w-5 h-5" />
                        </button>
                    </div>

                    <a href="#" class="self-end mb-4 text-xs text-red-800">¿Olvidaste tu contraseña?</a>

                    <button type="submit" class="px-4 py-3 mb-4 text-base font-bold text-white bg-sky-900 rounded-md border border-sky-900 w-full hover:bg-sky-800 focus:outline-none focus:ring-2 focus:ring-sky-900 focus:ring-offset-2">
                        Ingresar
                    </button>
                </form>

                <button onclick="goToRegister()" class="px-4 py-3 mb-6 text-base font-bold text-sky-900 rounded-md border border-sky-900 bg-neutral-100 w-full hover:bg-neutral-200 focus:outline-none focus:ring-2 focus:ring-sky-900 focus:ring-offset-2">
                    Crear Cuenta
                </button>

                <div class="shrink-0 mb-4 max-w-full h-px border border-solid border-sky-900 border-opacity-80 w-full"></div>
                <p class="mt-3.5 text-xs text-sky-900">Otras opciones</p>

                <div class="flex gap-4 items-start mt-5 max-w-full w-[182px]">
                    <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/5b829b7031e03ea51ef02b9a26a78650551580d5b02868516a6831b2f3331b8f?placeholderIfAbsent=true&apiKey=55e491f87d61487b9b7b3861f7502d13" alt="Social login option 1" class="object-contain shrink-0 w-[49px] h-[49px] rounded-full" />
                    <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/cc947fb46aec16834cfb512877280e4cae820a0a90606dbb7e80870b02fe1fe3?placeholderIfAbsent=true&apiKey=55e491f87d61487b9b7b3861f7502d13" alt="Social login option 2" class="object-contain shrink-0 w-[49px] h-[49px] rounded-full" />
                    <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/95a67c6ff86e6436890e0e7205afc7e71d103127c48880ebe17ee2ce36b2eca1?placeholderIfAbsent=true&apiKey=55e491f87d61487b9b7b3861f7502d13" alt="Social login option 3" class="object-contain shrink-0 w-[49px] h-[49px] rounded-full" />
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
<script>
    let showPassword = false;

    function togglePasswordVisibility() {
        showPassword = !showPassword;
        const passwordInput = document.getElementById('password');
        const togglePasswordIcon = document.getElementById('togglePasswordIcon');
        passwordInput.type = showPassword ? 'text' : 'password';
        togglePasswordIcon.src = showPassword ? '{{ asset('storage/assets/open.png') }}' : '{{ asset('storage/assets/closed.png') }}';
    }

    function goToRegister() {
        window.location.href = '{{ route('registro') }}';
    }

    document.getElementById('loginForm').addEventListener('submit', async function(event) {
        event.preventDefault();
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;

        try {
            const response = await axios.post('{{ route('login') }}', {
                email: email,
                password: password
            });

            if (response.data.token) {
                // Guardar el token en el almacenamiento local
                localStorage.setItem('token', response.data.token);
                alert('Inicio de sesión exitoso');
                // Redirigir a editar-perfil en lugar de la ruta raíz
                window.location.href = '{{ route('editar-perfil') }}';
            } else {
                alert('Usuario y/o contraseña inválida');
            }
        } catch (error) {
            alert('Error al iniciar sesión: ' + error.response.data.msg);
        }
    });
</script>
@endsection
