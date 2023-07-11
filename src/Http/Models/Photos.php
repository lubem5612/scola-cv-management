<?php

namespace Transave\ScolaCvManagement\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Transave\ScolaCvManagement\Database\Factories\PhotosFactory;
use Laravel\Sanctum\HasApiTokens;

class Photos extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = 'photos';

    protected $guarded = [
        "id",
        "photo"
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function newFactory()
    {
        return PhotosFactory::new();
    }
}
