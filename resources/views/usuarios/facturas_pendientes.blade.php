@extends('layouts.template')

@section('title', 'Facturas por Reportar')

@section('header_section')

    <h1 class="text-2xl font-bold tracking-tight text-gray-700">Facturas Pendientes</h1>

@endsection()

@section('content')

    <main>
        <div class="flex flex-wrap mx-auto py-4 pt-0">
            <div class="w-full py-4">
                @if ($total_facturas_pendientes > 0)

                    <div class="overflow-x-auto rounded shadow border-gray-200">
                        <div class="w-full">
                            <table class="w-full border-collapse bg-white text-left text-xs text-gray-500">
                            <thead class="bg-slate-200">
                                <tr>
                                    <th scope="col" class="px-4 py-3 font-bold text-slate-600"></th>
                                    <th scope="col" class="px-4 py-3 font-bold text-slate-600">Concepto</th>
                                    <th scope="col" class="px-4 py-3 font-bold text-slate-600">Categoria</th>
                                    <th scope="col" class="px-4 py-3 font-bold text-slate-600">Monto a pagar</th>
                                    <th scope="col" class="px-4 py-3 font-bold text-slate-600">Estatus</th>
                                    <th scope="col" class="px-4 py-3 font-bold text-slate-600">Fecha de creado</th>
                                    <th scope="col" class="px-4 py-3 font-bold text-slate-600"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 border-t border-gray-100 text-xs">
                                @foreach ($facturas_pendientes as $facturasP)

                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3">
                                        <div class="w-8 h-8 text-emerald-500"><span class="material-symbols-outlined">receipt_long</span></div>
                                    </td>
                                    <td class="px-4 py-3 max-w-[200px]">
                                        <p class="text-gray-700 font-bold mb-1">Factura #{{ $facturasP->id }}</p>
                                        <span class="text-gray-400 font-bold">{{ $facturasP->concepto }}</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        @if ($facturasP->categoria)
                                            <span
                                            class="inline-flex items-center gap-1 rounded text-xs bg-teal-50 px-2 py-1 font-semibold text-teal-600">
                                            {{ $facturasP->categoria }}
                                            </span>
                                        @else
                                            Not found
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        <p class="font-bold flex justify-start items-center text-gray-700 pr-4 text-sm">{{ $facturasP->monto_dolar }} <span class="text-gray-500 text-xxs ml-2">USD</span></p>
                                        <p class="font-bold flex justify-start items-center text-slate-500 pr-4 text-xs">≈ {{ number_format($facturasP->monto_actual_bs, 2) }} <span class="text-cyan-800 text-xxs ml-1">Bs</span></p>
                                    </td>
                                    <td class="px-4 py-3">
                                        @switch($facturasP->status)
                                            @case(1)
                                                <span
                                                class="inline-flex items-center gap-1 rounded-full bg-amber-50 px-2 py-1 font-semibold text-amber-600">
                                                <span class="h-1.5 w-1.5 rounded-full bg-amber-600"></span>
                                                Pendiente
                                                </span>
                                            @break
                                            @case(2)
                                                <span
                                                class="inline-flex items-center gap-1 rounded-full bg-cyan-50 px-2 py-1 font-semibold text-cyan-600">
                                                <span class="h-1.5 w-1.5 rounded-full bg-cyan-600"></span>
                                                Abonadas
                                                </span>
                                                @break
                                            @case(3)
                                                <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2 py-1 font-semibold text-emerald-600">
                                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-600"></span>
                                                Conciliado
                                                </span>
                                                @break
                                            @default
                                                Not found
                                        @endswitch
                                    </td>
                                    <td class="px-4 py-3 font-normal text-gray-900">
                                        <div class="text-xs">
                                            <div class="font-bold text-gray-700">{{ $facturasP->created_at->format('d/m/Y') }}</div>
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
                                                <li><a class="p-2 block text-xs font-bold hover:text-emerald-700 hover:bg-emerald-50" href="{{ route('factura', $facturasP) }}">Ver Factura</a></li>
                                                <li><a class="p-2 block text-xs font-bold hover:text-emerald-700 hover:bg-emerald-50" href="{{ route('reportar-pago', $facturasP) }}">Reportar Pago</a></li>
                                        </ul>
                                    </div>
                                </td>
                                </tr>

                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mt-3">
                        {{ $facturas_pendientes->links() }}
                    </div>

                @else

                    <div class="p-5">
                        <div class="w-full flex flex-col flex-wrap text-center justify-center items-center">
                            <div class="w-60 h-60 p-4 bg-white rounded-full overflow-hidden shadow border-gray-100 mb-2">
                                <img src="{{ asset('img/ayuda.jpg') }}" alt="">
                            </div>
                            <h2 class="text-lg font-bold text-neutral-700">Nada nuevo por acá...</h2>
                            <p class="text-sm font-bold text-neutral-500 w-2/3">Estas al día con el pago de tus facturas</p>
                        </div>
                    </div>

                @endif
            </div>
        </div>
    </main>

@endsection()
