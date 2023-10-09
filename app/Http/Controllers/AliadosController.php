<?php

namespace App\Http\Controllers;

use App\Models\Aliado;
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
        //
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
