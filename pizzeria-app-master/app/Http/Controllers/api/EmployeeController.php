<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $employees = DB::table('employees')
            ->join('users', 'employees.user_id', '=', 'users.id')
            ->select('employees.*', 'users.name as user_name', 'users.email as user_email')
            ->get();

        return response()->json(['employees' => $employees], 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Store a newly created resource in storage.
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'user_id' => ['required', 'exists:users,id'],
            'position' => ['required', 'string', 'max:100'],
            'identification_number' => ['required', 'string', 'max:20', 'unique:employees,identification_number'],
            'salary' => ['required', 'numeric', 'min:0'],
            'hire_date' => ['required', 'date']
        ]);

        if ($validate->fails()) {
            return response()->json([
                'msg' => 'Error en la validación de los datos',
                'errors' => $validate->errors(),
                'statusCode' => 400
            ]);
        }

        $employee = new Employee();
        $employee->user_id = $request->user_id;
        $employee->position = $request->position;
        $employee->identification_number = $request->identification_number;
        $employee->salary = $request->salary;
        $employee->hire_date = $request->hire_date;
        $employee->save();

        return response()->json(['employee' => $employee], 201, [], JSON_PRETTY_PRINT);
    }

    /**
     * Display the specified resource.
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id)
    {
        $employee = DB::table('employees')
            ->where('employees.id', $id)
            ->join('users', 'employees.user_id', '=', 'users.id')
            ->select('employees.*', 'users.name as user_name', 'users.email as user_email')
            ->first();

        if (is_null($employee)) {
            return response()->json(['msg' => 'Empleado no encontrado'], 404);
        }

        return response()->json(['employee' => $employee], 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Update the specified resource in storage.
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, string $id)
    {
        $validate = Validator::make($request->all(), [
            'user_id' => ['sometimes', 'exists:users,id'],
            'position' => ['sometimes', 'string', 'max:100'],
            'identification_number' => ['sometimes', 'string', 'max:20', 'unique:employees,identification_number,' . $id],
            'salary' => ['sometimes', 'numeric', 'min:0'],
            'hire_date' => ['sometimes', 'date']
        ]);

        if ($validate->fails()) {
            return response()->json([
                'msg' => 'Error en la validación de los datos',
                'errors' => $validate->errors(),
                'statusCode' => 400
            ]);
        }

        $employee = Employee::find($id);
        if (is_null($employee)) {
            return response()->json(['msg' => 'Empleado no encontrado'], 404);
        }

        $employee->fill($request->only([
            'user_id', 'position', 'identification_number', 'salary', 'hire_date'
        ]));
        $employee->save();

        return response()->json(['employee' => $employee], 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $id)
    {
        $employee = Employee::find($id);
        if (is_null($employee)) {
            return response()->json(['msg' => 'Empleado no encontrado'], 404);
        }

        $employee->delete();
        return response()->json(['msg' => 'Empleado eliminado exitosamente'], 200);
    }
}
