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
                        <h2 class="text-xl font-bold text-slate-700">Factura - {{ $factura->id }}</h2>
                        <span class="text-xs font-bold text-gray-500">Nombre aliado comercial</span>
                    </div>
                    @switch($factura->status)
                        @case(1)

                        <div class="px-3 py-2 rounded bg-blue-50 border border-blue-200">
                            <span class="text-blue-700 font-bold text-sm">Pendiente</span>
                        </div>

                        @break
                        @case(2)

                        <div class="px-3 py-2 rounded bg-orange-50 border border-orange-200">
                            <span class="text-orange-700 font-bold text-sm">Por Conciliar</span>
                        </div>

                        @break
                        @case(3)

                        <div class="px-3 py-2 rounded bg-green-50 border border-green-200">
                            <span class="text-green-700 font-bold text-sm">Conciliado</span>
                        </div>

                        @break
                        @default
                            Not found
                    @endswitch

                    </div>
                <div class="w-full flex text-sm">
                    <div class="w-1/3 mr-1">
                        <p class="font-bold text-xs mb-1 text-slate-800">Concepto:</p>
                        <p class="text-gray-700">{{ $factura->concepto }}</p>
                    </div>
                    <div class="w-1/3 mr-1">
                        <p class="font-bold text-xs mb-1 text-slate-800">Monto a pagar:</p>
                        <p class="text-gray-700">{{ $factura->monto_deudor }} USD</p>
                    </div>
                    <div class="w-1/3 mr-1">
                        <p class="font-bold text-xs mb-1 text-slate-800">Fecha de emisión:</p>
                        <p class="text-gray-700">{{ $factura->created_at->format('d/m/Y') }}</p>
                    </div>
                </div>

                @if ($factura->status > 1)
                    <hr class="border-b border-gray-100 my-8 w-full">
                    <h3 class="text-sm font-bold text-slate-800 mb-6">Datos del reporte de pago</h3>
                    <div class="w-full flex flex-wrap text-sm">
                        <div class="w-1/3 mb-6">
                            <p class="font-bold text-xs mb-1 text-slate-800">Fecha de reporte:</p>
                            <p class="text-gray-700">{{ $factura->updated_at->format('d/m/Y') }}</p>
                        </div>
                        <div class="w-1/3 mb-6">
                            <p class="font-bold text-xs mb-1 text-slate-800">Nombre del títular:</p>
                            <p class="text-gray-700">{{ $factura->nombre_titular }}</p>
                        </div>
                        <div class="w-1/3 mb-6">
                            <p class="font-bold text-xs mb-1 text-slate-800">Documento de identidad:</p>
                            <p class="text-gray-700">{{ $factura->tipo_documento }}-{{ $factura->num_documento }}</p>
                        </div>
                        <div class="w-1/3 mb-6">
                            <p class="font-bold text-xs mb-1 text-slate-800">Método de pago:</p>
                            <p class="text-gray-700">{{ $factura->metodo_pago }}</p>
                        </div>
                        <div class="w-1/3 mb-6">
                            <p class="font-bold text-xs mb-1 text-slate-800">Plataforma de pago:</p>
                            <p class="text-gray-700">{{ $factura->plataforma_pago }}</p>
                        </div>
                        <div class="w-1/3 mb-6">
                            <p class="font-bold text-xs mb-1 text-slate-800">Monto:</p>
                            <p class="text-gray-700">{{ $factura->monto_pago }} {{ $factura->divisa }}</p>
                        </div>
                        <div class="w-1/3 mb-6">
                            <p class="font-bold text-xs mb-1 text-slate-800">Fecha del pago:</p>
                            <p class="text-gray-700">{{ $factura->fecha_pago->format('d/m/Y') }}</p>
                        </div>
                        <div class="w-1/3 mb-6">
                            <p class="font-bold text-xs mb-1 text-slate-800">Referencia:</p>
                            <p class="text-gray-700">{{ $factura->referencia_pago }}</p>
                        </div>
                    </div>

                    @else

                    @endif

                    <hr class="border-b border-gray-100 my-8 mb-4 w-full">
                    <div class="w-full mt-2 flex justify-end items-center">
                        @if ($factura->status > 1)
                            <form action="" method="post">
                                @csrf
                                <button class="bg-blue-600 px-6 py-2 text-sm rounded text-white hover:bg-blue-700" type="submit">Conciliar Pago</button>
                            </form>
                        @else

                            <a href="{{ route('reportar-pago', $factura) }}" class="bg-blue-600 px-6 py-2 text-sm rounded text-white hover:bg-blue-700" type="submit">Reportar Pago</a>
                        @endif

                        <form action="" method="post">
                            @csrf
                            <button class="bg-red-600 px-6 py-2 text-sm rounded text-white ml-4 hover:bg-red-700" type="submit">Reportar Error</button>
                        </form>
                    </div>
            </div>
        </div>
    </main>

@endsection()
