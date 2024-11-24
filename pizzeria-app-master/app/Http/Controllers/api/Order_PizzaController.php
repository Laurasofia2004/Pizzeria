<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order_pizza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Order_PizzaController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $orderPizzas = Order_pizza::with(['pizza_size', 'order'])->get();

        return response()->json([
            'order_pizzas' => $orderPizzas,
        ], 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'pizza_size_id' => 'required|exists:pizza_size,id',
            'order_id' => 'required|exists:orders,id',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
            ], 400);
        }

        // Crear la orden de pizza
        $orderPizza = Order_pizza::create([
            'pizza_size_id' => $request->pizza_size_id,
            'order_id' => $request->order_id,
            'quantity' => $request->quantity,
        ]);

        return response()->json([
            'order_pizza' => $orderPizza,
            'msg' => 'Orden de pizza creada exitosamente.',
        ], 201, [], JSON_PRETTY_PRINT);
    }

    /**
     * Display the specified resource.
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id)
    {
        $orderPizza = Order_pizza::with(['pizza_size', 'order'])->find($id);

        if (is_null($orderPizza)) {
            return response()->json([
                'msg' => 'Orden de pizza no encontrada.',
            ], 404);
        }

        return response()->json([
            'order_pizza' => $orderPizza,
        ], 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, string $id)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'pizza_size_id' => 'required|exists:pizza_size,id',
            'order_id' => 'required|exists:orders,id',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
            ], 400);
        }

        $orderPizza = Order_pizza::find($id);

        if (is_null($orderPizza)) {
            return response()->json([
                'msg' => 'Orden de pizza no encontrada.',
            ], 404);
        }

        // Actualizar la orden de pizza
        $orderPizza->update([
            'pizza_size_id' => $request->pizza_size_id,
            'order_id' => $request->order_id,
            'quantity' => $request->quantity,
        ]);

        return response()->json([
            'order_pizza' => $orderPizza,
            'msg' => 'Orden de pizza actualizada exitosamente.',
        ], 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Remove the specified resource from storage.
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $id)
    {
        $orderPizza = Order_pizza::find($id);

        if (is_null($orderPizza)) {
            return response()->json([
                'msg' => 'Orden de pizza no encontrada.',
            ], 404);
        }

        $orderPizza->delete();

        return response()->json([
            'msg' => 'Orden de pizza eliminada exitosamente.',
        ], 200, [], JSON_PRETTY_PRINT);
    }
}
