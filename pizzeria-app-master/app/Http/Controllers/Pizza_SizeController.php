<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use App\Models\Pizza_Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Pizza_SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pizza_sizes = Pizza_Size::with('pizza')->get();
        return view('pizza_size.index', ['pizza_size' => $pizza_sizes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pizzas = DB::table('pizzas')->get();
        return view('pizza_size.new', ['pizzas' => $pizzas]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pizza_sizes = new Pizza_Size();
        $pizza_sizes->pizza_id = $request->name;
        $pizza_sizes->size = $request->size;
        $pizza_sizes->price = $request->price;
        $pizza_sizes->save();

        $pizza_sizes = DB::table('pizza_size')->get();

        return redirect()->route('pizza_sizes.index')->with('success', 'Tamaño Pizza creado exitosamente.');
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
        $pizza_size = Pizza_Size::find($id);
        $pizzas = DB::table('pizzas')->get(); 
        return view('pizza_size.edit', compact('pizza_size', 'pizzas'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pizza_sizes = Pizza_Size::find($id);
        $pizza_sizes->pizza_id = $request->name;
        $pizza_sizes->size = $request->size;
        $pizza_sizes->price = $request->price;
        $pizza_sizes->save();

        $pizza_sizes = DB::table('pizza_size')->get();

        return redirect()->route('pizza_sizes.index')->with('success', 'Tamaño Pizza creado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pizza_sizes = Pizza_Size::find($id);
        $pizza_sizes->delete();
        return redirect()->route('pizza_sizes.index')->with('success', 'Pizza eliminado exitosamente.');
    }
}
