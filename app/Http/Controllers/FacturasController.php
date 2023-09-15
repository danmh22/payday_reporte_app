<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FacturasController extends Controller
{
    // VISTAS DE USUARIO

    public function index(Request $request) : View
    {
        // Verifica si el usuario está autenticado.
        if (!auth()->check()) {
            // El usuario no está autenticado, redirige a la página de login.
            return view('auth.login');
        }
        return view('facturas.index', [
            'user'=> $request->user(),
            'total_facturas_pendientes'  => Factura::where('users_id', $request->user()->id)->where('status', '=', 1)->count(),
            'total_facturas_reportadas'  => Factura::where('users_id', $request->user()->id)->where('status', '=', 2)->count(),
            'total_facturas_conciliadas' => Factura::where('users_id', $request->user()->id)->where('status', '=', 3)->count(),
            'facturas_pendientes'        => Factura::where('users_id', $request->user()->id)->where('status', '=', 1)->get(),
            'facturas_reportadas'        => Factura::where('users_id', $request->user()->id)->where('status', '>', 1)->get(),
        ]);
    }

    public function facturasPendientes() : View
    {
        return view('facturas.facturas_pendientes');
    }

    public function historial() : View
    {
        return view('facturas.historial');
    }

    public function reportarPago() : View
    {
        return view('facturas.form_reportar');
    }

    // VISTAS DE ADMINISTRADOR

    public function indexAdmin(Request $request) : View
    {
        // Verifica si el usuario está autenticado.
        if (!auth()->check()) {
            // El usuario no está autenticado, redirige a la página de login.
            return view('auth.login');
        }
        return view('facturas.admin_index', [
            'user'=> $request->user(),
            'total_facturas_emitidas'      => Factura::where('status', '=', 1)->count(),
            'total_facturas_por_conciliar' => Factura::where('status', '=', 2)->count(),
            'total_facturas_conciliadas'   => Factura::where('status', '=', 3)->count(),
            'lista_facturas_por_conciliar' => Factura::where('status', '=', 2)->get(),
        ]);
    }

    public function facturasEmitidas() : View
    {
        return view('facturas.admin_facturas_emitidas', [
            'lista_facturas_emitidas'      => Factura::where('status', '=', 1)->get()
        ]);
    }

    public function facturasPorConciliar() : View
    {
        return view('facturas.admin_facturas_conciliar', [
            'lista_facturas_por_conciliar' => Factura::where('status', '=', 2)->get()
        ]);
    }

    public function cargarFacturas() : View
    {
        return view('facturas.admin_form_cargar_facturas');
    }

    // VISTAS COMUNES

    public function factura() : View
    {
        return view('facturas.factura');
    }



    public function create(){

    }

    public function store(){

    }

    public function show()
    {

    }
    public function edit(){

    }
    public function update(){

    }
    public function destroy(){

    }
}
