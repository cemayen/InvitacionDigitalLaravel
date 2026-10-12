@extends('layouts.app')

@section('title', 'Nuestra Boda - Jennie & Cristian')

@section('content')
@php
    $fotos = [];
    foreach ([1, 2, 3, 4, 5, 6, 7, 8] as $n) {
        $fotos[] = "assets/imgs/min/{$n}.webp";
    }
    // Cada columna con su dirección. Agrega más si quieres: ['subir', 'bajar', 'subir', 'bajar']
    $columnas = ['subir', 'bajar', 'subir'];
@endphp
<section class="w-full flex flex-col gap-14">
    <div class="sm:max-w-150 w-full mx-auto">
        <img src="{{ asset('assets/imgs/sobreNegroAbierto.svg') }}" class="w-full" alt="Sobre Foto">
    </div>

    <div class="px-4 flex flex-col gap-10">
        <img src="{{ asset('assets/imgs/decorativo.svg') }}" class="w-full sm:max-w-95 max-w-67 mx-auto" alt="decorativo">
        <img src="{{ asset('assets/imgs/fecha.svg') }}" class="w-full sm:max-w-102.5 max-w-71.5 mx-auto py-10" alt="01/MAYO/2027">
    </div>

    <!-- Countdown Timer -->
    <div class="bg-arena py-14 w-full">
        <div class="sm:max-w-150 w-full mx-auto px-4 flex flex-col sm:gap-14 gap-7">
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
        <div class="py-10 flex flex-col gap-14 border-4 border-arena xxs:px-8 px-5 rounded-2xl bg-marfil-1/20">

            <div class="flex flex-col gap-10">
                <h2 class="text-center text-arena sm:text-4xl text-3xl leading-125">Nuestro Mejor Viaje <br> Empieza Hoy</h2>
                <div class="flex flex-col gap-5">
                    <p class="sm:text-left text-center">
                        De la brisa de Coatzacoalcos al corazón de la CDMX, nuestros caminos se cruzaron para empezar
                        la mayor aventura de nuestras vidas. Entre risas, complicidad y sueños compartidos, descubrimos
                        que el mejor destino siempre es estar juntos.
                    </p>
                    <p class="sm:text-left text-center">
                        Hoy, listos para iniciar la expedición más importante y decir ¡Sí, acepto!, queremos que seas
                        parte del comienzo de nuestro para siempre.
                    </p>
                </div>
            </div>
    
            {{-- <img src="{{ asset('assets/imgs/decorativo.svg') }}" class="w-full sm:max-w-95 max-w-67 mx-auto" alt="decorativo"> --}}
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
                                <img src="{{ asset("assets/imgs/fam/{$i}.jpg") }}" class="size-full rounded-2xl border-4 border-arena" alt="{{ $i }}">
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
    
        </div>
        <img src="{{ asset('assets/imgs/decorativo.svg') }}" class="w-full sm:max-w-95 max-w-67 mx-auto" alt="decorativo">
        <!-- El lugar -->
        <div class="flex flex-col gap-10">
            <h2 class="text-center text-arena sm:text-4xl text-3xl leading-125">El lugar</h2>
            <img src="{{ asset('assets/imgs/salonIcono.svg') }}" class="w-full sm:max-w-112.5 max-w-75.25 mx-auto" alt="">
            <div class="flex flex-col gap-4">
                <a href="https://maps.app.goo.gl/9N2chHKeQzCJGj9bA" target="_blank" rel="noopener noreferrer" class="text-center w-fit mx-auto sm:text-xl text-lg text-arena text-playfair font-bold">
                    <i>Coral Clubes Santa María</i>
                </a>
                <a href="https://maps.app.goo.gl/9N2chHKeQzCJGj9bA" target="_blank" rel="noopener noreferrer" class="btnSecundario mx-auto">
                    <span class="spanbtn"></span>
                    <p class="relative">Ver ubicación</p>
                </a>
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
            <h2 class="text-center text-arena sm:text-4xl text-3xl leading-125">Código de vestimenta</h2>
            <div class="relative">
                <img src="{{ asset('assets/imgs/flor5.svg') }}" class="absolute top-0 left-0 sm:w-32 xs:w-24 w-20 latido" alt="">
                <img src="{{ asset('assets/imgs/flor5.svg') }}" class="absolute bottom-0 right-0 sm:w-32 xs:w-24 w-20 scale-x-[-1] scale-y-[-1] latido" alt="">
                <div class="sm:w-52 w-44 mx-auto relative mb-10" id="lottievestimenta"></div>
            </div>
            <div class="flex flex-col gap-3">
                <p class="sm:text-2xl text-xl font-bold text-playfair text-arena text-center"><i>Vestimenta Formal</i></p>
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
        <div class="py-10 flex flex-col gap-14 border-4 border-arena xxs:px-8 px-5 rounded-2xl bg-marfil-1/20">
            <!-- Mesa de regalos -->
            <div class="flex flex-col gap-10">
                <h2 class="text-center text-arena sm:text-4xl text-3xl leading-125">Mesa de regalos</h2>
                <p class="sm:text-left text-center">
                    Tu presencia es nuestro mejor regalo. Si deseas consentirnos con un detalle adicional,
                    puedes consultar nuestra mesa de regalos
                </p>
                {{-- <img src="{{ asset('assets/imgs/mesaRegalos.svg') }}" class="mx-auto w-full xs:max-w-96 max-w-[90%]" alt=""> --}}
                <div class="mx-auto w-full xs:max-w-96 max-w-[90%]" id="lottiemesa"></div>
                <a href="#" target="_blank" rel="noopener noreferrer" class="btnSecundario mx-auto">
                    <span class="spanbtn"></span>
                    <p class="relative">Ver mesa de regalos</p>
                </a>
                <div class="flex flex-col gap-7">
                    <p class="sm:text-left text-center">
                        o apoyarnos con una aportación en efectivo para nuestro nuevo hogar
                    </p>
                    <p class="text-center underline"><b>00121215452121052</b></p>
                    <img src="{{ asset('assets/imgs/bancoVerde.svg') }}" class="w-60 mx-auto" alt="">
                </div>
            </div>
        </div>
    
        <!-- Confirmar Asistencia -->
        <div class="flex flex-col gap-10">
            <h2 class="text-center text-arena sm:text-4xl text-3xl leading-125">Confirmar asistencia</h2>
            <p class="sm:text-left text-center">
                Queremos compartir este día tan especial contigo. Por favor, confirma tu asistencia iniciando sesión en el siguiente enlace:
            </p>
            <a href="{{ route('login') }}" class="btnSecundario mx-auto">
                <span class="spanbtn"></span>
                <p class="relative">Ingresar</p>
            </a>
            <div class="flex justify-center pt-5 pb-16">
                {{-- <img src="{{ asset('assets/imgs/carro.svg') }}" class="w-full xs:max-w-80 max-w-[calc(100%-70px)] xs:-ml-17.5 -ml-12.5" alt=""> --}}
                <div class="w-full xs:max-w-80 max-w-[calc(100%-70px)] xs:-ml-17.5 -ml-12.5" id="lottiecarro"></div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
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
