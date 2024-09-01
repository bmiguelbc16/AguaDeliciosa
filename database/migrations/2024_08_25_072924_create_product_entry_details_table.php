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
    Schema::create('product_entry_details', function (Blueprint $table) {
      $table->id();

      $table->unsignedBigInteger('product_entry_id'); // Llave foránea hacia la tabla de entradas de productos
      $table->unsignedBigInteger('product_id'); // Llave foránea hacia la tabla de productos
      $table->integer('quantity'); // Cantidad de productos que ingresan
      $table->decimal('unit_price', 8, 2); // Precio unitario de los productos ingresados

      $table->timestamps();

      $table
        ->foreign('product_entry_id')
        ->references('id')
        ->on('product_entries')
        ->onDelete('cascade'); // Llave foránea hacia product_entries

      $table
        ->foreign('product_id')
        ->references('id')
        ->on('products')
        ->onDelete('restrict'); // Llave f   oránea hacia products
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('product_entry_details');
  }
};
