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
                                <th scope="col" class="px-4 py-3 font-medium text-gray-900"></th>
                                <th scope="col" class="px-4 py-3 font-medium text-gray-900">Concepto</th>
                                <th scope="col" class="px-4 py-3 font-medium text-gray-900">Estatus</th>
                                <th scope="col" class="px-4 py-3 font-medium text-gray-900">Detalle</th>
                                <th scope="col" class="px-4 py-3 font-medium text-gray-900">Monto</th>
                                <th scope="col" class="px-4 py-3 font-medium text-gray-900">Fecha</th>
                                <th scope="col" class="px-4 py-3 font-medium text-gray-900"></th>
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
                                    <span class="text-gray-600">Pago realizado por: {{ $pago->nombre_titular }}</span>
                                </td>
                                <td class="px-4 py-3">
                                    @switch( $pago->status )
                                        @case(1)
                                            <span
                                            class="inline-flex items-center gap-1 rounded-full bg-amber-50 px-2 py-1 font-semibold text-amber-600">
                                            <span class="h-1.5 w-1.5 rounded-full bg-amber-600"></span>
                                            Por conciliar
                                            </span>
                                            @break
                                        @case(2)
                                            <span
                                            class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 font-semibold text-green-600">
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
                                    <span class="text-gray-600">{{ Str::ucfirst($pago->plataforma_pago) }}</span>
                                </td>
                                <td class="px-4 py-3">
                                    <p class="font-bold flex justify-center items-center text-gray-700 pr-4 text-sm">{{ $pago->monto_equivalente }} <span class="text-gray-500 text-xxs ml-2">USD</span></p>
                                </td>
                                <td class="px-4 py-3">
                                    <p class="text-gray-700">{{ $pago->fecha_pago->format('d-m-Y') }}</p>
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
                                                <li><a class="p-2 block hover:text-blue-500 hover:bg-blue-50" href="{{ route('factura', $pago->factura) }}">Ver Factura</a></li>
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
