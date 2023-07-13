<?php
namespace Transave\ScolaCvManagement\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Transave\ScolaCvManagement\Database\Factories\UserFactory;
use Transave\ScolaCvManagement\Helpers\UUIDHelper;

/**
 * @method static where(string $string, string $string1, mixed $email)
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, UUIDHelper;

    protected $table = 'users';

    protected $guarded = [
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
        return UserFactory::new();
    }
}
