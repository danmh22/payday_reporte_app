<div class="overflow-y-scroll sidebar-main">
    <!-- Logo -->
    <div class="flex justify-start h-16 p-3">
        <div class="shrink-0 flex items-center">
            @if (Auth::user()->role == 1)
                <a href="{{ route('dashboard-admin') }}" class="flex items-center">
                    {{-- <x-application-logo class="block h-9 w-auto fill-current text-gray-800" /> --}}
                    <span class="text-xl font-extrabold ml-2 text-slate-700">BILLDAY APP</span>
                </a>
            @else
                <a href="{{ route('dashboard-user') }}" class="flex items-center">
                    {{-- <x-application-logo class="block h-9 w-auto fill-current text-gray-800" /> --}}
                    <span class="text-xl font-extrabold ml-2 text-slate-700">BILLDAY APP</span>
                </a>
            @endif
        </div>
    </div>
    <ul class="mt-8 px-5">

            @can('dashboard-user')

                <li class="flex group w-full justify-between rounded cursor-pointer items-center">
                    <a href="{{ route('dashboard-user') }}" class="flex items-center justify-start rounded bg-emerald-700 text-white py-3 px-3 w-full transition-all hover:bg-emerald-600 focus:outline-none focus:ring-2 focus:ring-white">
                        <span class="material-symbols-outlined w-7 h-7 flex justify-center items-center text-emerald-100 group-hover:text-white">
                            space_dashboard
                            </span>
                        <span class="text-sm font-medium ml-4">Dashboard</span>
                    </a>
                </li>

            @endcan
            @can('facturas-pendientes')
            <span class="block mt-4 mb-2 font-bold text-gray-400 text-xs">FACTURAS</span>
                <li class="flex w-full justify-between rounded group hover:bg-emerald-600 transition-all hover:text-white text-gray-600 cursor-pointer items-center">
                    <a href="{{ route('facturas-pendientes') }}" class="flex items-center px-3 py-3 w-full focus:outline-none focus:ring-2 focus:ring-white">
                    <span class="material-symbols-outlined w-7 h-7 flex justify-center items-center text-emerald-600 group-hover:text-white">
                            receipt_long
                            </span>
                        <span class="text-sm font-medium ml-4">Facturas Pendientes</span>
                    </a>
                </li>
            @endcan
            @can('facturas-pendientes')
                <li class="flex w-full justify-between rounded group hover:bg-emerald-600 transition-all hover:text-white text-gray-600 cursor-pointer items-center">
                    <a href="{{ route('facturas-conciliadas-user') }}" class="flex items-center px-3 py-3 w-full focus:outline-none focus:ring-2 focus:ring-white">
                    <span class="material-symbols-outlined w-7 h-7 flex justify-center items-center text-emerald-600 group-hover:text-white">
                            receipt_long
                            </span>
                        <span class="text-sm font-medium ml-4">Facturas Conciliadas</span>
                    </a>
                </li>
            @endcan

            @can('historial')
            <span class="block mt-4 mb-2 font-bold text-gray-400 text-xs">PAGOS</span>
                <li class="flex w-full justify-between rounded group hover:bg-emerald-600 transition-all hover:text-white text-gray-600 cursor-pointer items-center">
                    <a href="{{ route('historial') }}" class="flex items-center px-3 py-3 w-full focus:outline-none focus:ring-2 focus:ring-white">
                        <span class="material-symbols-outlined w-7 h-7 flex justify-center items-center text-emerald-600 group-hover:text-white">
                            payments
                            </span>
                        <span class="text-sm font-medium ml-4">Historial de Pagos</span>
                    </a>
                </li>
            @endcan

            @can('dashboard-admin')
                <li class="flex w-full justify-between group rounded cursor-pointer items-center">
                    <a href="{{ route('dashboard-admin') }}" class="flex items-center justify-start rounded bg-emerald-700 text-white py-3 px-3 w-full transition-all hover:bg-emerald-600 focus:outline-none focus:ring-2 focus:ring-white">
                        <span class="material-symbols-outlined w-7 h-7 flex justify-center items-center transition-all text-emerald-100 group-hover:text-white">
                            space_dashboard
                            </span>
                        <span class="text-sm font-medium ml-4">Dashboard Admin</span>
                    </a>
                </li>
            @endcan

            {{-- <li class="flex w-full justify-between rounded cursor-pointer items-center">
                <a href="/reportar-pago" class="flex items-center justify-between bg-emerald-600 text-white py-3 px-3 w-full hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="18" height="18" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon icon-tabler">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                    </svg>
                    <span class="text-sm ml-2">Reportar pago</span>
                </a>
            </li> --}}

            @can('cargar-facturas')
            <span class="block mt-4 mb-2 font-bold text-gray-400 text-xs">FACTURAS</span>
                <li class="flex w-full justify-between rounded group hover:bg-emerald-600 transition-all hover:text-white text-gray-600 cursor-pointer items-center">
                    <a href="{{ route('cargar-facturas') }}" class="flex items-center px-3 py-3 w-full focus:outline-none focus:ring-2 focus:ring-white">
                    <span class="material-symbols-outlined w-7 h-7 flex justify-center items-center text-emerald-600 group-hover:text-white">
                        upload_file
                            </span>
                        <span class="text-sm font-medium ml-4">Cargar Facturas</span>
                    </a>
                </li>
            @endcan

            @can('facturas-emitidas')
                <li class="flex w-full justify-between rounded group hover:bg-emerald-600 transition-all hover:text-white text-gray-600 cursor-pointer items-center">
                    <a href="{{ route('facturas-emitidas') }}" class="flex items-center px-3 py-3 w-full focus:outline-none focus:ring-2 focus:ring-white">
                    <span class="material-symbols-outlined w-7 h-7 flex justify-center items-center text-emerald-600 group-hover:text-white">
                            receipt_long
                            </span>
                        <span class="text-sm font-medium ml-4">Facturas Emitidas</span>
                    </a>
                </li>
            @endcan
            
            @can('facturas-conciliadas')
                <li class="flex w-full justify-between rounded group hover:bg-emerald-600 transition-all hover:text-white text-gray-600 cursor-pointer items-center">
                    <a href="{{ route('facturas-conciliadas') }}" class="flex items-center px-3 py-3 w-full focus:outline-none focus:ring-2 focus:ring-white">
                    <span class="material-symbols-outlined w-7 h-7 flex justify-center items-center text-emerald-600 group-hover:text-white">
                            receipt_long
                            </span>
                        <span class="text-sm font-medium ml-4">Facturas Conciliadas</span>
                    </a>
                </li>
            @endcan

            @can('pagos-conciliar')
            <span class="block mt-4 mb-2 font-bold text-gray-400 text-xs">PAGOS</span>
                <li class="flex w-full justify-between rounded group hover:bg-emerald-600 transition-all hover:text-white text-gray-600 cursor-pointer items-center">
                    <a href="{{ route('pagos-conciliar') }}" class="flex items-center px-3 py-3 w-full focus:outline-none focus:ring-2 focus:ring-white">
                        <span class="material-symbols-outlined w-7 h-7 flex justify-center items-center text-emerald-600 group-hover:text-white">
                            payments
                            </span>
                        <span class="text-sm font-medium ml-4">Pagos por Conciliar</span>
                    </a>
                    {{-- <div class="py-1 px-2 bg-emerald-600 rounded-full text-white flex items-center justify-center text-xs mr-4">2</div> --}}
                </li>
            @endcan

            @can('pagos-conciliados')
                <li class="flex w-full justify-between rounded group hover:bg-emerald-600 transition-all hover:text-white text-gray-600 cursor-pointer items-center">
                    <a href="{{ route('pagos-conciliados') }}" class="flex items-center px-3 py-3 w-full focus:outline-none focus:ring-2 focus:ring-white">
                        <span class="material-symbols-outlined w-7 h-7 flex justify-center items-center text-emerald-600 group-hover:text-white">
                            payments
                            </span>
                        <span class="text-sm font-medium ml-4">Pagos Conciliados</span>
                    </a>
                </li>
            @endcan

            @can('aliados.index')
            <span class="block mt-4 mb-2 font-bold text-gray-400 text-xs">ALIADOS</span>
                <li class="flex w-full justify-between rounded group hover:bg-emerald-600 transition-all hover:text-white text-gray-600 cursor-pointer items-center">
                    <a href="{{ route('aliados.index') }}" class="flex items-center px-3 py-3 w-full focus:outline-none focus:ring-2 focus:ring-white">
                        <span class="material-symbols-outlined w-7 h-7 flex justify-center items-center text-emerald-600 group-hover:text-white">
                            group
                            </span>
                        <span class="text-sm font-medium ml-4">Aliados Comerciales</span>
                    </a>
                </li>
            @endcan

            {{-- <li class="flex w-full justify-between rounded group hover:bg-blue-700 transition-all hover:text-white cursor-pointer items-center">
                <a href="/historial" class="flex items-center px-3 py-3 w-full focus:outline-none focus:ring-2 focus:ring-white">
                    <span class="w-7 h-7 flex justify-center items-center text-blue-600 group-hover:text-white"><svg xmlns="http://www.w3.org/2000/svg" fill="none" width="16" height="16" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon icon-tabler">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6.878V6a2.25 2.25 0 012.25-2.25h7.5A2.25 2.25 0 0118 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 004.5 9v.878m13.5-3A2.25 2.25 0 0119.5 9v.878m0 0a2.246 2.246 0 00-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0121 12v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6c0-.98.626-1.813 1.5-2.122" />
                    </svg></span>
                    <span class="text-sm ml-2">Historial</span>
                </a>
            </li> --}}

            {{-- <li class="flex w-full justify-between rounded group hover:bg-blue-700 transition-all hover:text-white cursor-pointer items-center">
                <a href="javascript:void(0)" class="flex items-center px-3 py-3 w-full focus:outline-none focus:ring-2 focus:ring-white">
                    <span class="w-7 h-7 flex justify-center items-center text-blue-600 group-hover:text-white"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-settings" width="16" height="16" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <circle cx="12" cy="12" r="3" />
                    </svg></span>
                    <span class="text-sm ml-2">Soporte</span>
                </a>
            </li> --}}

            
        <div class="w-full py-4 mt-8 flex justify-center items-center border rounded"><img src="{{ asset('img/logo-llano-mall.png') }}" class="w-44" alt=""></div>

    </ul>
    <div class="px-4 mt-6">
        <ul class="w-full flex items-center justify-between">
            <li class="flex cursor-pointer pt-5 pb-5">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
    
                    <button :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" aria-label="open" class="focus:outline-none focus:ring-2 rounded focus:ring-gray-300 hover:text-gray-700 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="20" height="20" stroke-width="1.5" stroke="currentColor" class="icon icon-tabler">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                        </svg>
                        <span class="text-sm ml-2">Cerrar Sesión</span>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</div>

