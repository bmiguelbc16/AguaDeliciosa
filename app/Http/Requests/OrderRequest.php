<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest {
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
      'client_id' => 'required|exists:clients,id',
      'product_id' => 'required|array', // Verifica que sea un array
      'product_id.*' => 'required|exists:products,id', // Cada ID debe ser válido
      'quantity' => 'required|array', // Verifica que sea un array
      'quantity.*' => 'required|integer|min:1', // Cada cantidad debe ser un entero positivo
      'delivery_address' => 'nullable|string|max:255',
    ];
  }

  /**
   * Get the custom attributes for validator errors.
   *
   * @return array
   */
  public function messages() {
    return [
      'client_id.required' => 'El cliente es obligatorio.',
      'delivery_address.required' => 'La dirección de entrega es obligatoria.',
      'product_id.*.required' => 'El producto es obligatorio.',
      'quantity.*.required' => 'La cantidad es obligatoria.',
      'total_amount.required' => 'El monto total es obligatorio.',
    ];
  }
}
