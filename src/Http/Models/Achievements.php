<?php

namespace Transave\ScolaCvManagement\Http\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Transave\ScolaCvManagement\Database\Factories\AchievementFactory;

class Achievements extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    //  protected $guarded = [];

        protected $table = 'achievements';

        protected $fillable = [
            'user_id',
            'achievementName',
            'dateAchieved',
            'description',
            'id'
        ];

    protected static function newFactory()
    {
        return AchievementFactory::new();
    }

}


