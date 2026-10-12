<!DOCTYPE html>
<html lang="es-MX" class="h-full">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="robots" content="noindex, nofollow" />
    <title>@yield('title', 'Invitación Digital - Jennie & Cristian')</title>

    <link rel="stylesheet" href="{{ asset('lib/swiper-bundle.min.css') }}" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-full flex-col overflow-x-hidden bg-marfil-2 font-sans text-gris-500">
    @include('partials.animacion-cargando')

    @include('partials.header')

    <main role="main" class="pb-25">
        
            @if (session('exito'))
                <div class="max-w-4xl mx-auto mb-6 p-4 bg-salvia/20 border border-salvia text-salvia font-medium text-sm rounded-lg text-center shadow-sm">
                    {{ session('exito') }}
                </div>
            @endif

            @if (session('error'))
                <div class="max-w-4xl mx-auto mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-700 text-sm rounded-lg text-center shadow-sm">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
    </main>

    @auth
        @include('partials.footer')
    @endauth

    <script src="{{ asset('lib/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('lib/lottie.min.js') }}"></script>
    <!-- <script src="{{ asset('js/site.js') }}"></script> -->
    @stack('scripts')
    @yield('scripts')
    
    <script>
        function loaderLottie(){
            const container = document.getElementById('lottieCargando');
            if (container && typeof bodymovin !== 'undefined') {
                bodymovin.loadAnimation({
                    container: container,
                    path: '{{ asset("assets/lotties/loader3.json") }}',
                    renderer: 'svg',
                    loop: true,
                    autoplay: true,
                });
            }
        }
        function vestimentaLottie(){
            const container = document.getElementById('lottievestimenta');
            if (container && typeof bodymovin !== 'undefined') {
                bodymovin.loadAnimation({
                    container: container,
                    path: '{{ asset("assets/lotties/vestimenta.json") }}',
                    renderer: 'svg',
                    loop: true,
                    autoplay: true,
                });
            }
        }
        function mesaLottie(){
            const container = document.getElementById('lottiemesa');
            if (container && typeof bodymovin !== 'undefined') {
                bodymovin.loadAnimation({
                    container: container,
                    path: '{{ asset("assets/lotties/mesa.json") }}',
                    renderer: 'svg',
                    loop: true,
                    autoplay: true,
                });
            }
        }
        function carroLottie(){
            const container = document.getElementById('lottiecarro');
            if (container && typeof bodymovin !== 'undefined') {
                bodymovin.loadAnimation({
                    container: container,
                    path: '{{ asset("assets/lotties/carro.json") }}',
                    renderer: 'svg',
                    loop: true,
                    autoplay: true,
                });
            }
        }
        window.addEventListener("DOMContentLoaded", () => {
            loaderLottie();
            mesaLottie();
            vestimentaLottie();
            carroLottie();
        });
        window.addEventListener("pageshow", () => {
            const elementAnimacionCargando = document.querySelector("#elemento-animacioncargando");
            if (elementAnimacionCargando) {
                elementAnimacionCargando.classList.add("hidden");
            }
            document.body.style.overflow = '';
        });
    </script>
</body>
</html>
