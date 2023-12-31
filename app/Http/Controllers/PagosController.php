<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Pago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PagosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Factura $factura) : View
    {
        if (!auth()->check()) {
            return view('auth.login');
        }

        $monto_pagos_abonados = 0;
        $pagos_abonadas = $factura->pagos()->where('status', '=', 2)->pluck('monto_equivalente');
        foreach ($pagos_abonadas as $pago) {
            $monto_pagos_abonados = $monto_pagos_abonados + $pago;
        }

        $monto_restante = $factura->monto_dolar - $monto_pagos_abonados;
        $progreso_pagos_abonados  = round($monto_pagos_abonados*100/$factura->monto_dolar);

        return view('pagos.create', [
            'factura'                 => $factura,
            'monto_restante'          => $monto_restante,
            'monto_pagos_abonados'    => $monto_pagos_abonados,
            'progreso_pagos_abonados' => $progreso_pagos_abonados,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Factura $factura){

        $request->validate([
            'nombre_titular'    => 'required',
            'tipo_documento'    => 'required|in:V,J,P',
            'num_documento'     => 'required|max:9',
            'referencia_pago'   => 'required|unique:pagos,referencia_pago',
            'divisa'            => 'required|in:USD,VES',
            'metodo_pago'       => 'required|in:Pago Móvil,Efectivo,Transferencia,Depósito',
            'plataforma_pago'   => 'required',
            'monto_pago'        => 'required',
            'fecha_pago'        => 'required',
        ]);

        //Se obtiene la suma de los pagos abonados a la factura
        $monto_pagos_abonados = 0;
        $pagos_abonadas = $factura->pagos()->pluck('monto_equivalente');
        foreach ($pagos_abonadas as $pago) {
            $monto_pagos_abonados = $monto_pagos_abonados + $pago;
        }

        //Se resta el monto abonado al monto de la factura para obtener el restante por pagar
        $monto_restante = $factura->monto_dolar - $monto_pagos_abonados;

        if ($request->monto_pago > $monto_restante) {
            return back()->with('status', 'El monto ingresado es mayor al monto deudor actual');
        } else {

            $pago = new Pago;

            $pago->nombre_titular     = $request->nombre_titular;
            $pago->tipo_documento     = $request->tipo_documento;
            $pago->num_documento      = $request->num_documento;
            $pago->referencia_pago    = $request->referencia_pago;
            $pago->divisa             = $request->divisa;
            $pago->metodo_pago        = $request->metodo_pago;
            $pago->plataforma_pago    = $request->plataforma_pago;
            $pago->monto_pago         = $request->monto_pago;
            $pago->fecha_pago         = $request->fecha_pago;
            $pago->monto_equivalente  = $request->monto_pago;
            $pago->factura_id         = $factura->id;
            $pago->status             = '1';

            $pago->save();

            return redirect()->route('reportar-pago', [$factura])->with('success', 'Su pago fue reportado exitosamente');

        }


    }

    /**
     * Display the specified resource.
     */
    public function show(Pago $pago)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Factura $factura, Pago $pago)
    {
        if (!auth()->check()) {
            return view('auth.login');
        }

        $monto_pagos_abonados = 0;
        $pagos_abonadas = $factura->pagos()->where('status', '=', 2)->pluck('monto_equivalente');
        foreach ($pagos_abonadas as $pagoN) {
            $monto_pagos_abonados = $monto_pagos_abonados + $pagoN;
        }

        $monto_restante = $factura->monto_dolar - $monto_pagos_abonados;
        $progreso_pagos_abonados  = round($monto_pagos_abonados*100/$factura->monto_dolar);
        return view('pagos.edit', [
            'pago'                    => $pago,
            'factura'                 => $factura,
            'monto_restante'          => $monto_restante,
            'monto_pagos_abonados'    => $monto_pagos_abonados,
            'progreso_pagos_abonados' => $progreso_pagos_abonados,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pago $pago)
    {
        $request->validate([
            'nombre_titular'    => 'required',
            'tipo_documento'    => 'required|in:V,J,P',
            'num_documento'     => 'required|max:9',
            'referencia_pago'   => 'required',
            'divisa'            => 'required|in:USD,VES',
            'metodo_pago'       => 'required|in:Pago Móvil,Efectivo,Transferencia,Depósito',
            'plataforma_pago'   => 'required',
            'monto_pago'        => 'required',
            'fecha_pago'        => 'required',
        ]);

        $factura = $pago->factura;

        $monto_pagos_abonados = 0;
        $pagos_abonadas = $factura->pagos()->pluck('monto_equivalente');
        foreach ($pagos_abonadas as $pagoU) {
            $monto_pagos_abonados = $monto_pagos_abonados + $pagoU;
        }

        $monto_restante = $factura->monto_dolar - $monto_pagos_abonados + $pago->monto_pago;

        if ($request->monto_pago > $monto_restante) {
            return back()->with('status', 'El monto ingresado es mayor al monto deudor actual');
        } else {

            $pago->nombre_titular     = $request->nombre_titular;
            $pago->tipo_documento     = $request->tipo_documento;
            $pago->num_documento      = $request->num_documento;
            $pago->referencia_pago    = $request->referencia_pago;
            $pago->divisa             = $request->divisa;
            $pago->metodo_pago        = $request->metodo_pago;
            $pago->plataforma_pago    = $request->plataforma_pago;
            $pago->monto_pago         = $request->monto_pago;
            $pago->fecha_pago         = $request->fecha_pago;
            $pago->monto_equivalente  = $request->monto_pago;
            $pago->status             = '1';

            $pago->save();

            return redirect()->route('reportar-pago', [$factura])->with('success', 'Su pago fue reportado exitosamente');

        }
    }

    public function report(Pago $pago){

        $findPago = Pago::findOrFail($pago->id);
        $findPago->status = '3';
        $findPago->save();

        return redirect()->route('factura', [$pago->factura->id])->with('success', 'Se notificó el error exitosamente');

    }

    /**
     * Update the specified resource in storage.
     */
    public function conciliarPago(Request $request){

        $pago = Pago::findOrFail($request->id);
        $pago->status = '2';
        $pago->save();

        $factura = $pago->factura;

        $monto_pagos_abonados = 0;
        $pagos_abonadas = $factura->pagos->pluck('monto_equivalente');
        foreach ($pagos_abonadas as $pagoA) {
            $monto_pagos_abonados = $monto_pagos_abonados + $pagoA;
        }
        $monto_restante = $factura->monto_dolar - $monto_pagos_abonados + $pago->monto_equivalente;

        if ($pago->monto_equivalente < $monto_restante) {

            // $respuesta = [
            //     'status'                => 'El monto restante es mayor',
            //     'monto_equivalente'     => $pago->monto_equivalente,
            //     'monto_restante'        => $monto_restante,
            //     'monto_dolar'          => $factura->monto_dolar,
            //     'monto_pagos_abonados'  => $monto_pagos_abonados
            // ];

            // return $respuesta;
            $factura->status = '2';
            $factura->save();
        } else if ($pago->monto_equivalente >= $monto_restante) {
            // $respuesta = [
            //     'status'                => 'El monto restante es menor o igual',
            //     'monto_equivalente'     => $pago->monto_equivalente,
            //     'monto_restante'        => $monto_restante,
            //     'monto_dolar'          => $factura->monto_dolar,
            //     'monto_pagos_abonados'  => $monto_pagos_abonados
            // ];

            // return $respuesta;
            $factura->status = '3';
            $factura->save();
        } else {

        }

        return redirect()->route('factura', [$pago->factura->id])->with('success', 'El pago fue conciliado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pago $pago)
    {
        //
    }
}
