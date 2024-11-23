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
                    <form id="userForm" method="POST" action="{{ route('users.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre de usuario</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nombre de usuario">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="text" class="form-control" id="password" name="password" placeholder="Contraseña">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Confirmar Contraseña</label>
                            <input type="text" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirmar Contraseña">
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">Rol</label>
                            <select class="form-control" id="role" name="role" placeholder="Rol" required>
                                <option value="empleado">Empleado</option>
                                <option value="cliente">Cliente</option>
                            </select>
                            <!-- <input type="text"  class="form-control" id="role" name="role" placeholder="Rol" required> -->
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save</button>
                            <a href="{{ route('users.index') }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded ml-2">Cancel</a>
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
        $('#userForm').on('submit', function(e) {
            e.preventDefault();

            // Variables de los campos
            var email = $('#email').val();
            var password = $('#password').val();
            var confirmPassword = $('#confirmpassword').val();
            var name = $('#name').val();
            var role = $('#role').val();

            // Validaciones
            if (!name || !email || !password || !confirmPassword || !role) {
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

            if (!(email.includes('@gmail.com') || email.includes('@hotmail.com') || email.includes('@mail.com'))) {
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
                $('#floatingName').focus();

                Toast.fire({
                    icon: "error",
                    title: "El correo debe ser un email valido."
                });

                return;
            }

            if (password !== confirmPassword) {
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
                $('#floatingName').focus();

                Toast.fire({
                    icon: "error",
                    title: "Las contraseñas no coinciden."
                });

                return;
            }

            // Si pasa las validaciones, mostrar mensaje de éxito
            Swal.fire({
                icon: 'success',
                title: 'Usuario creado con éxito',
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                // Si todo es correcto, proceder con el envío del formulario
                $('#userForm').unbind('submit').submit();
            });
        });
    });
</script>