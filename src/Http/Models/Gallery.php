<?php

namespace Transave\ScolaCvManagement\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Transave\ScolaCvManagement\Database\Factories\GalleryFactory;
use Transave\ScolaCvManagement\Helpers\UUIDHelper;

class Gallery extends Model
{
    use HasFactory, UUIDHelper;

    protected $table = 'galleries';

    protected $guarded = [
        "id"
    ];

    public function cv() : BelongsTo
    {
        return $this->belongsTo(CV::class);
    }

    protected static function newFactory()
    {
        return GalleryFactory::new();
    }
}
