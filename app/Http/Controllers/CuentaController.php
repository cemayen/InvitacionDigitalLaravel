<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Invitado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class CuentaController extends Controller
{
    /**
     * Muestra el portal de la familia logueada y sus pases asignados.
     */
    public function index()
    {
        $usuario = Auth::user();
        $familia = User::with('invitados')->findOrFail($usuario->id);

        // 1. Validar si la fecha límite ya expiró (comparando fechas)
        $fechaExpirada = false;
        if ($familia->fecha_limite) {
            $fechaExpirada = now()->startOfDay()->greaterThan($familia->fecha_limite->startOfDay());
        }

        // 2. Validar si la familia ya registró a sus invitados
        $yaRegistrados = $familia->invitados()
            ->whereNotNull('nombre_completo')
            ->where('nombre_completo', '!=', '')
            ->exists();

        $edicionBloqueada = $fechaExpirada || $yaRegistrados;

        return view('cuenta.index', compact('familia', 'edicionBloqueada', 'yaRegistrados', 'fechaExpirada'));
    }

    /**
     * Guarda los nombres de los invitados ingresados por la familia.
     */
    public function guardarInvitados(Request $request)
    {
        $usuario = Auth::user();
        $familia = User::with('invitados')->findOrFail($usuario->id);

        // Validar fecha límite
        if ($familia->fecha_limite && now()->startOfDay()->greaterThan($familia->fecha_limite->startOfDay())) {
            return redirect()->route('cuenta.index')
                ->with('error', 'La fecha límite para confirmar tus pases ha expirado.');
        }

        // Validar si ya registraron invitados anteriormente
        $yaRegistrados = $familia->invitados()
            ->whereNotNull('nombre_completo')
            ->where('nombre_completo', '!=', '')
            ->exists();

        if ($yaRegistrados) {
            return redirect()->route('cuenta.index')
                ->with('error', 'Los invitados ya han sido registrados previamente y no pueden modificarse.');
        }

        $invitadosForm = $request->input('invitados', []);

        foreach ($invitadosForm as $invForm) {
            if (isset($invForm['id']) && !empty(trim($invForm['nombre_completo'] ?? ''))) {
                $invitadoBd = $familia->invitados->firstWhere('id', $invForm['id']);
                if ($invitadoBd) {
                    $invitadoBd->nombre_completo = trim($invForm['nombre_completo']);
                    $invitadoBd->confirmado = true;
                    $invitadoBd->save();
                }
            }
        }

        return redirect()->route('cuenta.index')
            ->with('exito', 'Los invitados han sido registrados con éxito. Si deseas cambiar un invitado, comunícate con los novios.');
    }

    /**
     * Genera y descarga el boleto en formato PDF.
     */
    /* dd(
        extension_loaded('gd'),
        file_exists(public_path('assets/imgs/Boleto2.png')),
        public_path('assets/imgs/Boleto2.png')
    ); */
   /*  public function descargarBoleto($id)
    {
        $invitado = Invitado::where('id', $id)
            ->where('user_id', Auth::id())
            ->with('user')
            ->first();

        if (!$invitado || empty(trim($invitado->nombre_completo ?? ''))) {
            return redirect()->route('cuenta.index')
                ->with('error', 'El boleto aún no tiene un nombre asignado o no te pertenece.');
        }

        $rutaImagen = public_path('assets/imgs/Boleto2.png');
        $imagenBase64 = null;
        if (extension_loaded('gd') && file_exists($rutaImagen)) {
            $imagenBase64 = 'data:image/png;base64,' . base64_encode(file_get_contents($rutaImagen));
        }

        $nombreFamilia = $invitado->user->nombre_familia ?? 'Invitado';
        $nombreInvitado = $invitado->nombre_completo;

        $pdf = Pdf::loadView('pdf.boleto', [
            'nombreFamilia' => $nombreFamilia,
            'nombreInvitado' => $nombreInvitado,
            'imagenBase64' => $imagenBase64,
        ]);

        $pdf->setPaper([0, 0, 745, 425]);

        $nombreArchivo = 'Boleto_' . str_replace(' ', '_', $nombreInvitado) . '.pdf';

        return $pdf->download($nombreArchivo);
    } */

        /**
 * Genera y descarga un boleto por familia con todos los nombres.
 */
    public function descargarBoleto()
    {
        $familia = User::with(['invitados' => fn ($q) => $q->orderBy('id')])
            ->findOrFail(Auth::id());

        $nombres = $familia->invitados
            ->pluck('nombre_completo')
            ->map(fn ($n) => trim($n ?? ''))
            ->filter()
            ->values();

        if ($nombres->isEmpty()) {
            return redirect()->route('cuenta.index')
                ->with('error', 'Aún no has registrado los nombres de tus invitados.');
        }

        $rutaImagen = public_path('assets/imgs/Boleto.png');
        $imagenBase64 = null;
        if (extension_loaded('gd') && file_exists($rutaImagen)) {
            $imagenBase64 = 'data:image/png;base64,' . base64_encode(file_get_contents($rutaImagen));
        }

        $nombreFamilia = $familia->nombre_familia ?? 'Invitados';

        $pdf = Pdf::loadView('pdf.boleto', [
            'nombreFamilia' => $nombreFamilia,
            'nombres'       => $nombres,
            'imagenBase64'  => $imagenBase64,
        ])->setPaper([0, 0, 3356, 1459]);

        $nombreArchivo = 'Boleto_Familia_' . \Illuminate\Support\Str::slug($nombreFamilia, '_') . '.pdf';

        return $pdf->download($nombreArchivo);
    }
}
