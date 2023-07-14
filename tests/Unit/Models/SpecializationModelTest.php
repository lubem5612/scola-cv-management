<?php
namespace Transave\ScolaCvManagement\Tests\Unit\Models;

use Transave\ScolaCvManagement\Http\Models\Specialization;
use Transave\ScolaCvManagement\Tests\TestCase;


class SpecializationModelTest extends TestCase
{
    private $specialization;

    public function setUp(): void
    {
        parent::setUp();
        $this->specialization = Specialization::factory()->create();
    }

    /** @test */
    public function specialization_model_can_be_initiated_with_factory()
    {
        $this->assertTrue($this->specialization instanceof Specialization);
    }

    /** @test */
    public function specialization_table_exists_in_database()
    {
        $this->assertModelExists($this->specialization);
    }
}
