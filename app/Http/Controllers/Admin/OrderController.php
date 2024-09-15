<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Client;
use App\Models\Product;
use App\Models\OrderDetail;
use App\Models\OrderMovement;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use Illuminate\Support\Facades\DB;

class OrderController extends AdminController {
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request) {
    $name = $request->input('name');

    $items = Order::whereHas('client', function ($query) use ($name) {
      $query->whereHas('user', function ($query) use ($name) {
        $query->where('name', 'LIKE', "%{$name}%")->orWhere('last_name', 'LIKE', "%{$name}%");
      });
    })->paginate(20);

    return view('admin.orders.index', compact('items', 'request'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
    $products = Product::all(); // Obtener todos los productos
    $clients = Client::all(); // Obtener todos los clientes
    return view('admin.orders.create', compact('products', 'clients'));
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
      $productIds = $request->input('product_id', []);
      $quantities = $request->input('quantity', []);
      $unitPrices = $request->input('unit_price', []);

      $total = $this->calculateTotal($productIds, $quantities);
      $data['total_amount'] = $total;
      $data['registration_date'] = now();

      $order = Order::create($data);

      foreach ($productIds as $index => $productId) {
        $unitPrice = $unitPrices[$index] ?? null;

        if (is_null($unitPrice)) {
          throw new \Exception("Precio unitario para el producto con ID $productId es nulo.");
        }

        OrderDetail::create([
          'order_id' => $order->id,
          'product_id' => $productId,
          'quantity' => $quantities[$index] ?? 1,
          'unit_price' => $unitPrice,
        ]);
      }

      OrderMovement::create([
        'order_id' => $order->id,
        'status' => 'Creado',
        'date' => now(),
      ]);

      DB::commit();
      return redirect()
        ->route('orders.index')
        ->with('success', 'Pedido creado satisfactoriamente.');
    } catch (\Exception $e) {
      DB::rollBack();
      return redirect()
        ->back()
        ->with('error', 'Ocurrió un error al crear el pedido: ' . $e->getMessage());
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Order  $order
   * @return \Illuminate\Http\Response
   */
  public function show(Order $order) {
    $order->load('orderDetails.product', 'orderMovements'); // Carga detalles y movimientos
    return view('admin.orders.show', compact('order'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Order  $order
   * @return \Illuminate\Http\Response
   */
  public function edit(Order $order) {
    $clients = Client::all();
    $products = Product::all(); // Obtener productos para la edición
    $order->load('orderDetails'); // Carga detalles del pedido
    return view('admin.orders.edit', compact('order', 'clients', 'products'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\OrderRequest  $request
   * @param  \App\Models\Order  $order
   * @return \Illuminate\Http\Response
   */
  public function update(OrderRequest $request, Order $order) {
    DB::beginTransaction();

    try {
      $data = $request->validated();
      $productIds = $request->input('product_id', []); // Default to empty array if null
      $quantities = $request->input('quantity', []); // Default to empty array if null

      $total = $this->calculateTotal($productIds, $quantities);
      $data['total_amount'] = $total;

      $order->update($data);

      // Elimina detalles del pedido antiguos y vuelve a crearlos
      $order->orderDetails()->delete();
      foreach ($productIds as $index => $productId) {
        OrderDetail::create([
          'order_id' => $order->id,
          'product_id' => $productId,
          'quantity' => $quantities[$index] ?? 1, // Default to 1 if quantity is missing
          'unit_price' => Product::find($productId)->price,
        ]);
      }

      // Actualiza o añade movimientos del pedido
      OrderMovement::create([
        'order_id' => $order->id,
        'status' => 'Actualizado', // Estado de actualización
        'date' => now(),
      ]);

      DB::commit();
      return redirect()
        ->route('orders.index')
        ->with('success', 'Pedido actualizado correctamente.');
    } catch (\Exception $e) {
      DB::rollBack();
      return redirect()
        ->back()
        ->with('error', 'Ocurrió un error al actualizar el pedido: ' . $e->getMessage());
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Order  $order
   * @return \Illuminate\Http\Response
   */

  public function destroy(Order $order) {
    DB::beginTransaction();

    try {
      // Eliminar detalles del pedido
      $order->orderDetails()->delete();

      // Eliminar movimientos del pedido
      $order->orderMovements()->delete();

      // Eliminar el pedido
      $order->delete();

      DB::commit();
      return redirect()
        ->route('orders.index')
        ->with('success', 'Pedido eliminado correctamente.');
    } catch (\Exception $e) {
      DB::rollBack();
      return redirect()
        ->route('orders.index')
        ->with('error', 'No se pudo eliminar el pedido: ' . $e->getMessage());
    }
  }

  /**
   * Calculate the total price of the order.
   *
   * @param  array  $productIds
   * @param  array  $quantities
   * @return float
   */
  private function calculateTotal($productIds, $quantities) {
    $total = 0;
    foreach ($productIds as $index => $productId) {
      $product = Product::find($productId);
      if ($product) {
        $total += $product->price * ($quantities[$index] ?? 1);
      }
    }
    return $total;
  }
}
