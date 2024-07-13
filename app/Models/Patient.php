<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Patient extends Authenticatable {
  use Notifiable;

  const OPTIONS_GENDER = [
    'M' => 'MASCULINO',
    'F' => 'FEMENINO',
  ];

  protected $fillable = [
    'document_number',
    'name',
    'last_name',
    'birth_date',
    'gender',
    'phone_number',
    'email',
    'password',
  ];

  public function fullName() {
    return "{$this->name} {$this->last_name}";
  }
}
