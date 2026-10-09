@extends('layouts.app')

@section('title', 'Registrar Familia - Invitación Digital')

@section('content')
<div class="max-w-2xl mx-auto flex flex-col gap-6 px-4">
    <div class="flex justify-between items-center bg-marfil-2 p-6 rounded-2xl shadow-sm border border-slate-100">
        <div>
            <h1 class="text-2xl text-arena">Registrar Nueva Familia</h1>
            <p class="text-sm">Crea el usuario y asigna la cantidad inicial de boletos.</p>
        </div>
        <a href="{{ route('dashboard.index') }}" class="px-3 py-1.5 bg-arena text-marfil-1 hover:bg-arena/80 text-xs font-medium rounded-lg transition-colors">
            &larr; Volver
        </a>
    </div>

    <form action="{{ route('dashboard.registro-familia.store') }}" method="POST" class="bg-marfil-2 p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col gap-5">
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

        <div class="flex flex-col gap-1">
            <label for="nombre_familia" class="label">Nombre de la Familia</label>
            <input type="text" id="nombre_familia" name="nombre_familia" value="{{ old('nombre_familia') }}" placeholder="Ej. Familia Mayén Trejo" required
                class="input">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="flex flex-col gap-1">
                <label for="username" class="label">Usuario de Acceso</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" placeholder="Ej. FamiliaMayenTrejo" required
                    class="input font-mono">
            </div>
            <div class="flex flex-col gap-1">
                <label for="password" class="label">Contraseña</label>
                <div class="inputContraseña w-full relative">
                    <input type="password" id="password" name="password" required class="input !pr-8" autocomplete="current-password">
                    <div class="w-5 absolute top-0 mt-3 mr-2 right-0 cursor-pointer" onclick="mostarOcultarContraseña(this)">
                        <svg class="w-5 cursor-pointer fill-salvia iconShowPassword" viewBox="0 0 576 512">
                            <path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z" />
                        </svg>
                        <svg class="w-5 hidden cursor-pointer fill-salvia iconHiddenPassword" viewBox="0 0 640 512">
                            <path d="M38.8 5.1C28.4-3.1 13.3-1.2 5.1 9.2S-1.2 34.7 9.2 42.9l592 464c10.4 8.2 25.5 6.3 33.7-4.1s6.3-25.5-4.1-33.7L525.6 386.7c39.6-40.6 66.4-86.1 79.9-118.4c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C465.5 68.8 400.8 32 320 32c-68.2 0-125 26.3-169.3 60.8L38.8 5.1zM223.1 149.5C248.6 126.2 282.7 112 320 112c79.5 0 144 64.5 144 144c0 24.9-6.3 48.3-17.4 68.7L408 294.5c8.4-19.3 10.6-41.4 4.8-63.3c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3c0 10.2-2.4 19.8-6.6 28.3l-90.3-70.8zM373 389.9c-16.4 6.5-34.3 10.1-53 10.1c-79.5 0-144-64.5-144-144c0-6.9 .5-13.6 1.4-20.2L83.1 161.5C60.3 191.2 44 220.8 34.5 243.7c-3.3 7.9-3.3 16.7 0 24.6c14.9 35.7 46.2 87.7 93 131.1C174.5 443.2 239.2 480 320 480c47.8 0 89.9-12.9 126.2-32.5L373 389.9z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="flex flex-col gap-1">
                <label for="cantidad_boletos" class="label">Cantidad de Boletos</label>
                <input type="number" id="cantidad_boletos" name="cantidad_boletos" min="1" max="20" value="{{ old('cantidad_boletos', 2) }}" required
                    class="input">
            </div>
            <div class="flex flex-col gap-1">
                <label for="fecha_limite" class="label">Fecha Límite de Confirmación</label>
                <input type="date" id="fecha_limite" name="fecha_limite" value="2026-12-01" required
                    class="input">
            </div>
        </div>

        <div class="flex items-center gap-2 pt-2">
            <input type="checkbox" id="opcion_cabana" name="opcion_cabana" value="1" {{ old('opcion_cabana') ? 'checked' : '' }}
                class="rounded border-slate-300 text-amber-600 focus:ring-amber-500">
            <label for="opcion_cabana" class="label">
                ¿Opción a Cabaña Habilitada?
            </label>
        </div>

        <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
            <a href="{{ route('dashboard.index') }}" class="btnPrincipal">
                <span class="spanbtn"></span>
                <p class="relative">Cancelar</p>
            </a>
            <button type="submit" class="btnSecundario">
                <span class="spanbtn"></span>
                <p class="relative">Guardar Familia</p>
            </button>
        </div>
    </form>
</div>
@endsection
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const inputUsuario = document.getElementById('username');
        const inputPassword = document.getElementById('password');

        inputUsuario.addEventListener('input', () => {
            inputPassword.value = inputUsuario.value + '1527';
        });
    });
</script>
@endpush