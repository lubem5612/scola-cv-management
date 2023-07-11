<?php

namespace Transave\ScolaCvManagement\Tests\Unit\Models;

use Transave\ScolaCvManagement\Http\Models\Specialization;
use Orchestra\Testbench\TestCase;

class SpecializationModelTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_can_check_if_Specialization_model_exists()
    {
        $this->assertTrue(class_exists(Specialization::class), 'Specialization model does not exist.');
    }
}
