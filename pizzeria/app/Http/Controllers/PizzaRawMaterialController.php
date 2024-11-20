<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use App\Models\RawMaterial;
use Illuminate\Http\Request;

class PizzaRawMaterialController extends Controller
{
    /**
     * Mostrar la lista de relaciones entre pizzas y materias primas.
     */
    public function index()
    {
        $pizzas = Pizza::with('rawMaterials')->get();
        return view('pizza_raw_materials.index', compact('pizzas'));
    }

    /**
     * Mostrar el formulario para asociar materias primas a una pizza.
     */
    public function create()
    {
        $pizzas = Pizza::all();
        $rawMaterials = RawMaterial::all();
        return view('pizza_raw_materials.create', compact('pizzas', 'rawMaterials'));
    }

    /**
     * Almacenar una nueva relación entre pizza y materia prima.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pizza_id' => 'required|exists:pizzas,id',
            'raw_material_id' => 'required|exists:raw_materials,id',
            'quantity' => 'required|numeric|min:0',
        ]);

        $pizza = Pizza::find($request->pizza_id);
        $pizza->rawMaterials()->attach($request->raw_material_id, ['quantity' => $request->quantity]);

        return redirect()->route('pizza_raw_materials.index');
    }

    /**
     * Mostrar los detalles de una relación específica.
     */
    public function show(Pizza $pizza)
    {
        $pizza->load('rawMaterials');
        return view('pizza_raw_materials.show', compact('pizza'));
    }

    /**
     * Mostrar el formulario para editar una relación entre pizza y materia prima.
     */
    public function edit(Pizza $pizza, RawMaterial $rawMaterial)
    {
        $pizza->load('rawMaterials');
        return view('pizza_raw_materials.edit', compact('pizza', 'rawMaterial'));
    }

    /**
     * Actualizar una relación existente entre pizza y materia prima.
     */
    public function update(Request $request, Pizza $pizza, RawMaterial $rawMaterial)
    {
        $validated = $request->validate([
            'quantity' => 'required|numeric|min:0',
        ]);

        $pizza->rawMaterials()->updateExistingPivot($rawMaterial->id, ['quantity' => $request->quantity]);

        return redirect()->route('pizza_raw_materials.index');
    }

    /**
     * Eliminar una relación entre pizza y materia prima.
     */
    public function destroy(Pizza $pizza, RawMaterial $rawMaterial)
    {
        $pizza->rawMaterials()->detach($rawMaterial->id);
        return redirect()->route('pizza_raw_materials.index');
    }
}
