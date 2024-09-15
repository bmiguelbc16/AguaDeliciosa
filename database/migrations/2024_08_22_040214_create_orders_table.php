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
    Schema::create('orders', function (Blueprint $table) {
      $table->id(); // ID del pedido

      $table->unsignedBigInteger('client_id'); // Llave foránea hacia la tabla de clientes
      $table->timestamp('registration_date')->useCurrent(); // Fecha de registro del pedido
      $table->decimal('total_amount', 10, 2); // Monto total del pedido
      $table->text('delivery_address')->nullable(); // Dirección de entrega

      $table->timestamps(); // created_at y updated_at

      $table
        ->foreign('client_id')
        ->references('id')
        ->on('clients')
        ->onDelete('cascade'); // Eliminación en cascada

      $table->index('client_id'); // Índice para mejorar el rendimiento
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('orders');
  }
};
