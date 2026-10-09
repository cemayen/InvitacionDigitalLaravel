<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CuentaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InicioController;
use Illuminate\Support\Facades\Route;

// Rutas Públicas
Route::get('/', [InicioController::class, 'index'])->name('inicio.index');
Route::get('/invitacion', [InicioController::class, 'invitacion'])->name('inicio.invitacion');
Route::get('/legales', [InicioController::class, 'legales'])->name('inicio.legales');

// Rutas de Autenticación
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas del Panel Administrador (Protegidas por Admin)
Route::middleware(['auth', 'role:Admin'])->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::get('/registro-familia', [DashboardController::class, 'registroFamiliaForm'])->name('registro-familia');
    Route::post('/registro-familia', [DashboardController::class, 'registroFamilia'])->name('registro-familia.store');
    Route::get('/editar-familia/{id}', [DashboardController::class, 'editarFamiliaForm'])->name('editar-familia');
    Route::post('/editar-familia/{id}', [DashboardController::class, 'editarFamilia'])->name('editar-familia.update');
    Route::get('/lista-invitados', [DashboardController::class, 'listaInvitados'])->name('lista-invitados');
    Route::get('/lista-confirmados', [DashboardController::class, 'listaConfirmados'])->name('lista-confirmados');
    Route::delete('/eliminar-familia/{id}', [DashboardController::class, 'eliminarFamilia'])->name('eliminar-familia');
});

// Rutas de la Familia / Cuenta (Protegidas por Auth)
Route::middleware(['auth'])->prefix('cuenta')->name('cuenta.')->group(function () {
    Route::get('/', [CuentaController::class, 'index'])->name('index');
    Route::post('/guardar-invitados', [CuentaController::class, 'guardarInvitados'])->name('guardar-invitados');
    Route::get('/descargar-boleto', [CuentaController::class, 'descargarBoleto'])->name('descargar-boleto');
});
