<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends BaseFormRequest {
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
    $client = $this->route('admin.client');

    $rules = [
      'name' => 'required|string',
      'last_name' => 'required|string',
      'document_number' => 'required|numeric|digits_between:8,11',
      'gender' => 'required|in:M,F',
      'birth_date' => 'required|date',
      'phone' => 'nullable|string',
      'active' => 'nullable|in:on',
      'email' => 'required|email|unique:users,email,' . optional($client)->id,
    ];

    // Solo validar unicidad del email si es diferente al actual o si es una creación
    if (
      ($this->isMethod('patch') && $client && $client->user->email !== $this->input('email')) ||
      $this->isMethod('post')
    ) {
      $rules['email'] = 'required|email|unique:users,email';
    } else {
      $rules['email'] = 'required|email';
    }

    if ($this->isMethod('post')) {
      $rules['password'] = 'required|string|min:6|confirmed';
    }

    if ($this->isMethod('patch') && $this->filled('password')) {
      $rules['password'] = 'required|string|min:6|confirmed';
    }

    return $rules;
  }

  protected function prepareForValidation() {
    parent::prepareForValidation();

    // Generar el correo electrónico basado en el DNI si no está presente o si el DNI se ha cambiado
    if ($this->filled('document_number')) {
      $this->merge([
        'email' => $this->input('document_number') . '@aguadeliciosa.com',
      ]);

      // Generar la nueva contraseña basada en el DNI si este se ha cambiado
      if ($this->route('client') && $this->route('client')->document_number !== $this->input('document_number')) {
        $this->merge([
          'password' => $this->input('document_number'),
          'password_confirmation' => $this->input('document_number'),
        ]);
      }
    }

    $this->parseDate('birth_date');
  }
}
