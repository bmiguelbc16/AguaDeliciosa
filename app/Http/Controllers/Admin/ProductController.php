<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ProductController extends AdminController {
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request) {
    $name = $request->name;

    $items = Product::when($name, function ($query) use ($name) {
      $query->where('name', 'like', "%{$name}%");
    })->paginate(20);

    return response()->view('admin.products.index', compact('items', 'request'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
    // Implementar si es necesario
    return view('admin.products.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\ProductRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(ProductRequest $request) {
    DB::beginTransaction();

    try {
      $data = $request->validated();

      Product::create($data);

      DB::commit();

      return redirect()
        ->route('admin.products.index')
        ->with('success', 'Producto creado satisfactoriamente');
    } catch (\Exception $e) {
      DB::rollBack();

      return redirect()
        ->back()
        ->with('error', 'Ocurrió un error al crear el producto: ' . $e->getMessage());
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function show(Product $product) {
    // Implementar si es necesario
    return view('admin.products.show', compact('product'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function edit(Product $product) {
    // Implementar si es necesario
    return view('admin.products.edit', compact('product'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\ProductRequest  $request
   * @param  \App\Models\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function update(ProductRequest $request, Product $product) {
    $data = $request->validated();

    $product->update($data);

    return redirect()
      ->route('admin.products.index')
      ->with('success', 'Producto actualizado satisfactoriamente');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function destroy(Product $product) {
    try {
      $product->delete();

      return response()->json(['success' => true, 'message' => 'Producto eliminado satisfactoriamente']);
    } catch (\Exception $e) {
      return response()->json(['success' => false, 'message' => 'Error al eliminar el producto'], 500);
    }
  }
}
