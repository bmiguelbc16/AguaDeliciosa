<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model {
  use HasFactory;

  protected $fillable = ['client_id', 'registration_date'];

  public function orderDetails() {
    return $this->hasMany(OrderDetail::class);
  }

  public function orderStatuses() {
    return $this->hasMany(OrderStatus::class);
  }

  public function client() {
    return $this->belongsTo(Client::class);
  }
}
