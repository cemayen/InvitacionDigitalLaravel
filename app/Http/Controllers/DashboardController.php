<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Invitado;
use App\Exports\ConfirmadosExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class DashboardController extends Controller
{
    /**
     * Muestra el resumen del Dashboard y la lista de familias.
     */
    public function index()
    {
        $familias = User::where('rol', 'Invitado')
            ->with('invitados')
            ->latest('created_at')
            ->get();

        $totalFamilias = $familias->count();
        $totalBoletos = $familias->sum('cantidad_boletos');
        $totalConfirmados = Invitado::where('confirmado', true)->count();

        return view('dashboard.index', compact('familias', 'totalFamilias', 'totalBoletos', 'totalConfirmados'));
    }

    /**
     * Muestra el formulario de registro de familia.
     */
    public function registroFamiliaForm()
    {
        return view('dashboard.registro-familia');
    }

    /**
     * Procesa el registro de una nueva familia y sus boletos.
     */
    public function registroFamilia(Request $request)
    {
        $validated = $request->validate([
            'nombre_familia' => ['required', 'string', 'max:100'],
            'username' => ['required', 'string', 'min:3', 'max:50', 'unique:users,username'],
            'password' => ['required', 'string', 'min:6'],
            'cantidad_boletos' => ['required', 'integer', 'min:1', 'max:20'],
            'opcion_cabana' => ['nullable', 'boolean'],
            'fecha_limite' => ['required', 'date'],
        ], [
            'nombre_familia.required' => 'El nombre de la familia es obligatorio.',
            'username.required' => 'El nombre de usuario es obligatorio.',
            'username.unique' => 'El nombre de usuario ya está registrado por otra familia.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'cantidad_boletos.required' => 'Indica la cantidad de boletos.',
            'fecha_limite.required' => 'La fecha límite es obligatoria.',
        ]);

        $familia = User::create([
            'nombre_familia' => $validated['nombre_familia'],
            'username' => trim($validated['username']),
            'password' => Hash::make($validated['password']),
            'cantidad_boletos' => $validated['cantidad_boletos'],
            'opcion_cabana' => $request->boolean('opcion_cabana'),
            'fecha_limite' => $validated['fecha_limite'],
            'rol' => 'Invitado',
        ]);

        // Crear automáticamente los registros de invitados según la cantidad de boletos
        for ($i = 1; $i <= $familia->cantidad_boletos; $i++) {
            $familia->invitados()->create([
                'nombre_completo' => null,
                'confirmado' => false,
            ]);
        }

        return redirect()->route('dashboard.index')
            ->with('exito', "Familia '{$familia->nombre_familia}' creada con {$familia->cantidad_boletos} boletos.");
    }

    /**
     * Muestra el formulario de edición de familia e invitados.
     */
    public function editarFamiliaForm($id)
    {
        $familia = User::where('rol', 'Invitado')
            ->with('invitados')
            ->findOrFail($id);

        return view('dashboard.editar-familia', compact('familia'));
    }

    /**
     * Actualiza la información de una familia y ajusta la lista de boletos.
     */
    public function editarFamilia(Request $request, $id)
    {
        $familia = User::where('rol', 'Invitado')
            ->with('invitados')
            ->findOrFail($id);

        $validated = $request->validate([
            'nombre_familia' => ['required', 'string', 'max:100'],
            'username' => ['required', 'string', 'min:3', 'max:50', Rule::unique('users', 'username')->ignore($familia->id)],
            'nueva_password' => ['nullable', 'string', 'min:6'],
            'cantidad_boletos' => ['required', 'integer', 'min:1', 'max:20'],
            'opcion_cabana' => ['nullable', 'boolean'],
            'fecha_limite' => ['required', 'date'],
            'invitados' => ['nullable', 'array'],
            'invitados.*.id' => ['required_with:invitados', 'integer'],
            'invitados.*.nombre_completo' => ['nullable', 'string', 'max:150'],
        ]);

        // Actualizar datos generales
        $familia->nombre_familia = $validated['nombre_familia'];
        $familia->username = trim($validated['username']);
        $familia->opcion_cabana = $request->boolean('opcion_cabana');
        $familia->fecha_limite = $validated['fecha_limite'];

        if (!empty($validated['nueva_password'])) {
            $familia->password = Hash::make($validated['nueva_password']);
        }

        // Actualizar nombres de los invitados existentes
        if (!empty($request->input('invitados'))) {
            foreach ($request->input('invitados') as $invForm) {
                $invitadoBd = $familia->invitados->firstWhere('id', $invForm['id']);
                if ($invitadoBd) {
                    $nombreLimpio = !empty(trim($invForm['nombre_completo'] ?? '')) ? trim($invForm['nombre_completo']) : null;
                    $invitadoBd->nombre_completo = $nombreLimpio;
                    $invitadoBd->confirmado = !is_null($nombreLimpio);
                    $invitadoBd->save();
                }
            }
        }

        // Ajustar la cantidad de boletos si cambió la cifra total
        $nuevaCantidad = (int) $validated['cantidad_boletos'];
        $cantidadActual = $familia->cantidad_boletos;
        $diferencia = $nuevaCantidad - $cantidadActual;

        if ($diferencia > 0) {
            for ($i = 0; $i < $diferencia; $i++) {
                $familia->invitados()->create([
                    'nombre_completo' => null,
                    'confirmado' => false,
                ]);
            }
        } elseif ($diferencia < 0) {
            $aEliminar = $familia->invitados()->skip($nuevaCantidad)->take(abs($diferencia))->get();
            foreach ($aEliminar as $inv) {
                $inv->delete();
            }
        }

        $familia->cantidad_boletos = $nuevaCantidad;
        $familia->save();

        return redirect()->route('dashboard.lista-invitados')
            ->with('exito', 'Familia e invitados actualizados correctamente.');
    }

    /**
     * Muestra el listado completo de familias con sus boletos/invitados.
     */
    public function listaInvitados()
    {
        $familias = User::where('rol', 'Invitado')
            ->with('invitados')
            ->orderBy('nombre_familia')
            ->get();

        return view('dashboard.lista-invitados', compact('familias'));
    }

    /**
     * Muestra únicamente las familias con al menos un invitado confirmado.
     */
    public function listaConfirmados()
    {
        $familias = User::where('rol', 'Invitado')
            ->whereHas('invitados', function ($query) {
                $query->whereNotNull('nombre_completo')
                    ->where('nombre_completo', '!=', '');
            })
            ->with('invitados')
            ->orderBy('nombre_familia')
            ->get();

        return view('dashboard.lista-confirmados', compact('familias'));
    }

    /**
     * Exporta la lista de confirmados a formato Excel (.xlsx).
     */
    public function exportarConfirmadosExcel()
    {
        $fecha = now()->format('Y-m-d_H-i');
        return Excel::download(new ConfirmadosExport, "Invitados_Confirmados_{$fecha}.xlsx");
    }

    /**
     * Exporta la lista de confirmados a formato PDF.
     */
    public function exportarConfirmadosPdf()
    {
        $familias = User::where('rol', 'Invitado')
            ->whereHas('invitados', function ($query) {
                $query->whereNotNull('nombre_completo')
                    ->where('nombre_completo', '!=', '');
            })
            ->with(['invitados' => function ($query) {
                $query->whereNotNull('nombre_completo')
                    ->where('nombre_completo', '!=', '');
            }])
            ->orderBy('nombre_familia')
            ->get();

        $totalConfirmados = Invitado::whereNotNull('nombre_completo')
            ->where('nombre_completo', '!=', '')
            ->whereHas('user', function ($q) {
                $q->where('rol', 'Invitado');
            })
            ->count();

        $totalCabana = $familias->where('opcion_cabana', true)->count();

        $pdf = Pdf::loadView('pdf.confirmados', compact('familias', 'totalConfirmados', 'totalCabana'));
        $pdf->setPaper('a4', 'portrait');

        $fecha = now()->format('Y-m-d_H-i');
        return $pdf->download("Invitados_Confirmados_{$fecha}.pdf");
    }

    /**
     * Elimina una familia y sus boletos asociados en cascada.
     */
    public function eliminarFamilia($id)
    {
        $familia = User::where('rol', 'Invitado')->findOrFail($id);
        $nombre = $familia->nombre_familia;

        $familia->delete();

        return redirect()->route('dashboard.index')
            ->with('exito', "La familia '{$nombre}' fue eliminada correctamente.");
    }
}
