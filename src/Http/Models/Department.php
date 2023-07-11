<?php
namespace Transave\ScolaCvManagement\Http\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Transave\ScolaCvManagement\Database\Factories\DepartmentFactory;

class Department extends Model
{
    use HasFactory;

    protected $table = 'department';

    protected $guarded = [
        "id",
        "name"
    ];


    protected static function newFactory()
    {
        return DepartmentFactory::new();
    }
}
