<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Pago;
use App\Models\User;
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

        return view('facturas.show', [
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
