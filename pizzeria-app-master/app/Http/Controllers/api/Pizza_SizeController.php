<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Pizza_Size;
use App\Models\Pizza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Pizza_SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $pizza_sizes = Pizza_Size::with('pizza')->get();
        return response()->json(['pizza_sizes' => $pizza_sizes], 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Store a newly created resource in storage.
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pizza_id' => ['required', 'exists:pizzas,id'],
            'size' => ['required', 'string', 'max:50'],
            'price' => ['required', 'numeric', 'min:0'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'statusCode' => 400
            ]);
        }

        $pizza_size = new Pizza_Size();
        $pizza_size->pizza_id = $request->pizza_id;
        $pizza_size->size = $request->size;
        $pizza_size->price = $request->price;
        $pizza_size->save();

        return response()->json(['pizza_size' => $pizza_size, 'msg' => 'Tamaño de pizza creado exitosamente.'], 201, [], JSON_PRETTY_PRINT);
    }

    /**
     * Display the specified resource.
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id)
    {
        $pizza_size = Pizza_Size::with('pizza')->find($id);

        if (is_null($pizza_size)) {
            return response()->json(['msg' => 'Tamaño de pizza no encontrado'], 404);
        }

        return response()->json(['pizza_size' => $pizza_size], 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Update the specified resource in storage.
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'pizza_id' => ['required', 'exists:pizzas,id'],
            'size' => ['required', 'string', 'max:50'],
            'price' => ['required', 'numeric', 'min:0'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'statusCode' => 400
            ]);
        }

        $pizza_size = Pizza_Size::find($id);

        if (is_null($pizza_size)) {
            return response()->json(['msg' => 'Tamaño de pizza no encontrado'], 404);
        }

        $pizza_size->pizza_id = $request->pizza_id;
        $pizza_size->size = $request->size;
        $pizza_size->price = $request->price;
        $pizza_size->save();

        return response()->json(['pizza_size' => $pizza_size, 'msg' => 'Tamaño de pizza actualizado exitosamente.'], 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $id)
    {
        $pizza_size = Pizza_Size::find($id);

        if (is_null($pizza_size)) {
            return response()->json(['msg' => 'Tamaño de pizza no encontrado'], 404);
        }

        $pizza_size->delete();

        return response()->json(['msg' => 'Tamaño de pizza eliminado exitosamente.'], 200);
    }
}
