<?php

namespace App\Http\Controllers;

use App\Imports\FacturasImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Factura;
use App\Models\Pago;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        
        $user = User::find($request->user()->id);
        return view('facturas.index', [
            'user'=> $request->user(),
            'total_facturas_pendientes'  => Factura::where('aliado_id', $user->aliados->id)->where('status', '=', 1)->count(),
            'total_facturas_reportadas'  => Factura::where('aliado_id', $user->aliados->id)->where('status', '=', 2)->count(),
            'total_facturas_conciliadas' => Factura::where('aliado_id', $user->aliados->id)->where('status', '=', 3)->count(),
            'facturas_pendientes'        => Factura::where('aliado_id', $user->aliados->id)->where('status', '=', 1)->get(),
            'facturas_reportadas'        => Factura::where('aliado_id', $user->aliados->id)->get(),
        ]);
    }

    public function facturasPendientes(Request $request) : View
    {
        if (!auth()->check()) {
            return view('auth.login');
        }

        $user = User::find($request->user()->id);
        return view('facturas.facturas_pendientes', [
            'total_facturas_pendientes'  => Factura::where('aliado_id', $user->aliados->id)->where('status', '<', 3)->count(),
            'facturas_pendientes'        => Factura::where('aliado_id', $user->aliados->id)->where('status', '<', 3)->paginate(8),
        ]);
    }

    public function historial(Request $request) : View
    {
        if (!auth()->check()) {
            return view('auth.login');
        }

        $user = User::find($request->user()->id);
        $facturas_con_pagos = Factura::where('aliado_id', $user->aliados->id)->has('pagos')->get();
        return view('facturas.historial', [
            'total_facturas_reportadas'  => Factura::where('aliado_id', $user->aliados->id)->where('status', '>', 1)->count(),
            'pagos_realizados'           => Pago::whereBelongsTo($facturas_con_pagos)->orderBy('fecha_pago', 'desc')->paginate(8),
        ]);
    }


    // VISTAS DE ADMINISTRADOR

    public function indexAdmin(Request $request) : View
    {
        if (!auth()->check()) {
            return view('auth.login');
        }

        // Verifica si el usuario está autenticado.
        if (!auth()->check()) {
            // El usuario no está autenticado, redirige a la página de login.
            return view('auth.login');
        }

        $monto_conciliados_final = 0;
        $monto_conciliados = Pago::where('status', '=', 2)->whereMonth('created_at', Carbon::now()->format('m'))->pluck('monto_equivalente');
        foreach ($monto_conciliados as $monto_pago){
            $monto_conciliados_final = floatval($monto_conciliados_final) + floatval($monto_pago);
        }

        $monto_pendiente_todas = 0;
        $monto_facturas_pendiente = Factura::whereIn('status', [1, 2])->whereMonth('created_at', Carbon::now()->format('m'))->pluck('monto_deudor');
        foreach ($monto_facturas_pendiente as $monto_pago){
            $monto_pendiente_todas = floatval($monto_pendiente_todas) + floatval($monto_pago);
        }

        $monto_pendiente_abonadas = 0;
        $facturas_abonadas = Factura::where('status', '=', 2)->get();
        $monto_pagos_abonados = Pago::whereBelongsTo($facturas_abonadas)->where('status', '=', 2)->whereMonth('created_at', Carbon::now()->format('m'))->pluck('monto_equivalente');
        foreach ($monto_pagos_abonados as $monto_pago){
            $monto_pendiente_abonadas = floatval($monto_pendiente_abonadas) + floatval($monto_pago);
        }

        $monto_pendiente_final = $monto_pendiente_todas - $monto_pendiente_abonadas;

        return view('facturas.admin_index', [
            'user'=> $request->user(),
            'total_facturas_emitidas'   => Factura::where('status', '=', 1)->count(),
            'total_pagos_por_conciliar' => Pago::where('status', '=', 1)->count(),
            'total_pagos_conciliados'   => Pago::where('status', '=', 2)->count(),
            'lista_pagos_por_conciliar' => Pago::where('status', '=', 1)->orderBy('fecha_pago', 'desc')->paginate(7),
            'monto_conciliados_final'      => $monto_conciliados_final,
            'monto_pendiente_final'        => $monto_pendiente_final,
        ]);
    }

    public function facturasEmitidas() : View
    {
        if (!auth()->check()) {
            return view('auth.login');
        }
        return view('facturas.admin_facturas_emitidas', [
            'lista_facturas_emitidas'      => Factura::where('status', '<', 3)->orderBy('updated_at', 'desc')->paginate(7),
        ]);
    }

    public function facturasConciliadas() : View
    {
        if (!auth()->check()) {
            return view('auth.login');
        }
        return view('facturas.admin_facturas_conciliadas', [
            'lista_facturas_conciliadas'      => Factura::where('status', '=', 3)->orderBy('fecha_pago', 'desc')->paginate(7)
        ]);
    }

    public function facturasPorConciliar() : View
    {
        if (!auth()->check()) {
            return view('auth.login');
        }
        return view('facturas.admin_facturas_conciliar', [
            'lista_facturas_por_conciliar' => Factura::where('status', '=', 2)->orderBy('fecha_pago', 'desc')->paginate(7)
        ]);
    }

    public function conciliarPago(Request $request){

        $findFactura = Factura::findOrFail($request->id);
        $findFactura->status = '3';
        $findFactura->save();

        return redirect()->route('facturas-conciliadas')->with('success', 'El pago fue conciliado exitosamente');
    }

    public function cargarFacturas() : View
    {
        if (!auth()->check()) {
            return view('auth.login');
        }
        return view('facturas.admin_form_cargar_facturas');
    }

    public function importarFacturas(Request $request)
    {
        $file = $request->file('lote_facturas');
        Excel::import(new FacturasImport, $file);

        return redirect()->route('facturas-emitidas')->with('success', 'Las facturas se cargaron exitosamente');
    }

    // VISTAS COMUNES

    // public function factura(Factura $factura) : View
    // {
    //     if (!auth()->check()) {
    //         return view('auth.login');
    //     }
    //     return view('facturas.factura', [
    //         'factura' => $factura,
    //         'user' => Auth::user(),
    //     ]);
    // }



    public function create(){

    }

    public function store(){

    }

    public function show(Factura $factura)
    {
        if (!auth()->check()) {
            return view('auth.login');
        }

        $monto_pagos_abonados = 0;
        $pagos_abonadas = $factura->pagos()->where('status', 2)->pluck('monto_equivalente');
        foreach ($pagos_abonadas as $pago) {
            $monto_pagos_abonados = $monto_pagos_abonados + $pago;
        }

        $monto_pagos_totales = 0;
        $pagos_totales = $factura->pagos()->pluck('monto_equivalente');
        foreach ($pagos_totales as $pagoT) {
            $monto_pagos_totales = $monto_pagos_totales + $pagoT;
        }

        $monto_restante = $factura->monto_deudor - $monto_pagos_abonados;
        $progreso_pago  = round($monto_pagos_abonados*100/$factura->monto_deudor);

        return view('facturas.factura', [
            'factura'               => $factura,
            'user'                  => Auth::user(),
            'monto_pagos_abonados'  => $monto_pagos_abonados,
            'monto_pagos_totales'   => $monto_pagos_totales,
            'monto_restante'        => $monto_restante,
            'progreso_pago'         => $progreso_pago,
        ]);
    }
    public function edit(){

    }
    public function update(){

    }
    public function destroy(){

    }
}
