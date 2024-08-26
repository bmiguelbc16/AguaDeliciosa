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

      $table->unsignedBigInteger('client_id'); // Llave foránea hacia la tabla de usuarios
      $table->timestamp('registration_date')->useCurrent(); // Fecha de registro del pedido

      $table->timestamps(); // created_at y updated_at

      $table
        ->foreign('client_id')
        ->references('id')
        ->on('clients')
        ->onDelete('cascade'); // created_at y updated_at
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
