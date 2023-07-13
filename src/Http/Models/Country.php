<?php


namespace Transave\ScolaCvManagement\Http\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Transave\ScolaCvManagement\Database\Factories\CountryFactory;

class Country extends Model
{
    use HasFactory;
    protected $guarded = [
        "id"
    ];
    protected $table = "countries";

    protected static function newFactory()
    {
        return CountryFactory::new();
    }
}