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
    Schema::create('product_output_details', function (Blueprint $table) {
      $table->id(); // ID del detalle de salida

      $table->unsignedBigInteger('product_output_id'); // Llave foránea hacia la tabla de salidas de productos
      $table->unsignedBigInteger('product_id'); // Llave foránea hacia la tabla de productos
      $table->integer('quantity'); // Cantidad de productos que salen
      $table->decimal('unit_price', 8, 2); // Precio unitario de los productos que salen (si aplica)

      $table->timestamps(); // created_at y updated_at

      $table
        ->foreign('product_output_id')
        ->references('id')
        ->on('product_outputs')
        ->onDelete('cascade'); // Llave foránea hacia product_outputs

      $table
        ->foreign('product_id')
        ->references('id')
        ->on('products')
        ->onDelete('restrict'); // Llave foránea hacia products
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('product_output_details');
  }
};
