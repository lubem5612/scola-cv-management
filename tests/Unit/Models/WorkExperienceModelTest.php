<?php
namespace Transave\ScolaCvManagement\Tests\Unit\Models;

use Transave\ScolaCvManagement\Http\Models\WorkExperience;
use Transave\ScolaCvManagement\Tests\TestCase;


class WorkExperienceModelTest extends TestCase
{
    private $workExperience;

    public function setUp(): void
    {
        parent::setUp();
        $this->workExperience = WorkExperience::factory()->create();
    }

    /** @test */
    public function workExperience_model_can_be_initiated_with_factory()
    {
        $this->assertTrue($this->workExperience instanceof WorkExperience);
    }

    /** @test */
    public function workExperience_table_exists_in_database()
    {
        $this->assertModelExists($this->workExperience);
    }
}
