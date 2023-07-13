<?php

namespace Transave\ScolaCvManagement\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Transave\ScolaCvManagement\Database\Factories\QualificationFactory;

class Qualification extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'qualifications';

    protected static function newFactory()
    {
        return QualificationFactory::new();
    }
}
