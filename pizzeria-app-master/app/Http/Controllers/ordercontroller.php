<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Client;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $orders = Order::with(['client.user', 'branch', 'deliveryPerson.user'])->get();
        return view('order.index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::with('user')->get();
        $employees = Employee::with('user')->get();
        $branches = DB::table('branches')->get();

        return view('order.new', [
            'clients' => $clients,
            'employees' => $employees,
            'branches' => $branches,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $order = new Order();

        $order->client_id = $request->client_id;
        $order->branch_id = $request->branch_id;
        $order->total_price = $request->total_price;
        $order->status = $request->status;
        $order->delivery_type = $request->delivery_type;
        $order->delivery_person_id = $request->employee_id; // Cambiado a delivery_person_id
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Orden creada exitosamente.');
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
        // Encuentra la orden especificada
        $order = Order::find($id);

        // Obtener todos los clientes, empleados y sucursales para los select
        $clients = Client::with('user')->get();
        $employees = Employee::with('user')->get();
        $branches = DB::table('branches')->get();

        // Retornar la vista de edición con todas las variables necesarias
        return view('order.edit', [
            'order' => $order, // Asegúrate de pasar $order aquí
            'clients' => $clients,
            'employees' => $employees,
            'branches' => $branches,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $order = Order::find($id);

        $order->client_id = $request->client_id;
        $order->branch_id = $request->branch_id;
        $order->total_price = $request->total_price;
        $order->status = $request->status;
        $order->delivery_type = $request->delivery_type;
        $order->delivery_person_id = $request->employee_id; // Cambiado a delivery_person_id
        $order->save();

        $orders = DB::table('orders')->get();

        return redirect()->route('orders.index')->with('success', 'Orden creada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::find($id);
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Orden eliminada exitosamente.');
    }
}
