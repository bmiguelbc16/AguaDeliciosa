<?php

namespace App\Http\Controllers\Client;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class OrderController extends ClientController {
  public function index() {
    return view('client.orders.index');
  }
  // /**
  //  * Display a listing of the resource.
  //  *
  //  * @return \Illuminate\Http\Response
  //  */
  // public function index(Request $request) {
  //   //
  //   $name = $request->name;

  //   $items = Order::when($name, function ($query) use ($name) {
  //     $query->whereRaw("CONCAT(name, ' ', last_name) LIKE ?", ["%{$name}%"]);
  //   })->paginate(20);

  //   return response()->view('client.orders.index', compact('items', 'request'));
  // }

  // /**
  //  * Show the form for creating a new resource.
  //  *
  //  * @return \Illuminate\Http\Response
  //  */
  // public function create() {
  //   //
  //   $genders = Order::OPTIONS_GENDER;

  //   return view('client.orders.create', compact('genders'));
  // }

  // /**
  //  * Store a newly created resource in storage.
  //  *
  //  * @param  \Illuminate\Http\DoctorRequest  $request
  //  * @return \Illuminate\Http\Response
  //  */
  // public function store(OrderRequest $request) {
  //   //
  //   DB::beginTransaction();

  //   try {
  //     $data = $request->validated();

  //     $data['active'] = isset($data['active']);
  //     $data['password'] = Hash::make($request->input('password'));

  //     Order::create($data);

  //     DB::commit();

  //     return redirect()
  //       ->route('client.orders.index')
  //       ->with('success', 'Paciente creado satisfactoriamente');
  //   } catch (\Exception $e) {
  //     DB::rollBack();

  //     return redirect()
  //       ->back()
  //       ->with('error', 'Ocurrió un error al crear el Paciente: ' . $e->getMessage());
  //   }
  // }

  // /**
  //  * Display the specified resource.
  //  *
  //  * @param  \App\Models\Order  $order
  //  * @return \Illuminate\Http\Response
  //  */
  // public function show(Order $order) {
  //   //
  // }

  // /**
  //  * Show the form for editing the specified resource.
  //  *
  //  * @param  \App\Models\Order  $order
  //  * @return \Illuminate\Http\Response
  //  */
  // public function edit(Order $order) {
  //   //
  //   $genders = Order::OPTIONS_GENDER;

  //   return view('client.orders.edit', compact('order', 'genders'));
  // }

  // /**
  //  * Update the specified resource in storage.
  //  *
  //  * @param  \Illuminate\Http\Request  $request
  //  * @param  \App\Models\Order  $order
  //  * @return \Illuminate\Http\Response
  //  */
  // public function update(OrderRequest $request, Order $order) {
  //   //
  //   $data = $request->validated();
  //   $data['active'] = isset($data['active']);

  //   $order->update($data);
  //   $order->update($data);

  //   return redirect()
  //     ->route('client.orders.index')
  //     ->with('success', 'Paciente actualizado satisfactoriamente');
  // }

  // /**
  //  * Remove the specified resource from storage.
  //  *
  //  * @param  \App\Models\Order  $order
  //  * @return \Illuminate\Http\Response
  //  */
  // public function destroy(Order $order) {
  //   //
  //   try {
  //     $order->delete();

  //     return response()->json(['success' => true, 'message' => 'Paciente eliminado satisfactoriamente']);
  //   } catch (\Exception $e) {
  //     return response()->json(['success' => false, 'message' => 'Error al eliminar el Paciente'], 500);
  //   }
  // }
}
