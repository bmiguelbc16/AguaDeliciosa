<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
  use Notifiable;
  use HasRoles;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'document_number',
    'name',
    'last_name',
    'birth_date',
    'gender',
    'phone_number',
    'rol_id',
    'userable_type',
    'userable_id',
    'email',
    'password',
    'active',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = ['password', 'remember_token'];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  public function role() {
    return $this->belongsTo(Role::class, 'rol_id');
  }

  public function userable() {
    return $this->morphTo();
  }

  public function fullName() {
    return "{$this->name} {$this->last_name}";
  }
}
