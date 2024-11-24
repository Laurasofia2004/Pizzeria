<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Pizza;
use Illuminate\Support\Facades\DB;

class PizzaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pizzas = Pizza::all();
        return view('pizza.index', ['pizzas' => $pizzas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pizzas = DB::table('pizzas');
        return view('pizza.new', ['pizzas' => $pizzas]);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pizza = new Pizza();   
        $pizza->name = $request->name; 
        $pizza->save();
        $pizzas = DB::table('pizzas')->get();
        return redirect()->route('pizzas.index')->with('success', 'Pizza escogida exitosamente.');
        
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
        $pizza = Pizza::find($id);
        $pizzas = DB::table('pizzas')->get();
        return view('pizza.edit', compact('pizza'));
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pizza = Pizza::find($id);
        $pizza->name = $request->name;
        $pizza->save();
        $pizzas = DB::table('pizzas')->get();
        
        return redirect()->route('pizzas.index')->with('success', 'Pizza editada exitosamente.');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pizza = Pizza::find($id);
        $pizza->delete();
        return redirect()->route('pizzas.index')->with('success', 'pizza eliminada exitosamente.');
        
    }
}
