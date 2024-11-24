<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pizza_Ingredient;
use Illuminate\Support\Facades\DB;

class Pizza_IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pizza_ingredients = Pizza_Ingredient::with(['pizza', 'ingredient'])->get();
        return view('pizza_ingredient.index', ['pizza_ingredients' => $pizza_ingredients]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener las pizzas desde la tabla de pizzas
        $pizzas = DB::table('pizzas')->get();

        // Obtener los materiales desde la tabla de materiales (cambia 'raw_materials' si el nombre es otro)
        $ingredients = DB::table('ingredients')->get();

        return view('pizza_ingredient.new', [
            'pizzas' => $pizzas,
            'ingredients' => $ingredients
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pizza_ingredient = new pizza_ingredient();
        $pizza_ingredient->pizza_id = $request->pizza_id;
        $pizza_ingredient->ingredient_id = $request->ingredient_id;

        $pizza_ingredient->save();

        $pizza_ingredients = DB::table('pizza_ingredient')->get();

        return redirect()->route('pizza_ingredients.index')->with('success', 'Ingredientes Pizza creado exitosamente.');
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
        $pizza_ingredient = Pizza_Ingredient::find($id);

        // Obtener todos las pizza y materias primas para los select
        $pizzas = DB::table('pizzas')->get();
        $ingredients = DB::table('ingredients')->get();

        return view('pizza_ingredient.edit', compact('pizza_ingredient', 'pizzas', 'ingredients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pizza_ingredient = Pizza_Ingredient::find($id);

        $pizza_ingredient->pizza_id = $request->pizza_id;
        $pizza_ingredient->ingredient_id = $request->ingredient_id;

        $pizza_ingredient->save();

        $pizza_ingredients = DB::table('pizza_ingredient')->get();

        return redirect()->route('pizza_ingredients.index')->with('success', 'Ingredientes de Pizza editado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pizza_ingredient = Pizza_Ingredient::find($id);
        $pizza_ingredient->delete();
        return redirect()->route('pizza_ingredients.index')->with('success', 'Ingredientes de Pizza eliminado exitosamente.');
    }
}

