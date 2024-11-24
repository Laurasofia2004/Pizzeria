<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //obtener los clientes y usuarios para mostrarlos en el index
        $clients = Client::with('user')->get();

        return view('client.index', ['clients' => $clients]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener los usuarios para el select de crear
        $users = DB::table('users')->get();

        // Retornar la vista con los usuarios
        return view('client.new', ['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $client = new Client();
        $client->user_id = $request->user_id;
        $client->address = $request->address;
        $client->phone = $request->phone;
        $client->save();

        $clients = DB::table('clients')->get();

        return redirect()->route('clients.index')->with('success', 'Cliente creado exitosamente.');
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
        $client = Client::find($id);
        $users = DB::table('users')->get(); 
        return view('client.edit', compact('client', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $client = Client::find($id);

        $client->user_id = $request->user_id;
        $client->address = $request->address;
        $client->phone = $request->phone;
        $client->save();

        $clients = DB::table('clients')->get();

        return redirect()->route('clients.index')->with('success', 'Cliente creado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = Client::find($id);
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Cliente eliminado exitosamente.');
    }
}
