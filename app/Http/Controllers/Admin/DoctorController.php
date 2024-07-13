<?php

namespace App\Http\Controllers\Admin;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\DoctorRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class DoctorController extends AdminController {
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request) {
    //
    $name = $request->name;

    $items = Doctor::whereHas('user', function ($query) use ($name) {
      $query->whereRaw("CONCAT(name, ' ', last_name) LIKE ?", ["%{$name}%"]);
    })->paginate(20);

    return response()->view('admin.doctors.index', compact('items', 'request'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
    //
    $genders = Doctor::OPTIONS_GENDER;

    return view('admin.doctors.create', compact('genders'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\DoctorRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(DoctorRequest $request) {
    //

    DB::beginTransaction();

    try {
      $data = $request->validated();

      $data['active'] = isset($data['active']);
      $data['password'] = Hash::make($request->input('password'));

      $doctor = Doctor::create($data);

      $user = new User($data);
      $user->userable()->associate($doctor);
      $user->save();
      $user->assignRole('admin');

      DB::commit();

      return redirect()
        ->route('admin.doctors.index')
        ->with('success', 'Doctor creado satisfactoriamente');
    } catch (\Exception $e) {
      DB::rollBack();

      return redirect()
        ->back()
        ->with('error', 'Ocurrió un error al crear el Doctor: ' . $e->getMessage());
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Doctor  $doctor
   * @return \Illuminate\Http\Response
   */
  public function show(Doctor $doctor) {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Doctor  $doctor
   * @return \Illuminate\Http\Response
   */
  public function edit(Doctor $doctor) {
    //
    $genders = Doctor::OPTIONS_GENDER;

    return view('admin.doctors.edit', compact('doctor', 'genders'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\DoctorRequest  $request
   * @param  \App\Models\Doctor  $doctor
   * @return \Illuminate\Http\Response
   */
  public function update(DoctorRequest $request, Doctor $doctor) {
    //
    $data = $request->validated();
    $data['active'] = isset($data['active']);

    $doctor->update($data);
    $doctor->user->update($data);

    return redirect()
      ->route('admin.doctors.index')
      ->with('success', 'Doctor actualizado satisfactoriamente');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Doctor  $doctor
   * @return \Illuminate\Http\Response
   */
  public function destroy(Doctor $doctor) {
    //
    try {
      $doctor->delete();

      return response()->json(['success' => true, 'message' => 'Doctor eliminado satisfactoriamente']);
    } catch (\Exception $e) {
      return response()->json(['success' => false, 'message' => 'Error al eliminar el Doctor'], 500);
    }
  }
}
