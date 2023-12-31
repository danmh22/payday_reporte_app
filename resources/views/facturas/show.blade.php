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
        <div class="flex flex-wrap items-start mx-auto py-4 pt-0">
            <div class="flex flex-wrap w-4/6 py-6 px-8 rounded shadow border-gray-200 bg-white">
                @if (session('success'))
                <div class="py-2 px-2 rounded border bg-green-50 text-green-600 text-xs mb-2 font-semibold tracking-wider" role="alert">
                    {{ session('success') }}
                </div>
                @endif
                <div class="w-full flex justify-between items-start mb-8">
                    <div>
                        <h2 class="text-xl font-bold text-slate-700">Factura - {{ $factura->id }}</h2>
                        <a class="transition-all text-gray-500 hover:text-emerald-600" href="{{ route('aliados.show', $factura->aliado) }}"><span class="text-xs font-bold">{{ $factura->aliado->nombre_aliado }}</span></a>
                    </div>
                    @switch($factura->status)
                        @case(1)

                        <div class="px-3 py-2 rounded bg-amber-50 border border-amber-200">
                            <span class="text-amber-700 font-bold text-sm">Pendiente</span>
                        </div>

                        @break
                        @case(2)

                        <div class="px-3 py-2 rounded bg-cyan-50 border border-cyan-200">
                            <span class="text-cyan-600 font-bold text-sm">Abonada</span>
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
                    <div class="w-2/4 mb-5 pr-2">
                        <p class="text-xs mb-1 text-slate-400">Concepto:</p>
                        <p class="text-gray-700">{{ $factura->concepto }}</p>
                    </div>
                    <div class="w-1/4 mb-5">
                        <p class="text-xs mb-1 text-slate-400">Categoria:</p>
                        <p class="text-gray-700">{{ $factura->categoria }}</p>
                    </div>
                    <div class="w-1/4 mb-5">
                        <p class="text-xs mb-1 text-slate-400">Fecha de emisión:</p>
                        <p class="text-gray-700">{{ $factura->created_at->format('d/m/Y') }}</p>
                    </div>
                    <div class="w-1/3 mb-5">
                        <p class="text-xs mb-1 text-slate-400">Monto a pagar en USD:</p>
                        <p class="text-gray-700">{{ $factura->monto_dolar }} USD</p>
                    </div>
                    <div class="w-1/3 mb-5">
                        <p class="text-xs mb-1 text-slate-400">Monto a pagar en Bs:</p>
                        <p class="text-gray-700">{{ $factura->monto_actual_bs }} Bs</p>
                    </div>
                    <div class="w-1/3 mb-5">
                        <p class="text-xs mb-1 text-slate-400">Diferencial Cambiario:</p>
                        <p class="text-gray-700">{{ $factura->dif_cambiario }} Bs</p>
                    </div>
                    {{-- <div class="w-1/3">
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
                    </div> --}}
                </div>

                @if ($factura->pagos->count() > 0)
                    
                <h3 class="text-sm mt-6 font-bold text-slate-800 mb-4">Resumen de pagos realizados:</h3>
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
                                    @case(3)
                                        <span
                                        class="inline-flex items-center gap-1 rounded-full bg-red-50 px-2 py-1 text-xs font-semibold text-red-600">
                                        <span class="h-1.5 w-1.5 rounded-full bg-red-600"></span>
                                        Error
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

                            <div class="w-1/6 px-4 py-4 gap-3 flex items-center justify-center">
                                @role('Aliado')
                                    @if ($pago->status == 3)
                                    <a href="{{ route('editar-pago', [$pago->factura, $pago]) }}" class="px-3 py-2 text-emerald-600 font-bold border-2 rounded border-emerald-600 text-sm ml-2 hover:bg-emerald-600 hover:text-white">Editar</a>
                                    @endif
                                @endrole
                                @can('conciliar-pago')
                                    @if ($pago->status == 1)
                                        <form action="{{ route('conciliar-pago') }}" method="POST">
                                            @csrf
                                            @method('patch')
                                            <input type="hidden" name="id" value="{{ $pago->id }}">
                                            <button
                                            x-data="{ tooltip: false }" 
                                            x-on:mouseover="tooltip = true" 
                                            x-on:mouseleave="tooltip = false"
                                            class="text-emerald-600 transition-all rounded relative hover:text-emerald-700 group" 
                                            type="submit">
                                            <span 
                                            x-show="tooltip"
                                            x-transition:enter="ease-out duration-300"
                                            x-transition:enter-start="opacity-0"
                                            x-transition:enter-end="opacity-100"
                                            x-transition:leave="ease-in duration-200"
                                            x-transition:leave-start="opacity-100"
                                            x-transition:leave-end="opacity-0"
                                            class="text-xs w-36 font-semibold text-cyan-600 absolute bg-cyan-100 border border-cyan-300 rounded p-2
                                            transform transition-all bottom-10 right-0"
                                            >Conciliar pago</span>
                                            <span class="material-symbols-outlined text-3xl transition-all group-hover:scale-125">
                                            check_circle
                                            </span></button>
                                        </form>
                                        <form action="{{ route('reportar-error', $pago) }}" method="POST">
                                            @csrf
                                            @method('patch')
                                            <button 
                                            x-data="{ tooltip: false }" 
                                            x-on:mouseover="tooltip = true" 
                                            x-on:mouseleave="tooltip = false"
                                            class="text-amber-600 transition-all rounded relative ml-1 hover:text-amber-700 group" 
                                            type="submit">
                                            <span 
                                            x-show="tooltip"
                                            x-transition:enter="ease-out duration-300"
                                            x-transition:enter-start="opacity-0"
                                            x-transition:enter-end="opacity-100"
                                            x-transition:leave="ease-in duration-200"
                                            x-transition:leave-start="opacity-100"
                                            x-transition:leave-end="opacity-0"
                                            class="text-xs w-40 font-semibold text-cyan-600 absolute bg-cyan-100 border border-cyan-300 rounded p-2
                                            transform transition-all bottom-10 right-0"
                                            >Notificar error en el reporte de pago</span>
                                            <span class="material-symbols-outlined text-3xl transition-all group-hover:scale-125">
                                            report
                                            </span></button>
                                        </form>
                                    @else

                                    @endif
                                @endcan

                            </div>
                        </div>

                    @endforeach
                </div>

                @else
                    
                @endif

                <div class="w-full mt-2 flex justify-end items-center">

                    @can ('reportar-pago')
                        @if ($factura->status <= 3)
                            @if ($monto_pagos_totales >= $factura->monto_dolar)

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
            <div class="sm:w-2/6 pb-4 sm:px-4 lg:px-4 w-full">
                {{-- <div class="bg-white shadow flex flex-wrap text-center mb-4 rounded overflow-hidden">
                    <div class="w-full flex justify-center items-center border-b-0 flex-col px-2 py-4">
                        <span class="text-sm block text-gray-500 font-bold mb-3">Tasa del dolar hoy:</span>
                        <p class="text-2xl text-emerald-700 font-bold">{{ $tasa_dolar_hoy->tasa_dolar }}<span class="text-xs font-bold ml-1">Bs</span></p>
                        <span class="text-xxs block text-gray-400 font-bold mt-4">Registrado el: {{ $tasa_dolar_hoy->created_at }}</span>
                    </div>
                </div> --}}

                <div class="flex justify-between items-center mb-3">
                    <h2 class="text-l font-bold mb-0 text-gray-800">Resumen:</h2>
                </div>
                <div class="bg-white shadow flex flex-wrap text-center mb-4 rounded overflow-hidden">
                    <div class="w-full flex justify-center items-center border-b-0 flex-col px-2 py-4">
                        <span class="text-sm block text-gray-500 font-bold mb-2">Monto total de la factura:</span>
                        <p class="text-2xl text-emerald-700 font-bold">{{ number_format($factura->monto_dolar) }}<span class="text-xs font-bold ml-2">USD</span></p>
                    </div>
                    <div class="w-full border-t-0 border-b-0 px-4 pt-1 pb-3">
                        <div class="flex justify-between items-center">
                            <span class="text-xs block text-gray-500 font-bold mb-2">Progreso:</span>
                            <span class="text-sm block text-gray-500 font-bold mb-2">{{ $progreso_pago }}%</span>
                        </div>
                        <div class="overflow-hidden h-1 mb-2 text-xs flex rounded bg-green-200">
                            <div style="width: {{ $progreso_pago }}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-emerald-600"></div>
                        </div>
                    </div>
                    <div class="w-1/2 flex justify-center items-center border-r border-t border-slate-100 flex-col px-2 py-4">
                        <span class="text-xs block text-gray-500 font-bold mb-2">Monto restante:</span>
                        <p class="text-2xl text-amber-600 font-bold">{{ number_format($monto_restante) }}<span class="text-xs font-bold ml-2">USD</span></p>
                    </div>
                    <div class="w-1/2 flex justify-center items-center border-t border-slate-100 flex-col px-2 py-4">
                        <span class="text-xs block text-gray-500 font-bold mb-2">Monto abonado:</span>
                        <p class="text-2xl text-emerald-700 font-bold">{{ number_format($monto_pagos_abonados) }}<span class="text-xs font-bold ml-2">USD</span></p>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection()
