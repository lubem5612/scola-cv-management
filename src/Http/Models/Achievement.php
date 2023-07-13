<?php

namespace Transave\ScolaCvManagement\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Transave\ScolaCvManagement\Database\Factories\AchievementFactory;
use Transave\ScolaCvManagement\Helpers\UUIDHelper;

class Achievement extends Model
{
    use HasFactory, UUIDHelper;

    protected $guarded = [
        "id"
    ];
    protected $table = 'achievements';

    public function user() : BelongsTo
    {
        return $this->belongsTo(config('scolacv.auth_model'));
    }

    protected static function newFactory()
    {
        return AchievementFactory::new();
    }

}

