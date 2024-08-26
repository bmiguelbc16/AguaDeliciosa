<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {
  use HasFactory;

  protected $fillable = ['name', 'stock', 'unit_price'];

  public function orderDetails() {
    return $this->hasMany(OrderDetail::class);
  }
}
