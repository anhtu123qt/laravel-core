<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function newestPost()
    {
        return $this->hasOne(Post::class)->orderBy('created_at','DESC');
    }

    public function getNameAttribute($value)
    {
        return strtoupper($value);
    }

    public function getDateCreateAttribute()
    {
        return $this->created_at->format('H:m:s d-m-Y');
    }

    const ROLE_ADMIN = 1;
    
    public function scopeAdmin($query)
    {
        $query->where('is_admin', self::ROLE_ADMIN);
    }  
}
