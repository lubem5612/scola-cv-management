<?php
namespace Transave\ScolaCvManagement\Tests\Unit\Models;

use Transave\ScolaCvManagement\Http\Models\Department;
use Transave\ScolaCvManagement\Tests\TestCase;


class DepartmentModelTest extends TestCase
{
    private $department;

    public function setUp(): void
    {
        parent::setUp();
        $this->department = Department::factory()->create();
    }

    /** @test */
    public function department_model_can_be_initiated_with_factory()
    {
        $this->assertTrue($this->department instanceof Department);
    }

    /** @test */
    public function department_table_exists_in_database()
    {
        $this->assertModelExists($this->department);
    }
}
