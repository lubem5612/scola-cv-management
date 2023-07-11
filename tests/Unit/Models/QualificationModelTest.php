<?php
namespace Transave\ScolaCvManagement\Tests\Unit\Models;

use Transave\ScolaCvManagement\Http\Models\Qualifications;
use Orchestra\Testbench\TestCase;

class QualificationModelTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_can_check_if_Qualifications_model_exists()
    {
        $this->assertTrue(class_exists(Qualifications::class), 'Qualifications model does not exist.');
    }
}
