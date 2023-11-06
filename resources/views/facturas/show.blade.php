@extends('layouts.template')

@section('title', 'Detalles de Factura')

@section('header_section')
    
    <a href="{{ URL::previous() }}" class="text-emerald-700 hover:text-emerald-500 transition-all text-sm font-bold mb-3 flex items-center justify-start w-52"><span class="material-symbols-outlined mr-2">
        keyboard_backspace
        </span> Regresar a las facturas</a>
    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Detalles de Factura</h1>

@endsection()

@section('content')

    <main>
        <div class="flex flex-wrap mx-auto py-4 pt-0">
            <div class="flex flex-wrap w-3/4 py-6 px-8 rounded shadow border-gray-200 bg-white">
                @if (session('success'))
                <div class="py-2 px-2 rounded border bg-green-50 text-green-600 text-xs mb-2 font-semibold tracking-wider" role="alert">
                    {{ session('success') }}
                </div>
                @endif
                <div class="w-full flex justify-between items-start mb-8">
                    <div>
                        <h2 class="text-xl font-bold text-slate-700">Factura - {{ $factura->id }}</h2>
                        <span class="text-xs font-bold text-gray-500">{{ $factura->aliado->nombre_aliado }}</span>
                    </div>
                    @switch($factura->status)
                        @case(1)

                        <div class="px-3 py-2 rounded bg-cyan-50 border border-cyan-200">
                            <span class="text-cyan-700 font-bold text-sm">Pendiente</span>
                        </div>

                        @break
                        @case(2)

                        <div class="px-3 py-2 rounded bg-amber-50 border border-amber-200">
                            <span class="text-amber-600 font-bold text-sm">Abonada</span>
                        </div>

                        @break
                        @case(3)

                        <div class="px-3 py-2 rounded bg-emerald-50 border border-emerald-200">
                            <span class="text-emerald-700 font-bold text-sm">Conciliada</span>
                        </div>

                        @break
                        @default
                            Not found
                    @endswitch

                    </div>
                <div class="w-full flex flex-wrap text-sm font-bold">
                    <div class="w-2/5 mb-5 pr-1">
                        <p class="text-xs mb-1 text-slate-400">Concepto:</p>
                        <p class="text-gray-700">{{ $factura->concepto }}</p>
                    </div>
                    <div class="w-1/5 mb-5">
                        <p class="text-xs mb-1 text-slate-400">Monto a pagar:</p>
                        <p class="text-gray-700">{{ $factura->monto_deudor }} USD</p>
                    </div>
                    <div class="w-1/5 mb-5">
                        <p class="text-xs mb-1 text-slate-400">Categoria:</p>
                        <p class="text-gray-700">{{ $factura->categoria }}</p>
                    </div>
                    <div class="w-1/5 mb-5">
                        <p class="text-xs mb-1 text-slate-400">Fecha de emisión:</p>
                        <p class="text-gray-700">{{ $factura->created_at->format('d/m/Y') }}</p>
                    </div>
                    <div class="w-1/3">
                        <p class="text-xs mb-1 text-slate-400">Monto conciliado:</p>
                        <p class="text-gray-700">{{ $monto_pagos_abonados }} USD</p>
                    </div>
                    <div class="w-1/3">
                        <p class="text-xs mb-1 text-slate-400">Monto restante:</p>
                        <p class="text-gray-700">{{ $monto_restante }} USD</p>
                    </div>
                    <div class="w-1/3 pr-4">
                        <p class="text-xs mb-4 text-slate-400">Progreso:</p>
                        <div class="overflow-hidden h-1 text-xs flex rounded bg-emerald-200">
                            <div style="width: {{ $progreso_pago }}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-emerald-600"></div>
                        </div>
                    </div>
                </div>

                <h3 class="text-sm mt-8 font-bold text-slate-800 mb-4">Resumen de pagos realizados:</h3>
                <div class="w-full mb-4 border-gray-100 bg-slate-100 p-4 max-h-96 overflow-scroll">
                    @foreach ($factura->pagos as $pago)
                        <div class="w-full flex flex-wrap items-center text-sm shadow border-gray-100 bg-white rounded mb-1">
                            <div class="w-3/6 px-4 py-4">
                                @switch( $pago->status )
                                    @case(1)
                                        <span
                                        class="inline-flex items-center gap-1 rounded-full bg-amber-50 px-2 py-1 text-xs font-semibold text-amber-600">
                                        <span class="h-1.5 w-1.5 rounded-full bg-amber-600"></span>
                                        Por conciliar
                                        </span>
                                        @break
                                    @case(2)
                                        <span
                                        class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2 py-1 text-xs font-semibold text-emerald-600">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-600"></span>
                                        Conciliado
                                        </span>

                                        @break
                                    @default
                                        Not found
                                @endswitch
                                <p class="text-gray-700 font-bold my-2 flex justify-start items-center">{{ Str::ucfirst($pago->metodo_pago) }} <span class="material-symbols-outlined mx-2">trending_flat</span> {{ Str::ucfirst($pago->plataforma_pago) }}</p>
                                <p class="text-gray-400 font-bold text-xs">Ref: {{ $pago->referencia_pago }}</p>
                            </div>
                            <div class="w-1/6 px-4 py-4 gap-3">
                                <p class="font-bold flex justify-center items-center text-emerald-600 pr-4 text-lg">{{ $pago->monto_equivalente }} <span class="text-emerald-700 text-xxs ml-2">USD</span></p>
                            </div>
                            <div class="w-1/6 px-4 py-4 gap-3">
                                <p class="text-gray-400 font-bold text-xs mb-2">Reportado el:</p>
                                <p class="text-gray-700 font-bold">{{ $pago->fecha_pago->format('d/m/Y') }}</p>
                            </div>

                            <div class="w-1/6 px-4 py-4 gap-3">
                                @can('conciliar-pago')
                                    @if ($pago->status == 1)
                                        <form action="{{ route('conciliar-pago') }}" method="POST">
                                            @csrf
                                            @method('patch')
                                            <input type="hidden" name="id" value="{{ $pago->id }}">
                                            <button class="bg-emerald-600 px-4 transition-all py-2 text-sm rounded text-white hover:bg-emerald-700" type="submit">Conciliar</button>
                                        </form>
                                    @else

                                    @endif
                                @endcan

                            </div>
                        </div>

                    @endforeach
                    </div>

                    <div class="w-full mt-2 flex justify-end items-center">

                        @can ('reportar-pago')
                            @if ($factura->status <= 3)
                                @if ($monto_pagos_totales >= $factura->monto_deudor)

                                @else
                                <a href="{{ route('reportar-pago', $factura) }}" class="bg-emerald-700 px-6 py-2 text-sm rounded text-white hover:bg-emerald-600" type="submit">Reportar Pago</a>
                                @endif
                            @else

                            @endif
                        @endcan

                        {{-- <form action="" method="post">
                            @csrf
                            <button class="bg-red-600 px-6 py-2 text-sm rounded text-white ml-4 hover:bg-red-700" type="submit">Reportar Error</button>
                        </form> --}}
                    </div>
            </div>
        </div>
    </main>

@endsection()
