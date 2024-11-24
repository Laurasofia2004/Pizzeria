<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchases = Purchase::with(['supplier', 'raw_material'])->get();
        return view('purchase.index', ['purchases' => $purchases]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = DB::table('suppliers')->get();
        $raw_materials = DB::table('raw_materials')->get();

        return view('purchase.new', ['suppliers' => $suppliers, 'raw_materials' => $raw_materials]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $purchase = new Purchase();
        $purchase->supplier_id = $request->supplier_id;
        $purchase->raw_material_id = $request->raw_material_id;
        $purchase->quantity = $request->quantity;
        $purchase->purchase_price = $request->purchase_price;
        $purchase->purchase_date = $request->purchase_date;
        $purchase->save();

        $purchases = DB::table('purchases')->get();

        return redirect()->route('purchases.index')->with('success', 'Compra creado exitosamente.');
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
        $purchase = Purchase::find($id);

        // Obtener todos los proveedores y materias primas para los select
        $suppliers = DB::table('suppliers')->get();
        $raw_materials = DB::table('raw_materials')->get();

        return view('purchase.edit', compact('purchase', 'suppliers', 'raw_materials'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $purchase = Purchase::find($id);

        $purchase->supplier_id = $request->supplier_id;
        $purchase->raw_material_id = $request->raw_material_id;
        $purchase->quantity = $request->quantity;
        $purchase->purchase_price = $request->purchase_price;
        $purchase->purchase_date = $request->purchase_date;
        $purchase->save();

        $purchases = DB::table('purchases')->get();

        return redirect()->route('purchases.index')->with('success', 'Compra editada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $purchase = Purchase::find($id);
        $purchase->delete();
        return redirect()->route('purchases.index')->with('success', 'Compra eliminada exitosamente.');
    }
}
