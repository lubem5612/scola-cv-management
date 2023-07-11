<?php
namespace Transave\ScolaCvManagement\Tests\Unit\Models;

use Transave\ScolaCvManagement\Http\Models\Faculty;
use Orchestra\Testbench\TestCase;


class FacultyModelTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_can_check_if_Faculty_model_exists()
    {
        $this->assertTrue(class_exists(Faculty::class), 'Faculty model does not exist.');
    }
}
