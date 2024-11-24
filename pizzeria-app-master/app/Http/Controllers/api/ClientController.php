<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        $clients = DB::table('clients')
            ->select('clients.*')
            ->get();

        return response()->json(['clients' => $clients], 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Store a newly created resource in storage.
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => ['required', 'max:100'],
            'email' => ['required', 'email', 'unique:clients,email'],
            'phone' => ['required', 'max:15'],
            'address' => ['required', 'max:255']
        ]);

        if ($validate->fails()) {
            return response()->json([
                'msg' => 'Se produjo un error en la validación de la información',
                'statusCode' => 400,
                'errors' => $validate->errors()
            ]);
        }

        $client = new Client();
        $client->name = $request->name;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->address = $request->address;
        $client->save();

        return response()->json(['client' => $client], 201, [], JSON_PRETTY_PRINT);
    }

    /**
     * Display the specified resource.
     * @return Illuminate\Http\Response
     */
    public function show(string $id)
    {
        $client = Client::find($id);
        if (is_null($client)) {
            return response()->json(['msg' => 'Cliente no encontrado'], 404);
        }

        return response()->json(['client' => $client], 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Update the specified resource in storage.
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {
        $validate = Validator::make($request->all(), [
            'name' => ['sometimes', 'max:100'],
            'email' => ['sometimes', 'email', 'unique:clients,email,' . $id],
            'phone' => ['sometimes', 'max:15'],
            'address' => ['sometimes', 'max:255']
        ]);

        if ($validate->fails()) {
            return response()->json([
                'msg' => 'Se produjo un error en la validación de la información',
                'statusCode' => 400,
                'errors' => $validate->errors()
            ]);
        }

        $client = Client::find($id);
        if (is_null($client)) {
            return response()->json(['msg' => 'Cliente no encontrado'], 404);
        }

        if ($request->has('name')) $client->name = $request->name;
        if ($request->has('email')) $client->email = $request->email;
        if ($request->has('phone')) $client->phone = $request->phone;
        if ($request->has('address')) $client->address = $request->address;

        $client->save();

        return response()->json(['client' => $client], 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Remove the specified resource from storage.
     * @return Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        $client = Client::find($id);
        if (is_null($client)) {
            return response()->json(['msg' => 'Cliente no encontrado'], 404);
        }

        $client->delete();

        $clients = DB::table('clients')->select('clients.*')->get();

        return response()->json(['clients' => $clients, 'success' => true], 200, [], JSON_PRETTY_PRINT);
    }
}
