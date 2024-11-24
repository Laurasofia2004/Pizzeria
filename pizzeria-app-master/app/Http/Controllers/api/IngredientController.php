<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $ingredients = Ingredient::with('pizza')->get();
        return response()->json(['ingredients' => $ingredients], 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Store a newly created resource in storage.
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:50'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'statusCode' => 400
            ]);
        }

        $ingredient = new Ingredient();
        $ingredient->name = $request->name;
        $ingredient->save();

        return response()->json(['ingredient' => $ingredient, 'msg' => 'Ingrediente creado exitosamente.'], 201, [], JSON_PRETTY_PRINT);
    }

    /**
     * Display the specified resource.
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id)
    {
        $ingredient = Ingredient::with('pizza')->find($id);

        if (is_null($ingredient)) {
            return response()->json(['msg' => 'Ingrediente no encontrado'], 404);
        }

        return response()->json(['ingredient' => $ingredient], 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Update the specified resource in storage.
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:50'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'statusCode' => 400
            ]);
        }

        $ingredient = Ingredient::find($id);

        if (is_null($ingredient)) {
            return response()->json(['msg' => 'Ingrediente no encontrado'], 404);
        }

        $ingredient->name = $request->name;
        $ingredient->save();

        return response()->json(['ingredient' => $ingredient, 'msg' => 'Ingrediente actualizado exitosamente.'], 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $id)
    {
        $ingredient = Ingredient::find($id);

        if (is_null($ingredient)) {
            return response()->json(['msg' => 'Ingrediente no encontrado'], 404);
        }

        $ingredient->delete();

        return response()->json(['msg' => 'Ingrediente eliminado exitosamente.'], 200);
    }
}
