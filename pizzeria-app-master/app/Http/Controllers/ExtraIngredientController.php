<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExtraIngredient;
use Illuminate\Support\Facades\DB;

class ExtraIngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $extraIngredients = ExtraIngredient::all();
        return view('extraIngredient.index', ['extraIngredients' => $extraIngredients]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('extraIngredient.new');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los campos
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric', // Agregar la validación para el precio
        ]);
    
        // Crear el nuevo ingrediente con el precio
        ExtraIngredient::create([
            'name' => $request->name,
            'price' => $request->price, // Asegúrate de incluir el precio
        ]);
    
        return redirect()->route('extraingredient.index');
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
        $extraIngredient = ExtraIngredient::find($id); 
        return view('extraingredient.edit', compact('extraIngredient'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $extraIngredient = ExtraIngredient::find($id);
        $extraIngredient->name = $request->name; 
        $extraIngredient->price = $request->price; 
        $extraIngredient->save();
        return redirect()->route('extraingredient.index')->with('success', 'Extra ingrediente editado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $extraIngredient = ExtraIngredient::find($id);
        if ($extraIngredient) {
            
            $extraIngredient->delete();
    
            return redirect()->route('extraingredient.index')->with('success', 'Ingrediente eliminado con éxito.');
        } else {
            return redirect()->route('extraingredient.index')->with('error', 'Ingrediente no encontrado.');
        }
    }
}