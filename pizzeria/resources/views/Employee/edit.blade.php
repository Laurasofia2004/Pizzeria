<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Empleados') }}
        </h2>
    </x-slot>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form id="editEmpleadoForm" method="POST" action="{{ route('employees.update', $employee->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="user_id" class="form-label">Nombre de usuario</label>
                            <select class="form-control" id="user_id" name="user_id">
                                <option value="">Seleccionar un usuario</option>
                                @foreach($users as $user)
                                <option value="{{ $user->id }}"
                                    {{ $employee->user_id == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="position" class="form-label">Cargo</label>
                            <select class="form-control" id="position" name="position">
                                <option value="">Seleccione un cargo</option>
                                <option value="cajero" {{ $employee->position == 'cajero' ? 'selected' : '' }}>Cajero</option>
                                <option value="administrador" {{ $employee->position == 'administrador' ? 'selected' : '' }}>Administrador</option>
                                <option value="cocinero" {{ $employee->position == 'cocinero' ? 'selected' : '' }}>Cocinero</option>
                                <option value="mensajero" {{ $employee->position == 'mensajero' ? 'selected' : '' }}>Mensajero</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="identification_number" class="form-label">Numero de identificacion</label>
                            <input type="number" class="form-control" id="identification_number" name="identification_number" placeholder="Numero de identificacion" value="{{ $employee->identification_number }}">
                        </div>

                        <div class="mb-3">
                            <label for="salary" class="form-label">Salario</label>
                            <input type="number" class="form-control" id="salary" name="salary" placeholder="Salario" value="{{ $employee->salary }}">
                        </div>

                        <div class="mb-3">
                            <label for="hire_date" class="form-label">Inicio de Contrato</label>
                            <input type="date" class="form-control" id="hire_date" name="hire_date" placeholder="Inicio de Contrato" value="{{ $employee-> hire_date}}">
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save</button>
                            <a href="{{ route('employees.index') }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded ml-2">Cancel</a>
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
        $('#editEmpleadoForm').on('submit', function(event) {
            event.preventDefault(); // Evita que el formulario se envíe inmediatamente

            let userId = $('#user_id').val();
            let position = $('#position').val();
            let identification_number = $('#identification_number').val();
            let salary = $('#salary').val();
            let hire_date = $('#hire_date').val();

            // Validación de campos vacíos
            if (!userId || !position || !identification_number || !salary || !hire_date) {
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

                $('#user_id').focus();

                Toast.fire({
                    icon: "error",
                    title: "Completa todos los campos."
                });

                return;
            }


            // Si todas las validaciones son correctas, enviar el formulario
            Swal.fire({
                icon: 'success',
                title: 'Empleado editado con éxito',
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                // Si todo es correcto, proceder con el envío del formulario
                $('#editEmpleadoForm').unbind('submit').submit();
            });
        });
    });
</script>