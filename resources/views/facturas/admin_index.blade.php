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
                        <span class="bg-green-500 text-white rounded p-1 font-extrabold text-lg mr-2 w-9 h-9 text-center">{{ $total_facturas_conciliadas }}</span>
                        <p class="mb-0 text-xs font-bold text-gray-700">Facturas conciliadas</p>
                    </div>

                    <div class="w-2/6 mr-2 flex items-center justify-start p-3 bg-white border rounded">
                        <span class="bg-amber-400 text-white rounded p-1 font-extrabold text-lg mr-2 w-9 h-9 text-center">{{ $total_facturas_por_conciliar }}</span>
                        <p class="mb-0 text-xs font-bold text-gray-700">Facturas por conciliar</p>
                    </div>

                    <div class="w-2/6 flex items-center justify-start p-3 bg-white border rounded">
                        <span class="bg-blue-500 text-white rounded p-1 font-extrabold text-lg mr-2 w-9 h-9 text-center">{{ $total_facturas_emitidas }}</span>
                        <p class="mb-0 text-xs font-bold text-gray-700">Facturas pendientes</p>
                    </div>
                </div>
                <div class="">
                    <div class="flex justify-between items-center mb-3">
                        <h2 class="text-l font-bold mb-0 text-gray-800">Últimos pagos por conciliar</h2>
                        <a href="{{ route('facturas-conciliar') }}" class="py-2 px-2 rounded text-blue-700 text-xs font-bold hover:text-white hover:bg-blue-700">Ver todos</a>
                    </div>
                    <div class="overflow-x-auto rounded border border-gray-200">
                        <div class="w-full">
                            <table class="w-full border-collapse bg-white text-left text-xs text-gray-500">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-4 py-3 font-medium text-gray-900">ID</th>
                                    <th scope="col" class="px-4 py-3 font-medium text-gray-900">Aliado Comercial</th>
                                    <th scope="col" class="px-4 py-3 font-medium text-gray-900">Método de pago</th>
                                    <th scope="col" class="px-4 py-3 font-medium text-gray-900">Fecha de reporte</th>
                                    <th scope="col" class="px-4 py-3 font-medium text-gray-900"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 border-t border-gray-100 text-xs">

                                @foreach ($lista_facturas_por_conciliar as $facturasC)

                                <tr class="hover:bg-gray-50">
                                <th class="px-4 gap-3">
                                    <span class="flex justify-center items-center font-bold p-2 p-2 rounded bg-blue-50 text-blue-600 w-8 h-8">{{ $facturasC->id }}</span>
                                </th>
                                <td class="px-4 py-3 max-w-[180px]">

                                    @php
                                        $currentUser = App\Models\User::findOrFail($facturasC->users_id);
                                    @endphp

                                    <span class="text-gray-500 font-bold">{{ $currentUser->nombre_aliado }}</span>
                                    <p class="truncate text-xxs leading-5 text-gray-500">{{ $facturasC->concepto }}</p>
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
                                <td class="px-4 py-3 max-w-[150px]">
                                    <span class="text-gray-500 font-bold">{{ $facturasC->monto_pago }} {{ $facturasC->divisa }}</span>
                                    <p class="truncate text-xxs leading-5 text-gray-500">{{ Str::ucfirst($facturasC->metodo_pago) }}: {{ $facturasC->plataforma_pago }}</p>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="text-xs font-medium text-gray-600">{{ $facturasC->fecha_pago->format('d/m/Y') }}</div>
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
                                                <li><a class="p-2 block hover:text-blue-500 hover:bg-blue-50" href="{{ route('factura', $facturasC) }}">Ver Factura</a></li>
                                            @if ($facturasC->status < 3)
                                                <li>
                                                    <form action="{{ route('conciliar-pago') }}" method="POST">
                                                        @csrf
                                                        @method('patch')
                                                        <input type="hidden" name="id" value="{{ $facturasC->id }}">
                                                        <button class="p-2 text-left block w-full hover:text-blue-500 hover:bg-blue-50">Conciliar Pago</button>
                                                    </form>
                                                </li>
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
                </div>
            </div>

            <div class="sm:w-2/6 py-4 sm:px-4 lg:px-4 w-full">
                <div class="bg-gradient-to-r from-green-300 to-green-300 border border-green-200 py-6 px-7 text-white rounded mb-3">
                    <span class="text-xs mb-3 rounded text-gray-600 font-bold inline-block">Total recaudado este mes</span>
                    <h2 class="text-2xl text-gray-700 font-bold mb-4 flex items-center justify-start"><div class="bg-green-600 p-1 rounded flex items-center justify-center w-9 h-9 mr-2"><span class="material-symbols-outlined text-white">monitoring</span></div> ${{ number_format($monto_conciliados_final) }}</h2>
                    <div class="overflow-hidden h-1 mb-2 text-xs flex rounded bg-white">
                        <div style="width: 60%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-green-600"></div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-blue-300 to-blue-300 border border-blue-200 py-6 px-7 text-white rounded">
                    <span class="text-xs mb-3 rounded text-gray-600 font-bold inline-block">Total por recaudar este mes</span>
                    <h2 class="text-2xl text-gray-700 font-bold mb-4 flex items-center justify-start"><div class="bg-blue-600 p-1 rounded flex items-center justify-center w-9 h-9 mr-2"><span class="material-symbols-outlined text-white">monitoring</span></div> ${{ number_format($monto_pendiente_final) }}</h2>
                    <div class="overflow-hidden h-1 mb-2 text-xs flex rounded bg-white">
                        <div style="width: 40%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-600"></div>
                    </div>
                </div>
            </div>

        </div>
    </main>

@endsection()
