<nav class="bg-gray-700 border-gray-200">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="{{ route('index') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">{{ config('app.name') }}</span>
        </a>
        <button data-collapse-toggle="navbar-dropdown" type="button"
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm rounded-lg md:hidden focus:outline-none focus:ring-2 text-gray-400 hover:bg-gray-700 focus:ring-gray-600"
            aria-controls="navbar-dropdown" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>
        <div class="hidden w-full md:block md:w-auto" id="navbar-dropdown">
            <ul
                class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-200 rounded-lg bg-gray-700 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 ">
                <li>
                    <a href="{{ route('index') }}"
                        class="block py-2 px-3 text-white rounded md:bg-transparent md:p-0 hover:text-blue-500"
                        aria-current="page">Home</a>
                </li>
                @guest
                    <li>
                        <a href="{{ route('login') }}"
                            class="block py-2 px-3 text-white rounded md:bg-transparent md:p-0 hover:text-blue-500"
                            aria-current="page">Accedi</a>
                    </li>
                @endguest
                @auth
                    <li>
                        <a href="{{ route('cart') }}"
                            class="block py-2 px-3 text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-500 md:p-0">Carrello</a>
                    </li>
                    <li>
                        <a href="{{ route('orders') }}"
                            class="block py-2 px-3 text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-500 md:p-0">Ordini</a>
                    </li>

                    <li>
                        <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar"
                            class="flex items-center justify-between w-full py-2 px-3 text-gray-900 rounded md:border-0  md:p-0 md:w-auto text-white md:hover:text-blue-500 focus:text-white border-gray-700 hover:bg-gray-700 md:hover:bg-transparent">
                            {{ auth()->user()->email }}
                            <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 4 4 4-4" />
                            </svg></button>
                        <!-- Dropdown menu -->
                        <div id="dropdownNavbar"
                            class="z-10 hidden font-normal divide-y rounded-lg shadow w-44 bg-gray-700 divide-gray-600">
                            @can('admin')
                                <ul class="py-2 text-sm text-white" aria-labelledby="dropdownLargeButton">
                                    <li>
                                        <a href="{{ route('itemTable') }}" class="block px-4 py-2 hover:bg-blue-500">Tabella
                                            articoli</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('addItem') }}" class="block px-4 py-2 hover:bg-blue-500">Aggiungi
                                            articoli</a>
                                    </li>
                                </ul>
                            @endcan

                            <div class="py-1">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="w-full text-left block px-4 py-2 text-sm text-white hover:bg-blue-500">
                                        Esci</button>
                                </form>
                            </div>
                        </div>
                    </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>
