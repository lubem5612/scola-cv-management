<?php

namespace Transave\ScolaCvManagement\Http\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Transave\ScolaCvManagement\Database\Factories\QualificationFactory;

class Qualifications extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


               //  protected $guarded = [];

               protected $table = 'qualifications';

               protected $fillable = [
                   'id',
                   'qualification'
               ];

    protected static function newFactory()
    {
        return QualificationFactory::new();
    }

}
