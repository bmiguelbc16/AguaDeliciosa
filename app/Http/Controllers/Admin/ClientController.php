<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Requests\ClientRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ClientController extends AdminController {
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request) {
    //
    $name = $request->name;

    $items = Client::when($name, function ($query) use ($name) {
      $query->whereRaw("CONCAT(name, ' ', last_name) LIKE ?", ["%{$name}%"]);
    })->paginate(20);

    return response()->view('admin.clients.index', compact('items', 'request'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
    //
    $genders = Client::OPTIONS_GENDER;

    return view('admin.clients.create', compact('genders'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\DoctorRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(ClientRequest $request) {
    //
    DB::beginTransaction();

    try {
      $data = $request->validated();
      $data['active'] = isset($data['active']);
      $data['password'] = Hash::make($request->input('password'));

      Client::create($data);

      DB::commit();

      return redirect()
        ->route('admin.clients.index')
        ->with('success', 'Cliente creado satisfactoriamente');
    } catch (\Exception $e) {
      DB::rollBack();

      return redirect()
        ->back()
        ->with('error', 'Ocurrió un error al crear el cliente: ' . $e->getMessage());
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Client  $client
   * @return \Illuminate\Http\Response
   */
  public function show(Client $client) {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Client  $client
   * @return \Illuminate\Http\Response
   */
  public function edit(Client $client) {
    //
    $genders = Client::OPTIONS_GENDER;

    return view('admin.clients.edit', compact('client', 'genders'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Client  $client
   * @return \Illuminate\Http\Response
   */
  public function update(ClientRequest $request, Client $client) {
    //
    $data = $request->validated();
    $data['active'] = isset($data['active']);

    $client->update($data);

    return redirect()
      ->route('admin.clients.index')
      ->with('success', 'Cliente actualizado satisfactoriamente');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Client  $client
   * @return \Illuminate\Http\Response
   */
  public function destroy(Client $client) {
    //
    try {
      $client->delete();

      return response()->json(['success' => true, 'message' => 'Cliente eliminado satisfactoriamente']);
    } catch (\Exception $e) {
      return response()->json(['success' => false, 'message' => 'Error al eliminar el cliente'], 500);
    }
  }
}
