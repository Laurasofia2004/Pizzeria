<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Ingrediente Extra') }}
        </h2>
    </x-slot>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('extraingredient.update', $extraIngredient->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="id" class="form-label">Id</label>
                            <input type="text" class="form-control" id="id" name="id" disabled="disabled" value="{{ $extraIngredient->id }}">
                            <div id="idHelp" class="form-text">Ingrediente Extra id</div>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre de Ingrediente Extra</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nombre de Ingrediente Extra" value="{{ $extraIngredient->name }}">
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Precio</label>
                            <input type="number" class="form-control" id="price" name="price" step="0.01" placeholder="Precio" value="{{ $extraIngredient->price }}">
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save</button>
                            <a href="{{ route('extraingredient.index') }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded ml-2">Cancel</a>
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
        $('form').on('submit', function(e) {
            e.preventDefault();
            var name = $('#name').val();
            var price = $('#price').val();
            if (!name || !price) {
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
                Toast.fire({
                    icon: "error",
                    title: "Completa todos los campos."
                });
                return;
            }
            Swal.fire({
                icon: 'success',
                title: 'Ingrediente extra editado con éxito',
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                $('form').unbind('submit').submit();
            });
        });
    });
</script>
