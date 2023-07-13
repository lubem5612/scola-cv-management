<?php


namespace Transave\ScolaCvManagement\Http\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Transave\ScolaCvManagement\Database\Factories\LgFactory;

class Lg extends Model
{
    use HasFactory;

    protected $table = "lgs";

    protected $guarded = [
        "id"
    ];

    public function state() : BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    protected static function newFactory()
    {
        return LgFactory::new();
    }
}