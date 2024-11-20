<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Mostrar una lista de los empleados.
     */
    public function index()
    {
        $employees = Employee::all();
        return view('employees.index', compact('employees'));
    }

    /**
     * Mostrar el formulario para crear un nuevo empleado.
     */
    public function create()
    {
        // Si necesitas asociar un empleado con un usuario
        $users = User::all();
        return view('employees.create', compact('users'));
    }

    /**
     * Almacenar un nuevo empleado en la base de datos.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'position' => 'required|string|max:255',
            'identification_number' => 'required|string|unique:employees,identification_number',
            'salary' => 'required|numeric|min:0',
            'hire_date' => 'required|date',
        ]);

        Employee::create($validated);

        return redirect()->route('employees.index');
    }

    /**
     * Mostrar un empleado específico.
     */
    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    /**
     * Mostrar el formulario para editar un empleado.
     */
    public function edit(Employee $employee)
    {
        // Si necesitas asociar un empleado con un usuario
        $users = User::all();
        return view('employees.edit', compact('employee', 'users'));
    }

    /**
     * Actualizar un empleado en la base de datos.
     */
    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'position' => 'required|string|max:255',
            'identification_number' => 'required|string|unique:employees,identification_number,' . $employee->id,
            'salary' => 'required|numeric|min:0',
            'hire_date' => 'required|date',
        ]);

        $employee->update($validated);

        return redirect()->route('employees.index');
    }

    /**
     * Eliminar un empleado de la base de datos.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index');
    }
}
