<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Purchase;
use Illuminate\Support\Facades\Validator;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchases = Purchase::with(['supplier', 'raw_material'])->get();

        return response()->json([
            'success' => true,
            'data' => $purchases,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'supplier_id' => 'required|exists:suppliers,id',
            'raw_material_id' => 'required|exists:raw_materials,id',
            'quantity' => 'required|numeric|min:1',
            'purchase_price' => 'required|numeric|min:0',
            'purchase_date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 400);
        }

        // Crear la compra
        $purchase = Purchase::create([
            'supplier_id' => $request->supplier_id,
            'raw_material_id' => $request->raw_material_id,
            'quantity' => $request->quantity,
            'purchase_price' => $request->purchase_price,
            'purchase_date' => $request->purchase_date,
        ]);

        return response()->json([
            'success' => true,
            'data' => $purchase,
            'message' => 'Compra creada exitosamente.',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $purchase = Purchase::with(['supplier', 'raw_material'])->find($id);

        if (!$purchase) {
            return response()->json([
                'success' => false,
                'message' => 'Compra no encontrada.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $purchase,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $purchase = Purchase::find($id);

        if (!$purchase) {
            return response()->json([
                'success' => false,
                'message' => 'Compra no encontrada.',
            ], 404);
        }

        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'supplier_id' => 'sometimes|required|exists:suppliers,id',
            'raw_material_id' => 'sometimes|required|exists:raw_materials,id',
            'quantity' => 'sometimes|required|numeric|min:1',
            'purchase_price' => 'sometimes|required|numeric|min:0',
            'purchase_date' => 'sometimes|required|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 400);
        }

        // Actualizar la compra
        $purchase->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $purchase,
            'message' => 'Compra actualizada exitosamente.',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $purchase = Purchase::find($id);

        if (!$purchase) {
            return response()->json([
                'success' => false,
                'message' => 'Compra no encontrada.',
            ], 404);
        }

        $purchase->delete();

        return response()->json([
            'success' => true,
            'message' => 'Compra eliminada exitosamente.',
        ], 200);
    }
}
