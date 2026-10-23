@extends('layouts.app')

@section('title', 'Registro de boletos')

@section('content')
<section class="sm:max-w-150 w-full mx-auto px-4 flex flex-col gap-14">
    <div class="flex flex-col gap-5">
        <div class="flex flex-col gap-2 -mt-5">
            <p class="text-center font-medium leading-120">
                Bienvenidos Familia
            </p>
            <h3 class="text-arena text-center text-3xl leading-120 font-bold">
                {{ $familia->nombre_familia }}
            </h3>
            <p class="text-center font-medium text-sm leading-120 text-salvia">
                Tienes {{ $familia->cantidad_boletos }} {{ $familia->cantidad_boletos == 1 ? 'boleto asignado' : 'boletos asignados' }}
            </p>
        </div>
    </div>

    <div class="flex flex-col gap-12">
        <form action="{{ route('cuenta.guardar-invitados') }}" method="POST">
            @csrf

            <div class="flex flex-col gap-5">
                @foreach($familia->invitados as $index => $invitado)
                    <div class="flex flex-col gap-1">
                        <label class="label">Boleto / Pase #{{ $index + 1 }}</label>

                        <input type="hidden" name="invitados[{{ $index }}][id]" value="{{ $invitado->id }}">
                        <input type="text"
                            name="invitados[{{ $index }}][nombre_completo]"
                            value="{{ old("invitados.$index.nombre_completo", $invitado->nombre_completo) }}"
                            class="input"
                            placeholder="Nombre completo del invitado"
                            {{ $edicionBloqueada ? 'disabled' : '' }} />
                    </div>
                @endforeach

                @if (!$edicionBloqueada)
                    <button type="submit" class="btnPrincipal w-full mx-auto mt-5">
                        <span class="spanbtn"></span>
                        <p class="relative">Confirmar</p>
                    </button>
                @endif

                @if ($familia->invitados->filter(fn ($i) => trim($i->nombre_completo ?? '') !== '')->isNotEmpty())
                    <a href="{{ route('cuenta.descargar-boleto') }}" target="_blank"
                    class="inline-flex items-center justify-center gap-2 mt-3 text-sm font-semibold text-arena hover:underline">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Descargar boleto familiar (PDF)
                    </a>
                @endif
            </div>
        </form>
        <div class="flex flex-col gap-2">
            @if ($yaRegistrados)
                <div class="p-4 text-sm text-salvia rounded-lg bg-salvia/10 border border-salvia text-center font-medium">
                    Los invitados han sido registrados con éxito. Si deseas cambiar un invitado, comunícate con los novios.
                </div>
            @elseif ($fechaExpirada)
                <div class="p-4 text-sm text-gris-500 rounded-lg bg-gris-500/10 border border-gris-500 text-center font-medium">
                    La fecha límite para confirmar o registrar tus pases ha expirado. Por favor comunícate con los novios.
                </div>
            @endif

            @if (!$yaRegistrados && $familia->fecha_limite)
                <p class="bg-arena/10 py-1 px-3 border border-arena text-sm text-arena text-center font-medium rounded">
                    Tienes hasta el <b>{{ $familia->fecha_limite->format('d/m/Y') }}</b> para registrar tus boletos
                </p>
                <p class="text-center font-medium text-playfair mt-1">
                    <i>
                        Si tienes problemas para confirmar contacta a los novios por WhatsApp
                    </i>
                </p>
            @endif
        </div>
    </div>
</section>
@endsection
