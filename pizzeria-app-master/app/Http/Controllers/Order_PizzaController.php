<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order_pizza;
use Illuminate\Support\Facades\DB;

class Order_PizzaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order_pizzas = Order_pizza::with(['pizza_size', 'order'])->get();
        return view('order_pizza.index', ['order_pizzas' => $order_pizzas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener las pizzas desde la tabla de pizza size
        $pizza_size = DB::table('pizza_size')->get();

        // Obtener los materiales desde la tabla de orders
        $orders = DB::table('orders')->get();

        return view('order_pizza.new', [
            'pizza_size' => $pizza_size,
            'orders' => $orders
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $order_pizza = new Order_pizza();
        $order_pizza->pizza_size_id = $request->pizza_size_id; //size
        $order_pizza->order_id = $request->order_id; //order
        $order_pizza->quantity = $request->quantity;

        $order_pizza->save();

        $order_pizzas = DB::table('order_pizza')->get();

        return redirect()->route('order_pizzas.index')->with('success', 'Orden de Pizza creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $order_pizza = Order_pizza::find($id);

        // obtener size y ordenes
        $orders = DB::table('orders')->get(); // Obtiene todas las órdenes
        $pizza_size = DB::table('pizza_size')->get(); // Obtiene todos los tamaños de pizza

        return view('order_pizza.edit', compact('order_pizza', 'orders', 'pizza_size'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $order_pizza = Order_pizza::find($id);


        $order_pizza->pizza_size_id = $request->pizza_size_id; //size
        $order_pizza->order_id = $request->order_id; //order
        $order_pizza->quantity = $request->quantity;

        $order_pizza->save();

        $order_pizzas = DB::table('order_pizza')->get();

        return redirect()->route('order_pizzas.index')->with('success', 'Orden de Pizza editada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order_pizza = Order_pizza::find($id);
        $order_pizza->delete();
        return redirect()->route('order_pizzas.index')->with('success', 'Orden de Pizza eliminado exitosamente.');
    }
}
