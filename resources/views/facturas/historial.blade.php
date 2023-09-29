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
                                <th scope="col" class="px-4 py-3 font-medium text-gray-900">ID</th>
                                <th scope="col" class="px-4 py-3 font-medium text-gray-900">Concepto</th>
                                <th scope="col" class="px-4 py-3 font-medium text-gray-900">Estatus</th>
                                <th scope="col" class="px-4 py-3 font-medium text-gray-900">Fecha de reporte</th>
                                <th scope="col" class="px-4 py-3 font-medium text-gray-900">Método de pago</th>
                                <th scope="col" class="px-4 py-3 font-medium text-gray-900">Monto</th>
                                <th scope="col" class="px-4 py-3 font-medium text-gray-900"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 border-t border-gray-100 text-xs">

                            @foreach ($facturas_reportadas as $factura)

                            <tr class="hover:bg-gray-50">
                            <th class="px-4 gap-3">
                                <span class="flex justify-center items-center p-2 p-2 rounded bg-blue-100 text-blue-600 w-8 h-8">{{ $factura->id }}</span>
                            </th>
                            <td class="px-4 py-3">
                                <span class="text-gray-700">{{ $factura->concepto }}</span>
                            </td>
                            <td class="px-4 py-3">
                                @switch( $factura->status )
                                    @case(2)
                                        <span
                                        class="inline-flex items-center gap-1 rounded-full bg-amber-50 px-2 py-1 text-xxs font-semibold text-amber-600">
                                        <span class="h-1.5 w-1.5 rounded-full bg-amber-600"></span>
                                        Por conciliar
                                        </span>
                                        @break
                                    @case(3)
                                        <span
                                        class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xxs font-semibold text-green-600">
                                        <span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>
                                        Conciliadas
                                        </span>

                                        @break
                                    @default
                                        Not found
                                @endswitch
                            </td>
                            <td class="px-4 py-3 font-normal text-gray-900">
                                <div class="text-xs">
                                    <div class="font-medium text-gray-700">{{ $factura->fecha_pago->format('d/m/Y') }}</div>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <span class="text-gray-700">{{ Str::ucfirst($factura->metodo_pago) }}</span>
                                <p>{{ $factura->plataforma_pago }}</p>
                            </td>
                            <td class="px-4 py-3">
                                <span class="text-gray-700">{{ $factura->monto_pago }} {{ $factura->divisa }}</span>
                                <p class="mt-1 truncate text-xxs leading-5 text-gray-500">Ref: {{ $factura->referencia_pago }}</p>
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
                                            <li><a class="p-2 block hover:text-blue-500 hover:bg-blue-50" href="{{ route('factura', $factura) }}">Ver Factura</a></li>
                                        @if ($factura->status < 3)
                                            <li><a class="p-2 block hover:text-blue-500 hover:bg-blue-50" href="">Editar Factura</a></li>
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
                <div class="mt-3">
                    {{ $facturas_reportadas->links() }}
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
