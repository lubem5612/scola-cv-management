<?php

namespace Transave\ScolaCvManagement\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Transave\ScolaCvManagement\Database\Factories\SpecializationFactory;
use Transave\ScolaCvManagement\Helpers\UUIDHelper;

class Specialization extends Model
{
    use HasFactory, UUIDHelper;

    protected $guarded = ['id'];

    protected $table = 'specialization';

    public function cv() : BelongsTo
    {
        return $this->belongsTo(CV::class);
    }

    protected static function newFactory()
    {
        return SpecializationFactory::new();
    }
}
