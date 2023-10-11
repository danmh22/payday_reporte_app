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

    public function index(Request $request)
    {

    }

    public function create(){

    }

    public function store(){

    }

    public function show(Factura $factura)
    {
        if (!auth()->check()) {
            return view('auth.login');
        }

        $this->authorize('invoiceOwner', $factura);

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
