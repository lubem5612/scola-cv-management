<?php

namespace Transave\ScolaCvManagement\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Transave\ScolaCvManagement\Database\Factories\FacultyFactory;
use Transave\ScolaCvManagement\Helpers\UUIDHelper;

class Faculty extends Model
{
    use HasFactory, UUIDHelper;

    protected $guarded = [ 'id' ];

    protected $table = 'faculties';

    public function departments() : HasMany
    {
        return $this->hasMany(Department::class);
    }

    protected static function newFactory()
    {
        return FacultyFactory::new();
    }
}


