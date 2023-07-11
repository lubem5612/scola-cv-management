<?php

namespace Transave\ScolaCvManagement\Http\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Transave\ScolaCvManagement\Database\Factories\SpecializationFactory;

class Specialization extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


               //  protected $guarded = [];

               protected $table = 'specialization';

               protected $fillable = [
                   'id',
                   'user_id',
                   'name',
                   'description'
               ];

    protected static function newFactory()
    {
        return SpecializationFactory::new();
    }
}
