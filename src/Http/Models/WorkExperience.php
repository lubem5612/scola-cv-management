<?php

namespace Transave\ScolaCvManagement\Http\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Transave\ScolaCvManagement\Database\Factories\WorkExperienceFactory;

class WorkExperience extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;



              //  protected $guarded = [];

              protected $table = 'work_experience';

              protected $fillable = [
                  'id',
                  'user_id',
                  'companyName',
                  'position',
                  'responsibilities',
                  'startDate',
                  'endDate'
              ];
    protected static function newFactory()
    {
        return WorkExperienceFactory::new();
    }

}
