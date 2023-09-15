@extends('layouts.template')

@section('title', 'Dashboard')

@section('header_section')

            <h1 class="text-2xl font-bold tracking-tight text-gray-900">Bienvenido, {{ Auth::user()->name }}</h1>

@endsection()

@section('content')

    <main>
        <div class="flex flex-wrap mx-auto py-4 pt-0">
            <div class="sm:w-3/5 py-4 pr-4 w-full">
                <div class="flex mb-4">
                    <div class="w-2/6 mr-2 flex items-center justify-start p-3 bg-white border rounded">
                        <span class="bg-green-500 text-white rounded p-1 font-extrabold text-xl mr-2 w-9 h-9 text-center">{{ $total_facturas_conciliadas }}</span>
                        <p class="mb-0 text-xs font-bold text-gray-700">Facturas conciliadas</p>
                    </div>

                    <div class="w-2/6 mr-2 flex items-center justify-start p-3 bg-white border rounded">
                        <span class="bg-amber-400 text-white rounded p-1 font-extrabold text-xl mr-2 w-9 h-9 text-center">{{ $total_facturas_reportadas }}</span>
                        <p class="mb-0 text-xs font-bold text-gray-700">Facturas por conciliar</p>
                    </div>

                    <div class="w-2/6 flex items-center justify-start p-3 bg-white border rounded">
                        <span class="bg-blue-700 text-white rounded p-1 font-extrabold text-xl mr-2 w-9 h-9 text-center">{{ $total_facturas_pendientes }}</span>
                        <p class="mb-0 text-xs font-bold text-gray-700">Facturas pendientes</p>
                    </div>
                </div>
                <div class="">
                    <div class="flex justify-between items-center mb-3">
                        <h2 class="text-l font-bold mb-0 text-gray-800">Últimos pagos realizados</h2>
                        <a href="#" class="py-2 px-2 rounded text-blue-700 text-xs hover:text-white hover:bg-blue-700">Ver todos</a>
                    </div>
                    <div class="overflow-x-auto rounded border border-gray-200">
                        <div class="w-max max-w-5xl">
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

                                @foreach ($facturas_reportadas as $facturaR)

                                <tr class="hover:bg-gray-50">
                                <th class="px-4 gap-3">
                                    <span class="flex justify-center items-center p-2 p-2 rounded bg-blue-100 text-blue-600 w-8 h-8">{{ $facturaR->id }}</span>
                                </th>
                                <td class="px-4 py-3">
                                    <span class="text-gray-700">{{ $facturaR->concepto }}</span>
                                </td>
                                <td class="px-4 py-3">
                                    @switch($facturaR->status)
                                        @case(2)
                                            <span
                                            class="inline-flex items-center gap-1 rounded-full bg-amber-50 px-2 py-1 text-xxs font-semibold text-amber-600">
                                            <span class="h-1.5 w-1.5 rounded-full bg-amber-600"></span>
                                            Por conciliar
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
                                    <div class="font-medium text-gray-700 text-xs">{{ $facturaR->fecha_pago->format('d/m/Y') }}</div>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="text-gray-700">{{ $facturaR->metodo_pago }}</span>
                                    <p>{{ $facturaR->plataforma_pago }}</p>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="text-gray-700">{{ $facturaR->monto_pago }} {{ $facturaR->divisa }}</span>
                                    <p class="mt-1 truncate text-xxs leading-5 text-gray-500">Ref: {{ $facturaR->referencia_pago }}</p>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex justify-end gap-4">
                                    <a x-data="{ tooltip: 'Delete' }" href="#">
                                        <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="h-4 w-4"
                                        x-tooltip="tooltip"
                                        >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                                        />
                                        </svg>
                                    </a>
                                    <a x-data="{ tooltip: 'Edite' }" href="#">
                                        <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="h-4 w-4"
                                        x-tooltip="tooltip"
                                        >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"
                                        />
                                        </svg>
                                    </a>
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
            <div class="sm:w-2/5 py-4 sm:px-4 lg:px-4 w-full">
                <div class="mb-4">
                    <h2 class="text-l font-bold mb-3 text-gray-800">Facturas pendientes</h2>
                    <div class="">

                        @foreach ($facturas_pendientes as $facturasP)

                        <div class="flex flex-wrap items-center justify-between border border-gray-200 rounded bg-white p-4 mb-2">
                            <div class="w-4/6">
                                <h5 class="text-sm">{{ $facturasP->concepto }}</h5>
                                <p class="text-xxs text-gray-500">Monto: {{ $facturasP->monto_deudor }} USD</p>
                            </div>
                            <a href="/reportar-pago" class="w-2/6 bg-blue-700 p-2 text-white text-xs rounded text-center">Reportar pago</a>
                        </div>

                        @endforeach

                    </div>
                </div>
                <div class="bg-gradient-to-r from-blue-500 to-blue-700 py-8 px-7 text-white rounded">
                    <span class="text-xs bg-blue-50 mb-3 rounded text-blue-700 p-1 px-2 font-bold inline-block">Anuncio</span>
                    <h2 class="text-lg font-bold mb-3">Recuerda reportar el pago de tus facturas a tiempo</h2>
                    <p class="text-sm">Cuando cancelas tus facturas dentro del plazo corresponiente y realizas tus reportes a través de la aplicación estás contribuyendo a la prestación de un servicio más eficiente</p>
                </div>
            </div>

        </div>
    </main>

@endsection()
