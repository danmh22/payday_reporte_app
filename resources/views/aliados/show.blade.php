@extends('layouts.template')

@section('title', 'Resumen del Aliado Comercial')

@section('header_section')

    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Resumen del Aliado Comercial</h1>

@endsection()

@section('content')

    <main>
        <div class="flex flex-wrap mx-auto py-4 pt-0">
            <div class="flex flex-wrap w-3/4 py-6 px-8 rounded border border-gray-200 bg-white">
                <div class="w-full flex justify-between items-start mb-8">
                    <div class="flex items-center">
                        <div class="rounded-full text-lg border border-blue-50 bg-blue-50 text-blue-500 font-bold mr-3 h-12 w-12 inline-flex justify-center items-center">
                            @php
                                $pickName = $aliado->nombre_aliado;
                                echo substr($pickName, 0, 1);
                            @endphp
                        </div>
                        <div class="ml-2">
                            <h2 class="text-xl font-bold text-slate-700">{{ $aliado->nombre_aliado }}</h2>
                            <span class="text-xs font-bold text-gray-500">{{ $aliado->user->name }}</span>
                        </div>
                    </div>
                    @switch($aliado->status)
                        @case(0)

                        <div class="px-3 py-2 rounded bg-red-50 border border-red-200">
                            <span class="text-red-700 font-bold text-sm">Inactivo</span>
                        </div>

                        @break
                        @case(1)

                        <div class="px-3 py-2 rounded bg-green-50 border border-green-200">
                            <span class="text-green-500 font-bold text-sm">Activo</span>
                        </div>

                        @break
                        @default
                            Error
                    @endswitch

                    </div>
                <div class="w-full flex flex-wrap text-sm font-bold">
                    <div class="w-1/4 mb-5 pr-1">
                        <p class="text-xs mb-1 text-slate-400">Usuario asociado:</p>
                        <p class="text-gray-700">{{ $aliado->user->name }}</p>
                    </div>
                    <div class="w-1/4 mb-5">
                        <p class="text-xs mb-1 text-slate-400">Código del aliado:</p>
                        <p class="text-gray-700">{{ $aliado->codigo_aliado }}</p>
                    </div>
                    <div class="w-1/4 mb-5">
                        <p class="text-xs mb-1 text-slate-400">Fecha de creado:</p>
                        <p class="text-gray-700">{{ $aliado->created_at->format('d/m/Y') }}</p>
                    </div>
                    <div class="w-1/4 mb-5">
                        <p class="text-xs mb-1 text-slate-400">Correo asociado:</p>
                        <p class="text-gray-700">{{ $aliado->user->email }}</p>
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
                        <p class="text-xs mb-3 text-slate-400">Progreso:</p>
                        <div class="overflow-hidden h-1 text-xs flex rounded bg-green-50">
                            <div style="width: {{ $progreso_pago }}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-green-600"></div>
                        </div>
                    </div> --}}
                </div>

                <h3 class="text-sm mt-8 font-bold text-slate-800 mb-4">Facturas emitidas para este usuario:</h3>
                <div class="overflow-x-auto w-full rounded border border-gray-200">
                    <div class="w-full">
                        <table class="w-full border-collapse bg-white text-left text-xs text-gray-500">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 py-3 font-bold text-gray-500">ID</th>
                                <th scope="col" class="px-4 py-3 font-bold text-gray-500">Concepto</th>
                                <th scope="col" class="px-4 py-3 font-bold text-gray-500">Monto a pagar</th>
                                <th scope="col" class="px-4 py-3 font-bold text-gray-500">Status</th>
                                <th scope="col" class="px-4 py-3 font-bold text-gray-500">Fecha de creado</th>
                                <th scope="col" class="px-4 py-3 font-bold text-gray-500"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 border-t border-gray-100 text-xs">

                            @foreach ($facturas as $factura)

                            <tr class="hover:bg-gray-50">
                            <th class="px-4 gap-3">
                                <span class="flex justify-center items-center p-2 rounded bg-blue-100 text-blue-600 w-8 h-8">{{ $factura->id }}</span>
                            </th>
                            <td class="px-4 py-3 max-w-[200px]">
                                @switch($factura->categoria)
                                    @case('Gastos Generales')
                                        <span
                                        class="inline-flex items-center gap-1 rounded text-xxs bg-violet-50 px-1 py-0.5 font-semibold text-violet-600">
                                        Gastos Generales
                                        </span>
                                        @break
                                    @case('Mensualidad')
                                        <span
                                        class="inline-flex items-center gap-1 rounded text-xxs bg-emerald-50 px-1 py-0.5 font-semibold text-emerald-600">
                                        Mensualidad
                                        </span>
                                        @break
                                    @case('Otros')
                                        <span
                                        class="inline-flex items-center gap-1 rounded text-xxs bg-amber-50 px-1 py-0.5 font-semibold text-amber-600">
                                        Otros
                                        </span>
                                        @break
                                    @default
                                        Not found
                                @endswitch

                                <p class="font-bold truncate leading-3 text-gray-600 mt-2">{{ $factura->concepto }}</p>
                            </td>
                            <td class="px-4 py-3">
                                <p class="font-bold flex justify-start items-center text-blue-500 pr-4 text-base">{{ $factura->monto_deudor }} <span class="text-blue-600 text-xxs ml-2">USD</span></p>
                            </td>
                            <td class="px-4 py-3">
                                @switch($factura->status)
                                    @case(1)
                                        <span
                                        class="inline-flex items-center gap-1 rounded-full bg-amber-50 px-2 py-1 text-xxs font-semibold text-amber-600">
                                        <span class="h-1.5 w-1.5 rounded-full bg-amber-600"></span>
                                        Pendiente
                                        </span>
                                    @break
                                    @case(2)
                                        <span
                                        class="inline-flex items-center gap-1 rounded-full bg-blue-50 px-2 py-1 text-xxs font-semibold text-blue-600">
                                        <span class="h-1.5 w-1.5 rounded-full bg-blue-600"></span>
                                        Abonadas
                                        </span>
                                        @break
                                    @case(3)
                                        <span class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xxs font-semibold text-green-600">
                                        <span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>
                                        Conciliado
                                        </span>
                                        @break
                                    @default
                                        Not found
                                @endswitch
                            </td>
                            <td class="px-4 py-3 font-normal text-gray-900">
                                <div class="text-xs">
                                    <div class="font-bold text-gray-600">{{ $factura->created_at->format('d/m/Y') }}</div>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <a class="px-3 py-2 text-blue-600 border-2 rounded border-blue-600 text-xs hover:bg-blue-600 hover:text-white" x-data="{ tooltip: 'Ver Factura' }" href="{{ route('factura', $factura) }}">Ver Detalle</a>
                            </td>
                            </tr>

                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mt-2 w-full">{{ $facturas->links() }}</div>
            </div>
        </div>
    </main>

@endsection()
