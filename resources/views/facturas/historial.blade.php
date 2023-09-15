@extends('layouts.template')

@section('title', 'Historial de facturas')

@section('header_section')

    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Historial de Pagos Realizados</h1>

@endsection()

@section('content')

    <main>
        <div class="flex flex-wrap mx-auto py-4 pt-0">
            <div class="w-full py-4">
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
                            <tr class="hover:bg-gray-50">
                            <th class="px-4 gap-3">
                                <span class="flex justify-center items-center p-2 p-2 rounded bg-blue-100 text-blue-600 w-8 h-8">5</span>
                            </th>
                            <td class="px-4 py-3">
                                <span class="text-gray-700">Mensualidad</span>
                                <p>Agosto</p>
                            </td>
                            <td class="px-4 py-3">
                                <span
                                class="inline-flex items-center gap-1 rounded-full bg-amber-50 px-2 py-1 text-xxs font-semibold text-amber-600">
                                <span class="h-1.5 w-1.5 rounded-full bg-amber-600"></span>
                                Por conciliar
                            </span>
                            </td>
                            <td class="px-4 py-3 font-normal text-gray-900">
                                <div class="text-xs">
                                    <div class="font-medium text-gray-700">10/08/2023</div>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <span class="text-gray-700">Transferencia</span>
                                <p>Banesco</p>
                            </td>
                            <td class="px-4 py-3">
                                <span class="text-gray-700">300,00 USD</span>
                                <p class="mt-1 truncate text-xxs leading-5 text-gray-500">Ref: 01020552321</p>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex justify-end gap-4">
                                <a x-data="{ tooltip: 'Ver Factura' }" href="/factura">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="h-4 w-4"
                                    x-tooltip="tooltip"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                </a>
                                <a x-data="{ tooltip: 'Editar Factura' }" href="#">
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

                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection()
