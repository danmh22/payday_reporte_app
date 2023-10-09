<?php

use App\Http\Controllers\AliadosController;
use App\Http\Controllers\FacturasController;
use App\Http\Controllers\PagosController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsuariosController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/home', function () {
    return view('header');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(FacturasController::class)->group(function () {
    Route::get('/',                        'index')->name('dashboard-user');
    Route::get('/facturas-pendientes',     'facturasPendientes')->name('facturas-pendientes');
    Route::get('/historial',               'historial')->name('historial');
    Route::get('/dashboard-admin',         'indexAdmin')->name('dashboard-admin');
    Route::get('/cargar-facturas',         'cargarFacturas')->name('cargar-facturas');
    Route::post('/cargar-facturas',        'importarFacturas')->name('importar-facturas');
    Route::get('/facturas-emitidas',       'facturasEmitidas')->name('facturas-emitidas');
    Route::get('/facturas-conciliar',      'facturasPorConciliar')->name('facturas-conciliar');
    Route::get('/facturas-conciliadas',    'facturasConciliadas')->name('facturas-conciliadas');
    Route::get('/factura/{factura}',       'show')->name('factura');
})->middleware(['auth', 'verified']);

Route::controller(PagosController::class)->group(function (){
    Route::get('/facturas/{factura}/pagos/reportar', 'create')->name('reportar-pago');
    Route::post('/facturas/{factura}/pagos',          'store')->name('guardar-pago');
    Route::patch('/pagos',                    'conciliarPago')->name('conciliar-pago');
})->middleware(['auth', 'verified']);

Route::controller(UsuariosController::class)->group(function(){
    Route::get('/usuarios',   'vistaUsuarios')->name('usuarios');
    Route::patch('/usuarios', 'cambiarStatus')->name('usuario-status');
})->middleware(['auth', 'verified']);

Route::controller(AliadosController::class)->group(function(){
    Route::get('/aliados',    'index')->name('aliados');
    Route::patch('/aliados',  'cambiarStatus')->name('aliado-status');
})->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
