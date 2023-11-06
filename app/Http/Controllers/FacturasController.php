<?php

namespace App\Http\Controllers;

use App\Models\Aliado;
use App\Models\Factura;
use App\Models\Pago;
use App\Models\Tasa;
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

    public function store(Request $request){

        $request->validate([
            'concepto'      => 'required',
            'monto_dolar'  => 'required',
            'categoria'     => 'required|in:Mensualidad,Gastos Generales,Otros',
            'aliado'        => 'required|different:null',
        ]);

        $findAliado = Aliado::where('codigo_aliado', '=', $request->aliado)->get();

        if ($findAliado->isEmpty()) {
            return back()->with('status', 'El aliado comercial está inactivo o no existe');
        } else {

            $factura = new Factura;

            $factura->concepto      = $request->concepto;
            $factura->monto_dolar  = $request->monto_dolar;
            $factura->categoria     = $request->categoria;
            $factura->aliado_id     = $findAliado[0]->id;
            $factura->status        = '1';

            $factura->save();
            
            return redirect()->route('factura', [$factura])->with('success', 'La factura fue creada exitosamente');
        }
        
    }

    public function show(Factura $factura)
    {
        if (!auth()->check()) {
            return view('auth.login');
        }

        $this->authorize('invoiceOwner', $factura);
        
        $tasa_dolar_hoy = Tasa::latest('id')->first();

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

        $monto_restante = $factura->monto_dolar - $monto_pagos_abonados;
        $progreso_pago  = round($monto_pagos_abonados*100/$factura->monto_dolar);

        return view('facturas.show', [
            'factura'               => $factura,
            'user'                  => Auth::user(),
            'monto_pagos_abonados'  => $monto_pagos_abonados,
            'monto_pagos_totales'   => $monto_pagos_totales,
            'monto_restante'        => $monto_restante,
            'progreso_pago'         => $progreso_pago,
            'tasa_dolar_hoy'        => $tasa_dolar_hoy,
        ]);
    }
    public function edit(){

    }
    public function update(){

    }
    public function destroy(){

    }
}
