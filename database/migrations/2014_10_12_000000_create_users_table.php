<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('users', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('document_number', 11)->unique();
      $table->string('name');
      $table->string('last_name');
      $table->date('birth_date');
      $table->enum('gender', ['M', 'F']);
      $table->string('phone_number')->nullable();
      $table->string('email')->unique();
      $table->morphs('userable');
      $table->timestamp('email_verified_at')->nullable();
      $table->string('password');
      $table->rememberToken();
      $table->integer('active')->default(true);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('users');
  }
}
