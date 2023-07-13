<?php
namespace Transave\ScolaCvManagement\Http\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Transave\ScolaCvManagement\Database\Factories\DepartmentFactory;
use Transave\ScolaCvManagement\Helpers\UUIDHelper;

class Department extends Model
{
    use HasFactory, UUIDHelper;

    protected $table = 'departments';

    protected $guarded = [
        "id"
    ];

    public function faculty() : BelongsTo
    {
        return $this->belongsTo(Faculty::class);
    }

    protected static function newFactory()
    {
        return DepartmentFactory::new();
    }
}
