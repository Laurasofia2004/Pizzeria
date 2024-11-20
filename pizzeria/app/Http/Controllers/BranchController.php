<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Mostrar una lista de las sucursales.
     */
    public function index()
    {
        $branches = Branch::all();
        return view('branches.index', compact('branches'));
    }

    /**
     * Mostrar el formulario para crear una nueva sucursal.
     */
    public function create()
    {
        return view('branches.create');
    }

    /**
     * Almacenar una nueva sucursal en la base de datos.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        Branch::create($validated);

        return redirect()->route('branches.index');
    }

    /**
     * Mostrar una sucursal específica.
     */
    public function show(Branch $branch)
    {
        return view('branches.show', compact('branch'));
    }

    /**
     * Mostrar el formulario para editar una sucursal.
     */
    public function edit(Branch $branch)
    {
        return view('branches.edit', compact('branch'));
    }

    /**
     * Actualizar una sucursal en la base de datos.
     */
    public function update(Request $request, Branch $branch)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        $branch->update($validated);

        return redirect()->route('branches.index');
    }

    /**
     * Eliminar una sucursal de la base de datos.
     */
    public function destroy(Branch $branch)
    {
        $branch->delete();
        return redirect()->route('branches.index');
    }
}
