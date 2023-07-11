<?php

namespace Transave\ScolaCvManagement\Http\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Transave\ScolaCvManagement\Database\Factories\PublicationFactory;

class Publications extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

            //  protected $guarded = [];

            protected $table = 'publications';

            protected $fillable = [
                'id',
                'user_id',
                'publication',
            ];

    protected static function newFactory()
    {
        return PublicationFactory::new();
    }

}


