<?php

namespace Transave\ScolaCvManagement\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Transave\ScolaCvManagement\Database\Factories\PublicationFactory;
use Transave\ScolaCvManagement\Helpers\UUIDHelper;

class Publication extends Model
{
    use HasFactory, UUIDHelper;

    protected $guarded = [
        "id"
    ];

    protected $table = 'publications';



    public function cv() : BelongsTo
    {
        return $this->belongsTo(CV::class);
    }

    protected static function newFactory()
    {
        return PublicationFactory::new();
    }

}


