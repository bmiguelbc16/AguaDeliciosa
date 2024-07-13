<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model {
  use HasFactory;

  const OPTIONS_GENDER = [
    'M' => 'MASCULINO',
    'F' => 'FEMENINO',
  ];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [];

  public function user() {
    return $this->morphOne(User::class, 'userable');
  }
}
