<?php

namespace App\Http\Controllers;

use App\Models\RawMaterial;
use Illuminate\Http\Request;

class RawMaterialController extends Controller
{
    /**
     * Mostrar una lista de las materias primas.
     */
    public function index()
    {
        $rawMaterials = RawMaterial::all();
        return view('raw_materials.index', compact('rawMaterials'));
    }

    /**
     * Mostrar el formulario para crear una nueva materia prima.
     */
    public function create()
    {
        return view('raw_materials.create');
    }

    /**
     * Almacenar una nueva materia prima en la base de datos.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'unit' => 'required|string|max:50',
            'current_stock' => 'required|numeric|min:0',
        ]);

        RawMaterial::create($validated);

        return redirect()->route('raw_materials.index');
    }

    /**
     * Mostrar una materia prima específica.
     */
    public function show(RawMaterial $rawMaterial)
    {
        return view('raw_materials.show', compact('rawMaterial'));
    }

    /**
     * Mostrar el formulario para editar una materia prima.
     */
    public function edit(RawMaterial $rawMaterial)
    {
        return view('raw_materials.edit', compact('rawMaterial'));
    }

    /**
     * Actualizar una materia prima en la base de datos.
     */
    public function update(Request $request, RawMaterial $rawMaterial)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'unit' => 'required|string|max:50',
            'current_stock' => 'required|numeric|min:0',
        ]);

        $rawMaterial->update($validated);

        return redirect()->route('raw_materials.index');
    }

    /**
     * Eliminar una materia prima de la base de datos.
     */
    public function destroy(RawMaterial $rawMaterial)
    {
        $rawMaterial->delete();
        return redirect()->route('raw_materials.index');
    }
}
