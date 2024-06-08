<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Patient extends Model
{
    use HasFactory,HasRoles;

    protected $fillable = ['', ''];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function medicalExams()
    {
        return $this->belongsToMany(MedicalExam::class);
    }
}
