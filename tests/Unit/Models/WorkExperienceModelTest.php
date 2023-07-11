<?php
namespace Transave\ScolaCvManagement\Tests\Unit\Models;

use Transave\ScolaCvManagement\Http\Models\WorkExperience;
use Orchestra\Testbench\TestCase;


class WorkExperienceModelTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_can_check_if_WorkExperience_model_exists()
    {
        $this->assertTrue(class_exists(WorkExperience::class), 'WorkExperience model does not exist.');
    }
}
