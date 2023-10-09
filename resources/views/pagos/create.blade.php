@extends('layouts.template')

@section('title', 'Reporta tu pago')

@section('header_section')

    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Reporta el pago de tu factura</h1>

@endsection()

@section('content')

<main>
    <div class="flex flex-wrap mx-auto py-4 pt-0">
        {{-- <div class="sm:w-1/4 py-4 w-full">
            <div class="mb-4">
                <h2 class="text-l font-bold mb-3 text-gray-800">Seleccione una factura</h2>
                <div>
                    <div class="bg-white rounded drop-shadow-lg p-3 mb-3">
                        <div class="flex flex-wrap items-center justify-between rounded p-1">
                            <div class="">
                                <h5 class="text-sm">Mes de Julio</h5>
                                <p class="text-xxs text-gray-500">Monto: 250,00 USD</p>
                            </div>
                            <a href="#" class="bg-blue-700 p-2 text-white text-xs rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
                            </a>
                        </div>
                    </div>
                    <div class="bg-white rounded drop-shadow-lg p-3 mb-3">
                        <div class="flex flex-wrap items-center justify-between rounded p-1">
                            <div class="">
                                <h5 class="text-sm">Mes de Julio</h5>
                                <p class="text-xxs text-gray-500">Monto: 250,00 USD</p>
                            </div>
                            <a href="#" class="bg-blue-700 p-2 text-white text-xs rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="w-2/3 py-4 pr-8">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div class="rounded border bg-white p-4">
            <h2 class="text-lg font-bold text-gray-800">Reporta tu pago</h2>
            <p class="text-xs mb-4 mt-2 text-gray-500">Completa los campos del siguiente formulario para realizar el reporte de tu pago. Ingresa los datos del titular y la información bancaria correspondiente.</p>
                <form action="{{ route('guardar-pago', $factura) }}" method="post" class="flex flex-wrap">
                    @csrf
                    @method('POST')
                    <div class="w-2/4 mb-4 pr-4">
                        <label for="nombre_titular" class="block text-xs font-medium leading-6 text-gray-900">Nombre Títular</label>
                        <div class="mt-2">
                        <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                            <input type="text" name="nombre_titular" id="nombre_titular" autocomplete="nombre_titular" class="block flex-1 border-0 bg-transparent py-1.5 pl-2 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Pedro Pérez">
                        </div>
                        </div>
                    </div>

                    <div class="w-2/4 mb-4 flex flex-wrap pr-4">
                        <label for="dni_usuario" class="block w-full text-xs font-medium leading-6 text-gray-900">Tipo de Documento</label>
                        <div class="mt-2 w-2/6 pr-2">
                            <select id="tipo_documento" name="tipo_documento" autocomplete="tipo_documento" class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <option>V</option>
                                <option>J</option>
                                <option>P</option>
                            </select>
                        </div>
                        <div class="mt-2 w-4/6">
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                            <input type="text" name="num_documento" id="num_documento" autocomplete="num_documento" maxlength="9" onkeypress="return event.charCode>=48 && event.charCode<=57" class="block flex-1 border-0 bg-transparent py-1.5 pl-2 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Nro de Documento">
                            </div>
                        </div>
                    </div>

                    <div class="w-2/5 mb-4 pr-4">
                        <label for="referencia_pago" class="block text-xs font-medium leading-6 text-gray-900">Nro de Referencia</label>
                        <div class="mt-2">
                        <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                            <input type="text" name="referencia_pago" id="referencia_pago" autocomplete="referencia_pago" onkeypress="return event.charCode>=48 && event.charCode<=57" class="block flex-1 border-0 bg-transparent py-1.5 pl-2 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Referencia Bancaria">
                        </div>
                        </div>
                    </div>

                    <div class="w-1/5 mb-4 flex flex-wrap pr-4">
                        <label for="divisa" class="block w-full text-xs font-medium leading-6 text-gray-900">Divisa</label>
                        <div class="mt-2 w-full">
                            <select id="divisa" name="divisa" autocomplete="divisa" class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <option>USD</option>
                                <option>VES</option>
                            </select>
                        </div>
                    </div>

                    <div class="w-2/5 mb-4 flex flex-wrap pr-4">
                        <label for="metodo_pago" class="block w-full text-xs font-medium leading-6 text-gray-900">Método de pago</label>
                        <div class="mt-2 w-full">
                            <select id="metodo_pago" name="metodo_pago" autocomplete="metodo_pago" class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <option>Seleccionar</option>
                                <option>Pago Móvil</option>
                                <option>Transferencia</option>
                                <option>Efectivo</option>
                                <option>Depósito</option>
                            </select>
                        </div>
                    </div>

                    <div class="w-2/6 mb-4 flex flex-wrap pr-4">
                        <label for="plataforma_pago" class="block w-full text-xs font-medium leading-6 text-gray-900">Plataforma de pago</label>
                        <div class="mt-2 w-full">
                            <select id="plataforma_pago" name="plataforma_pago" autocomplete="plataforma_pago" class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <option>Seleccionar</option>
                                <option>Banco de Venezuela</option>
                                <option>Banesco</option>
                                <option>Mercantil</option>
                                <option>Bancamiga</option>
                                <option>Banco del Tesoro</option>
                                <option>Zelle</option>
                                <option>Bank of América</option>
                                <option>Mercantil Panamá</option>
                            </select>
                        </div>
                    </div>

                    <div class="w-2/6 mb-4 flex flex-wrap pr-4">
                    <label for="monto_pago" class="block w-full text-xs font-medium leading-6 text-gray-900">Monto</label>
                    <div class="mt-2 w-full">
                        <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                            <input type="number" name="monto_pago" id="monto_pago" autocomplete="monto_pago" class="block flex-1 border-0 bg-transparent py-1.5 pl-2 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="300,00">
                        </div>
                        </div>
                    </div>

                    <div class="w-2/6 mb-4 flex flex-wrap pr-4">
                    <label for="fecha_pago" class="block w-full text-xs font-medium leading-6 text-gray-900">Fecha de pago</label>
                    <div class="mt-2 w-full">
                        <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                            <input type="date" name="fecha_pago" id="fecha_pago" autocomplete="fecha_pago" class="block flex-1 border-0 bg-transparent py-1.5 pl-2 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="300,00">
                        </div>
                        </div>
                    </div>

                    <input type="hidden" name="status" id="status" autocomplete="status" value="2">

                    <button type="submit" class="px-3 py-2 text-sm !bg-blue-700 rounded block text-white w-1/4 mt-2">Enviar reporte</button>

                </form>
            </div>
        </div>
        <div class="w-1/3 py-4">
            <div class="bg-gradient-to-r border-blue-500 border from-blue-500 to-blue-700 py-8 px-7 text-white rounded">
                <h2 class="text-lg font-bold mb-2">Detalles de la factura</h2>
                <hr class="w-1/4 h-1 bg-white rounded-full mb-3">
                <p class="text-xs mb-2"><strong>Concepto</strong>: {{ $factura->concepto }}</p>
                <p class="text-xs"><strong>Monto</strong>: {{ $factura->monto_deudor }} USD</p>
            </div>
        </div>
    </div>
</main>

@endsection()
