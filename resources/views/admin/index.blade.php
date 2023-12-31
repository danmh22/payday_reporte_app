@extends('layouts.template')

@section('title', 'Dashboard')

@section('header_section')

            <h1 class="text-2xl font-bold tracking-tight text-gray-900">Bienvenido, Administrador</h1>

@endsection()

@section('content')

    <main>
        <div class="flex flex-wrap mx-auto py-4 pt-0">
            
            <div class="sm:w-2/6 py-4 sm:pr-4 lg:pr-4 w-full">
                {{-- {{ $tasa_dolar_bcv }} --}}
                <div class="w-full shadow bg-white px-6 py-4 rounded h-32">
                    <div class="flex justify-between items-center h-full">
                        <div>
                            <div class="w-9 h-9 text-xs bg-emerald-100 text-emerald-600 rounded flex justify-center items-center"><span class="material-symbols-outlined">
                                payments
                                </span></div>
                            <h2 class="text-l font-bold mt-2 mb-1 text-gray-800">Pagos</h2>
                            <p class="text-gray-500 text-xs font-bold">{{ $total_pagos_conciliados }} de {{ $total_pagos }} Pagos Conciliados</p>
                        </div>
                        <div>
                            <div class="flex items-center flex-wrap max-w-md px-4 bg-white rounded-2xl"
                            x-data="{ 
                                circumference: 30 * 2 * Math.PI, 
                                @if ($total_pagos == 0)
                                    percent: 0
                                @else 
                                    percent: {{ round($total_pagos_conciliados*100/$total_pagos )}}  
                                @endif
                            }">
                                <div class="flex items-center justify-center overflow-hidden bg-white rounded-full">
                                    <svg class="w-20 h-20" x-cloak aria-hidden="true">
                                    <circle
                                        class="text-gray-300"
                                        stroke-width="5"
                                        stroke="currentColor"
                                        fill="transparent"
                                        r="30"
                                        cx="40"
                                        cy="40"
                                        />
                                    <circle
                                        class="text-emerald-600"
                                        stroke-width="5"
                                        :stroke-dasharray="circumference"
                                        :stroke-dashoffset="circumference - percent / 100 * circumference"
                                        stroke-linecap="round"
                                        stroke="currentColor"
                                        fill="transparent"
                                        r="30"
                                        cx="40"
                                        cy="40"
                                    />
                                    </svg>
                                    <span class="absolute text-lg font-bold text-emerald-700" x-text="`${percent}%`"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="sm:w-4/6 py-4 sm:pl-4 lg:pl-4 w-full">
                <div style="background-image: url('{{ asset('img/bg-green-img.jpg')}}')" class="h-32 shadow flex justify-between items-center flex-wrap overflow-hidden p-6 rounded text-white bg-cover bg-center relative before:w-full before:h-full before:absolute before:top-0 before:left-0 before:bg-emerald-700 before:opacity-80">
                    <div class="relative w-4/6 z-10">
                        <h2 class="text-xl font-bold mb-2">Carga un listado de facturas</h2>
                        <p class="text-sm font-semibold">¿Llegó la fecha de cobro? Carga un nuevo lote de facturas para tus aliados comerciales fácil y rápido</p>
                    </div>
                    <div class="relative w-2/6 z-10 flex justify-end items-center pr-4">
                        <a href="{{ route('cargar-facturas') }}" class="bg-white text-emerald-700 font-bold text-sm rounded py-3 px-4 border-2 border-white transition-all hover:bg-transparent hover:text-white">Cargar Facturas</a>
                    </div>
                </div>
            </div>

            <div class="sm:w-4/6 py-4 pr-4 w-full">
                <div class="">

                    <div class="flex justify-between items-center mb-3">
                        <h2 class="text-l font-bold mb-0 text-gray-800">Últimos pagos por conciliar</h2>
                        <a href="{{ route('pagos-conciliar') }}" class="py-2 px-2 rounded text-emerald-700 text-xs font-bold transition-all hover:text-white hover:bg-emerald-700">Ver todos</a>
                    </div>

                    @if ($total_pagos_por_conciliar > 0)

                    <div class="overflow-x-auto rounded shadow border-gray-200 max-h-[32rem]">
                        <div class="w-full">
                            <table class="w-full border-collapse bg-white text-left text-xs text-gray-500">
                            <thead class="bg-slate-200 z-10 sticky top-0">
                                <tr>
                                    <th scope="col" class="px-4 py-3 font-bold text-slate-600"></th>
                                    <th scope="col" class="pr-4 py-3 font-bold text-slate-600">Resumen</th>
                                    <th scope="col" class="px-4 py-3 font-bold text-slate-600">Categoria</th>
                                    <th scope="col" class="px-4 py-3 font-bold text-slate-600">Monto</th>
                                    <th scope="col" class="px-4 py-3 font-bold text-slate-600">Fecha de reporte</th>
                                    <th scope="col" class="px-4 py-3 font-bold text-slate-600"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 border-t border-gray-100 text-xs max-h-[32rem] overflow-auto">

                                @foreach ($lista_pagos_por_conciliar as $pagoC)

                                <tr class="hover:bg-gray-50">
                                <th class="px-4">
                                    <div class="w-8 h-8 text-emerald-600"><span class="material-symbols-outlined">payments</span></div>
                                </th>
                                <td class="pr-4 py-3 max-w-[180px]">

                                    <p class="truncate font-bold leading-5 text-gray-700 flex justify-start items-center">{{ Str::ucfirst($pagoC->metodo_pago) }} <span class="material-symbols-outlined mx-2 text-xs">trending_flat</span> {{ Str::ucfirst($pagoC->plataforma_pago) }}</p>
                                    {{-- <span class="text-slate-500 my-2 font-bold">{{ $pagoC->factura->aliado->nombre_aliado }}</span> --}}
                                    <p class="truncate text-xxs leading-5 font-bold text-slate-500">Ref: {{ $pagoC->referencia_pago }}</p>
                                </td>
                                <td class="px-4 py-3">
                                    @if ($pagoC->factura->categoria)
                                        <span
                                        class="inline-flex items-center gap-1 rounded text-xs bg-teal-50 px-2 py-1 font-semibold text-teal-600">
                                        {{ $pagoC->factura->categoria }}
                                        </span>
                                    @else
                                        Not found
                                    @endif
                                </td>
                                <td class="px-4 py-3 max-w-[150px]">
                                    <p class="font-bold flex justify-start items-center text-green-600 pr-4 text-base">{{ $pagoC->monto_equivalente }} <span class="text-green-700 text-xxs ml-2">USD</span></p>
                                    @php
                                        $monto_dolar = floatval($pagoC->monto_equivalente);
                                        $monto_bs    = $monto_dolar * floatval($tasa_dolar_hoy->tasa_dolar);
                                    @endphp
                                    <p class="font-bold flex justify-start items-center text-cyan-700 pr-4 text-xs">≈ {{ number_format($monto_bs, 2) }} <span class="text-cyan-800 text-xxs ml-1">Bs</span></p>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="text-xs font-bold text-gray-600">{{ $pagoC->fecha_pago->format('d/m/Y') }}</div>
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
                                                <li><a class="p-2 block transition-all hover:text-emerald-700 hover:bg-emerald-50" href="{{ route('factura', $pagoC->factura->id) }}">Ver Factura</a></li>
                                            @if ($pagoC->status = 1 )
                                                <li>
                                                    <form action="{{ route('conciliar-pago') }}" method="POST">
                                                        @csrf
                                                        @method('patch')
                                                        <input type="hidden" name="id" value="{{ $pagoC->id }}">
                                                        <button class="p-2 text-left block w-full transition-all hover:text-emerald-700 hover:bg-emerald-50">Conciliar Pago</button>
                                                    </form>
                                                </li>
                                            @else

                                            @endif
                                        </ul>

                                    </div>
                                </td>
                                </tr>

                                @endforeach

                            </tbody>
                            </table>
                        </div>
                    </div>
                    @else
                        <div class="p-12 bg-white rounded shadow">
                            <div class="w-full flex flex-col flex-wrap text-center justify-center items-center">
                                <div class="w-60 h-60 p-6 bg-white rounded-full overflow-hidden shadow shadow-slate-200 mb-2">
                                    <img src="{{ asset('img/facturas-pendientes.jpg') }}" alt="">
                                </div>
                                <h2 class="text-lg font-bold text-neutral-700">Parece que no hay nada nuevo por acá...</h2>
                                <p class="text-sm text-neutral-600">No has recibido nuevos pagos por parte de tus aliados comerciales</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="sm:w-2/6 py-4 sm:px-4 lg:px-4 w-full">
                <div class="bg-white shadow flex flex-wrap text-center mb-4 rounded overflow-hidden">
                    <div class="w-full flex justify-center items-center border-b-0 flex-col px-2 py-4">
                        <span class="text-sm block text-gray-500 font-bold mb-3">Tasa del dolar hoy:</span>
                        <p class="text-2xl text-emerald-700 font-bold">{{ $tasa_dolar_hoy->tasa_dolar }}<span class="text-xs font-bold ml-1">Bs</span></p>
                        <span class="text-xxs block text-gray-400 font-bold mt-4">Registrado el: {{ $tasa_dolar_hoy->created_at }}</span>
                    </div>
                </div>

                <div class="flex justify-between items-center mb-3">
                    <h2 class="text-l font-bold mb-0 text-gray-800">Resumen:</h2>
                </div>
                <div class="bg-white shadow flex flex-wrap text-center mb-4 rounded overflow-hidden">
                    <div class="w-full flex justify-center items-center border-b-0 flex-col px-2 py-4">
                        <span class="text-sm block text-gray-500 font-bold mb-2">Total facturado este mes:</span>
                        <p class="text-2xl text-emerald-700 font-bold">{{ number_format($monto_pendiente_todas) }}<span class="text-xs font-bold ml-2">USD</span></p>
                    </div>
                    <div class="w-full border-t-0 border-b-0 px-4 pt-1 pb-3">
                        <div class="flex justify-between items-center">
                            <span class="text-xs block text-gray-500 font-bold mb-2">Progreso:</span>
                            <span class="text-sm block text-gray-500 font-bold mb-2">{{ $progreso_pagos_abonados }}%</span>
                        </div>
                        <div class="overflow-hidden h-1 mb-2 text-xs flex rounded bg-green-200">
                            <div style="width: {{ $progreso_pagos_abonados }}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-emerald-600"></div>
                        </div>
                    </div>
                    <div class="w-1/2 flex justify-center items-center border-r border-t border-slate-100 flex-col px-2 py-4">
                        <span class="text-xs block text-gray-500 font-bold mb-2">Abonado:</span>
                        <p class="text-2xl text-emerald-700 font-bold">{{ number_format($monto_pendiente_abonadas) }}<span class="text-xs font-bold ml-2">USD</span></p>
                    </div>
                    <div class="w-1/2 flex justify-center items-center border-t border-slate-100 flex-col px-2 py-4">
                        <span class="text-xs block text-gray-500 font-bold mb-2">Por pagar:</span>
                        <p class="text-2xl text-amber-600 font-bold">{{ number_format($monto_pendiente_final) }}<span class="text-xs font-bold ml-2">USD</span></p>
                    </div>
                </div>

                <div class="flex justify-between items-center mb-3">
                    <h2 class="text-l font-bold mb-0 text-gray-800">Facturas:</h2>
                </div>
                <div class="grid grid-cols-3 mb-2 rounded shadow overflow-hidden">
                    <div class="flex justify-center items-center text-center bg-white border-r border-slate-100 flex-col px-4 py-4">
                        <span class="text-xs block text-gray-500 font-bold mb-2">Pendientes</span>
                        <p class="text-2xl text-amber-600 font-bold">{{ $total_facturas_emitidas }}</p>
                    </div>

                    <div class="flex justify-center items-center text-center bg-white border-r border-slate-100 flex-col px-4 py-4">
                        <span class="text-xs block text-gray-500 font-bold mb-2">Abonadas</span>
                        <p class="text-2xl text-cyan-600 font-bold">{{ $total_facturas_reportadas }}</p>
                    </div>
                    
                    <div class="flex justify-center items-center text-center bg-white flex-col px-4 py-4">
                        <span class="text-xs block text-gray-500 font-bold mb-2">Conciliadas</span>
                        <p class="text-2xl text-emerald-700 font-bold">{{ $total_facturas_conciliadas }}</p>
                    </div>
                    
                    
                </div>

            </div>

        </div>
    </main>

@endsection()
