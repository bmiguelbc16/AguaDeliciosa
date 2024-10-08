<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('products', function (Blueprint $table) {
      $table->id(); // ID del producto

      $table->string('name'); // Nombre del producto
      $table->integer('stock')->default(0); // Cantidad disponible en stock
      $table->decimal('unit_price', 8, 2); // Precio unitario del producto

      $table->timestamps(); // created_at y updated_at
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('products');
  }
};
