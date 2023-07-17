<?php
namespace Transave\ScolaCvManagement\Http\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Transave\ScolaCvManagement\Database\Factories\CVFactory;
use Transave\ScolaCvManagement\Helpers\UUIDHelper;


class CV extends Model
{
    use HasFactory, UUIDHelper;

    protected $table = 'cvs';

    protected $guarded = [
        'id'
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(config('scolacv.auth_model'));
    }

    protected static function newFactory()
    {
        return CVFactory::new();
    }
}


