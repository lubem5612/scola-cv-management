<?php
namespace Transave\ScolaCvManagement\Tests\Unit\Models;

use Transave\ScolaCvManagement\Http\Models\Department;
use Orchestra\Testbench\TestCase;

class DepartmentModelTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_can_check_if_Department_model_exists()
    {
        $this->assertTrue(class_exists(Department::class), 'DepartmentController model does not exist.');
    }
}
