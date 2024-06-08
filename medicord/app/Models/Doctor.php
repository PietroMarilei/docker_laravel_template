<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Doctor extends Model
{

    use HasFactory, HasRoles;
    protected $fillable = [
        'user_id',
        'specialization',
        'meeting_link',
    ];
    protected $guard_name = "web";
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
