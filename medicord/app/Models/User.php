<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Storage;

use App\Models\Doctor;
use App\Models\Patient;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'address',
        'photo_url'
    ];
    //🚮test update profile image 
    protected $appends = ['image'];
    public function getImageAttribute()
    {
        if (Storage::disk('public')->exists($this->attributes['photo_url'])) {
            return asset('storage/' . $this->attributes['photo_url']);
        }

        return $this->attributes['photo_url'];
       
        // if (Storage::disk('public')->exists(auth()->user()->photo_url)) {
        //     return asset('storage/' . $this->photo_url);
        // }
        // return $this->photo_url;
    }
    //🚮test update profile image 

    protected $with = [
        'roles',
        'roles.permissions',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }
    public function patient()
    {
        return $this->hasOne(Patient::class);
    }

//collegamenti con i msg

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }
}


