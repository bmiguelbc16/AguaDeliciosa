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

      $table->timestamp('entry_date')->useCurrent(); // Fecha y hora de la entrada de productos
      $table->text('notes')->nullable(); // Notas o comentarios opcionales sobre la entrada
      $table->string('supplier_name')->nullable(); // Nombre del proveedor
      $table->string('supplier_ruc')->nullable(); // RUC del proveedor
      $table->boolean('is_canceled')->default(false); // Campo para marcar si la entrada ha sido anulada

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
