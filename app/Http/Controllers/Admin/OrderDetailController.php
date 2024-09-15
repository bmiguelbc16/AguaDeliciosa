<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Requests\OrderDetailRequest;
use Illuminate\Support\Facades\DB;

class OrderDetailController extends AdminController {
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request) {
    //
    $name = $request->input('name'); // Nombre del pruducto para buscar en el pedido

    $items = OrderDetail::whereHas('product', function ($query) use ($name) {
      $query->where('name', 'LIKE', "%{$name}%");
    })->paginate(20);

    return response()->view('admin.orderdetails.index', compact('items', 'request'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
    return view('admin.orderdetails.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\OrderDetailRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(OrderDetailRequest $request) {
    //
    DB::beginTransaction();

    try {
      $data = $request->validated();

      // Aquí debes asegurarte de que los datos estén correctamente formateados
      // Por ejemplo, puede ser necesario asociados
      OrderDetail::create($data);

      DB::commit();

      return redirect()
        ->route('admin.orderdetails.index')
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
   * @param  \App\Models\OrderDetail $OrderDetail
   * @return \Illuminate\Http\Response
   */
  public function show(OrderDetail $orderdetail) {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\OrderDetail  $OrderDetail
   * @return \Illuminate\Http\Response
   */
  public function edit(OrderDetail $orderdetail) {
    return view('admin.orderdetails.edit', compact('orderdetail'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\OrderDetailRequest  $request
   * @param  \App\Models\OrderDetail  $OrderDetail
   * @return \Illuminate\Http\Response
   */
  public function update(OrderDetailRequest $request, OrderDetail $orderdetail) {
    $data = $request->validated();

    $orderdetail->update($data);

    return redirect()
      ->route('admin.orderdetails.index')
      ->with('success', 'Orden detallada actualizada satisfactoriamente');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\OrderDetail $orderdetail
   * @return \Illuminate\Http\Response
   */
  public function destroy(OrderDetail $orderdetail) {
    try {
      $orderdetail->delete();

      return response()->json(['success' => true, 'message' => 'Orden detallada eliminada satisfactoriamente']);
    } catch (\Exception $e) {
      return response()->json(['success' => false, 'message' => 'Error al eliminar la orden detallada'], 500);
    }
  }
}
