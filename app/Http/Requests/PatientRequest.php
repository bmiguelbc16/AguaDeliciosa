<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends BaseFormRequest {
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
    $patient = $this->route('admin.patient');

    $rules = [
      'name' => 'required|string',
      'last_name' => 'required|string',
      'document_number' => 'required|numeric|digits_between:8,11',
      'gender' => 'required|in:M,F',
      'birth_date' => 'required|date',
      'phone' => 'nullable|string',
      'active' => 'nullable|in:on',
    ];

    if (
      ($this->isMethod('patch') && $patient && $patient->email !== $this->input('email')) ||
      $this->isMethod('post')
    ) {
      $rules['email'] = 'required|email|unique:users,email';
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
    $this->parseDate('birth_date');
  }
}
