@extends('layouts.template')

@section('title', 'Usuarios')

@section('header_section')

    <div class="flex justify-between items-center w-5/6">
        <h1 class="text-2xl font-bold tracking-tight text-gray-900">Listado de Aliados Comerciales</h1>
        <a href="{{ route('cargar-aliados') }}" class="px-3 py-2 font-bold text-sm bg-emerald-700 rounded block text-white mt-4 tracking-wider transition-all hover:bg-emerald-600">Crear Aliado</a>
    </div>

@endsection()

@section('content')

    <main>
        <div class="flex flex-wrap mx-auto py-4 pt-0">
            <div class="w-5/6 py-4">
                <div class="overflow-x-auto rounded shadow border-gray-200">
                    <div class="w-full">
                        <table class="w-full border-collapse bg-white text-left text-xs text-gray-500">
                        <thead class="bg-gray-50">
                            <tr>
                                {{-- <th scope="col" class="px-4 py-3 font-medium text-gray-900">ID</th> --}}
                                <th scope="col" class="px-4 py-3 font-medium text-gray-900"></th>
                                <th scope="col" class="px-4 py-3 font-medium text-gray-900">Usuario</th>
                                <th scope="col" class="px-4 py-3 font-medium text-gray-900">Código</th>
                                <th scope="col" class="px-4 py-3 font-medium text-gray-900">Email</th>
                                <th scope="col" class="px-4 py-3 font-medium text-gray-900">Status</th>
                                <th scope="col" class="px-4 py-3 font-medium text-gray-900"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 border-t border-gray-100 text-xs">
                            @foreach ($aliados as $aliado)

                            {{-- <tr class="hover:bg-gray-50">
                                <th class="px-4 gap-3">
                                <span class="flex justify-center items-center p-2 rounded bg-green-100 text-green-600 w-8 h-8">{{ $user->id }}</span>
                            </th> --}}
                            <td class="px-4 py-3">
                                <div class="flex items-center">
                                    <div class="rounded-full text-sm border border-cyan-50 bg-cyan-50 text-cyan-700 font-bold mr-2 h-8 w-8 inline-flex justify-center items-center">
                                        @php
                                            $pickName = $aliado->nombre_aliado;
                                            echo substr($pickName, 0, 1);
                                        @endphp
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <p class="text-gray-700 font-bold mb-1">{{ $aliado->nombre_aliado }}</p>
                                @if (!$aliado->user)
                                
                                @else
                                    <span class="truncate text-xs font-bold leading-5 text-gray-500">{{ $aliado->user->name }}</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <span class="text-gray-700 font-bold">{{ $aliado->codigo_aliado }}</span>
                            </td>
                            <td class="px-4 py-3">
                                @if (!$aliado->user)
                                
                                @else
                                    <p class="text-xs font-bold text-gray-500">{{ $aliado->user->email }}</p>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                @if ($aliado->status == '1')
                                    <span
                                    class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2 py-1 text-xs font-semibold text-emerald-600">
                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-600"></span>
                                        Activo
                                    </span>
                                @else
                                    <span
                                    class="inline-flex items-center gap-1 rounded-full bg-orange-50 px-2 py-1 text-xs font-semibold text-orange-600">
                                    <span class="h-1.5 w-1.5 rounded-full bg-orange-600"></span>
                                        Inactivo
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex justify-end gap-4">
                                    <a class="px-3 py-2 font-bold text-emerald-600 border-2 rounded border-emerald-600 text-xs transition-all hover:bg-emerald-600 hover:text-white" x-data="{ tooltip: 'Ver Aliado' }" href="{{ route('aliados.show', $aliado) }}">Ver Aliado</a>
                                </div>

                                {{-- @if ($aliado_state == '1')
                                    <form action="{{ route('aliado-status')}}" method="POST">
                                        @csrf
                                        @method('patch')
                                        <input type="hidden" name="id" value="{{ $aliado->id }}">
                                        <input type="hidden" name="status" value="0">
                                        <button class="px-4 py-2 text-xs bg-red-600 text-white rounded hover:bg-red-500">Desactivar</button>
                                    </form>
                                @else
                                    <form action="{{ route('aliado-status')}}" method="POST">
                                        @csrf
                                        @method('patch')
                                        <input type="hidden" name="id" value="{{ $aliado->id }}">
                                        <input type="hidden" name="status" value="1">
                                        <button class="px-4 py-2 text-xs bg-green-600 text-white rounded hover:bg-green-500">Activar</button>
                                    </form>
                                @endif --}}
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                </div>
                <div class="mt-3">
                    {{ $aliados->links() }}
                </div>
            </div>
        </div>
    </main>

@endsection()
