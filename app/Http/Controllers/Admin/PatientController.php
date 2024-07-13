<?php

namespace App\Http\Controllers\Admin;

use App\Models\Patient;
use Illuminate\Http\Request;
use App\Http\Requests\PatientRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PatientController extends AdminController {
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request) {
    //
    $name = $request->name;

    $items = Patient::when($name, function ($query) use ($name) {
      $query->whereRaw("CONCAT(name, ' ', last_name) LIKE ?", ["%{$name}%"]);
    })->paginate(20);

    return response()->view('admin.patients.index', compact('items', 'request'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
    //
    $genders = Patient::OPTIONS_GENDER;

    return view('admin.patients.create', compact('genders'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\DoctorRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(PatientRequest $request) {
    //
    DB::beginTransaction();

    try {
      $data = $request->validated();

      $data['active'] = isset($data['active']);
      $data['password'] = Hash::make($request->input('password'));

      Patient::create($data);

      DB::commit();

      return redirect()
        ->route('admin.patients.index')
        ->with('success', 'Paciente creado satisfactoriamente');
    } catch (\Exception $e) {
      DB::rollBack();

      return redirect()
        ->back()
        ->with('error', 'Ocurrió un error al crear el Paciente: ' . $e->getMessage());
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Patient  $patient
   * @return \Illuminate\Http\Response
   */
  public function show(Patient $patient) {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Patient  $patient
   * @return \Illuminate\Http\Response
   */
  public function edit(Patient $patient) {
    //
    $genders = Patient::OPTIONS_GENDER;

    return view('admin.patients.edit', compact('patient', 'genders'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Patient  $patient
   * @return \Illuminate\Http\Response
   */
  public function update(PatientRequest $request, Patient $patient) {
    //
    $data = $request->validated();
    $data['active'] = isset($data['active']);

    $patient->update($data);
    $patient->update($data);

    return redirect()
      ->route('admin.patients.index')
      ->with('success', 'Paciente actualizado satisfactoriamente');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Patient  $patient
   * @return \Illuminate\Http\Response
   */
  public function destroy(Patient $patient) {
    //
    try {
      $patient->delete();

      return response()->json(['success' => true, 'message' => 'Paciente eliminado satisfactoriamente']);
    } catch (\Exception $e) {
      return response()->json(['success' => false, 'message' => 'Error al eliminar el Paciente'], 500);
    }
  }
}
