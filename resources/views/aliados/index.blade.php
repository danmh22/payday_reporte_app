@extends('layouts.template')

@section('title', 'Usuarios')

@section('header_section')

    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Listado de Aliados Comerciales</h1>

@endsection()

@section('content')

    <main>
        <div class="flex flex-wrap mx-auto py-4 pt-0">
            <div class="w-5/6 py-4">
                <div class="overflow-x-auto rounded border border-gray-200">
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
                                    <div class="rounded-full text-sm border border-blue-50 bg-blue-50 text-blue-500 font-bold mr-3 h-8 w-8 inline-flex justify-center items-center">
                                        @php
                                            $pickName = $aliado->user->name;
                                            echo substr($pickName, 0, 1);
                                        @endphp
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <p class="text-gray-500 font-bold">{{ $aliado->nombre_aliado }}</p>
                                <span class="truncate text-xs leading-5 text-gray-500">{{ $aliado->user->name }}</span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="text-gray-500 font-bold">{{ $aliado->codigo_aliado }}</span>
                            </td>
                            <td class="px-4 py-3 font-normal text-gray-900">
                                <div class="text-xs font-medium text-gray-700">
                                    <a href="#">{{ $aliado->user->email }}</a>
                                </div>
                            </td>
                            <td class="px-4 py-3">

                                @php
                                    $aliado_state = $aliado->status;
                                @endphp

                                @if ($aliado_state == '1')
                                    <span
                                    class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-semibold text-green-600">
                                    <span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>
                                        Activo
                                    </span>
                                @else
                                    <span
                                    class="inline-flex items-center gap-1 rounded-full bg-red-50 px-2 py-1 text-xs font-semibold text-red-600">
                                    <span class="h-1.5 w-1.5 rounded-full bg-red-600"></span>
                                        Inactivo
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                @if ($aliado_state == '1')
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
                                @endif
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
