<?php


namespace Transave\ScolaCvManagement\Http\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Transave\ScolaCvManagement\Database\Factories\RefereeFactory;
use Transave\ScolaCvManagement\Helpers\UUIDHelper;

class Referee extends Model
{
    use HasFactory, UUIDHelper;

    protected $table = "referees";

    protected $guarded = [ "id" ];

    public function cv() : BelongsTo
    {
        return $this->belongsTo(CV::class);
    }

    protected static function newFactory()
    {
        return RefereeFactory::new();
    }
}