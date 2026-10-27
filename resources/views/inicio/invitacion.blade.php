@extends('layouts.app')

@section('title', 'Nuestra Boda - Jennie & Cristian')
@push('preloads')
    {{-- Preload de las imágenes prioritarias del hero/sobre --}}
    <link rel="preload" as="image" type="image/webp" href="{{ asset('assets/imgs/sobre/back.webp') }}" fetchpriority="high">
    <link rel="preload" as="image" type="image/webp" href="{{ asset('assets/imgs/sobre/mid.webp') }}" fetchpriority="high">
    <link rel="preload" as="image" type="image/webp" href="{{ asset('assets/imgs/sobre/front.webp') }}" fetchpriority="high">
@endpush

@section('content')
{{-- Forzar loader visible vía CSS mientras cargan las imágenes críticas.
     Se elimina desde JS cuando ya están listas. Sin esta etiqueta el loader
     parpadea porque app.js (módulo Vite) corre DESPUÉS del script inline. --}}
<style id="invitacion-loader-override">
    #elemento-animacioncargando { display: flex !important; }
    body { overflow: hidden !important; }
</style>
@php
    $fotos = [];
    foreach ([1, 2, 3, 4, 5, 6, 7, 8] as $n) {
        $fotos[] = "assets/imgs/min/{$n}.webp";
    }
    // Cada columna con su dirección. Agrega más si quieres: ['subir', 'bajar', 'subir', 'bajar']
    $columnas = ['subir', 'bajar', 'subir'];
@endphp
<section class="w-full flex flex-col gap-14 overflow-x-hidden">
    <div class="sm:max-w-150 w-full mx-auto flex flex-col gap-5">
        <div class="relative">
            <img src="{{ asset('assets/imgs/sobre/back.webp') }}"
                class="w-full"
                alt="Sobre Foto"
                fetchpriority="high"
                loading="eager"
                decoding="async">

            <img src="{{ asset('assets/imgs/sobre/mid.webp') }}"
                class="w-full absolute top-0 sm:translate-y-40 translate-y-[27vw] transition-transform duration-1000 ease-out will-change-transform"
                id="imgSobreInvitacion"
                alt="Sobre Foto"
                fetchpriority="high"
                loading="eager"
                decoding="async">

            <img src="{{ asset('assets/imgs/sobre/front.webp') }}"
                class="w-full absolute top-0"
                alt="Sobre Foto"
                fetchpriority="high"
                loading="eager"
                decoding="async">
            {{-- <img src="{{ asset('assets/imgs/sobreNegroAbierto.svg') }}" class="w-full" alt="Sobre Foto"> --}}
        </div>
        <div class="px-4 flex flex-col gap-5">
            <img src="{{ asset('assets/imgs/decorativo.svg') }}" class="w-full sm:max-w-95 max-w-67 mx-auto" alt="decorativo">
            <img src="{{ asset('assets/imgs/fecha.svg') }}" class="w-full sm:max-w-102.5 max-w-71.5 mx-auto py-10" alt="01/MAYO/2027">
        </div>
    </div>


    <!-- Countdown Timer -->
    <div class="bg-arena py-14 w-full relative">
        <div class="sm:max-w-150 w-full mx-auto px-4 flex flex-col sm:gap-10 gap-7">
            <h3 class="sm:text-4xl text-3xl text-center text-marfil-2">Faltan</h3>
            <div class="flex xxs:gap-4 gap-3 justify-center">
                <div class="w-fit text-marfil-2 flex flex-col gap-3">
                    <p class="w-fit mx-auto text-playfair !font-bold xs:text-5xl xxs:text-4xl text-3xl leading-120"><i id="dias">0</i></p>
                    <p class="w-fit mx-auto sm:text-base text-sm text-playfair leading-120"><i>Días</i></p>
                </div>
                <div class="w-fit text-marfil-2 flex flex-col gap-3">
                    <p class="w-fit mx-auto text-playfair !font-bold xs:text-5xl xxs:text-4xl text-3xl leading-120"><i>:</i></p>
                </div>
                <div class="w-fit text-marfil-2 flex flex-col gap-3">
                    <p class="w-fit mx-auto text-playfair !font-bold xs:text-5xl xxs:text-4xl text-3xl leading-120"><i id="horas">0</i></p>
                    <p class="w-fit mx-auto sm:text-base text-sm text-playfair leading-120"><i>Horas</i></p>
                </div>
                <div class="w-fit text-marfil-2 flex flex-col gap-3">
                    <p class="w-fit mx-auto text-playfair !font-bold xs:text-5xl xxs:text-4xl text-3xl leading-120"><i>:</i></p>
                </div>
                <div class="w-fit text-marfil-2 flex flex-col gap-3">
                    <p class="w-fit mx-auto text-playfair !font-bold xs:text-5xl xxs:text-4xl text-3xl leading-120"><i id="minutos">0</i></p>
                    <p class="w-fit mx-auto sm:text-base text-sm text-playfair leading-120"><i>Minutos</i></p>
                </div>
                <div class="w-fit text-marfil-2 flex flex-col gap-3">
                    <p class="w-fit mx-auto text-playfair !font-bold xs:text-5xl xxs:text-4xl text-3xl leading-120"><i>:</i></p>
                </div>
                <div class="w-fit text-marfil-2 flex flex-col gap-3">
                    <p class="w-fit mx-auto text-playfair !font-bold xs:text-5xl xxs:text-4xl text-3xl leading-120"><i id="segundos">0</i></p>
                    <p class="w-fit mx-auto sm:text-base text-sm text-playfair leading-120"><i>Segundos</i></p>
                </div>
            </div>
        </div>
    </div>

    <div class="sm:max-w-150 w-full mx-auto px-4 flex flex-col gap-14">
        <!-- Gallery Carousel -->
        <div class="flex flex-col">
            <div class="grid grid-cols-3 gap-6">
                <div>
                    <img src="{{ asset('assets/imgs/flor.svg') }}" class="w-full max-w-40 mr-auto mt-10 latido" alt="">
                </div>
                <div>
                    <img src="{{ asset('assets/imgs/flor3.svg') }}" class="w-full max-w-32 mx-auto latido" alt="">
                </div>
                <div>
                    <img src="{{ asset('assets/imgs/flor.svg') }}" class="w-full max-w-40 ml-auto mt-10 scale-x-[-1] latido" alt="">
                </div>
            </div>
            <div class="flex flex-col gap-5 w-10/12 mx-auto relative">
                <div>
                    <div class="swiper carruselMarcoPrincipal border-[7px] border-arena bg-arena rounded-t-full rounded-b-3xl">
                        <div class="swiper-wrapper">
                            @for($j = 1; $j <= 4; $j++)
                                <div class="swiper-slide bg-marfil-2">
                                    <img src="{{ asset("assets/imgs/arco/{$j}.webp") }}" class="w-full rounded-t-full rounded-b-3xl" alt="{{ $j }}">
                                </div>
                            @endfor
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="swiper carruselMarcoMiniatura">
                            <div class="swiper-wrapper">
                                @for($i = 1; $i <= 4; $i++)
                                    <div class="swiper-slide size-auto cursor-pointer opacity-60 [&.swiper-slide-thumb-active]:opacity-100 transition-opacity">
                                        <img src="{{ asset("assets/imgs/arcoMin/{$i}.webp") }}" class="size-full rounded-md border-2 border-arena" alt="{{ $i }}">
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-14">
            <div class="ticket exterior xxs:px-8 px-5 bg-arena">
                <div class="ticket interior bg-marfil-2 flex flex-col gap-14 px-10 py-16 relative">
                    <div class="flex flex-col gap-10">
                        <img src="{{ asset('assets/imgs/flor5.svg') }}" class="w-full latido xs:max-w-20 max-w-28 absolute left-0 xs:ml-6 top-0 xs:mt-6 -ml-7 -mt-2 mx-auto" alt="flor">
                        <img src="{{ asset('assets/imgs/flor5.svg') }}" class="w-full latido xs:max-w-20 max-w-28 absolute right-0 top-0 scale-x-[-1] xs:mt-6 xs:mr-6 -mt-2 -mr-7 mx-auto" alt="flor">
                        <h2 class="text-center text-arena sm:text-4xl text-3xl leading-125 relative">Nuestro Mejor Viaje <br> Empieza Hoy</h2>
                        <div class="flex flex-col gap-5">
                            <p class=" text-center">
                                Hay momentos que marcan un antes y un después, instantes que se quedan grabados en el corazón para siempre. 
                                Decidir caminar juntos en la misma dirección ha sido la mejor decisión de nuestras vidas, y el 1 de mayo de 2027 
                                daremos el «sí, acepto» rodeados del amor de las personas que más queremos.
                            </p>
                            <p class=" text-center">
                                Tu presencia en este día es fundamental para nosotros, porque la alegría solo es completa cuando 
                                se comparte con quienes han sido parte de nuestra historia. 
                            </p>
                            <p class=" text-center">
                                Esperamos contar contigo para hacer de esta celebración un recuerdo inolvidable.
                            </p>
                            {{-- <svg class="w-24 mx-auto opacity-85 fill-arena" viewBox="0 0 453.08 468.35">
                                <g id="Capa_1-2" data-name="Capa 1">
                                    <path d="M255.05,0v2.99c-4.86-.17-10.05,2.76-12.66,7.05-1.22,2.01-3.34,9.4-3.34,11.45v105.15c63.91-26.43,140.7-12.67,190.39,35.28l9.6,66.07-1.83,1.72c-16.32-76.84-97.25-126.74-173.57-107.01-3.78.98-21.47,6.66-23.6,8.43-.98.82-1.09,1.75-1.05,2.95-3.12,53.44,10.07,115.63-16.79,164.36-11.99,21.75-31.86,41.52-56.22,48.38,7.98,23.32,20.73,45.92,37.52,64.05,2.59,2.8,9.8,11.83,13.01,8.98,2.98-2.65,11.57-19.34,13.29-23.74,1.86-4.77,2.58-10.46,4.25-14.76.33-.86.81-2.41.81-2.41,1.96-.11.22.01,2.18-.1-1.34,16.15-9.82,32.08-19.96,44.53,46.04,42.13,115.33,54.21,169.4,19.33,24.23-15.63,39.24-38.55,50.64-64.47.42-.95-.59-1.75,1.57-1.37l14.1,12c.76,1.28-.08,2.27-.71,3.34-2.46,4.22-9.84,12.72-13.36,16.68-61.42,69.09-156.13,77.31-233.05,28.16-22.64,20.43-54.83,34.46-85.76,28.43-18.03-3.52-33.34-15.82-35.01-35.04-2.81-32.29,23.51-55.26,49.75-68.47l2.32,2.87c-28.96,14.84-40.7,46.2-26.87,76.43,11.8,25.8,32.25,25.12,56.15,16.4,10.2-3.72,27.57-13.22,35.26-20.78.96-.95,1.91-1.29,1.51-2.96-28.71-18.74-49.67-48.17-62.2-79.91-58.11,6.8-118.97-24.69-136.21-82.48-22.1-74.1,38.7-142.99,111.86-147.87,3.41-.23,32.54-.92,32.49,2.49-.75,1.75-.54,1.99-1.03,1.91-4.94-1.28-6.84-1.36-9.42-1.45-52.98-1.78-105.83,22.36-127.12,73.12-34.68,82.66,44.25,160.48,126.58,146.09-11.36-37.02,2.7-86.63,49.42-81.94,3.18.32,10.81,1.97,13.39,3.6.54.34,1.78.45,1.68.96-.44,2.31-.15.93-.44,2.31-.15.69-10.88-3.59-13.61-3.89-11.56-1.29-35.53,2.03-35.5,17.41,0,3.71.78,10.93,1.21,14.88,1.34,12.41,4.71,24.79,8.38,36.66,1.24,1.69,1.06.53,2.02.04,2.98-1.52,7.87-5.28,10.5-7.53,52.96-45.35,37.66-119.68,40.01-181.65-.62-.73-8.11,5.68-9.02,6.49-31.7,28.11-48.14,69.97-52.54,111.59-12.75,7.69-20.21,20.79-23.52,35.03-1.74.24-.94-2.28-.99-3.48-2.34-62.72,32.69-125.42,86.09-157.34l-.15-117.33c-1.18-10.65-5.38-18.34-17.85-18.63V0h58Z"/>
                                </g>
                            </svg> --}}
                        </div>
                    </div>
                    {{-- <img src="{{ asset('assets/imgs/decorativo.svg') }}" class="w-full sm:max-w-95 max-w-67 mx-auto" alt="decorativo"> --}}
                </div>
            </div>
            <img src="{{ asset('assets/imgs/decorativo.svg') }}" class="w-full sm:max-w-95 max-w-67 mx-auto" alt="decorativo">
            <div class="ticket exterior xxs:px-8 px-5 bg-arena  relative">
                <!-- <svg class="-mt-1 w-full h-1 text-marfil-2" preserveAspectRatio="none">
                    <line x1="0" y1="2" x2="100%" y2="2" stroke="currentColor" stroke-width="4" stroke-dasharray="11 10"/>
                </svg> -->
                <div class="ticket interior p-10 bg-marfil-2 flex flex-col gap-10">
                    <h3 class="text-center text-arena sm:text-xl text-lg leading-125"><i>¡Con la bendicion de Dios y nustros padres!</i></h3>
                    <!-- Padres -->
                    <div class="flex flex-col gap-10">
                        <div class="flex items-center w-full">
                            <div class="w-1/3">
                                <img src="{{ asset('assets/imgs/olivo1.svg') }}" class="xxxs:w-14 w-10 mx-auto -rotate-45 latido" alt="">
                            </div>
                            <div class="w-2/3 flex flex-col gap-4 pl-2">
                                <p class="sm:text-2xl text-xl text-right font-bold text-playfair text-arena"><i>Padres de la novia</i></p>
                                <div class="flex flex-col gap-2">
                                    <p class="text-playfair text-right"><i>Francisco de Jesús Trejo Molina</i></p>
                                    <p class="text-playfair text-right"><i>María del Carmen Lopéz Taxilaga</i></p>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center w-full">
                            <div class="w-2/3 flex flex-col gap-4 pr-2">
                                <p class="sm:text-2xl text-xl text-left font-bold text-playfair text-arena"><i>Padres del novio</i></p>
                                <div class="flex flex-col gap-2">
                                    <p class="text-playfair text-left"><i>Alejandro Mayén Tinoco</i></p>
                                    <p class="text-playfair text-left"><i>Nancy Guadalupe Martínez Grañel</i></p>
                                </div>
                            </div>
                            <div class="w-1/3">
                                <img src="{{ asset('assets/imgs/olivo1.svg') }}" class="xxxs:w-14 w-10 mx-auto rotate-45 latido" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="relative w-10/12 mx-auto">
                        <div class="swiper carruselTarjetas">
                            <div class="swiper-wrapper">
                                @for($i = 1; $i <= 6; $i++)
                                    <div class="swiper-slide bg-arena p-0.5 rounded-2xl">
                                        <img src="{{ asset("assets/imgs/fam/{$i}.webp") }}" class="size-full rounded-2xl xs:border-4 border-2 border-arena" alt="{{ $i }}">
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <img src="{{ asset('assets/imgs/decorativo.svg') }}" class="w-full sm:max-w-95 max-w-67 mx-auto" alt="decorativo">
        <!-- El lugar -->
        <div class="flex flex-col gap-0">
            <div class="ticket exterior xxs:px-8 px-5 bg-arena">
                <div class="ticket interior px-10 py-16 bg-marfil-2 relative">
                    <div class="flex flex-col gap-10">
                    <img src="{{ asset('assets/imgs/flor5.svg') }}" class="w-full latido xs:max-w-20 max-w-28 absolute left-0 xs:ml-6 top-0 xs:mt-6 -ml-7 -mt-2 mx-auto" alt="flor">
                    <img src="{{ asset('assets/imgs/flor5.svg') }}" class="w-full latido xs:max-w-20 max-w-28 absolute right-0 top-0 scale-x-[-1] xs:mt-6 xs:mr-6 -mt-2 -mr-7 mx-auto" alt="flor">
                        <h2 class="text-center text-arena sm:text-4xl text-3xl leading-125">El lugar</h2>
                        <img src="{{ asset('assets/imgs/salonIcono.svg') }}" class="w-full sm:max-w-112.5 max-w-75.25 mx-auto" alt="">
                        <div class="flex flex-col gap-4">
                            <a href="https://maps.app.goo.gl/9N2chHKeQzCJGj9bA" target="_blank" rel="noopener noreferrer" class="text-center w-fit mx-auto sm:text-xl text-lg text-arena text-playfair font-bold">
                                <i>Coral Clubes Santa María</i>
                            </a>
                            <p class="text-center text-playfair"> *Salón vista hermosa* </p>
                            <a href="https://maps.app.goo.gl/9N2chHKeQzCJGj9bA" target="_blank" rel="noopener noreferrer" class="btnSecundario mx-auto">
                                <span class="spanbtn"></span>
                                <p class="relative">Ver ubicación</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ticket exterior xxs:px-8 px-5 bg-arena -mt-1 relative">
                <svg class="-mt-1 w-full h-1 text-marfil-2" preserveAspectRatio="none">
                    <line x1="0" y1="2" x2="100%" y2="2" stroke="currentColor" stroke-width="4" stroke-dasharray="11 10"/>
                </svg>
                <div class="ticket interior p-10 bg-marfil-2 flex flex-col gap-10">
                    <div class="flex flex-col gap-3">
                        <p class="sm:text-2xl text-xl font-bold text-playfair text-arena text-center"><i>Hora de recepción</i></p>
                        <p class="text-playfair text-center text-2xl sm:text-4xl">4:00<small> pm</small> </p>
                        <p class="text-center text-xs text-playfair"><i>*Se les agradece ser puntuales</i></p>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <div class=" w-full">
        <div class="sm:max-w-150 w-full mx-auto px-4 flex flex-col gap-14">
            <div class="carrusel-vertical w-full aspect-[923.4/463.9] flex gap-3 px-1">
                @foreach ($columnas as $c => $direccion)
                    @php
                        // Invierte el orden en columnas impares para que no coincidan las fotos
                        // $lista = $c % 2 ? array_reverse($fotos) : $fotos;
                        $desfase = ($c * 2) % count($fotos);
                        $lista = [...array_slice($fotos, $desfase), ...array_slice($fotos, 0, $desfase)];
                    @endphp
                    <div class="flex-1 min-w-0 overflow-hidden">
                        <div class="carrusel-track carrusel-{{ $direccion }}">
                            @foreach ([...$lista, ...$lista] as $i => $foto)
                                <img src="{{ asset('' . $foto) }}" alt=""
                                    @if ($i >= count($lista)) aria-hidden="true" @endif>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
    
    <div class="sm:max-w-150 w-full mx-auto px-4 flex flex-col gap-14">
        <!-- Código de vestimenta -->
        <div class="flex flex-col gap-10">
            <div class="flex flex-col gap-0">
                <div class="ticket exterior xxs:px-8 px-5 bg-arena relative">
                    <div class="ticket interior px-10 py-16 bg-marfil-2 flex flex-col gap-0 relative">
                    <img src="{{ asset('assets/imgs/flor5.svg') }}" class="w-full latido xs:max-w-20 max-w-28 absolute left-0 xs:ml-6 top-0 xs:mt-6 -ml-7 -mt-2 mx-auto" alt="flor">
                    <img src="{{ asset('assets/imgs/flor5.svg') }}" class="w-full latido xs:max-w-20 max-w-28 absolute right-0 top-0 scale-x-[-1] xs:mt-6 xs:mr-6 -mt-2 -mr-7 mx-auto" alt="flor">
                        <h2 class="text-center text-arena sm:text-4xl text-3xl leading-125">Código de vestimenta</h2>
                        <div class="relative">
                            <!-- <img src="{{ asset('assets/imgs/flor5.svg') }}" class="absolute top-0 left-0 sm:w-32 xs:w-24 w-20 latido" alt="">
                            <img src="{{ asset('assets/imgs/flor5.svg') }}" class="absolute bottom-0 right-0 sm:w-32 xs:w-24 w-20 scale-x-[-1] scale-y-[-1] latido" alt=""> -->
                            <div class="sm:w-52 w-44 mx-auto relative mb-10" id="lottievestimenta"></div>
                            <p class="sm:text-2xl w-full text-xl font-bold text-playfair text-arena absolute bottom-0 -mb-3 left-1/2 -translate-x-1/2 text-center"><i>Vestimenta Formal</i></p>
                        </div>
                    </div>
                </div>
                <div class="ticket exterior xxs:px-8 px-5 bg-arena -mt-1 relative">
                    <svg class="-mt-1 w-full h-1 text-marfil-2" preserveAspectRatio="none">
                        <line x1="0" y1="2" x2="100%" y2="2" stroke="currentColor" stroke-width="4" stroke-dasharray="11 10"/>
                    </svg>
                    <div class="ticket interior px-10 py-10 bg-marfil-2 flex flex-col gap-5">
    
                        <div class="flex flex-col gap-3">
                            
                            <p class="text-playfair text-center sm:text-lg"><i>Les pedimos de la manera más atenta no utilizar prendas en color</i></p>
                        </div>
                        <div class="xs:w-3/5 mx-auto grid grid-cols-3 gap-4 items-center">
                            <div class="flex flex-col gap-2">
                                <span class="block size-14 mx-auto bg-arena rounded-full latido"></span>
                                <p class="text-center">Arena</p>
                            </div>
                            <div class="flex flex-col gap-2">
                                <span class="block size-20 mx-auto bg-marfil-2 rounded-full border border-gris-100 latido"></span>
                                <p class="text-center">Blanco</p>
                            </div>
                            <div class="flex flex-col gap-2">
                                <span class="block size-14 mx-auto bg-marfil-1 rounded-full latido"></span>
                                <p class="text-center">Marfil</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <img src="{{ asset('assets/imgs/decorativo.svg') }}" class="w-full sm:max-w-95 max-w-67 mx-auto" alt="decorativo">
        <div class=" flex flex-col  ">
            <!-- Mesa de regalos -->
            <div class="ticket exterior xxs:px-8 px-5 bg-arena">
                <div class="ticket interior px-10 py-16 bg-marfil-2 relative">
                    <img src="{{ asset('assets/imgs/flor5.svg') }}" class="w-full latido xs:max-w-20 max-w-28 absolute left-0 xs:ml-6 top-0 xs:mt-6 -ml-7 -mt-2 mx-auto" alt="flor">
                    <img src="{{ asset('assets/imgs/flor5.svg') }}" class="w-full latido xs:max-w-20 max-w-28 absolute right-0 top-0 scale-x-[-1] xs:mt-6 xs:mr-6 -mt-2 -mr-7 mx-auto" alt="flor">
                    <div class="flex flex-col gap-10">
                        <h2 class="text-center text-arena sm:text-4xl text-3xl leading-125">Mesa de regalos</h2>
                        <p class=" text-center">
                            Tu presencia es nuestro mejor regalo. Si deseas consentirnos con un detalle adicional,
                            puedes consultar nuestra mesa de regalos
                        </p>
                        {{-- <img src="{{ asset('assets/imgs/mesaRegalos.svg') }}" class="mx-auto w-full xs:max-w-96 max-w-[90%]" alt=""> --}}
                        <div class="mx-auto w-full xs:max-w-96 max-w-[90%]" id="lottiemesa"></div>
                        <a href="https://www.amazon.com.mx/wedding/share/JennieyCristian" target="_blank" rel="noopener noreferrer" class="btnSecundario mx-auto">
                            <span class="spanbtn"></span>
                            <p class="relative">Ver mesa de regalos</p>
                        </a>

                    </div>
                </div>
            </div>
            <div class="ticket exterior xxs:px-8 px-5 bg-arena -mt-1 relative">
                <svg class="-mt-1 w-full h-1 text-marfil-2" preserveAspectRatio="none">
                    <line x1="0" y1="2" x2="100%" y2="2" stroke="currentColor" stroke-width="4" stroke-dasharray="11 10"/>
                </svg>
                <div class="ticket interior px-10 py-10 bg-marfil-2 flex flex-col gap-7">
                    <p class=" text-center">
                        O apoyarnos con una aportación en efectivo para nuestro nuevo hogar
                    </p>
                    <p class="text-center underline"><b>00121215452121052</b></p>
                    <img src="{{ asset('assets/imgs/bancoVerde.svg') }}" class="w-60 mx-auto" alt="">
                </div>
            </div>
        </div>
        <img src="{{ asset('assets/imgs/decorativo.svg') }}" class="w-full sm:max-w-95 max-w-67 mx-auto" alt="decorativo">
    
        <!-- Confirmar Asistencia -->
        <div class="ticket exterior xxs:px-8 px-5 bg-arena">
            <div class="flex flex-col gap-10 ticket interior px-10 py-16 bg-marfil-2 relative">
                <img src="{{ asset('assets/imgs/flor5.svg') }}" class="w-full latido xs:max-w-20 max-w-28 absolute left-0 xs:ml-6 top-0 xs:mt-6 -ml-7 -mt-2 mx-auto" alt="flor">
                <img src="{{ asset('assets/imgs/flor5.svg') }}" class="w-full latido xs:max-w-20 max-w-28 absolute right-0 top-0 scale-x-[-1] xs:mt-6 xs:mr-6 -mt-2 -mr-7 mx-auto" alt="flor">
                <h2 class="text-center text-arena sm:text-4xl text-3xl leading-125">Confirmar asistencia</h2>
                <p class=" text-center">
                    Queremos compartir este día tan especial contigo. Por favor, confirma tu asistencia iniciando sesión en el siguiente enlace:
                </p>
                <a href="{{ route('login') }}" class="btnSecundario mx-auto">
                    <span class="spanbtn"></span>
                    <p class="relative">Ingresar</p>
                </a>
                <div class="flex justify-center ">
                    {{-- <img src="{{ asset('assets/imgs/carro.svg') }}" class="w-full xs:max-w-80 max-w-[calc(100%-70px)] xs:-ml-17.5 -ml-12.5" alt=""> --}}
                    <div class="w-full xs:max-w-80 max-w-[calc(100%-70px)] xs:-ml-17.5 -ml-12.5" id="lottiecarro"></div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    // ── Flag sincrónico: bloquea que pageshow/load oculten el loader ──────────
    // Esta asignación simple corre antes que app.js (módulo Vite), lo que
    // está bien porque no llama a ninguna función externa.
    window.__esperandoImagenes = true;

    // ── Todo lo demás espera a DOMContentLoaded ───────────────────────────────
    // En ese momento los módulos Vite ya corrieron → mostrarCargando y
    // ocultarCargando ya están definidos en window.
    document.addEventListener('DOMContentLoaded', function () {

        function _mostrarPagina() {
            if (!window.__esperandoImagenes) return; // seguridad: ejecutar una sola vez
            window.__esperandoImagenes = false;

            // Primero quitamos el CSS override (si no, ocultarCargando no puede ocultar)
            var estiloOverride = document.getElementById('invitacion-loader-override');
            if (estiloOverride) estiloOverride.remove();

            ocultarCargando();

            // Animación del sobre emergiendo
            var sobre = document.getElementById('imgSobreInvitacion');
            if (sobre) {
                setTimeout(function () {
                    sobre.classList.remove('sm:translate-y-40', 'translate-y-[27vw]');
                    sobre.classList.add('translate-y-0');
                }, 150);
            }
        }

        // Imágenes críticas: las 3 partes del sobre (visible al entrar)
        var _imgsCriticas = [
            document.querySelector('img[src*="sobre/back"]'),
            document.querySelector('img[src*="sobre/mid"]'),
            document.querySelector('img[src*="sobre/front"]'),
        ].filter(function (img) { return img !== null; });

        if (_imgsCriticas.length === 0) {
            // No se encontraron imágenes → mostrar de inmediato
            _mostrarPagina();
        } else {
            // Las que aún no terminaron de cargar
            var _pendientes = _imgsCriticas.filter(function (img) {
                return !img.complete || img.naturalWidth === 0;
            });

            if (_pendientes.length === 0) {
                // Todas ya en caché → mostrar de inmediato
                _mostrarPagina();
            } else {
                var _cargadas = 0;
                _pendientes.forEach(function (img) {
                    var _onListo = function () {
                        _cargadas++;
                        if (_cargadas >= _pendientes.length) _mostrarPagina();
                    };
                    img.addEventListener('load', _onListo, { once: true });
                    img.addEventListener('error', _onListo, { once: true }); // si falla, continúa igual
                });
            }
        }

        // Fallback de seguridad: máximo 8 segundos
        setTimeout(function () {
            if (window.__esperandoImagenes) _mostrarPagina();
        }, 8000);
    });

    // ── Countdown ──────────────────────────────────────────────────────────────

    const fechaObjetivo = new Date("2027-05-01T00:00:00").getTime();

    const _dias = document.getElementById("dias");
    const _horas = document.getElementById("horas");
    const _minutos = document.getElementById("minutos");
    const _segundos = document.getElementById("segundos");

    function actualizarContador() {
        const ahora = new Date().getTime();
        const diferencia = fechaObjetivo - ahora;

        if (diferencia <= 0) {
            if (_dias) _dias.textContent = "0";
            if (_horas) _horas.textContent = "0";
            if (_minutos) _minutos.textContent = "0";
            if (_segundos) _segundos.textContent = "0";
            clearInterval(intervalo);
            return;
        }

        const dias = Math.floor(diferencia / (1000 * 60 * 60 * 24));
        const horas = Math.floor((diferencia % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutos = Math.floor((diferencia % (1000 * 60 * 60)) / (1000 * 60));
        const segundos = Math.floor((diferencia % (1000 * 60)) / 1000);

        if (_dias) _dias.textContent = dias;
        if (_horas) _horas.textContent = String(horas).padStart(2, "0");
        if (_minutos) _minutos.textContent = String(minutos).padStart(2, "0");
        if (_segundos) _segundos.textContent = String(segundos).padStart(2, "0");
    }

    actualizarContador();
    const intervalo = setInterval(actualizarContador, 1000);
</script>
@endsection
