<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Client;
use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    //

    // Crear admin
    $employee = Employee::create();

    $userEmployee = User::create([
      'document_number' => '12345678',
      'name' => 'Admin',
      'last_name' => 'User',
      'birth_date' => '1990-01-01',
      'gender' => 'M',
      'phone_number' => '1234567890',
      'userable_type' => Employee::class,
      'userable_id' => $employee->id,
      'active' => true,
      'email' => 'admin@aguadeliciosa.com',
      'password' => Hash::make('admin123456'),
    ]);
    $userEmployee->assignRole('Admin');

    // Crear client
    $client = Client::create();

    $userClient = User::create([
      'document_number' => '45678901',
      'name' => 'Cliente',
      'last_name' => 'Usuario',
      'birth_date' => '2000-01-01',
      'gender' => 'M',
      'phone_number' => '1234567890',
      'userable_type' => Client::class,
      'userable_id' => $client->id,
      'phone_number' => '1234567893',
      'email' => 'cliente@aguadeliciosa.com',
      'password' => Hash::make('cliente123456'),
    ]);

    $userClient->assignRole('Cliente');
  }
}
