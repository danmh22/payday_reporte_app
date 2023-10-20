<div class="w-full py-4 pr-4">
    @if ($errors->any())
        <div class="py-2 px-2 rounded border bg-red-50 text-red-600 text-xs mb-2 font-semibold tracking-wider" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('status'))
        <div class="py-2 px-2 rounded border bg-red-50 text-red-600 text-xs mb-2 font-semibold tracking-wider" role="alert">
            {{ session('status') }}
        </div>
    @endif
    @if (session('success'))
        <div class="py-2 px-2 rounded border bg-green-50 text-green-600 text-xs mb-2 font-semibold tracking-wider" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="rounded shadow bg-white p-6">
    <h2 class="text-lg font-bold text-gray-800">Crea una nueva factura para un aliado comercial</h2>
    <p class="text-sm mb-4 mt-2 text-gray-500">Completa los campos del siguiente formulario para crear una nueva factura:</p>
        <form action="{{ route('facturas.store') }}" method="post" class="flex flex-wrap">
            @csrf
            @method('POST')
            <div class="w-4/6 mb-4 pr-4">
                <label for="concepto" class="block text-xs font-bold leading-6 text-gray-500">Concepto de la factura</label>
                <div class="mt-2">
                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                    <input type="text" name="concepto" id="concepto" autocomplete="concepto" class="block flex-1 border-0 bg-transparent py-1.5 pl-2 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Mensualidad de Enero">
                </div>
                </div>
            </div>
            
            <div class="w-2/6 mb-4 pr-4">
            <label for="monto_deudor" class="block w-full text-xs font-bold leading-6 text-gray-500">Monto</label>
            <div class="mt-2 w-full">
                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                    <input type="number" step="any" name="monto_deudor" id="monto_deudor" autocomplete="monto_deudor" class="block flex-1 border-0 bg-transparent py-1.5 pl-2 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="300,00">
                </div>
                </div>
            </div>
            
            <div class="w-2/6 mb-4 pr-4">
                <label for="categoria" class="block w-full text-xs font-bold leading-6 text-gray-500">Categoría</label>
                <div class="mt-2 w-full">
                    <select id="categoria" name="categoria" autocomplete="categoria" class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                        <option>Mensualidad</option>
                        <option>Gastos Generales</option>
                        <option>Otros</option>
                    </select>
                </div>
            </div>
            
            <div class="w-4/6 mb-4 pr-4">
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


            <div class="w-full">
                <button type="submit" class="px-3 py-2 font-bold text-sm bg-blue-700 transition-all hover:bg-indigo-700 rounded block text-white w-1/4 mt-4">Crear Factura</button>
            </div>

        </form>
    </div>
</div>