<div class="w-full py-4 pr-4">
    <div class="rounded shadow bg-white p-6">
    <h2 class="text-lg font-bold text-gray-800">Crea una nueva factura para un aliado comercial</h2>
    <p class="text-sm mb-4 mt-2 text-gray-500">Completa los campos del siguiente formulario para crear una nueva factura:</p>
        <form action="{{ route('facturas.store') }}" method="post" class="flex flex-wrap">
            @csrf
            @method('POST')
            
            <div class="w-3/6 mb-4 pr-4">
                <label for="aliado" class="block w-full text-xs font-bold leading-6 text-gray-500">Selecciona un aliado comercial</label>
                <div class="mt-2 w-full">
                    <select id="aliado" name="aliado" autocomplete="aliado" class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-full sm:text-sm sm:leading-6">
                        <option>Seleccionar</option>
                        @foreach ($aliados as $aliado)
                            <option value="{{ $aliado->codigo_aliado }}">{{ $aliado->nombre_aliado }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="w-3/6 mb-4 pr-4">
                <label for="concepto" class="block text-xs font-bold leading-6 text-gray-500">Concepto de la factura</label>
                <div class="mt-2">
                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                    <input type="text" name="concepto" id="concepto" autocomplete="concepto" class="block flex-1 border-0 bg-transparent py-1.5 pl-2 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Mensualidad de Enero">
                </div>
                </div>
            </div>
            
            <div class="w-2/6 mb-4 pr-4">
                <label for="categoria" class="block w-full text-xs font-bold leading-6 text-gray-500">Categoría</label>
                <div class="mt-2 w-full">
                    <select id="categoria" name="categoria" autocomplete="categoria" class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                        <option>Alquiler</option>
                        <option>Parking</option>
                        <option>Gastos Comunes</option>
                        <option>Gastos No Comunes</option>
                        <option>Reembolsables</option>
                        <option>Condominios</option>
                    </select>
                </div>
            </div>
            
            <div class="w-2/6 mb-4 pr-4">
            <label for="monto_dolar" class="block w-full text-xs font-bold leading-6 text-gray-500">Monto en USD</label>
            <div class="mt-2 w-full">
                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                    <input type="number" step="any" name="monto_dolar" id="monto_dolar" autocomplete="monto_dolar" class="block flex-1 border-0 bg-transparent py-1.5 pl-2 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="300,00">
                </div>
                </div>
            </div>
            
            <div class="w-2/6 mb-4 pr-4">
            <label for="monto_original_b" class="block w-full text-xs font-bold leading-6 text-gray-500">Monto en Bs</label>
            <div class="mt-2 w-full">
                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                    <input type="number" step="any" name="monto_original_b" id="monto_original_b" autocomplete="monto_original_b" class="block flex-1 border-0 bg-transparent py-1.5 pl-2 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="10,000,00">
                </div>
                </div>
            </div>


            <div class="w-full">
                <button type="submit" class="px-3 py-2 font-bold text-sm bg-emerald-700 transition-all hover:bg-emerald-600 rounded block text-white w-1/4 mt-4">Crear Factura</button>
            </div>

        </form>
    </div>
</div>