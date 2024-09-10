<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest {
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
   * @return array<string, mixed>
   */
  public function rules() {
    return [
      'name' => 'required|string|max:255', // Nombre obligatorio, tipo cadena, longitud máxima 255
      'stock' => 'required|integer|min:0', // Stock obligatorio, debe ser un entero positivo o 0
      'unit_price' => 'required|numeric|min:0', // Precio unitario obligatorio, numérico y mayor o igual a 0
    ];
  }

  /**
   * Get the error messages for the defined validation rules.
   *
   * @return array
   */
  public function messages() {
    return [
      'name.required' => 'El nombre del producto es obligatorio.',
      'stock.required' => 'El stock es obligatorio.',
      'stock.integer' => 'El stock debe ser un número entero.',
      'unit_price.required' => 'El precio unitario es obligatorio.',
      'unit_price.numeric' => 'El precio unitario debe ser un valor numérico.',
    ];
  }
}
