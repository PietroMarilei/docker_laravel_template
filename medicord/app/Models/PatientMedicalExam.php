<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientMedicalExam extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient_id',
        'medical_exam_id',
    ];
}
