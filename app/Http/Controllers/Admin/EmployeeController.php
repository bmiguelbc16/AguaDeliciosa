<?php

namespace App\Http\Controllers\Admin;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class EmployeeController extends AdminController {
  public function __construct() {
    // Autoriza automáticamente acciones basadas en el recurso para las políticas registradas
    $this->authorizeResource(Employee::class, 'employee');
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request) {
    // Verifica si el usuario puede ver la lista de empleados
    $this->authorize('viewAny', Employee::class);
    //
    $name = $request->name;

    $items = Employee::whereHas('user', function ($query) use ($name) {
      $query->whereRaw("CONCAT(name, ' ', last_name) LIKE ?", ["%{$name}%"]);
    })->paginate(20);

    return response()->view('admin.employees.index', compact('items', 'request'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
    // Verifica si el usuario puede crear empleados
    $this->authorize('create', Employee::class);
    // Verifica si el usuario puede crear empleados
    $this->authorize('create', Employee::class);
    //
    $genders = Employee::OPTIONS_GENDER;

    return view('admin.employees.create', compact('genders'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\EmployeeRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(EmployeeRequest $request) {
    // Verifica si el usuario puede crear empleados
    $this->authorize('create', Employee::class);
    //

    DB::beginTransaction();

    try {
      $data = $request->validated();

      $data['active'] = isset($data['active']);
      $data['password'] = Hash::make($request->input('password'));

      $employee = Employee::create();

      $user = new User($data);
      $user->userable()->associate($employee);
      $user->save();
      $user->assignRole('admin');

      DB::commit();

      return redirect()
        ->route('admin.employees.index')
        ->with('success', 'Trabajador creado satisfactoriamente');
    } catch (\Exception $e) {
      DB::rollBack();

      return redirect()
        ->back()
        ->with('error', 'Ocurrió un error al crear el trabajador: ' . $e->getMessage());
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  Employee  $Employee
   * @return \Illuminate\Http\Response
   */
  public function show(Employee $Employee) {
    // Verifica si el usuario puede ver el empleado
    $this->authorize('view', $employee);
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  Employee  $Employee
   * @return \Illuminate\Http\Response
   */
  public function edit(Employee $employee) {
    // Verifica si el usuario puede editar el empleado
    $this->authorize('update', $employee);
    //
    $genders = Employee::OPTIONS_GENDER;

    return view('admin.employees.edit', compact('employee', 'genders'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\EmployeeRequest  $request
   * @param  Employee  $Employee
   * @return \Illuminate\Http\Response
   */
  public function update(EmployeeRequest $request, Employee $employee) {
    // Verifica si el usuario puede actualizar el empleado
    $this->authorize('update', $employee);
    //
    $data = $request->validated();
    $data['active'] = isset($data['active']);

    $employee->user->update($data);

    return redirect()
      ->route('admin.employees.index')
      ->with('success', 'Trabajador actualizado satisfactoriamente');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  Employee  $Employee
   * @return \Illuminate\Http\Response
   */
  public function destroy(Employee $employee) {
    // Verifica si el usuario puede eliminar el empleado
    $this->authorize('delete', $employee);
    //
    try {
      $employee->delete();

      return response()->json(['success' => true, 'message' => 'Trabajador eliminado satisfactoriamente']);
    } catch (\Exception $e) {
      return response()->json(['success' => false, 'message' => 'Error al eliminar el Trabajador'], 500);
    }
  }
}
