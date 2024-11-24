<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Orden de ingredientes extra') }}
        </h2>
    </x-slot>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form id="editOrder_extra_ingredientForm" method="POST" action="{{ route('order_extra_ingredients.update', $order_extra_ingredient->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="order_id" class="form-label">Orden</label>
                            <select class="form-control" id="order_id" name="order_id">
                                <option value="">Seleccionar una orden</option>
                                @foreach($orders as $order)
                                <option value="{{ $order->id }}" {{ $order_extra_ingredient->order_id == $order->id ? 'selected' : '' }}>
                                    {{ $order->id }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="extra_ingredient_id" class="form-label">Ingrediente Extra</label>
                            <select class="form-control" id="extra_ingredient_id" name="extra_ingredient_id">
                                <option value="">Seleccionar un Ingrediente</option>
                                @foreach($extra_ingredients as $extra)
                                <option value="{{ $extra->id }}" {{ $order_extra_ingredient->extra_ingredient_id == $extra->id ? 'selected' : '' }}>
                                    {{ $extra->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Cantidad</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Cantidad" value="{{ $order_extra_ingredient->quantity }}">
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save</button>
                            <a href="{{ route('order_extra_ingredients.index') }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded ml-2">Cancel</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>