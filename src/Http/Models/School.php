<?php

namespace Transave\ScolaCvManagement\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Transave\ScolaCvManagement\Database\Factories\SchoolFactory;
use Transave\ScolaCvManagement\Helpers\UUIDHelper;

class School extends Model
{
    use HasFactory, UUIDHelper;

    protected $table = 'schools';

    protected $guarded = ['id'];

    protected static function newFactory()
    {
        return SchoolFactory::new();
    }
}
