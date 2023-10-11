@extends('layouts.template')

@section('title', 'Historial de facturas')

@section('header_section')

    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Historial de Pagos Realizados</h1>

@endsection()

@section('content')

    <main>
        <div class="flex flex-wrap mx-auto py-4 pt-0">
            <div class="w-full py-4">

                @if ($total_facturas_reportadas > 0)

                <div class="overflow-x-auto rounded border border-gray-200">
                    <div class="w-full">
                        <table class="w-full border-collapse bg-white text-left text-xs text-gray-500">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 py-3 font-bold text-gray-500"></th>
                                <th scope="col" class="px-4 py-3 font-bold text-gray-500">Concepto</th>
                                <th scope="col" class="px-4 py-3 font-bold text-gray-500">Estatus</th>
                                <th scope="col" class="px-4 py-3 font-bold text-gray-500">Detalle</th>
                                <th scope="col" class="px-4 py-3 font-bold text-gray-500">Monto</th>
                                <th scope="col" class="px-4 py-3 font-bold text-gray-500">Fecha</th>
                                <th scope="col" class="px-4 py-3 font-bold text-gray-500"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 border-t border-gray-100 text-xs">

                            @foreach ($pagos_realizados as $pago)

                                <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3">
                                    <div class="w-8 h-8 text-blue-500"><span class="material-symbols-outlined">payments</span></div>
                                </td>
                                <td class="px-4 py-3 max-w-[200px]">
                                    <p class="text-gray-700 font-bold mb-1">{{ $pago->factura->concepto }}</p>
                                    <span class="text-gray-400 font-bold">Pago realizado por: {{ $pago->nombre_titular }}</span>
                                </td>
                                <td class="px-4 py-3">
                                    @switch( $pago->status )
                                        @case(1)
                                            <span
                                            class="inline-flex items-center gap-1 rounded-full bg-amber-50 px-2 text-xxs py-1 font-semibold text-amber-600">
                                            <span class="h-1.5 w-1.5 rounded-full bg-amber-600"></span>
                                            Por conciliar
                                            </span>
                                            @break
                                        @case(2)
                                            <span
                                            class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 text-xxs py-1 font-semibold text-green-600">
                                            <span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>
                                            Conciliadas
                                            </span>

                                            @break
                                        @default
                                            Not found
                                    @endswitch
                                </td>
                                <td class="px-4 py-3">
                                    <p class="text-gray-700 font-bold mb-1">{{ Str::ucfirst($pago->metodo_pago) }}</p>
                                    <span class="text-gray-400 font-bold">{{ Str::ucfirst($pago->plataforma_pago) }}</span>
                                </td>
                                <td class="px-4 py-3">
                                    <p class="font-bold flex justify-center items-center text-gray-700 pr-4 text-sm">{{ $pago->monto_equivalente }} <span class="text-gray-500 text-xxs ml-2">USD</span></p>
                                </td>
                                <td class="px-4 py-3">
                                    <p class="text-gray-700 font-bold">{{ $pago->fecha_pago->format('d/m/Y') }}</p>
                                </td>
                                <td class="px-4 py-3">
                                    <a href="{{ route('factura', $pago->factura) }}" class="px-3 py-2 text-blue-600 font-bold border-2 rounded border-blue-600 text-xs hover:bg-blue-600 hover:text-white">Ver Factura</a>
                                </td>
                                </tr>

                            @endforeach

                        </tbody>
                        </table>
                    </div>
                </div>
                <div class="mt-3">
                    {{ $pagos_realizados->links() }}
                </div>

            @else

                <div class="p-5">
                    <div class="w-full flex flex-col flex-wrap text-center justify-center items-center">
                        <div class="w-56 h-56 p-6 bg-white rounded-full overflow-hidden border border-gray-100 mb-2">
                            <img src="{{ asset('img/facturas-pendientes.jpg') }}" alt="">
                        </div>
                        <h2 class="text-lg font-bold text-neutral-700">Nada nuevo por acá...</h2>
                        <p class="text-sm text-neutral-600">Estas al día con el pago de tus facturas</p>
                    </div>
                </div>

            @endif
            </div>
        </div>
    </main>

@endsection()