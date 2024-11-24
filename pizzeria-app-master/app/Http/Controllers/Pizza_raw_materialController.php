<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pizza_raw_material;
use Illuminate\Support\Facades\DB;

class Pizza_raw_materialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pizza_raw_materials = Pizza_raw_material::with(['pizza', 'raw_material'])->get();
        return view('pizza_raw_material.index', ['pizza_raw_materials' => $pizza_raw_materials]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener las pizzas desde la tabla de pizzas
        $pizzas = DB::table('pizzas')->get();

        // Obtener los materiales desde la tabla de materiales (cambia 'raw_materials' si el nombre es otro)
        $raw_materials = DB::table('raw_materials')->get();

        return view('pizza_raw_material.new', [
            'pizzas' => $pizzas,
            'raw_materials' => $raw_materials
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pizza_raw_material = new Pizza_raw_material();
        $pizza_raw_material->pizza_id = $request->pizza_id;
        $pizza_raw_material->raw_material_id = $request->raw_material_id;
        $pizza_raw_material->quantity = $request->quantity;

        $pizza_raw_material->save();

        $pizza_raw_materials = DB::table('pizza_raw_material')->get();

        return redirect()->route('pizza_raw_materials.index')->with('success', 'Materiales Pizza creado exitosamente.');
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
        $pizza_raw_material = Pizza_raw_material::find($id);

        // Obtener todos las pizza y materias primas para los select
        $pizzas = DB::table('pizzas')->get();
        $raw_materials = DB::table('raw_materials')->get();

        return view('pizza_raw_material.edit', compact('pizza_raw_material', 'pizzas', 'raw_materials'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pizza_raw_material = Pizza_raw_material::find($id);

        $pizza_raw_material->pizza_id = $request->pizza_id;
        $pizza_raw_material->raw_material_id = $request->raw_material_id;
        $pizza_raw_material->quantity = $request->quantity;

        $pizza_raw_material->save();

        $pizza_raw_materials = DB::table('pizza_raw_material')->get();

        return redirect()->route('pizza_raw_materials.index')->with('success', 'Materiales Pizza editado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pizza_raw_material = Pizza_raw_material::find($id);
        $pizza_raw_material->delete();
        return redirect()->route('pizza_raw_materials.index')->with('success', 'Materiales Pizza eliminado exitosamente.');
    }
}
