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
    Schema::create('product_entries', function (Blueprint $table) {
      $table->id();

      $table->timestamp('output_date')->useCurrent(); // Fecha y hora de la salida de productos
      $table->text('notes')->nullable(); // Notas o comentarios opcionales sobre la salida

      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('product_entries');
  }
};
