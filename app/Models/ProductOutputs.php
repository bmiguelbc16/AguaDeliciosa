<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOutputs extends Model {
  use HasFactory;

  protected $fillable = ['output_date', 'notes', 'is_canceled'];

  public function productOutputDetails() {
    return $this->hasMany(ProductOutputDetail::class);
  }
}
