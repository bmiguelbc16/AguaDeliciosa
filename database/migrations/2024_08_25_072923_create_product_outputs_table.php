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
    Schema::create('product_outputs', function (Blueprint $table) {
      $table->id();

      $table->timestamp('entry_date')->useCurrent(); // Fecha y hora de la entrada de productos
      $table->text('notes')->nullable(); // Notas o comentarios opcionales sobre la entrada

      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('product_outputs');
  }
};
