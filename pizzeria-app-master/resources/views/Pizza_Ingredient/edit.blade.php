<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Ingredientes de pizza') }}
        </h2>
    </x-slot>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form id="editPizza_IngredientForm" method="POST" action="{{ route('pizza_ingredients.update', $pizza_ingredient->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="pizza_id" class="form-label">Nombre de Pizza</label>
                            <select class="form-control" id="pizza_id" name="pizza_id">
                                <option value="">Seleccionar una Pizza</option>
                                @foreach($pizzas as $pizza)
                                <option value="{{ $pizza->id }}"
                                    {{$pizza_ingredient->pizza_id==$pizza->id ? 'selected':''}}>
                                    {{ $pizza->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="ingredient_id" class="form-label">Nombre de ingrediente</label>
                            <select class="form-control" id="ingredient_id" name="ingredient_id">
                                <option value="">Seleccionar un ingrediente</option>
                                @foreach($ingredients as $ingredient)
                                <option value="{{ $ingredient->id }}"
                                    {{$pizza_ingredient->ingredient_id==$ingredient->id ? 'selected':''}}>
                                    {{ $ingredient->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save</button>
                            <a href="{{ route('pizza_ingredients.index') }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded ml-2">Cancel</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#editPizza_IngredientForm').on('submit', function(event) {
            event.preventDefault(); // Evita que el formulario se envíe inmediatamente
            let pizza_id = $('#pizza_id').val();
            let ingredient_id = $('#ingredient_id').val();
            // Validación de campos vacíos
            if (!pizza_id || !ingredient_id) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                $('#editPizza_IngredientForm').focus();
                Toast.fire({
                    icon: "error",
                    title: "Completa todos los campos."
                });
                return;
            }
            // Si todas las validaciones son correctas, enviar el formulario
            Swal.fire({
                icon: 'success',
                title: 'Material Pizza editada con éxito',
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                // Si todo es correcto, proceder con el envío del formulario
                $('#editPizza_IngredientForm').unbind('submit').submit();
            });
        });
    });
</script>