<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Mostrar una lista de los clientes.
     */
    public function index()
    {
        $clients = Client::all();
        return view('clients.index', compact('clients'));
    }

    /**
     * Mostrar el formulario para crear un nuevo cliente.
     */
    public function create()
    {
        // Si quieres asociar un cliente con un usuario (usualmente para la autenticación)
        $users = User::all();
        return view('clients.create', compact('users'));
    }

    /**
     * Almacenar un nuevo cliente en la base de datos.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'address' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15',
        ]);

        Client::create($validated);

        return redirect()->route('clients.index');
    }

    /**
     * Mostrar un cliente específico.
     */
    public function show(Client $client)
    {
        return view('clients.show', compact('client'));
    }

    /**
     * Mostrar el formulario para editar un cliente.
     */
    public function edit(Client $client)
    {
        // Si quieres asociar un cliente con un usuario
        $users = User::all();
        return view('clients.edit', compact('client', 'users'));
    }

    /**
     * Actualizar un cliente en la base de datos.
     */
    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'address' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15',
        ]);

        $client->update($validated);

        return redirect()->route('clients.index');
    }

    /**
     * Eliminar un cliente de la base de datos.
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index');
    }
}
