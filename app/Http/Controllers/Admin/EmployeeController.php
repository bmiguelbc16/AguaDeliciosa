<?php

namespace App\Http\Controllers\Admin;

use App\Models\Employee;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class EmployeeController extends AdminController {
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request) {
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
    // Obtiene los géneros para el formulario
    $genders = Employee::OPTIONS_GENDER;

    // Obtiene los roles en un array para el select
    $excludedRoles = ['Cliente'];
    $roles = Role::whereNotIn('name', $excludedRoles)
      ->pluck('name', 'name')
      ->toArray();

    return view('admin.employees.create', compact('genders', 'roles'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\EmployeeRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(EmployeeRequest $request) {
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
      $user->assignRole($data['role']);

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
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  Employee  $Employee
   * @return \Illuminate\Http\Response
   */
  public function edit(Employee $employee) {
    //
    $genders = Employee::OPTIONS_GENDER;

    // Obtiene los roles en un array para el select
    $roles = Role::pluck('name', 'name')->toArray();

    return view('admin.employees.edit', compact('employee', 'genders', 'roles'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\EmployeeRequest  $request
   * @param  Employee  $Employee
   * @return \Illuminate\Http\Response
   */
  public function update(EmployeeRequest $request, Employee $employee) {
    //
    $data = $request->validated();
    $data['active'] = isset($data['active']);

    $employee->user->update($data);

    // Actualiza el rol del usuario
    if (isset($data['role'])) {
      $employee->user->syncRoles([$data['role']]);
    }
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
    //
    try {
      $employee->delete();

      return response()->json(['success' => true, 'message' => 'Trabajador eliminado satisfactoriamente']);
    } catch (\Exception $e) {
      return response()->json(['success' => false, 'message' => 'Error al eliminar el Trabajador'], 500);
    }
  }
}
