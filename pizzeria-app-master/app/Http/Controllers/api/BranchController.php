<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $branches = Branch::all();
        return response()->json([
            'branches' => $branches,
        ], 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Store a newly created resource in storage.
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'statusCode' => 400,
            ]);
        }

        // Crear nueva sucursal
        $branch = Branch::create([
            'name' => $request->name,
            'address' => $request->address,
        ]);

        return response()->json([
            'branch' => $branch,
            'msg' => 'Sucursal creada exitosamente.',
        ], 201, [], JSON_PRETTY_PRINT);
    }

    /**
     * Display the specified resource.
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id)
    {
        $branch = Branch::find($id);

        if (is_null($branch)) {
            return response()->json([
                'msg' => 'Sucursal no encontrada.',
            ], 404);
        }

        return response()->json([
            'branch' => $branch,
        ], 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Update the specified resource in storage.
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, string $id)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'statusCode' => 400,
            ]);
        }

        $branch = Branch::find($id);

        if (is_null($branch)) {
            return response()->json([
                'msg' => 'Sucursal no encontrada.',
            ], 404);
        }

        $branch->update([
            'name' => $request->name,
            'address' => $request->address,
        ]);

        return response()->json([
            'branch' => $branch,
            'msg' => 'Sucursal actualizada exitosamente.',
        ], 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $id)
    {
        $branch = Branch::find($id);

        if (is_null($branch)) {
            return response()->json([
                'msg' => 'Sucursal no encontrada.',
            ], 404);
        }

        $branch->delete();

        return response()->json([
            'msg' => 'Sucursal eliminada exitosamente.',
        ], 200, [], JSON_PRETTY_PRINT);
    }
}
