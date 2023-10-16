<?php

use App\Http\Controllers\AdminController;
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
    Route::get('/profile', [ProfileController::class,       'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class,   'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(FacturasController::class)->group(function () {
    Route::get('/factura/{factura}',                 'show')->can('factura')->name('factura');
    Route::post('/crear-factura',                   'store')->name('facturas.store');
})->middleware(['auth', 'verified']);

Route::controller(AdminController::class)->group(function () {
    Route::get('/admin',                         'index')->can('dashboard-admin')->name('dashboard-admin');
    Route::get('/cargar-facturas',      'cargarFacturas')->can('cargar-facturas')->name('cargar-facturas');
    Route::post('/cargar-facturas',   'importarFacturas')->can('importar-facturas')->name('importar-facturas');
    Route::get('/facturas-emitidas',  'facturasEmitidas')->can('facturas-emitidas')->name('facturas-emitidas');
    Route::get('/pagos/pendientes',  'pagosPorConciliar')->can('pagos-conciliar')->name('pagos-conciliar');
    Route::get('/pagos/conciliados',  'pagosConciliados')->can('pagos-conciliados')->name('pagos-conciliados');
})->middleware(['auth', 'verified']);

Route::controller(PagosController::class)->group(function (){
    Route::get('/facturas/{factura}/pagos/reportar', 'create')->can('reportar-pago')->name('reportar-pago');
    Route::post('/facturas/{factura}/pagos',          'store')->can('guardar-pago')->name('guardar-pago');
    Route::patch('/pagos',                    'conciliarPago')->can('conciliar-pago')->name('conciliar-pago');
})->middleware(['auth', 'verified']);

Route::controller(UsuariosController::class)->group(function(){
    Route::get('/',                                 'index')->can('dashboard-user')->name('dashboard-user');
    Route::get('/facturas-pendientes', 'facturasPendientes')->can('facturas-pendientes')->name('facturas-pendientes');
    Route::get('/historial',                    'historial')->can('historial')->name('historial');
})->middleware(['auth', 'verified']);

Route::controller(AliadosController::class)->group(function(){
    Route::get('/aliados',            'index')->can('aliados.index')->name('aliados.index');
    Route::get('/aliados/{aliado}',    'show')->can('aliados.show')->name('aliados.show');
    Route::get('/cargar-aliados',    'create')->name('cargar-aliados');
    Route::post('/crear-aliados',     'store')->name('aliados.store');
    Route::patch('/aliados',  'cambiarStatus')->can('aliado-status')->name('aliado-status');
})->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
