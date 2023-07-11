<?php

namespace Transave\ScolaCvManagement\Http\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Transave\ScolaCvManagement\Database\Factories\EducationalQualificationFactory;

class EducationalQualification extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


        //  protected $guarded = [];

        protected $table = 'educational_qualification';

        protected $fillable = [
            'user_id',
            'institutionName',
            'department_id',
            'courseStudy',
            'qualification_id',
            'startDate',
            'endDate',
            'country',
            'id'
        ];

    protected static function newFactory()
    {
        return EducationalQualificationFactory::new();
    }
}


