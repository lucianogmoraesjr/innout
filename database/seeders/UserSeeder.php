<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    User::create([
      'name' => 'Admin',
      'password' => '$2y$10$/vC1UKrEJQUZLN2iM3U9re/4DQP74sXCOVXlYXe/j9zuv1/MHD4o.',
      'email' => 'admin@teste.com.br',
      'start_date' => '2000-1-1',
      'end_date' => null,
      'is_admin' => 1,
    ]);

    User::create([
      'name' => 'Chaves',
      'password' => '$2y$10$/vC1UKrEJQUZLN2iM3U9re/4DQP74sXCOVXlYXe/j9zuv1/MHD4o.',
      'email' => 'chaves@teste.com.br',
      'start_date' => '2000-1-1',
      'end_date' => null,
      'is_admin' => 1,
    ]);

    User::create([
      'name' => 'Seu Barriga',
      'password' => '$2y$10$/vC1UKrEJQUZLN2iM3U9re/4DQP74sXCOVXlYXe/j9zuv1/MHD4o.',
      'email' => 'barriga@teste.com.br',
      'start_date' => '2000-1-1',
      'end_date' => null,
      'is_admin' => 0,
    ]);

    User::create([
      'name' => 'Seu Madruga',
      'password' => '$2y$10$/vC1UKrEJQUZLN2iM3U9re/4DQP74sXCOVXlYXe/j9zuv1/MHD4o.',
      'email' => 'madruga@teste.com.br',
      'start_date' => '2000-1-1',
      'end_date' => null,
      'is_admin' => 0,
    ]);

    User::create([
      'name' => 'Quico',
      'password' => '$2y$10$/vC1UKrEJQUZLN2iM3U9re/4DQP74sXCOVXlYXe/j9zuv1/MHD4o.',
      'email' => 'quico@teste.com.br',
      'start_date' => '2000-1-1',
      'end_date' => '2019-1-1',
      'is_admin' => 0,
    ]);
  }
}
