<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\RawMaterial;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Mostrar una lista de las compras.
     */
    public function index()
    {
        $purchases = Purchase::with(['supplier', 'rawMaterial'])->get();
        return view('purchases.index', compact('purchases'));
    }

    /**
     * Mostrar el formulario para registrar una nueva compra.
     */
    public function create()
    {
        $suppliers = Supplier::all();
        $rawMaterials = RawMaterial::all();
        return view('purchases.create', compact('suppliers', 'rawMaterials'));
    }

    /**
     * Almacenar una nueva compra en la base de datos.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'raw_material_id' => 'required|exists:raw_materials,id',
            'quantity' => 'required|numeric|min:1',
            'purchase_price' => 'required|numeric|min:0',
            'purchase_date' => 'required|date',
        ]);

        Purchase::create($validated);

        return redirect()->route('purchases.index');
    }

    /**
     * Mostrar los detalles de una compra específica.
     */
    public function show(Purchase $purchase)
    {
        $purchase->load(['supplier', 'rawMaterial']);
        return view('purchases.show', compact('purchase'));
    }

    /**
     * Mostrar el formulario para editar una compra.
     */
    public function edit(Purchase $purchase)
    {
        $suppliers = Supplier::all();
        $rawMaterials = RawMaterial::all();
        return view('purchases.edit', compact('purchase', 'suppliers', 'rawMaterials'));
    }

    /**
     * Actualizar una compra en la base de datos.
     */
    public function update(Request $request, Purchase $purchase)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'raw_material_id' => 'required|exists:raw_materials,id',
            'quantity' => 'required|numeric|min:1',
            'purchase_price' => 'required|numeric|min:0',
            'purchase_date' => 'required|date',
        ]);

        $purchase->update($validated);

        return redirect()->route('purchases.index');
    }

    /**
     * Eliminar una compra de la base de datos.
     */
    public function destroy(Purchase $purchase)
    {
        $purchase->delete();
        return redirect()->route('purchases.index');
    }
}
