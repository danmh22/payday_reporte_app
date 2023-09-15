<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    public function vistaUsuarios() : View
    {
        return view('usuarios.index', [
            'users' => User::where('role', '=', 0)->latest()->paginate()
        ]);
    }

    public function cambiarStatus(Request $request)
    {

        $findUsuario = User::findOrFail($request->id);
        $findUsuario->status = $request->status;

        // if ($findUsuario->status = 0) {
        //     $findUsuario->status = $request->status;
        // } else {
        //     $findUsuario->status = $request->status;
        // }


        $findUsuario->save();

        return redirect()->route('usuarios');

    }

}
