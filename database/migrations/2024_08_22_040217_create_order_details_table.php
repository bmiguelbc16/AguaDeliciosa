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
    Schema::create('order_details', function (Blueprint $table) {
      $table->id(); // ID del detalle del pedido

      $table->unsignedBigInteger('order_id'); // Llave foránea hacia la tabla de pedidos
      $table->unsignedBigInteger('product_id'); // Llave foránea hacia la tabla de productos
      $table->integer('quantity'); // Cantidad de productos en el pedido
      $table->decimal('unit_price', 8, 2); // Precio unitario al momento del pedido

      $table->timestamps();

      $table
        ->foreign('order_id')
        ->references('id')
        ->on('orders')
        ->onDelete('cascade'); // created_at y updated_at

      $table
        ->foreign('product_id')
        ->references('id')
        ->on('products')
        ->onDelete('cascade'); // created_at y updated_at
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('order_details');
  }
};
