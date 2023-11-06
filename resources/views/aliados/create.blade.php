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
    <h2 class="text-lg font-bold text-gray-800">Crea un nuevo aliado comercial</h2>
    <p class="text-sm mb-4 mt-2 text-gray-500">Completa los campos del siguiente formulario para crear un nuevo aliado comercial:</p>
        <form action="{{ route('aliados.store') }}" method="post" class="flex flex-wrap">
            @csrf
            @method('POST')
            <div class="w-4/6 mb-4 pr-4">
                <label for="nombre_aliado" class="block text-xs font-bold leading-6 text-gray-500">Nombre del Aliado Comercial</label>
                <div class="mt-2">
                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                    <input type="text" name="nombre_aliado" id="nombre_aliado" autocomplete="nombre_aliado" class="block flex-1 border-0 bg-transparent py-1.5 pl-2 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Inversiones Simón 123">
                </div>
                </div>
            </div>

            <div class="w-2/6 mb-4 pr-4">
                <label for="codigo_aliado" class="block text-xs font-bold leading-6 text-gray-500">Código del Aliado</label>
                <div class="mt-2">
                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                    <input type="text" name="codigo_aliado" id="codigo_aliado" autocomplete="codigo_aliado" class="block flex-1 border-0 bg-transparent py-1.5 pl-2 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="cod-123">
                </div>
                </div>
            </div>

            <div class="w-full">
                <button type="submit" class="px-3 py-2 font-bold text-sm bg-emerald-700 rounded block text-white w-1/4 mt-4 transition-all hover:bg-emerald-600">Crear Aliado</button>
            </div>

        </form>
    </div>
</div>