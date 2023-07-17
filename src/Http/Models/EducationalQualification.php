<?php

namespace Transave\ScolaCvManagement\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Transave\ScolaCvManagement\Database\Factories\EducationalQualificationFactory;
use Transave\ScolaCvManagement\Helpers\UUIDHelper;

class EducationalQualification extends Model
{
    use HasFactory, UUIDHelper;

    protected $guarded = [ "id" ];

    protected $table = 'educational_qualifications';

    public function cv() : BelongsTo
    {
        return $this->belongsTo(CV::class);
    }

    public function qualification() : BelongsTo
    {
        return $this->belongsTo(Qualification::class);
    }

    public function country() : BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    protected static function newFactory()
    {
        return EducationalQualificationFactory::new();
    }
}


