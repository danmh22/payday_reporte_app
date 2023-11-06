@extends('layouts.template')

@section('title', 'Facturas Conciliadas')

@section('header_section')

    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Facturas Conciliadas</h1>

@endsection()

@section('content')

    <main>
        <div class="flex flex-wrap mx-auto py-4 pt-0">
            <div class="w-full py-4">

                @if ($total_facturas_conciliadas > 0)

                    @if (session('success'))
                        <div class="py-2 px-2 rounded border bg-green-50 text-green-600 text-xs mb-2 font-semibold tracking-wider" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="overflow-x-auto rounded shadow border-gray-200">
                        <div class="w-full">
                            <table class="w-full border-collapse bg-white text-left text-xs text-gray-500">
                            <thead class="bg-slate-200">
                                <tr>
                                    <th scope="col" class="px-4 py-3 font-bold text-bold-900">ID</th>
                                    <th scope="col" class="px-4 py-3 font-bold text-bold-900">Aliado Comercial</th>
                                    <th scope="col" class="px-4 py-3 font-bold text-bold-900">Categoría</th>
                                    <th scope="col" class="px-4 py-3 font-bold text-bold-900">Monto a pagar</th>
                                    <th scope="col" class="px-4 py-3 font-bold text-bold-900">Status</th>
                                    <th scope="col" class="px-4 py-3 font-bold text-bold-900">Fecha de creado</th>
                                    <th scope="col" class="px-4 py-3 font-bold text-bold-900"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 border-t border-gray-100 text-xs">

                                @foreach ($lista_facturas_conciliadas as $factura)

                                <tr class="hover:bg-gray-50">
                                <th class="px-4 gap-3">
                                    <span class="flex justify-center items-center p-2 rounded bg-emerald-100 text-emerald-700 w-8 h-8">{{ $factura->id }}</span>
                                </th>
                                <td class="px-4 py-3 max-w-[130px]">

                                    <p class="text-gray-700 font-bold mb-1">{{ $factura->aliado->nombre_aliado }}</p>
                                    <p class="text-gray-400 truncate font-bold leading-5">{{ $factura->concepto }}</p>
                                </td>
                                <td class="px-4 py-3">
                                    @if ($factura->categoria)
                                        <span
                                        class="inline-flex items-center gap-1 rounded text-xs bg-teal-50 px-2 py-1 font-semibold text-teal-600">
                                        {{ $factura->categoria }}
                                        </span>
                                    @else
                                        Not found
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <p class="font-bold flex justify-start items-center text-emerald-600 pr-4 text-base">{{ $factura->monto_dolar }} <span class="text-emerald-700 text-xxs ml-2">USD</span></p>
                                    <p class="font-bold flex justify-start items-center text-cyan-700 pr-4 text-xs">≈ {{ number_format($factura->monto_actual_bs, 2) }} <span class="text-cyan-800 text-xxs ml-1">Bs</span></p>
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
                                            class="inline-flex items-center gap-1 rounded-full bg-cyan-50 px-2 py-1 text-xxs font-semibold text-cyan-600">
                                            <span class="h-1.5 w-1.5 rounded-full bg-cyan-600"></span>
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
                                        <div class="font-bold text-gray-700">{{ $factura->created_at->format('d/m/Y') }}</div>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <a class="px-3 py-2 text-emerald-700 font-bold border-2 rounded border-emerald-700 text-xs transition-all hover:bg-emerald-700 hover:text-white" x-data="{ tooltip: 'Ver Factura' }" href="{{ route('factura', $factura) }}">Ver Detalle</a>
                                </td>
                                </tr>

                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mt-3">{{ $lista_facturas_conciliadas->links() }}</div>

                @else

                    <div class="p-5">
                        <div class="w-full flex flex-col flex-wrap text-center justify-center items-center">
                            <div class="w-60 h-60 p-4 bg-white rounded-full overflow-hidden shadow border-gray-100 mb-2">
                                <img src="{{ asset('img/ayuda.jpg') }}" alt="">
                            </div>
                            <h2 class="text-lg font-bold text-neutral-700">Parece que aquí no hay nada...</h2>
                            <p class="text-sm font-bold text-neutral-500 w-1/2">Puede que tengas <a class="text-emerald-600" href="{{ route('pagos-conciliar') }}">pagos por conciliar</a> o que aún no hayas cargado facturas a tus aliados comerciales.</p>
                        </div>
                    </div>

                @endif

            </div>
        </div>
    </main>

@endsection()
