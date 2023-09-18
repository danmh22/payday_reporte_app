@extends('layouts.template')

@section('title', 'Facturas por Reportar')

@section('header_section')

    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Facturas Pendientes</h1>

@endsection()

@section('content')

    <main>
        <div class="flex flex-wrap mx-auto py-4 pt-0">
            <div class="w-3/4 py-4">
                <div class="overflow-x-auto rounded border border-gray-200">
                    <div class="w-full">
                        <table class="w-full border-collapse bg-white text-left text-xs text-gray-500">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 py-3 font-medium text-gray-900">ID</th>
                                <th scope="col" class="px-4 py-3 font-medium text-gray-900">Concepto</th>
                                <th scope="col" class="px-4 py-3 font-medium text-gray-900">Monto a pagar</th>
                                <th scope="col" class="px-4 py-3 font-medium text-gray-900">Fecha de creado</th>
                                <th scope="col" class="px-4 py-3 font-medium text-gray-900"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 border-t border-gray-100 text-xs">
                            @foreach ($facturas_pendientes as $facturasP)

                            <tr class="hover:bg-gray-50">
                                <th class="px-4 gap-3">
                                <span class="flex justify-center items-center p-2 p-2 rounded bg-blue-100 text-blue-600 w-8 h-8">{{ $facturasP->id }}</span>
                            </th>
                            <td class="px-4 py-3 max-w-[150px]">
                                <span class="text-gray-700">{{ $facturasP->concepto }}</span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="text-gray-700">{{ $facturasP->monto_deudor }} USD</span>
                            </td>
                            <td class="px-4 py-3 font-normal text-gray-900">
                                <div class="text-xs">
                                    <div class="font-medium text-gray-700">{{ $facturasP->created_at->format('d/m/Y') }}</div>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex justify-end gap-4">
                                    <a href="{{ route('reportar-pago', $facturasP) }}" class="bg-blue-700 p-2 text-white text-xs rounded">Reportar pago</a>
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
    </main>

@endsection()
