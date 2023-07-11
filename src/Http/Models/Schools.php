<?php

namespace Transave\ScolaCvManagement\Http\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Transave\ScolaCvManagement\Database\Factories\SchoolsFactory;

class Schools extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    //  protected $guarded = [];

    protected $table = 'specialization';

    protected $guarded = [
        'id',
        'name'
    ];

    protected static function newFactory()
    {
        return SchoolsFactory::new();
    }
}
