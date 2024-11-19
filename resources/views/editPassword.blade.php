@extends('layouts.main_layout')

@section('content')
    <div class="relative flex overflow-hidden flex-col pb-28 bg-cover bg-center min-h-screen" 
        style="background-image: url('{{ asset('images/fondo.png') }}');">
    <div class="absolute inset-0 bg-black bg-opacity-40"></div>

    <div class="relative flex flex-col items-center justify-center px-10 w-full h-full max-md:px-4 max-md:max-w-full mt-20">
        <main class="flex z-10 flex-col px-10 pt-16 pb-16 max-w-full bg-white rounded-xl shadow-md w-[460px] max-md:px-6 max-md:mb-4">
        <div class="flex flex-col items-center justify-center mb-10">
            <img src="{{ asset('images/lock.png') }}" alt="Icono de contraseña" class="w-16 h-16 mb-4" />
            <h1 class="text-2xl font-semibold text-slate-900">Cambiar Contraseña</h1>
        </div>

        <form onsubmit="handleSubmit(event)" class="w-full">
            <!-- Campo de Contraseña Actual -->
            <div class="relative mb-4">
            <input
                id="currentPasswordInput"
                type="password"
                placeholder="Contraseña actual"
                class="w-full px-4 py-4 mt-3 text-base rounded-md border-b border-sky-900 bg-neutral-100 focus:outline-none focus:ring-2 focus:ring-sky-900 focus:border-transparent"
            />
            <button
                type="button"
                onclick="toggleVisibility('currentPasswordInput', 'eyeCurrent')"
                class="absolute right-3 top-1/2 transform -translate-y-1/2 focus:outline-none flex items-center justify-center"
            >
                <img id="eyeCurrent" src="{{ asset('images/open.png') }}" alt="Toggle current password visibility" class="w-5 h-5" />
            </button>
            </div>

            <!-- Campo de Nueva Contraseña -->
            <div class="relative mb-4">
            <input
                id="newPasswordInput"
                type="password"
                placeholder="Nueva contraseña"
                class="w-full px-4 py-4 mt-3 text-base rounded-md border-b border-sky-900 bg-neutral-100 focus:outline-none focus:ring-2 focus:ring-sky-900 focus:border-transparent"
            />
            <button
                type="button"
                onclick="toggleVisibility('newPasswordInput', 'eyeNew')"
                class="absolute right-3 top-1/2 transform -translate-y-1/2 focus:outline-none flex items-center justify-center"
            >
                <img id="eyeNew" src="{{ asset('images/open.png') }}" alt="Toggle new password visibility" class="w-5 h-5" />
            </button>
            </div>

            <!-- Campo de Confirmar Nueva Contraseña -->
            <div class="relative mb-4">
            <input
                id="confirmNewPasswordInput"
                type="password"
                placeholder="Confirmar nueva contraseña"
                class="w-full px-4 py-4 mt-3 text-base rounded-md border-b border-sky-900 bg-neutral-100 focus:outline-none focus:ring-2 focus:ring-sky-900 focus:border-transparent"
            />
            <button
                type="button"
                onclick="toggleVisibility('confirmNewPasswordInput', 'eyeConfirm')"
                class="absolute right-3 top-1/2 transform -translate-y-1/2 focus:outline-none flex items-center justify-center"
            >
                <img id="eyeConfirm" src="{{ asset('images/open.png') }}" alt="Toggle confirm password visibility" class="w-5 h-5" />
            </button>
            </div>

            <p id="errorMessage" class="text-red-500 text-sm" style="display: none;"></p>

            <button
            type="submit"
            class="w-full py-2.5 mt-8 text-base font-bold text-white bg-sky-900 rounded-xl border border-sky-900 border-solid hover:bg-sky-800 transition duration-200"
            >
            Guardar Cambios
            </button>
        </form>
        </main>
    </div>
    </div>


    <script>
  function toggleVisibility(inputId, eyeId) {
    const input = document.getElementById(inputId);
    const eyeIcon = document.getElementById(eyeId);
    if (input.type === "password") {
      input.type = "text";
      eyeIcon.src = "{{ asset('assets/closed.png') }}";
    } else {
      input.type = "password";
      eyeIcon.src = "{{ asset('assets/open.png') }}";
    }
  }

  function handleSubmit(event) {
    event.preventDefault();
    const newPassword = document.getElementById('newPasswordInput').value;
    const confirmNewPassword = document.getElementById('confirmNewPasswordInput').value;
    const errorMessage = document.getElementById('errorMessage');

    if (newPassword !== confirmNewPassword) {
      errorMessage.style.display = 'block';
      errorMessage.textContent = 'Las contraseñas no coinciden';
    } else {
      errorMessage.style.display = 'none';
      alert('Contraseña actualizada');
      // Aquí puedes agregar la lógica para enviar la nueva contraseña al backend
    }
  }
</script>

@endsection