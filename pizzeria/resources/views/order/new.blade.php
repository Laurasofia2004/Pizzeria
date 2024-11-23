<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Agregar Pedido') }}
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('orders.store') }}">
                        @csrf

                        <!-- Cliente -->
                        <div class="mb-3">
                            <label for="client_id" class="form-label">Cliente</label>
                            <select class="form-select" id="client_id" name="client_id" required>
                                <option selected disabled value="">Seleccione uno...</option>
                                @foreach ($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Sucursal -->
                        <div class="mb-3">
                            <label for="branch_id" class="form-label">Sucursal</label>
                            <select class="form-select" id="branch_id" name="branch_id" required>
                                <option selected disabled value="">Seleccione uno...</option>
                                @foreach ($branches as $branch)
                                <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Precio Total -->
                        <div class="mb-3">
                            <label for="total_price" class="form-label">Precio Total</label>
                            <input type="number" step="0.01" class="form-control" id="total_price" name="total_price" placeholder="Precio Total" required>
                        </div>

                        <!-- Estado -->
                        <div class="mb-3">
                            <label for="status" class="form-label">Estado</label>
                            <select class="form-select" id="status" name="status" required>
                                <option selected disabled value="">Seleccione el estado...</option>
                                <option value="pendiente">Pendiente</option>
                                <option value="en_preparacion">En Preparación</option>
                                <option value="listo">Listo</option>
                                <option value="entregado">Entregado</option>
                            </select>
                        </div>

                        <!-- Tipo de Entrega -->
                        <div class="mb-3">
                            <label for="delivery_type" class="form-label">Tipo de Entrega</label>
                            <select class="form-select" id="delivery_type" name="delivery_type" required>
                                <option selected disabled value="">Seleccione el tipo de entrega...</option>
                                <option value="en_local">En Local</option>
                                <option value="a_domicilio">A Domicilio</option>
                            </select>
                        </div>

                        <!-- Empleado -->
                        <div class="mb-3">
                            <label for="employee" class="form-label">Empleado</label>
                            <select class="form-select" id="employee" name="employee_id" required> <!-- Cambiado a employee_id -->
                                <option selected disabled value="">Seleccione uno...</option>
                                @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->user->name }}</option>
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