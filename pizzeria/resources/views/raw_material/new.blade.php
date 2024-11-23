<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Usuarios') }}
        </h2>
    </x-slot>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form id="materialForm" method="POST" action="{{ route('raw_materials.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre del Producto</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nombre de usuario">
                        </div>

                        <div class="mb-3">
                            <label for="unidad" class="form-label">Unidad de medida</label>
                            <input type="text" class="form-control" id="unit" name="unit" placeholder="Unidad de medida">
                        </div>

                        <div class="mb-3">
                            <label for="current_stock" class="form-label">Stock Actual</label>
                            <input type="number" class="form-control" id="current_stock" name="current_stock" placeholder="Stock Actual">
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save</button>
                            <a href="{{ route('raw_materials.index') }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded ml-2">Cancel</a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>


<!-- Alertas de creacion -->

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        $('#materialForm').on('submit', function(e) {
            e.preventDefault();

            // Variables de los campos
            var name = $('#name').val();
            var unit = $('#unit').val();
            var current_stock = $('#current_stock').val();


            // Validaciones
            if (!name || !unit || !current_stock) {
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

                $('#name').focus();

                Toast.fire({
                    icon: "error",
                    title: "Completa todos los campos."
                });

                return;
            }

            // Si pasa las validaciones, mostrar mensaje de éxito
            Swal.fire({
                icon: 'success',
                title: 'Material creado con éxito',
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                // Si todo es correcto, proceder con el envío del formulario
                $('#materialForm').unbind('submit').submit();
            });
        });
    });
</script>