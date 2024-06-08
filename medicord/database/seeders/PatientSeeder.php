<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $blood = [
            'A+',
            'A-',
            'B+',
            'B-',
            'AB+',
            'AB-',
            'O+',
            'O-'
        ];
        
        for ($i = 6; $i <= 10; $i++) {
            $patient = new Patient();
            $patient->user_id = $i;
            $patient->blood_type = $blood[array_rand($blood, 1)];
            $patient->patologies = 'patology ' . $i;
            $patient->save();

        }
        

    }
}
