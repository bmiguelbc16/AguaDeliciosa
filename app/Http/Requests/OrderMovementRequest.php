<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderMovementRequest extends FormRequest {
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
      'status' => 'required|string',
      'description' => 'nullable|string',
      'status_date' => 'nullable|date',
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
      'status' => 'estado',
      'description' => 'descripción',
      'status_date' => 'fecha del estado',
    ];
  }
}
