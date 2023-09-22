<?php

namespace App\Http\Controllers;

use App\Imports\FacturasImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Factura;
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
        return view('facturas.index', [
            'user'=> $request->user(),
            'total_facturas_pendientes'  => Factura::where('users_id', $request->user()->id)->where('status', '=', 1)->count(),
            'total_facturas_reportadas'  => Factura::where('users_id', $request->user()->id)->where('status', '=', 2)->count(),
            'total_facturas_conciliadas' => Factura::where('users_id', $request->user()->id)->where('status', '=', 3)->count(),
            'facturas_pendientes'        => Factura::where('users_id', $request->user()->id)->where('status', '=', 1)->get(),
            'facturas_reportadas'        => Factura::where('users_id', $request->user()->id)->where('status', '>', 1)->get(),
        ]);
    }

    public function facturasPendientes(Request $request) : View
    {
        return view('facturas.facturas_pendientes', [
            'facturas_pendientes'        => Factura::where('users_id', $request->user()->id)->where('status', '=', 1)->get()
        ]);
    }

    public function historial(Request $request) : View
    {
        return view('facturas.historial', [
            'facturas_reportadas'        => Factura::where('users_id', $request->user()->id)->where('status', '>', 1)->get(),
        ]);
    }

    public function showReportarPago(Factura $factura) : View
    {
        return view('facturas.form_reportar', [
            'factura' => $factura,
        ]);
    }
    public function updateReportarPago(Request $request, Factura $factura){

        $request->validate([
            'nombre_titular'    => 'required',
            'tipo_documento'    => 'required',
            'num_documento'     => 'required',
            'referencia_pago'   => 'required|unique:facturas,referencia_pago',
            'divisa'            => 'required',
            'metodo_pago'       => 'required',
            'plataforma_pago'   => 'required',
            'monto_pago'        => 'required',
            'fecha_pago'        => 'required',
        ]);

        $factura->nombre_titular  = $request->nombre_titular;
        $factura->tipo_documento  = $request->tipo_documento;
        $factura->num_documento   = $request->num_documento;
        $factura->referencia_pago = $request->referencia_pago;
        $factura->divisa          = $request->divisa;
        $factura->metodo_pago     = $request->metodo_pago;
        $factura->plataforma_pago = $request->plataforma_pago;
        $factura->monto_pago      = $request->monto_pago;
        $factura->fecha_pago      = $request->fecha_pago;
        $factura->status          = '2';

        $factura->save();

        return redirect()->route('facturas-pendientes');

    }

    // VISTAS DE ADMINISTRADOR

    public function indexAdmin(Request $request) : View
    {
        // Verifica si el usuario está autenticado.
        if (!auth()->check()) {
            // El usuario no está autenticado, redirige a la página de login.
            return view('auth.login');
        }
        return view('facturas.admin_index', [
            'user'=> $request->user(),
            'total_facturas_emitidas'      => Factura::where('status', '=', 1)->count(),
            'total_facturas_por_conciliar' => Factura::where('status', '=', 2)->count(),
            'total_facturas_conciliadas'   => Factura::where('status', '=', 3)->count(),
            'lista_facturas_por_conciliar' => Factura::where('status', '=', 2)->orderBy('updated_at', 'desc')->get(),
        ]);
    }

    public function facturasEmitidas() : View
    {
        return view('facturas.admin_facturas_emitidas', [
            'lista_facturas_emitidas'      => Factura::where('status', '=', 1)->orderBy('updated_at', 'desc')->get()
        ]);
    }

    public function facturasConciliadas() : View
    {
        return view('facturas.admin_facturas_conciliadas', [
            'lista_facturas_conciliadas'      => Factura::where('status', '=', 3)->orderBy('updated_at', 'desc')->get()
        ]);
    }

    public function facturasPorConciliar() : View
    {
        return view('facturas.admin_facturas_conciliar', [
            'lista_facturas_por_conciliar' => Factura::where('status', '=', 2)->orderBy('updated_at', 'desc')->get()
        ]);
    }

    public function conciliarPago(Request $request){

        $findFactura = Factura::findOrFail($request->id);
        $findFactura->status = '3';
        $findFactura->save();

        return redirect()->route('facturas-conciliadas');
    }

    public function cargarFacturas() : View
    {
        return view('facturas.admin_form_cargar_facturas');
    }

    public function importarFacturas(Request $request)
    {
        $file = $request->file('lote_facturas');
        Excel::import(new FacturasImport, $file);

        return redirect()->route('dashboard-admin')->with('¡Todo Listo!', 'Las facturas se cargaron exitosamente');
    }

    // VISTAS COMUNES

    public function factura(Factura $factura) : View
    {
        return view('facturas.factura', [
            'factura' => $factura,
            'user' => Auth::user(),
        ]);
    }



    public function create(){

    }

    public function store(){

    }

    public function show()
    {

    }
    public function edit(){

    }
    public function update(){

    }
    public function destroy(){

    }
}
