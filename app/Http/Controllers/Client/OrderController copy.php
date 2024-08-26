<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class OrderController extends AdminController {
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request) {
    $name = $request->input('name'); // Nombre del cliente para buscar

    // Asegúrate de tener la relación definida en tu modelo Order
    $items = Order::whereHas('client.user', function ($query) use ($name) {
      $query->where(function ($query) use ($name) {
        $query->where('name', 'LIKE', "%{$name}%")->orWhere('last_name', 'LIKE', "%{$name}%");
      });
    })->paginate(20);

    return response()->view('admin.orders.index', compact('items', 'request'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
    // Cargar datos necesarios para la creación, si es necesario
    // Ejemplo: $clients = Client::all();
    return view('admin.orders.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\OrderRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(OrderRequest $request) {
    DB::beginTransaction();

    try {
      $data = $request->validated();

      // Aquí debes asegurarte de que los datos estén correctamente formateados
      // Por ejemplo, puede ser necesario asociar un cliente u otros datos
      Order::create($data);

      DB::commit();

      return redirect()
        ->route('admin.orders.index')
        ->with('success', 'Orden creada satisfactoriamente');
    } catch (\Exception $e) {
      DB::rollBack();

      return redirect()
        ->back()
        ->with('error', 'Ocurrió un error al crear la orden: ' . $e->getMessage());
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Order  $order
   * @return \Illuminate\Http\Response
   */
  public function show(Order $order) {
    // Implementar si es necesario
    return view('admin.orders.show', compact('order'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Order  $order
   * @return \Illuminate\Http\Response
   */
  public function edit(Order $order) {
    // Implementar si es necesario
    return view('admin.orders.edit', compact('order'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\OrderRequest  $request
   * @param  \App\Models\Order  $order
   * @return \Illuminate\Http\Response
   */
  public function update(OrderRequest $request, Order $order) {
    $data = $request->validated();

    $order->update($data);

    return redirect()
      ->route('admin.orders.index')
      ->with('success', 'Orden actualizada satisfactoriamente');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Order  $order
   * @return \Illuminate\Http\Response
   */

  public function destroy(Order $order) {
    try {
      $order->delete();

      return response()->json(['success' => true, 'message' => 'Orden eliminada satisfactoriamente']);
    } catch (\Exception $e) {
      return response()->json(['success' => false, 'message' => 'Error al eliminar la orden'], 500);
    }
  }
}
