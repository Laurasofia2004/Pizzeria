<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <!-- Opción de Dashboard (visible para Admin y Cliente) -->
                    @if(Auth::user()->role === 'admin' || Auth::user()->role === 'cajero')
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Panel') }}
                    </x-nav-link>
                    @endif
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <!-- Opción de Sucursales (visible para Admin) -->
                    @if(Auth::user()->role === 'admin' || Auth::user()->role === 'mensajero' || Auth::user()->role === 'cliente')
                    <x-nav-link :href="route('branches.index')" :active="request()->routeIs('branches.index')">
                        {{ __('Sucursales') }}
                    </x-nav-link>
                    @endif
                </div>

                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    @if(Auth::user()->role === 'admin')
                    <x-dropdown align="right" width="48">

                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ __('Usuarios') }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>

                            </button>
                        </x-slot>
                        @endif
                        <x-slot name="content">
                            <x-dropdown-link :href="route('users.index')">
                                {{ __('Usuarios') }}
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('clients.index')">
                                {{ __('Clientes') }}
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('employees.index')">
                                {{ __('Empleados') }}
                            </x-dropdown-link>

                        </x-slot>
                    </x-dropdown>
                </div>

                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    @if(Auth::user()->role === 'admin')
                    <x-dropdown align="right" width="48">

                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ __('Inventario y Proveedores') }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>

                            </button>
                        </x-slot>
                        @endif
                        <x-slot name="content">

                            <x-dropdown-link :href="route('suppliers.index')">
                                {{ __('Proovedores') }}
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('raw_materials.index')">
                                {{ __('Materiales') }}
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('purchases.index')">
                                {{ __('Compras') }}
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('pizza_raw_materials.index')">
                                {{ __('Materiales Pizza') }}
                            </x-dropdown-link>

                        </x-slot>
                    </x-dropdown>
                </div>

                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    @if(Auth::user()->role === 'admin' || Auth::user()->role === 'cajero' || Auth::user()->role === 'cocinero' || Auth::user()->role === 'cliente')
                    <x-dropdown align="right" width="48">

                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ __('Pizzeria') }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>

                            </button>
                        </x-slot>
                        @endif
                        <x-slot name="content">

                            <x-dropdown-link :href="route('pizzas.index')">
                                {{ __('Pizzas') }}
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('ingredients.index')">
                                {{ __('Ingredientes') }}
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('pizza_sizes.index')">
                                {{ __('Tamaño Pizza') }}
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('pizza_ingredients.index')">
                                {{ __('Pizza e Ingredientes') }}
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('extraingredient.index')">
                                {{ __('Ingredientes Extra') }}
                            </x-dropdown-link>


                        </x-slot>



                    </x-dropdown>
                </div>


                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    @if(Auth::user()->role === 'admin' || Auth::user()->role === 'cajero' || Auth::user()->role === 'cocinero' || Auth::user()->role === 'mensajero')
                    <x-dropdown align="right" width="48">

                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ __('Ordenes') }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>

                            </button>
                        </x-slot>
                        @endif
                        <x-slot name="content">
                            @if(Auth::user()->role === 'admin' || Auth::user()->role === 'cajero' || Auth::user()->role === 'cocinero' || Auth::user()->role === 'mensajero')
                            <x-dropdown-link :href="route('orders.index')">
                                {{ __('Ordenes') }}
                            </x-dropdown-link>
                            @endif
                            @if(Auth::user()->role === 'admin' || Auth::user()->role === 'cajero' || Auth::user()->role === 'cocinero')
                            <x-dropdown-link :href="route('order_pizzas.index')">
                                {{ __('Ordenes de pizza') }}
                            </x-dropdown-link>
                            @if(Auth::user()->role === 'admin' || Auth::user()->role === 'cajero' || Auth::user()->role === 'cocinero')
                            @endif
                            <x-dropdown-link :href="route('order_extra_ingredients.index')">
                                {{ __('Ordenes de ingredientes Extra') }}
                            </x-dropdown-link>
                            @endif
                        </x-slot>

                    </x-dropdown>
                </div>

            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Perfil') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Cerrar sesion') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Panel') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Perfil') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Cerrar sesion') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>