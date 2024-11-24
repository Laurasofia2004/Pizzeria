<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pizza_raw_material;
use Illuminate\Support\Facades\Validator;

class Pizza_raw_materialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pizza_raw_materials = Pizza_raw_material::with(['pizza', 'raw_material'])->get();

        return response()->json([
            'success' => true,
            'data' => $pizza_raw_materials,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'pizza_id' => 'required|exists:pizzas,id',
            'raw_material_id' => 'required|exists:raw_materials,id',
            'quantity' => 'required|numeric|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 400);
        }

        // Crear el registro
        $pizza_raw_material = Pizza_raw_material::create([
            'pizza_id' => $request->pizza_id,
            'raw_material_id' => $request->raw_material_id,
            'quantity' => $request->quantity,
        ]);

        return response()->json([
            'success' => true,
            'data' => $pizza_raw_material,
            'message' => 'Material relacionado con la pizza creado exitosamente.',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pizza_raw_material = Pizza_raw_material::with(['pizza', 'raw_material'])->find($id);

        if (!$pizza_raw_material) {
            return response()->json([
                'success' => false,
                'message' => 'Relación no encontrada.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $pizza_raw_material,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pizza_raw_material = Pizza_raw_material::find($id);

        if (!$pizza_raw_material) {
            return response()->json([
                'success' => false,
                'message' => 'Relación no encontrada.',
            ], 404);
        }

        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'pizza_id' => 'sometimes|required|exists:pizzas,id',
            'raw_material_id' => 'sometimes|required|exists:raw_materials,id',
            'quantity' => 'sometimes|required|numeric|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 400);
        }

        // Actualizar los datos
        $pizza_raw_material->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $pizza_raw_material,
            'message' => 'Relación actualizada exitosamente.',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pizza_raw_material = Pizza_raw_material::find($id);

        if (!$pizza_raw_material) {
            return response()->json([
                'success' => false,
                'message' => 'Relación no encontrada.',
            ], 404);
        }

        $pizza_raw_material->delete();

        return response()->json([
            'success' => true,
            'message' => 'Relación eliminada exitosamente.',
        ], 200);
    }
}
