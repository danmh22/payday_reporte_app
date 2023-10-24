@extends('layouts.template')

@section('title', 'Carga una nueva factura')

@section('header_section')

    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Envía facturas a tus aliados comerciales</h1>

@endsection()

@section('content')

<main>
    <div class="flex flex-wrap mx-auto py-4 pt-0">
        <div class="w-4/6 flex flex-wrap">
            @if ($errors->any())
                <div class="py-2 px-4 rounded shadow w-2/3 bg-red-50 text-red-600 text-xs mb-1 font-semibold tracking-wider" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('status'))
                <div class="py-2 px-4 rounded shadow w-2/3 bg-red-50 text-red-600 text-xs mb-1 font-semibold tracking-wider" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            @if (session('success'))
                <div class="py-2 px-4 rounded shadow w-2/3 bg-green-50 text-green-600 text-xs mb-1 font-semibold tracking-wider" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="w-full py-4 pr-4">
                <div class="rounded shadow bg-white p-6">
                    <h2 class="text-lg font-bold text-gray-800">Carga un nuevo listado de facturas</h2>
                    <p class="text-sm mb-4 mt-2 text-gray-500">Descarga el formato para la carga de facturas, rellena sus campos con los datos solicitados y carga un nuevo listado de facturas para tus aliados comerciales:</p>
                    <div class="flex items-center mt-2">
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
                            <button type="submit" class="px-3 py-2 text-sm bg-blue-700 transition-all hover:bg-indigo-700 rounded block text-white ml-4 w-1/4 font-bold">Cargar Facturas</button>
                        </form>
                    </div>
                </div>
            </div>
            @include('facturas.create')
        </div>
        
        <div class="w-full sm:w-2/6 py-4 sm:px-4 lg:px-4">
            <div class="shadow bg-gradient-to-r from-blue-500 to-blue-700 py-7 px-7 text-white rounded">
                <div class="flex flex-wrap">
                    <div class="w-1/6">
                        <span class="flex justify-center items-center h-8 w-8 bg-white text-blue-500 rounded-full p-2 mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 15v4c0 1.1.9 2 2 2h14a2 2 0 0 0 2-2v-4M17 9l-5 5-5-5M12 12.8V2.5"/></svg>
                        </span>
                    </div>
                    <h2 class="w-5/6 font-bold mb-3">Descarga el formato para cargar facturas</h2>
                </div>
                <p class="text-white text-sm mb-3">Asegurate de usar el formato correcto para la carga de facturas.</p>
                <a href="{{ asset('downloadable/formato_carga_facturas.xlsx') }}" download="Formato para carga de Facturas" class="px-3 py-2 text-center text-sm bg-white transition-all hover:bg-blue-700 hover:text-white rounded block text-blue-500 w-full font-bold">Descargar formato</a>
            </div>
        </div>
    </div>
</main>

@endsection()
