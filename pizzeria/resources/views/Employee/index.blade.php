<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Empleados') }}
        </h2>
    </x-slot>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('employees.create') }}" class="bg-green-700 hover:bg-green-900 text-white font-bold py-2 px-4 rounded ml-2">Add</a>

                    <table class="table">
                        <thead>
                        <!-- id	user_id	position	identification_number	salary	hire_date -->
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Usuario</th>
                                <th scope="col">Cargo</th>
                                <th scope="col">Identificacion</th>
                                <th scope="col">Salario</th>
                                <th scope="col">Inicio de Contrato</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $employee)
                            <tr>
                                <th scope="row">{{ $employee->id }}</th>
                                <td>{{ $employee->user->name }}</td> <!-- Aquí mostramos el nombre del usuario -->
                                <td>{{ $employee->position }}</td>
                                <td>{{ $employee->identification_number }}</td>
                                <td>{{ $employee->salary }}</td>
                                <td>{{ $employee->hire_date }}</td>
                                <td>
                                    <a href="{{ route('employees.edit', $employee->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        Edit
                                    </a></li>

                                    <form id="deleteEmpleado" action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display: inline-block">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2" id="delete">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


<!-- Alerta para eliminar Empleado -->

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('#deleteEmpleado').on('submit', function(e) {
            e.preventDefault(); // Prevenir el envío del formulario

            const form = this; // Guardar referencia al formulario

            Swal.fire({
                title: '¿Estás seguro de eliminar este empleado?',
                text: "No podrás revertir esta acción",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Eliminado',
                        'El empleado ha sido eliminado.',
                        'success'
                    );

                    form.submit(); // Enviar el formulario si se confirma
                }
            });
        });
    });
</script>