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
      'email' => [
        'required',
        'email',
        function ($attribute, $value, $fail) use ($client) {
          if ($this->isMethod('post') || ($this->isMethod('patch') && $client && $client->user->email !== $value)) {
            // Solo valida la unicidad del email si es una creación o si el email ha cambiado.
            $exists = \App\Models\User::where('email', $value)
              ->where('id', '!=', optional($client)->user->id)
              ->exists();

            if ($exists) {
              $fail('El campo email ya ha sido tomado.');
            }
          }
        },
      ],
    ];

    // Requerir contraseña solo si se está creando un nuevo cliente o se ha proporcionado en una actualización.
    if ($this->isMethod('post') || ($this->isMethod('patch') && $this->filled('password'))) {
      $rules['password'] = 'required|string|min:6|confirmed';
    }

    return $rules;
  }

  protected function prepareForValidation() {
    // Convertir `birth_date` al formato `Y-m-d` (ejemplo: '2003-09-11').
    if ($this->filled('birth_date')) {
      $birthDate = \DateTime::createFromFormat('d/m/Y', $this->input('birth_date'));
      if ($birthDate) {
        $this->merge([
          'birth_date' => $birthDate->format('Y-m-d'),
        ]);
      } else {
        // Si la fecha no puede ser parseada, puedes agregar un error o manejarlo de otra manera.
        $this->merge([
          'birth_date' => null,
        ]);
      }
    }

    // Generar el correo electrónico basado en el DNI si no está presente.
    if ($this->filled('document_number')) {
      $this->merge([
        'email' => $this->input('document_number') . '@aguadeliciosa.com',
      ]);

      // Generar la nueva contraseña basada en el DNI si este se ha cambiado.
      if (
        $this->isMethod('post') ||
        ($this->isMethod('patch') &&
          $this->route('client') &&
          $this->route('client')->document_number !== $this->input('document_number'))
      ) {
        $this->merge([
          'password' => $this->input('document_number'),
          'password_confirmation' => $this->input('document_number'),
        ]);
      }
    }
  }
}
