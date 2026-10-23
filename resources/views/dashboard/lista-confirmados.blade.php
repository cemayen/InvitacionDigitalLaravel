@extends('layouts.app')

@section('title', 'Lista de Confirmados - Invitación Digital')

@section('content')
<div class="max-w-6xl mx-auto flex flex-col gap-6 px-4">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-marfil-2 p-6 rounded-2xl shadow-sm border border-slate-100">
        <div>
            <h1 class="text-2xl text-arena">Familias e Invitados Confirmados</h1>
            <p class="text-sm">Muestra únicamente las familias que ya capturaron al menos un nombre de invitado.</p>
        </div>
        <div class="flex flex-wrap items-center gap-2">
            <a href="{{ route('dashboard.confirmados.excel') }}" data-target="noBlank" class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-salvia hover:bg-salvia/90 text-marfil-2 text-xs font-semibold rounded-lg shadow-sm transition-all">
                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14 2H6C4.89 2 4 2.89 4 4V20C4 21.11 4.89 22 6 22H18C19.11 22 20 21.11 20 20V8L14 2M15.8 19L14 15.6L12.2 19H10.2L12.9 14.5L10.4 10.3H12.4L14 13.5L15.6 10.3H17.6L15.1 14.5L17.8 19H15.8M13 9V3.5L18.5 9H13Z"/>
                </svg>
                <span>Descargar Excel</span>
            </a>

            <a href="{{ route('dashboard.confirmados.pdf') }}" data-target="noBlank" class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-arena hover:bg-arena/90 text-marfil-2 text-xs font-semibold rounded-lg shadow-sm transition-all">
                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 3H5C3.89 3 3 3.89 3 5V19C3 20.11 3.89 21 5 21H19C20.11 21 21 20.11 21 19V5C21 3.89 20.11 3 19 3M9.5 11.5C9.5 12.33 8.83 13 8 13H7V15H5.5V9H8C8.83 9 9.5 9.67 9.5 10.5V11.5M14.5 13.5C14.5 14.33 13.83 15 13 15H10.5V9H13C13.83 9 14.5 9.67 14.5 10.5V13.5M18.5 10.5H16.5V11.5H18V13H16.5V15H15V9H18.5V10.5M7 10.5V11.5H8V10.5H7M12 10.5V13.5H13V10.5H12Z"/>
                </svg>
                <span>Descargar PDF</span>
            </a>

            <a href="{{ route('dashboard.index') }}" class="px-3.5 py-2 bg-marfil-1 hover:bg-gris-100 text-gris-500 border border-gris-100 text-xs font-medium rounded-lg transition-colors">
                &larr; Dashboard
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($familias as $familia)
            <div class="bg-marfil-2 rounded-2xl shadow-sm border border-salvia p-6 flex flex-col justify-between">
                <div>
                    <div class="flex justify-between items-start mb-3 border-b border-slate-100 pb-3">
                        <div>
                            <h2 class="text-arena text-lg">{{ $familia->nombre_familia }}</h2>
                            <span class="text-xs font-mono ">Usuario: {{ $familia->username }}</span>
                        </div>
                        <span class="px-3 py-1 bg-salvia/20 text-emerald-700 text-xs font-bold rounded-full border border-salvia">
                            {{ $familia->invitados->where('confirmado', true)->count() }} de {{ $familia->cantidad_boletos }} Confirmados
                        </span>
                    </div>

                    <div class="flex flex-col gap-2 mb-4">
                        @foreach($familia->invitados as $index => $invitado)
                            @if($invitado->confirmado)
                                <div class="p-2.5 rounded-lg border border-salvia bg-emerald-50/60 text-xs text-emerald-950 flex justify-between items-center">
                                    <span class="font-medium">
                                        Boleto #{{ $index + 1 }}: {{ $invitado->nombre_completo }}
                                    </span>
                                    <span class="px-2 py-0.5 rounded text-[11px] font-semibold bg-salvia/20 text-emerald-800">
                                        Confirmado
                                    </span>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div class="pt-3 border-t border-slate-100 flex justify-between items-center text-xs text-slate-500">
                    <span>Cabaña: <strong>{{ $familia->opcion_cabana ? 'Sí' : 'No' }}</strong></span>
                    <a href="{{ route('dashboard.editar-familia', $familia->id) }}" class="text-arena font-semibold hover:underline">
                        Editar Familia &rarr;
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-2 bg-marfil-2 p-8 rounded-2xl text-center text-slate-400 italic">
                Aún no hay familias con invitados confirmados.
            </div>
        @endforelse
    </div>
</div>
@endsection
