@extends('layouts.template')

@section('title', 'Dashboard')

@section('header_section')

            <h1 class="text-2xl font-bold tracking-tight text-gray-900">Bienvenido, {{ Auth::user()->name }}</h1>

@endsection()

@section('content')

    <main>
        <div class="flex flex-wrap mx-auto py-4 pt-0">
            <div class="sm:w-4/6 py-4 pr-4 w-full">
                <div class="flex justify-between items-center mb-3">
                    <h2 class="text-l font-bold mb-0 text-gray-800">Facturas Pendientes</h2>
                    <a href="{{ route('facturas-pendientes') }}" class="py-2 px-2 rounded text-blue-700 text-xs hover:text-white hover:bg-blue-700 font-bold">Ver todos</a>
                </div>
                <div class="grid gap-2 grid-cols-2 mb-4">
                    @foreach ($facturas_pendientes as $facturasP)

                        <div class="flex flex-wrap items-center justify-between border border-gray-200 rounded bg-white p-4">
                            <div class="w-4/6 text-xs">
                                @switch($facturasP->status)
                                    @case(1)
                                        <span
                                        class="inline-flex items-center gap-1 rounded-full bg-amber-50 px-2 py-0.5 text-xxs font-semibold text-amber-600">
                                        <span class="h-1.5 w-1.5 rounded-full bg-amber-600"></span>
                                        Pendiente
                                        </span>
                                    @break
                                    @case(2)
                                        <span
                                        class="inline-flex items-center gap-1 rounded-full bg-blue-50 px-2 py-0.5 text-xxs font-semibold text-blue-600">
                                        <span class="h-1.5 w-1.5 rounded-full bg-blue-600"></span>
                                        Abonadas
                                        </span>
                                        @break
                                    @case(3)
                                        <span class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-0.5 text-xxs font-semibold text-green-600">
                                        <span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>
                                        Conciliado
                                        </span>
                                        @break
                                    @default
                                        Not found
                                @endswitch
                                <h3 class="text-sm font-bold mt-3">Factura #{{ $facturasP->id }}</h3>
                                <h5 class="text-xs font-bold text-gray-500 mt-2 mb-3">{{ $facturasP->concepto }}</h5>
                                @switch( $facturasP->categoria )
                                    @case('Gastos Generales')
                                        <span
                                        class="inline-flex items-center rounded text-xxs font-bold text-violet-600">
                                        
                                        Gastos Generales
                                        </span>
                                        @break
                                    @case('Mensualidad')
                                        <span
                                        class="inline-flex items-center rounded text-xxs font-bold text-emerald-600">
                                        
                                        Mensualidad
                                        </span>

                                        @break
                                    @case('Otros')
                                            <span
                                            class="inline-flex items-center rounded text-xxs font-bold text-amber-600">
                                            
                                            Otros
                                            </span>

                                            @break
                                    @default
                                        Not found
                                @endswitch
                            </div>
                            <div class="w-2/6 flex flex-col justify-between items-end h-full">
                                <p class="text-base text-gray-700 font-bold">{{ $facturasP->monto_deudor }} <span class="text-xs text-gray-500 font-bold">USD</span></p>
                                <a href="{{ route('factura', $facturasP) }}" class="bg-blue-700 p-2 text-white text-xs rounded text-center">Ver Factura</a>
                            </div>
                        </div>

                        @endforeach
                </div>
                <div class="">
                    <div class="flex justify-between items-center mb-3">
                        <h2 class="text-l font-bold mb-0 text-gray-800">Últimas facturas recibidas</h2>
                        <a href="{{ route('historial') }}" class="py-2 px-2 rounded text-blue-700 text-xs hover:text-white hover:bg-blue-700 font-bold">Ver todos</a>
                    </div>
                    <div class="overflow-x-auto rounded border border-gray-200">
                        <div class="w-full">
                            <table class="w-full border-collapse bg-white text-left text-xs text-gray-500">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="pl-4 py-3 font-bold text-gray-500"></th>
                                    <th scope="col" class="pl-4 py-3 font-bold text-gray-500">Concepto</th>
                                    <th scope="col" class="px-4 py-3 font-bold text-gray-500">Estatus</th>
                                    <th scope="col" class="px-4 py-3 font-bold text-gray-500">Monto</th>
                                    <th scope="col" class="px-4 py-3 font-bold text-gray-500">Creado el</th>
                                    <th scope="col" class="px-4 py-3 font-bold text-gray-500"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 border-t border-gray-100 text-xs">

                                @foreach ($facturas_recibidas as $facturaR)

                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3">
                                        <div class="w-8 h-8 text-blue-500"><span class="material-symbols-outlined">receipt_long</span></div>
                                    </td>
                                    <td class="px-4 py-3 max-w-[200px]">
                                        <p class="text-gray-700 font-bold text-xs mb-1">Factura #{{ $facturaR->id }}</p>
                                        <span class="text-gray-400 font-bold">{{ $facturaR->concepto }}</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        @switch($facturaR->status)
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
                                    <td class="px-4 py-3">
                                        <p class="font-bold flex justify-center items-center text-gray-700 pr-4 text-sm">{{ $facturaR->monto_deudor }} <span class="text-gray-500 text-xxs ml-2">USD</span></p>
                                    </td>
                                    <td class="px-4 py-3 font-normal text-gray-900">
                                        <div class="text-xs">
                                            <div class="font-bold text-gray-700">{{ $facturaR->created_at->format('d/m/Y') }}</div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex justify-end relative gap-4" x-data="{ open: false }">

                                            <button @click="open = true"><span class="material-symbols-outlined">
                                                more_vert
                                                </span></button>

                                            <ul x-show="open" @click.outside="open = false"
                                            x-transition:enter="transition ease-out duration-200"
                                            x-transition:enter-start="opacity-0 scale-95"
                                            x-transition:enter-end="opacity-100 scale-100"
                                            x-transition:leave="transition ease-in duration-75"
                                            x-transition:leave-start="opacity-100 scale-100"
                                            x-transition:leave-end="opacity-0 scale-95"
                                            class="absolute bg-white z-50 mt-2 w-32 rounded-md shadow-lg right-full p-1">
                                                    <li><a class="p-2 block text-xs font-bold hover:text-blue-500 hover:bg-blue-50" href="{{ route('factura', $facturaR) }}">Ver Factura</a></li>
                                                    <li><a class="p-2 block text-xs font-bold hover:text-blue-500 hover:bg-blue-50" href="{{ route('reportar-pago', $facturaR) }}">Reportar Pago</a></li>
                                            </ul>

                                        </div>
                                    </td>
                                </tr>

                                @endforeach

                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sm:w-2/6 py-4 sm:px-4 lg:px-4 w-full">
                <div class="flex justify-between items-center mb-3 mt-2">
                    <h2 class="text-l font-bold mb-0 text-gray-800">Resumen:</h2>
                </div>
                <div class="bg-white flex flex-wrap text-center mb-4 rounded overflow-hidden">
                    <div class="w-full flex justify-center items-center border border-b-0 flex-col px-2 py-4">
                        <span class="text-sm block text-gray-500 font-bold mb-2">Total facturado este mes:</span>
                        <p class="text-2xl text-blue-600 font-bold">{{ number_format($monto_pendiente_todas) }}<span class="text-xs font-bold ml-2">USD</span></p>
                    </div>
                    <div class="w-full border border-t-0 border-b-0 px-4 pt-1 pb-3">
                        <div class="flex justify-between items-center">
                            <span class="text-xs block text-gray-500 font-bold mb-2">Progreso:</span>
                            <span class="text-sm block text-gray-500 font-bold mb-2">{{ $progreso_pagos_abonados }}%</span>
                        </div>
                        <div class="overflow-hidden h-1 mb-2 text-xs flex rounded bg-green-200">
                            <div style="width: {{ $progreso_pagos_abonados }}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-green-500"></div>
                        </div>
                    </div>
                    <div class="w-1/2 flex justify-center items-center border flex-col px-2 py-4">
                        <span class="text-xs block text-gray-500 font-bold mb-2">Abonado:</span>
                        <p class="text-2xl text-green-600 font-bold">{{ number_format($monto_total_abonadas) }}<span class="text-xs font-bold ml-2">USD</span></p>
                    </div>
                    <div class="w-1/2 flex justify-center items-center border border-l-0 flex-col px-2 py-4">
                        <span class="text-xs block text-gray-500 font-bold mb-2">Por pagar:</span>
                        <p class="text-2xl text-blue-600 font-bold">{{ number_format($monto_pagos_pendientes) }}<span class="text-xs font-bold ml-2">USD</span></p>
                    </div>
                </div>
                {{-- <div class="grid gap-2 grid-cols-1 mb-4">
                    <div class="flex items-center justify-start p-3 bg-white border rounded">
                        <span class="bg-blue-700 text-white rounded p-1 font-extrabold text-xl mr-2 w-9 h-9 text-center">{{ $total_facturas_pendientes }}</span>
                        <p class="mb-0 text-xs font-bold text-gray-700">Facturas pendientes</p>
                    </div>

                    <div class="flex items-center justify-start p-3 bg-white border rounded">
                        <span class="bg-amber-400 text-white rounded p-1 font-extrabold text-xl mr-2 w-9 h-9 text-center">{{ $total_facturas_reportadas }}</span>
                        <p class="mb-0 text-xs font-bold text-gray-700">Facturas abonadas</p>
                    </div>

                    <div class="flex items-center justify-start p-3 bg-white border rounded">
                        <span class="bg-green-500 text-white rounded p-1 font-extrabold text-xl mr-2 w-9 h-9 text-center">{{ $total_facturas_conciliadas }}</span>
                        <p class="mb-0 text-xs font-bold text-gray-700">Facturas conciliadas</p>
                    </div>
                </div> --}}
                {{-- <div class="mb-4">
                    <h2 class="text-l font-bold mb-3 text-gray-800">Facturas pendientes</h2>
                    <div class="">

                        @foreach ($facturas_pendientes as $facturasP)

                        <div class="flex flex-wrap items-center justify-between border border-gray-200 rounded bg-white p-4 mb-2">
                            <div class="w-4/6">
                                <h5 class="text-sm">{{ $facturasP->concepto }}</h5>
                                <p class="text-xxs text-gray-500">Monto: {{ $facturasP->monto_deudor }} USD</p>
                            </div>
                            <a href="{{ route('reportar-pago', $facturasP) }}" class="w-2/6 bg-blue-700 p-2 text-white text-xs rounded text-center">Reportar pago</a>
                        </div>

                        @endforeach

                    </div>
                </div> --}}
                <div class="bg-gradient-to-r from-blue-500 to-blue-700 py-8 px-7 text-white rounded">
                    <span class="text-xs bg-blue-50 mb-3 rounded text-blue-700 p-1 px-2 font-bold inline-block">Anuncio</span>
                    <h2 class="text-lg font-bold mb-3">Recuerda reportar el pago de tus facturas a tiempo</h2>
                    <p class="text-sm">Cuando cancelas tus facturas dentro del plazo corresponiente y realizas tus reportes a través de la aplicación estás contribuyendo a la prestación de un servicio más eficiente</p>
                </div>
            </div>

        </div>
    </main>

@endsection()
