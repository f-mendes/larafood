<?php

use App\Models\User;
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
        User::create([
            'name' => 'Felipe Mendes',
            'email' => 'felipe@mail.com',
            'password' => bcrypt('123456'),
        ]);
    }
}
