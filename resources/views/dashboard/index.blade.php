@extends('layouts.app')

@section('title', 'Panel Administrador - Invitación Digital')

@section('content')
<div class="max-w-6xl mx-auto flex flex-col gap-6 px-4">
    <!-- Header & Navigation -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-marfil-2 p-6 rounded-2xl shadow-sm border border-slate-100">
        <div>
            <h1 class="text-2xl text-arena">Panel Administrador</h1>
            <p class="text-sm">Gestión de familias, invitaciones y boletos.</p>
        </div>

        <div class="flex flex-wrap gap-2">
            <a href="{{ route('dashboard.registro-familia') }}" class="px-4 py-2 bg-arena hover:bg-arena/80 text-marfil-2 font-medium text-xs rounded-lg transition-colors shadow-sm">
                + Nueva Familia
            </a>
            <a href="{{ route('dashboard.lista-invitados') }}" class="px-4 py-2 bg-salvia hover:bg-salvia/80 text-marfil-2 font-medium text-xs rounded-lg transition-colors">
                Ver Todos los Invitados
            </a>
            <a href="{{ route('dashboard.lista-confirmados') }}" class="px-4 py-2 bg-durazno hover:bg-durazno/80 font-medium text-xs rounded-lg transition-colors">
                Ver Confirmados
            </a>
        </div>
    </div>

    <!-- Cards Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-marfil-2 p-5 rounded-2xl shadow-sm border border-slate-100 flex flex-col">
            <span class="text-3xl font-serif font-bold text-center">{{ $totalFamilias }}</span>
            <span class="text-xxs font-semibold uppercase text-arena text-center">Total Familias</span>
        </div>
        <div class="bg-marfil-2 p-5 rounded-2xl shadow-sm border border-slate-100 flex flex-col">
            <span class="text-3xl font-serif font-bold text-center">{{ $totalBoletos }}</span>
            <span class="text-xxs font-semibold uppercase text-arena text-center">Total Boletos Asignados</span>
        </div>
        <div class="bg-marfil-2 p-5 rounded-2xl shadow-sm border border-slate-100 flex flex-col">
            <span class="text-3xl font-serif font-bold text-center">{{ $totalConfirmados }}</span>
            <span class="text-xxs font-semibold uppercase text-arena text-center">Invitados Confirmados</span>
        </div>
    </div>

    <!-- Main Table -->
    <div class="bg-marfil-2 rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center">
            <h2 class="font-serif font-bold text-arena text-lg">Familias Registradas</h2>
            <span class="text-xs text-slate-500">{{ $familias->count() }} familias encontradas</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-gris-500 text-xs font-semibold uppercase">
                        <th class="py-3 px-6">Familia</th>
                        <th class="py-3 px-6">Usuario</th>
                        <th class="py-3 px-6 text-center">Boletos</th>
                        <th class="py-3 px-6 text-center">Cabaña</th>
                        <th class="py-3 px-6 text-center">Fecha Límite</th>
                        <th class="py-3 px-6 text-center">Confirmados</th>
                        <th class="py-3 px-6 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                    @forelse($familias as $familia)
                        @php
                            $confirmadosCuenta = $familia->invitados->where('confirmado', true)->count();
                        @endphp
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="py-4 px-6 font-medium text-slate-900">{{ $familia->nombre_familia }}</td>
                            <td class="py-4 px-6 text-slate-600 font-mono text-xs">{{ $familia->username }}</td>
                            <td class="py-4 px-6 text-center font-bold text-arena">{{ $familia->cantidad_boletos }}</td>
                            <td class="py-4 px-6 text-center">
                                @if($familia->opcion_cabana)
                                    <span class="px-2.5 py-1 bg-salvia/20 text-salvia text-xs font-medium rounded-full">Sí</span>
                                @else
                                    <span class="px-2.5 py-1 bg-slate-100 text-slate-500 text-xs font-medium rounded-full">No</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-center text-xs text-slate-600">
                                {{ $familia->fecha_limite ? $familia->fecha_limite->format('d/m/Y') : 'N/A' }}
                            </td>
                            <td class="py-4 px-6 text-center font-semibold">
                                <span class="{{ $confirmadosCuenta == $familia->cantidad_boletos ? 'text-emerald-600' : 'text-slate-600' }}">
                                    {{ $confirmadosCuenta }} / {{ $familia->cantidad_boletos }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right flex justify-end gap-2">
                                {{-- <a href="{{ $familia->whatsappUrl() }}" target="_blank" rel="noopener"
                                class="inline-flex items-center gap-2 rounded-lg bg-[#25D366] px-3 py-1.5 text-sm font-medium text-white hover:bg-[#1ebe5a]">
                                    WhatsApp
                                </a> --}}
                                 <button type="button"
                                        data-target="noBlank"
                                        class="btn-compartir px-3 py-1 bg-salvia hover:bg-salvia/80 text-marfil-2 font-medium text-xs rounded transition-colors"
                                        data-titulo="Invitación familia {{ $familia->nombre_familia }}"
                                        data-mensaje="{{ $familia->mensajeAcceso() }}">
                                    Compartir
                                </button>
                                <a href="{{ route('dashboard.editar-familia', $familia->id) }}" class="px-3 py-1 bg-arena hover:bg-arena/80 text-marfil-2 font-medium text-xs rounded transition-colors">
                                    Editar
                                </a>
                                <form action="{{ route('dashboard.eliminar-familia', $familia->id) }}" method="POST" onsubmit="if (!confirm('¿Estás seguro de eliminar a la familia {{ $familia->nombre_familia }}?')) { ocultarCargando(); return false; } mostrarCargando();">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" data-target="noBlank" class="px-3 py-1 bg-rose-50 hover:bg-rose-100 text-rose-600 font-medium text-xs rounded transition-colors">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 text-center text-slate-400 italic">No hay familias registradas todavía.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection


@section('scripts')
<script>
document.addEventListener('click', async (e) => {
    const btn = e.target.closest('.btn-compartir');
    if (!btn) return;

    const { titulo, mensaje } = btn.dataset;

    // Menú nativo de compartir (celular y algunos navegadores de escritorio)
    if (navigator.share) {
        try {
            await navigator.share({ title: titulo, text: mensaje });
        } catch (err) { /* el usuario canceló */ }
        return;
    }

    // Respaldo: copiar al portapapeles
    try {
        await navigator.clipboard.writeText(mensaje);
        const original = btn.textContent;
        btn.textContent = '¡Copiado!';
        setTimeout(() => btn.textContent = original, 2000);
    } catch {
        prompt('Copia el mensaje:', mensaje);
    }
});
</script>
@endsection