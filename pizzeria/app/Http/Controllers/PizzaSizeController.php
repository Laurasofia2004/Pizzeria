<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use App\Models\PizzaSize;
use Illuminate\Http\Request;

class PizzaSizeController extends Controller
{
    /**
     * Mostrar una lista de los tamaños de pizza.
     */
    public function index()
    {
        $pizzaSizes = PizzaSize::with('pizza')->get(); // Cargar las relaciones con las pizzas
        return view('pizza_sizes.index', compact('pizzaSizes'));
    }

    /**
     * Mostrar el formulario para crear un nuevo tamaño de pizza.
     */
    public function create()
    {
        $pizzas = Pizza::all(); // Obtener todas las pizzas disponibles
        return view('pizza_sizes.create', compact('pizzas'));
    }

    /**
     * Almacenar un nuevo tamaño de pizza en la base de datos.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pizza_id' => 'required|exists:pizzas,id',
            'size' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        PizzaSize::create($validated);

        return redirect()->route('pizza_sizes.index');
    }

    /**
     * Mostrar un tamaño de pizza específico.
     */
    public function show(PizzaSize $pizzaSize)
    {
        $pizzaSize->load('pizza'); // Cargar la relación con la pizza
        return view('pizza_sizes.show', compact('pizzaSize'));
    }

    /**
     * Mostrar el formulario para editar un tamaño de pizza.
     */
    public function edit(PizzaSize $pizzaSize)
    {
        $pizzas = Pizza::all(); // Obtener todas las pizzas disponibles
        return view('pizza_sizes.edit', compact('pizzaSize', 'pizzas'));
    }

    /**
     * Actualizar un tamaño de pizza en la base de datos.
     */
    public function update(Request $request, PizzaSize $pizzaSize)
    {
        $validated = $request->validate([
            'pizza_id' => 'required|exists:pizzas,id',
            'size' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        $pizzaSize->update($validated);

        return redirect()->route('pizza_sizes.index');
    }

    /**
     * Eliminar un tamaño de pizza de la base de datos.
     */
    public function destroy(PizzaSize $pizzaSize)
    {
        $pizzaSize->delete();
        return redirect()->route('pizza_sizes.index');
    }
}
