<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\PizzaSize;
use App\Models\ExtraIngredient;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $pizzas = PizzaSize::all();
        $extraIngredients = ExtraIngredient::all();
        return view('orders.create', compact('pizzas', 'extraIngredients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'total_price' => 'required|numeric',
            'status' => 'required',
            'delivery_type' => 'required',
            'pizza_sizes' => 'required|array',
            'extra_ingredients' => 'nullable|array',
        ]);

        $order = Order::create($validated);
        $order->pizzas()->attach($request->pizza_sizes);
        if ($request->has('extra_ingredients')) {
            $order->extraIngredients()->attach($request->extra_ingredients);
        }

        return redirect()->route('orders.index');
    }

    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        $pizzas = PizzaSize::all();
        $extraIngredients = ExtraIngredient::all();
        return view('orders.edit', compact('order', 'pizzas', 'extraIngredients'));
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'total_price' => 'required|numeric',
            'status' => 'required',
            'delivery_type' => 'required',
            'pizza_sizes' => 'required|array',
            'extra_ingredients' => 'nullable|array',
        ]);

        $order->update($validated);
        $order->pizzas()->sync($request->pizza_sizes);
        if ($request->has('extra_ingredients')) {
            $order->extraIngredients()->sync($request->extra_ingredients);
        }

        return redirect()->route('orders.index');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index');
    }
}
