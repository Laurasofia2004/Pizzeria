<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use App\Models\Ingredient;
use Illuminate\Http\Request;

class PizzaController extends Controller
{
    /**
     * Mostrar una lista de las pizzas.
     */
    public function index()
    {
        $pizzas = Pizza::with('ingredients')->get(); // Incluye los ingredientes relacionados
        return view('pizzas.index', compact('pizzas'));
    }

    /**
     * Mostrar el formulario para crear una nueva pizza.
     */
    public function create()
    {
        $ingredients = Ingredient::all(); // Recupera todos los ingredientes disponibles
        return view('pizzas.create', compact('ingredients'));
    }

    /**
     * Almacenar una nueva pizza en la base de datos.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'ingredients' => 'nullable|array', // Los ingredientes pueden ser opcionales
            'ingredients.*' => 'exists:ingredients,id', // Cada ingrediente debe existir
        ]);

        // Crear la pizza
        $pizza = Pizza::create([
            'name' => $request->name,
        ]);

        // Asociar los ingredientes a la pizza (si se seleccionaron)
        if ($request->has('ingredients')) {
            $pizza->ingredients()->attach($request->ingredients);
        }

        return redirect()->route('pizzas.index');
    }

    /**
     * Mostrar una pizza específica.
     */
    public function show(Pizza $pizza)
    {
        $pizza->load('ingredients'); // Carga los ingredientes relacionados
        return view('pizzas.show', compact('pizza'));
    }

    /**
     * Mostrar el formulario para editar una pizza.
     */
    public function edit(Pizza $pizza)
    {
        $ingredients = Ingredient::all(); // Recupera todos los ingredientes disponibles
        $pizza->load('ingredients'); // Carga los ingredientes de la pizza
        return view('pizzas.edit', compact('pizza', 'ingredients'));
    }

    /**
     * Actualizar una pizza en la base de datos.
     */
    public function update(Request $request, Pizza $pizza)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'ingredients' => 'nullable|array', // Los ingredientes pueden ser opcionales
            'ingredients.*' => 'exists:ingredients,id', // Cada ingrediente debe existir
        ]);

        // Actualizar la pizza
        $pizza->update([
            'name' => $request->name,
        ]);

        // Actualizar los ingredientes asociados a la pizza
        if ($request->has('ingredients')) {
            $pizza->ingredients()->sync($request->ingredients);
        }

        return redirect()->route('pizzas.index');
    }

    /**
     * Eliminar una pizza de la base de datos.
     */
    public function destroy(Pizza $pizza)
    {
        $pizza->delete();
        return redirect()->route('pizzas.index');
    }
}
