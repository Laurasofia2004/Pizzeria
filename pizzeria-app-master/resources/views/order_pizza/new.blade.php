<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Orden de Pizza') }}
        </h2>
    </x-slot>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form id="order_pizzaForm" method="POST" action="{{ route('order_pizzas.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="order_id" class="form-label">Orden</label>
                            <select class="form-control" id="order_id" name="order_id">
                                <option value="">Seleccionar una orden</option>
                                @foreach($orders as $order)
                                <option value="{{ $order->id }}">{{ $order->id }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="pizza_size_id" class="form-label">Tamaño de pizza</label>
                            <select class="form-control" id="pizza_size_id" name="pizza_size_id">
                                <option value="">Seleccionar una pizza</option>
                                @foreach($pizza_size as $size)
                                <option value="{{ $size->id }}">{{ $size->size }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Cantidad</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Cantidad">
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save</button>
                            <a href="{{ route('order_pizzas.index') }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded ml-2">Cancel</a>
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
        $('#order_pizzaForm').on('submit', function(event) {
            event.preventDefault(); // Evita que el formulario se envíe inmediatamente

            let order_id = $('#order_id').val();
            let pizza_size_id = $('#pizza_size_id').val();
            let quantity = $('#quantity').val();

            // Validación de campos vacíos
            if (!order_id || !pizza_size_id || !quantity) {
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

                $('#pizza_id').focus();

                Toast.fire({
                    icon: "error",
                    title: "Completa todos los campos."
                });

                return;
            }

            // Si todas las validaciones son correctas, enviar el formulario
            Swal.fire({
                icon: 'success',
                title: 'Orden de Pizza creado con éxito',
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                // Si todo es correcto, proceder con el envío del formulario
                $('#order_pizzaForm').unbind('submit').submit();
            });
        });
    });
</script>