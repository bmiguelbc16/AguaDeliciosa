<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderDetailRequest extends FormRequest {
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize() {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules() {
    return [
      'order_id' => 'required|exists:orders,id',
      'product_id' => 'required|exists:products,id',
      'quantity' => 'required|integer|min:1',
      'unit_price' => 'required|numeric|min:0',
    ];
  }

  /**
   * Get the custom attributes for validator errors.
   *
   * @return array
   */
  public function attributes() {
    return [
      'order_id' => 'ID del pedido',
      'product_id' => 'ID del producto',
      'quantity' => 'cantidad',
      'unit_price' => 'precio unitario',
    ];
  }
}
