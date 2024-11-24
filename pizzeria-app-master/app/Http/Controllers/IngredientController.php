<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredient;
use Illuminate\Support\Facades\DB;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ingredients = Ingredient::with('pizza')->get();
        return view('ingredient.index', ['ingredients' => $ingredients]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pizzas = DB::table('pizzas')->get();
        return view('ingredient.new', ['pizzas' => $pizzas]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $ingredient = new Ingredient();   
        $ingredient->name = $request->name; 
        $ingredient->save();
        $ingredients = DB::table('ingredients')->get();
        return redirect()->route('ingredients.index')->with('success', 'ingredientes escogida exitosamente.');
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
        $ingredient = Ingredient::find($id);
        $pizzas = DB::table('pizzas')->get(); 
        return view('ingredient.edit', compact('ingredient', 'pizzas'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ingredient = Ingredient::find($id);
        $ingredient->name = $request->name; 
        $ingredient->save();
        $ingredients = DB::table('ingredients')->get();
        return redirect()->route('ingredients.index')->with('success', 'ingredientes escogida exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ingredient = Ingredient::find($id);
        $ingredient->delete();
        return redirect()->route('ingredients.index')->with('success', 'Ingredientes eliminados exitosamente.');
    }
}
