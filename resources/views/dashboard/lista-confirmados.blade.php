@extends('layouts.app')

@section('title', 'Lista de Confirmados - Invitación Digital')

@section('content')
<div class="max-w-6xl mx-auto flex flex-col gap-6 px-4">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-marfil-2 p-6 rounded-2xl shadow-sm border border-slate-100">
        <div>
            <h1 class="text-2xl text-arena">Familias e Invitados Confirmados</h1>
            <p class="text-sm">Muestra únicamente las familias que ya capturaron al menos un nombre de invitado.</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('dashboard.index') }}" class="px-3 py-1.5 bg-arena hover:bg-arena/80 text-marfil-2 text-xs font-medium rounded-lg transition-colors">
                &larr; Volver al Dashboard
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
