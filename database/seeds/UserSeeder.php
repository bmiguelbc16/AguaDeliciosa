<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Client;
use App\Models\Employee;
use App\Models\Digitizer;
use App\Models\Seller;
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
    $admin = Employee::create();

    $userAdmin = User::create([
      'document_number' => '12345678',
      'name' => 'Admin',
      'last_name' => 'User',
      'birth_date' => '1990-01-01',
      'gender' => 'M',
      'phone_number' => '1234567890',
      'userable_type' => Employee::class,
      'userable_id' => $admin->id,
      'active' => true,
      'email' => 'admin@aguadeliciosa.com',
      'password' => Hash::make('admin123456'),
    ]);
    $userAdmin->assignRole('Admin');

    // Crear gestor de pedidos
    $order_manager = Employee::create();

    $userWarehouseman = User::create([
      'document_number' => '45678902',
      'name' => 'Gestor de pedidos',
      'last_name' => 'User',
      'birth_date' => '2001-02-03',
      'gender' => 'M',
      'phone_number' => '123456789',
      'userable_type' => Employee::class,
      'userable_id' => $order_manager->id,
      'email' => 'gestorp@aguadeliciosa.com',
      'password' => Hash::make('gestorp123456'),
    ]);

    $userWarehouseman->assignRole('Gestor de pedidos');

    // Crear almacenero
    $warehouseman = Employee::create();

    $userWarehouseman = User::create([
      'document_number' => '48678902',
      'name' => 'Almacenero',
      'last_name' => 'User',
      'birth_date' => '2001-02-03',
      'gender' => 'M',
      'phone_number' => '123456789',
      'userable_type' => Employee::class,
      'userable_id' => $warehouseman->id,
      'email' => 'almacenero@aguadeliciosa.com',
      'password' => Hash::make('almacenero123456'),
    ]);

    $userWarehouseman->assignRole('Almacen');

    // Crear sellers (vendedor)
    $seller = Employee::create();

    $userSeller = User::create([
      'document_number' => '45678903',
      'name' => 'Vendedor',
      'last_name' => 'User',
      'birth_date' => '2001-02-03',
      'gender' => 'F',
      'phone_number' => '123456789',
      'userable_type' => Employee::class,
      'userable_id' => $seller->id,
      'email' => 'vendedor@aguadeliciosa.com',
      'password' => Hash::make('vendedor123456'),
    ]);

    $userSeller->assignRole('Vendedor');
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
