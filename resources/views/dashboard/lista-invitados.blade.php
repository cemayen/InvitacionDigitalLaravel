@extends('layouts.app')

@section('title', 'Lista de Invitados - Invitación Digital')

@section('content')
<div class="max-w-6xl mx-auto flex flex-col gap-6 px-4">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-marfil-2 p-6 rounded-2xl shadow-sm border border-slate-100">
        <div>
            <h1 class="text-2xl text-arena">Lista General de Invitados</h1>
            <p class="text-sm">Desglose de boletos asignados por cada familia.</p>
            
        </div>
        <div class="flex flex-col gap-2">
            <a href="{{ route('dashboard.index') }}" class="px-3 py-1.5 bg-arena hover:bg-arena/80 text-marfil-1 text-xs font-medium rounded-lg transition-colors">
                &larr; Volver al Dashboard
            </a>
            
        </div>
    </div>
    <div class="flex justify-end">
        <a href="{{ route('dashboard.lista-confirmados') }}" class="px-3 py-1.5 bg-salvia hover:bg-salvia/80 text-center text-marfil-2 text-xs font-medium rounded-lg transition-colors">
            Solo Confirmados
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($familias as $familia)
            <div class="bg-marfil-2 rounded-2xl shadow-sm border border-slate-100 p-6 flex flex-col justify-between">
                <div>
                    <div class="flex justify-between items-start mb-3 border-b border-slate-100 pb-3">
                        <div>
                            <h2 class="font-serif font-bold text-arena text-lg">{{ $familia->nombre_familia }}</h2>
                            <span class="text-xs font-mono ">Usuario: {{ $familia->username }}</span>
                        </div>
                        <span class="px-3 py-1 bg-salvia/10 text-salvia text-xs font-bold rounded-full border border-salvia/30">
                            {{ $familia->cantidad_boletos }} {{ $familia->cantidad_boletos == 1 ? 'Boleto' : 'Boletos' }}
                        </span>
                    </div>

                    <div class="flex flex-col gap-2 mb-4">
                        @foreach($familia->invitados as $index => $invitado)
                            <div class="p-2.5 rounded-lg border text-xs flex justify-between items-center {{ $invitado->confirmado ? 'bg-salvia/10 border-salvia' : 'bg-marfil-1 border-slate-200' }}">
                                <span class="font-medium">
                                    #{{ $index + 1 }}: {{ $invitado->nombre_completo ?? 'Sin capturar' }}
                                </span>
                                <span class="px-2 py-0.5 rounded text-[11px] font-semibold {{ $invitado->confirmado ? 'bg-salvia/15 text-emerald-800' : 'bg-marfil-2 text-slate-600' }}">
                                    {{ $invitado->confirmado ? 'Confirmado' : 'Pendiente' }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="pt-3 border-t border-slate-100 flex justify-between items-center text-xs">
                    <span class="">
                        Cabaña: <strong>{{ $familia->opcion_cabana ? 'Sí' : 'No' }}</strong> | Límite: <strong>{{ $familia->fecha_limite ? $familia->fecha_limite->format('d/m/Y') : 'N/A' }}</strong>
                    </span>
                    <a href="{{ route('dashboard.editar-familia', $familia->id) }}" class="text-arena font-semibold hover:underline">
                        Editar Familia &rarr;
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-2 bg-marfil-2 p-8 rounded-2xl text-center text-slate-400 italic">
                No hay familias ni invitados registrados.
            </div>
        @endforelse
    </div>
</div>
@endsection
