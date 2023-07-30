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

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function origin()
    {
        return $this->belongsTo(Country::class, 'country_of_origin_id', 'id');
    }

    public function residence()
    {
        return $this->belongsTo(Country::class, 'country_of_residence_id', 'id');
    }

    public function lgOfResidence()
    {
        return $this->belongsTo(Lg::class, 'lg_of_residence_id', 'id');
    }

    public function lgOfOrigin()
    {
        return $this->belongsTo(Lg::class, 'lg_of_origin_id', 'id');
    }

    public function qualification()
    {
        return $this->belongsTo(Lg::class, 'qualification_id', 'id');
    }

    protected static function newFactory()
    {
        return UserFactory::new();
    }
}
