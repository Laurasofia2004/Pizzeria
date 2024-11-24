<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order_extra_ingredient;
use Illuminate\Support\Facades\DB;

class Order_extra_ingredientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order_extra_ingredients = Order_extra_ingredient::with(['extra_ingredient', 'order'])->get();
        return view('order_extra_ingredient.index', ['order_extra_ingredients' => $order_extra_ingredients]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener las pizzas desde la tabla de pizza size
        $extra_ingredients = DB::table('extra_ingredients')->get();

        // Obtener los materiales desde la tabla de orders
        $orders = DB::table('orders')->get();

        return view('order_extra_ingredient.new', [
            'extra_ingredients' => $extra_ingredients,
            'orders' => $orders
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $order_extra_ingredient = new Order_extra_ingredient();
        $order_extra_ingredient->extra_ingredient_id = $request->extra_ingredient_id; //size
        $order_extra_ingredient->order_id = $request->order_id; //order
        $order_extra_ingredient->quantity = $request->quantity;

        $order_extra_ingredient->save();

        $order_extra_ingredients = DB::table('order_extra_ingredient')->get();

        return redirect()->route('order_extra_ingredients.index')->with('success', 'Orden de extra ingredients creada exitosamente.');
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
        $order_extra_ingredient = Order_extra_ingredient::find($id);

        // obtener extra ingredientes y ordenes
        $orders = DB::table('orders')->get(); // Obtiene todas las órdenes
        $extra_ingredients = DB::table('extra_ingredients')->get(); // Obtiene todos los extra ingredients

        return view('order_extra_ingredient.edit', compact('order_extra_ingredient', 'orders', 'extra_ingredients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $order_extra_ingredient = Order_extra_ingredient::find($id);

        $order_extra_ingredient->extra_ingredient_id = $request->extra_ingredient_id; //extra
        $order_extra_ingredient->order_id = $request->order_id; //order
        $order_extra_ingredient->quantity = $request->quantity;

        $order_extra_ingredient->save();

        $order_extra_ingredients = DB::table('order_extra_ingredient')->get();

        return redirect()->route('order_extra_ingredients.index')->with('success', 'Orden de extra ingredients editada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order_extra_ingredient = Order_extra_ingredient::find($id);
        $order_extra_ingredient->delete();
        return redirect()->route('order_extra_ingredients.index')->with('success', 'order_extra_ingredient eliminado exitosamente.');
    }
}
