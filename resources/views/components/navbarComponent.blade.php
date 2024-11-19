@extends('layouts.main_layout')

@section('navbar')
    @include('components.navbarComponent')

@section('content')
    <header class="flex flex-col pb-4 rounded-none">
        <div class="pr-20 w-full bg-zinc-100 shadow-lg max-md:pr-5 max-md:max-w-full">
            <div class="flex gap-5 max-md:flex-col items-center"> 
                <div class="flex flex-col w-[81%] max-md:ml-0 max-md:w-full">
                    <div class="w-full max-md:mt-10 max-md:max-w-full">
                        <div class="flex gap-5 max-md:flex-col items-center"> 
                            <div class="flex flex-col w-[33%] max-md:ml-0 max-md:w-full">
                                <div class="flex grow items-center justify-center max-md:mt-5">
                                    <img
                                        loading="lazy"
                                        src="{{ asset('images/logop.png') }}"
                                        class="logop object-contain shrink-0 max-w-full aspect-[1.11] w-[130px]" 
                                        alt="Company logo"
                                    />
                                </div>
                            </div>
                            <div class="flex flex-col ml-5 w-[67%] max-md:ml-0 max-md:w-full">
                                <form class="flex flex-wrap gap-5 self-stretch px-3.5 py-4 my-auto w-full text-2xl font-bold text-black whitespace-nowrap bg-blue-100 rounded-xl border-b-2 border-slate-900 shadow-md hover:shadow-lg transition duration-200">
                                    <img
                                        loading="lazy"
                                        src="https://cdn.builder.io/api/v1/image/assets/TEMP/08e1293efa47dbcd487dc608b9c8a12fe95be812c48702f436bd2649880b067a?placeholderIfAbsent=true&apiKey=55e491f87d61487b9b7b3861f7502d13"
                                        class="object-contain shrink-0 w-9 aspect-[1.03]"
                                        alt="Search icon"
                                    />
                                    <label for="searchInput" class="sr-only">Search</label>
                                    <input
                                        type="text"
                                        id="searchInput"
                                        placeholder="Buscar..."
                                        class="flex-auto my-auto max-md:max-w-full bg-transparent border-none focus:outline-none text-lg" 
                                    />
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <nav class="flex flex-col ml-5 w-[19%] max-md:ml-0 max-md:w-full">
                    <div class="flex gap-7 items-center mt-6 max-md:mt-10">
                        <a href="#" class="focus:outline-none focus:ring-2 focus:ring-blue-500" tabindex="0">
                            <img
                                loading="lazy"
                                src="https://cdn.builder.io/api/v1/image/assets/TEMP/4382fd5c3355c9afb5dbbd2714a255eaff8eae6a100b4ecf5211592cd3b98643?placeholderIfAbsent=true&apiKey=55e491f87d61487b9b7b3861f7502d13"
                                class="object-contain shrink-0 w-12 aspect-square transition-transform duration-200 hover:scale-105" 
                            />
                        </a>
                        <a href="#" class="focus:outline-none focus:ring-2 focus:ring-blue-500" tabindex="0">
                            <img
                                loading="lazy"
                                src="https://cdn.builder.io/api/v1/image/assets/TEMP/bebf125e5fa96ab29c5514535c6a5e3de5fd178c274952282cd2996a9da8c5c1?placeholderIfAbsent=true&apiKey=55e491f87d61487b9b7b3861f7502d13"
                                class="object-contain shrink-0 w-12 aspect-square transition-transform duration-200 hover:scale-105" 
                                alt="Messages icon"
                            />
                        </a>
                        <a href="#" class="focus:outline-none focus:ring-2 focus:ring-blue-500" tabindex="0">
                            <img
                                loading="lazy"
                                src="https://cdn.builder.io/api/v1/image/assets/TEMP/ab85e0c36766456df23c563955f0a56364e98c300b4d16679af29670ba526d2d?placeholderIfAbsent=true&apiKey=55e491f87d61487b9b7b3861f7502d13"
                                class="object-contain shrink-0 self-stretch rounded-full shadow-md aspect-[0.97] w-[68px] transition-transform duration-200 hover:scale-105" 
                                alt="User profile"
                            />
                        </a>
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <style>
        header {
            background-color: #f9f9f9;
        }

        .logop {
            transform: scale(4); 
            transform-origin: center; 
            margin-left: 80%; 
            margin-right: auto; 
        }
    </style>
@endsection

@section('scripts')

@endsection