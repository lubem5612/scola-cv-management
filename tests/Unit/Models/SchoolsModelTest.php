<?php

namespace Transave\ScolaCvManagement\Tests\Unit\Models;

use Transave\ScolaCvManagement\Http\Models\Schools;
use Orchestra\Testbench\TestCase;


class SchoolsModelTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_can_check_if_Schools_model_exists()
    {
        $this->assertTrue(class_exists(Schools::class), 'Schools model does not exist.');
    }
}
