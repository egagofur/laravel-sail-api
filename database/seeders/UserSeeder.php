<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $dummyData = [
      [
        'name' => 'admin',
        'email' => 'admin@admin.com',
        'password' => Hash::make('password'),
        'username' => 'admin',
        'fullname' => 'egagofur',
        'company_id' => null,
        'role' => 'admin'
      ]
    ];

    DB::table('users')->insert($dummyData);
  }
}
