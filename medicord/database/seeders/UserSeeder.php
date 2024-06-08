<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;


use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = User::create([
            'name' => 'Marco Caggiano',
            'email' => 'marco.caggiano@email.com',
            'password' => Hash::make('password')
        ]);
        $superAdmin->assignRole('superAdmin');

        // Creating Admin User
        $superAdmin = User::create([
            'name' => 'Pietro Marilei',
            'email' => 'pietro.marilei@email.com',
            'password' => Hash::make('password')
        ]);
        $superAdmin->assignRole('superAdmin');

        for ($i = 1; $i <= 5; $i++) {
            $user = new User();
            $user->name = fake()->firstName();
            $user->email = "$i-email@email.com";
            $user->password = Hash::make('password');
            $user->address = fake()->address();
            $user->phone_number = fake()->phoneNumber();
            $user->assignRole('doctor');
            $user->save();
        }

        for ($i = 6; $i <= 10; $i++) {
            $user = new User();
            $user->name = fake()->firstName();
            $user->email = "$i-email@email.com";
            $user->password = Hash::make('password');
            $user->address = fake()->address();
            $user->phone_number = fake()->phoneNumber();
            $user->assignRole('patient');
            $user->save();
        }
    } 
}
