@extends('layouts.template')

@section('title', 'Dashboard')

@section('header_section')

            <h1 class="text-2xl font-bold tracking-tight text-gray-900">Bienvenido, Administrador</h1>

@endsection()

@section('content')

    <main>
        <div class="flex flex-wrap mx-auto py-4 pt-0">
            <div class="sm:w-4/6 py-4 pr-4 w-full">
                <div class="flex mb-4">
                    <div class="w-2/6 mr-2 flex items-center justify-start p-3 bg-white border rounded">
                        <span class="bg-green-500 text-white rounded p-1 font-extrabold text-xl mr-2 w-9 h-9 text-center">{{ $total_facturas_conciliadas }}</span>
                        <p class="mb-0 text-xs font-bold text-gray-700">Facturas conciliadas</p>
                    </div>

                    <div class="w-2/6 mr-2 flex items-center justify-start p-3 bg-white border rounded">
                        <span class="bg-amber-400 text-white rounded p-1 font-extrabold text-xl mr-2 w-9 h-9 text-center">{{ $total_facturas_por_conciliar }}</span>
                        <p class="mb-0 text-xs font-bold text-gray-700">Facturas por conciliar</p>
                    </div>

                    <div class="w-2/6 flex items-center justify-start p-3 bg-white border rounded">
                        <span class="bg-blue-700 text-white rounded p-1 font-extrabold text-xl mr-2 w-9 h-9 text-center">{{ $total_facturas_emitidas }}</span>
                        <p class="mb-0 text-xs font-bold text-gray-700">Facturas pendientes</p>
                    </div>
                </div>
                <div class="">
                    <div class="flex justify-between items-center mb-3">
                        <h2 class="text-l font-bold mb-0 text-gray-800">Últimos pagos por conciliar</h2>
                        <a href="{{ route('facturas-conciliar') }}" class="py-2 px-2 rounded text-blue-700 text-xs hover:text-white hover:bg-blue-700">Ver todos</a>
                    </div>
                    <div class="overflow-x-auto rounded border border-gray-200">
                        <div class="w-max max-w-5xl">
                            <table class="w-full border-collapse bg-white text-left text-xs text-gray-500">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-4 py-3 font-medium text-gray-900">ID</th>
                                    <th scope="col" class="px-4 py-3 font-medium text-gray-900">Aliado Comercial</th>
                                    {{-- <th scope="col" class="px-4 py-3 font-medium text-gray-900">Estatus</th> --}}
                                    <th scope="col" class="px-4 py-3 font-medium text-gray-900">Fecha de reporte</th>
                                    <th scope="col" class="px-4 py-3 font-medium text-gray-900">Método de pago</th>
                                    <th scope="col" class="px-4 py-3 font-medium text-gray-900">Monto</th>
                                    <th scope="col" class="px-4 py-3 font-medium text-gray-900"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 border-t border-gray-100 text-xs">

                                @foreach ($lista_facturas_por_conciliar as $facturasC)

                                <tr class="hover:bg-gray-50">
                                <th class="px-4 gap-3">
                                    <span class="flex justify-center items-center p-2 p-2 rounded bg-orange-100 text-orange-600 w-8 h-8">{{ $facturasC->id }}</span>
                                </th>
                                <td class="px-4 py-3 max-w-[200px]">

                                    @php
                                        $currentUser = App\Models\User::findOrFail($facturasC->users_id);
                                    @endphp

                                    <span class="text-gray-700">{{ $currentUser->nombre_aliado }}</span>
                                    <p>{{ $facturasC->concepto }}</p>
                                </td>
                                {{-- <td class="px-4 py-3">
                                    @switch($facturasC->status)
                                        @case(1)
                                        <span
                                        class="inline-flex items-center gap-1 rounded-full bg-red-50 px-2 py-1 text-xxs font-semibold text-red-600">
                                        <span class="h-1.5 w-1.5 rounded-full bg-red-600"></span>
                                        Por pagar
                                        </span>
                                            @break
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
                                        Pagado
                                        </span>
                                            @break
                                        @default
                                        Not found
                                    @endswitch

                                </td> --}}
                                <td class="px-4 py-3">
                                    <div class="text-xs font-medium text-gray-700">{{ $facturasC->fecha_pago->format('d-m-Y') }}</div>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="text-gray-700">{{ Str::ucfirst($facturasC->metodo_pago) }}</span>
                                    <p class="mt-1 truncate text-xxs leading-5 text-gray-500">{{ $facturasC->plataforma_pago }}</p>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="text-gray-700">{{ $facturasC->monto_pago }} {{ $facturasC->divisa }}</span>
                                    <p class="mt-1 truncate text-xxs leading-5 text-gray-500">Ref: {{ $facturasC->referencia_pago }}</p>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex justify-end gap-4">
                                        <a class="px-2 py-2 text-blue-600 border-2 rounded border-blue-600 text-xs hover:bg-blue-600 hover:text-white" x-data="{ tooltip: 'Ver Factura' }" href="{{ route('factura', $facturasC) }}">Ver Detalle</a>
                                        <form action="{{ route('conciliar-pago') }}" method="POST">
                                            @csrf
                                            @method('patch')
                                            <input type="hidden" name="id" value="{{ $facturasC->id }}">
                                            <button class="px-2 py-2 text-white bg-blue-600 border-2 rounded border-blue-600 text-xs hover:bg-blue-500 hover:border-blue-500">Conciliar Pago</button>
                                        </form>
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
                <div class="bg-gradient-to-r from-green-500 to-green-600 py-6 px-7 text-white rounded mb-3">
                    <span class="text-xs mb-3 rounded text-white font-bold inline-block">Total recaudado este mes</span>
                    <h2 class="text-2xl font-bold mb-4 flex items-center justify-start"><div class="bg-green-50 p-1 rounded flex items-center justify-center w-9 h-9 mr-2"><span class="material-symbols-outlined text-green-500">monitoring</span></div> ${{ number_format($monto_conciliados_final) }}</h2>
                    <div class="overflow-hidden h-1 mb-2 text-xs flex rounded bg-gray-200">
                        <div style="width: 60%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-green-600"></div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-blue-500 to-blue-600 py-6 px-7 text-white rounded">
                    <span class="text-xs mb-3 rounded text-white font-bold inline-block">Total por recaudar este mes</span>
                    <h2 class="text-2xl font-bold mb-4 flex items-center justify-start"><div class="bg-blue-50 p-1 rounded flex items-center justify-center w-9 h-9 mr-2"><span class="material-symbols-outlined text-blue-500">monitoring</span></div> ${{ number_format($monto_pendiente_final) }}</h2>
                    <div class="overflow-hidden h-1 mb-2 text-xs flex rounded bg-gray-200">
                        <div style="width: 40%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-600"></div>
                    </div>
                </div>
            </div>

        </div>
    </main>

@endsection()
