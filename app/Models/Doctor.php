<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model {
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
  protected $fillable = ['facebook', 'instagram', 'whatsapp', 'university', 'university_studies', 'foto'];

  public function user() {
    return $this->morphOne(User::class, 'userable');
  }
}
