<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
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
      'gender' => 'F',
      'phone_number' => '1234567890',
      'userable_type' => Employee::class,
      'userable_id' => $employee->id,
      'active' => true,
      'email' => 'admin@orozcodent.com',
      'password' => Hash::make('admin123456'),
    ]);
    $userEmployee->assignRole('admin');

    // Crear doctor
    $doctor = Doctor::create([
      'facebook' => '',
      'instagram' => '',
      'whatsapp' => '',
      'university' => '',
      'university_studies' => '',
    ]);

    $userDoctor = User::create([
      'document_number' => '23456789',
      'name' => 'Doctor',
      'last_name' => 'Usuario',
      'birth_date' => '1985-01-01',
      'gender' => 'F',
      'phone_number' => '1234567891',
      'userable_type' => Doctor::class,
      'userable_id' => $doctor->id,
      'active' => true,
      'email' => 'doctor@orozcodent.com',
      'password' => Hash::make('doctor123456'),
    ]);
    $userDoctor->assignRole('doctor');

    // Crear patient
    $patient = Patient::create([
      'document_number' => '45678901',
      'name' => 'Paciente',
      'last_name' => 'Usuario',
      'birth_date' => '2000-01-01',
      'gender' => 'M',
      'phone_number' => '1234567893',
      'email' => 'paciente@orozcodent.com',
      'password' => Hash::make('paciente123456'),
    ]);
  }
}
