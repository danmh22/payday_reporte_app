@extends('layouts.template')

@section('title', 'Detalles de Factura')

@section('header_section')

    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Detalles de Factura</h1>

@endsection()

@section('content')

    <main>
        <div class="flex flex-wrap mx-auto py-4 pt-0">
            <div class="flex flex-wrap w-3/4 py-6 px-8 rounded border border-gray-200 bg-white">
                <div class="w-full flex justify-between items-start mb-8">
                    <div>
                        <h2 class="text-xl font-bold text-slate-700">Factura - 122</h2>
                        <span class="text-xs font-bold text-gray-500">Nombre aliado comercial</span>
                    </div>
                    <div class="px-3 py-2 rounded bg-green-50 border border-green-200">
                        <span class="text-green-700 font-bold text-sm">Conciliado</span>
                    </div>
                </div>
                <div class="w-full flex text-sm">
                    <div class="w-1/3 mr-1">
                        <p class="font-bold text-xs mb-1 text-slate-800">Concepto:</p>
                        <p class="text-gray-700">Mensualidad Mes de Julio</p>
                    </div>
                    <div class="w-1/3 mr-1">
                        <p class="font-bold text-xs mb-1 text-slate-800">Monto a pagar:</p>
                        <p class="text-gray-700">300,00 USD</p>
                    </div>
                    <div class="w-1/3 mr-1">
                        <p class="font-bold text-xs mb-1 text-slate-800">Fecha de emisión:</p>
                        <p class="text-gray-700">20/07/2023</p>
                    </div>
                </div>
                <hr class="border-b border-gray-100 my-8 w-full">
                <h3 class="text-sm font-bold text-slate-800 mb-6">Datos del reporte de pago</h3>
                <div class="w-full flex flex-wrap text-sm">
                    <div class="w-1/3 mb-6">
                        <p class="font-bold text-xs mb-1 text-slate-800">Fecha de reporte:</p>
                        <p class="text-gray-700">18/08/2023</p>
                    </div>
                    <div class="w-1/3 mb-6">
                        <p class="font-bold text-xs mb-1 text-slate-800">Nombre del títular:</p>
                        <p class="text-gray-700">Pedro Perez</p>
                    </div>
                    <div class="w-1/3 mb-6">
                        <p class="font-bold text-xs mb-1 text-slate-800">Documento de identidad:</p>
                        <p class="text-gray-700">V-15.225.552</p>
                    </div>
                    <div class="w-1/3 mb-6">
                        <p class="font-bold text-xs mb-1 text-slate-800">Método de pago:</p>
                        <p class="text-gray-700">Transferencia</p>
                    </div>
                    <div class="w-1/3 mb-6">
                        <p class="font-bold text-xs mb-1 text-slate-800">Plataforma de pago:</p>
                        <p class="text-gray-700">Banca Amiga</p>
                    </div>
                    <div class="w-1/3 mb-6">
                        <p class="font-bold text-xs mb-1 text-slate-800">Monto:</p>
                        <p class="text-gray-700">300,00 USD</p>
                    </div>
                    <div class="w-1/3 mb-6">
                        <p class="font-bold text-xs mb-1 text-slate-800">Fecha del pago:</p>
                        <p class="text-gray-700">17/08/2023</p>
                    </div>
                    <div class="w-1/3 mb-6">
                        <p class="font-bold text-xs mb-1 text-slate-800">Referencia:</p>
                        <p class="text-gray-700">10102525396</p>
                    </div>
                    <hr class="border-b border-gray-100 my-8 mb-4 w-full">
                    <div class="w-full mt-2 flex justify-end items-center">
                        <form action="" method="post">
                            @csrf
                            <button class="bg-blue-600 px-6 py-2 text-sm rounded text-white hover:bg-blue-700" type="submit">Conciliar Pago</button>
                        </form>
                        <form action="" method="post">
                            @csrf
                            <button class="bg-red-600 px-6 py-2 text-sm rounded text-white ml-4 hover:bg-red-700" type="submit">Reportar Error</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection()
