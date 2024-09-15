<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model {
  use HasFactory;

  protected $fillable = [
    'client_id',
    'total_amount',
    'registration_date', // Otros campos relevantes
  ];

  public function client() {
    return $this->belongsTo(Client::class);
  }

  public function orderDetails() {
    return $this->hasMany(OrderDetail::class);
  }

  public function orderMovements() {
    return $this->hasMany(OrderMovement::class);
  }
}
