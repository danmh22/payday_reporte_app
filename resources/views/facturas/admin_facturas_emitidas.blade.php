@extends('layouts.template')

@section('title', 'Facturas Emitidas')

@section('header_section')

    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Facturas Emitidas</h1>

@endsection()

@section('content')

    <main>
        <div class="flex flex-wrap mx-auto py-4 pt-0">
            <div class="w-full py-4">
                @if (session('success'))
                <div class="py-2 px-2 rounded border bg-green-50 text-green-600 text-xs mb-2 font-semibold tracking-wider" role="alert">
                    {{ session('success') }}
                </div>
                @endif
                <div class="overflow-x-auto rounded border border-gray-200">
                    <div class="w-full">
                        <table class="w-full border-collapse bg-white text-left text-xs text-gray-500">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 py-3 font-medium text-gray-900">ID</th>
                                <th scope="col" class="px-4 py-3 font-medium text-gray-900">Aliado Comercial</th>
                                <th scope="col" class="px-4 py-3 font-medium text-gray-900">Concepto</th>
                                <th scope="col" class="px-4 py-3 font-medium text-gray-900">Monto a pagar</th>
                                <th scope="col" class="px-4 py-3 font-medium text-gray-900">Fecha de creado</th>
                                <th scope="col" class="px-4 py-3 font-medium text-gray-900"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 border-t border-gray-100 text-xs">

                            @foreach ($lista_facturas_emitidas as $factura)

                            <tr class="hover:bg-gray-50">
                            <th class="px-4 gap-3">
                                <span class="flex justify-center items-center p-2 p-2 rounded bg-blue-100 text-blue-600 w-8 h-8">{{ $factura->id }}</span>
                            </th>
                            <td class="px-4 py-3 max-w-[130px]">

                                @php
                                    $currentUser = App\Models\User::findOrFail($factura->users_id);
                                @endphp

                                <span class="text-gray-500 font-bold">{{ $currentUser->nombre_aliado }}</span>
                                <p class="mt-1">{{ $currentUser->name }}</p>
                            </td>
                            <td class="px-4 py-3 max-w-[200px]">
                                <span class="text-gray-700">{{ $factura->concepto }}</span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="text-gray-500 font-bold">{{ $factura->monto_deudor }} <span class="ml-1">USD</span></span>
                            </td>
                            <td class="px-4 py-3 font-normal text-gray-900">
                                <div class="text-xs">
                                    <div class="font-medium text-gray-700">{{ $factura->created_at->format('d/m/Y') }}</div>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <a class="px-3 py-2 text-blue-600 border-2 rounded border-blue-600 text-xs hover:bg-blue-600 hover:text-white" x-data="{ tooltip: 'Ver Factura' }" href="{{ route('factura', $factura) }}">Ver Detalle</a>
                            </td>
                            </tr>

                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mt-2">{{ $lista_facturas_emitidas->links() }}</div>
            </div>
        </div>
    </main>

@endsection()
