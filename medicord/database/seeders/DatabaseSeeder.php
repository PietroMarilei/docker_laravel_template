<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

// use App\Models\PatientMedicalExamSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\PermissionsRoleSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        $this->call(
            [
                PermissionsRoleSeeder::class,
                UserSeeder::class,
                DoctorSeeder::class,
                PatientSeeder::class,
                MedicalExamSeeder::class,
                MessageSeeder::class,
            ]
        );
    }
}
