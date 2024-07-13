<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;

use App\Http\Requests\RoleRequest;

class RoleController extends AdminController {
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    //
    $items = Role::paginate(20);
    return view('admin.roles.index', compact('items'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\RoleRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(RoleRequest $request) {
    //
    $data = $request->validated();
    $data['active'] = isset($data['active']);

    Role::create($data);

    return response()->json(['success' => true, 'message' => 'Rol creado satisfactoriamente']);
  }

  /**
   * Display the specified resource.
   *
   * @param  Role  $role
   * @return \Illuminate\Http\Response
   */
  public function show(Role $role) {
    //
    return response()->json($role, 200);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  Role  $role
   * @return \Illuminate\Http\Response
   */
  public function edit(Role $role) {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\request  $request
   * @param  Role  $role
   * @return \Illuminate\Http\Response
   */
  public function update(RoleRequest $request, Role $role) {
    $data = $request->validated();
    $data['active'] = isset($data['active']);

    $role->update($data);

    return response()->json(['success' => true, 'message' => 'Rol actualizado satisfactoriamente']);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  Role  $role
   * @return \Illuminate\Http\Response
   */
  public function destroy(Role $role) {
    try {
      $role->delete();

      return response()->json(['success' => true, 'message' => 'Rol eliminado satisfactoriamente']);
    } catch (\Exception $e) {
      return response()->json(['success' => false, 'message' => 'Error al eliminar el rol'], 500);
    }
  }
}
