@extends('layouts.app')

@section('title', 'Registro de boletos')

@section('content')
<section class="sm:max-w-150 w-full mx-auto px-4 flex flex-col gap-14 pb-10">
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
        {{-- Mensaje de cabaña: solo visible si la familia tiene habilitada esa opción --}}
        @if ($familia->opcion_cabana && !$fechaExpirada)
            <div class="flex flex-col gap-3 p-5 rounded-2xl border border-arena/40 bg-arena/10">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 shrink-0 fill-arena" viewBox="0 0 576 512">
                        <path d="M575.8 255.5c0 18-15 32.1-32 32.1l-32 0 .7 160.2c0 2.7-.2 5.4-.5 8.1l0 16.2c0 22.1-17.9 40-40 40l-16 0c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1L416 512l-24 0c-22.1 0-40-17.9-40-40l0-24 0-64c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32 14.3-32 32l0 64 0 24c0 22.1-17.9 40-40 40l-24 0-31.9 0c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2l-16 0c-22.1 0-40-17.9-40-40l0-112c0-.9 0-1.9 .1-2.8l0-69.7-32 0c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/>
                    </svg>
                    <h4 class="font-semibold text-arena text-base">¿Necesitan hospedaje?</h4>
                </div>
                <p class="text-sm leading-relaxed">
                    Las instalaciones del evento cuentan con <strong>cabañas disponibles</strong> con capacidad para
                    <strong>6 personas</strong>. Si deseas apartar una, puedes comunicarte directamente con los novios
                    o al siguiente número telefónico:
                </p>
                <p class="text-sm font-semibold text-arena text-center tracking-wide">
                    📞 <span class="underline underline-offset-2">(Esta pendiente)</span>
                </p>
                <p class="text-xs text-center text-gris-500 italic">
                    * Sujeto a disponibilidad. Se recomienda apartar con anticipación.
                </p>
            </div>
        @endif
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
