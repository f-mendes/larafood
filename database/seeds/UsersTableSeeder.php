<?php

use App\Models\User;
use App\Models\Tenant;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $tenant = Tenant::first();
        
        $tenant->users()->create([
            'name' => 'Felipe Mendes',
            'email' => 'felipe@mail.com',
            'password' => Hash::make('123456'),
        ]);
    }
}
