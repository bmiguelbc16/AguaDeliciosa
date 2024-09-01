<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductEntries extends Model {
  use HasFactory;
  protected $fillable = ['entry_date', 'notes', 'supplier_name', 'supplier_ruc', 'is_canceled'];

  public function productEntryDetails() {
    return $this->hasMany(ProductEntryDetail::class);
  }
}
