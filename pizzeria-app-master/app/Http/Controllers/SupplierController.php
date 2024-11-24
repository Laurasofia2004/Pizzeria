<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return view('supplier.index', ['suppliers' => $suppliers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = DB::table('suppliers');
        return view('supplier.new', ['suppliers' => $suppliers]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $supplier = new Supplier();
        $supplier-> name = $request-> name;
        $supplier-> contact_info= $request-> contact_info;

        $supplier->save();

        $suppliers = DB::table('suppliers')->get();

        return redirect()->route('suppliers.index')->with('success', 'Proveedor creado exitosamente.');
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
        $supplier = Supplier::find($id);
        $suppliers = DB::table('suppliers')->get();
        return view('supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $supplier = Supplier::find($id);

        $supplier-> name = $request-> name;
        $supplier-> contact_info= $request-> contact_info;
        $supplier->save();

        $suppliers = DB::table('suppliers')->get();

        return redirect()->route('suppliers.index')->with('success', 'Proveedor creado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplier = Supplier::find($id);
        $supplier->delete();
        return redirect()->route('suppliers.index')->with('success', 'Proovedor eliminado exitosamente.');
    }
}
