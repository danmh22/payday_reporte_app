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

                    <div class="overflow-x-auto rounded border border-gray-200">
                        <div class="w-full">
                            <table class="w-full border-collapse bg-white text-left text-xs text-gray-500">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-4 py-3 font-medium text-gray-900"></th>
                                    <th scope="col" class="px-4 py-3 font-medium text-gray-900">Concepto</th>
                                    <th scope="col" class="px-4 py-3 font-medium text-gray-900">Categoria</th>
                                    <th scope="col" class="px-4 py-3 font-medium text-gray-900">Monto a pagar</th>
                                    <th scope="col" class="px-4 py-3 font-medium text-gray-900">Fecha de creado</th>
                                    <th scope="col" class="px-4 py-3 font-medium text-gray-900"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 border-t border-gray-100 text-xs">
                                @foreach ($facturas_pendientes as $facturasP)

                                <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3">
                                    <div class="w-8 h-8 text-blue-500"><span class="material-symbols-outlined">receipt_long</span></div>
                                </td>
                                <td class="px-4 py-3 max-w-[150px]">
                                    <span class="text-gray-600 font-bold">{{ $facturasP->concepto }}</span>
                                </td>
                                <td class="px-4 py-3">
                                    @switch( $facturasP->categoria )
                                        @case('Gastos Generales')
                                            <span
                                            class="inline-flex items-center gap-1 rounded bg-violet-50 px-2 py-1 font-semibold text-violet-600">
                                            
                                            Gastos Generales
                                            </span>
                                            @break
                                        @case('Mensualidad')
                                            <span
                                            class="inline-flex items-center gap-1 rounded bg-emerald-50 px-2 py-1 font-semibold text-emerald-600">
                                            
                                            Mensualidad
                                            </span>

                                            @break
                                        @case('Otros')
                                                <span
                                                class="inline-flex items-center gap-1 rounded bg-amber-50 px-2 py-1 font-semibold text-amber-600">
                                                
                                                Otros
                                                </span>
    
                                                @break
                                        @default
                                            Not found
                                    @endswitch
                                </td>
                                <td class="px-4 py-3">
                                    <p class="font-bold flex justify-center items-center text-gray-700 pr-4 text-sm">{{ $facturasP->monto_deudor }} <span class="text-gray-500 text-xxs ml-2">USD</span></p>
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
                    <div class="mt-3">
                        {{ $facturas_pendientes->links() }}
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
