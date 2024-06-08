<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalExam extends Model
{
    use HasFactory;
    protected $fillable = ['','' ];

    public function patients()
    {
        return $this->belongsToMany(Patient::class);
    }
}
