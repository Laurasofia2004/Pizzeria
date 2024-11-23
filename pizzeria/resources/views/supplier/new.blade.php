<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Proovedor') }}
        </h2>
    </x-slot>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form id="supplierForm" method="POST" action="{{ route('suppliers.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre de Proovedor</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nombre de Proovedor">
                        </div>

                        <div class="mb-3">
                            <label for="contact_info" class="form-label">Info de contacto</label>
                            <input type="number" class="form-control" id="contact_info" name="contact_info" placeholder="Info de contacto">
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save</button>
                            <a href="{{ route('suppliers.index') }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded ml-2">Cancel</a>
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
        $('#supplierForm').on('submit', function(e) {
            e.preventDefault();

            // Variables de los campos
            var name = $('#name').val();
            var contact_info = $('#contact_info').val();

            // Validaciones
            if (!name || !contact_info) {
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
                title: 'Proovedor creado con éxito',
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                // Si todo es correcto, proceder con el envío del formulario
                $('#supplierForm').unbind('submit').submit();
            });
        });
    });
</script>