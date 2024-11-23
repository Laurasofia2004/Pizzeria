<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Pedido') }}
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('orders.update', $order->id) }}">
                        @csrf
                        @method('PUT')
                        <!-- Cliente -->
                        <div class="mb-3">
                            <label for="client_id" class="form-label">Cliente</label>
                            <select class="form-select" id="client_id" name="client_id" required>
                                <option disabled value="">Seleccione uno...</option>
                                @foreach ($clients as $client)
                                <option value="{{ $client->id }}" {{ $order->client_id == $client->id ? 'selected' : '' }}>
                                    {{ $client->user->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Sucursal -->
                        <div class="mb-3">
                            <label for="branch_id" class="form-label">Sucursal</label>
                            <select class="form-select" id="branch_id" name="branch_id" required>
                                <option disabled value="">Seleccione uno...</option>
                                @foreach ($branches as $branch)
                                <option value="{{ $branch->id }}" {{ $order->branch_id == $branch->id ? 'selected' : '' }}>
                                    {{ $branch->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Precio Total -->
                        <div class="mb-3">
                            <label for="total_price" class="form-label">Precio Total</label>
                            <input type="number" step="0.01" class="form-control" id="total_price" name="total_price" value="{{ $order->total_price }}" placeholder="Precio Total" required>
                        </div>

                        <!-- Estado -->
                        <div class="mb-3">
                            <label for="status" class="form-label">Estado</label>
                            <select class="form-select" id="status" name="status" required>
                                <option disabled value="">Seleccione el estado...</option>
                                <option value="pendiente" {{ $order->status == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                <option value="en_preparacion" {{ $order->status == 'en_preparacion' ? 'selected' : '' }}>En Preparación</option>
                                <option value="listo" {{ $order->status == 'listo' ? 'selected' : '' }}>Listo</option>
                                <option value="entregado" {{ $order->status == 'entregado' ? 'selected' : '' }}>Entregado</option>
                            </select>
                        </div>

                        <!-- Tipo de Entrega -->
                        <div class="mb-3">
                            <label for="delivery_type" class="form-label">Tipo de Entrega</label>
                            <select class="form-select" id="delivery_type" name="delivery_type" required>
                                <option disabled value="">Seleccione el tipo de entrega...</option>
                                <option value="en_local" {{ $order->delivery_type == 'en_local' ? 'selected' : '' }}>En Local</option>
                                <option value="a_domicilio" {{ $order->delivery_type == 'a_domicilio' ? 'selected' : '' }}>A Domicilio</option>
                            </select>
                        </div>

                        <!-- Empleado -->
                        <div class="mb-3">
                            <label for="employee" class="form-label">Empleado</label>
                            <select class="form-select" id="employee" name="employee_id" required>
                                <option disabled value="">Seleccione uno...</option>
                                @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}" {{ $order->delivery_person_id == $employee->id ? 'selected' : '' }}>
                                    {{ $employee->user->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Botones de Acción -->
                        <div class="mt-3">
                            <button type="submit" class="bg-green-700 hover:bg-green-900 text-white font-bold py-2 px-4 rounded">Guardar</button>
                            <a href="{{ route('orders.index') }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded ml-2">Cancelar</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-Nrx+IQDkQ7o5gSoTgI8Y6ODZt0AXSD3ddJTr9me5JFCnU4XpjNBRrfJCGFZ4EKAV" crossorigin="anonymous"></script>