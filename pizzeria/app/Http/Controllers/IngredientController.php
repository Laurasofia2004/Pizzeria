<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    /**
     * Mostrar una lista de los ingredientes.
     */
    public function index()
    {
        $ingredients = Ingredient::all();
        return view('ingredients.index', compact('ingredients'));
    }

    /**
     * Mostrar el formulario para crear un nuevo ingrediente.
     */
    public function create()
    {
        return view('ingredients.create');
    }

    /**
     * Almacenar un nuevo ingrediente en la base de datos.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Ingredient::create($validated);

        return redirect()->route('ingredients.index');
    }

    /**
     * Mostrar un ingrediente específico.
     */
    public function show(Ingredient $ingredient)
    {
        return view('ingredients.show', compact('ingredient'));
    }

    /**
     * Mostrar el formulario para editar un ingrediente.
     */
    public function edit(Ingredient $ingredient)
    {
        return view('ingredients.edit', compact('ingredient'));
    }

    /**
     * Actualizar un ingrediente en la base de datos.
     */
    public function update(Request $request, Ingredient $ingredient)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $ingredient->update($validated);

        return redirect()->route('ingredients.index');
    }

    /**
     * Eliminar un ingrediente de la base de datos.
     */
    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();
        return redirect()->route('ingredients.index');
    }
}
