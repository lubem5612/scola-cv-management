<?php

namespace Transave\ScolaCvManagement\Http\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Transave\ScolaCvManagement\Database\Factories\CredentialsFactory;

class Credential extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    //  protected $guarded = [];

    protected $table = 'credentials';

    protected $fillable = [
        'user_id',
        'file',
        'fileType',
        'id'
    ];

    protected static function newFactory()
    {
        return CredentialsFactory::new();
    }

}


