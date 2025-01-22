<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class EmployeeSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $faker = Faker::create();
    for ($i = 0; $i < 100; $i++) {
      $employee = new Employee();
      $employee->first_name = $faker->firstName();
      $employee->last_name = $faker->lastName();
      $employee->company_id = rand(1, 10);
      $employee->email = strtolower($employee->first_name . '.' . $employee->last_name . '@example.com');
      $employee->phone = $faker->phoneNumber();
      $employee->save();
    }
  }
}
