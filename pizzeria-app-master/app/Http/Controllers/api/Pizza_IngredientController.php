<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Pizza_Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Pizza_IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $pizza_ingredients = Pizza_Ingredient::with(['pizza', 'ingredient'])->get();
        return response()->json(['pizza_ingredients' => $pizza_ingredients], 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Store a newly created resource in storage.
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pizza_id' => ['required', 'exists:pizzas,id'],
            'ingredient_id' => ['required', 'exists:ingredients,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'statusCode' => 400
            ]);
        }

        $pizza_ingredient = new Pizza_Ingredient();
        $pizza_ingredient->pizza_id = $request->pizza_id;
        $pizza_ingredient->ingredient_id = $request->ingredient_id;
        $pizza_ingredient->save();

        return response()->json(['pizza_ingredient' => $pizza_ingredient, 'msg' => 'Ingrediente de Pizza creado exitosamente.'], 201, [], JSON_PRETTY_PRINT);
    }

    /**
     * Display the specified resource.
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id)
    {
        $pizza_ingredient = Pizza_Ingredient::with(['pizza', 'ingredient'])->find($id);

        if (is_null($pizza_ingredient)) {
            return response()->json(['msg' => 'Ingrediente de Pizza no encontrado'], 404);
        }

        return response()->json(['pizza_ingredient' => $pizza_ingredient], 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Update the specified resource in storage.
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'pizza_id' => ['required', 'exists:pizzas,id'],
            'ingredient_id' => ['required', 'exists:ingredients,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'statusCode' => 400
            ]);
        }

        $pizza_ingredient = Pizza_Ingredient::find($id);

        if (is_null($pizza_ingredient)) {
            return response()->json(['msg' => 'Ingrediente de Pizza no encontrado'], 404);
        }

        $pizza_ingredient->pizza_id = $request->pizza_id;
        $pizza_ingredient->ingredient_id = $request->ingredient_id;
        $pizza_ingredient->save();

        return response()->json(['pizza_ingredient' => $pizza_ingredient, 'msg' => 'Ingrediente de Pizza actualizado exitosamente.'], 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $id)
    {
        $pizza_ingredient = Pizza_Ingredient::find($id);

        if (is_null($pizza_ingredient)) {
            return response()->json(['msg' => 'Ingrediente de Pizza no encontrado'], 404);
        }

        $pizza_ingredient->delete();

        return response()->json(['msg' => 'Ingrediente de Pizza eliminado exitosamente.'], 200);
    }
}
