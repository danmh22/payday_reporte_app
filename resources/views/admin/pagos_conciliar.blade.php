@extends('layouts.template')

@section('title', 'Pagos por Conciliar')

@section('header_section')

    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Pagos por Conciliar</h1>

@endsection()

@section('content')

    <main>
        <div class="flex flex-wrap mx-auto py-4 pt-0">
            <div class="w-full py-4">

                @if ($total_pagos_por_conciliar > 0)

                    <div class="overflow-x-auto rounded shadow border-gray-200">
                        <div class="w-full">
                            <table class="w-full border-collapse bg-white text-left text-xs text-gray-500">
                                <thead class="bg-slate-200">
                                    <tr>
                                        <th scope="col" class="px-4 py-3 font-bold text-slate-600"></th>
                                        <th scope="col" class="px-4 py-3 font-bold text-slate-600">Aliado Comercial</th>
                                        <th scope="col" class="px-4 py-3 font-bold text-slate-600">Método de pago</th>
                                        <th scope="col" class="px-4 py-3 font-bold text-slate-600">Categoría</th>
                                        <th scope="col" class="px-4 py-3 font-bold text-slate-600">Monto</th>
                                        <th scope="col" class="px-4 py-3 font-bold text-slate-600">Fecha de reporte</th>
                                        <th scope="col" class="px-4 py-3 font-bold text-slate-600"></th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 border-t border-gray-100 text-xs">

                                    @foreach ($lista_pagos_por_conciliar as $pago)
                                    <tr class="hover:bg-gray-50">
                                        <th class="px-4 gap-3">
                                            <div class="w-8 h-8 text-amber-600"><span class="material-symbols-outlined">payments</span></div>
                                        </td>
                                        </th>
                                        <td class="px-4 py-3 max-w-[200px]">
                                            <p class="text-gray-700 font-bold mb-1">{{ $pago->factura->aliado->nombre_aliado }}</p>
                                            <p class="truncate leading-5 font-bold text-gray-400">{{ $pago->factura->concepto }}</p>
                                        </td>
                                        <td class="px-4 py-3">
                                            <p class="truncate font-bold leading-5 text-gray-700 flex justify-start items-center mb-1">{{ Str::ucfirst($pago->metodo_pago) }} <span class="material-symbols-outlined mx-2 text-xs">trending_flat</span> {{ Str::ucfirst($pago->plataforma_pago) }}</p>
                                            <p class="truncate leading-5 font-bold text-gray-400">Ref: {{ $pago->referencia_pago }}</p>
                                        </td>
                                        <td class="px-4 py-3">
                                            @if ($pago->factura->categoria)
                                                <span
                                                class="inline-flex items-center gap-1 rounded text-xs bg-teal-50 px-2 py-1 font-semibold text-teal-600">
                                                {{ $pago->factura->categoria }}
                                                </span>
                                            @else
                                                Not found
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 max-w-[150px]">
                                            <p class="font-bold flex justify-start items-center text-emerald-600 pr-4 text-base">{{ $pago->monto_equivalente }} <span class="text-emerald-700 text-xxs ml-2">USD</span></p>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="text-xs font-bold text-gray-700">{{ $pago->fecha_pago->format('d/m/y') }}</div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex justify-end gap-4">
                                                <a class="px-3 py-2 font-bold text-emerald-700 border-2 rounded border-emerald-700 text-xs transition-all hover:bg-emerald-700 hover:text-white" x-data="{ tooltip: 'Ver Factura' }" href="{{ route('factura', $pago->factura) }}">Ver Factura</a>
                                            </div>
                                        </td>
                                    </tr>

                                    @endforeach

                                </tbody>
                                </table>
                        </div>
                    </div>
                    <div class="mt-2">{{ $lista_pagos_por_conciliar->links() }}</div>

                @else

                    <div class="p-5">
                        <div class="w-full flex flex-col flex-wrap text-center justify-center items-center">
                            <div class="w-60 h-60 p-4 bg-white rounded-full overflow-hidden border border-gray-100 mb-2">
                                <img src="{{ asset('img/task-complete.jpg') }}" alt="">
                            </div>
                            <h2 class="text-lg font-bold text-neutral-700">Nada nuevo por acá...</h2>
                            <p class="text-sm font-bold text-neutral-500">Estas al día con la conciliación de los pagos</p>
                        </div>
                    </div>

                @endif
            </div>
        </div>
    </main>

@endsection()
