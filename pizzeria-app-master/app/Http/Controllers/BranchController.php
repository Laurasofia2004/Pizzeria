<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use Illuminate\Support\Facades\DB;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches = Branch::all();
        return view('branch.index', ['branches' => $branches]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches = DB::table('branches');
        return view('branch.new', ['branches' => $branches]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $branches = new Branch();
        $branches->name = $request->name;
        $branches->address = $request->address;
        $branches->save();
        $branches = DB::table('branches')->get();
        return redirect()->route('branches.index')->with('success', 'Pedido creado exitosamente.');
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
        $branch = Branch::find($id);  
        return view('branch.edit', compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $branches = Branch::find($id);
        $branches->name = $request->name;
        $branches->address = $request->address;
        $branches->save();
        $branches = DB::table('branches')->get();
        return redirect()->route('branches.index')->with('success', 'Pedido editado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $branches = Branch::find($id);
        $branches->delete();
        return redirect()->route('branches.index')->with('success', 'Pedido eliminado exitosamente.');
    }
}
