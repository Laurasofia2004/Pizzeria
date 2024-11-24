<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ExtraIngredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExtraIngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $extraIngredients = ExtraIngredient::all();
        return response()->json([
            'extra_ingredients' => $extraIngredients,
        ], 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Store a newly created resource in storage.
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'statusCode' => 400,
            ]);
        }

        $extraIngredient = ExtraIngredient::create([
            'name' => $request->name,
            'price' => $request->price,
        ]);

        return response()->json([
            'extra_ingredient' => $extraIngredient,
            'msg' => 'Ingrediente extra creado exitosamente.',
        ], 201, [], JSON_PRETTY_PRINT);
    }

    /**
     * Display the specified resource.
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id)
    {
        $extraIngredient = ExtraIngredient::find($id);

        if (is_null($extraIngredient)) {
            return response()->json([
                'msg' => 'Ingrediente extra no encontrado.',
            ], 404);
        }

        return response()->json([
            'extra_ingredient' => $extraIngredient,
        ], 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Update the specified resource in storage.
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'statusCode' => 400,
            ]);
        }

        $extraIngredient = ExtraIngredient::find($id);

        if (is_null($extraIngredient)) {
            return response()->json([
                'msg' => 'Ingrediente extra no encontrado.',
            ], 404);
        }

        $extraIngredient->update([
            'name' => $request->name,
            'price' => $request->price,
        ]);

        return response()->json([
            'extra_ingredient' => $extraIngredient,
            'msg' => 'Ingrediente extra actualizado exitosamente.',
        ], 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $id)
    {
        $extraIngredient = ExtraIngredient::find($id);

        if (is_null($extraIngredient)) {
            return response()->json([
                'msg' => 'Ingrediente extra no encontrado.',
            ], 404);
        }

        $extraIngredient->delete();

        return response()->json([
            'msg' => 'Ingrediente extra eliminado exitosamente.',
        ], 200, [], JSON_PRETTY_PRINT);
    }
}
