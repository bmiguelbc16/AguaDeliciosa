<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductEntryDetails extends Model {
  use HasFactory;
  protected $fillable = ['product_entry_id', 'product_id', 'quantity', 'unit_price'];

  public function productEntry() {
    return $this->belongsTo(ProductEntry::class);
  }

  public function product() {
    return $this->belongsTo(Product::class);
  }
}
