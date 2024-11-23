<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Compra') }}
        </h2>
    </x-slot>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form id="editPurchaseForm" method="POST" action="{{ route('purchases.update', $purchase->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="supplier_id" class="form-label">Nombre del proovedor</label>
                            <select class="form-control" id="supplier_id" name="supplier_id">
                                <option value="">Seleccionar un proovedor</option>
                                @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}"
                                    {{ $purchase->supplier_id == $supplier->id ? 'selected' : '' }}>
                                    {{ $supplier->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="raw_material_id" class="form-label">Material</label>
                            <select class="form-control" id="raw_material_id" name="raw_material_id">
                                <option value="">Seleccionar un producto</option>
                                @foreach($raw_materials as $raw_material)
                                <option value="{{ $raw_material->id }}"
                                    {{ $purchase->raw_material_id == $raw_material->id ? 'selected' : '' }}>
                                    {{ $raw_material->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="quantity" class="form-label">Cantidad</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Cantidad" value="{{ $purhcase->quantity }}">
                        </div>

                        <div class="mb-3">
                            <label for="purchase_price" class="form-label">Precio</label>
                            <input type="number" class="form-control" id="purchase_price" name="purchase_price" placeholder="Precio" value="{{ $purchase->purchase_price }}">
                        </div>

                        <div class="mb-3">
                            <label for="purchase_date" class="form-label">Fecha</label>
                            <input type="date" class="form-control" id="purchase_date" name="purchase_date" placeholder="Fecha" value="{{ $purchase->purchase_date }}">
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save</button>
                            <a href="{{ route('purchases.index') }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded ml-2">Cancel</a>
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
        $('#editPurchaseForm').on('submit', function(event) {
            event.preventDefault(); // Evita que el formulario se envíe inmediatamente

            let supplier_id = $('#supplier_id').val();
            let raw_material_id = $('#raw_material_id').val();
            let quantity = $('#quantity').val();
            let purchase_price = $('#purchase_price').val();
            let purchase_date = $('#purchase_date').val();

            // Validación de campos vacíos
            if (!supplier_id || !raw_material_id || !quantity || !purchase_price || !purchase_date) {
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

                $('#supplier_id').focus();

                Toast.fire({
                    icon: "error",
                    title: "Completa todos los campos."
                });

                return;
            }

            // Si todas las validaciones son correctas, enviar el formulario
            Swal.fire({
                icon: 'success',
                title: 'Compra editada con éxito',
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                // Si todo es correcto, proceder con el envío del formulario
                $('#editPurchaseForm').unbind('submit').submit();
            });
        });
    });
</script>