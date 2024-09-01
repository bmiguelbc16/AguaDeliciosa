<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOutputDetails extends Model {
  use HasFactory;

  protected $fillable = ['product_output_id', 'product_id', 'quantity', 'unit_price'];

  public function productOutput() {
    return $this->belongsTo(ProductOutput::class);
  }

  public function product() {
    return $this->belongsTo(Product::class);
  }
}
