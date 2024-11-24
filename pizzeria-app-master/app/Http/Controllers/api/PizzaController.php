<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Pizza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PizzaController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $pizzas = Pizza::all();
        return response()->json(['pizzas' => $pizzas], 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Store a newly created resource in storage.
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:100', 'unique:pizzas,name']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'statusCode' => 400
            ]);
        }

        $pizza = new Pizza();
        $pizza->name = $request->name;
        $pizza->save();

        return response()->json(['pizza' => $pizza, 'msg' => 'Pizza creada exitosamente.'], 201, [], JSON_PRETTY_PRINT);
    }

    /**
     * Display the specified resource.
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id)
    {
        $pizza = Pizza::find($id);

        if (is_null($pizza)) {
            return response()->json(['msg' => 'Pizza no encontrada'], 404);
        }

        return response()->json(['pizza' => $pizza], 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Update the specified resource in storage.
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:100', 'unique:pizzas,name,' . $id]
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'statusCode' => 400
            ]);
        }

        $pizza = Pizza::find($id);

        if (is_null($pizza)) {
            return response()->json(['msg' => 'Pizza no encontrada'], 404);
        }

        $pizza->name = $request->name;
        $pizza->save();

        return response()->json(['pizza' => $pizza, 'msg' => 'Pizza actualizada exitosamente.'], 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $id)
    {
        $pizza = Pizza::find($id);

        if (is_null($pizza)) {
            return response()->json(['msg' => 'Pizza no encontrada'], 404);
        }

        $pizza->delete();

        return response()->json(['msg' => 'Pizza eliminada exitosamente.'], 200);
    }
}
