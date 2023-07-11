<?php
namespace Transave\ScolaCvManagement\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Transave\ScolaCvManagement\Database\Factories\UsersFactory;

/**
 * @method static where(string $string, string $string1, mixed $email)
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

     protected $table = 'users';

    protected $guarded = [
        'firstName',
        'lastName',
        'faculty_id',
        'department_id',
        'email',
        'password',
        'phone',
        'gender',
        'marital_status',
        'nationality',
        'lga',
        'state_of_resident',
        'residential_address',
        'permanent_address',
        'dob',
        'no_of_children',
        'user_type',
        'id'
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
        return UsersFactory::new();
    }
}
