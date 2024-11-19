@extends('layouts.main_layout')

@section('content')
  <div class="relative flex overflow-hidden flex-col pb-28 bg-cover bg-center min-h-screen" style="background-image: url('{{ asset('storage/assets/fondo.png') }}');">
    <div class="absolute inset-0 bg-black bg-opacity-40"></div>
    <div class="relative flex flex-col items-center px-10 pt-10 w-full max-md:px-4 max-md:max-w-full">
      <main class="flex z-10 flex-col px-10 pt-6 pb-16 max-w-full bg-white rounded-xl shadow-md w-[460px] max-md:px-6 max-md:mb-4">
        <div class="w-[200px] h-[200px] rounded-full overflow-hidden mx-auto mb-6 shadow-[0px_4px_4px_rgba(0,0,0,0.45)]">
          <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/2fe73ee0b7d23c2c13d1e5eca1344c4389f603bac3093fea44ff18f46ac4ff25?placeholderIfAbsent=true&apiKey=55e491f87d61487b9b7b3861f7502d13" alt="Company logo" class="w-full h-full object-cover" />
        </div>
        <h1 class="self-start text-xl font-semibold text-slate-900 max-md:ml-1.5 mb-5">
          Crear Cuenta
        </h1>
        <form id="registerForm" method="POST" action="{{ route('registro') }}" class="w-full">
          @csrf
          <label for="nameInput" class="sr-only">Nombre</label>
          <input id="nameInput" name="name" type="text" placeholder="Nombre" class="w-full px-4 py-4 mt-3 text-base rounded-md border-b border-sky-900 bg-neutral-100 focus:outline-none focus:ring-2 focus:ring-sky-900 focus:border-transparent" />

          <label for="emailInput" class="sr-only">Correo electrónico o usuario</label>
          <input id="emailInput" type="email" name="email" type="text" placeholder="Correo electrónico o usuario" class="w-full px-4 py-4 mt-3 text-base rounded-md border-b border-sky-900 bg-neutral-100 focus:outline-none focus:ring-2 focus:ring-sky-900 focus:border-transparent" />
          
          <div class="relative mb-4">
            <input id="passwordInput" name="password" type="password" placeholder="Contraseña" class="w-full px-4 py-4 mt-3 text-base rounded-md border-b border-sky-900 bg-neutral-100 focus:outline-none focus:ring-2 focus:ring-sky-900 focus:border-transparent" />
            <button type="button" id="togglePasswordButton" class="absolute right-3 top-1/2 transform -translate-y-1/2 focus:outline-none flex items-center justify-center">
              <img id="togglePasswordIcon" loading="lazy" src="{{ asset('storage/assets/closed.png') }}" alt="Toggle password visibility" class="w-5 h-5" />
            </button>
          </div>
          
          <div class="relative mb-4">
            <input id="confirmPasswordInput" name="password_confirmation" type="password" placeholder="Confirmar contraseña" class="w-full px-4 py-4 mt-3 text-base rounded-md border-b border-sky-900 bg-neutral-100 focus:outline-none focus:ring-2 focus:ring-sky-900 focus:border-transparent" />
            <button type="button" id="toggleConfirmPasswordButton" class="absolute right-3 top-1/2 transform -translate-y-1/2 focus:outline-none flex items-center justify-center">
              <img id="toggleConfirmPasswordIcon" loading="lazy" src="{{ asset('storage/assets/closed.png') }}" alt="Toggle password visibility" class="w-5 h-5" />
            </button>
          </div>

          <div id="errorMessage" class="text-red-500 text-sm"></div>

          <button id="registerButton" class="w-full py-2.5 mt-8 text-base font-bold text-white bg-sky-900 rounded-xl border border-sky-900 border-solid">
            Crear Cuenta
          </button>
        </form>
        
        <div class="w-full h-px mt-10 bg-sky-900 opacity-80"></div>
        <p class="self-center mt-4 text-xs text-sky-900">Otras opciones</p>
        <div class="flex gap-4 justify-center mt-4">
          <div class="w-12 h-12 rounded-full overflow-hidden flex items-center justify-center shadow-[0px_4px_4px_rgba(0,0,0,0.45)]">
            <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/5b829b7031e03ea51ef02b9a26a78650551580d5b02868516a6831b2f3331b8f?placeholderIfAbsent=true&apiKey=55e491f87d61487b9b7b3861f7502d13" alt="Social media login option 1" class="w-full h-full object-contain" />
          </div>
          <div class="w-12 h-12 rounded-full overflow-hidden flex items-center justify-center shadow-[0px_4px_4px_rgba(0,0,0,0.45)]">
            <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/cc947fb46aec16834cfb512877280e4cae820a0a90606dbb7e80870b02fe1fe3?placeholderIfAbsent=true&apiKey=55e491f87d61487b9b7b3861f7502d13" alt="Social media login option 2" class="w-full h-full object-contain" />
          </div>
          <div class="w-12 h-12 rounded-full overflow-hidden flex items-center justify-center shadow-[0px_4px_4px_rgba(0,0,0,0.45)]">
            <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/95a67c6ff86e6436890e0e7205afc7e71d103127c48880ebe17ee2ce36b2eca1?placeholderIfAbsent=true&apiKey=55e491f87d61487b9b7b3861f7502d13" alt="Social media login option 3" class="w-full h-full object-contain" />
          </div>
        </div>
      </main>
    </div>
  </div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    let showPassword = false;
    let showConfirmPassword = false;

    const togglePasswordVisibility = () => {
        showPassword = !showPassword;
        const passwordInput = document.getElementById('passwordInput');
        const togglePasswordIcon = document.getElementById('togglePasswordIcon');
        if (passwordInput && togglePasswordIcon) {
            passwordInput.type = showPassword ? 'text' : 'password';
            togglePasswordIcon.src = showPassword ? '{{ asset('storage/assets/open.png') }}' : '{{ asset('storage/assets/closed.png') }}';
        }
    };

    const toggleConfirmPasswordVisibility = () => {
        showConfirmPassword = !showConfirmPassword;
        const confirmPasswordInput = document.getElementById('confirmPasswordInput');
        const toggleConfirmPasswordIcon = document.getElementById('toggleConfirmPasswordIcon');
        if (confirmPasswordInput && toggleConfirmPasswordIcon) {
            confirmPasswordInput.type = showConfirmPassword ? 'text' : 'password';
            toggleConfirmPasswordIcon.src = showConfirmPassword ? '{{ asset('storage/assets/open.png') }}' : '{{ asset('storage/assets/closed.png') }}';
        }
    };

    const handleSubmit = async (event) => {
        event.preventDefault();
        const passwordInput = document.getElementById('passwordInput');
        const confirmPasswordInput = document.getElementById('confirmPasswordInput');
        const errorMessage = document.getElementById('errorMessage');

        if (passwordInput.value !== confirmPasswordInput.value) {
            errorMessage.textContent = 'Las contraseñas no coinciden';
        } else {
            errorMessage.textContent = '';
            try {
                const response = await axios.post('{{ route('registro') }}', {
                    name: document.getElementById('nameInput').value,
                    email: document.getElementById('emailInput').value,
                    password: passwordInput.value,
                    password_confirmation: confirmPasswordInput.value
                });

                alert('Registro exitoso');
                window.location.href = '{{ route('login') }}';
            } catch (error) {
                errorMessage.textContent = error.response.data.msg || 'Error al registrar usuario';
            }
        }
    };

    const togglePasswordButton = document.getElementById('togglePasswordButton');
    const toggleConfirmPasswordButton = document.getElementById('toggleConfirmPasswordButton');
    if (togglePasswordButton) {
        togglePasswordButton.addEventListener('click', togglePasswordVisibility);
    }
    if (toggleConfirmPasswordButton) {
        toggleConfirmPasswordButton.addEventListener('click', toggleConfirmPasswordVisibility);
    }
    const registerButton = document.getElementById('registerButton');
    if (registerButton) {
        registerButton.addEventListener('click', handleSubmit);
    }
});
</script>
@endsection