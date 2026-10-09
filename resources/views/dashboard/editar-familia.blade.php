@extends('layouts.app')

@section('title', 'Editar Familia - Invitación Digital')

@section('content')
<div class="max-w-3xl mx-auto flex flex-col gap-6 px-4">
    <div class="flex justify-between items-center bg-marfil-2 p-6 rounded-2xl shadow-sm border border-slate-100">
        <div>
            <h1 class="text-xl text-arena">Editar Familia: {{ $familia->nombre_familia }}</h1>
            <p class="text-sm">Modifica datos generales o actualiza el nombre de sus invitados.</p>
        </div>
        <a href="{{ route('dashboard.lista-invitados') }}" class="px-3 py-1.5 bg-arena hover:bg-arena/80 text-marfil-2 text-xs font-medium rounded-lg transition-colors">
            &larr; Volver a Lista
        </a>
    </div>

    <form action="{{ route('dashboard.editar-familia.update', $familia->id) }}" method="POST" class="bg-marfil-2 p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col gap-6">
        @csrf

        @if ($errors->any())
        <div class="p-4 bg-rose-50 border border-rose-200 text-rose-700 text-xs rounded-lg">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="border-b border-slate-100 pb-4">
            <h2 class="text-arena text-base mb-4">Datos Generales</h2>

            <div class="flex flex-col gap-4">
                <div class="flex flex-col gap-1">
                    <label for="nombre_familia" class="label">Nombre de la Familia</label>
                    <input type="text" id="nombre_familia" name="nombre_familia" value="{{ old('nombre_familia', $familia->nombre_familia) }}" required
                        class="input">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="flex flex-col gap-1">
                        <label for="username" class="label">Usuario de Acceso</label>
                        <input type="text" id="username" name="username" value="{{ old('username', $familia->username) }}" required
                            class="input font-mono">
                    </div>
                    <div class="flex flex-col gap-1">
                        <label for="nueva_password" class="label">Nueva Contraseña (Opcional)</label>
                        <input type="password" id="nueva_password" name="nueva_password" placeholder="Dejar en blanco para no cambiar"
                            class="input">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="flex flex-col gap-1">
                        <label for="cantidad_boletos" class="label">Cantidad de Boletos</label>
                        <input type="number" id="cantidad_boletos" name="cantidad_boletos" min="1" max="20" value="{{ old('cantidad_boletos', $familia->cantidad_boletos) }}" required
                            class="input">
                        <span class="text-[11px] text-slate-400">Si cambias la cifra, los boletos se agregarán o recortarán automáticamente.</span>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label for="fecha_limite" class="label">Fecha Límite</label>
                        <input type="date" id="fecha_limite" name="fecha_limite" value="{{ old('fecha_limite', $familia->fecha_limite ? $familia->fecha_limite->format('Y-m-d') : '') }}" required
                            class="input">
                    </div>
                </div>

                <div class="flex items-center gap-2 pt-2">
                    <input type="checkbox" id="opcion_cabana" name="opcion_cabana" value="1" {{ old('opcion_cabana', $familia->opcion_cabana) ? 'checked' : '' }}
                        class="rounded border-slate-300 text-amber-600 focus:ring-amber-500">
                    <label for="opcion_cabana" class="text-xs font-medium text-slate-700 cursor-pointer">
                        ¿Opción a Cabaña Habilitada?
                    </label>
                </div>
            </div>
        </div>

        <!-- Section Invitados -->
        <div>
            <h2 class="text-arena text-lg mb-2">Boletos e Invitados Asignados</h2>
            <p class="text-sm mb-4">Puedes asignar o corregir directamente los nombres de los invitados.</p>

            <div class="flex flex-col gap-3">
                @foreach($familia->invitados as $index => $invitado)
                <div class="p-3 bg-marfil-2 border border-slate-200 rounded-lg flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <span class="text-xs font-semibold  w-24">Boleto #{{ $index + 1 }}</span>
                    <input type="hidden" name="invitados[{{ $index }}][id]" value="{{ $invitado->id }}">
                    <input type="text" name="invitados[{{ $index }}][nombre_completo]" value="{{ old("invitados.$index.nombre_completo", $invitado->nombre_completo) }}" placeholder="Sin nombre asignado"
                        class="grow input">
                    <span class="text-xs font-medium px-2.5 py-1 rounded-full text-center {{ $invitado->confirmado ? 'bg-salvia/10 text-esmerald-500' : 'bg-arena text-marfil-1' }}">
                        {{ $invitado->confirmado ? 'Confirmado' : 'Pendiente' }}
                    </span>
                </div>
                @endforeach
            </div>
        </div>

        <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
            <a href="{{ route('dashboard.index') }}" class="btnPrincipal">
                <span class="spanbtn"></span>
                <p class="relative">Cancelar</p>
            </a>
            <button type="submit" class="btnSecundario">
                <span class="spanbtn"></span>
                <p class="relative">Guardar cambios</p>
            </button>

        </div>
    </form>
</div>
@endsection