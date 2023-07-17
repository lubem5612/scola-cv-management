<?php

namespace Transave\ScolaCvManagement\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Transave\ScolaCvManagement\Database\Factories\CredentialFactory;
use Transave\ScolaCvManagement\Helpers\UUIDHelper;

class Credential extends Model
{
    use HasFactory, UUIDHelper;

    protected $guarded = [
        "id"
    ];

    protected $table = 'credentials';

    public function cv() : BelongsTo
    {
        return $this->belongsTo(CV::class);
    }

    protected static function newFactory()
    {
        return CredentialFactory::new();
    }

}


