<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InicioController extends Controller
{
    /**
     * Landing principal.
     */
    public function index()
    {
        return view('inicio.index');
    }

    /**
     * Vista detallada de la invitación.
     */
    public function invitacion()
    {
        return view('inicio.invitacion');
    }

    /**
     * Términos y legales.
     */
    public function legales()
    {
        return view('inicio.legales');
    }
}
