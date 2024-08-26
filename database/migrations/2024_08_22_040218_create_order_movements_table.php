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
    Schema::create('order_movements', function (Blueprint $table) {
      $table->id(); // ID del estado del pedido

      $table->unsignedBigInteger('order_id'); // Llave foránea hacia la tabla de pedidos
      $table->string('status'); // Título del estado (ej: "Enviado", "Registrado")
      $table->text('description')->nullable(); // Descripción opcional
      $table->timestamp('status_date')->useCurrent(); // Fecha y hora del cambio de estado

      $table->timestamps(); // created_at y updated_at

      $table
        ->foreign('order_id')
        ->references('id')
        ->on('orders')
        ->onDelete('cascade'); // created_at y updated_at
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('order_movements');
  }
};
