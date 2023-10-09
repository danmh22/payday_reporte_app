<?php

namespace App\Http\Controllers;

use App\Models\Aliado;
use App\Models\Factura;
use App\Models\User;
use Illuminate\Http\Request;

class AliadosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('aliados.index', [
            'aliados' => Aliado::latest()->paginate(7)
        ]);
    }

    /**
     * Función para cambiar status del aliado
     */
    public function cambiarStatus(Request $request)
    {

        $findAliado = Aliado::findOrFail($request->id);
        $findAliado->status = $request->status;
        $findAliado->save();

        return redirect()->route('aliados');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Aliado $aliado)
    {
        if (!auth()->check()) {
            return view('auth.login');
        }

        // $monto_pagos_abonados = 0;
        // $pagos_abonadas = $aliado->pagos()->where('status', 2)->pluck('monto_equivalente');
        // foreach ($pagos_abonadas as $pago) {
        //     $monto_pagos_abonados = $monto_pagos_abonados + $pago;
        // }

        // $monto_pagos_totales = 0;
        // $pagos_totales = $aliado->pagos()->pluck('monto_equivalente');
        // foreach ($pagos_totales as $pagoT) {
        //     $monto_pagos_totales = $monto_pagos_totales + $pagoT;
        // }

        // $monto_restante = $aliado->monto_deudor - $monto_pagos_abonados;
        // $progreso_pago  = round($monto_pagos_abonados*100/$aliado->monto_deudor);

        return view('aliados.show', [
            'aliado'                => $aliado,
            'facturas'              => Factura::whereBelongsTo($aliado)->orderBy('created_at', 'desc')->paginate(6),
            // 'monto_pagos_abonados'  => $monto_pagos_abonados,
            // 'monto_pagos_totales'   => $monto_pagos_totales,
            // 'monto_restante'        => $monto_restante,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Aliado $aliado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aliado $aliado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aliado $aliado)
    {
        //
    }
}
