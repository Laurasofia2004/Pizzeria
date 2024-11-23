<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Cliente') }}
        </h2>
    </x-slot>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form id="clientForm" method="POST" action="{{ route('clients.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="user_id" class="form-label">Nombre de usuario</label>
                            <select class="form-control" id="user_id" name="user_id">
                                <option value="">Seleccionar un usuario</option>
                                @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Direccion</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Direccion">
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Numero de telefono</label>
                            <input type="number" class="form-control" id="phone" name="phone" placeholder="Numero de telefono">
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save</button>
                            <a href="{{ route('clients.index') }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded ml-2">Cancel</a>
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
        $('#clientForm').on('submit', function(event) {
            event.preventDefault(); // Evita que el formulario se envíe inmediatamente

            let userId = $('#user_id').val();
            let address = $('#address').val();
            let phone = $('#phone').val();

            // Validación de campos vacíos
            if (!userId || !address || !phone) {
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

                $('#address').focus();

                Toast.fire({
                    icon: "error",
                    title: "Completa todos los campos."
                });

                return;
            }

            // Si todas las validaciones son correctas, enviar el formulario
            Swal.fire({
                icon: 'success',
                title: 'Cliente creado con éxito',
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                // Si todo es correcto, proceder con el envío del formulario
                $('#clientForm').unbind('submit').submit();
            });
        });
    });
</script>