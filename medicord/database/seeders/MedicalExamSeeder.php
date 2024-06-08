<?php

namespace Database\Seeders;

use App\Models\MedicalExam;
use App\Models\Patient;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Seeder;

class MedicalExamSeeder extends Seeder
{
    public function run(): void
    {
        $faker = FakerFactory::create();

        $patientIds = Patient::pluck('id')->toArray();

        for ($i = 0; $i < 10; $i++) {
            $medical_exam = new MedicalExam();
            $medical_exam->patient_id = $faker->randomElement($patientIds);
            $medical_exam->exam_name = 'medical exam name' . $i;
            $medical_exam->exam_description = $faker->paragraph(2);

            $medical_exam->save();
        }
    }
}
