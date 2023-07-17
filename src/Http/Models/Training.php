<?php


namespace Transave\ScolaCvManagement\Http\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Transave\ScolaCvManagement\Database\Factories\TrainingFactory;
use Transave\ScolaCvManagement\Helpers\UUIDHelper;

class Training extends Model
{
    use HasFactory, UUIDHelper;

    protected $guarded = [
        "id"
    ];
    protected $table = "trainings";

    public function cv() : BelongsTo
    {
        return $this->belongsTo(CV::class);
    }

    public function country() : BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    protected static function newFactory()
    {
        return TrainingFactory::new();
    }
}