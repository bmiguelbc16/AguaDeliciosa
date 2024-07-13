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
    Schema::create('patients', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('document_number', 20);
      $table->string('name', 150);
      $table->string('last_name', 150);
      $table->date('birth_date')->nullable();
      $table->enum('gender', ['M', 'F']);
      $table->string('phone_number')->nullable();
      $table->string('email')->unique();
      $table->timestamp('email_verified_at')->nullable();
      $table->string('password');
      $table->rememberToken();
      $table->integer('active')->default(1);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('patients');
  }
};
