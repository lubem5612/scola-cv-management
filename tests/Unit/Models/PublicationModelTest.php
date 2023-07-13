<?php
namespace Transave\ScolaCvManagement\Tests\Unit\Models;

use Transave\ScolaCvManagement\Http\Models\Publication;
use Orchestra\Testbench\TestCase;

class PublicationModelTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_can_check_if_Publications_model_exists()
    {
        $this->assertTrue(class_exists(Publication::class), 'Publication model does not exist.');
    }
}
