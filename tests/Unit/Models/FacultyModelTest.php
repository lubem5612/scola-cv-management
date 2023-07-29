<?php
namespace Transave\ScolaCvManagement\Tests\Unit\Models;

use Transave\ScolaCvManagement\Http\Models\Faculty;
use Transave\ScolaCvManagement\Tests\TestCase;


class FacultyModelTest extends TestCase
{
    private $faculty;

    public function setUp(): void
    {
        parent::setUp();
        $this->faculty = Faculty::factory()->create();
    }

    /** @test */
    public function faculty_model_can_be_initiated_with_factory()
    {
        $this->assertTrue($this->faculty instanceof Faculty);
    }

    /** @test */
    public function faculty_table_exists_in_database()
    {
        $this->assertModelExists($this->faculty);
    }
}
