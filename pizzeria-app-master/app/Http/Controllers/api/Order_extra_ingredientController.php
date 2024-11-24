<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Models\Order_extra_ingredient;
use App\Http\Controllers\Controller;

class Order_extra_ingredientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orderExtraIngredients = Order_extra_ingredient::with(['extra_ingredient', 'order'])->get();

        return response()->json([
            'success' => true,
            'data' => $orderExtraIngredients,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'extra_ingredient_id' => 'required|exists:extra_ingredients,id',
            'order_id' => 'required|exists:orders,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $orderExtraIngredient = Order_extra_ingredient::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Order extra ingredient created successfully.',
            'data' => $orderExtraIngredient,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $orderExtraIngredient = Order_extra_ingredient::with(['extra_ingredient', 'order'])->find($id);

        if (!$orderExtraIngredient) {
            return response()->json([
                'success' => false,
                'message' => 'Order extra ingredient not found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $orderExtraIngredient,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $orderExtraIngredient = Order_extra_ingredient::find($id);

        if (!$orderExtraIngredient) {
            return response()->json([
                'success' => false,
                'message' => 'Order extra ingredient not found.',
            ], 404);
        }

        $validated = $request->validate([
            'extra_ingredient_id' => 'required|exists:extra_ingredients,id',
            'order_id' => 'required|exists:orders,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $orderExtraIngredient->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Order extra ingredient updated successfully.',
            'data' => $orderExtraIngredient,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $orderExtraIngredient = Order_extra_ingredient::find($id);

        if (!$orderExtraIngredient) {
            return response()->json([
                'success' => false,
                'message' => 'Order extra ingredient not found.',
            ], 404);
        }

        $orderExtraIngredient->delete();

        return response()->json([
            'success' => true,
            'message' => 'Order extra ingredient deleted successfully.',
        ], 200);
    }
}
