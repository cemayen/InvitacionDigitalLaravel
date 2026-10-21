<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class AuthController extends Controller
{
    /**
     * Muestra el formulario de inicio de sesión.
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->rol === 'Admin') {
                return redirect()->route('dashboard.index');
            }
            return redirect()->route('cuenta.index');
        }

        return view('auth.login');
    }

    /**
     * Procesa el intento de inicio de sesión por Username.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'username.required' => 'El nombre de usuario es obligatorio.',
            'password.required' => 'La contraseña es obligatoria.',
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']], $remember)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->rol === 'Admin') {
                return redirect()->intended(route('dashboard.index'));
            }

            return redirect()->intended(route('cuenta.index'));
        }

        return back()->withErrors([
            'username' => 'Usuario o contraseña incorrectos.',
        ])->onlyInput('username');
    }

    /**
     * Cierra la sesión del usuario.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function accesoEnlace(Request $request, User $user)
    {
        // El enlace no sirve para administradores
        abort_if($user->rol === 'Admin', 403);

        // Valida contra la fecha_limite que haya en la BD en este momento
        if (now()->gt($user->fecha_limite->endOfDay())) {
            return redirect()->route('login')->withErrors([
                'username' => 'Tu enlace de acceso expiró. Contacta a los organizadores.',
            ]);
        }

        Auth::login($user, remember: true);
        $request->session()->regenerate();

        return redirect()->route('inicio.index');
    }
}
