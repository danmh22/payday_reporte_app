<div class="bg-white flex flex-wrap text-center mb-4 rounded overflow-hidden">
    <div class="w-full flex flex-wrap justify-between items-start border border-b-0 px-4 pt-4 pb-2">
        <div class="flex w-1/2 flex-col text-left">
            <p class="text-base font-bold text-emerald-700 hover:text-emerald-600 transition-all mb-1"><a href="{{ route('factura', $factura) }}">Factura #{{ $factura->id }}</a></p>
            <p class="text-xs font-bold text-gray-500">{{ $factura->concepto }}</p>
        </div>
        <div class="w-1/2 text-right">
            @if ($factura->categoria)
                <span
                class="inline-flex items-center gap-1 rounded text-xs bg-teal-50 px-2 py-1 font-semibold text-teal-600">
                {{ $factura->categoria }}
                </span>
            @else
                Not found
            @endif
        </div>
    </div>
    <div class="w-full flex justify-center items-center border border-b-0 border-t-0 flex-col px-2 py-4">
        <span class="text-sm block text-gray-500 font-bold mb-2">Monto Pendiente:</span>
        <p class="text-2xl text-emerald-700 font-bold">{{ $monto_restante }}<span class="text-xs font-bold ml-2">USD</span></p>
    </div>
    <div class="w-full border border-t-0 border-b-0 px-4 pt-1 pb-3">
        <div class="flex justify-between items-center">
            <span class="text-xs block text-gray-500 font-bold mb-2">Progreso:</span>
            <span class="text-sm block text-gray-500 font-bold mb-2">{{ $progreso_pagos_abonados }}%</span>
        </div>
        <div class="overflow-hidden h-1 mb-2 text-xs flex rounded bg-emerald-200">
            <div style="width: {{ $progreso_pagos_abonados }}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-emerald-600"></div>
        </div>
    </div>
    <div class="w-1/2 flex justify-center items-center border flex-col px-2 py-4">
        <span class="text-xs block text-gray-500 font-bold mb-2">Abonado:</span>
        <p class="text-2xl text-cyan-600 font-bold">{{ $monto_pagos_abonados }}<span class="text-xs font-bold ml-2">USD</span></p>
    </div>
    <div class="w-1/2 flex justify-center items-center border border-l-0 flex-col px-2 py-4">
        <span class="text-xs block text-gray-500 font-bold mb-2">Monto Total:</span>
        <p class="text-2xl text-emerald-700 font-bold">{{ $factura->monto_dolar }}<span class="text-xs font-bold ml-2">USD</span></p>
    </div>
</div>