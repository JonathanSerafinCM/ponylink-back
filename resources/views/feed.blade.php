@extends('layouts.main_layout')

@section('content')
<div class="flex flex-col md:flex-row min-h-screen bg-[#F9FAFB]">
   <!-- Sidebar -->
   <aside 
     class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-lg transform transition-transform duration-300 ease-in-out md:relative md:translate-x-0"
   >
     <header class="flex items-center justify-between bg-[#001839] text-white p-4">
       <h2 class="text-xl font-semibold">Eventos & Proyectos</h2>
       <!-- Botón de cerrar solo en móviles -->
       <button 
         class="md:hidden text-2xl" 
         onclick="toggleSidebar()" 
         aria-label="Cerrar menú"
       >
         &times;
       </button>
     </header>

     <div class="p-4 space-y-4">
       @foreach($events as $event)
         <div class="rounded-lg shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300 border border-gray-200">
           <img src="{{ $event->image }}" alt="Imagen del evento" class="w-full h-32 object-cover" />
           <div class="p-4">
             <h3 class="text-lg font-semibold text-[#001839]">{{ $event->title }}</h3>
             <p class="text-sm text-gray-500 mt-2">{{ $event->description }}</p>
             <button class="mt-4 w-full bg-[#001839] text-white rounded-md py-2 hover:bg-[#A9C8E0] transition-colors">
               Ver más
             </button>
           </div>
         </div>
       @endforeach
     </div>
   </aside>

   <!-- Overlay para móviles cuando el sidebar está abierto -->
   <div id="sidebar-overlay" class="fixed inset-0 bg-black opacity-50 z-40 md:hidden hidden" onclick="toggleSidebar()"></div>

   <!-- Columna de Publicaciones (centro) -->
   <main class="flex-1 p-4">
     <!-- Botón para abrir el sidebar solo en móviles -->
     <button 
       class="md:hidden mb-4 px-4 py-2 bg-[#001839] text-white rounded-md flex items-center justify-center gap-2"
       onclick="toggleSidebar()"
       aria-label="Abrir menú"
     >
       <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
       </svg>
       Eventos & Proyectos
     </button>
     
     <!-- Sección para Crear Publicación -->
     <section class="flex flex-col rounded-lg w-full max-w-[1000px] bg-white shadow-lg border border-[#A7C7E0] p-6 mb-6 mt-2 transition duration-200 transform hover:shadow-xl hover:bg-[#F8FBFF]">
       <header class="flex gap-6 items-start">
         <img
           src="https://via.placeholder.com/80"
           alt="User profile picture"
           class="object-contain rounded-full shadow-md w-[80px]"
         />
         <div class="flex flex-col grow relative">
           <input
             type="text"
             aria-label="Publica una actualización"
             placeholder="¿Qué estás pensando?"
             class="px-4 py-4 rounded-xl bg-[#E7F3FF] text-neutral-700 placeholder:text-neutral-500 border border-[#A7C7E0] focus:border-blue-500 focus:outline-none transition duration-200 text-lg mb-4"
           />
           <div class="flex gap-4 items-center justify-end">
             <button class="flex items-center justify-center bg-[#CCE2FF] rounded-md h-[40px] px-3 hover:bg-[#A9C8E0] transition duration-200 border border-[#A7C7E0] shadow-md hover:shadow-lg">
               <img src="{{ asset('assets/imagen.png') }}" alt="Attachment icon" class="object-contain w-[30px] h-[30px] mr-2" />
             </button>
             <button class="flex items-center justify-center bg-[#CCE2FF] rounded-md h-[40px] px-3 hover:bg-[#A9C8E0] transition duration-200 border border-[#A7C7E0] shadow-md hover:shadow-lg">
               <img src="{{ asset('assets/publicar.png') }}" alt="Media options" class="object-contain w-[20px] h-[20px] mr-2" />
               <span class="text-base font-bold">Publicar</span>
             </button>
           </div>
         </div>
       </header>
     </section>

     <!-- Publicaciones -->
     <div class="space-y-4">
       @foreach($posts as $post)
         <section class="flex flex-col rounded-lg w-full max-w-[1000px] bg-white shadow-lg border border-[#A7C7E0] p-6 mb-6 mt-2 transition duration-200 transform hover:shadow-xl hover:bg-[#F8FBFF]">
           <header class="flex gap-6 items-start">
             <img src="https://via.placeholder.com/80" alt="User profile picture" class="object-contain rounded-full shadow-md w-[80px]" />
             <div>
               <h1 class="text-lg font-bold text-[#001839]">{{ $post->user }}</h1>
               <p class="text-sm text-gray-500">{{ $post->time }}</p>
             </div>
           </header>

           <div class="mt-4 text-base text-black">
             <h2 class="font-bold text-[#001839]">{{ $post->title }}</h2>
             <p class="mt-2">{{ $post->content }}</p>
           </div>

           <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mt-6 space-y-4 sm:space-y-0">
             @if($post->type === 'job')
               <button class="bg-[#001839] text-white font-bold py-2 px-4 rounded-lg flex items-center justify-center transition-colors w-full sm:w-auto">
                 <img src="{{ asset('assets/apply.png') }}" alt="Aplicar" class="w-5 h-5 mr-2" />
                 {{ $post->buttonText }}
               </button>
             @elseif($post->type === 'status')
               <div class="flex items-center">
                 <span class="font-bold text-[#001839]">Estado:</span>
                 <span class="font-bold ml-2 px-3 py-1 text-black rounded-full {{ $post->statusClass }}">
                   {{ $post->status }}
                 </span>
               </div>
             @endif
             <div class="flex flex-row justify-start sm:justify-end gap-3 sm:gap-4">
               <button class="flex items-center justify-center text-[#001839] hover:bg-gray-100 p-2 rounded-lg">
                 <img src="{{ asset('assets/megusta.png') }}" alt="Me gusta" class="w-5 h-5 mr-1" /> Me gusta
               </button>
               <button class="flex items-center justify-center text-[#001839] hover:bg-gray-100 p-2 rounded-lg">
                 <img src="{{ asset('assets/comentar.png') }}" alt="Comentar" class="w-5 h-5 mr-1" /> Comentar
               </button>
               <button class="flex items-center justify-center text-[#001839] hover:bg-gray-100 p-2 rounded-lg">
                 <img src="{{ asset('assets/compartir.png') }}" alt="Compartir" class="w-5 h-5 mr-1" /> Compartir
               </button>
             </div>
           </div>
         </section>
       @endforeach
     </div>
   </main>

   <!-- Columna de Chat (derecha) -->
   <aside class="hidden md:flex flex-col w-1/3 max-w-[350px] bg-gradient-to-br from-[#E6F0FF] to-[#CCE2FF] rounded-lg shadow-xl border border-gray-300 p-4 ml-auto">
     @include('partials.chats')
   </aside>
</div>

<script>
function toggleSidebar() {
   const sidebar = document.querySelector('aside');
   const overlay = document.getElementById('sidebar-overlay');
   sidebar.classList.toggle('translate-x-full');
   overlay.classList.toggle('hidden');
}
</script>
@endsection