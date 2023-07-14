<?php
namespace Transave\ScolaCvManagement\Http\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Transave\ScolaCvManagement\Database\Factories\CVFactory;
use Transave\ScolaCvManagement\Helpers\UUIDHelper;


class CV extends Model
{
    use HasFactory, UUIDHelper;

    protected $table = 'cvs';

    protected $guarded = [
        'id'
    ];

    protected static function newFactory()
    {
        return CVFactory::new();
    }
}


