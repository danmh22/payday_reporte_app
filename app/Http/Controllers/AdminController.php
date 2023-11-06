<?php

namespace App\Http\Controllers;

use App\Imports\FacturasImport;
use App\Models\Aliado;
use App\Models\Factura;
use App\Models\Pago;
use App\Models\Tasa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    // VISTAS DE ADMINISTRADOR

    public function index(Request $request) : View
    {

        // Verifica si el usuario está autenticado.
        if (!auth()->check()) {
            // El usuario no está autenticado, redirige a la página de login.
            return view('auth.login');
        }

        $tasa_dolar_hoy = Tasa::latest('id')->first();

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

        $monto_pendiente_abonadas  = 0;
        $monto_pagos_abonados      = 0;
        $monto_pendiente_final     = 0;
        $progreso_pagos_abonados   = 0;
        $progreso_pagos_pendientes = 0;
        
        $facturas_abonadas = Factura::where('status', '=', 2)->get();
        
        if ($facturas_abonadas->isEmpty()) {

        } else {
            $monto_pagos_abonados = Pago::whereBelongsTo($facturas_abonadas)->where('status', '=', 2)->whereMonth('created_at', Carbon::now()->format('m'))->pluck('monto_equivalente');
            foreach ($monto_pagos_abonados as $monto_pago){
                $monto_pendiente_abonadas = floatval($monto_pendiente_abonadas) + floatval($monto_pago);
            }

            $monto_pendiente_final = $monto_pendiente_todas - $monto_pendiente_abonadas;

            $progreso_pagos_abonados    = round($monto_pendiente_abonadas*100/$monto_pendiente_todas);
            $progreso_pagos_pendientes  = round($monto_pendiente_final*100/$monto_pendiente_todas);
        }
        
        return view('admin.index', [
            'user'=> $request->user(),
            'total_facturas_emitidas'    => Factura::where('status', '=', 1)->count(),
            'total_facturas_reportadas'  => Factura::where('status', '=', 2)->count(),
            'total_facturas_conciliadas' => Factura::where('status', '=', 3)->count(),
            'total_pagos'                => Pago::count(),
            'total_pagos_por_conciliar'  => Pago::where('status', '=', 1)->count(),
            'total_pagos_conciliados'    => Pago::where('status', '=', 2)->count(),
            'lista_pagos_por_conciliar'  => Pago::where('status', '=', 1)->orderBy('fecha_pago', 'desc')->paginate(7),
            'monto_pendiente_todas'      => $monto_pendiente_todas,
            'monto_pendiente_abonadas'   => $monto_pendiente_abonadas,
            'monto_conciliados_final'    => $monto_conciliados_final,
            'progreso_pagos_abonados'    => $progreso_pagos_abonados,
            'monto_pendiente_final'      => $monto_pendiente_final,
            'progreso_pagos_pendientes'  => $progreso_pagos_pendientes,
            'tasa_dolar_hoy'             => $tasa_dolar_hoy,
        ]);
    }

    public function facturasEmitidas() : View
    {
        if (!auth()->check()) {
            return view('auth.login');
        }
        return view('admin.facturas_emitidas', [
            'total_facturas_emitidas'  => Factura::where('status', '<', 3)->count(),
            'lista_facturas_emitidas'  => Factura::where('status', '<', 3)->orderBy('created_at', 'desc')->paginate(8),
        ]);
    }

    
    public function facturasConciliadas() : View
    {
        if (!auth()->check()) {
            return view('auth.login');
        }
        return view('admin.facturas_conciliadas', [
            'total_facturas_conciliadas'  => Factura::where('status', '=', 3)->count(),
            'lista_facturas_conciliadas'  => Factura::where('status', '=', 3)->orderBy('created_at', 'desc')->paginate(8),
        ]);
    }

    public function pagosConciliados() : View
    {
        if (!auth()->check()) {
            return view('auth.login');
        }
        return view('admin.pagos_conciliados', [
            'total_pagos_conciliados'  => Pago::where('status', '=', 2)->count(),
            'lista_pagos_conciliados'  => Pago::where('status', '=', 2)->orderBy('fecha_pago', 'desc')->paginate(8)
        ]);
    }

    public function pagosPorConciliar() : View
    {
        if (!auth()->check()) {
            return view('auth.login');
        }
        return view('admin.pagos_conciliar', [
            'total_pagos_por_conciliar'  => Pago::where('status', '=', 1)->count(),
            'lista_pagos_por_conciliar'  => Pago::where('status', '=', 1)->orderBy('fecha_pago', 'desc')->paginate(8)
        ]);
    }

    public function cargarFacturas() : View
    {
        if (!auth()->check()) {
            return view('auth.login');
        }

        return view('admin.form_cargar_facturas', [
            'aliados' => Aliado::where('id', '>', 1)->get(),
        ]);
    }

    public function importarFacturas(Request $request)
    {
        $request->validate([
            'lote_facturas'  => 'required|file',
        ]);
        
        $file = $request->file('lote_facturas');
        Excel::import(new FacturasImport, $file);

        return redirect()->route('facturas-emitidas')->with('success', 'Las facturas se cargaron exitosamente');
    }

}
