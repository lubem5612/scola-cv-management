<?php


namespace Transave\ScolaCvManagement\Http\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Transave\ScolaCvManagement\Database\Factories\HobbyFactory;
use Transave\ScolaCvManagement\Helpers\UUIDHelper;

class Hobby extends Model
{
    use HasFactory, UUIDHelper;

    protected $guarded = [ "id" ];

    protected $table = "hobbies";

    public function cv() : BelongsTo
    {
        return $this->belongsTo(CV::class);
    }

    protected static function newFactory()
    {
        return HobbyFactory::new();
    }
}