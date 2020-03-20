<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'name' => 'Nathan Lehman',
            'email' => 'nlehman06@gmail.com',
            'password' => '$2y$10$f0vTJeWpVNmMqmjIDAEbC.DPM/e18IG4Y138rKavhZPsy.zy9Zq1K',
        ]);
    }
}
