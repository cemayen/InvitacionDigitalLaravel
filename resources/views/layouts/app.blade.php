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

    <meta name="theme-color" content="#D8B690">
    <meta name="copyright" content="Invitación Digital - Jennie & Cristian">
    <meta name="description"
        content="Te invitamos a nuestra boda Jennie & Cristian 1-MAY-2027.">
    
    <link rel="canonical" href="https://jennieycristian.celebratu.com">

    <meta property="og:title" content="Invitación Digital - Jennie & Cristian">
    <meta property="og:type" content="website"> 
    <meta property="og:url" content="https://jennieycristian.celebratu.com">
    <meta property="og:site_name" content="Invitación Digital - Jennie & Cristian">
    <meta property="og:image" content="https://jennieycristian.celebratu.com/assets/imgs/portada.webp?raw=true"> 
    <meta property="og:description"
        content="Te invitamos a nuestra boda Jennie & Cristian 1-MAY-2027.">
    
    <meta property="og:image:width" content="1500">
    <meta property="og:image:height" content="1080">
    <meta property="og:image:type" content="image/png">

    @stack('preloads')
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
            // Si una página está controlando el loader manualmente, no lo ocultamos aquí
            if (window.__esperandoImagenes) return;
            const elementAnimacionCargando = document.querySelector("#elemento-animacioncargando");
            if (elementAnimacionCargando) {
                elementAnimacionCargando.classList.add("hidden");
            }
            document.body.style.overflow = '';
        });
    </script>
</body>
</html>
