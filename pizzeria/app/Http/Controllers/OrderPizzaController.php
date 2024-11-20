<?php

namespace App\Http\Controllers;

use App\Models\OrderPizza;
use App\Models\Order;
use App\Models\PizzaSize;
use Illuminate\Http\Request;

class OrderPizzaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'pizza_size_id' => 'required|exists:pizza_size,id',
            'quantity' => 'required|integer',
        ]);

        OrderPizza::create([
            'order_id' => $request->order_id,
            'pizza_size_id' => $request->pizza_size_id,
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('orders.show', $request->order_id);
    }

    public function destroy(OrderPizza $orderPizza)
    {
        $orderPizza->delete();
        return redirect()->route('orders.show', $orderPizza->order_id);
    }
}

