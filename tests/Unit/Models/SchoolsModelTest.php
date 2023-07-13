<?php

namespace Transave\ScolaCvManagement\Tests\Unit\Models;

use Transave\ScolaCvManagement\Http\Models\School;
use Orchestra\Testbench\TestCase;


class SchoolsModelTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_can_check_if_Schools_model_exists()
    {
        $this->assertTrue(class_exists(School::class), 'School model does not exist.');
    }
}
