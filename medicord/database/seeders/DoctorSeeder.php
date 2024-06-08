<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Support\Facades\Schema;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $specs = [
            'surgeon',
            'physiotherapist',
            'laryngologist',
            'cardiologist',
            'psychiatrist',
        ];
        for ($i = 1; $i <= 5; $i++) {
            $doctor = new Doctor();
            $doctor->user_id = $i;
            $doctor->specialization = $specs[array_rand($specs, 1)];
            $doctor->meeting_link = 'https://meet.google.com/?pli=1';
            $doctor->assignRole('doctor');
            $doctor->save();
        };
    }
}
