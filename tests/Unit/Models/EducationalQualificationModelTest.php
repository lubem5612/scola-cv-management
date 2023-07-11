<?php
namespace Transave\ScolaCvManagement\Tests\Unit\Models;

use Transave\ScolaCvManagement\Http\Models\EducationalQualification;
use Orchestra\Testbench\TestCase;


class EducationalQualificationModelTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_can_check_if_Educational_Qualification_model_exists()
    {
        $this->assertTrue(class_exists(EducationalQualification::class), 'Educational Qualification model does not exist.');
    }
}
