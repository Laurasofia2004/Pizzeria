<?php

namespace App\Http\Controllers;

use App\Models\OrderExtraIngredient;
use App\Models\Order;
use App\Models\ExtraIngredient;
use Illuminate\Http\Request;

class OrderExtraIngredientController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'extra_ingredient_id' => 'required|exists:extra_ingredients,id',
            'quantity' => 'required|integer',
        ]);

        OrderExtraIngredient::create([
            'order_id' => $request->order_id,
            'extra_ingredient_id' => $request->extra_ingredient_id,
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('orders.show', $request->order_id);
    }

    public function destroy(OrderExtraIngredient $orderExtraIngredient)
    {
        $orderExtraIngredient->delete();
        return redirect()->route('orders.show', $orderExtraIngredient->order_id);
    }
}
