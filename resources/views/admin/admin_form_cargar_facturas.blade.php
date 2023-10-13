@extends('layouts.template')

@section('title', 'Carga una nueva factura')

@section('header_section')

    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Envía facturas a tus aliados comerciales</h1>

@endsection()

@section('content')

<main>
    <div class="flex flex-wrap mx-auto py-4 pt-0">
        <div class="w-4/6 py-4 pr-4">
            <div class="rounded border bg-white p-4">
                <h2 class="text-lg font-bold text-gray-800">Carga un nuevo listado de facturas</h2>
                <p class="text-sm mb-4 mt-2 text-gray-500">Descarga el formato para la carga de facturas, rellena sus campos con los datos solicitados y carga un nuevo listado de facturas para tus aliados comerciales:</p>
                <div class="flex items-center mt-2">
                    @if (isset($errors) && $errors->any())

                    <div class="alert alert-danger" role="alert">
                        @foreach ($errors->all() as $error)
                        {{ $error }}
                        @endforeach
                    </div>

                    @endif
                    <form action="{{ route('importar-facturas') }}" method="POST" enctype="multipart/form-data" class="flex flex-wrap w-full">
                        @csrf
                        <label class="block">
                            <span class="sr-only">Sube un listado de facturas</span>
                            <input type="file" name="lote_facturas" class="block w-full text-sm text-slate-500
                                file:py-2 file:px-4
                            file:rounded file:border-0
                            file:text-sm file:font-semibold
                            file:bg-cyan-50 file:text-cyan-700
                            hover:file:bg-cyan-100
                            "/>
                        </label>
                        <button type="submit" class="px-3 py-2 text-sm !bg-blue-700 rounded block text-white ml-4 w-1/4 font-bold">Cargar Facturas</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="w-full sm:w-2/6 py-4 sm:px-4 lg:px-4">
            <div class="bg-gradient-to-r from-blue-500 to-blue-700 py-7 px-7 text-white rounded">
                <div class="flex flex-wrap">
                    <div class="w-1/6">
                        <span class="flex justify-center items-center h-8 w-8 bg-white text-blue-500 rounded-full p-2 mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 15v4c0 1.1.9 2 2 2h14a2 2 0 0 0 2-2v-4M17 9l-5 5-5-5M12 12.8V2.5"/></svg>
                        </span>
                    </div>
                    <h2 class="w-5/6 font-bold mb-3">Descarga el formato para cargar facturas</h2>
                </div>
                <p class="text-white text-sm mb-3">Asegurate de usar el formato correcto para la carga de facturas.</p>
                <a href="{{ asset('downloadable/formato_carga_facturas.xlsx') }}" download="Formato para carga de Facturas" class="px-3 py-2 text-center text-sm bg-white rounded block text-blue-500 w-full font-bold">Descargar formato</a>
            </div>
        </div>
        <div class="w-4/6 py-4 pr-4">
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
            <div class="rounded border bg-white p-6">
            <h2 class="text-lg font-bold text-gray-800">Crea una nueva factura para un aliado comercial</h2>
            <p class="text-sm mb-4 mt-2 text-gray-500">Completa los campos del siguiente formulario para crear una nueva factura:</p>
                <form action="" method="post" class="flex flex-wrap">
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
                        <button type="submit" class="px-3 py-2 font-bold text-sm !bg-blue-700 rounded block text-white w-1/4 mt-4">Crear Factura</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</main>

@endsection()
