@extends('layouts.app')

@section('title', 'Nuestra Boda - Jennie & Cristian')

@section('content')
<a href="{{ route('inicio.invitacion') }}" class="sm:max-w-200 w-full mx-auto lg:px-4 overflow-x-hidden overflow-y-hidden relative h-158.25 xs:pt-0 pt-10 sm:mt-0 -mt-10 block">
    <div class="sm:w-100 w-75.25 absolute top left-0 sm:ml-0 -ml-16 xs:mt-0 -mt-10">
        <img src="{{ asset('assets/imgs/flor5.svg') }}" class="relative sm:w-100 w-75.25" alt="">
    </div>
    <div class="relative h-full py-25 w-135.5 left-1/2 -translate-x-1/2 block sobreNegro">
        <img src="{{ asset('assets/imgs/sobreNegro.svg') }}" class="w-135.5 mx-auto rotate-[-35deg] sobreNegro" alt="">
    </div>
    <div class="sm:w-82.5 w-78.25 absolute bottom-0 right-0 rotate-180 md:mr-12 sm:mr-0 -mr-32 mb-8">
        <img src="{{ asset('assets/imgs/flor6.svg') }}" class="relative sm:w-82.5 w-78.25 sm:rotate-0 -rotate-12" alt="">
    </div>
</a>
<a href="{{ route('inicio.invitacion') }}" class="bg-arena w-62.25 fixed bottom-0 left-1/2 -translate-x-1/2 mb-6 rounded-3xl animate-pulse hidden" id="verMensaje">
    <p class="px-5 py-1 text-marfil-1 text-sm line-clamp-1">Dale click al sobre para abrirlo</p>
</a>
@endsection
