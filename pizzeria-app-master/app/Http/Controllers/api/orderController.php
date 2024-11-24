<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Client;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $orders = Order::with(['client.user', 'branch', 'deliveryPerson.user'])->get();

        return response()->json([
            'orders' => $orders,
        ], 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'client_id' => 'required|exists:clients,id',
            'branch_id' => 'required|exists:branches,id',
            'total_price' => 'required|numeric|min:0',
            'status' => 'required|string|max:50',
            'delivery_type' => 'required|string|max:50',
            'employee_id' => 'nullable|exists:employees,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
            ], 400);
        }

        // Crear la nueva orden
        $order = Order::create([
            'client_id' => $request->client_id,
            'branch_id' => $request->branch_id,
            'total_price' => $request->total_price,
            'status' => $request->status,
            'delivery_type' => $request->delivery_type,
            'delivery_person_id' => $request->employee_id,
        ]);

        return response()->json([
            'order' => $order,
            'msg' => 'Orden creada exitosamente.',
        ], 201, [], JSON_PRETTY_PRINT);
    }

    /**
     * Display the specified resource.
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id)
    {
        $order = Order::with(['client.user', 'branch', 'deliveryPerson.user'])->find($id);

        if (is_null($order)) {
            return response()->json([
                'msg' => 'Orden no encontrada.',
            ], 404);
        }

        return response()->json([
            'order' => $order,
        ], 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, string $id)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'client_id' => 'required|exists:clients,id',
            'branch_id' => 'required|exists:branches,id',
            'total_price' => 'required|numeric|min:0',
            'status' => 'required|string|max:50',
            'delivery_type' => 'required|string|max:50',
            'employee_id' => 'nullable|exists:employees,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
            ], 400);
        }

        $order = Order::find($id);

        if (is_null($order)) {
            return response()->json([
                'msg' => 'Orden no encontrada.',
            ], 404);
        }

        // Actualizar la orden
        $order->update([
            'client_id' => $request->client_id,
            'branch_id' => $request->branch_id,
            'total_price' => $request->total_price,
            'status' => $request->status,
            'delivery_type' => $request->delivery_type,
            'delivery_person_id' => $request->employee_id,
        ]);

        return response()->json([
            'order' => $order,
            'msg' => 'Orden actualizada exitosamente.',
        ], 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Remove the specified resource from storage.
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $id)
    {
        $order = Order::find($id);

        if (is_null($order)) {
            return response()->json([
                'msg' => 'Orden no encontrada.',
            ], 404);
        }

        $order->delete();

        return response()->json([
            'msg' => 'Orden eliminada exitosamente.',
        ], 200, [], JSON_PRETTY_PRINT);
    }
}
