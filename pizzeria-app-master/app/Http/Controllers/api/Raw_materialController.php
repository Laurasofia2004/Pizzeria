<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Raw_material;
use Illuminate\Support\Facades\Validator;

class Raw_materialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $raw_materials = Raw_material::all();
        return response()->json([
            'success' => true,
            'data' => $raw_materials,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'unit' => 'required|string|max:50',
            'current_stock' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 400);
        }

        // Crear el nuevo material
        $raw_material = Raw_material::create([
            'name' => $request->name,
            'unit' => $request->unit,
            'current_stock' => $request->current_stock,
        ]);

        return response()->json([
            'success' => true,
            'data' => $raw_material,
            'message' => 'Material creado exitosamente.',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $raw_material = Raw_material::find($id);

        if (!$raw_material) {
            return response()->json([
                'success' => false,
                'message' => 'Material no encontrado.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $raw_material,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $raw_material = Raw_material::find($id);

        if (!$raw_material) {
            return response()->json([
                'success' => false,
                'message' => 'Material no encontrado.',
            ], 404);
        }

        // Validar los datos del request
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'unit' => 'sometimes|required|string|max:50',
            'current_stock' => 'sometimes|required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 400);
        }

        // Actualizar el material
        $raw_material->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $raw_material,
            'message' => 'Material actualizado exitosamente.',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $raw_material = Raw_material::find($id);

        if (!$raw_material) {
            return response()->json([
                'success' => false,
                'message' => 'Material no encontrado.',
            ], 404);
        }

        $raw_material->delete();

        return response()->json([
            'success' => true,
            'message' => 'Material eliminado exitosamente.',
        ], 200);
    }
}
