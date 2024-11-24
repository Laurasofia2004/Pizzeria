<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Raw_material;
use Illuminate\Support\Facades\DB;

class Raw_materialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $raw_materials = Raw_material::all();
        return view('raw_material.index', ['raw_materials' => $raw_materials]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $raw_materials = DB::table('raw_materials');
        return view('raw_material.new', ['raw_materials' => $raw_materials]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $raw_material = new Raw_material();
        $raw_material->name = $request->name;
        $raw_material->unit = $request->unit;
        $raw_material->current_stock = $request->current_stock;
        $raw_material->save();

        $raw_materials = DB::table('raw_materials')->get();

        return redirect()->route('raw_materials.index')->with('success', 'Producto creado exitosamente.');
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
        $raw_material = Raw_material::find($id);
        $raw_materials = DB::table('raw_materials')->get();
        return view('raw_material.edit', compact('raw_material'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $raw_material = Raw_material::find($id);

        $raw_material->name = $request->name;
        $raw_material->unit = $request->unit;
        $raw_material->current_stock = $request->current_stock;
        $raw_material->save();

        $raw_materials = DB::table('raw_materials')->get();

        return redirect()->route('raw_materials.index')->with('success', 'Producto editado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $raw_material = Raw_material::find($id);
        $raw_material->delete();
        return redirect()->route('raw_materials.index')->with('success', 'Producto eliminado exitosamente.');
    }
}
