<?php
namespace Transave\ScolaCvManagement\Http\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Transave\ScolaCvManagement\database\factories\CvUploadFactory;


class CvUpload extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $table = 'cv_upload';

    protected $guarded = [
        'id',
        'user_id',
        'cvName'
    ];


    protected static function newFactory()
    {
        return CvUploadFactory::new();
    }
}


