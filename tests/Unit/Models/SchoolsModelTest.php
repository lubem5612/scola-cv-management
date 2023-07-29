<?php
namespace Transave\ScolaCvManagement\Tests\Unit\Models;

use Transave\ScolaCvManagement\Http\Models\School;
use Transave\ScolaCvManagement\Tests\TestCase;


class SchoolsModelTest extends TestCase
{
    private $school;

    public function setUp(): void
    {
        parent::setUp();
        $this->school = School::factory()->create();
    }

    /** @test */
    public function school_model_can_be_initiated_with_factory()
    {
        $this->assertTrue($this->school instanceof School);
    }

    /** @test */
    public function school_table_exists_in_database()
    {
        $this->assertModelExists($this->school);
    }
}
