@extends('layouts.template')

@section('title', 'Facturas por Conciliar')

@section('header_section')

    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Facturas por Conciliar</h1>

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
                                    <th scope="col" class="px-4 py-3 font-medium text-gray-900">Aliado Comercial</th>
                                    <th scope="col" class="px-4 py-3 font-medium text-gray-900">Concepto</th>
                                    <th scope="col" class="px-4 py-3 font-medium text-gray-900">Método de pago</th>
                                    <th scope="col" class="px-4 py-3 font-medium text-gray-900">Monto</th>
                                    <th scope="col" class="px-4 py-3 font-medium text-gray-900">Fecha de reporte</th>
                                    <th scope="col" class="px-4 py-3 font-medium text-gray-900"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 border-t border-gray-100 text-xs">

                                @foreach ($lista_facturas_por_conciliar as $factura)

                                {{-- @php
                                    $randomColor = $colorsPalette[array_rand($colorsPalette)];
                                @endphp --}}

                                <tr class="hover:bg-gray-50">
                                <th class="px-4 gap-3">
                                    <span class="flex justify-center items-center p-2 p-2 rounded bg-amber-100 text-amber-600 w-8 h-8">{{ $factura->id }}</span>
                                </th>
                                <td class="px-4 py-3 max-w-[120px]">

                                    @php
                                        $currentUser = App\Models\User::findOrFail($factura->users_id);
                                    @endphp

                                    <span class="text-gray-700">{{ $currentUser->nombre_aliado }}</span>
                                    <p>{{ $currentUser->name }}</p>
                                </td>
                                <td class="px-4 py-3 max-w-[140px]">
                                    <span class="text-gray-700">{{ $factura->concepto }}</span>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="text-gray-700">{{ Str::ucfirst($factura->metodo_pago) }}</span>
                                    <p>{{ $factura->plataforma_pago }}</p>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="text-gray-700">{{ $factura->monto_pago }} {{ $factura->divisa }}</span>
                                    <p class="truncate text-xxs leading-5 text-gray-500">Ref: {{ $factura->referencia_pago }}</p>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="text-xs font-medium text-gray-700">{{ $factura->fecha_pago->format('d/m/y') }}</div>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex justify-end gap-4">
                                        <a class="px-3 py-2 text-blue-600 border-2 rounded border-blue-600 text-xs hover:bg-blue-600 hover:text-white" x-data="{ tooltip: 'Ver Factura' }" href="{{ route('factura', $factura) }}">Ver Detalle</a>
                                        <form action="{{ route('conciliar-pago') }}" method="POST">
                                            @csrf
                                            @method('patch')
                                            <input type="hidden" name="id" value="{{ $factura->id }}">
                                            <button class="px-3 py-2 text-white bg-blue-600 border-2 rounded border-blue-600 text-xs hover:bg-blue-500 hover:border-blue-500">Conciliar Pago</button>
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
    </main>

@endsection()
