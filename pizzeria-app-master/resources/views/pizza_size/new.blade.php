<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Tamaño') }}
        </h2>
    </x-slot>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form id="pizza_sizeForm" method="POST" action="{{ route('pizza_sizes.store') }}">
                        @csrf


                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre de Pizza</label>
                            <select class="form-control" id="name" name="name">
                                <option value="">Seleccionar una Pizza</option>
                                @foreach($pizzas as $pizza)
                                <option value="{{ $pizza->id }}">{{ $pizza->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="size" class="form-label">Tamaño</label>
                            <select class="form-control" id="size" name="size">
                                <option value="">Seleccionar una Pizza</option>
                                <option value="pequeña">pequeña</option>
                                <option value="mediana">mediana</option>
                                <option value="grande">grande</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Precio</label>
                            <input type="number" class="form-control" id="price" name="price" placeholder="Numero de telefono">
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save</button>
                            <a href="{{ route('pizza_sizes.index') }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded ml-2">Cancel</a>
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
        $('#pizza_sizeForm').on('submit', function(event) {
            event.preventDefault(); // Evita que el formulario se envíe inmediatamente

            let name = $('#name').val();
            let size = $('#size').val();
            let price = $('#price').val();

            // Validación de campos vacíos
            if (!price) {
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

                $('#price').focus();

                Toast.fire({
                    icon: "error",
                    title: "Completa todos los campos."
                });

                return;
            }

            // Si todas las validaciones son correctas, enviar el formulario
            Swal.fire({
                icon: 'success',
                title: 'Tamaño creado con éxito',
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                // Si todo es correcto, proceder con el envío del formulario
                $('#pizza_sizeForm').unbind('submit').submit();
            });
        });
    });
</script>