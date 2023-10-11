<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Pago;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    public function index(Request $request) : View
    {
        // Verifica si el usuario está autenticado.
        if (!auth()->check()) {
            // El usuario no está autenticado, redirige a la página de login.
            return view('auth.login');
        }

        $monto_pendiente_todas = 0;
        $monto_facturas_pendiente = Factura::where('aliado_id', $request->user()->aliados->id)->whereIn('status', [1, 2])->whereMonth('created_at', Carbon::now()->format('m'))->pluck('monto_deudor');
        foreach ($monto_facturas_pendiente as $monto_pago){
            $monto_pendiente_todas = floatval($monto_pendiente_todas) + floatval($monto_pago);
        }

        $monto_total_abonadas = 0;
        $facturas_abonadas = Factura::where('aliado_id', $request->user()->aliados->id)->where('status', '=', 2)->whereMonth('created_at', Carbon::now()->format('m'))->get();
        $monto_pagos_abonados = Pago::whereBelongsTo($facturas_abonadas)->where('status', '=', 2)->pluck('monto_equivalente');
        foreach ($monto_pagos_abonados as $monto_pago){
            $monto_total_abonadas = floatval($monto_total_abonadas) + floatval($monto_pago);
        }

        $monto_pagos_pendientes = $monto_pendiente_todas - $monto_total_abonadas;

        $progreso_pagos_abonados    = round($monto_total_abonadas*100/$monto_pendiente_todas);
        $progreso_pagos_pendientes  = round($monto_pagos_pendientes*100/$monto_pendiente_todas);

        $user = User::find($request->user()->id);
        return view('usuarios.index', [
            'user'=> $request->user(),
            'total_facturas_pendientes'  => Factura::where('aliado_id', $user->aliados->id)->where('status', '=', 1)->count(),
            'total_facturas_reportadas'  => Factura::where('aliado_id', $user->aliados->id)->where('status', '=', 2)->count(),
            'total_facturas_conciliadas' => Factura::where('aliado_id', $user->aliados->id)->where('status', '=', 3)->count(),
            'facturas_pendientes'        => Factura::where('aliado_id', $user->aliados->id)->orderBy('created_at', 'desc')->where('status', '=', 1)->take(4)->get(),
            'facturas_recibidas'         => Factura::where('aliado_id', $user->aliados->id)->orderBy('created_at', 'desc')->take(6)->get(),
            'monto_pendiente_todas'      => $monto_pendiente_todas,
            'monto_total_abonadas'       => $monto_total_abonadas,
            'progreso_pagos_abonados'    => $progreso_pagos_abonados,
            'monto_pagos_pendientes'     => $monto_pagos_pendientes,
            'progreso_pagos_pendientes'  => $progreso_pagos_pendientes
        ]);
    }

    public function facturasPendientes(Request $request) : View
    {
        if (!auth()->check()) {
            return view('auth.login');
        }

        $user = User::find($request->user()->id);
        return view('usuarios.facturas_pendientes', [
            'total_facturas_pendientes'  => Factura::where('aliado_id', $user->aliados->id)->where('status', '<', 3)->orderBy('created_at', 'desc')->count(),
            'facturas_pendientes'        => Factura::where('aliado_id', $user->aliados->id)->where('status', '<', 3)->orderBy('created_at', 'desc')->paginate(8),
        ]);
    }

    public function historial(Request $request) : View
    {
        if (!auth()->check()) {
            return view('auth.login');
        }

        $user = User::find($request->user()->id);
        $facturas_con_pagos = Factura::where('aliado_id', $user->aliados->id)->has('pagos')->get();
        return view('usuarios.historial', [
            'total_facturas_reportadas'  => Factura::where('aliado_id', $user->aliados->id)->where('status', '>', 1)->count(),
            'pagos_realizados'           => Pago::whereBelongsTo($facturas_con_pagos)->orderBy('fecha_pago', 'desc')->paginate(8),
        ]);
    }

}
