<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //obtener los empleados y usuarios para mostrarlos en el index
        $employees = Employee::with('user')->get();

        return view('employee.index', ['employees' => $employees]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
                // Obtener los usuarios para el select de crear
                $users = DB::table('users')->get();

                // Retornar la vista con los usuarios
                return view('employee.new', ['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $employee = new Employee();
        $employee-> user_id = $request-> user_id;
        $employee-> position = $request-> position;
        $employee-> identification_number = $request-> identification_number;
        $employee-> salary = $request-> salary;
        $employee-> hire_date = $request-> hire_date;
        $employee->save();

        $employees = DB::table('employees')->get();

        return redirect()->route('employees.index')->with('success', 'Empleado creado exitosamente.');
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
        $employee = Employee::find($id);
        $users = DB::table('users')->get(); 
        return view('employee.edit', compact('employee', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $employee = Employee::find($id);

        $employee-> user_id = $request-> user_id;
        $employee-> position = $request-> position;
        $employee-> identification_number = $request-> identification_number;
        $employee-> salary = $request-> salary;
        $employee-> hire_date = $request-> hire_date;
        $employee->save();

        $employees = DB::table('employees')->get();

        return redirect()->route('employees.index')->with('success', 'Empleado creado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::find($id);
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Empleado eliminado exitosamente.');
    }
}
